<?php
/*
Plugin Name: Ultimate Widgets
Plugin URI: http://khositeweb.com/ultimate-widgets/
Description: Ultimate Widgets plugin allows you to add the most popular widgets like Ads, Contact Info, Facebook Page Plugin, Google Map, Testomonial, Twitter Widget, Social Widget, Soundclound, etc...
Author: Khothemes
Author URI: http://khositeweb.com/
Text Domain: kho
Domain Path: /languages/
Version: 1.0.3
*/

/*  Copyright 2007-2015 Khothemes

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define( 'UW_PLUGIN', __FILE__ );
define( 'UW_PLUGIN_DIR', untrailingslashit( dirname( UW_PLUGIN ) ) );
define( 'UW_VERSION', '1.0.3' );

function uw_plugin_url( $path = '' ) {
	$url = plugins_url( $path, UW_PLUGIN );

	if ( is_ssl() && 'http:' == substr( $url, 0, 5 ) ) {
		$url = 'https:' . substr( $url, 5 );
	}

	return $url;
}

/*-----------------------------------------------------------------------------------*/
/*	- Core functions
/*-----------------------------------------------------------------------------------*/
// Core functions
require_once ( UW_PLUGIN_DIR .'/assets/core.php' );
require_once ( UW_PLUGIN_DIR .'/assets/images-resize.php' );
require_once ( UW_PLUGIN_DIR .'/assets/styling.php' );
require_once ( UW_PLUGIN_DIR .'/assets/walker-nav.php' );
require_once ( UW_PLUGIN_DIR .'/assets/widgets-functions.php' );

// ReduxFramework admin panel
if ( function_exists( 'uw_supports' ) && uw_supports( 'primary', 'admin' ) ) {
	// Include the Redux options Framework
	if ( !class_exists( 'ReduxFramework' ) ) {
		require_once( UW_PLUGIN_DIR .'/assets/admin/redux-core/framework.php' );
	}
	// Register all the main options
	require_once( UW_PLUGIN_DIR .'/assets/admin/admin-config.php' );
}

/*-----------------------------------------------------------------------------------*/
/*	- Language/Widgets
/*-----------------------------------------------------------------------------------*/
add_action( 'plugins_loaded', 'uw_core' );
function uw_core() {
	load_plugin_textdomain( 'kho', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	uw_custom_widgets();
}

/*-----------------------------------------------------------------------------------*/
/*	- Scripts
/*-----------------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'uw_plugin_css' );
function uw_plugin_css() {
	if ( '1' == uw_option( 'minify_css', '1' ) ) {
		// Minified style
		wp_enqueue_style( 'uw-style', uw_plugin_url( 'assets/css/style-min.css' ), array(), UW_VERSION);
	} else {
		// Core style
		wp_enqueue_style( 'uw-style', uw_plugin_url( 'assets/css/styles/core-min.css' ), array(), UW_VERSION );
	}

	// RTL style
	if ( is_rtl() ) {
		wp_enqueue_style( 'ultimate-style-rtl', uw_plugin_url( 'assets/css/styles-rtl-min.css' ), array(), UW_VERSION );
	}
}

add_action( 'wp_footer', 'uw_plugin_js' );
function uw_plugin_js() {
	if ( '1' == uw_option( 'minify_js', '1' ) ) {
		wp_enqueue_script('uw-scripts', uw_plugin_url( 'assets/js/scripts-min.js' ), array('jquery'), UW_VERSION );
	}
}


add_action('admin_init', 'uw_admin_style' );
function uw_admin_style() {
	wp_enqueue_style( 'uw-admin-style', uw_plugin_url( 'assets/css/admin.css' ), array(), UW_VERSION );
}