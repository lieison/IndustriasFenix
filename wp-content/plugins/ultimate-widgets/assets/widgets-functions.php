<?php
// Widgets Functions

/*-----------------------------------------------------------------------------------*/
/*	- Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_custom_widgets' ) ) {
	function uw_custom_widgets() {

		// Define array of custom widgets
		$widgets = array(
			'about-me',
			'ads',
			'banner',
			'calendar',
			'contact-info',
			'custom-links',
			'facebook',
			'flickr',
			'gmap',
			'login',
			'mailchimp',
			'menu',
			'posts-slider',
			'posts-thumbnails',
			'search',
			'slideshow',
			'social',
			'soundcloud',
			'tabs',
			'testimonials',
			'text',
			'twitter',
			'video',
			'weather',
		);

		// Apply filters so you can remove custom widgets via a child theme if wanted
		$widgets = apply_filters( 'custom_widgets', $widgets );

		// Loop through widgets and load their files
		foreach ( $widgets as $widget ) {
			$widget_file = UW_PLUGIN_DIR .'/widgets/widget-'. $widget .'.php';
			if ( file_exists( $widget_file ) ) {
				require_once( $widget_file );
			}
		}

	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Register Widgets
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'register_uw_widgets' ) ) {
	function register_uw_widgets() {

		if ( '1' == uw_option( 'about-me', '1' ) ) {
		    register_widget('uw_about_me');
		}
		if ( '1' == uw_option( 'ads-widget', '1' ) ) {
		    register_widget('uw_ads');
		}
		if ( '1' == uw_option( 'banner', '1' ) ) {
		    register_widget('uw_banner');
		}
		if ( '1' == uw_option( 'calendar', '1' ) ) {
		    register_widget('uw_calendar');
		}
		if ( '1' == uw_option( 'contact-info', '1' ) ) {
		    register_widget('uw_contact_info');
		}
		if ( '1' == uw_option( 'custom-links', '1' ) ) {
		    register_widget('uw_custom_links');
		}
		if ( '1' == uw_option( 'facebook', '1' ) ) {
		    register_widget('uw_facebook');
		}
		if ( '1' == uw_option( 'flickr', '1' ) ) {
		    register_widget('uw_flickr');
		}
		if ( '1' == uw_option( 'gmap', '1' ) ) {
		    register_widget('uw_map');
		}
		if ( '1' == uw_option( 'login', '1' ) ) {
		    register_widget('uw_login');
		}
		if ( '1' == uw_option( 'mailchimp', '1' ) ) {
		    register_widget('uw_mailchimp');
		}
		if ( '1' == uw_option( 'menu', '1' ) ) {
		    register_widget('uw_menu');
		}
		if ( '1' == uw_option( 'posts-slider', '1' ) ) {
		    register_widget('uw_posts_slider');
		}
		if ( '1' == uw_option( 'posts-thumbnails', '1' ) ) {
		    register_widget('uw_recent_posts_thumb');
		}
		if ( '1' == uw_option( 'search', '1' ) ) {
		    register_widget('uw_search');
		}
		if ( '1' == uw_option( 'slideshow', '1' ) ) {
		    register_widget('uw_slideshow');
		}
		if ( '1' == uw_option( 'social', '1' ) ) {
		    register_widget('uw_social');
		}
		if ( '1' == uw_option( 'soundcloud', '1' ) ) {
		    register_widget('uw_soundcloud');
		}
		if ( '1' == uw_option( 'tabs', '1' ) ) {
		    register_widget('uw_tabs');
		}
		if ( '1' == uw_option( 'testimonials', '1' ) ) {
		    register_widget('uw_testimonial');
		}
		if ( '1' == uw_option( 'text', '1' ) ) {
		    register_widget('uw_text');
		}
		if ( '1' == uw_option( 'twitter', '1' ) ) {
		    register_widget('uw_twitter');
		}
		if ( '1' == uw_option( 'video', '1' ) ) {
		    register_widget('uw_video');
		}
		if ( '1' == uw_option( 'weather', '1' ) ) {
		    register_widget('uw_weather');
		}

	}
}
add_action('widgets_init', 'register_uw_widgets');

/*-----------------------------------------------------------------------------------*/
/*	- Tabs Widget Functions
/*-----------------------------------------------------------------------------------*/
// Post Thumbnails
if ( function_exists( 'add_image_size' ) ){
	add_image_size( 'uw-small', 110, 75, true );
}

// Get Most Recent posts
if ( !function_exists( 'uw_last_posts' ) ) {
	function uw_last_posts($posts_number = 5 , $thumb = true) {
		global $post;
		$uw_post = $post;

		$args = array('posts_per_page'		 => $posts_number);

		$get_posts_query = new WP_Query( $args );

		if ( $get_posts_query->have_posts() ):
			while ( $get_posts_query->have_posts() ) : $get_posts_query->the_post() ?>
			<li>
				<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() && $thumb ) : ?>			
					<div class="uw-post-thumbnail">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'uw-small' ); ?></a>
					</div>
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
				<span class="uw-date"><i class="icon_clock_alt"></i><?php echo get_the_date(); ?></span>
			</li>
			<?php endwhile;
		endif;
		
		$post = $uw_post;
		wp_reset_query();
	}
}

