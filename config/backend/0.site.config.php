<?php
/**
 * Site configuration file
 */

$dev_env_prefixes = ['psklo', 'devlo', 'devxa'];

date_default_timezone_set('Europe/Riga');
define('KEEPALIVE_PROXY', 'http://keepalive.proxy:8080');

/**
 * Website name(title)
 */
$cfg['websiteName'] = 'PlanetSpin Casino'; //Correct site name: 'Casino'
$cfg['websiteUrl'] = 'planetspin.casino'; //Correct domain name: 'casino.com'
$cfg['websiteDescription'] = ''; //Site description
$cfg['websiteKeywords'] = ''; //Site keywords

$site_url_name = strtolower($cfg['websiteName']); //Only site name: 'casino'

/**
 * checking the env, redefinning for none prod sites
 */
switch ($cfg['env']) {
    case 'test':
        /* Other configs dependant from $cfg[env] */
        $cfg['site'] = 'https://test-' . $site_url_name . '.egamings.com';

        // Redirect rules ('<trailing part of request domain>' => '<redirect_domain>')
        $cfg['domains'] = Array();

        $cfg['mobile_domains'] = Array();

        break;

    case 'qa':
        /* Other configs dependant from $cfg[env] */
        $cfg['site'] = 'https://qa-' . $site_url_name . '.egamings.com';

        // Redirect rules ('<trailing part of request domain>' => '<redirect_domain>')
        $cfg['domains'] = Array();

        $cfg['mobile_domains'] = Array();

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        break;

    case 'dev':
        /* Other configs dependant from $cfg[env] */
        foreach ($dev_env_prefixes as $prefix) {
            if (strpos($_SERVER['SERVER_NAME'], $prefix . '-' . $site_url_name . '.egamings.com') !== false) {
                $cfg['site'] = 'https://' . $prefix . '-' . $site_url_name . '.egamings.com:' . $_SERVER['SERVER_PORT'];
                $cfg['msite'] = 'https://m.' . $prefix . '-' . $site_url_name . '.egamings.com:' . $_SERVER['SERVER_PORT'];
            }
        }

        define('SITECONFIG_LOCAL_FILE', __DIR__ . '/../../siteconfig_local.php');

        if (file_exists(SITECONFIG_LOCAL_FILE)) {
            require_once(SITECONFIG_LOCAL_FILE);
        }

        $cfg['mobileEnabled'] = 0;

        //Display errors on dev
        ini_set('display_errors', 0);
        error_reporting(0);

        break;

    default :
        /* Other configs dependant from $cfg[env] */
        $cfg['site'] = 'https://www.' . $site_url_name . '.com';

        // Redirect rules ('<trailing part of request domain>' => '<redirect_domain>')
        $cfg['domains'] = Array();

        $cfg['mobile_domains'] = Array();

        break;
}

// Request was made via nginx
if (!empty($_SERVER['HTTP_HOST'])) {
    $cfg['site'] = 'https://'.$_SERVER['HTTP_HOST'];
}

/**
 * Checking if mobile, $cfg['site'] required to be changed
 */
if (!empty($cfg['mobileEnabled'])) {
    if (isset($cfg['mobile']) && $cfg['mobile'] == 1 && (($cfg['mobileDetected']) && !$cfg['forceDesktop'])) {
        $breakdown = explode('//', $cfg['site']);
        $breakdown[1] = 'm.' . $breakdown[1];
        if ($cfg['env'] == 'prod') { //need to remove www if on prod. environment
            $breakdown[1] = str_replace('www.', '', $breakdown[1]);
        }
        $cfg['site'] = implode('//', $breakdown);

        setcookie('FORCE_DESKTOP', 0, time() + 0, '/', $cfg['websiteUrl'], true, true); //removing
    } else if ($cfg['mobileDomainUsed'] && isset($_GET['forcedesktop'])) {
        setcookie('FORCE_DESKTOP', 1, time() + 2592000, '/', $cfg['websiteUrl'], true, true); //30 days, secure, onlyhttp
    }
}

/**
 * Site URLs and PATHs
 */
if (isset($cfg['static'])) {
    $cfg['js'] = $cfg['site'] . '/' . $cfg['static'] . 'js';
    $cfg['css'] = $cfg['site'] . '/' . $cfg['static'] . 'css';
}
$cfg['static'] = $cfg['site'] . '/static';
if ($cfg['env'] == 'dev' || !isset($cfg['static'])) {
    $cfg['js'] = $cfg['static'] . '/js'; //on development environment direct access to JS files
    $cfg['css'] = $cfg['static'] . '/css';
}
$cfg['img'] = $cfg['static'] . '/images';
$cfg['bin_img'] = $cfg['site'] . '/content/wp-content/themes/whitelabel/images';

