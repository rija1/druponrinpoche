<?php
/**
 * WordPress plugin "OnlineTeachings" main file, responsible for initiating the plugin
 *
 * @package OnlineTeachings
 * @author Rija Ratinahirana Rigdzin
 * @version 0.1
 */

/*
Plugin Name: OnlineTeachings
Plugin URI:
Description: Online teachings, registration and attendance
Version: 0.1
Author: Rija Ratinahirana Rigdzin
Author email: rija.ratinahirana@gmail.com
Text Domain: online-teachings
*/

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// Define certain plugin variables as constants.
if ( ! defined( 'ONLINETEACHINGS_ABSPATH' ) ) {
	define( 'ONLINETEACHINGS_ABSPATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ONLINETEACHINGS__FILE__' ) ) {
	define( 'ONLINETEACHINGS__FILE____FILE__', __FILE__ );
}

if ( ! defined( 'ONLINETEACHINGS__FILE___BASENAME' ) ) {
	define( 'ONLINETEACHINGS__FILE___BASENAME', plugin_basename( ONLINETEACHINGS__FILE__ ) );
}

/*
 * Define global JSON encoding options that OnlineTeachings uses.
 * We don't escape slashes (anymore), which makes search/replace of URLs in the database much easier.
 */
if ( ! defined( 'ONLINETEACHINGS_JSON_OPTIONS' ) ) {
	$onlineteachings_json_options = 0;
	if ( defined( 'JSON_UNESCAPED_SLASHES' ) ) {
        $onlineteachings_json_options |= JSON_UNESCAPED_SLASHES; // Introduced in PHP 5.4.
	}
	define( 'ONLINETEACHINGS_JSON_OPTIONS', $onlineteachings_json_options );
	unset( $onlineteachings_json_options );
}

/**
 * Load TablePress class, which holds common functions and variables.
 */
//require_once ONLINETEACHINGS_ABSPATH . 'classes/class-onlineteachings.php';

// Start up TablePress on WordPress's "init" action hook.
add_action( 'init', array( 'OnlineTeachings', 'run' ) );
