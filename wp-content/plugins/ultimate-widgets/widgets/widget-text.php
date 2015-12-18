<?php
/**
 * Text Widget
*/
class uw_text extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_text',
            $name = __( 'UW - Text', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_text_widget',
				'description'	=> __( 'Displays of text or HTML.', 'kho' )
            )
        );

    }

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title'] );
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$center 	= $instance['center'];
		$text 		= $instance['text'];

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

		if ( $center == '1' ) {
			$center = 'text-align: center';
		} else if ( is_rtl() ) {
			$center = 'text-align: right';
		} else {
			$center = 'text-align: left';
		}

		if ( !empty( $text ) ) {
			echo $before_widget;
				if( $title ) { ?>
					<h3 class="uw-title">
						<span><?php echo esc_attr( $title ); ?></span>
					</h3>
			<?php } ?>
				<div class="text-wrap" style="<?php echo esc_attr( $center ); ?>">
					<?php echo do_shortcode( $text ) ?>
				</div>
			<?php
			echo $after_widget;
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] = strip_tags( $new_instance['class_wrap'] );
		$instance['center'] 	= (int)$new_instance['center'];
		$instance['text'] 		= $new_instance['text'];
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'			=> __('Custom Text','kho'),
			'class_wrap' 	=> '',
			'center'		=> __('Yes','kho'),
			'text'			=> '',
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('center'); ?>"><?php _e( 'Center Content:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('center'); ?>" id="<?php echo $this->get_field_id('center'); ?>">
				<option value="1" <?php if($instance['center'] == '1') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'kho' ); ?></option>
				<option value="0" <?php if($instance['center'] == '0') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'kho'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text, Shortcodes Or HTML Code:' , 'kho') ?></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" class="widefat" style="height: 150px;"><?php if( !empty( $instance['text'] ) ) { echo $instance['text']; } ?></textarea>
		</p>

	<?php
	}
}