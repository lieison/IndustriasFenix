<?php
/**
 * Flickr Widget
*/
class uw_flickr extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_flickr',
            $name = __( 'UW - Flickr Stream', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_flickr_widget',
				'description'	=> __( 'Pulls in images from your Flickr account.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_flickr_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_flickr_js'));
			}
		}

    }

	public function uw_flickr_script() {
		wp_enqueue_style( 'uw-flickr', uw_plugin_url( 'assets/css/styles/widgets/flickr.css' ) );
	}

	public function uw_flickr_js() {
		wp_enqueue_script('uw-flickr-js', uw_plugin_url( 'assets/js/widgets/flickr.js' ), UW_VERSION );
	}
	
	// display the widget in the theme
	public function widget( $args, $instance ) {
		extract($args);
		
		$title 		= apply_filters('widget_title', $instance['title']);
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$columns 	= isset( $instance['columns'] ) ? $instance['columns'] : '';
		$number 	= (int) strip_tags($instance['number']);
		$id 		= strip_tags($instance['id']);

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
			<?php } ?>
			<ul class="uw-flickr-widget <?php echo esc_attr( $columns ); ?>" data-id="<?php echo esc_attr( $id ); ?>" data-num="<?php echo esc_attr( $number ); ?>"></ul>
			<textarea style="display:none;" class="flickrtemplate">
				<li class="flickr_badge_image">
					<a href="{{image_b}}" title="{{title}}"><img src="{{image_q}}" alt="{{title}}" /></a>
				</li>
			</textarea>
		<?php
		echo $after_widget;
	}
	
	// update the widget when new options have been entered
	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['class_wrap'] = strip_tags($new_instance['class_wrap']);
		$instance['columns'] 	= strip_tags($new_instance['columns']);
		$instance['number'] 	= (int) strip_tags($new_instance['number']);
		$instance['id'] 		= strip_tags($new_instance['id']);
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	public function form( $instance ) {

		// combine provided fields with defaults
		$instance 	= wp_parse_args( (array) $instance, array(
			'title' 		=> __('Flickr Feed','kho'),
			'class_wrap' 	=> '',
			'columns' 		=> __('3 Columns','kho'),
			'id' 			=> '52617155@N08',
			'number'		=> 9
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:', 'kho'); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('columns'); ?>" id="<?php echo $this->get_field_id('columns'); ?>">
				<option value="three-columns" <?php if($instance['columns'] == 'three-columns') { ?>selected="selected"<?php } ?>><?php _e( '3 Columns', 'kho' ); ?></option>
				<option value="four-columns" <?php if($instance['columns'] == 'four-columns') { ?>selected="selected"<?php } ?>><?php _e( '4 Columns', 'kho' ); ?></option>
				<option value="five-columns" <?php if($instance['columns'] == 'five-columns') { ?>selected="selected"<?php } ?>><?php _e( '5 Columns', 'kho' ); ?></option>
				<option value="six-columns" <?php if($instance['columns'] == 'six-columns') { ?>selected="selected"<?php } ?>><?php _e( '6 Columns', 'kho' ); ?></option>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('Flickr ID ', 'kho'); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $instance['id']; ?>" />
			<small><?php _e('Enter the url of your Flickr page on this site: idgettr.com.', 'kho'); ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number:', 'kho'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" />
			<small><?php _e('The maximum is 20 images.', 'kho'); ?></small>
		</p>

	<?php
	}
}