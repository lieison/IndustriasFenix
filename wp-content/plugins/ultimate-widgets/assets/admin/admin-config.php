<?php
// Admin Panel Options

if ( ! class_exists( 'Redux' ) ) {
    return;
}

// Add CSS panel
function uw_redux_custom_css() {
    wp_register_style( 'uw-redux-custom-css', uw_plugin_url( 'assets/admin/redux-custom.css' ), array('redux-admin-css'), time(), 'all' );
    wp_enqueue_style('uw-redux-custom-css');
}
add_action( 'redux/page/uw_options/enqueue', 'uw_redux_custom_css' );

// Option name where all the Redux data is stored.
$opt_name = "uw_options";

// All the possible arguments for Redux.
$uw_redux_header = '<span id="name"><span style="color: #4dbefa;">U</span>ltimate <span style="color: #4dbefa;">W</span>idgets</span>';

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'              => 'uw_options', // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'          => $uw_redux_header . __( 'Panel','kho' ), // Name that appears at the top of your panel
    'display_version'       => '', // Version that appears at the top of your panel
    'menu_type'             => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'        => true, // Show the sections below the admin menu item or not
    'menu_title'            => __( 'UW Panel', 'kho' ),
    'page_title'            => __( 'Panel', 'kho' ),
    'global_variable'       => '', // Set a different name for your global variable other than the opt_name
    'dev_mode'              => false, // Show the time the page took to load, etc
    'customizer'            => true, // Enable basic customizer support,
    'async_typography'      => false, // Enable async for fonts,
    'disable_save_warn'     => true,
    'open_expanded'         => false,
    'templates_path'        => UW_PLUGIN_DIR .'/assets/admin/templates/', // Path to the templates file for various Redux elements
    // OPTIONAL -> Give you extra features
    'page_priority'         => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'           => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'      => 'manage_options', // Permissions needed to access the options panel.
    'menu_icon'             => '', // Specify a custom URL to an icon
    'last_tab'              => '', // Force your panel to always open to a specific tab (by id)
    'page_icon'             => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
    'page_slug'             => 'uw_options', // Page slug used to denote the panel
    'save_defaults'         => true, // On load save the defaults to DB before user clicks save or not
    'default_show'          => false, // If true, shows the default value next to each field that is not the default value.
    'default_mark'          => '', // What to print by the field's title if the value shown is default. Suggested: *
    'admin_bar'             => true,
    'admin_bar_icon'        => 'dashicons-admin-generic',
    // CAREFUL -> These options are for advanced use only
    'output'                => false, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'            => false, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
    'footer_credit'         => false, // Disable the footer credit of Redux. Please leave if you can help it.
    'footer_text'           => "",
    'show_import_export'    => false,
    'system_info'           => false,
);

$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/Khositeweb',
    'title' => 'Like us on Facebook',
    'icon'  => 'el el-facebook'
);
$args['share_icons'][] = array(
    'url'   => 'https://twitter.com/Khositeweb',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el el-twitter'
);
$args['share_icons'][] = array(
    'url'   => 'https://plus.google.com/+Khositeweb/',
    'title' => 'Find us on google+',
    'icon'  => 'el el-googleplus'
);

Redux::setArgs( "uw_options", $args );

