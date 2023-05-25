<?php
use eGamings\WLC\Front;

$promoCode = '';

if (isset($_GET['promoCode']) && $_GET['promoCode']) {
    $promoCode = $_GET['promoCode'];
}

/**
 * User defined global context
 * context contains data array or
 * extrnal file and function (foo_file.php?foo_function_name)
 * file must be at plugin directory
 * function must retun array for context
 */
$_context = array(
    'timezone' => (Front::User('id') > 0 ? Front::User('timezone') : _cfg('defaultTimeZone')),
    'logged_in' => intval(Front::User('id') > 0),
    'site' => _cfg('site'),
    'user' => Front::User(),
    'seo' => seo(),
    'promoCode' => $promoCode,
    'session' => $_SESSION,
    'origin_web' => (_cfg('mobile') == 1 ? _cfg('original_site') : null),
    'redirect_ref' => (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : _cfg('href')),
    'msite' => _cfg('msite'),
    'sessionEnded' => ((isset($_GET['session']) && $_GET['session'] == 1) ? 1 : 0),
    'mobileGames' => (_cfg('mobileDynamic') ? 1 : 0),
    'mobile' => (_cfg('mobileDetected')  && (!_cfg('forceDesktop') || _cfg('forceMobile')) ) ? 1 : 0,
    'navigation' => array(
        '' => _('navigation_main'),
        'bookmaker' => _('navigation_bookmaker'),
        'games/slots' => _('navigation_slots'),
        'games/board' => _('navigation_board'),
        'games/live' => _('navigation_evo'),
        'social_network' => _('navigation_social_network'),
        'games/poker' => _('navigation_poker'),
        'fair-play' => _('navigation_fair_play'),
    ),
);

//Required after social registration
if (isset($_SESSION['socialRegistration'])) {
    unset($_SESSION['socialRegistration']);
}

/**
 * User defined routing
 * url => array(template[,context]),
 * if context is string, try to call function from plugins/function.php
 */
$template = 'index';
if(_cfg('mobileDetected')  && (!_cfg('forceDesktop') || _cfg('forceMobile')) )
    $template = $template.'_m';
$_routes = array(
    'login' => array($template),
    'profile' => array($template),
    'register' => array($template),
    'restore' => array($template),
    'games' => array($template),
    '' => array($template)
);