/**
 * Mobile Site URLs and PATHs
 */
if (isset($cfg['mobile']) && $cfg['mobile'] == 1 && $cfg['mobileEnabled'] == 1) {
    $cfg['static'] .= '/m';
    $cfg['js'] .= '/m';
    $cfg['css'] .= '/m';
    $cfg['mimg'] = $cfg['static'] . '/images/m';
} else {
    $cfg['mobile'] = 0;
}

if (class_exists('Mobile_Detect')) {
    $detect = new Mobile_Detect;
    $zone = explode('.', $_SERVER['HTTP_HOST']);
    if ((isset($zone[0]) && str_replace(array('http://', 'https://'), array('', ''), $zone[0]) == 'm') ||
        $detect->isMobile() && !isset($_COOKIE['FORCE_DESKTOP']) && !isset($_GET['forcedesktop'])) {
        $cfg['mobileDynamic'] = 1;
    }
}


$cfg['social_ka_proxy'] = KEEPALIVE_PROXY;
/** social logins */
if ($cfg['env'] === 'prod') {
    $cfg['social'] = array(
        //client_id, client_secure
        //mail.ru
        'ml' => array('id' => '', 'private' => ''),
        //odnoklassniki
        'ok' => array('id' => '', 'public' => '', 'private' => ''),
        //facebook
        'fb' => array('id' => '', 'private' => ''),
        //vkontakte
        'vk' => array('id' => '', 'private' => ''),
        //google plus
        'gp' => array('id' => '', 'private' => ''),
    );
} else {
    $cfg['social'] = array(
        //client_id, client_secure
        //mail.ru
        'ml' => array('id' => '', 'private' => ''),
        //odnoklassniki
        'ok' => array('id' => '', 'public' => '', 'private' => ''),
        //facebook
        'fb' => array('id' => '', 'private' => ''),
        //vkontakte
        'vk' => array('id' => '', 'private' => ''),
        //google plus
        'gp' => array('id' => '', 'private' => ''),
    );
}

$cfg['socialConnectParams'] = '?message=FINALIZE_SOCIAL_CONNECT&social=#social#';
$cfg['userSocialRegister'] = '';

$cfg['defaultTimeZonedefaultTimeZone'] = 180; // GMT+3
$cfg['maxWithdrawalQueries'] = 3; //Maximum withdrawal money requests allowed
$cfg['platformCountry'] = 'rus'; //Platform country is a country that counts as "main" for the website
$cfg['userCountry'] = 'rus'; //DEFAULT User country, will be updated if GEO ip thing is available
$cfg['checkPassOnUpdate'] = 1; //0 or 1, Check user current password on profile update
$cfg['fastRegistration'] = 0;
$cfg['gameImageWidth'] = 315;
$cfg['resetPassByLink'] = 1;
$cfg['userProfilePhoneIsRequired'] = false;
$cfg['defaultCurrency'] = 'EUR';
$cfg['disallowCountryChange'] = 1;//if 1 users couldn't change country
$cfg['PasswordSecureLevel'] = 'medium';//available low, medium, strong

$cfg['useFundistTemplate'] = 1;
$cfg['restorePasswordUrl'] = '%language%';
$cfg['completeRegstrationUrl'] = '%language%';

// Hooks configuration 'hook_id' => [array of function names]
$cfg['hooks'] = [
    'api:games:list' => ['hook_api_games_list'],
    'system:language:before' => ['hook_system_language_before'],
    'api:bootstrap'          => ['hook_api_bootstrap_chat', 'hook_api_bootstrap_theme_config'],
    'user:datacheck' => ['hook_user_datacheck'],
    'system:run:before' => ['hook_system_run_before'],
    'system:cron:after' => ['hook_system_cron_after']
];

$cfg['useFundistBanners'] = true;
$cfg['loginBy'] = 'all';
$cfg['allowPartialUpdate'] = true;

$cfg['insideIps'] = [
    '192.168.88.*',
    '188.130.240.79'
];

$cfg['bonusesExcludeHeavyFields'] = false;
$cfg['newTempUsersEndpoint']=true;
