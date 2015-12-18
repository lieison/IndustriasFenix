<?php
// Core Functions

/*-----------------------------------------------------------------------------------*/
/*	- Setup core Framework
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_global_config' ) ) {
	function uw_global_config() {
		$setup = array(
			'primary'		=> array(
				'admin'			=> true,
				'post_types'	=> true,
			),
			'mce'			=> array(
				'fontselect'		=> true,
				'fontsizeselect'	=> true,
				'formats'			=> true,
				'shortcodes'		=> true,
			),
			'helpers'		=> array (
				'display_queries_memory'	=> false,
			),
			'minify'		=> array(
				'js'	=> true,
				'css'	=> true
			),
		);
		return apply_filters( 'uw_global_config', $setup );
	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Checks framework for core support
/*-----------------------------------------------------------------------------------*/
function uw_supports( $group, $feature ) {
	$setup = uw_global_config();
	if( isset( $setup[$group][$feature] ) && $setup[$group][$feature] ) {
		return true;
	} else {
		return false;
	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Returns the correct option value
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'uw_option' ) ) {
	function uw_option( $id, $fallback = false, $param = false ) {
		// Return value based on $_GET value
		if ( isset( $_GET[ 'uw_'.$id ] ) ) {
			if ( '-1' == $_GET[ 'uw_'.$id ] ) {
				return false;
			} else {
				return $_GET[ 'uw_'.$id ];
			}
		}
		// Return value based on panel option
		else {
			// Get options
			global $uw_options;
			// Check if fallback is false set to empty
			if ( $fallback == false ) {
				$fallback = '';
			}
			// If option value exists and not empty return value
			if( isset( $uw_options[ $id ] ) && '' != $uw_options[ $id ] ) {
				$output = $uw_options[ $id ];
			}
			// Otherwise return fallback
			else {
				$output = $fallback;
			}
			// If param defined return param
			if ( !empty( $uw_options[ $id ] ) && $param ) {
				$output = $uw_options[ $id ][ $param ];
			}
		}
		return $output;
	}
}