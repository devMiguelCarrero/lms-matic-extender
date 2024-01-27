<?php
/*
Plugin Name: LMS Matic Extender
Plugin URI: #
Description: Plugin made for LMS Mathic Wordpress Theme supporting
Version: 1.0.1
Author: slidmike
Author URI: #
License: OSLv3
Requires at least: 4.0
Text Domain: lmsmaticx
Domain Path: /lms-matic-extender/
*/

/* Copyright 2021
This program is free licensed software; 

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

//error_reporting(E_ALL);
//ini_set("display_errors", 1); 

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'LMSCX_DOMAIN' , 'lms-matic-extender' );
define( 'LMSCX_VERSION' , '1.0.1' );
define( 'LMSCX_SITE_URL', get_site_url() . '/' );
define( 'LMSCX_ACHIEVEMENTS_PATH' , plugin_dir_path( __FILE__ ) );
define( 'LMSCX_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );
define( 'LMSCX_PLUGIN_SCRIPT_URL' , LMSCX_PLUGIN_URL . '/assets/js/' );
define( 'LMSCX_PLUGIN_STYLE_URL' , LMSCX_PLUGIN_URL . '/assets/css/' );
define( 'LMSCX_ACHIEVEMENTS_PATH_INCLUDES' , LMSCX_ACHIEVEMENTS_PATH . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_CONFIG' , LMSCX_ACHIEVEMENTS_PATH_INCLUDES . 'config' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_APPLICATION' , LMSCX_ACHIEVEMENTS_PATH_INCLUDES . 'application' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_ENQUEUE' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'enqueue' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_SHORTCODE' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'shortcode' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_VIEW' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'view' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_CPT' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'cpt' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_METABOXES' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'metaboxes' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_ASYNC' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'async' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_MODEL' , LMSCX_ACHIEVEMENTS_PATH_INCLUDES . 'model' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_TIMEZONE' , LMSCX_ACHIEVEMENTS_PATH_APPLICATION . 'timezone' . DIRECTORY_SEPARATOR );
define( 'LMSCX_ACHIEVEMENTS_PATH_HELPERS' , LMSCX_ACHIEVEMENTS_PATH_INCLUDES . 'helpers' . DIRECTORY_SEPARATOR );
define( 'LMSCX_BUILD_PATH', LMSCX_ACHIEVEMENTS_PATH . DIRECTORY_SEPARATOR . 'build' . DIRECTORY_SEPARATOR );

require_once LMSCX_ACHIEVEMENTS_PATH_INCLUDES . 'lms-matic-extender-install.php';