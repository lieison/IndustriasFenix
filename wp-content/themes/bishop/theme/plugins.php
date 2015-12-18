<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

return array(
    array(
        'name'         => 'YITH Maintenance Mode',
        'slug' 		   => 'yith-maintenance-mode',
        'required' 	   => false,
        'version'      => '1.1.1',
    ),

    array(
        'name'               => 'Revolution Slider',
        'slug'               => 'revslider',
        'source'             => YIT_THEME_PLUGINS_PATH . '/revslider.zip',
        'required'           => false,
        'version'            => '4.6.5',
        'force_activation'   => false,
        'force_deactivation' => true,
    ),
    array(
        'name'               => 'WPBakery Visual Composer',
        'slug'               => 'js_composer',
        'source'             => YIT_THEME_PLUGINS_PATH . '/js_composer.zip',
        'required'           => true,
        'version'            => '4.4.1',
        'force_activation'   => false,
        'force_deactivation' => true,
    ),
    array(
        'name'               => 'Ultimate Addons for Visual Composer',
        'slug'               => 'Ultimate_VC_Addons',
        'source'             => YIT_THEME_PLUGINS_PATH . '/Ultimate_VC_Addons.zip',
        'required'           => false,
        'version'            => '3.8.0',
        'force_activation'   => false,
        'force_deactivation' => true,
    ),
    array(
        'name'         => 'WooCommerce',
        'slug' 		   => 'woocommerce',
        'required' 	   => false,
        'version'      => '2.2.8',
    ),

    array(
        'name' 		=> 'YITH WooCommerce Compare',
        'slug' 		=> 'yith-woocommerce-compare',
        'required' 	=> false,
        'version'   => '1.1.2',
    ),

    array(
        'name' 		=> 'YITH WooCommerce Ajax Navigation',
        'slug' 		=> 'yith-woocommerce-ajax-navigation',
        'required' 	=> false,
        'version'   => '1.3.1'
    ),


    array(
        'name'      => 'YITH WooCommerce Colors and Labels Variations',
        'slug'      => 'yith-woocommerce-colors-labels-variations',
        'repository'   => 'YIT Repository',
        'required' 	=> false,
        'version' 	=> '1.1.0'
    ),

    array(
        'name'      => 'YITH WooCommerce Featured Video',
        'slug'      => 'yith-woocommerce-featured-video',
        'required'  => false,
        'version'   => '1.1.0'
    ),

    defined( 'YITH_YWZM_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Zoom Magnifier',
        'slug'   => 'yith-woocommerce-zoom-magnifier',
        'required'  => false,
        'version'   => '1.2.0',
    ),

    defined( 'YITH_WCWL_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Wishlist',
        'slug'   => 'yith-woocommerce-wishlist',
        'required'  => false,
        'version'   => '2.0.6',
    ),

    defined( 'YITH_WCAS_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Ajax Search',
        'slug'   => 'yith-woocommerce-ajax-search',
        'required'  => false,
        'version'   => '1.1.1'
    ),

    defined( 'YITH_YWRAQ_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Request a Quote',
        'slug'   => 'yith-woocommerce-request-a-quote',
        'required'  => false,
        'version'   => '1.0.2'
    ),

    defined( 'YWCTM_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Catalog Mode',
        'slug'   => 'yith-woocommerce-catalog-mode',
        'required'  => false,
        'version'   => '1.0.3'
    ),

    defined( 'YITH_YWAR_PREMIUM' ) ? array() : array(
        'name'         => 'YITH Woocommerce Advanced Reviews',
        'slug' 		   => 'yith-woocommerce-advanced-reviews',
        'required' 	   => false,
        'version'      => '1.0.0',
    ),

    defined( 'YITH_YWOT_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Order Tracking',
        'slug'   => 'yith-woocommerce-order-tracking',
        'required'  => false,
        'version'   => '1.0.2'
    ),

    defined( 'YWRR_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Review Reminder',
        'slug'   => 'yith-woocommerce-review-reminder',
        'required'  => false,
        'version'   => '1.0.2'
    ),

    defined( 'YITH_YWCM_PREMIUM' ) ? array() : array(
        'name'      => 'YITH WooCommerce Cart Message',
        'slug'      => 'yith-woocommerce-cart-messages',
        'required'  => false,
        'version'   => '1.0.0'
    ),

    defined( 'YITH_YWPI_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce PDF Invoice and Shipping List',
        'slug'   => 'yith-woocommerce-pdf-invoice',
        'required'  => false,
        'version'   => '1.1.0'
    ),

    defined( 'YITH_WCSTRIPE_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Stripe',
        'slug'   => 'yith-woocommerce-stripe',
        'required'  => false,
        'version'   => '1.0.0'
    ),

    defined( 'YITH_WCAUTHNET_PREMIUM' ) ? array() : array(
        'name'   => 'YITH WooCommerce Authorize.net Payment Gateway',
        'slug'   => 'yith-woocommerce-authorizenet-payment-gateway',
        'required'  => false,
        'version'   => '1.0.0'
    ),
    defined( 'YITH_YWSL_PREMIUM' ) ? array() : array(
        'name'         => 'YITH WooCommerce Social Login',
        'slug'         => 'yith-woocommerce-social-login',
        'required'     => false,
        'version'      => '1.0.0',
    ),
    defined( 'YITH_WPV_PREMIUM' ) ? array() : array(
        'name'         => 'YITH WooCommerce Multi Vendor',
        'slug'         => 'yith-woocommerce-product-vendors',
        'required'     => false,
        'version'      => '1.0.0',
    ) ,
    defined( 'YLC_PREMIUM' ) ? array() : array(
        'name'         => 'YITH Live Chat',
        'slug'         => 'yith-live-chat',
        'required'     => false,
        'version'      => '1.0.0',
    ),
    defined( 'YITH_INFS_PREMIUM' ) ? array() : array(
        'name'   => 'YITH Infinite Scrolling',
        'slug'   => 'yith-infinite-scrolling',
        'required'  => false,
        'version'   => '1.0.0'
    ),


);