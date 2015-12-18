<?php
/**
 * Testimonial Widget
*/
class uw_testimonial extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_testimonials',
            $name = __( 'UW - Testimonial', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_testimonials_widget',
				'description'	=> __( 'Displays a testimonial slider.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_testimonials_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_testimonials_js'));
			}
		}

    }

	public function uw_testimonials_script() {
		wp_enqueue_style( 'uw-testimonials', uw_plugin_url( 'assets/css/styles/widgets/testimonials.css' ) );
	}

	public function uw_testimonials_js() {
		wp_enqueue_script('uw-testimonials-js', uw_plugin_url( 'assets/js/widgets/testimonials.js' ), UW_VERSION );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 		= apply_filters('widget_title', $instance['title'] );
		$class_wrap = isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$speed 		= $instance['speed'];
		$count 		= $instance['count'];
		$width 		= isset( $instance['width'] ) ? $instance['width']:'';
		$height 	= isset( $instance['height'] ) ? $instance['height']:'';
		$target 	= isset( $instance['target'] ) ? $instance['target']:'';

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
					<?php if($count !== '1') { ?>
						<a href="#" class="uw-testimonial-nav uw-testimonial-prev"><i class="fa fa-angle-left"></i></a>
					<?php } ?>
					<span><?php echo esc_attr( $title ); ?></span>
					<?php if($count !== '1') { ?>
						<a href="#" class="uw-testimonial-nav uw-testimonial-next"><i class="fa fa-angle-right"></i></a>
					<?php } ?>
				</h3>
			<?php } ?>

			<div class="uw-testimonial-slider uw-flexslider" data-slidespeed="<?php echo esc_attr( $speed ); ?>">
				<ul class="uw-ul uw-flex-slides">
					<?php if ( $count !== '0' ) {
						for ( $i=1; $i<=$count; $i++ ) {
							$image_src 		= '';
							$quote 			= isset( $instance["quote_".$i] ) ? $instance["quote_".$i] : '';
							$author_name 	= isset( $instance["author_name_".$i] ) ? $instance["author_name_".$i]:'';
							$company 		= isset( $instance["company_".$i] ) ? $instance["company_".$i]:'';
							$url 			= isset( $instance["url_".$i] ) ? $instance["url_".$i]:'';
							$src 			= isset( $instance["src_".$i] ) ? $instance["src_".$i]:'';
							if(!empty($src)) {
								$image_src 	= uw_image_resize( $src, $width, $height );
							} ?>

							<li>
								<div class="uw-testimonial-entry-content"><span class="uw-testimonial-caret"></span><span><?php echo esc_attr( $quote ); ?></span></div>
							<?php if(!empty($image_src)) { ?>
								<div class="uw-testimonial-entry-thumb"><img class="uw-testimonial-author-image" width="<?php echo esc_attr( $width ); ?>" height="<?php echo esc_attr( $height ); ?>" src="<?php echo esc_url( $image_src['url'] ); ?>" alt="<?php echo esc_attr( $company ); ?>" /></div>
							<?php } ?>
								<div class="uw-testimonial-entry-meta"><span class="uw-testimonial-entry-author"><?php echo esc_attr( $author_name ); ?></span>
								<a class="uw-testimonial-author" href="<?php echo esc_url( $url ); ?>" target="_<?php echo esc_attr( $target ); ?>"><?php echo esc_attr( $company ); ?></a></div>
							</li>

						<?php }
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
		$instance['width'] 		= !empty( $new['width'] ) ? strip_tags( $new['width'] ) : 80;
		$instance['height'] 	= !empty( $new['height'] ) ? strip_tags( $new['height'] ) : 80;
		$instance['target'] 	= !empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["quote_".$i] 			= !empty( $new['quote_'.$i] ) ? strip_tags( $new['quote_'.$i] ) : '';
			$instance["author_name_".$i] 	= !empty( $new['author_name_'.$i] ) ? strip_tags( $new['author_name_'.$i] ) : '';
			$instance["company_".$i] 		= !empty( $new['company_'.$i] ) ? strip_tags( $new['company_'.$i] ) : '';
			$instance["url_".$i] 			= !empty( $new['url_'.$i] ) ? strip_tags( $new['url_'.$i] ) : '';
			$instance["src_".$i] 			= !empty( $new['src_'.$i] ) ? strip_tags( $new['src_'.$i] ) : '';
		}
		return $instance;
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'				=> __('Testimonials','kho'),
			'class_wrap' 		=> '',
			'speed'				=> '7000',
			'count'				=> '3',
			'width'				=> '80',
			'height'			=> '80',
			'target' 			=> 'blank',
		));
		for ( $i=1;$i<=10;$i++ ) {
			$quote 			= 'quote_'.$i;
			$$quote 		= isset( $instance[$quote] ) ? $instance[$quote] : '';
			$src 			= 'src_'.$i;
			$$src 			= isset( $instance[$src] ) ? $instance[$src] : '';
			$author_name 	= 'author_name_'.$i;
			$$author_name 	= isset( $instance[$author_name] ) ? $instance[$author_name] : '';
			$company 		= 'company_'.$i;
			$$company 		= isset( $instance[$company] ) ? $instance[$company] : '';
			$url 			= 'url_'.$i;
			$$url 			= isset( $instance[$url] ) ? $instance[$url] : '';
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
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Link Target:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Testimonials:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $instance['count']; ?>" size="3" />
			<small style="font-size: 11px;"><?php _e( 'Enter a number between 1 to 10', 'kho' ); ?></small>
		</p>

		<div class="testimonial_custom_wrap">
			<?php for ( $i=1;$i<=10;$i++ ): $quote = 'quote_'.$i; $author_name = 'author_name_'.$i; $company = 'company_'.$i; $url = 'url_'.$i; $src = 'src_'.$i; ?>
			<div class="testimonial_custom_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">
				<p>
					<label for="<?php echo $this->get_field_id( $quote ); ?>"><?php printf( '#%s Quote:', $i );?></label>
					<textarea style="width:100%;height:100px;" rows="6" id="<?php echo $this->get_field_id( $quote ); ?>" name="<?php echo $this->get_field_name( $quote ); ?>" ><?php echo esc_attr($$quote); ?></textarea>
				</p>

				<p class="uw-left">
					<label for="<?php echo $this->get_field_id( $author_name ); ?>"><?php printf( '#%s Author Name:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $author_name ); ?>" name="<?php echo $this->get_field_name( $author_name ); ?>" type="text" value="<?php echo esc_attr($$author_name); ?>" />
				</p>

				<p class="uw-right">
					<label for="<?php echo $this->get_field_id( $company ); ?>"><?php printf( '#%s Company:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $company ); ?>" name="<?php echo $this->get_field_name( $company ); ?>" type="text" value="<?php echo esc_attr($$company); ?>" />
				</p>

				<p class="uw-left">
					<label for="<?php echo $this->get_field_id( $src ); ?>"><?php printf( '#%s Author Image URL:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $src ); ?>" name="<?php echo $this->get_field_name( $src ); ?>" type="text" value="<?php echo esc_attr($$src); ?>" />
				</p>

				<p class="uw-right">
					<label for="<?php echo $this->get_field_id( $url ); ?>"><?php printf( '#%s Author Website URL:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo esc_attr($$url); ?>" />
				</p>
			</div>
			<?php endfor;?>
		</div>
	<?php
	}
}