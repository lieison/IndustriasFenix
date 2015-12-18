<?php
/**
 * Banner Widget
*/
class uw_banner extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_banner',
            $name = __( 'UW - Banner', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_banner_widget',
				'description'	=> __( 'Displays a banner with text.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_banner_script'), 15);
			}
		}

    }

	public function uw_banner_script() {
		wp_enqueue_style( 'uw-banner', uw_plugin_url( 'assets/css/styles/widgets/banner.css' ) );
	}

	// display the widget in the theme
	public function widget( $args, $instance ) {
		extract( $args );
		$title 				= apply_filters('widget_title', $instance['title'] );
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$src 				= isset( $instance['src'] ) ? $instance['src'] : '';
		$image_hover 		= $instance['image_hover'];
		$width 				= $instance['width'];
		$height 			= $instance['height'];
		$content_align 		= isset( $instance['content_align'] ) ? $instance['content_align'] : '';
		$content_position 	= isset( $instance['content_position'] ) ? $instance['content_position'] : '';
		$content 			= $instance['content'];
		$button 			= isset( $instance['button'] ) ? $instance['button'] : '';
		$button_style 		= isset( $instance['button_style'] ) ? $instance['button_style'] : '';
		$button_link 		= isset( $instance['button_link'] ) ? $instance['button_link'] : '';
		$button_target 		= $instance['button_target'];
		$button_text 		= isset( $instance['button_text'] ) ? $instance['button_text'] : '';

		// Class wrap
		if ( '' != $class_wrap ) {
      		$class_widget = $class_wrap;
		} else {
      		$class_widget = uw_option('widgets_style', 'style1');
		}

		// no 'class' attribute
		if( strpos($before_widget, 'class' ) === false ) {
			$before_widget = str_replace('>', 'class="'. $class_widget . '"', $before_widget);
		}
		// there is 'class' attribute
		else {
			$before_widget = str_replace('class="', 'class="'. $class_widget . ' ', $before_widget);
		}

		// Image url
		$image_src 	= uw_image_resize( $src, $width, $height );

		// Classes
		$classes = '';

		// Image hover
		if ( '' != $image_hover && 'none' != $image_hover ) {
      		$classes .= $image_hover;
		}

		// Content align
		if ( 'left' == $content_align ) {
      		$classes .= ' uw-left';
		} else if ( 'center' == $content_align ) {
      		$classes .= ' uw-center';
		} else if ( 'right' == $content_align ) {
      		$classes .= ' uw-right';
		}

		// Content position
		if ( 'top' == $content_position ) {
      		$classes .= '';
		} else if ( 'middle' == $content_position ) {
      		$classes .= ' valign-middle';
		} else if ( 'bottom' == $content_position ) {
      		$classes .= ' valign-bottom';
		}

		// If button
		if ( 'yes' == $button && $button_link ) {
      		$classes .= ' uw-has-button';
		}

		echo $before_widget;
			if($title) { ?>
				<h3 class="uw-title">
					<span><?php echo esc_attr( $title ); ?></span>
				</h3>
			<?php } ?>
			<div class="uw-banner-wrap clr <?php echo esc_attr( $classes ); ?>">
				<div class="uw-banner-content">
					<div class="uw-banner-inner">
						<?php echo do_shortcode( $content ); ?>
					</div>
				</div>
				<?php if ( 'yes' == $button && $button_link ) { ?>
					<div class="uw-button">
						<a class="<?php echo esc_attr( $button_style ); ?>" href="<?php echo esc_attr( $button_link ); ?>" target="_<?php echo esc_attr( $button_target ); ?>"><?php echo esc_attr( $button_text ); ?></a>
					</div>
				<?php } ?>
				<img alt="" src="<?php echo esc_url( $image_src['url'] ); ?>" />
			</div>
		<?php
		echo $after_widget;

	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] 		= strip_tags( $new_instance['class_wrap'] );
		$instance['src'] 				= $new_instance['src'];
		$instance['image_hover'] 		= $new_instance['image_hover'];
		$instance['width'] 				= $new_instance['width'];
		$instance['height'] 			= $new_instance['height'];
		$instance['content_align'] 		= $new_instance['content_align'];
		$instance['content_position'] 	= $new_instance['content_position'];
		$instance['content'] 			= $new_instance['content'];		
		$instance['button'] 			= $new_instance['button'];		
		$instance['button_style'] 		= $new_instance['button_style'];		
		$instance['button_link'] 		= $new_instance['button_link'];		
		$instance['button_target'] 		= $new_instance['button_target'];		
		$instance['button_text'] 		= $new_instance['button_text'];		
		return $instance;
	}
		 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' 			=> __('Banner','kho'),
			'class_wrap' 		=> '',
			'src' 				=> '',
			'image_hover' 		=> __('Fade','kho'),
			'width' 			=> '',
			'height' 			=> '',
			'content_align' 	=> __('Center','kho'),
			'content_position' 	=> __('Middle','kho'),
			'content' 			=> '',
			'button' 			=> __('Yes','kho'),
			'button_style' 		=> '',
			'button_link' 		=> '#',
			'button_target' 	=> 'blank',
			'button_text' 		=> __('Read More','kho'),
		)); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kho') ?></label>
		    <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('src'); ?>"><?php _e('Image Url:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('src'); ?>" name="<?php echo $this->get_field_name('src'); ?>" type="text" value="<?php echo $instance['src']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('image_hover'); ?>"><?php _e( 'Image Hover:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('image_hover'); ?>" id="<?php echo $this->get_field_id('image_hover'); ?>">
				<option value="none" <?php if($instance['image_hover'] == 'none') { ?>selected="selected"<?php } ?>><?php _e( 'None', 'kho' ); ?></option>
				<option value="uw-fade" <?php if($instance['image_hover'] == 'uw-fade') { ?>selected="selected"<?php } ?>><?php _e( 'Fade', 'kho' ); ?></option>
				<option value="uw-grow" <?php if($instance['image_hover'] == 'uw-grow') { ?>selected="selected"<?php } ?>><?php _e( 'Grow', 'kho'); ?></option>
			</select>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Image Width:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $instance['width']; ?>" size="3" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Image Height:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $instance['height']; ?>" size="3" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('content_align'); ?>"><?php _e( 'Content Align:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('content_align'); ?>" id="<?php echo $this->get_field_id('content_align'); ?>">
				<option value="left" <?php if($instance['content_align'] == 'left') { ?>selected="selected"<?php } ?>><?php _e( 'Left', 'kho' ); ?></option>
				<option value="center" <?php if($instance['content_align'] == 'center') { ?>selected="selected"<?php } ?>><?php _e( 'Center', 'kho' ); ?></option>
				<option value="right" <?php if($instance['content_align'] == 'right') { ?>selected="selected"<?php } ?>><?php _e( 'Right', 'kho'); ?></option>
			</select>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('content_position'); ?>"><?php _e( 'Content Position:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('content_position'); ?>" id="<?php echo $this->get_field_id('content_position'); ?>">
				<option value="top" <?php if($instance['content_position'] == 'top') { ?>selected="selected"<?php } ?>><?php _e( 'Top', 'kho' ); ?></option>
				<option value="middle" <?php if($instance['content_position'] == 'middle') { ?>selected="selected"<?php } ?>><?php _e( 'Middle', 'kho' ); ?></option>
				<option value="bottom" <?php if($instance['content_position'] == 'bottom') { ?>selected="selected"<?php } ?>><?php _e( 'Bottom', 'kho'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content:' , 'kho') ?></label>
			<textarea rows="15" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" class="widefat" style="height: 150px;"><?php if( !empty( $instance['content'] ) ) { echo $instance['content']; } ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e( 'Button:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('button'); ?>" id="<?php echo $this->get_field_id('button'); ?>">
				<option value="yes" <?php if($instance['button'] == 'yes') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'kho' ); ?></option>
				<option value="no" <?php if($instance['button'] == 'no') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'kho' ); ?></option>
			</select>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('button_style'); ?>"><?php _e( 'Button Style:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('button_style'); ?>" id="<?php echo $this->get_field_id('button_style'); ?>">
				<option value="black" <?php if($instance['button_style'] == 'black') { ?>selected="selected"<?php } ?>><?php _e( 'Black', 'kho' ); ?></option>
				<option value="blue" <?php if($instance['button_style'] == 'blue') { ?>selected="selected"<?php } ?>><?php _e( 'Blue', 'kho' ); ?></option>
				<option value="brown" <?php if($instance['button_style'] == 'brown') { ?>selected="selected"<?php } ?>><?php _e( 'Brown', 'kho' ); ?></option>
				<option value="green" <?php if($instance['button_style'] == 'green') { ?>selected="selected"<?php } ?>><?php _e( 'Green', 'kho' ); ?></option>
				<option value="gold" <?php if($instance['button_style'] == 'gold') { ?>selected="selected"<?php } ?>><?php _e( 'Gold', 'kho' ); ?></option>
				<option value="pink" <?php if($instance['button_style'] == 'pink') { ?>selected="selected"<?php } ?>><?php _e( 'Pink', 'kho' ); ?></option>
				<option value="purple" <?php if($instance['button_style'] == 'purple') { ?>selected="selected"<?php } ?>><?php _e( 'Purple', 'kho' ); ?></option>
				<option value="red" <?php if($instance['button_style'] == 'red') { ?>selected="selected"<?php } ?>><?php _e( 'Red', 'kho' ); ?></option>
				<option value="white" <?php if($instance['button_style'] == 'white') { ?>selected="selected"<?php } ?>><?php _e( 'White', 'kho' ); ?></option>
				<option value="yellow" <?php if($instance['button_style'] == 'yellow') { ?>selected="selected"<?php } ?>><?php _e( 'Yellow', 'kho' ); ?></option>
			</select>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'button_link' ); ?>"><?php _e('Button Link:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_link' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'button_link' ); ?>" type="text" value="<?php echo $instance['button_link']; ?>" size="3" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('button_target'); ?>"><?php _e( 'Button Target:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('button_target'); ?>" id="<?php echo $this->get_field_id('button_target'); ?>">
				<option value="blank" <?php if($instance['button_target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['button_target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php _e('Button Text:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo $instance['button_text']; ?>" size="3" />
		</p>

	<?php
	}
}