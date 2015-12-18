<?php
/**
 * Soundcloud Widget
*/
class uw_soundcloud extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_soundcloud',
            $name = __( 'UW - Soundcloud', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_soundcloud_widget',
				'description'	=> __( 'Adds a Soundcloud player.', 'kho' )
            )
        );

    }

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title'] );
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$url 		= isset( $instance['url'] ) ? $instance['url'] : '';
		$height 	= isset( $instance['height'] ) ? $instance['height'] : '300';
		$autoplay 	= $instance['autoplay'];
		$play 		= 'false';
		if( !empty( $autoplay )) $play = 'true';

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
			<iframe width="100%" height="<?php echo esc_attr( $height ); ?>" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo esc_url( $url ); ?>&amp;auto_play=<?php echo esc_attr( $play ); ?>&amp;show_artwork=true&amp;show_user=true&amp;visual=true"></iframe>
		<?php
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] = strip_tags( $new_instance['class_wrap'] );
		$instance['url'] 		= $new_instance['url'];
		$instance['height'] 	= $new_instance['height'] ;
		$instance['autoplay'] 	= strip_tags( $new_instance['autoplay'] );
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' 		=> 'SoundCloud',
			'class_wrap' 	=> '',
			'url' 			=> '',
			'height' 		=> '300',
			'play' 			=> '',
			'autoplay' 		=> ''  
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>
		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e('URL :', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" value="<?php echo $instance['url']; ?>" type="text" class="widefat" />
		</p>
		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height :', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo $instance['height']; ?>" type="text" class="widefat" />
		</p>
		<p style="clear: both;">
			<input id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>" value="true" <?php if( $instance['autoplay'] ) echo 'checked="checked"'; ?> type="checkbox" />
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>"><?php _e('Autoplay', 'kho'); ?></label>
		</p>
	<?php
	}
}