// Get Most commented posts
if ( !function_exists( 'uw_most_commented' ) ) {
	function uw_most_commented($comment_posts = 5 , $avatar_size = 55) {
		$comments = get_comments('status=approve&number='.$comment_posts);
		foreach ($comments as $comment) { ?>
		<li>
			<div class="uw-post-thumbnail" style="width:<?php echo esc_attr($avatar_size); ?>px">
				<?php echo get_avatar( $comment, $avatar_size ); ?>
			</div>
			<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>#comment-<?php echo $comment->comment_ID; ?>">
				<?php echo strip_tags($comment->comment_author); ?>: <?php echo wp_html_excerpt( $comment->comment_content, 80 ); ?>...
			</a>
		</li>
	<?php } 
	}
}

/*-----------------------------------------------------------------------------------*/
/*	- Weather Widget Functions
/*	- Based On: Awesome Weather Widget http://halgatewood.com/awesome-weather
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'uw_weather_logic' ) ) {
	function uw_weather_logic($atts) {
		$rtn 				= "";
		$weather_data		= array();
		$location 			= isset($atts['location']) ? $atts['location'] : false;
		$units 				= (isset($atts['units']) AND strtoupper($atts['units']) == "C") ? "metric" : "imperial";
		$units_display		= $units == "metric" ? __('C', 'kho') : __('F', 'kho');
		$days_to_show 		= isset($atts['forecast_days']) ? $atts['forecast_days'] : 5;
		$locale				= 'en';

		$sytem_locale 		= get_locale();
		$available_locales 	= array( 'en', 'sp', 'fr', 'it', 'de', 'pt', 'ro', 'pl', 'ru', 'ua', 'fi', 'nl', 'bg', 'se', 'tr', 'zh_tw', 'zh_cn' ); 
		
	    // Check for locale
	    if( in_array( $sytem_locale , $available_locales ) ){
	    	$locale = $sytem_locale;
	    }
	    
	    // Check for locale by first two digits
	    if( in_array(substr($sytem_locale, 0, 2), $available_locales ) ){
	    	$locale = substr($sytem_locale, 0, 2);
	    }

		// If no location
		if( !$location ) { return uw_weather_error(); }
		
		// Find and cache city ID
		if ( is_numeric($location) ) {
			$city_name_slug 	= $location;
			$api_query			= "id=" . $location;
		} else {
			$city_name_slug 	= sanitize_title( $location );
			$api_query			= "q=" . $location;
		}
		
		// Transient name
		$weather_transient_name = 'uw_' . $city_name_slug . "_" . strtolower($units_display) . '_' . $locale;

		
		// Get weather data
		if ( get_transient( $weather_transient_name ) ) {
			$weather_data = get_transient( $weather_transient_name );
		} else {
			$weather_data['now'] 		= array();
			$weather_data['forecast'] 	= array();
			
			$now_ping = "http://api.openweathermap.org/data/2.5/weather?" . $api_query . "&lang=" . $locale . "&units=" . $units;
			$now_ping_get = wp_remote_get( $now_ping );
		
			if( is_wp_error( $now_ping_get ) ){
				return uw_weather_error( $now_ping_get->get_error_message() ); 
			}
		
			$city_data = json_decode( $now_ping_get['body'] );
			
			if ( isset($city_data->cod) AND $city_data->cod == 404 ) {
				return uw_weather_error( $city_data->message ); 
			} else {
				$weather_data['now'] = $city_data;
			}
			
			// Forecast
			if ( $days_to_show != "hide" ) {
				$forecast_ping 		= "http://api.openweathermap.org/data/2.5/forecast/daily?" . $api_query . "&lang=" . $locale . "&units=" . $units ."&cnt=7";
				$forecast_ping_get 	= wp_remote_get( $forecast_ping );
			
				if ( is_wp_error( $forecast_ping_get ) ) {
					return uw_weather_error( $forecast_ping_get->get_error_message()  ); 
				}	
				
				$forecast_data = json_decode( $forecast_ping_get['body'] );
				
				if ( isset($forecast_data->cod) AND $forecast_data->cod == 404 ) {
					return uw_weather_error( $forecast_data->message ); 
				} else {
					$weather_data['forecast'] = $forecast_data;
				}
			}	
			
			if ($weather_data['now'] OR $weather_data['forecast']) {
				set_transient( $weather_transient_name, $weather_data, apply_filters( 'awesome_weather_cache', 11000 ) ); 
			}
		}

		// If no weather
		if ( !$weather_data OR !isset($weather_data['now'])) { return uw_weather_error(); }
		
		
		// Todays temps and icons
		$today 			= $weather_data['now'];
		$today_temp 	= round($today->main->temp);
		$today_high 	= round($today->main->temp_max);
		$today_low 		= round($today->main->temp_min);
		
		// Data
		$today->main->humidity 		= round($today->main->humidity);
		$today->wind->speed 		= round($today->wind->speed);
		
		$wind_label = array( 
			__('N', 'kho'),
			__('NNE', 'kho'), 
			__('NE', 'kho'),
			__('ENE', 'kho'),
			__('E', 'kho'),
			__('ESE', 'kho'),
			__('SE', 'kho'),
			__('SSE', 'kho'),
			__('S', 'kho'),
			__('SSW', 'kho'),
			__('SW', 'kho'),
			__('WSW', 'kho'),
			__('W', 'kho'),
			__('WNW', 'kho'),
			__('NW', 'kho'),
			__('NNW', 'kho')
		);
							
		$wind_direction = $wind_label[ fmod((($today->wind->deg + 11) / 22.5),16) ];	
		
		// Icons
		$today_icon 	= $today->weather[0]->icon;
		$icon_class 	= 'N';
		if ( $today_icon == '01d' ) {
			$icon_class ='B';
		} else if ( $today_icon == '01n' ) {
			$icon_class ='C';
		} else if( $today_icon == '02d' ) {
			$icon_class ='H';
		} else if( $today_icon == '02n' ) {
			$icon_class ='I';
		} else if( $today_icon == '04d'  || $today_icon == '04n' ) {
			$icon_class ='Y';
		} else if( $today_icon == '09d'  || $today_icon == '09n' || $today_icon == '10d'  || $today_icon == '10n' ) {
			$icon_class ='R';
		} else if( $today_icon == '11d'  || $today_icon == '11n' ) {
			$icon_class ='Z';
		} else if( $today_icon == '13d'  || $today_icon == '13n' ) {
			$icon_class ='X';
		} else if( $today_icon == '50d'  || $today_icon == '50n' ) {
			$icon_class ='M';
		}
		
		// Dispaly weather
		$rtn .= "
			<div id=\"uw-weather-{$city_name_slug}\" class=\"uw-weather-wrap\">
		";

		$rtn .= "
			<div class=\"uw-weather-current-temp\">
				<div class=\"uw-weather-icon\" data-icon=\"{$icon_class}\"></div>
				$today_temp<sup>{$units_display}</sup>
			</div>
		";	
		
		
		$speed_text = ($units == "metric") ? __('km/h', 'kho') : __('mph', 'kho');
		
		$rtn .= "
			<div class=\"uw-weather-todays-stats\">
				<div class=\"uw_weather_name\">{$today->name}</div>
				<div class=\"uw_weather_desc\">{$today->weather[0]->description}</div>
				<div class=\"uw_weather_humidty\">" . __('humidity:', 'kho') . " {$today->main->humidity}% </div>
				<div class=\"uw_weather_wind\">" . __('wind:', 'kho') . " {$today->wind->speed}" . $speed_text . " {$wind_direction}</div>
				<div class=\"uw_weather_highlow\"> "  .__('H', 'kho') . " {$today_high} &bull; " . __('L', 'kho') . " {$today_low} </div>	
			</div>
		";
		

		if ($days_to_show != "hide") {
			$rtn 			.= "<div class=\"uw-weather-forecast uw_weather_days_{$days_to_show}\">";
			$c 				= 1;
			$dt_today 		= date( 'Ymd', current_time( 'timestamp', 0 ) );
			$forecast 		= $weather_data['forecast'];
			$days_to_show 	= (int) $days_to_show;
			
			foreach ( (array) $forecast->list as $forecast ) {
				if ( $dt_today >= date('Ymd', $forecast->dt)) { continue; }
				$days_of_week = array( __('Sun' ,'kho'), __('Mon' ,'kho'), __('Tue' ,'kho'), __('Wed' ,'kho'), __('Thu' ,'kho'), __('Fri' ,'kho'), __('Sat' ,'kho') );
					
				$forecast->temp = (int) $forecast->temp->day;
				$day_of_week = $days_of_week[ date('w', $forecast->dt) ];
				$rtn .= "
					<div class=\"uw-weather-forecast-day\">
						<div class=\"uw-weather-forecast-day-temp\">{$forecast->temp}<sup>{$units_display}</sup></div>
						<div class=\"uw-weather-forecast-day-abbr\">$day_of_week</div>
					</div>
				";
				if ($c == $days_to_show) { break; }
				$c++;
			}
			$rtn .= " </div>";
		}

		$rtn .= "</div>";
		return $rtn;
	}
}

// Return error
if ( !function_exists( 'uw_weather_error' ) ) {
	function uw_weather_error( $msg = false ) {
		if(!$msg) {
			$msg = __('No weather information available', 'kho');
		}
		return apply_filters( 'uw_weather_error', "<!-- UW WEATHER ERROR: " . $msg . " -->" );
	}
}