/**
    Widgets
**/
Redux::setSection( $opt_name, array(
    'id'            => 'widgets',
    'icon'          => 'el el-cogs',
    'title'         => __( 'Widgets', 'kho' ),
    'customizer'    => false,
    'fields'        => array(
        array(
            'id'        => 'minify_css',
            'type'      => 'switch', 
            'title'     => __( 'Minify CSS', 'kho' ),
            'subtitle'  => __( 'Compress all CSS in a single file or activate the CSS when the widgets are on the page.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'minify_js',
            'type'      => 'switch', 
            'title'     => __( 'Minify JS', 'kho' ),
            'subtitle'  => __( 'Compress all JS in a single file or activate the JS when the widgets are on the page.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'about-me',
            'type'      => 'switch', 
            'title'     => __( 'About Me Widget', 'kho' ),
            'subtitle'  => __( 'A widget that talks to you.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'ads-widget',
            'type'      => 'switch', 
            'title'     => __( 'Ads Widget', 'kho' ),
            'subtitle'  => __( 'Display ads in your sidebar.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'banner',
            'type'      => 'switch', 
            'title'     => __( 'Banner Widget', 'kho' ),
            'subtitle'  => __( 'Displays a banner with text.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'calendar',
            'type'      => 'switch', 
            'title'     => __( 'Calendar Widget', 'kho' ),
            'subtitle'  => __( 'Displays a calendar in the sidebar.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'contact-info',
            'type'      => 'switch', 
            'title'     => __( 'Contact Info Widget', 'kho' ),
            'subtitle'  => __( 'Add contact info, phone, email, etc.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'custom-links',
            'type'      => 'switch', 
            'title'     => __( 'Custom Links Widget', 'kho' ),
            'subtitle'  => __( 'Displays custom links.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'facebook',
            'type'      => 'switch', 
            'title'     => __( 'Facebook Widget', 'kho' ),
            'subtitle'  => __( 'Adds support for Facebook Page Plugin.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'flickr',
            'type'      => 'switch', 
            'title'     => __( 'Flickr Widget', 'kho' ),
            'subtitle'  => __( 'Pulls in images from your Flickr account.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'gmap',
            'type'      => 'switch', 
            'title'     => __( 'Google Map Widget', 'kho' ),
            'subtitle'  => __( 'Displays google map.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'login',
            'type'      => 'switch', 
            'title'     => __( 'Login Widget', 'kho' ),
            'subtitle'  => __( 'Displays Login/Register Form.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'mailchimp',
            'type'      => 'switch', 
            'title'     => __( 'MailChimp Widget', 'kho' ),
            'subtitle'  => __( 'Displays Mailchimp Subscription Form.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'menu',
            'type'      => 'switch', 
            'title'     => __( 'Menu Widget', 'kho' ),
            'subtitle'  => __( 'Displays a menu.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'posts-slider',
            'type'      => 'switch', 
            'title'     => __( 'Posts Slider Widget', 'kho' ),
            'subtitle'  => __( 'Displays a posts slider.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'posts-thumbnails',
            'type'      => 'switch', 
            'title'     => __( 'Posts Thumbnails Widget', 'kho' ),
            'subtitle'  => __( 'Shows a listing of your recent or random posts.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'search',
            'type'      => 'switch', 
            'title'     => __( 'Search Widget', 'kho' ),
            'subtitle'  => __( 'Displays a search form.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'slideshow',
            'type'      => 'switch', 
            'title'     => __( 'Slideshow Widget', 'kho' ),
            'subtitle'  => __( 'Displays a mini slideshow.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'social',
            'type'      => 'switch', 
            'title'     => __( 'Social Widget', 'kho' ),
            'subtitle'  => __( 'Displays icons with links to your social profiles.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'soundcloud',
            'type'      => 'switch', 
            'title'     => __( 'SoundCloud Widget', 'kho' ),
            'subtitle'  => __( 'Adds a Soundcloud player.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'tabs',
            'type'      => 'switch', 
            'title'     => __( 'Tabs Widget', 'kho' ),
            'subtitle'  => __( 'Displays Recent, Comments and Tags.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'testimonials',
            'type'      => 'switch', 
            'title'     => __( 'Testimonials Widget', 'kho' ),
            'subtitle'  => __( 'Displays a testimonial slider.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'text',
            'type'      => 'switch', 
            'title'     => __( 'Text Widget', 'kho' ),
            'subtitle'  => __( 'Displays of text or HTML.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'twitter',
            'type'      => 'switch', 
            'title'     => __( 'Twitter Widget', 'kho' ),
            'subtitle'  => __( 'Adds support for your tweets.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'video',
            'type'      => 'switch', 
            'title'     => __( 'Video Widget', 'kho' ),
            'subtitle'  => __( 'Add a video in your sidebar.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'weather',
            'type'      => 'switch', 
            'title'     => __( 'Weather Widget', 'kho' ),
            'subtitle'  => __( 'Displays weather in the sidebar.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
        array(
            'id'        => 'woo-cat',
            'type'      => 'switch', 
            'title'     => __( 'Woo Categories Widget', 'kho' ),
            'subtitle'  => __( 'Displays your product categories.', 'kho' ),
            "default"   => '1',
            'on'        => __( 'On', 'kho' ),
            'off'       => __( 'Off', 'kho' ),
        ),
    ),
));

/**
    Styling
**/
Redux::setSection( $opt_name, array(
    'id'            => 'styling',
    'icon'          => 'el el-magic',
    'title'         => __( 'Styling', 'kho' ),
    'customizer'    => false,
    'fields'        => array(
        array(
            'id'        => 'widgets_style',
            'type'      => 'select',
            'title'     => __( 'Widgets Style', 'kho' ), 
            'subtitle'  => __( 'Select your preferred style.', 'kho' ),
            'desc'      => '',
            'options'   => array(
                'style1'  => __( 'Style 1', 'kho' ),
                'style2'  => __( 'Style 2', 'kho' ),
                'style3'  => __( 'Style 3', 'kho' ),
                'style4'  => __( 'Style 4', 'kho' ),
                'style5'  => __( 'Style 5', 'kho' ),
                'style6'  => __( 'Style 6', 'kho' ),
                'style7'  => __( 'Style 7', 'kho' ),
            ),
            'default'   => 'style1',
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 1
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'        => 'style1_border_color',
            'type'      => 'color',
            'title'     => __( 'Style 1 Border Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
            'required'  => array( 'widgets_style', 'equals', 'style1' ),
        ),

        array(
            'id'        => 'style1_padding',
            'type'      => 'text',
            'title'     => __( 'Style 1 Padding', 'kho' ),
            'subtitle'  => __( 'Enter your custom padding in pixels.', 'kho' ),
            'default'   => '16px',
            'required'  => array( 'widgets_style', 'equals', 'style1' ),
        ),

        array(
            'id'        => 'style1_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 1 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '40px',
            'required'  => array( 'widgets_style', 'equals', 'style1' ),
        ),

        array(
            'id'          => 'style1_title_bg',
            'type'        => 'color',
            'title'       => __( 'Style 1 Title Background', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style1' ),
        ),

        array(
            'id'          => 'style1_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 1 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style1' ),
        ),

        array(
            'id'        => 'style1_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 1 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '10px',
            'required'  => array( 'widgets_style', 'equals', 'style1' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 2
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'        => 'style2_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 2 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '50px',
            'required'  => array( 'widgets_style', 'equals', 'style2' ),
        ),

        array(
            'id'          => 'style2_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 2 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style2' ),
        ),

        array(
            'id'        => 'style2_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 2 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '16px',
            'required'  => array( 'widgets_style', 'equals', 'style2' ),
        ),

        array(
            'id'          => 'style2_title_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 2 Title Border Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style2' ),
        ),

        array(
            'id'        => 'style2_title_border_width',
            'type'      => 'text',
            'title'     => __( 'Style 2 Title Border Width', 'kho' ),
            'subtitle'  => __( 'Enter your width for the title border.', 'kho' ),
            'default'   => '40%',
            'required'  => array( 'widgets_style', 'equals', 'style2' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 3
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'        => 'style3_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 3 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '30px',
            'required'  => array( 'widgets_style', 'equals', 'style3' ),
        ),

        array(
            'id'          => 'style3_title_bg',
            'type'        => 'color',
            'title'       => __( 'Style 3 Title Background', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style3' ),
        ),

        array(
            'id'          => 'style3_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 3 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style3' ),
        ),

        array(
            'id'        => 'style3_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 3 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '18px',
            'required'  => array( 'widgets_style', 'equals', 'style3' ),
        ),

        array(
            'id'          => 'style3_title_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 3 Title Border Bottom Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style3' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 4
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'          => 'style4_bg',
            'type'        => 'color',
            'title'       => __( 'Style 4 Background', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'          => 'style4_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 4 Border Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'        => 'style4_padding',
            'type'      => 'text',
            'title'     => __( 'Style 4 Padding', 'kho' ),
            'subtitle'  => __( 'Enter your custom padding in pixels.', 'kho' ),
            'default'   => '20px',
            'required'  => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'        => 'style4_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 4 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '30px',
            'required'  => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'          => 'style4_title_bg',
            'type'        => 'color',
            'title'       => __( 'Style 4 Title Background', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'          => 'style4_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 4 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'        => 'style4_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 4 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '14px',
            'required'  => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'          => 'style4_title_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 4 Title Border Bottom Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        array(
            'id'          => 'style4_title_border_right_color',
            'type'        => 'color',
            'title'       => __( 'Style 4 Title Border Right Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style4' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 5
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'        => 'style5_padding',
            'type'      => 'text',
            'title'     => __( 'Style 5 Padding Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom padding bottom in pixels.', 'kho' ),
            'default'   => '20px',
            'required'  => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'          => 'style5_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 5 Border Bottom Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'        => 'style5_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 5 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '50px',
            'required'  => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'          => 'style5_title_bg',
            'type'        => 'color',
            'title'       => __( 'Style 5 Title Background', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'          => 'style5_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 5 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'        => 'style5_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 5 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '14px',
            'required'  => array( 'widgets_style', 'equals', 'style5' ),
        ),

        array(
            'id'          => 'style5_title_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 5 Title Border Bottom Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'required'    => array( 'widgets_style', 'equals', 'style5' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 6
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'        => 'style6_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 6 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '50px',
            'required'  => array( 'widgets_style', 'equals', 'style6' ),
        ),

        array(
            'id'          => 'style6_title_color',
            'type'        => 'color',
            'title'       => __( 'Style 6 Title Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style6' ),
        ),

        array(
            'id'        => 'style6_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 6 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '16px',
            'required'  => array( 'widgets_style', 'equals', 'style6' ),
        ),

        array(
            'id'        => 'style6_title_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 6 Title Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your margin bottom for the title in pixels.', 'kho' ),
            'default'   => '30px',
            'required'  => array( 'widgets_style', 'equals', 'style6' ),
        ),

        array(
            'id'        => 'style6_title_primary_border_color',
            'type'      => 'color',
            'title'     => __( 'Style 6 Title Primary Border Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
            'required'  => array( 'widgets_style', 'equals', 'style6' ),
        ),

        array(
            'id'        => 'style6_title_secondary_border_color',
            'type'      => 'color',
            'title'     => __( 'Style 6 Title Secondary Border Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
            'required'  => array( 'widgets_style', 'equals', 'style6' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Style 7
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'          => 'style7_border_color',
            'type'        => 'color',
            'title'       => __( 'Style 7 Border Color', 'kho' ),
            'subtitle'    => __( 'Select your custom hex color.', 'kho' ),
            'default'     => '',
            'transparent' => false,
            'required'    => array( 'widgets_style', 'equals', 'style7' ),
        ),

        array(
            'id'        => 'style7_padding',
            'type'      => 'text',
            'title'     => __( 'Style 7 Padding', 'kho' ),
            'subtitle'  => __( 'Enter your custom padding in pixels.', 'kho' ),
            'default'   => '25px',
            'required'  => array( 'widgets_style', 'equals', 'style7' ),
        ),

        array(
            'id'        => 'style7_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 7 Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your custom margin bottom in pixels.', 'kho' ),
            'default'   => '25px',
            'required'  => array( 'widgets_style', 'equals', 'style7' ),
        ),

        array(
            'id'        => 'style7_title_color',
            'type'      => 'color',
            'title'     => __( 'Style 7 Title Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
            'transparent' => false,
            'required'  => array( 'widgets_style', 'equals', 'style7' ),
        ),

        array(
            'id'        => 'style7_title_font_size',
            'type'      => 'text',
            'title'     => __( 'Style 7 Title Font Size', 'kho' ),
            'subtitle'  => __( 'Enter your font size for the title in pixels.', 'kho' ),
            'default'   => '18px',
            'required'  => array( 'widgets_style', 'equals', 'style7' ),
        ),

        array(
            'id'        => 'style7_title_margin_bottom',
            'type'      => 'text',
            'title'     => __( 'Style 7 Title Margin Bottom', 'kho' ),
            'subtitle'  => __( 'Enter your margin bottom for the title in pixels.', 'kho' ),
            'default'   => '20px',
            'required'  => array( 'widgets_style', 'equals', 'style7' ),
        ),

        /*-----------------------------------------------------------------------------------*/
        /*  - Other Styles
        /*-----------------------------------------------------------------------------------*/
        array(
            'id'    => 'links-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Links Color', 'kho' ),
        ),

        array(
            'id'            => 'uw_custom_links_color',
            'type'          => 'color',
            'title'         => __( 'Links Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'uw_custom_links_hover_color',
            'type'          => 'color',
            'title'         => __( 'Links Hover Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'    => 'inputs-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Inputs Styles', 'kho' ),
        ),

        array(
            'id'            => 'input_bg',
            'type'          => 'link_color',
            'title'         => __( 'Input Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'input_color',
            'type'          => 'color',
            'title'         => __( 'Input Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'input_border',
            'type'          => 'link_color',
            'title'         => __( 'Input Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'    => 'buttons-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Buttons Styles', 'kho' ),
        ),

        array(
            'id'            => 'input_submit_bg',
            'type'          => 'link_color',
            'title'         => __( 'Input Submit Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'input_submit_color',
            'type'          => 'link_color',
            'title'         => __( 'Input Submit Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'input_submit_border',
            'type'          => 'link_color',
            'title'         => __( 'Input Submit Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'    => 'checkbox-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Checkbox Styles', 'kho' ),
        ),

        array(
            'id'            => 'checkbox_bg',
            'type'          => 'color',
            'title'         => __( 'Checkbox Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'checkbox_border',
            'type'          => 'color',
            'title'         => __( 'Checkbox Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'checkbox_checked_color',
            'type'          => 'color',
            'title'         => __( 'Checkbox Checked Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'    => 'checkbox-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Nav Slideshow Widget', 'kho' ),
        ),

        array(
            'id'            => 'nav_slideshow_bg',
            'type'          => 'link_color',
            'title'         => __( 'Nav Slideshow Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'nav_slideshow_color',
            'type'          => 'link_color',
            'title'         => __( 'Nav Slideshow Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),
    ),
));

/**
Styling => Calendar Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_calendar_widget',
    'title'         => __( 'Calendar Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'                => 'calendar_caption_color',
            'type'              => 'color',
            'title'             => __( 'Month Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_th_color',
            'type'              => 'color',
            'title'             => __( 'Weeks Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_td_color',
            'type'              => 'color',
            'title'             => __( 'Days Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_today_color',
            'type'              => 'color',
            'title'             => __( 'Today Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'calendar-style1-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Calendar Style 1', 'kho' ),
        ),

        array(
            'id'                => 'calendar_style1_caption_border_color',
            'type'              => 'color',
            'title'             => __( 'Month Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_style1_th_border_color',
            'type'              => 'color',
            'title'             => __( 'Weeks Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_style1_tbody_border_color',
            'type'              => 'color',
            'title'             => __( 'Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'calendar-style2-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Calendar Style 2', 'kho' ),
        ),

        array(
            'id'                => 'calendar_style2_th_bg',
            'type'              => 'color',
            'title'             => __( 'Weeks Background', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'                => 'calendar_style2_th_color',
            'type'              => 'color',
            'title'             => __( 'Weeks Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_style2_th_border_color',
            'type'              => 'color',
            'title'             => __( 'Weeks Border Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'            => 'calendar_style2_td_bg',
            'type'          => 'link_color',
            'title'         => __( 'Days Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'                => 'calendar_style2_td_color',
            'type'              => 'color',
            'title'             => __( 'Days Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'calendar_style2_td_border_color',
            'type'              => 'color',
            'title'             => __( 'Days Border Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'calendar-style3-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Calendar Style 3', 'kho' ),
        ),

        array(
            'id'                => 'calendar_style3_th_bg',
            'type'              => 'color',
            'title'             => __( 'Weeks Background', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'                => 'calendar_style3_th_color',
            'type'              => 'color',
            'title'             => __( 'Weeks Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),
    ),
));

/**
Styling => Contact Info Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_contact_info_widget',
    'title'         => __( 'Contact Info Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'    => 'contact-info-default-style-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Default Style', 'kho' ),
        ),

        array(
            'id'                => 'default_style_icons_color',
            'type'              => 'color',
            'title'             => __( 'Icons Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'default_style_icons_border_color',
            'type'              => 'color',
            'title'             => __( 'Icons Border Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'                => 'default_style_titles_color',
            'type'              => 'color',
            'title'             => __( 'Titles Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'contact-info-big-icons-style-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Big Icons Style', 'kho' ),
        ),

        array(
            'id'            => 'big_icons_style_icons_bg',
            'type'          => 'link_color',
            'title'         => __( 'Icons Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'big_icons_style_icons_color',
            'type'          => 'link_color',
            'title'         => __( 'Icons Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'big_icons_style_icons_border_color',
            'type'          => 'link_color',
            'title'         => __( 'Icons Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'                => 'big_icons_style_titles_color',
            'type'              => 'color',
            'title'             => __( 'Titles Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'contact-info-skype-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Skype Style', 'kho' ),
        ),

        array(
            'id'            => 'contact_info_skype_bg',
            'type'          => 'link_color',
            'title'         => __( 'Skype Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'contact_info_skype_color',
            'type'          => 'link_color',
            'title'         => __( 'Skype Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),
    ),
));

/**
Styling => Custom Links Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_custom_links_widget',
    'title'         => __( 'Custom Links Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'                => 'custom_links_widget_color',
            'type'              => 'color',
            'title'             => __( 'Links Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'custom_links_widget_color_hover',
            'type'              => 'color',
            'title'             => __( 'Links Color Hover', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'custom_links_widget_border_color',
            'type'              => 'color',
            'title'             => __( 'Links Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'custom_links_widget_border_color_hover',
            'type'              => 'color',
            'title'             => __( 'Links Border Bottom Color Hover', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),
    ),
));

/**
Styling => Login Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_login_widget',
    'title'         => __( 'Login Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'                => 'label_color',
            'type'              => 'color',
            'title'             => __( 'Label Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'show_pass_bg',
            'type'              => 'color',
            'title'             => __( 'Show Password Background', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'show_pass_color',
            'type'              => 'color',
            'title'             => __( 'Show Password Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'rememberme_color',
            'type'              => 'color',
            'title'             => __( 'Remember Me Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'                => 'rememberme_checked_color',
            'type'              => 'color',
            'title'             => __( 'Remember Me Checked Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
            'transparent'       => false,
        ),

        array(
            'id'    => 'logged-title',
            'type'  => 'info',
            'title' => false,
            'desc'  => __( 'Logged In', 'kho' ),
        ),

        array(
            'id'                => 'avatar_outside_border',
            'type'              => 'color',
            'title'             => __( 'Avatar Outside Border Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'                => 'avatar_inside_border',
            'type'              => 'color',
            'title'             => __( 'Avatar Inside Border Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'                => 'avatar_sonar',
            'type'              => 'color',
            'title'             => __( 'Avatar Hover Sonar Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'            => 'username_color',
            'type'          => 'link_color',
            'title'         => __( 'Username Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'                => 'nav_border_bottom',
            'type'              => 'color',
            'title'             => __( 'Menu Link Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),
    ),
));

/**
Styling => Menu Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_menu_widget',
    'title'         => __( 'Menu Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'                => 'links_border_bottom',
            'type'              => 'color',
            'title'             => __( 'Links Border Bottom Color', 'kho' ),
            'subtitle'          => __( 'Select your custom hex color.', 'kho' ),
            'default'           => '',
        ),

        array(
            'id'            => 'sub_icon_color',
            'type'          => 'link_color',
            'title'         => __( 'Sub Icon Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),
    ),
));

/**
Styling => Posts Slider Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_posts_slider_widget',
    'title'         => __( 'Posts Slider Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'img_hover_bg',
            'type'      => 'color',
            'title'     => __( 'Image Hover Background', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
        ),

        array(
            'id'        => 'posts_elements_bg',
            'type'      => 'text',
            'title'     => __( 'Title/Comments/Nav Background', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => 'rgba(0,0,0,0.5)',
        ),

        array(
            'id'        => 'posts_elements_hover_bg',
            'type'      => 'text',
            'title'     => __( 'Title/Nav Hover Background', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => 'rgba(0,0,0,0.8)',
        ),

        array(
            'id'            => 'posts_elements_color',
            'type'          => 'link_color',
            'title'         => __( 'Title/Comments/Nav Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),
    ),
));

/**
Styling => Tabs Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_tabs_widget',
    'title'         => __( 'Tabs Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'tabs_border',
            'type'      => 'color',
            'title'     => __( 'Tabs Border Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
        ),

        array(
            'id'            => 'tabs_top_bg',
            'type'          => 'link_color',
            'title'         => __( 'Tabs Top Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'tabs_top_color',
            'type'          => 'link_color',
            'title'         => __( 'Tabs Top Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'        => 'tab_recent_date_color',
            'type'      => 'color',
            'title'     => __( 'Tab Recent: Date Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
            'transparent'       => false,
        ),

        array(
            'id'        => 'tabs_recent_comments_border_color',
            'type'      => 'color',
            'title'     => __( 'Tabs Recent/Comments: Items Border Color', 'kho' ),
            'subtitle'  => __( 'Select your custom hex color.', 'kho' ),
            'default'   => '',
        ),

        array(
            'id'            => 'tab_tags_bg',
            'type'          => 'link_color',
            'title'         => __( 'Tab Tags: Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'tab_tags_color',
            'type'          => 'link_color',
            'title'         => __( 'Tab Tags: Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),
    ),
));

/**
Styling => Testimonials Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_testimonials_widget',
    'title'         => __( 'Testimonials Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'            => 'testimonials_nav_bg',
            'type'          => 'link_color',
            'title'         => __( 'Nav Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'testimonials_nav_color',
            'type'          => 'link_color',
            'title'         => __( 'Nav Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'testimonials_nav_border_color',
            'type'          => 'link_color',
            'title'         => __( 'Nav Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => array(
                'regular'   => '',
                'hover'     => '',
                'active'    => '',
            ),
        ),

        array(
            'id'            => 'testimonials_quote_bg',
            'type'          => 'color',
            'title'         => __( 'Quote Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'testimonials_quote_color',
            'type'          => 'color',
            'title'         => __( 'Quote Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'testimonials_avatar_bg',
            'type'          => 'color',
            'title'         => __( 'Avatar Background', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'testimonials_avatar_border_color',
            'type'          => 'color',
            'title'         => __( 'Avatar Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'testimonials_name_color',
            'type'          => 'color',
            'title'         => __( 'Name Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),
    ),
));

/**
Styling => Twitter Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_twitter_widget',
    'title'         => __( 'Twitter Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'            => 'tweets_color',
            'type'          => 'color',
            'title'         => __( 'Tweets Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'tweets_border_color',
            'type'          => 'color',
            'title'         => __( 'Tweets Border Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
        ),

        array(
            'id'            => 'tweets_icon_color',
            'type'          => 'color',
            'title'         => __( 'Tweets Icons Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),
    ),
));

/**
Styling => Weather Widget
**/
Redux::setSection( $opt_name, array(
    'id'            => 'style_weather_widget',
    'title'         => __( 'Weather Widget', 'kho' ),
    'customizer'    => false,
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'            => 'weather_temp_color',
            'type'          => 'color',
            'title'         => __( 'Weather Temp Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'weather_name_color',
            'type'          => 'color',
            'title'         => __( 'Weather Name/Desc/Days Temp Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'weather_stats_days_color',
            'type'          => 'color',
            'title'         => __( 'Weather Stats/Days Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
            'transparent'   => false,
        ),

        array(
            'id'            => 'weather_forecast_border_color',
            'type'          => 'color',
            'title'         => __( 'Weather Forecast Border Top Color', 'kho' ),
            'subtitle'      => __( 'Select your custom hex color.', 'kho' ),
            'default'       => '',
        ),
    ),
));

/**
    Custom CSS
**/
Redux::setSection( $opt_name, array(
    'id'            => 'custom_code',
    'icon'          => 'el el-css',
    'title'         => __( 'Custom CSS', 'kho' ),
    'customizer'    => false,
    'fields'        => array(
        array(
            'id'        => 'custom_css',
            'type'      => 'ace_editor',
            'mode'      => 'css',
            'theme'     => 'chrome',
            'title'     => __( 'Design Edits', 'kho' ),
            'subtitle'  => __( 'Quickly add some CSS to your theme to make design adjustments by adding it to this block. It is a much better solution then manually editing style.css', 'kho' ),
        ),
    ),
));

/**
    Import/Export
**/
Redux::setSection( $opt_name, array(
    'id'        => 'import_export',
    'title'     => __( 'Import / Export', 'kho' ),
    'icon'      => 'el el-refresh',
    'fields'    => array(
        array(
            'id'            => 'opt-import-export',
            'type'          => 'import_export',
            'title'         => 'Import Export',
            'subtitle'      => 'Save and restore your Redux options',
            'full_width'    => false,
        ),
    ),
));

class UW_Redux_Tracking {
    public $options = array();
    public $parent;
    private static $instance = null;
    public static function get_instance() {
        if ( null == self::$instance ) {self::$instance = new self;}
        return self::$instance;
    }

    function __construct() {}
    public function load( $parent ) {}
    function _enqueue_tracking() {}
    function _enqueue_newsletter() {}
    function tracking_request() {}
    function newsletter_request() {}
    function print_scripts( $selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '' ) {}
    function tracking() {}
}

UW_Redux_Tracking::get_instance();