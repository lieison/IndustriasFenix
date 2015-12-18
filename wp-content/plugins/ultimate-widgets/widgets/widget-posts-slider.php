<?php
/**
 * Posts Slider Widget
*/
class uw_posts_slider extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_posts_slider',
            $name = __( 'UW - Posts Slider', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_slider_widget',
				'description'	=> __( 'Displays a posts slider.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_posts_slider_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_posts_slider_js'));
			}
		}

    }

	public function uw_posts_slider_script() {
		wp_enqueue_style( 'uw-posts-slider', uw_plugin_url( 'assets/css/styles/widgets/posts-slider.css' ) );
	}

	public function uw_posts_slider_js() {
		wp_enqueue_script('uw-posts-slider-js', uw_plugin_url( 'assets/js/widgets/posts-slider.js' ), UW_VERSION );
	}

	/** @see WP_Widget::widget */
	public function widget($args, $instance) {
		extract( $args );
		$title 			= apply_filters('widget_title', $instance['title'] );
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$number 		= $instance['number'];
		$speed 			= ( !empty( $instance['speed'] ) ) ? intval( $instance['speed'] ) : '7000';
		$order 			= $instance['order'];
		$img_width 		= ( !empty( $instance['img_width'] ) ) ? intval( $instance['img_width'] ) : '320';
		$img_height 	= ( !empty( $instance['img_height'] ) ) ? intval( $instance['img_height'] ) : '400';
		$post_type 		= $instance['post_type'];

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
			<div class="uw-posts-slider flexslider" data-slideshow="<?php echo esc_attr( $speed ); ?>">
				<ul class="uw-ul uw-widget-posts-slider uw-flex-slides slides clr">
				<?php
					global $post;
					$args = array(
						'post_type'			=> $post_type,
						'numberposts'		=> $number,
						'orderby'			=> $order,
						'no_found_rows'		=> true,
						'suppress_filters'	=> false,
						'meta_key'			=> '_thumbnail_id',
					);
					$myposts = get_posts( $args );
					foreach( $myposts as $post ) : setup_postdata($post);
					if( has_post_thumbnail() ) {
						$featured_image = uw_image_resize( wp_get_attachment_url( get_post_thumbnail_id() ), $img_width, $img_height ); ?>
						<li class="uw-posts-slider-li">
							<div class="uw-posts-slider-wrap">
								<div class="uw-info-wrap">
									<span class="uw-posts-slider-comments"><i class="icon_comment_alt"></i><?php comments_popup_link( __( '0', 'kho' ), __( '1',  'kho' ), __( '%', 'kho' ), 'uw-comments-link' ); ?></span>
								</div>
								<?php if ( $number !== '1' ) { ?>
									<ul class="uw-posts-slider-nav">
										<li><a href="#" class="uw-posts-prev"><i class="fa fa-angle-left"></i></a></li>
										<li><a href="#" class="uw-posts-next"><i class="fa fa-angle-right"></i></a></li>
									</ul>
								<?php } ?>
								<a href="<?php the_permalink(); ?>" class="uw-posts-slider-image"><img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php the_title(); ?>" /></a>
								<div class="uw-posts-slider-desc">
									<a href="<?php the_permalink(); ?>" class="uw-posts-slider-title" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</div>
							</div>
						</li>
					<?php
					} endforeach; wp_reset_postdata(); ?>
				</ul>
			</div>

	<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	public function update($new_instance, $old_instance) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['class_wrap'] 	= strip_tags($new_instance['class_wrap']);
		$instance['number'] 		= strip_tags($new_instance['number']);
		$instance['speed'] 			= strip_tags($new_instance['speed']);
		$instance['order'] 			= strip_tags($new_instance['order']);
		$instance['img_width'] 		= strip_tags($new_instance['img_width']);
		$instance['img_height'] 	= strip_tags($new_instance['img_height']);
		$instance['post_type'] 		= strip_tags($new_instance['post_type']);
		return $instance;
	}

	/** @see WP_Widget::form */
	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'			=> __('Posts Slider','kho' ),
			'class_wrap' 	=> '',
			'post_type'		=> 'post',
			'number'		=> '3',
			'speed'			=> '7000',
			'order'			=> 'ASC',
			'img_width'		=> '320',
			'img_height'	=> '400',
		)); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','kho' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>
		
		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e( 'Post Type?', 'kho' ); ?></label> 
			<select class='uw-select widefat' name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
				<option value="post" <?php if($instance['post_type'] == 'post') { ?>selected="selected"<?php } ?>><?php _e( 'Post', 'kho' ); ?></option>
				<?php
				//get post_typeonomies
				$args=array('public' => true,'_builtin' => false, 'exclude_from_search' => false); 
				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
				$get_post_types = get_post_types($args,$output,$operator);
				foreach ($get_post_types as $get_post_type ) {
					if( $get_post_type != 'post' && $get_post_type !== 'faq' ){ ?>
					<option value="<?php echo $get_post_type; ?>" id="<?php $get_post_type; ?>" <?php if($instance['post_type'] == $get_post_type) { ?>selected="selected"<?php } ?>><?php echo ucfirst( $get_post_type ); ?></option>
				<?php } } ?>
			</select>
		</p>
		
		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e( 'Random or Recent?', 'kho' ); ?></label>
			<select class='uw-select widefat' name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
				<option value="ASC" <?php if($instance['order'] == 'ASC') { ?>selected="selected"<?php } ?>><?php _e( 'Recent', 'kho' ); ?></option>
				<option value="rand" <?php if($instance['order'] == 'rand') { ?>selected="selected"<?php } ?>><?php _e( 'Random', 'kho' ); ?></option>
				<option value="comment_count" <?php if($instance['order'] == 'comment_count' ) { ?>selected="selected"<?php } ?>><?php _e( 'Most Comments', 'kho' ); ?></option>
				<option value="modified" <?php if($instance['order'] == 'modified' ) { ?>selected="selected"<?php } ?>><?php _e( 'Last Modified', 'kho' ); ?></option>
			</select>
		</p>
		
		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number to Show', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Slide Speed', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $instance['speed']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e( 'Image Width', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo $instance['img_width']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('img_height'); ?>"><?php _e( 'Image Height', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo $instance['img_height']; ?>" />
		</p>
		
		<?php
	}

}