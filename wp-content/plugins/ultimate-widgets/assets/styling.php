<?php
// All Custom CSS

/*-----------------------------------------------------------------------------------*/
/*	- Style Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_style_widgets' ) ) {
	function uw_style_widgets() {
		// Var
		$css = '';

		/**
		   Widget Style 1
		**/
		// Border color
		$style1_border_color = uw_option( 'style1_border_color' );
		if ( '' != $style1_border_color && '#e0e0e0' != $style1_border_color ) {
			$css .= '.uw_widget_wrap.style1 {border-color: '. $style1_border_color .';}';
		}

		// Padding
		$style1_padding = uw_option( 'style1_padding' );
		if ( '' != $style1_padding && '16px' != $style1_padding ) {
			$css .= '.uw_widget_wrap.style1 {padding: '. $style1_padding .' !important;}
					.uw_widget_wrap.style1 .uw-title {top: -'. $style1_padding .';}';
		}

		// Margin bottom
		$style1_margin_bottom = uw_option( 'style1_margin_bottom' );
		if ( '' != $style1_margin_bottom && '40px' != $style1_margin_bottom ) {
			$css .= '.uw_widget_wrap.style1, .uw_tabs_widget {margin-bottom: '. $style1_margin_bottom .';}';
		}

		// Title background
		$style1_title_bg = uw_option( 'style1_title_bg' );
		if ( '' != $style1_title_bg && '#e7f1ff' != $style1_title_bg ) {
			$css .= '.uw_widget_wrap.style1 .uw-title span {background: '. $style1_title_bg .';}';
		}

		// Title color
		$style1_title_color = uw_option( 'style1_title_color' );
		if ( '' != $style1_title_color && '#2676ef' != $style1_title_color ) {
			$css .= '.uw_widget_wrap.style1 .uw-title {color: '. $style1_title_color .';}';
		}

		// Title font size
		$style1_title_font_size = uw_option( 'style1_title_font_size' );
		if ( '' != $style1_title_font_size && '10px' != $style1_title_font_size ) {
			$css .= '.uw_widget_wrap.style1 .uw-title {font-size: '. $style1_title_font_size .';}';
		}

		/**
		   Widget Style 2
		**/
		// Margin bottom
		$style2_margin_bottom = uw_option( 'style2_margin_bottom' );
		if ( '' != $style2_margin_bottom && '50px' != $style2_margin_bottom ) {
			$css .= '.uw_widget_wrap.style2, .uw_tabs_widget {margin-bottom: '. $style2_margin_bottom .';}';
		}
		
		// Title color
		$style2_title_color = uw_option( 'style2_title_color' );
		if ( '' != $style2_title_color && '#333' != $style2_title_color ) {
			$css .= '.uw_widget_wrap.style2 .uw-title {color: '. $style2_title_color .';}';
		}

		// Title font size
		$style2_title_font_size = uw_option( 'style2_title_font_size' );
		if ( '' != $style2_title_font_size && '16px' != $style2_title_font_size ) {
			$css .= '.uw_widget_wrap.style2 .uw-title {font-size: '. $style2_title_font_size .';}';
		}

		// Title border color
		$style2_title_border_color = uw_option( 'style2_title_border_color' );
		if ( '' != $style2_title_border_color && '#4dbefa' != $style2_title_border_color ) {
			$css .= '.uw_widget_wrap.style2 .uw-title::after {border-color: '. $style2_title_border_color .';}';
		}

		// Title border width
		$style2_title_border_width = uw_option( 'style2_title_border_width' );
		if ( '' != $style2_title_border_width && '40%' != $style2_title_border_width ) {
			$css .= '.uw_widget_wrap.style2 .uw-title::after {width: '. $style2_title_border_width .';}';
		}

		/**
		   Widget Style 3
		**/
		// Margin bottom
		$style3_margin_bottom = uw_option( 'style3_margin_bottom' );
		if ( '' != $style3_margin_bottom && '30px' != $style3_margin_bottom ) {
			$css .= '.uw_widget_wrap.style3, .uw_tabs_widget {margin-bottom: '. $style3_margin_bottom .';}';
		}
		
		// Title background
		$style3_title_bg = uw_option( 'style3_title_bg' );
		if ( '' != $style3_title_bg && '#f2f2f2' != $style3_title_bg ) {
			$css .= '.uw_widget_wrap.style3 .uw-title {background-color: '. $style3_title_bg .';}';
		}

		// Title color
		$style3_title_color = uw_option( 'style3_title_color' );
		if ( '' != $style3_title_color && '#666' != $style3_title_color ) {
			$css .= '.uw_widget_wrap.style3 .uw-title {color: '. $style3_title_color .';}';
		}

		// Title font size
		$style3_title_font_size = uw_option( 'style3_title_font_size' );
		if ( '' != $style3_title_font_size && '18px' != $style3_title_font_size ) {
			$css .= '.uw_widget_wrap.style3 .uw-title {font-size: '. $style3_title_font_size .';}';
		}

		// Title border color
		$style3_title_border_color = uw_option( 'style3_title_border_color' );
		if ( '' != $style3_title_border_color && '#4dbefa' != $style3_title_border_color ) {
			$css .= '.uw_widget_wrap.style3 .uw-title {border-color: '. $style3_title_border_color .';}';
		}

		/**
		   Widget Style 4
		**/
		// Background
		$style4_bg = uw_option( 'style4_bg' );
		if ( '' != $style4_bg && '#fcfcfc' != $style4_bg ) {
			$css .= '.uw_widget_wrap.style4 {background: '. $style4_bg .';}';
		}

		// Border color
		$style4_border_color = uw_option( 'style4_border_color' );
		if ( '' != $style4_border_color && '#e0e0e0' != $style4_border_color ) {
			$css .= '.uw_widget_wrap.style4 {border-color: '. $style4_border_color .';}';
		}

		// Padding
		$style4_padding = uw_option( 'style4_padding' );
		if ( '' != $style4_padding && '20px' != $style4_padding ) {
			$css .= '.uw_widget_wrap.style4 {padding: '. $style4_padding .' !important;}
					.uw_widget_wrap.style4 .uw-title {margin: -'. $style4_padding .';margin-bottom: '. $style4_padding .';}';
		}

		// Margin bottom
		$style4_margin_bottom = uw_option( 'style4_margin_bottom' );
		if ( '' != $style4_margin_bottom && '30px' != $style4_margin_bottom ) {
			$css .= '.uw_widget_wrap.style4, .uw_tabs_widget {margin-bottom: '. $style4_margin_bottom .';}';
		}
		
		// Title background
		$style4_title_bg = uw_option( 'style4_title_bg' );
		if ( '' != $style4_title_bg && '#f8f8f8' != $style4_title_bg ) {
			$css .= '.uw_widget_wrap.style4 .uw-title {background-color: '. $style4_title_bg .';}
					.uw_widget_wrap.style4.uw_testimonials_widget .uw-testimonial-nav {background-color: '. $style4_title_bg .';}';
		}

		// Title color
		$style4_title_color = uw_option( 'style4_title_color' );
		if ( '' != $style4_title_color && '#666' != $style4_title_color ) {
			$css .= '.uw_widget_wrap.style4 .uw-title {color: '. $style4_title_color .';}';
		}

		// Title font size
		$style4_title_font_size = uw_option( 'style4_title_font_size' );
		if ( '' != $style4_title_font_size && '14px' != $style4_title_font_size ) {
			$css .= '.uw_widget_wrap.style4 .uw-title {font-size: '. $style4_title_font_size .';}';
		}

		// Title border color
		$style4_title_border_color = uw_option( 'style4_title_border_color' );
		if ( '' != $style4_title_border_color && '#eaeaea' != $style4_title_border_color ) {
			$css .= '.uw_widget_wrap.style4 .uw-title {border-color: '. $style4_title_border_color .';}';
		}

		// Title border right color
		$style4_title_border_right_color = uw_option( 'style4_title_border_right_color' );
		if ( '' != $style4_title_border_right_color && '#eee' != $style4_title_border_right_color ) {
			$css .= '.uw_widget_wrap.style4 .uw-title span::after {background-color: '. $style4_title_border_right_color .';}';
		}

		/**
		   Widget Style 5
		**/
		// Padding
		$style5_padding = uw_option( 'style5_padding' );
		if ( '' != $style5_padding && '20px' != $style5_padding ) {
			$css .= '.uw_widget_wrap.style5 {padding: 0 0 '. $style5_padding .' 0 !important;}';
		}

		// Border color
		$style5_border_color = uw_option( 'style5_border_color' );
		if ( '' != $style5_border_color && '#222' != $style5_border_color ) {
			$css .= '.uw_widget_wrap.style5 {border-color: '. $style5_border_color .';}';
		}

		// Margin bottom
		$style5_margin_bottom = uw_option( 'style5_margin_bottom' );
		if ( '' != $style5_margin_bottom && '50px' != $style5_margin_bottom ) {
			$css .= '.uw_widget_wrap.style5, .uw_tabs_widget {margin-bottom: '. $style5_margin_bottom .';}';
		}

		// Title background
		$style5_title_bg = uw_option( 'style5_title_bg' );
		if ( '' != $style5_title_bg && '#222' != $style5_title_bg ) {
			$css .= '.uw_widget_wrap.style5 .uw-title span {background-color: '. $style5_title_bg .';}
					.uw_widget_wrap.style5 .uw-title span::before {border-color: transparent '. $style5_title_bg .' transparent transparent;}
					.uw_widget_wrap.style5 .uw-title span::after {border-color: transparent transparent transparent '. $style5_title_bg .';}';
		}

		// Title color
		$style5_title_color = uw_option( 'style5_title_color' );
		if ( '' != $style5_title_color && '#fff' != $style5_title_color ) {
			$css .= '.uw_widget_wrap.style5 .uw-title span {color: '. $style5_title_color .';}';
		}

		// Title font size
		$style5_title_font_size = uw_option( 'style5_title_font_size' );
		if ( '' != $style5_title_font_size && '14px' != $style5_title_font_size ) {
			$css .= '.uw_widget_wrap.style5 .uw-title {font-size: '. $style5_title_font_size .';}';
		}

		// Title border color
		$style5_title_border_color = uw_option( 'style5_title_border_color' );
		if ( '' != $style5_title_border_color && '#222' != $style5_title_border_color ) {
			$css .= '.uw_widget_wrap.style5 .uw-title {border-color: '. $style5_title_border_color .';}';
		}

		/**
		   Widget Style 6
		**/
		// Margin bottom
		$style6_margin_bottom = uw_option( 'style6_margin_bottom' );
		if ( '' != $style6_margin_bottom && '50px' != $style6_margin_bottom ) {
			$css .= '.uw_widget_wrap.style6, .uw_tabs_widget {margin-bottom: '. $style6_margin_bottom .';}';
		}

		// Title color
		$style6_title_color = uw_option( 'style6_title_color' );
		if ( '' != $style6_title_color && '#333' != $style6_title_color ) {
			$css .= '.uw_widget_wrap.style6 .uw-title {color: '. $style6_title_color .';}';
		}

		// Title font size
		$style6_title_font_size = uw_option( 'style6_title_font_size' );
		if ( '' != $style6_title_font_size && '16px' != $style6_title_font_size ) {
			$css .= '.uw_widget_wrap.style6 .uw-title {font-size: '. $style6_title_font_size .';}';
		}

		// Title margin bottom
		$style6_title_margin_bottom = uw_option( 'style6_title_margin_bottom' );
		if ( '' != $style6_title_margin_bottom && '30px' != $style6_title_margin_bottom ) {
			$css .= '.uw_widget_wrap.style6 .uw-title {margin: 0 0 '. $style6_title_margin_bottom .' 0;}';
		}

		// Title primary border color
		$style6_title_primary_border_color = uw_option( 'style6_title_primary_border_color' );
		if ( '' != $style6_title_primary_border_color && '#00AFF0' != $style6_title_primary_border_color ) {
			$css .= '.uw_widget_wrap.style6 .uw-title:after {background: '. $style6_title_primary_border_color .';}';
		}

		// Title secondary border color
		$style6_title_secondary_border_color = uw_option( 'style6_title_secondary_border_color' );
		if ( '' != $style6_title_secondary_border_color && '#e2e2e2' != $style6_title_secondary_border_color ) {
			$css .= '.uw_widget_wrap.style6 .uw-title {border-color: '. $style6_title_secondary_border_color .';}';
		}

		/**
		   Widget Style 7
		**/
		// Border color
		$style7_border_color = uw_option( 'style7_border_color' );
		if ( '' != $style7_border_color && '#e0e0e0' != $style7_border_color ) {
			$css .= '.uw_widget_wrap.style7 {border-color: '. $style7_border_color .';}';
		}

		// Padding
		$style7_padding = uw_option( 'style7_padding' );
		if ( '' != $style7_padding && '25px' != $style7_padding ) {
			$css .= '.uw_widget_wrap.style7 {padding: '. $style7_padding .' !important;}';
		}

		// Margin bottom
		$style7_margin_bottom = uw_option( 'style7_margin_bottom' );
		if ( '' != $style7_margin_bottom && '25px' != $style7_margin_bottom ) {
			$css .= '.uw_widget_wrap.style7, .uw_tabs_widget {margin-bottom: '. $style7_margin_bottom .';}';
		}

		// Title color
		$style7_title_color = uw_option( 'style7_title_color' );
		if ( '' != $style7_title_color && '#333' != $style7_title_color ) {
			$css .= '.uw_widget_wrap.style7 .uw-title {color: '. $style7_title_color .';}';
		}

		// Title font size
		$style7_title_font_size = uw_option( 'style7_title_font_size' );
		if ( '' != $style7_title_font_size && '18px' != $style7_title_font_size ) {
			$css .= '.uw_widget_wrap.style7 .uw-title {font-size: '. $style7_title_font_size .';}';
		}

		// Title margin bottom
		$style7_title_margin_bottom = uw_option( 'style7_title_margin_bottom' );
		if ( '' != $style7_title_margin_bottom && '20px' != $style7_title_margin_bottom ) {
			$css .= '.uw_widget_wrap.style7 .uw-title {margin: 0 0 '. $style7_title_margin_bottom .' 0;}';
		}

		/**
		   Links Color
		**/
		$links_color = uw_option( 'uw_custom_links_color' );
		if ( '' != $links_color && '#333' != $links_color ) {
			$css .= 'body .uw_widget_wrap a {color: '. $links_color .';}';
		}

		// Links hover Color
		$links_hover_color = uw_option( 'uw_custom_links_hover_color' );
		if ( '' != $links_hover_color && '#4dbefa' != $links_hover_color ) {
			$css .= 'body .uw_widget_wrap a:hover {color: '. $links_hover_color .';}';
		}

		/**
		   Inputs Styles
		**/
		// Input background
		$input_bg = uw_option( 'input_bg' );
		$input_bg_regular = $input_bg['regular'];
		if ( '' != $input_bg_regular && '#fff' != $input_bg_regular ) {
			$css .= '.uw_widget_wrap input[type="text"], .uw_widget_wrap input[type="password"], .uw_widget_wrap input[type="email"], .uw_widget_wrap input[type="search"] {background-color: '. $input_bg_regular .';}';
		}
		$input_bg_hover = $input_bg['hover'];
		if ( '' != $input_bg_hover && '#fff' != $input_bg_hover ) {
			$css .= '.uw_widget_wrap input[type="text"]:hover, .uw_widget_wrap input[type="password"]:hover, .uw_widget_wrap input[type="email"]:hover, .uw_widget_wrap input[type="search"]:hover {background-color: '. $input_bg_hover .';}';
		}
		$input_bg_active = $input_bg['active'];
		if ( '' != $input_bg_active && '#fff' != $input_bg_active ) {
			$css .= '.uw_widget_wrap input[type="text"]:focus, .uw_widget_wrap input[type="password"]:focus, .uw_widget_wrap input[type="email"]:focus, .uw_widget_wrap input[type="search"]:focus {background-color: '. $input_bg_active .';}';
		}

		// Input color
		$input_color = uw_option( 'input_color' );
		if ( '' != $input_color && '#888' != $input_color ) {
			$css .= '.uw_widget_wrap input[type="text"], .uw_widget_wrap input[type="password"], .uw_widget_wrap input[type="email"], .uw_widget_wrap input[type="search"] {color: '. $input_color .';}';
		}

		// Input border color
		$input_border = uw_option( 'input_border' );
		$input_border_regular = $input_border['regular'];
		if ( '' != $input_border_regular && '#e0e0e0' != $input_border_regular ) {
			$css .= '.uw_widget_wrap input[type="text"], .uw_widget_wrap input[type="password"], .uw_widget_wrap input[type="email"], .uw_widget_wrap input[type="search"], .uw_login_widget .input-append .show-pass {border-color: '. $input_border_regular .';}';
		}
		$input_border_hover = $input_border['hover'];
		if ( '' != $input_border_hover && '#c1c1c1' != $input_border_hover ) {
			$css .= '.uw_widget_wrap input[type="text"]:hover, .uw_widget_wrap input[type="password"]:hover, .uw_widget_wrap input[type="email"]:hover, .uw_widget_wrap input[type="search"]:hover {border-color: '. $input_border_hover .';}';
		}
		$input_border_active = $input_border['active'];
		if ( '' != $input_border_active && '#4dbefa' != $input_border_active ) {
			$css .= '.uw_widget_wrap input[type="text"]:focus, .uw_widget_wrap input[type="password"]:focus, .uw_widget_wrap input[type="email"]:focus, .uw_widget_wrap input[type="search"]:focus {border-color: '. $input_border_active .';}';
		}

		/**
		   Buttons Styles
		**/
		// Input submit background
		$input_submit_bg = uw_option( 'input_submit_bg' );
		$input_submit_bg_regular = $input_submit_bg['regular'];
		if ( '' != $input_submit_bg_regular && '#4dbefa' != $input_submit_bg_regular ) {
			$css .= '.uw_widget_wrap input[type="submit"] {background-color: '. $input_submit_bg_regular .';}';
		}
		$input_submit_bg_hover = $input_submit_bg['hover'];
		if ( '' != $input_submit_bg_hover ) {
			$css .= '.uw_widget_wrap input[type="submit"]:hover {background-color: '. $input_submit_bg_hover .';}';
		}
		$input_submit_bg_active = $input_submit_bg['active'];
		if ( '' != $input_submit_bg_active && '#4dbefa' != $input_submit_bg_active ) {
			$css .= '.uw_widget_wrap input[type="submit"]:active {background-color: '. $input_submit_bg_active .';}';
		}

		// Input submit color
		$input_submit_color = uw_option( 'input_submit_color' );
		$input_submit_color_regular = $input_submit_color['regular'];
		if ( '' != $input_submit_color_regular && '#fff' != $input_submit_color_regular ) {
			$css .= '.uw_widget_wrap input[type="submit"] {color: '. $input_submit_color_regular .';}';
		}
		$input_submit_color_hover = $input_submit_color['hover'];
		if ( '' != $input_submit_color_hover && '#4dbefa' != $input_submit_color_hover ) {
			$css .= '.uw_widget_wrap input[type="submit"]:hover {color: '. $input_submit_color_hover .';}';
		}
		$input_submit_color_active = $input_submit_color['active'];
		if ( '' != $input_submit_color_active && '#4dbefa' != $input_submit_color_active ) {
			$css .= '.uw_widget_wrap input[type="submit"]:active {color: '. $input_submit_color_active .';}';
		}

		// Input submit border color
		$input_submit_border = uw_option( 'input_submit_border' );
		$input_submit_border_regular = $input_submit_border['regular'];
		if ( '' != $input_submit_border_regular && '#4dbefa' != $input_submit_border_regular ) {
			$css .= '.uw_widget_wrap input[type="submit"] {border-color: '. $input_submit_border_regular .';}';
		}
		$input_submit_border_hover = $input_submit_border['hover'];
		if ( '' != $input_submit_border_hover && '#4dbefa' != $input_submit_border_hover ) {
			$css .= '.uw_widget_wrap input[type="submit"]:hover {border-color: '. $input_submit_border_hover .';}';
		}
		$input_submit_border_active = $input_submit_border['active'];
		if ( '' != $input_submit_border_active && '#4dbefa' != $input_submit_border_active ) {
			$css .= '.uw_widget_wrap input[type="submit"]:active {border-color: '. $input_submit_border_active .';}';
		}

		/**
		   Checkbox Styles
		**/
		// Checkbox background
		$checkbox_bg = uw_option( 'checkbox_bg' );
		if ( '' != $checkbox_bg && '#fff' != $checkbox_bg ) {
			$css .= '.uw_widget_wrap input[type=checkbox] {background: '. $checkbox_bg .';}';
		}

		// Checkbox border color
		$checkbox_border = uw_option( 'checkbox_border' );
		if ( '' != $checkbox_border && '#bbb' != $checkbox_border ) {
			$css .= '.uw_widget_wrap input[type=checkbox] {border-color: '. $checkbox_border .';}';
		}

		// Checkbox checked color
		$checkbox_checked_color = uw_option( 'checkbox_checked_color' );
		if ( '' != $checkbox_checked_color && '#4dbefa' != $checkbox_checked_color ) {
			$css .= '.uw_widget_wrap input[type=checkbox]:checked:before {color: '. $checkbox_checked_color .';}';
		}

		/**
		   Nav Slideshow Widget
		**/
		// Nav slideshow background
		$nav_slideshow_bg = uw_option( 'nav_slideshow_bg' );
		$nav_slideshow_bg_regular = $nav_slideshow_bg['regular'];
		if ( '' != $nav_slideshow_bg_regular && '#aaa' != $nav_slideshow_bg_regular ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav {background-color: '. $nav_slideshow_bg_regular .';}';
		}
		$nav_slideshow_bg_hover = $nav_slideshow_bg['hover'];
		if ( '' != $nav_slideshow_bg_hover && '#4dbefa' != $nav_slideshow_bg_hover ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav:hover {background-color: '. $nav_slideshow_bg_hover .';}';
		}
		$nav_slideshow_bg_active = $nav_slideshow_bg['active'];
		if ( '' != $nav_slideshow_bg_active ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav:active {background-color: '. $nav_slideshow_bg_active .';}';
		}

		// Nav slideshow color
		$nav_slideshow_color = uw_option( 'nav_slideshow_color' );
		$nav_slideshow_color_regular = $nav_slideshow_color['regular'];
		if ( '' != $nav_slideshow_color_regular && '#aaa' != $nav_slideshow_color_regular ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav {color: '. $nav_slideshow_color_regular .';}';
		}
		$nav_slideshow_color_hover = $nav_slideshow_color['hover'];
		if ( '' != $nav_slideshow_color_hover && '#4dbefa' != $nav_slideshow_color_hover ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav:hover {color: '. $nav_slideshow_color_hover .';}';
		}
		$nav_slideshow_color_active = $nav_slideshow_color['active'];
		if ( '' != $nav_slideshow_color_active ) {
			$css .= '.uw_slideshow_widget .uw-slideshow-nav:active {color: '. $nav_slideshow_color_active .';}';
		}
		
		/**
		   Calendar Widget
		**/
		// Month color
		$calendar_caption_color = uw_option( 'calendar_caption_color' );
		if ( '' != $calendar_caption_color && '#222' != $calendar_caption_color ) {
			$css .= '.uw_calendar_widget #wp-calendar caption {color: '. $calendar_caption_color .';}';
		}

		// Weeks color
		$calendar_th_color = uw_option( 'calendar_th_color' );
		if ( '' != $calendar_th_color ) {
			$css .= '.uw_calendar_widget #wp-calendar th {color: '. $calendar_th_color .';}';
		}

		// Days color
		$calendar_td_color = uw_option( 'calendar_td_color' );
		if ( '' != $calendar_td_color && '#888' != $calendar_td_color ) {
			$css .= '.uw_calendar_widget #wp-calendar tbody td {color: '. $calendar_td_color .';}';
		}

		// Today color
		$calendar_today_color = uw_option( 'calendar_today_color' );
		if ( '' != $calendar_today_color && '#111' != $calendar_today_color ) {
			$css .= '.uw_calendar_widget #wp-calendar tbody #today {color: '. $calendar_today_color .';}';
		}

		// Style 1 - month border bottom color
		$calendar_style1_caption_border_color = uw_option( 'calendar_style1_caption_border_color' );
		if ( '' != $calendar_style1_caption_border_color && '#e0e0e0' != $calendar_style1_caption_border_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style1 #wp-calendar caption {border-color: '. $calendar_style1_caption_border_color .';}';
		}

		// Style 1 - weeks border bottom color
		$calendar_style1_th_border_color = uw_option( 'calendar_style1_th_border_color' );
		if ( '' != $calendar_style1_th_border_color && '#e0e0e0' != $calendar_style1_th_border_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style1 #wp-calendar th {border-color: '. $calendar_style1_th_border_color .';}';
		}

		// Style 1 - border bottom color
		$calendar_style1_tbody_border_color = uw_option( 'calendar_style1_tbody_border_color' );
		if ( '' != $calendar_style1_tbody_border_color && '#e0e0e0' != $calendar_style1_tbody_border_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style1 #wp-calendar tbody {border-color: '. $calendar_style1_tbody_border_color .';}';
		}

		// Style 2 - weeks background color
		$calendar_style2_th_bg = uw_option( 'calendar_style2_th_bg' );
		if ( '' != $calendar_style2_th_bg && '#333' != $calendar_style2_th_bg ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar th {background-color: '. $calendar_style2_th_bg .';}';
		}

		// Style 2 - weeks color
		$calendar_style2_th_color = uw_option( 'calendar_style2_th_color' );
		if ( '' != $calendar_style2_th_color && '#fff' != $calendar_style2_th_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar th {color: '. $calendar_style2_th_color .';}';
		}

		// Style 2 - weeks border color
		$calendar_style2_th_border_color = uw_option( 'calendar_style2_th_border_color' );
		if ( '' != $calendar_style2_th_border_color && '#e0e0e0' != $calendar_style2_th_border_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar th {border-color: '. $calendar_style2_th_border_color .';}';
		}

		// Style 2 - days background color
		$calendar_style2_td_bg = uw_option( 'calendar_style2_td_bg' );
		$calendar_style2_td_bg_regular = $calendar_style2_td_bg['regular'];
		if ( '' != $calendar_style2_td_bg_regular && '#f6f6f6' != $calendar_style2_td_bg_regular ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar tbody td {background-color: '. $calendar_style2_td_bg_regular .';}';
		}
		$calendar_style2_td_bg_hover = $calendar_style2_td_bg['hover'];
		if ( '' != $calendar_style2_td_bg_hover && '#fff' != $calendar_style2_td_bg_hover ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar tbody td:hover {background-color: '. $calendar_style2_td_bg_hover .';}';
		}
		$calendar_style2_td_bg_active = $calendar_style2_td_bg['active'];
		if ( '' != $calendar_style2_td_bg_active ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar tbody td:active {background-color: '. $calendar_style2_td_bg_active .';}';
		}

		// Style 2 - days color
		$calendar_style2_td_color = uw_option( 'calendar_style2_td_color' );
		if ( '' != $calendar_style2_td_color && '#999' != $calendar_style2_td_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar tbody td {color: '. $calendar_style2_td_color .';}';
		}

		// Style 2 - days border color
		$calendar_style2_td_border_color = uw_option( 'calendar_style2_td_border_color' );
		if ( '' != $calendar_style2_td_border_color && '#e0e0e0' != $calendar_style2_td_border_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style2 #wp-calendar tbody td {border-color: '. $calendar_style2_td_border_color .';}';
		}

		// Style 3 - weeks background color
		$calendar_style3_th_bg = uw_option( 'calendar_style3_th_bg' );
		if ( '' != $calendar_style3_th_bg && '#333' != $calendar_style3_th_bg ) {
			$css .= '.uw_calendar_widget .uw-calendar-style3 #wp-calendar th {background-color: '. $calendar_style3_th_bg .';}';
		}

		// Style 3 - weeks color
		$calendar_style3_th_color = uw_option( 'calendar_style3_th_color' );
		if ( '' != $calendar_style3_th_color && '#fff' != $calendar_style3_th_color ) {
			$css .= '.uw_calendar_widget .uw-calendar-style3 #wp-calendar th {color: '. $calendar_style3_th_color .';}';
		}

		/**
		   Contact Info Widget
		**/
		// Default style icons color
		$default_style_icons_color = uw_option( 'default_style_icons_color' );
		if ( '' != $default_style_icons_color && '#01aef0' != $default_style_icons_color ) {
			$css .= '.uw_contact_info_widget .default i {color: '. $default_style_icons_color .';}';
		}

		// Default style icons border color
		$default_style_icons_border_color = uw_option( 'default_style_icons_border_color' );
		if ( '' != $default_style_icons_border_color && '#e2e2e2' != $default_style_icons_border_color ) {
			$css .= '.uw_contact_info_widget .default i {border-color: '. $default_style_icons_border_color .';}';
		}

		// Default style titles color
		$default_style_titles_color = uw_option( 'default_style_titles_color' );
		if ( '' != $default_style_titles_color && '#777' != $default_style_titles_color ) {
			$css .= '.uw_contact_info_widget .default span.uw-contact-title {color: '. $default_style_titles_color .';}';
		}

		// Big icons style icons background
		$big_icons_style_icons_bg = uw_option( 'big_icons_style_icons_bg' );
		$big_icons_style_icons_bg_regular = $big_icons_style_icons_bg['regular'];
		if ( '' != $big_icons_style_icons_bg_regular ) {
			$css .= '.uw_contact_info_widget .big-icons i {background-color: '. $big_icons_style_icons_bg_regular .';}';
		}
		$big_icons_style_icons_bg_hover = $big_icons_style_icons_bg['hover'];
		if ( '' != $big_icons_style_icons_bg_hover && '#01aef0' != $big_icons_style_icons_bg_hover ) {
			$css .= '.uw_contact_info_widget .big-icons li:hover i {background-color: '. $big_icons_style_icons_bg_hover .';}';
		}
		$big_icons_style_icons_bg_active = $big_icons_style_icons_bg['active'];
		if ( '' != $big_icons_style_icons_bg_active ) {
			$css .= '.uw_contact_info_widget .big-icons li:active i {background-color: '. $big_icons_style_icons_bg_active .';}';
		}

		// Big icons style icons color
		$big_icons_style_icons_color = uw_option( 'big_icons_style_icons_color' );
		$big_icons_style_icons_color_regular = $big_icons_style_icons_color['regular'];
		if ( '' != $big_icons_style_icons_color_regular && '#01aef0' != $big_icons_style_icons_color_regular ) {
			$css .= '.uw_contact_info_widget .big-icons i {color: '. $big_icons_style_icons_color_regular .';}';
		}
		$big_icons_style_icons_color_hover = $big_icons_style_icons_color['hover'];
		if ( '' != $big_icons_style_icons_color_hover && '#fff' != $big_icons_style_icons_color_hover ) {
			$css .= '.uw_contact_info_widget .big-icons li:hover i {color: '. $big_icons_style_icons_color_hover .';}';
		}
		$big_icons_style_icons_color_active = $big_icons_style_icons_color['active'];
		if ( '' != $big_icons_style_icons_color_active ) {
			$css .= '.uw_contact_info_widget .big-icons li:active i {color: '. $big_icons_style_icons_color_active .';}';
		}

		// Big icons style icons border color
		$big_icons_style_icons_border_color = uw_option( 'big_icons_style_icons_border_color' );
		$big_icons_style_icons_border_color_regular = $big_icons_style_icons_border_color['regular'];
		if ( '' != $big_icons_style_icons_border_color_regular && '#01aef0' != $big_icons_style_icons_border_color_regular ) {
			$css .= '.uw_contact_info_widget .big-icons i {border-color: '. $big_icons_style_icons_border_color_regular .';}';
		}
		$big_icons_style_icons_border_color_hover = $big_icons_style_icons_border_color['hover'];
		if ( '' != $big_icons_style_icons_border_color_hover && '#01aef0' != $big_icons_style_icons_border_color_hover ) {
			$css .= '.uw_contact_info_widget .big-icons li:hover i {border-color: '. $big_icons_style_icons_border_color_hover .';}';
		}
		$big_icons_style_icons_border_color_active = $big_icons_style_icons_border_color['active'];
		if ( '' != $big_icons_style_icons_border_color_active ) {
			$css .= '.uw_contact_info_widget .big-icons li:active i {border-color: '. $big_icons_style_icons_border_color_active .';}';
		}

		// Big icons style titles color
		$big_icons_style_titles_color = uw_option( 'big_icons_style_titles_color' );
		if ( '' != $big_icons_style_titles_color ) {
			$css .= '.uw_contact_info_widget .big-icons span.uw-contact-title {color: '. $big_icons_style_titles_color .';}';
		}

		// Skype background
		$contact_info_skype_bg = uw_option( 'contact_info_skype_bg' );
		$contact_info_skype_bg_regular = $contact_info_skype_bg['regular'];
		if ( '' != $contact_info_skype_bg_regular && '#00AFF0' != $contact_info_skype_bg_regular ) {
			$css .= '.uw_contact_info_widget li.skype a {background-color: '. $contact_info_skype_bg_regular .';}';
		}
		$contact_info_skype_bg_hover = $contact_info_skype_bg['hover'];
		if ( '' != $contact_info_skype_bg_hover && '#333' != $contact_info_skype_bg_hover ) {
			$css .= '.uw_contact_info_widget li.skype a:hover {background-color: '. $contact_info_skype_bg_hover .';}';
		}
		$contact_info_skype_bg_active = $contact_info_skype_bg['active'];
		if ( '' != $contact_info_skype_bg_active ) {
			$css .= '.uw_contact_info_widget li.skype a:active {background-color: '. $contact_info_skype_bg_active .';}';
		}

		// Skype color
		$contact_info_skype_color = uw_option( 'contact_info_skype_color' );
		$contact_info_skype_color_regular = $contact_info_skype_color['regular'];
		if ( '' != $contact_info_skype_color_regular && '#fff' != $contact_info_skype_color_regular ) {
			$css .= '.uw_contact_info_widget li.skype a {color: '. $contact_info_skype_color_regular .'!important;}';
		}
		$contact_info_skype_color_hover = $contact_info_skype_color['hover'];
		if ( '' != $contact_info_skype_color_hover && '#fff' != $contact_info_skype_color_hover ) {
			$css .= '.uw_contact_info_widget li.skype a:hover {color: '. $contact_info_skype_color_hover .'!important;}';
		}
		$contact_info_skype_color_active = $contact_info_skype_color['active'];
		if ( '' != $contact_info_skype_color_active ) {
			$css .= '.uw_contact_info_widget li.skype a:active {color: '. $contact_info_skype_color_active .'!important;}';
		}

		/**
		   Custom Links Widget
		**/
		// Links color
		$custom_links_widget_color = uw_option( 'custom_links_widget_color' );
		if ( '' != $custom_links_widget_color && '#333' != $custom_links_widget_color ) {
			$css .= 'body .uw_custom_links_widget .uw-custom-links li a {color: '. $custom_links_widget_color .';}';
		}

		// Links color hover
		$custom_links_widget_color_hover = uw_option( 'custom_links_widget_color_hover' );
		if ( '' != $custom_links_widget_color_hover && '#4dbefa' != $custom_links_widget_color_hover ) {
			$css .= 'body .uw_custom_links_widget .uw-custom-links li a:hover {color: '. $custom_links_widget_color_hover .';}';
		}

		// Links border bottom color
		$custom_links_widget_border_color = uw_option( 'custom_links_widget_border_color' );
		if ( '' != $custom_links_widget_border_color && '#e0e0e0' != $custom_links_widget_border_color ) {
			$css .= 'body .uw_custom_links_widget .uw-custom-links li a {border-color: '. $custom_links_widget_border_color .';}';
		}

		// Links border bottom color hover
		$custom_links_widget_border_color_hover = uw_option( 'custom_links_widget_border_color_hover' );
		if ( '' != $custom_links_widget_border_color_hover && '#4dbefa' != $custom_links_widget_border_color_hover ) {
			$css .= 'body .uw_custom_links_widget .uw-custom-links li a:hover {border-color: '. $custom_links_widget_border_color_hover .';}';
		}

		/**
		   Login Widget
		**/
		// Label color
		$label_color = uw_option( 'label_color' );
		if ( '' != $label_color && '#484848' != $label_color ) {
			$css .= '.uw_widget_wrap .uw-form-wrap .label {color: '. $label_color .';}';
		}

		// Show pass background
		$show_pass_bg = uw_option( 'show_pass_bg' );
		if ( '' != $show_pass_bg && '#f5f5f5' != $show_pass_bg ) {
			$css .= '.uw_login_widget .input-append .show-pass {background: '. $show_pass_bg .';}';
		}

		// Show pass color
		$show_pass_color = uw_option( 'show_pass_color' );
		if ( '' != $show_pass_color && '#484848' != $show_pass_color ) {
			$css .= '.uw_login_widget .input-append .show-pass label {color: '. $show_pass_color .';}';
		}

		// Remeber me color
		$rememberme_color = uw_option( 'rememberme_color' );
		if ( '' != $rememberme_color && '#484848' != $rememberme_color ) {
			$css .= '.uw_login_widget .rememberme label {color: '. $rememberme_color .';}';
		}

		// Remeber me checked color
		$rememberme_checked_color = uw_option( 'rememberme_checked_color' );
		if ( '' != $rememberme_checked_color && '#4dbefa' != $rememberme_checked_color ) {
			$css .= '.uw_login_widget .rememberme input[type="checkbox"]:checked + label {color: '. $rememberme_checked_color .';}';
		}

		// Avatar outside border
		$avatar_outside_border = uw_option( 'avatar_outside_border' );
		if ( '' != $avatar_outside_border && '#e0e0e0' != $avatar_outside_border ) {
			$css .= '.uw_login_widget .uw-user-avatar {border-color: '. $avatar_outside_border .';}';
		}

		// Avatar inside border
		$avatar_inside_border = uw_option( 'avatar_inside_border' );
		if ( '' != $avatar_inside_border && '#eee' != $avatar_inside_border ) {
			$css .= '.uw_login_widget .uw-user-avatar img {border-color: '. $avatar_inside_border .';}';
		}

		// Box shadow avatar sonar
		$avatar_sonar = uw_option( 'avatar_sonar' );
		if ( '' != $avatar_sonar && '#ABE2FF' != $avatar_sonar && 'transparent' != $avatar_sonar ) {
			$css .= '@-webkit-keyframes avatarSonar {0% {opacity: 0.3;}40% {opacity: 0.5;box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);}100% {box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);-webkit-transform: scale(1.5);opacity: 0;}}@-moz-keyframes avatarSonar {0% {opacity: 0.3;}40% {opacity: 0.5;box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);}100% {box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);-moz-transform: scale(1.5);opacity: 0;}}@keyframes avatarSonar {0% {opacity: 0.3;}40% {opacity: 0.5;box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);}100% {box-shadow: 0 0 0 2px rgba(255,255,255,0.1), 0 0 10px 10px '. $avatar_sonar .', 0 0 0 10px rgba(255,255,255,0.5);transform: scale(1.5);opacity: 0;}}';
		} else if ( 'transparent' == $avatar_sonar ) {
			$css .= '.uw_login_widget .uw-user-avatar::after {display: none;}';
		}

		// Username color
		$username_color = uw_option( 'username_color' );
		$username_color_regular = $username_color['regular'];
		if ( '' != $username_color_regular && '#4dbefa' != $username_color_regular ) {
			$css .= '.uw_login_widget .uw-user-content h2, .uw_login_widget .uw-user-content h2 a {color: '. $username_color_regular .';}';
		}
		$username_color_hover = $username_color['hover'];
		if ( '' != $username_color_hover && '#333' != $username_color_hover ) {
			$css .= '.uw_login_widget .uw-user-content h2 a:hover {color: '. $username_color_hover .';}';
		}
		$username_color_active = $username_color['active'];
		if ( '' != $username_color_active ) {
			$css .= '.uw_login_widget .uw-user-content h2 a:active {color: '. $username_color_active .';}';
		}

		// Menu link border bottom color
		$nav_border_bottom = uw_option( 'nav_border_bottom' );
		if ( '' != $nav_border_bottom && '#e0e0e0' != $nav_border_bottom ) {
			$css .= '.uw_login_widget .uw-user-content ul li {border-color: '. $nav_border_bottom .';}';
		}

		/**
		   Menu Widget
		**/
		// Menu link border bottom color
		$links_border_bottom = uw_option( 'links_border_bottom' );
		if ( '' != $links_border_bottom && '#e0e0e0' != $links_border_bottom ) {
			$css .= '.uw_menu_widget ul li {border-color: '. $links_border_bottom .';}';
		}

		// Sub icon color
		$sub_icon_color = uw_option( 'sub_icon_color' );
		$sub_icon_color_regular = $sub_icon_color['regular'];
		if ( '' != $sub_icon_color_regular && '#aaa' != $sub_icon_color_regular ) {
			$css .= '.uw_menu_widget li .uw-sub-icon {color: '. $sub_icon_color_regular .';}';
		}
		$sub_icon_color_hover = $sub_icon_color['hover'];
		if ( '' != $sub_icon_color_hover && '#4dbefa' != $sub_icon_color_hover ) {
			$css .= '.uw_menu_widget li .uw-sub-icon:hover {color: '. $sub_icon_color_hover .';}';
		}
		$sub_icon_color_active = $sub_icon_color['active'];
		if ( '' != $sub_icon_color_active ) {
			$css .= '.uw_menu_widget li .uw-sub-icon:active {color: '. $sub_icon_color_active .';}';
		}

		/**
		   Posts Slider Widget
		**/
		// Image hover background
		$img_hover_bg = uw_option( 'img_hover_bg' );
		if ( '' != $img_hover_bg && '#000' != $img_hover_bg ) {
			$css .= '.posts-slider .uw-posts-slider-li {background: '. $img_hover_bg .';}';
		}

		// Title/Comments/Nav background
		$posts_elements_bg = uw_option( 'posts_elements_bg' );
		if ( '' != $posts_elements_bg && 'rgba(0,0,0,0.5)' != $posts_elements_bg ) {
			$css .= '.posts-slider .uw-posts-slider-li .uw-posts-slider-desc a, .posts-slider .uw-posts-slider-li .uw-info-wrap, .posts-slider .uw-posts-slider-li .uw-posts-slider-nav li a {background: '. $posts_elements_bg .';}';
		}

		// Title/Nav hover background
		$posts_elements_hover_bg = uw_option( 'posts_elements_hover_bg' );
		if ( '' != $posts_elements_hover_bg && 'rgba(0,0,0,0.8)' != $posts_elements_hover_bg ) {
			$css .= '.posts-slider .uw-posts-slider-li .uw-posts-slider-desc a:hover, .posts-slider .uw-posts-slider-li .uw-posts-slider-nav li a:hover {background: '. $posts_elements_hover_bg .';}';
		}

		// Title/Comments/Nav color
		$posts_elements_color = uw_option( 'posts_elements_color' );
		$posts_elements_color_regular = $posts_elements_color['regular'];
		if ( '' != $posts_elements_color_regular && '#aaa' != $posts_elements_color_regular ) {
			$css .= '.posts-slider .uw-posts-slider-li .uw-posts-slider-desc a, .posts-slider .uw-posts-slider-li .uw-info-wrap, .posts-slider .uw-posts-slider-li .uw-info-wrap a, .posts-slider .uw-posts-slider-li .uw-posts-slider-nav li a {color: '. $posts_elements_color_regular .' !important;}';
		}
		$posts_elements_color_hover = $posts_elements_color['hover'];
		if ( '' != $posts_elements_color_hover && '#4dbefa' != $posts_elements_color_hover ) {
			$css .= '.posts-slider .uw-posts-slider-li .uw-posts-slider-desc a:hover, .posts-slider .uw-posts-slider-li .uw-info-wrap a:hover, .posts-slider .uw-posts-slider-li .uw-posts-slider-nav li a:hover {color: '. $posts_elements_color_hover .' !important;}';
		}
		$posts_elements_color_active = $posts_elements_color['active'];
		if ( '' != $posts_elements_color_active ) {
			$css .= '.posts-slider .uw-posts-slider-li .uw-posts-slider-desc a:active, .posts-slider .uw-posts-slider-li .uw-info-wrap a:active, .posts-slider .uw-posts-slider-li .uw-posts-slider-nav li a:active {color: '. $posts_elements_color_active .' !important;}';
		}

		/**
		   Tabs Widget
		**/
		// Tabs border color
		$tabs_border = uw_option( 'tabs_border' );
		if ( '' != $tabs_border && '#e0e0e0' != $tabs_border ) {
			$css .= '.uw_tabs_widget, .uw_tabs_widget .uw-top, .uw_tabs_widget ul.uw-posts-tabs li {border-color: '. $tabs_border .';}';
		}

		// Tabs top background
		$tabs_top_bg = uw_option( 'tabs_top_bg' );
		$tabs_top_bg_regular = $tabs_top_bg['regular'];
		if ( '' != $tabs_top_bg_regular && '#f8f8f8' != $tabs_top_bg_regular ) {
			$css .= '.uw_tabs_widget .uw-top {background: '. $tabs_top_bg_regular .';}';
		}
		$tabs_top_bg_hover = $tabs_top_bg['hover'];
		if ( '' != $tabs_top_bg_hover && '#fff' != $tabs_top_bg_hover ) {
			$css .= '.uw_tabs_widget ul.uw-posts-tabs li a:hover {background: '. $tabs_top_bg_hover .';}';
		}
		$tabs_top_bg_active = $tabs_top_bg['active'];
		if ( '' != $tabs_top_bg_active ) {
			$css .= '.uw_tabs_widget ul.uw-posts-tabs li.uw-active a {background: '. $tabs_top_bg_active .';}';
		}

		// Tabs top color
		$tabs_top_color = uw_option( 'tabs_top_color' );
		$tabs_top_color_regular = $tabs_top_color['regular'];
		if ( '' != $tabs_top_color_regular && '#555' != $tabs_top_color_regular ) {
			$css .= '.uw_tabs_widget ul.uw-posts-tabs li a {color: '. $tabs_top_color_regular .';}';
		}
		$tabs_top_color_hover = $tabs_top_color['hover'];
		if ( '' != $tabs_top_color_hover && '#000' != $tabs_top_color_hover ) {
			$css .= '.uw_tabs_widget ul.uw-posts-tabs li a:hover {color: '. $tabs_top_color_hover .';}';
		}
		$tabs_top_color_active = $tabs_top_color['active'];
		if ( '' != $tabs_top_color_active ) {
			$css .= '.uw_tabs_widget ul.uw-posts-tabs li.uw-active a {color: '. $tabs_top_color_active .';}';
		}

		// Tabs recent date color
		$tab_recent_date_color = uw_option( 'tab_recent_date_color' );
		if ( '' != $tab_recent_date_color && '#aaa' != $tab_recent_date_color ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap li .uw-date {color: '. $tab_recent_date_color .';}';
		}

		// Tabs recent/comments border color
		$tabs_recent_comments_border_color = uw_option( 'tabs_recent_comments_border_color' );
		if ( '' != $tabs_recent_comments_border_color && '#f2f2f2' != $tabs_recent_comments_border_color ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap li {border-color: '. $tabs_recent_comments_border_color .';}';
		}

		// Tabs tags background
		$tab_tags_bg = uw_option( 'tab_tags_bg' );
		$tab_tags_bg_regular = $tab_tags_bg['regular'];
		if ( '' != $tab_tags_bg_regular && '#f5f5f5' != $tab_tags_bg_regular ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a {background: '. $tab_tags_bg_regular .';}';
		}
		$tab_tags_bg_hover = $tab_tags_bg['hover'];
		if ( '' != $tab_tags_bg_hover && '#e7f1ff' != $tab_tags_bg_hover ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a:hover {background: '. $tab_tags_bg_hover .';}';
		}
		$tab_tags_bg_active = $tab_tags_bg['active'];
		if ( '' != $tab_tags_bg_active ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a:active {background: '. $tab_tags_bg_active .';}';
		}

		// Tabs tags color
		$tab_tags_color = uw_option( 'tab_tags_color' );
		$tab_tags_color_regular = $tab_tags_color['regular'];
		if ( '' != $tab_tags_color_regular && '#333' != $tab_tags_color_regular ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a {color: '. $tab_tags_color_regular .';}';
		}
		$tab_tags_color_hover = $tab_tags_color['hover'];
		if ( '' != $tab_tags_color_hover && '#2676ef' != $tab_tags_color_hover ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a:hover {color: '. $tab_tags_color_hover .';}';
		}
		$tab_tags_color_active = $tab_tags_color['active'];
		if ( '' != $tab_tags_color_active ) {
			$css .= '.uw_tabs_widget .uw-tabs-wrap.uw-tagcloud a:active {color: '. $tab_tags_color_active .';}';
		}

		/**
		   Testimonials Widget
		**/
		// Nav background
		$testimonials_nav_bg = uw_option( 'testimonials_nav_bg' );
		$testimonials_nav_bg_regular = $testimonials_nav_bg['regular'];
		if ( '' != $testimonials_nav_bg_regular && 'transparent' != $testimonials_nav_bg_regular ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav {background-color: '. $testimonials_nav_bg_regular .';}';
		}
		$testimonials_nav_bg_hover = $testimonials_nav_bg['hover'];
		if ( '' != $testimonials_nav_bg_hover && '#e7f1ff' != $testimonials_nav_bg_hover ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:hover, .uw_widget_wrap.style4.uw_testimonials_widget .uw-testimonial-nav:hover {background-color: '. $testimonials_nav_bg_hover .';}';
		}
		$testimonials_nav_bg_active = $testimonials_nav_bg['active'];
		if ( '' != $testimonials_nav_bg_active ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:active {background-color: '. $testimonials_nav_bg_active .';}';
		}

		// Nav color
		$testimonials_nav_color = uw_option( 'testimonials_nav_color' );
		$testimonials_nav_color_regular = $testimonials_nav_color['regular'];
		if ( '' != $testimonials_nav_color_regular && '#777' != $testimonials_nav_color_regular ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav {color: '. $testimonials_nav_color_regular .';}';
		}
		$testimonials_nav_color_hover = $testimonials_nav_color['hover'];
		if ( '' != $testimonials_nav_color_hover && '#2676ef' != $testimonials_nav_color_hover ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:hover, .uw_widget_wrap.style4.uw_testimonials_widget .uw-testimonial-nav:hover {color: '. $testimonials_nav_color_hover .';}';
		}
		$testimonials_nav_color_active = $testimonials_nav_color['active'];
		if ( '' != $testimonials_nav_color_active ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:active {color: '. $testimonials_nav_color_active .';}';
		}

		// Nav border color
		$testimonials_nav_border_color = uw_option( 'testimonials_nav_border_color' );
		$testimonials_nav_border_color_regular = $testimonials_nav_border_color['regular'];
		if ( '' != $testimonials_nav_border_color_regular && '#777' != $testimonials_nav_border_color_regular ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav {border-color: '. $testimonials_nav_border_color_regular .';}';
		}
		$testimonials_nav_border_color_hover = $testimonials_nav_border_color['hover'];
		if ( '' != $testimonials_nav_border_color_hover && '#2676ef' != $testimonials_nav_border_color_hover ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:hover, .uw_widget_wrap.style4.uw_testimonials_widget .uw-testimonial-nav:hover {border-color: '. $testimonials_nav_border_color_hover .';}';
		}
		$testimonials_nav_border_color_active = $testimonials_nav_border_color['active'];
		if ( '' != $testimonials_nav_border_color_active ) {
			$css .= '.uw_testimonials_widget .uw-testimonial-nav:active {border-color: '. $testimonials_nav_border_color_active .';}';
		}

		// Quote background
		$testimonials_quote_bg = uw_option( 'testimonials_quote_bg' );
		if ( '' != $testimonials_quote_bg && '#efefef' != $testimonials_quote_bg ) {
			$css .= '.uw-testimonial-entry-content {background: '. $testimonials_quote_bg .';}
					.uw-testimonial-caret {border-top-color: '. $testimonials_quote_bg .';}';
		}

		// Quote color
		$testimonials_quote_color = uw_option( 'testimonials_quote_color' );
		if ( '' != $testimonials_quote_color && '#888' != $testimonials_quote_color ) {
			$css .= '.uw-testimonial-entry-content {color: '. $testimonials_quote_color .';}';
		}

		// Avatar background
		$testimonials_avatar_bg = uw_option( 'testimonials_avatar_bg' );
		if ( '' != $testimonials_avatar_bg && '#fff' != $testimonials_avatar_bg ) {
			$css .= '.uw-testimonial-entry-thumb img {background: '. $testimonials_avatar_bg .';}';
		}

		// Avatar border color
		$testimonials_avatar_border_color = uw_option( 'testimonials_avatar_border_color' );
		if ( '' != $testimonials_avatar_border_color && '#ddd' != $testimonials_avatar_border_color ) {
			$css .= '.uw-testimonial-entry-thumb img {border-color: '. $testimonials_avatar_border_color .';}';
		}

		// Name color
		$testimonials_name_color = uw_option( 'testimonials_name_color' );
		if ( '' != $testimonials_name_color && '#000' != $testimonials_name_color ) {
			$css .= '.uw-testimonial-entry-author {color: '. $testimonials_name_color .';}';
		}
		
		/**
		   Twitter Widget
		**/
		// Tweets color
		$tweets_color = uw_option( 'tweets_color' );
		if ( '' != $tweets_color && '#838383' != $tweets_color ) {
			$css .= '#uw_jtwt .uw_jtwt_tweet {color: '. $tweets_color .';}';
		}

		// Tweets border color
		$tweets_border_color = uw_option( 'tweets_border_color' );
		if ( '' != $tweets_border_color && '#eee' != $tweets_border_color ) {
			$css .= '#uw_jtwt .uw_jtwt_tweet {border-color: '. $tweets_border_color .';}';
		}

		// Tweets icons color
		$tweets_icon_color = uw_option( 'tweets_icon_color' );
		if ( '' != $tweets_icon_color && '#33ccff' != $tweets_icon_color ) {
			$css .= '#uw_jtwt .uw_jtwt_tweet:before {color: '. $tweets_icon_color .';}
					#uw_jtwt .uw_jtwt_tweet:before {text-shadow: 1px -1px rgba(0,0,0,0.5), 1px 1px rgba(255,255,255,0.5);}';
		}

		/**
		   Weather Widget
		**/
		// Weather temp color
		$weather_temp_color = uw_option( 'weather_temp_color' );
		if ( '' != $weather_temp_color && '#4dbefa' != $weather_temp_color ) {
			$css .= '.uw_weather_widget .uw-weather-current-temp {color: '. $weather_temp_color .';}';
		}

		// Weather name color
		$weather_name_color = uw_option( 'weather_name_color' );
		if ( '' != $weather_name_color && '#333' != $weather_name_color ) {
			$css .= '.uw_weather_widget .uw_weather_name, .uw_weather_widget .uw_weather_desc, .uw_weather_widget .uw-weather-forecast-day-temp {color: '. $weather_name_color .';}';
		}

		// Weather stats/days color
		$weather_stats_days_color = uw_option( 'weather_stats_days_color' );
		if ( '' != $weather_stats_days_color && '#888' != $weather_stats_days_color ) {
			$css .= '.uw_weather_widget .uw-weather-todays-stats, .uw_weather_widget .uw-weather-forecast-day-abbr {color: '. $weather_stats_days_color .';}';
		}

		// Weather border top color
		$weather_forecast_border_color = uw_option( 'weather_forecast_border_color' );
		if ( '' != $weather_forecast_border_color && '#e0e0e0' != $weather_forecast_border_color ) {
			$css .= '.uw_weather_widget .uw-weather-forecast {border-color: '. $weather_forecast_border_color .';}';
		}

		/**
		   Output css on front end
		**/
		if ( '' != $css ) {
			$css =  preg_replace( '/\s+/', ' ', $css );
			$css = ''. $css .'';
			return $css;
		} else {
			return '';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Custom CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_custom_css' ) ) {
	function uw_custom_css() {
		$css = uw_option( 'custom_css' );
		if ( '' != $css ) {
			$css =  preg_replace( '/\s+/', ' ', $css );
			$css = ''. $css .'';
			return $css;
		} else {
			return '';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Output CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_output_css' ) ) {
	function uw_output_css() {
		// Set output Var
		$output = '';
		$output .= uw_style_widgets();
		$output .= uw_custom_css();

		if ( $output ) {
			echo "\n<style type=\"text/css\">\n" . $output . "\n</style>";
		}
	}
}
add_action( 'wp_head', 'uw_output_css' );