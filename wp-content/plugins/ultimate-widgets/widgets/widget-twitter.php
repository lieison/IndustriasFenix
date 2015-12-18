<?php
/**
 * Twitter Widget
*/
class uw_twitter extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_twitter',
            $name = __( 'UW - Banner', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_twitter_widget',
				'description'	=> __( 'Adds support for your tweets.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_twitter_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_twitter_js'));
			}
		}

    }

	public function uw_twitter_script() {
		wp_enqueue_style( 'uw-twitter', uw_plugin_url( 'assets/css/styles/widgets/twitter.css' ) );
	}

	public function uw_twitter_js() {
		wp_enqueue_script('uw-twitter-js', uw_plugin_url( 'assets/js/widgets/twitter.js' ), UW_VERSION );
	}

	public function widget($args, $instance) {
		extract($args);
		$title 					= apply_filters('widget_title', $instance['title']);
		$class_wrap 			= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$style 					= $instance['style'];
		$twitter_id 			= $instance['twitter_id'];
		$twitter_width 			= $instance['twitter_width'];
		$twitter_height 		= $instance['twitter_height'];
		$color_scheme 			= $instance['color_scheme'];
		$consumer_key 			= $instance['consumer_key'];
		$consumer_secret 		= $instance['consumer_secret'];
		$access_token 			= $instance['access_token'];
		$access_token_secret 	= $instance['access_token_secret'];
		$twitter_username 		= $instance['twitter_username'];
		$count 					= (int) $instance['count'];
		$widget_id 				= $args['widget_id'];

		// Class wrap
		if ( '' != $class_wrap ) {
      		$class_widget = $class_wrap;
		} else {
      		$class_widget = uw_option('widgets_style', 'style1');
		}

		// no 'class' attribute
		if( strpos($before_widget, 'class') === false ) {
			$before_widget = str_replace('>', 'class="'. $class_widget . '"', $before_widget);
		}
		// there is 'class' attribute
		else {
			$before_widget = str_replace('class="', 'class="'. $class_widget . ' ', $before_widget);
		}

		echo $before_widget;

			if($title) { ?>
				<h3 class="uw-title">
					<span><?php echo esc_attr( $title ); ?></span>
				</h3>
			<?php }

			if ('expand' == $style && $twitter_id) { ?>

				<a class="twitter-timeline" <?php if ('dark' == $color_scheme) { ?>data-theme="dark"<?php } ?> width="<?php echo esc_attr($twitter_width); ?>" height="<?php echo esc_attr($twitter_height); ?>" href="https://twitter.com/twitter" data-widget-id="<?php echo esc_attr($twitter_id); ?>">Tweets by @twitter</a>

			<?php } else if ('simple' == $style && $twitter_username && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {

				$transName = 'list_tweets_'.$widget_id;
				$cacheTime = 10;
				if(false === ($twitterData = get_transient($transName))) {

					$token = get_option('cfTwitterToken_'.$widget_id);

					// get a new token anyways
					delete_option('cfTwitterToken_'.$widget_id);

					// getting new auth bearer only if we don't have one
					if(!$token) {
						// preparing credentials
						$credentials = $consumer_key . ':' . $consumer_secret;
						$toSend = base64_encode($credentials);

						// http post arguments
						$args = array(
							'method' 		=> 'POST',
							'httpversion' 	=> '1.1',
							'blocking' 		=> true,
							'headers' 		=> array(
								'Authorization' => 'Basic ' . $toSend,
								'Content-Type' 	=> 'application/x-www-form-urlencoded;charset=UTF-8'
							),
							'body' => array( 'grant_type' => 'client_credentials' )
						);

						add_filter('https_ssl_verify', '__return_false');
						$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);

						$keys = json_decode(wp_remote_retrieve_body($response));

						if($keys) {
							// saving token to wp_options table
							update_option('cfTwitterToken_'.$widget_id, $keys->access_token);
							$token = $keys->access_token;
						}
					}
					// we have bearer token wether we obtained it from API or from options
					$args = array(
						'httpversion' 	=> '1.1',
						'blocking' 		=> true,
						'headers' 		=> array(
							'Authorization' => "Bearer $token"
						)
					);

					add_filter('https_ssl_verify', '__return_false');
					$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$twitter_username&count=$count";
					$response = wp_remote_get($api_url, $args);

					set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
				}
				@$twitter = json_decode(get_transient($transName), true);
				if($twitter && is_array($twitter)) { ?>
					<div class="twitter-box">
						<div class="twitter-holder">
							<div class="b">
								<div class="tweets-container" id="tweets_<?php echo esc_attr( $widget_id ); ?>">
									<ul class="uw-ul" id="uw_jtwt">
										<?php foreach($twitter as $tweet): ?>
										<li class="uw_jtwt_tweet">
											<p class="uw_jtwt_tweet_text">
											<?php
											$latestTweet = $tweet['text'];
											$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
											$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
											echo $latestTweet;
											?>
											</p>
											<?php
											$twitterTime = strtotime($tweet['created_at']);
											$timeAgo = $this->ago($twitterTime);
											?>
											<a href="http://twitter.com/<?php echo esc_attr( $tweet['user']['screen_name'] ); ?>/statuses/<?php echo esc_attr( $tweet['id_str'] ); ?>" class="uw_jtwt_date"><?php echo esc_attr( $timeAgo ); ?></a>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
						<span class="arrow"></span>
					</div>

				<?php }
			}

		echo $after_widget;
	}

	public function ago($time) {
		$periods 	= array( __( 'second', 'kho' ), __( 'minute', 'kho' ), __( 'hour', 'kho' ), __( 'day', 'kho' ), __( 'week', 'kho' ), __( 'month', 'kho' ), __( 'year', 'kho' ), __( 'decade', 'kho' ) );
		$lengths 	= array( '60', '60', '24', '7', '4.35', '12', '10' );
		$now 		= time();
		$difference = $now - $time;
		$tense 		= __( 'ago', 'kho' );

		for( $j = 0; $difference >= $lengths[$j] && $j < count( $lengths )-1; $j++ ) {
			$difference /= $lengths[$j];
		}

		$difference = round( $difference );

		if( $difference != 1 ) {
			$periods[$j] .= __( 's', 'kho' );
		}

	   return sprintf('%s %s %s', $difference, $periods[$j], $tense );
	}

	public function update($new_instance, $old_instance) {
		$instance 							= $old_instance;
		$instance['title'] 					= strip_tags($new_instance['title']);
		$instance['class_wrap'] 			= strip_tags($new_instance['class_wrap']);
		$instance['style'] 					= $new_instance['style'];
		$instance['twitter_id'] 			= $new_instance['twitter_id'];
		$instance['twitter_width'] 			= $new_instance['twitter_width'];
		$instance['twitter_height'] 		= $new_instance['twitter_height'];
		$instance['color_scheme'] 			= $new_instance['color_scheme'];
		$instance['consumer_key'] 			= $new_instance['consumer_key'];
		$instance['consumer_secret'] 		= $new_instance['consumer_secret'];
		$instance['access_token'] 			= $new_instance['access_token'];
		$instance['access_token_secret'] 	= $new_instance['access_token_secret'];
		$instance['twitter_username'] 		= $new_instance['twitter_username'];
		$instance['count'] 					= $new_instance['count'];
		return $instance;
	}

	public function form($instance) {
		$instance = wp_parse_args((array) $instance, array(
			'title' 				=> __('Recent Tweets','kho'),
			'class_wrap' 			=> '',
			'style' 				=> __('Light','kho'),
			'twitter_id' 			=> '',
			'twitter_width' 		=> '320px',
			'twitter_height' 		=> '400px',
			'color_scheme' 			=> '',
			'consumer_key'			=> '',
			'consumer_secret' 		=> '',
			'access_token' 			=> '',
			'access_token_secret' 	=> '',
			'twitter_username' 		=> '',
			'count' 				=> 3
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Style:', 'kho' ); ?></label>
			<select class='uw-select widefat' name="<?php echo $this->get_field_name('style'); ?>" id="uw-twitter-style-select">
				<option value="expand" <?php if($instance['style'] == 'expand') { ?>selected="selected"<?php } ?>><?php _e( 'Expand', 'kho' ); ?></option>
				<option value="simple" <?php if($instance['style'] == 'simple') { ?>selected="selected"<?php } ?>><?php _e( 'Simple', 'kho' ); ?></option>
			</select>
		</p>

		<div style="display: inline-block;">
			<h3 style="margin: 15px 0 0 0;clear: both;"><?php _e( 'Expand Style','kho' ); ?></h3> 
			<p class="uw-left">
				<label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
			</p>

			<p class="uw-right">
				<label for="<?php echo $this->get_field_id('twitter_width'); ?>"><?php _e('Width:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_width'); ?>" name="<?php echo $this->get_field_name('twitter_width'); ?>" value="<?php echo $instance['twitter_width']; ?>" />
			</p>

			<p class="uw-left">
				<label for="<?php echo $this->get_field_id('twitter_height'); ?>"><?php _e('Height:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_height'); ?>" name="<?php echo $this->get_field_name('twitter_height'); ?>" value="<?php echo $instance['twitter_height']; ?>" />
			</p>

			<p class="uw-right">
				<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e( 'Color Scheme:', 'kho' ); ?></label>
				<select class='uw-select widefat' name="<?php echo $this->get_field_name('color_scheme'); ?>" id="<?php echo $this->get_field_id('color_scheme'); ?>">
					<option value="light" <?php if($instance['color_scheme'] == 'light') { ?>selected="selected"<?php } ?>><?php _e( 'Light', 'kho' ); ?></option>
					<option value="dark" <?php if($instance['color_scheme'] == 'dark') { ?>selected="selected"<?php } ?>><?php _e( 'Dark', 'kho' ); ?></option>
				</select>
			</p>
		</div>

		<div style="display: inline-block;margin-top: 20px;">
			<h3 style="margin: 15px 0 0 0;clear: both;"><?php _e( 'Simple Style','kho' ); ?></h3> 
			<p class="uw-left">
				<label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer Key:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
			</p>

			<p class="uw-right">
				<label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
			</p>

			<p class="uw-left">
				<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access Token:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
			</p>

			<p class="uw-right">
				<label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access Token Secret:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
			</p>

			<p class="uw-left">
				<label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e('Twitter Username:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" value="<?php echo $instance['twitter_username']; ?>" />
			</p>

			<p class="uw-right">
				<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of Tweets:', 'kho'); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
			</p>
		</div>

	<?php
	}
}