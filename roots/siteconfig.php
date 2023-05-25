<?php
/**
 * External functions file
 */
require_once(__DIR__.'/plugins/functions.php');

$configFiles = glob(__DIR__.'/../config/backend/*.config.php');
foreach ($configFiles as $file) {
    require_once($file);
}
