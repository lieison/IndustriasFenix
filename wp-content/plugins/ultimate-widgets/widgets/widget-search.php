<?php
/**
 * Search Widget
*/
class uw_search extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_search',
            $name = __( 'UW - Search', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_search_widget',
				'description'	=> __( 'Displays a search form.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_search_script'), 15);
			}
		}

    }

	public function uw_search_script() {
		wp_enqueue_style( 'uw-search', uw_plugin_url( 'assets/css/styles/widgets/search.css' ) );
	}
	
	// display the widget in the theme
	public function widget($args, $instance) {
		extract($args);
		$title 			= apply_filters('widget_title', $instance['title']);
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';

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
			<form role="search" method="get" class="uw-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" class="uw-field" name="s" value="<?php _e( 'search', 'kho' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
				<input type="submit" class="uw-submit" value="<?php _e( 'Search', 'kho' ); ?>">
			</form>

		<?php echo $after_widget;
	}

	public function update($new_instance, $old_instance) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['class_wrap'] 	= strip_tags($new_instance['class_wrap']);
		return $instance;
	}

	public function form($instance) {
		$instance 	= wp_parse_args( (array) $instance, array(
			'title' 		=> __('Search','kho'),
			'class_wrap' 	=> '',
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

	<?php
	}
}