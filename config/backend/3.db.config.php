<?php
/**
 * Database configuration file
 */

switch ($cfg['env']) {
    case 'test':
        $cfg['dbHost'] = '127.0.0.1';
        $cfg['dbBase'] = 'wlcplnetspntst';
        $cfg['dbUser'] = 'wlcplnetspntst';
        $cfg['dbPass'] = 'SJulLtb3fFRtAmJpHKeJs6VvGqc63Fsq';
        $cfg['dbPort'] = 3306;

        break;

    case 'qa':
    case 'dev':
        $cfg['dbHost'] = '127.0.0.1';
        $cfg['dbBase'] = 'wlcplnetspndev';
        $cfg['dbUser'] = 'wlcplnetspndev';
        $cfg['dbPass'] = 'fVWor2seKU2A3KKgyn1EzsvolZ7ukEer';
        $cfg['dbPort'] = 3306;

        break;

    default :
        $cfg['dbHost'] = '127.0.0.1';
        $cfg['dbBase'] = 'wlcplnetspnprd';
        $cfg['dbUser'] = 'wlcplnetspnprd';
        $cfg['dbPass'] = 'HXiuBLeVREukZFGm0hm3gZhm8HSmbucK';
        $cfg['dbPort'] = 3306;

        break;
}
