<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

ini_set('display_errors', 1);

error_reporting(E_ALL | E_STRICT);

function pa($a,$stop=0,$exp=0){
    echo '<pre>';
    if($exp){
        var_dump($a);
    } else {print_r($a);
    }
    echo '</pre>';
    if($stop){
        die();
    }
}

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
