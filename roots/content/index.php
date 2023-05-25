<?php

/* var_dump($_SERVER);
exit(); */

// WordPress view bootstrapper
define( 'WP_USE_THEMES', true );
//
require(__DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, ['wp', 'wp-blog-header.php']));
