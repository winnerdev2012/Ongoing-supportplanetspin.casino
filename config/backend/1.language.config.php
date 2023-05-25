<?php
/**
 * Language configuration file
 */

/**
 * Language
 * Deciding the default language
 */
$uri_array = explode('/', !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');

if (!empty($uri_array) && !empty($uri_array[1]) && strlen($uri_array[1]) === 2) {
    $cfg['language'] = $uri_array[1];
    setcookie('sitelang', $cfg['language'], time() + 30 * 24 * 3600, '/');
} elseif (!empty($_COOKIE['sitelang'])) {
    $cfg['language'] = $_COOKIE['sitelang'];
} else {
    $cfg['language'] = 'en';
}

/**
 * Enable browser language detection (default language)
 */
$cfg['enableBrowserLanguage'] = true;

// Language => Locale
$languagesLocalesFile = dirname(__FILE__) . '/../locales.json';
$cfg['allowedLanguages'] = array('en' => 'en_US', 'ru' => 'ru_RU');
if (file_exists($languagesLocalesFile) && ($languagesLocalesData = file_get_contents($languagesLocalesFile)) != "") {
    $languagesLocalesData = @json_decode($languagesLocalesData, true);
    if (is_array($languagesLocalesData)) {
        $languages = array();
        foreach ($languagesLocalesData as $locale => $localeInfo) {
            $languages[$locale] = (isset($localeInfo['locale'])) ? $localeInfo['locale'] : $locale;
        }
        $cfg['allowedLanguages'] = $languages;
    }
}

$cfg['languagesInfo'] = [
    'en' => ['code' => 'en', 'label' => 'English'],
    'ru' => ['code' => 'ru', 'label' => 'Русский'],
    'ar' => ['code' => 'ar', 'label' => 'العربية'],
    'de' => ['code' => 'de', 'label' => 'Deutsch'],
    'es' => ['code' => 'es', 'label' => 'Español'],
    'em' => ['code' => 'em', 'label' => 'Español de México'],
    'fa' => ['code' => 'fa', 'label' => 'فارسی'],
    'fr' => ['code' => 'fr', 'label' => 'Français'],
    'hi' => ['code' => 'hi', 'label' => 'हिन्दी'],
    'id' => ['code' => 'id', 'label' => 'Bahasa Indonesia'],
    'ja' => ['code' => 'ja', 'label' => '日本語'],
    'ko' => ['code' => 'ko', 'label' => '한국어'],
    'pt' => ['code' => 'pt', 'label' => 'Português'],
    'pb' => ['code' => 'pb', 'label' => 'Português do Brasil'],
    'tr' => ['code' => 'tr', 'label' => 'Türkçe'],
    'vi' => ['code' => 'vi', 'label' => 'Tiếng Việt'],
    'zc' => ['code' => 'zc', 'label' => '简体中文'],
    'zt' => ['code' => 'zt', 'label' => '繁體中文']
];
