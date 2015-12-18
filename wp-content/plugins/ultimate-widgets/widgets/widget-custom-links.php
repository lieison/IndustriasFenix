<?php
/**
 * Custom Links Widget
*/
class uw_custom_links extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_custom_links',
            $name = __( 'UW - Custom Links', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_custom_links_widget',
				'description'	=> __( 'Displays custom links.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_custom_links_script'), 15);
			}
		}

    }

	public function uw_custom_links_script() {
		wp_enqueue_style( 'uw-custom-links', uw_plugin_url( 'assets/css/styles/widgets/custom-links.css' ) );
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title 				= isset($instance['title']) ? $instance['title'] : false;
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$count 				= $instance['count'];
		$target 			= isset( $instance['target'] ) ? $instance['target']:'';

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
			<ul class="uw-custom-links">
				<?php if ( $count !== '0' ) {
					for ( $i=1; $i<=$count; $i++ ) {
						$url 	= isset( $instance["url_".$i] ) ? $instance["url_".$i] : '';
						$text 	= isset( $instance["text_".$i] ) ? $instance["text_".$i]:''; ?>

						<li>
							<a href="<?php echo esc_url( $url ); ?>" target="_<?php echo esc_attr( $target ); ?>"><?php echo esc_attr( $text ); ?></a>
						</li>

					<?php }
				} ?>
			</ul>
		<?php echo $after_widget;

	} 

	/**
	 * update widget settings
	 */	 
	public function update( $new_instance, $old_instance ) {
		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['class_wrap'] 		= strip_tags( $new_instance['class_wrap'] );
		$instance['count'] 				= !empty( $new_instance['count'] ) ? strip_tags( $new_instance['count'] ) : 5;
		$instance['target'] 			= !empty( $new_instance['target'] ) ? strip_tags( $new_instance['target'] ) : 'blank';
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["url_".$i] 		= !empty( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
			$instance["text_".$i] 		= !empty( $new_instance['text_'.$i] ) ? strip_tags( $new_instance['text_'.$i] ) : '';
		}
		return $instance;
	}
		 
	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' 			=> __('Useful Links','kho'),
			'class_wrap' 		=> '',
			'count'				=> '5',
			'target' 			=> 'blank',
		));
		for ( $i=1;$i<=15;$i++ ) {
			$url 			= 'url_'.$i;
			$$url 			= isset( $instance[$url] ) ? $instance[$url] : '';
			$text 			= 'text_'.$i;
			$$text 			= isset( $instance[$text] ) ? $instance[$text] : '';
		} ?>

	    <p>
	    	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Link Target:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of Custom Links:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" class="social_icon_custom_count widefat" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $instance['count']; ?>" size="3" />
			<small style="font-size: 11px;"><?php _e( 'Enter a number between 1 to 15', 'kho' ); ?></small>
		</p>

		<div class="custom_links_wrap">
			<?php for ( $i=1;$i<=15;$i++ ): $url = 'url_'.$i; $text = 'text_'.$i; ?>
			<div class="custom_links_<?php echo $i;?>" <?php if ( $i>$instance['count'] ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">
				<p class="uw-left">
					<label for="<?php echo $this->get_field_id( $url ); ?>"><?php printf( '#%s URL:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo esc_attr($$url); ?>" />
				</p>

				<p class="uw-right">
					<label for="<?php echo $this->get_field_id( $text ); ?>"><?php printf( '#%s Text:', $i );?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( $text ); ?>" name="<?php echo $this->get_field_name( $text ); ?>" type="text" value="<?php echo esc_attr($$text); ?>" />
				</p>
			</div>
			<?php endfor;?>
		</div>
		
	<?php 
	}
}