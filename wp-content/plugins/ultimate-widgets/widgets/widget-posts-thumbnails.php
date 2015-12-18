<?php
/**
 * Recent Post Widget
*/
class uw_recent_posts_thumb extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_recent_posts_thumb',
            $name = __( 'UW - Posts Thumbnails', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_thumb_widget',
				'description'	=> __( 'Shows a listing of your recent or random posts.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_posts_thumbnails_script'), 15);
			}
		}

    }

	public function uw_posts_thumbnails_script() {
		wp_enqueue_style( 'uw-posts-thumbnails', uw_plugin_url( 'assets/css/styles/widgets/posts-thumbnails.css' ) );
	}

	/** @see WP_Widget::widget */
	public function widget($args, $instance) {
		extract( $args );
		$title 			= apply_filters('widget_title', $instance['title'] );
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$number 		= $instance['number'];
		$style 			= $instance['style'];
		$order 			= $instance['order'];
		$img_height 	= ( !empty( $instance['img_height'] ) ) ? intval( $instance['img_height'] ) : '65';
		$img_width 		= ( !empty( $instance['img_width'] ) ) ? intval( $instance['img_width'] ) : '65';
		$image 			= isset( $instance['image'] ) ? $instance['image'] : '';
		$infowrap 		= isset( $instance['infowrap'] ) ? $instance['infowrap'] : '';
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
			<?php }

			if($style == 'fullimg' || $style == 'fullinfoinside') {
				$class = ' full';
			} else {
				$class = '';
			} ?>
			<ul class="uw-ul uw-widget-recent-posts clr style-<?php echo esc_attr( $style ); ?><?php echo esc_attr( $class ); ?>">
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
						<li class="uw-widget-recent-posts-li">
							<?php if ( $style == 'fullinfoinside' ) { ?><div class="uw-fullinfo-wrap"><?php } ?>
								<?php if ( $infowrap !== '1' && $style == 'fullinfoinside' ) { ?>
									<div class="uw-widget-info-wrap">
										<div class="uw-widget-recent-posts-date"><i class="icon_clock_alt"></i><?php echo get_the_date(); ?></div>
										<div class="uw-widget-recent-posts-comments"><i class="icon_comment_alt"></i><?php comments_popup_link( __( '0', 'kho' ), __( '1',  'kho' ), __( '%', 'kho' ), 'comments-link' ); ?></div>
									</div>
								<?php } ?>
								<?php if ( $image !== '1' ) { ?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="uw-widget-recent-posts-thumbnail">
										<img src="<?php echo esc_url( $featured_image['url'] ); ?>" alt="<?php the_title(); ?>" />
									</a>
								<?php } ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="uw-widget-recent-posts-title"><?php the_title(); ?></a>
								<?php if ( $infowrap !== '1' && $style !== 'fullinfoinside' ) { ?>
									<div class="uw-widget-info-wrap">
										<div class="uw-widget-recent-posts-date"><i class="icon_clock_alt"></i><?php echo get_the_date(); ?></div>
										<div class="uw-widget-recent-posts-comments"><i class="icon_comment_alt"></i><?php comments_popup_link( __( '0', 'kho' ), __( '1',  'kho' ), __( '%', 'kho' ), 'comments-link' ); ?></div>
									</div>
								<?php } ?>
							<?php if ( $style == 'fullinfoinside' ) { ?></div><?php } ?>
						</li>
				<?php
				} endforeach; wp_reset_postdata(); ?>
			</ul>
		<?php echo $after_widget;
	}

	/** @see WP_Widget::update */
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['class_wrap'] 	= strip_tags($new_instance['class_wrap']);
		$instance['number'] 		= strip_tags($new_instance['number']);
		$instance['style'] 			= strip_tags($new_instance['style']);
		$instance['order'] 			= strip_tags($new_instance['order']);
		$instance['img_height'] 	= strip_tags($new_instance['img_height']);
		$instance['img_width'] 		= strip_tags($new_instance['img_width']);
		$instance['image'] 			= strip_tags($new_instance['image']);
		$instance['infowrap'] 		= strip_tags($new_instance['infowrap']);
		$instance['post_type'] 		= strip_tags($new_instance['post_type']);
		return $instance;
	}

	/** @see WP_Widget::form */
	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'			=> __('Recent Posts','kho' ),
			'class_wrap' 	=> '',
			'style'			=> 'default',
			'post_type'		=> 'post',
			'number'		=> '3',
			'order'			=> 'ASC',
			'image'			=> '',
			'infowrap'		=> '',
			'img_height'	=> '65',
			'img_width'		=> '65',
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
			<label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Style', 'kho' ); ?></label>
			<br />
			<select class='uw-select widefat' name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
				<option value="default" <?php if($instance['style'] == 'default') { ?>selected="selected"<?php } ?>><?php _e( 'Small Image', 'kho' ); ?></option>
				<option value="fullimg" <?php if($instance['style'] == 'fullimg') { ?>selected="selected"<?php } ?>><?php _e( 'Full Image', 'kho' ); ?></option>
				<option value="fullinfoinside" <?php if($instance['style'] == 'fullinfoinside') { ?>selected="selected"<?php } ?>><?php _e( 'Full & Info Inside', 'kho' ); ?></option>
			</select>
		</p>
		
		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e( 'Post Type?', 'kho' ); ?></label> 
			<br />
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
		
		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e( 'Random or Recent?', 'kho' ); ?></label>
			<br />
			<select class='uw-select widefat' name="<?php echo $this->get_field_name('order'); ?>" id="<?php echo $this->get_field_id('order'); ?>">
				<option value="ASC" <?php if($instance['order'] == 'ASC') { ?>selected="selected"<?php } ?>><?php _e( 'Recent', 'kho' ); ?></option>
				<option value="rand" <?php if($instance['order'] == 'rand') { ?>selected="selected"<?php } ?>><?php _e( 'Random', 'kho' ); ?></option>
				<option value="comment_count" <?php if($instance['order'] == 'comment_count' ) { ?>selected="selected"<?php } ?>><?php _e( 'Most Comments', 'kho' ); ?></option>
				<option value="modified" <?php if($instance['order'] == 'modified' ) { ?>selected="selected"<?php } ?>><?php _e( 'Last Modified', 'kho' ); ?></option>
			</select>
		</p>
		
		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number to Show', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e( 'Image Width', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_width'); ?>" name="<?php echo $this->get_field_name('img_width'); ?>" type="text" value="<?php echo $instance['img_width']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('img_height'); ?>"><?php _e( 'Image Height', 'kho' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('img_height'); ?>" name="<?php echo $this->get_field_name('img_height'); ?>" type="text" value="<?php echo $instance['img_height']; ?>" />
		</p>

		<p style="clear: both;">
			<input id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['image'] ); ?> />
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e( 'Disable Featured Image?', 'kho' ); ?></label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('infowrap'); ?>" name="<?php echo $this->get_field_name('infowrap'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['infowrap'] ); ?> />
			<label for="<?php echo $this->get_field_id('infowrap'); ?>"><?php _e( 'Disable Date & Comments ?', 'kho' ); ?></label>
		</p>
		
		<?php
	}


}