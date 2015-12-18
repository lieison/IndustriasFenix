<?php 
/**
 * Google Map Widget
*/
class uw_map extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_map',
            $name = __( 'UW - Google Map', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_map_widget',
				'description'	=> __( 'Displays google map.', 'kho' )
            )
        );

    }

	public function widget( $args, $instance ) {
		extract( $args );
		$title 				= apply_filters('widget_title', $instance['title']);
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$latitude 			= !empty( $instance['latitude'] )?$instance['latitude']:0;
		$longitude 			= !empty( $instance['longitude'] )?$instance['longitude']:0;
		$panControl 		= !empty( $instance['panControl'] )?$instance['panControl']:false;
		$scrollwheel 		= !empty( $instance['scrollwheel'] )?$instance['scrollwheel']:false;
		$zoomControl 		= !empty( $instance['zoomControl'] )?$instance['zoomControl']:false;
		$mapTypeControl 	= !empty( $instance['mapTypeControl'] )?$instance['mapTypeControl']:false;
		$scaleControl 		= !empty( $instance['scaleControl'] )?$instance['scaleControl']:false;
		$draggable 			= !empty( $instance['draggable'] )?$instance['draggable']:false;
		$zoom 				= (int)$instance['zoom'];
		$height 			= (int)$instance['height'];

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

		if ( $zoom < 1 ) {
			$zoom = 1;
		}

		echo $before_widget;
			if($title) { ?>
				<h3 class="uw-title">
					<span><?php echo esc_attr( $title ); ?></span>
				</h3>
			<?php }

			$id = mt_rand( 100, 3000 ); ?>

			<div id="gmap_widget_<?php echo esc_attr( $id );?>" class="google_map" style="height:<?php echo esc_attr( $height );?>px; width:100%;"></div>
				<script type="text/javascript" src="http<?php echo (is_ssl())? 's' : ''; ?>://maps.google.com/maps/api/js?sensor=false"></script>
				<script type="text/javascript">
					jQuery(document).ready(function($) {
						var map;
						var gmap_marker = true;

						var myLatlng = new google.maps.LatLng(<?php echo esc_attr( $latitude );?>, <?php echo esc_attr( $longitude );?>)
						function initialize() {
							var mapOptions = {
								zoom: <?php echo esc_attr( $zoom );?>,
								center: myLatlng,
								panControl: <?php echo esc_attr( $panControl ) ? 'true' : 'false';?>,
								scrollwheel: <?php echo esc_attr( $scrollwheel ) ? 'true' : 'false';?>,
								zoomControl: <?php echo esc_attr( $zoomControl ) ? 'true' : 'false';?>,
								mapTypeControl: <?php echo esc_attr( $mapTypeControl ) ? 'true' : 'false';?>,
								scaleControl: <?php echo esc_attr( $scaleControl ) ? 'true' : 'false';?>,
								draggable: <?php echo esc_attr( $draggable ) ? 'true' : 'false';?>,
								mapTypeId: google.maps.MapTypeId.ROADMAP,
							};
							map = new google.maps.Map(document.getElementById('gmap_widget_<?php echo esc_attr( $id );?>'), mapOptions);

							if(gmap_marker == true) {
								var marker = new google.maps.Marker({
									position: myLatlng,
									map: map
								});
							}
						}
						google.maps.event.addDomListener(window, 'load', initialize);
					});
			</script>

			<div class="clearboth"></div>
		<?php echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] 		= strip_tags( $new_instance['class_wrap'] );
		$instance['latitude'] 			= strip_tags( $new_instance['latitude'] );
		$instance['longitude'] 			= strip_tags( $new_instance['longitude'] );
		$instance['zoom'] 				= (int) $new_instance['zoom'];
		$instance['height'] 			= (int) $new_instance['height'];
		$instance['draggable'] 			= !empty( $new_instance['draggable']) ? true : false;
		$instance['scaleControl'] 		= !empty( $new_instance['scaleControl']) ? true : false;
		$instance['mapTypeControl'] 	= !empty( $new_instance['mapTypeControl']) ? true : false;
		$instance['zoomControl'] 		= !empty( $new_instance['zoomControl']) ? true : false;
		$instance['scrollwheel'] 		= !empty( $new_instance['scrollwheel']) ? true : false;
		$instance['panControl'] 		= !empty( $new_instance['panControl']) ? true : false;



		return $instance;
	}

	public function form( $instance ) {
		$title 				= isset( $instance['title'] ) ? $instance['title'] : 'Google Map';
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$latitude 			= isset( $instance['latitude'] ) ? $instance['latitude'] : '13.95464';
		$longitude 			= isset( $instance['longitude'] ) ? $instance['longitude'] : '101.54774';
		$zoom 				= isset( $instance['zoom'] ) ? absint( $instance['zoom'] ) : 5;
		$height 			= isset( $instance['height'] ) ? absint( $instance['height'] ) : 250;
		$panControl 		= isset( $instance['panControl'] ) ? (bool)$instance['panControl'] : false;
		$scrollwheel 		= isset( $instance['scrollwheel'] ) ? (bool)$instance['scrollwheel'] : false;
		$zoomControl 		= isset( $instance['zoomControl'] ) ? (bool)$instance['zoomControl'] : false;
		$mapTypeControl 	= isset( $instance['mapTypeControl'] ) ?  (bool)$instance['mapTypeControl'] : false;
		$scaleControl 		= isset( $instance['scaleControl'] ) ? (bool)$instance['scaleControl'] : false;
		$draggable 			= isset( $instance['draggable'] ) ? (bool)$instance['draggable']  : false; ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'kho' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo esc_attr($class_wrap); ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php _e( 'Latitude:', 'kho' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'latitude' ); ?>" name="<?php echo $this->get_field_name( 'latitude' ); ?>" type="text" value="<?php echo esc_attr($latitude); ?>" />
			<small><?php _e('Find the latitude', 'kho'); ?> <a href="http://mondeca.com/index.php/en/any-place-en" target="_blank"><?php _e('here', 'kho'); ?></a></small>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'longitude' ); ?>"><?php _e( 'Longitude:', 'kho' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'longitude' ); ?>" name="<?php echo $this->get_field_name( 'longitude' ); ?>" type="text" value="<?php echo esc_attr($longitude); ?>" />
			<small><?php _e('Find the longitude', 'kho'); ?> <a href="http://mondeca.com/index.php/en/any-place-en" target="_blank"><?php _e('here', 'kho'); ?></a></small>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php _e( 'Zoom', 'kho' ); ?></label>
			<input class="widefat"  id="<?php echo $this->get_field_id( 'zoom' ); ?>" name="<?php echo $this->get_field_name( 'zoom' ); ?>" type="text" value="<?php echo esc_attr($zoom); ?>" size="3" />
			<small><?php _e('From 1 to 19, default : 5', 'kho'); ?></small>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'kho' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
		</p>

		<p style="clear: both;">
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'scrollwheel' ); ?>" name="<?php echo $this->get_field_name( 'scrollwheel' ); ?>"<?php checked( $scrollwheel ); ?> />
			<label for="<?php echo $this->get_field_id( 'scrollwheel' ); ?>"><?php _e( 'Enable Scroll Wheel', 'kho' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'panControl' ); ?>" name="<?php echo $this->get_field_name( 'panControl' ); ?>"<?php checked( $panControl ); ?> />
			<label for="<?php echo $this->get_field_id( 'panControl' ); ?>"><?php _e( 'Enable Pan Control', 'kho' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'zoomControl' ); ?>" name="<?php echo $this->get_field_name( 'zoomControl' ); ?>"<?php checked( $zoomControl ); ?> />
			<label for="<?php echo $this->get_field_id( 'zoomControl' ); ?>"><?php _e( 'Enable Zoom Control', 'kho' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'mapTypeControl' ); ?>" name="<?php echo $this->get_field_name( 'mapTypeControl' ); ?>"<?php checked( $mapTypeControl ); ?> />
			<label for="<?php echo $this->get_field_id( 'mapTypeControl' ); ?>"><?php _e( 'Enable Map Type Control', 'kho' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'scaleControl' ); ?>" name="<?php echo $this->get_field_name( 'scaleControl' ); ?>"<?php checked( $scaleControl ); ?> />
			<label for="<?php echo $this->get_field_id( 'scaleControl' ); ?>"><?php _e( 'Enable Scale Control', 'kho' ); ?></label>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'draggable' ); ?>" name="<?php echo $this->get_field_name( 'draggable' ); ?>"<?php checked( $draggable ); ?> />
			<label for="<?php echo $this->get_field_id( 'draggable' ); ?>"><?php _e( 'Enable Draggable', 'kho' ); ?></label>
		</p>

<?php
	}
}