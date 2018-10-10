<?php
/*
Plugin Name: CAHNRSWSUWP SNAP-ED
Version: 0.0.1
Description: Plugin for SNAP-ED custom features.
Author: washingtonstateuniversity, Danial Bleile
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/wsuwp-plugin-skeleton
Text Domain: cahnrswsuwp-plugin-snap-ed
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
	add_action( 'admin_notices', create_function( '', // phpcs:ignore WordPress.PHP.RestrictedPHPFunctions.create_function_create_function
	"echo '<div class=\"error\"><p>" . __( 'WSUWP Plugin Skeleton requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'wsuwp-plugin-skeleton' ) . "</p></div>';" ) );
	return;
} else {
	include_once __DIR__ . '/includes/cahnrswsuwp-plugin-snap-ed.php';
}
