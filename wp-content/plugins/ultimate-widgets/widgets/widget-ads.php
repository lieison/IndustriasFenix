<?php
/**
 * Ads Widget
*/
class uw_ads extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_ads',
            $name = __( 'UW - Ads', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_ads_widget',
				'description'	=> __( 'A widget that displays ads in sidebar.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_ads_widget_script'), 15);
			}
		}

    }

	public function uw_ads_widget_script() {
		wp_enqueue_style( 'uw-ads-widget', uw_plugin_url( 'assets/css/styles/widgets/ads-widget.css' ) );
	}

	// display the widget in the theme
	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title'] );
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$ad1 		= $instance['ad1'];
		$adlink1 	= $instance['adlink1'];
		$ad2 		= $instance['ad2'];
		$adlink2 	= $instance['adlink2'];
		$ad3 		= $instance['ad3'];
		$adlink3 	= $instance['adlink3'];
		$ad4 		= $instance['ad4'];
		$adlink4 	= $instance['adlink4'];
		$ad5 		= $instance['ad5'];
		$adlink5 	= $instance['adlink5'];
		$ad6 		= $instance['ad6'];
		$adlink6 	= $instance['adlink6'];

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

		$allads = array();

		echo $before_widget;
			if($title) { ?>
				<h3 class="uw-title">
					<span><?php echo esc_attr( $title ); ?></span>
				</h3>
			<?php } ?>
			<div class="uw_ads_wrap clr">
				<?php if ( $adlink1 && $ad1 ) { ?>
					<a href="<?php echo esc_url( $adlink1 ); ?>" target="_blank" class="large"><img src="<?php echo esc_url( $ad1 ); ?>" alt="" /></a>
				<?php }
				// Display Ad 2
				if ( $adlink2 && $ad2 ) { ?>
					<a href="<?php echo esc_url( $adlink2 ); ?>" target="_blank"><img src="<?php echo esc_url( $ad2 ); ?>" alt="" /></a>
				<?php }
				// Display Ad 3
				if ( $adlink3 && $ad3 ) { ?>
					<a href="<?php echo esc_url( $adlink3 ); ?>" target="_blank" class="small"><img src="<?php echo esc_url( $ad3 ); ?>" alt="" /></a>
				<?php }
				// Display Ad 4
				if ( $adlink4 && $ad4) { ?>
					<a href="<?php echo esc_url( $adlink4 ); ?>" target="_blank" class="righter small"><img src="<?php echo esc_url( $ad4 ); ?>" alt="" /></a>
				<?php }
				// Display Ad 5
				if ( $adlink5 && $ad5) { ?>
					<a href="<?php echo esc_url( $adlink5 ); ?>" target="_blank" class="small"><img src="<?php echo esc_url( $ad5 ); ?>" alt="" /></a>
				<?php }
				// Display Ad 6
				if ( $adlink6 && $ad6) { ?>
					<a href="<?php echo esc_url( $adlink6 ); ?>" target="_blank" class="righter small"><img src="<?php echo esc_url( $ad6 ); ?>" alt="" /></a>
				<?php } ?>
			</div>
		<?php
		echo $after_widget;

	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] = strip_tags( $new_instance['class_wrap'] );
		$instance['ad1'] 		= $new_instance['ad1'] ;
		$instance['adlink1'] 	= $new_instance['adlink1'];
		$instance['ad2'] 		= $new_instance['ad2'];
		$instance['adlink2'] 	= $new_instance['adlink2'];
		$instance['ad3'] 		= $new_instance['ad3'] ;
		$instance['adlink3'] 	= $new_instance['adlink3'];
		$instance['ad4'] 		= $new_instance['ad4'] ;
		$instance['adlink4'] 	= $new_instance['adlink4'];
		$instance['ad5'] 		= $new_instance['ad5'] ;
		$instance['adlink5'] 	= $new_instance['adlink5'];
		$instance['ad6'] 		= $new_instance['ad6'] ;
		$instance['adlink6'] 	= $new_instance['adlink6'];				
		return $instance;
	}
		 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' 		=> __('Sponsors','kho'),
			'class_wrap' 	=> '',
			'random' 		=> false,
			'ad1' 			=> plugins_url( 'assets/images/large.png', dirname(__FILE__) ),
			'adlink1' 		=> '#',
			'ad2' 			=> '',
			'adlink2' 		=> '',
			'ad3' 			=> plugins_url( 'assets/images/small.png', dirname(__FILE__) ),
			'adlink3' 		=> '#',
			'ad4' 			=> plugins_url( 'assets/images/small.png', dirname(__FILE__) ),
			'adlink4' 		=> '#',
			'ad5' 			=> '',
			'adlink5' 		=> '',
			'ad6' 			=> '',
			'adlink6' 		=> ''
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Ads Title (Optional):', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink1' ); ?>"><?php _e('Ad 1 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink1' ); ?>" name="<?php echo $this->get_field_name( 'adlink1' ); ?>" value="<?php echo $instance['adlink1']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink2' ); ?>"><?php _e('Ad 2 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink2' ); ?>" name="<?php echo $this->get_field_name( 'adlink2' ); ?>" value="<?php echo $instance['adlink2']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink3' ); ?>"><?php _e('Ad 3 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink3' ); ?>" name="<?php echo $this->get_field_name( 'adlink3' ); ?>" value="<?php echo $instance['adlink3']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink4' ); ?>"><?php _e('Ad 4 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink4' ); ?>" name="<?php echo $this->get_field_name( 'adlink4' ); ?>" value="<?php echo $instance['adlink4']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad5' ); ?>"><?php _e('Ad 5 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink5' ); ?>"><?php _e('Ad 5 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink5' ); ?>" name="<?php echo $this->get_field_name( 'adlink5' ); ?>" value="<?php echo $instance['adlink5']; ?>" />
		</p>

		<p class="uw-left">
		    <label for="<?php echo $this->get_field_id( 'ad6' ); ?>"><?php _e('Ad 6 Image URL:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
		</p>

		<p class="uw-right">
		    <label for="<?php echo $this->get_field_id( 'adlink6' ); ?>"><?php _e('Ad 6 Link:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'adlink6' ); ?>" name="<?php echo $this->get_field_name( 'adlink6' ); ?>" value="<?php echo $instance['adlink6']; ?>" />
		</p>
	<?php
	}
}