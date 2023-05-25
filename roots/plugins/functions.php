<?php
// Place here hooks and function helpers

function seo()
{
    global $_meta;
    $meta_file = $_SERVER['DOCUMENT_ROOT'] . '/meta.php';
    if (file_exists($meta_file)) include($meta_file);

    $return = new stdClass();
    $return->title = _cfg('websiteName');
    $return->keywords = _cfg('websiteKeywords');
    $return->description = _cfg('websiteDescription');

    if (_cfg('page') != 'default' && _cfg('page')) {
        $return->title .= ' - ' . _cfg('page');
    }

    $r = isset($_GET['route']) ? $_GET['route'] : 'default';
    if (isset($_meta[$r])) {
        $data = $_meta[$r];

        if (isset($data['title'])) $return->title = $data['title'];
        if (isset($data['keywords'])) $return->keywords = $data['keywords'];
        if (isset($data['description'])) $return->description = $data['description'];
    }

    return $return;
}

function hook_user_datacheck($data)
{

    if (!empty($data['social']) && !empty($data['social_uid']))
        return;

    $error = array();

    // if (!isset($data['repeat_password']) || !$data['repeat_password']) {
    //     $error['repeat_password'] = _(' ');
    // }

    // if ($data['repeat_password'] !== $data['password']) {
    //     $error['password_missmatch'] = _('password_does_not_match');
    // }

    return $error;
}

function get_cdn_filelist($url)
{
    $sslContextOpts = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );

    return array_flip(explode("\n", @file_get_contents($url, false, stream_context_create($sslContextOpts))));
}

function hook_api_games_list($items = null)
{
    if (!is_object($items) || !is_array($items->games)) {
        return;
    }

    $cdn = _cfg('websiteCDN');
    $staticPath = ($cdn) ? $cdn : 'static';
    $cdnThumbs = (!$cdn) ? [] : get_cdn_filelist($cdn . '/games_thumb/filelist.txt');
    $cdnBg = (!$cdn) ? [] : get_cdn_filelist($cdn . '/games_bg/filelist.txt');

    $mIdArr = [];
    if (is_array($items->merchants)) {
        foreach ($items->merchants as $mId => $mInfo) {
            $mIdArr[$mId] = $mInfo['menuId'];
        }
    }

    $dir = dirname(__FILE__);
    foreach ($items->games as $k => $v) {
        $urlParts = explode('/', $v['Url'], 2);

        /* Custom Thumbnail Image */
        $imageFileNameInfo = pathinfo($items->games[$k]['Image']);
        $imageFileName = $imageFileNameInfo['filename'] . '.jpg';

        $thumbs = [
            implode('/', [$mIdArr[$urlParts[0]], $imageFileName]),
            implode('/', [$v['MerchantID'], $v['ID'] . '.jpg']),
            implode('/', [$urlParts[0], $urlParts[1] . '.jpg'])
        ];

        foreach ($thumbs as $thumbUrl) {
            if (array_key_exists($thumbUrl, $cdnThumbs) !== false) {
                $items->games[$k]['Image'] = implode('/', [$cdn, 'games_thumb', $thumbUrl]);
                break;
            }

            $thumbFilePath = implode('/', [$dir, '..', 'static', 'images', 'games_thumb', $thumbUrl]);
            if (file_exists($thumbFilePath)) {
                $items->games[$k]['Image'] = implode('/', ['', 'static', 'images', 'games_thumb', $thumbUrl]);
                break;
            }
        }

        /* Custom Background */
        $bgImages = [
            implode('/', [$mIdArr[$urlParts[0]], $imageFileName]),
            implode('/', [$v['MerchantID'], $v['ID'] . '.jpg']),
            implode('/', [$urlParts[0], $urlParts[1] . '.jpg'])
        ];

        foreach ($bgImages as $bgImageUrl) {
            if (array_key_exists($bgImageUrl, $cdnBg) !== false) {
                $items->games[$k]['Background'] = implode('/', [$cdn, 'games_bg', $bgImageUrl]);
                break;
            }

            $bgImagePath = implode('/', [$dir, '..', 'static', 'images', 'games_bg', $bgImageUrl]);
            if (file_exists($bgImagePath)) {
                $items->games[$k]['Background'] = implode('/', ['', 'static', 'images', 'games_bg', $bgImageUrl]);
                break;
            }
        }
    }
}

function hook_api_bootstrap_theme_config($data = null)
{
    if (empty($data)) {
        return;
    }

    $configFiles = glob(__DIR__ . '/../../config/frontend/*.config.json');
    foreach ($configFiles as $file_name) {
        $json = json_decode(file_get_contents($file_name), true);
        if (!empty($json) && is_array($json)) {
            foreach ($json as $name => $item) {
                $data->$name = (isset($data->$name) && is_array($data->$name)) ? array_merge_recursive($data->$name, $item) : $item;
            }
        }
    }

    return $data;
}

function hook_api_afftracker($affData = [])
{
    if (!empty($affData['affiliateSystem'])) {
        switch ($affData['affiliateSystem']) {
            case 'faff':
                switch ($affData['affiliateClickId']) {
                    case 'adsmain':
                        if (!empty($affData['affiliateParams']['faff_clickid'])) {
                            $urlPrefix = 'http:/';
                            if (defined('KEEPALIVE_PROXY')) {
                                $urlPrefix = KEEPALIVE_PROXY;
                            }
                            $url = $urlPrefix . "/tracking.adsmain.com/aff_lsr?transaction_id={$affData['affiliateParams']['faff_clickid']}&security_token=ac9c486a5293b0e9350530337266e800";
                            $r = @file_get_contents($url);
                            if ($r == 'success=true;') {
                                header('X-AffiliateTracker-Result: success');
                            } else {
                                header('X-AffiliateTracker-Result: already-tracked');
                            }
                        }
                        break;
                }
        }
    }
}

use eGamings\WLC\Db;
use eGamings\WLC\FundistEmailTemplate;

function hook_system_cron_after() {
    $fundistTemplate = new FundistEmailTemplate();
    $result = Db::query("SELECT * FROM users_temp WHERE DATE_ADD(reg_time, INTERVAL 12 HOUR) < NOW() AND reg_notify = 0 LIMIT 25");
    if ($result) {
        while($user = $result->fetch_assoc()) {
            // Send notification
            $user['firstName'] = $user['first_name'];
            $user['lastName'] = $user['last_name'];
            $sendResult = $fundistTemplate->sendRegistrationReminder($user);
            //var_dump($sendResult); exit();
            $updateQuery = 'UPDATE users_temp SET ';
            if ($sendResult === true) {
                $updateQuery .= 'reg_notify=1';
            } else {
                $updateQuery .= 'reg_notify=2, reg_notify_time = NOW()';
            }
            $updateQuery .= ' WHERE id="'.$user['id'].'"';
            Db::query($updateQuery);
            sleep(1);
        }
        $result->free_result();
    }
}
