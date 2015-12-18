<?php
/**
 * Weather Widget
*/
class uw_weather extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_weather',
            $name = __( 'UW - Weather', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_weather_widget',
				'description'	=> __( 'Displays weather in the sidebar.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_weather_script'), 15);
			}
		}

    }

	public function uw_weather_script() {
		wp_enqueue_style( 'uw-weather', uw_plugin_url( 'assets/css/styles/widgets/weather.css' ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 				= isset($instance['title']) ? $instance['title'] : false;
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$location 			= isset($instance['location']) ? $instance['location'] : false;
        $units 				= isset($instance['units']) ? $instance['units'] : false;
        $forecast_days 		= isset($instance['forecast_days']) ? $instance['forecast_days'] : false;

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
			echo uw_weather_logic( array( 'location' => $location, 'units' => $units, 'forecast_days' => $forecast_days ));
		echo $after_widget;

	} 

	/**
	 * update widget settings
	 */	 
	public function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags($new_instance['title']);
		$instance['class_wrap'] 		= strip_tags($new_instance['class_wrap']);
		$instance['location'] 			= strip_tags($new_instance['location']);
		$instance['units'] 				= strip_tags($new_instance['units']);
		$instance['forecast_days'] 		= strip_tags($new_instance['forecast_days']);
        return $instance;
	}

	public function form($instance) {
        $title 				= isset($instance['title']) ? $instance['title'] : __('Weather','kho');
        $class_wrap 		= isset($instance['class_wrap']) ? $instance['class_wrap'] : '';
		$location 			= isset($instance['location']) ? $instance['location'] : "";
        $units 				= (isset($instance['units']) AND strtoupper($instance['units']) == "C") ? "C" : "F";
        $forecast_days 		= isset($instance['forecast_days']) ? $instance['forecast_days'] : 5; ?>

	    <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo esc_attr($class_wrap); ?>" />
		</p>
		
        <p>
			<label for="<?php echo $this->get_field_id('location'); ?>">
				<?php _e('Location:', 'kho'); ?> - <a href="http://openweathermap.org/find" target="_blank"><?php _e('Find Your Location', 'kho'); ?></a><br />
				<small><?php _e('(i.e: London or New York)', 'kho'); ?></small>
			</label> 
			<input class="widefat" style="margin-top: 4px;" id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="text" value="<?php echo esc_attr($location); ?>" />
        </p>
                                
        <p>
			<label for="<?php echo $this->get_field_id('units'); ?>"><?php _e('Units:', 'kho'); ?></label>  &nbsp;
			<input id="<?php echo $this->get_field_id('units'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="F" <?php if($units == "F") echo ' checked="checked"'; ?> /> <?php _e('F', 'kho'); ?> &nbsp; &nbsp;
			<input id="<?php echo $this->get_field_id('units'); ?>" name="<?php echo $this->get_field_name('units'); ?>" type="radio" value="C" <?php if($units == "C") echo ' checked="checked"'; ?> /> <?php _e('C', 'kho'); ?>
        </p>
        
        
		<p>
			<label for="<?php echo $this->get_field_id('forecast_days'); ?>"><?php _e('Forecast:', 'kho'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('forecast_days'); ?>" name="<?php echo $this->get_field_name('forecast_days'); ?>">
				<option value="5"<?php if($forecast_days == 5) echo " selected=\"selected\""; ?>><?php _e('5 Days', 'kho'); ?></option>
				<option value="4"<?php if($forecast_days == 4) echo " selected=\"selected\""; ?>><?php _e('4 Days', 'kho'); ?></option>
				<option value="3"<?php if($forecast_days == 3) echo " selected=\"selected\""; ?>><?php _e('3 Days', 'kho'); ?></option>
				<option value="2"<?php if($forecast_days == 2) echo " selected=\"selected\""; ?>><?php _e('2 Days', 'kho'); ?></option>
				<option value="1"<?php if($forecast_days == 1) echo " selected=\"selected\""; ?>><?php _e('1 Day', 'kho'); ?></option>
				<option value="hide"<?php if($forecast_days == 'hide') echo " selected=\"selected\""; ?>><?php _e("Don't Show", 'kho'); ?></option>
			</select>
		</p>
	<?php 
	}
}