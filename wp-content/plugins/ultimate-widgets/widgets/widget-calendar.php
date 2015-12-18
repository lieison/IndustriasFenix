<?php
/**
 * Calendar Widget
*/
class uw_calendar extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_calendar',
            $name = __( 'UW - Calendar', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_calendar_widget',
				'description'	=> __( 'Displays a calendar in the sidebar.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_calendar_script'), 15);
			}
		}

    }

	public function uw_calendar_script() {
		wp_enqueue_style( 'uw-calendar', uw_plugin_url( 'assets/css/styles/widgets/calendar.css' ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 				= isset($instance['title']) ? $instance['title'] : false;
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$calendar_style 	= isset( $instance['calendar_style'] ) ? $instance['calendar_style'] : '';

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
			<div class="uw-calendar-<?php echo esc_attr( $calendar_style ); ?>">
				<?php
				if ( 'style1' == $calendar_style ) {
					get_calendar(false);
				} else {
					get_calendar();
				} ?>
			</div>
		<?php echo $after_widget;

	} 

	/**
	 * update widget settings
	 */	 
	public function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] 		= strip_tags( $new_instance['class_wrap'] );
		$instance['calendar_style'] 	= strip_tags( $new_instance['calendar_style'] );
		return $instance;
	}
		 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' 			=> __('Calendar','kho'),
			'class_wrap' 		=> '',
			'calendar_style' 	=> __('Style 1','kho'),
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
			<label for="<?php echo $this->get_field_id('calendar_style'); ?>"><?php _e( 'Calendar Style:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('calendar_style'); ?>" id="<?php echo $this->get_field_id('calendar_style'); ?>">
				<option value="style1" <?php if($instance['calendar_style'] == 'style1') { ?>selected="selected"<?php } ?>><?php _e( 'Style 1', 'kho' ); ?></option>
				<option value="style2" <?php if($instance['calendar_style'] == 'style2') { ?>selected="selected"<?php } ?>><?php _e( 'Style 2', 'kho'); ?></option>
				<option value="style3" <?php if($instance['calendar_style'] == 'style3') { ?>selected="selected"<?php } ?>><?php _e( 'Style 3', 'kho'); ?></option>
			</select>
		</p>
		
	<?php 
	}
}