<?php
use eGamings\WLC\System;

global $cfg;
$cfg['root'] = str_replace('\\', '/', __DIR__);

if (!isset($_SERVER['DOCUMENT_ROOT']) || $_SERVER['DOCUMENT_ROOT'] == '') {
	$_SERVER['DOCUMENT_ROOT'] = $cfg['root'];
}

require_once $cfg['root'].'/../vendor/autoload.php';

//Init system
require_once $cfg['root'].'/../vendor/egamings/wlc_core/root/init.php';

//Launch
$system = new System();

// Check for cli cron
if (php_sapi_name() == 'cli') {
    if (!empty($argv[1])) switch($argv[1]) {
        case 'runcron':
            $system->runCron();
            break;
    }
    exit();
}

if (isset($_GET['content']) && $_GET['content'] == 1) {
    include($cfg['content']);
    return;
}

$system->run();
