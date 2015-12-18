<?php
/**
 * Slideshow Widget
*/
class uw_slideshow extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_slideshow',
            $name = __( 'UW - Slideshow', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_slideshow_widget',
				'description'	=> __( 'Displays a mini slideshow.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_slideshow_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_slideshow_js'));
			}
		}

    }

	public function uw_slideshow_script() {
		wp_enqueue_style( 'uw-slideshow', uw_plugin_url( 'assets/css/styles/widgets/slideshow.css' ) );
	}

	public function uw_slideshow_js() {
		wp_enqueue_script('uw-slideshow-js', uw_plugin_url( 'assets/js/widgets/slideshow.js' ), UW_VERSION );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title'] );
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$speed 		= $instance['speed'];
		$count 		= $instance['count'];
		$width 		= $instance['width'];
		$height 	= $instance['height'];
		$target 	= $instance['target'];

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

		echo $before_widget; ?>

            <?php if($title) { ?>
				<h3 class="uw-title">
					<?php if($count !== '1') { ?>
						<a href="#" class="uw-slideshow-nav uw-slideshow-prev"><i class="fa fa-angle-left"></i></a>
					<?php } ?>
					<span><?php echo esc_attr( $title ); ?></span>
					<?php if($count !== '1') { ?>
						<a href="#" class="uw-slideshow-nav uw-slideshow-next"><i class="fa fa-angle-right"></i></a>
					<?php } ?>
				</h3>
			<?php } ?>

			<div class="uw-widget-mini-slideshow flexslider" data-slideshow="<?php echo esc_attr( $speed ); ?>">
				<ul class="uw-ul uw-flex-slides">
					<?php if ( $count !== '0' ) {
						for ( $i=1; $i<=$count; $i++ ) {
							$src 		= isset( $instance["src_".$i] ) ? $instance["src_".$i] : '';
							$link 		= isset( $instance["link_".$i] ) ? $instance["link_".$i] : '';
							$image_src 	= uw_image_resize( $src, $width, $height );
							if ( $src !== '' ) { ?>
								<li>
									<?php if ( $link !== '' ) { ?>
										<a href="<?php echo esc_url( $link ); ?>" target="_<?php echo esc_attr( $target ); ?>">
											<img alt="" src="<?php echo esc_url( $image_src['url'] ); ?>" />
										</a>
									<?php } else { ?>
										<img alt="" src="<?php echo esc_url( $image_src['url'] ); ?>" />
									<?php } ?>
								</li>
							<?php }
						}
					} ?>
				</ul>
			</div>

		<?php echo $after_widget;
	}

	public function update( $new, $old ) {
		$instance 				= $old;
		$instance['title'] 		= !empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
		$instance['class_wrap'] = !empty( $new['class_wrap'] ) ? strip_tags( $new['class_wrap'] ) : '';
		$instance['speed'] 		= !empty( $new['speed'] ) ? strip_tags( $new['speed'] ) : 7000;
		$instance['count'] 		= !empty( $new['count'] ) ? strip_tags( $new['count'] ) : 3;
		$instance['width'] 		= !empty( $new['width'] ) ? strip_tags( $new['width'] ) : 320;
		$instance['height'] 	= !empty( $new['height'] ) ? strip_tags( $new['height'] ) : 400;
		$instance['target'] 	= !empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["src_".$i] 	= !empty( $new['src_'.$i] ) ? strip_tags( $new['src_'.$i] ) : '';
			$instance["link_".$i] 	= !empty( $new['link_'.$i] ) ? strip_tags( $new['link_'.$i] ) : '';
		}
		return $instance;
	}

	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'				=> __('Slideshow','kho'),
			'class_wrap' 		=> '',
			'speed'				=> '7000',
			'count'				=> '3',
			'width'				=> '320',
			'height'			=> '400',
			'target' 			=> 'blank'
		));
		for ( $i=1;$i<=10;$i++ ) {
			$src 	= 'src_'.$i;
			$$src 	= isset( $instance[$src] ) ? $instance[$src] : '';
			$link 	= 'link_'.$i;
			$$link 	= isset( $instance[$link] ) ? $instance[$link] : '';
		} ?>

		<p>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'kho'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Image width', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $instance['width']; ?>" size="3" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Image height', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $instance['height']; ?>" size="3" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Slide Speed', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $instance['speed']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('How many slides?', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $instance['count']; ?>" size="3" />
			<small style="font-size: 11px;"><?php _e( 'Between 1 to 10', 'kho' ); ?></small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Link Target:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>

		<div class="slideshow_custom_wrap" style="margin-top:50px;">
			<?php for ( $i=1;$i<=10;$i++ ): $src = 'src_'.$i; $link = 'link_'.$i; ?>
			<div class="slideshow_custom_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:10px">
				<p class="uw-left">
					<label for="<?php echo $this->get_field_id( $src ); ?>"><?php printf( '#%s Image URL:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $src ); ?>" name="<?php echo $this->get_field_name( $src ); ?>" type="text" value="<?php echo esc_attr($$src); ?>" />
				</p>
				<p class="uw-right">
					<label for="<?php echo $this->get_field_id( $link ); ?>"><?php printf( '#%s Image Link:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $link ); ?>" name="<?php echo $this->get_field_name( $link ); ?>" type="text" value="<?php echo esc_attr($$link); ?>" />
				</p>
			</div>
			<?php endfor;?>
		</div>

	<?php
	}
}