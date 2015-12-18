<?php
/**
 * Facebook Widget
*/
class uw_facebook extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_facebook',
            $name = __( 'UW - Facebook', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_facebook_widget',
				'description'	=> __( 'Adds support for Facebook Page Plugin.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			add_action( 'wp_footer', array(&$this, 'uw_facebook_script') );
		}

    }
	
	// display the widget in the theme
	public function widget($args, $instance) {
		extract($args);
		$title 			= apply_filters('widget_title', $instance['title']);
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$page_url 		= isset( $instance['page_url'] ) ? $instance['page_url'] : '';
		$width 			= isset( $instance['width'] ) ? $instance['width'] : '';
		$height 		= isset( $instance['height'] ) ? $instance['height'] : '';
		$small_header 	= isset($instance['small_header']) ? 'true' : 'false';
		$hide_cover 	= isset($instance['hide_cover']) ? 'true' : 'false';
		$show_facepile 	= isset($instance['show_facepile']) ? 'true' : 'false';
		$show_posts 	= isset($instance['show_posts']) ? 'true' : 'false';

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

			if($page_url) { ?>
				<div id="fb-root"></div>
				<div class="fb-page" data-href="<?php echo esc_url($page_url); ?>" <?php if($width) { ?>data-width="<?php echo esc_attr($width); ?>"<?php } if($height) { ?>data-height="<?php echo esc_attr($height); ?>" <?php } ?>data-small-header="<?php echo esc_attr($small_header); ?>" data-adapt-container-width="true" data-hide-cover="<?php echo esc_attr($hide_cover); ?>" data-show-facepile="<?php echo esc_attr($show_facepile); ?>" data-show-posts="<?php echo esc_attr($show_posts); ?>"><div class="fb-xfbml-parse-ignore"></div></div>
			<?php }

		echo $after_widget;
	}

	public function uw_facebook_script() { ?>
		<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = '//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.3';fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
	<?php }

	public function update($new_instance, $old_instance) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['class_wrap'] 	= strip_tags($new_instance['class_wrap']);
		$instance['page_url'] 		= $new_instance['page_url'];
		$instance['width'] 			= $new_instance['width'];
		$instance['height'] 		= $new_instance['height'];
		$instance['small_header'] 	= $new_instance['small_header'];
		$instance['hide_cover'] 	= $new_instance['hide_cover'];
		$instance['show_facepile'] 	= $new_instance['show_facepile'];
		$instance['show_posts'] 	= $new_instance['show_posts'];
		return $instance;
	}

	public function form($instance) {
		$instance 	= wp_parse_args( (array) $instance, array(
			'title' 		=> __('Find us on Facebook','kho'),
			'class_wrap' 	=> '',
			'page_url' 		=> 'www.facebook.com/Khositeweb',
			'width' 		=> '',
			'height' 		=> '',
			'small_header' 	=> false,
			'hide_cover' 	=> false,
			'show_facepile' => false,
			'show_posts' 	=> false
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
			<label for="<?php echo $this->get_field_id('page_url'); ?>"><?php _e('Facebook Page Url:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" value="<?php echo $instance['page_url']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['small_header'], 'on'); ?> id="<?php echo $this->get_field_id('small_header'); ?>" name="<?php echo $this->get_field_name('small_header'); ?>" />
			<label for="<?php echo $this->get_field_id('small_header'); ?>"><?php _e('Use Small Header', 'kho'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['hide_cover'], 'on'); ?> id="<?php echo $this->get_field_id('hide_cover'); ?>" name="<?php echo $this->get_field_name('hide_cover'); ?>" />
			<label for="<?php echo $this->get_field_id('hide_cover'); ?>"><?php _e('Hide Cover Photo', 'kho'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_facepile'], 'on'); ?> id="<?php echo $this->get_field_id('show_facepile'); ?>" name="<?php echo $this->get_field_name('show_facepile'); ?>" />
			<label for="<?php echo $this->get_field_id('show_facepile'); ?>"><?php _e('Show Friend&rsquo;s Faces', 'kho'); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('show_posts'); ?>"><?php _e('Show Page Posts', 'kho'); ?></label>
		</p>
	<?php
	}
}