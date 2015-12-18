<?php
/**
 * Social Widget
*/
class uw_social extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_social',
            $name = __( 'UW - Social Buttons', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_social_widget',
				'description'	=> __( 'Displays icons with links to your social profiles.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_social_script'), 15);
			}
		}

    }

	public function uw_social_script() {
		wp_enqueue_style( 'uw-social', uw_plugin_url( 'assets/css/styles/widgets/social.css' ) );
	}

	/** @see WP_Widget::widget */
	public function widget($args, $instance) {
		extract($args);
		$title 				= apply_filters('widget_title', $instance['title']);
		$class_wrap 		= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$social_style 		= $instance['social_style'];
		$transition 		= $instance['transition'];
		$target 			= $instance['target'];
		$width 				= isset( $instance['width'] ) ? $instance['width'] : '';
		$height 			= isset( $instance['height'] ) ? $instance['height'] : '';
		$line_height 		= isset( $instance['line_height'] ) ? $instance['line_height'] : '';
		$font_size 			= isset( $instance['font_size'] ) ? $instance['font_size'] : '';
		$border_radius 		= isset( $instance['border_radius'] ) ? $instance['border_radius'] : '';
		$social_services 	= $instance['social_services'];

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
			// Style
			$style = '';
			if ( '73px' != $width && $width ) {
				$style .= 'width: '. $width .';';
			}
			if ( '73px' != $height && $height ) {
				$style .= 'height: '. $height .';';
			}
			if ( '73px' != $line_height && $line_height ) {
				$style .= 'line-height: '. $line_height .';';
			}
			if ( '22px' != $font_size && $font_size ) {
				$style .= 'font-size: '. $font_size .';';
			}
			if ( '2px' != $border_radius && $border_radius ) {
				$style .= '-webkit-border-radius: '. $border_radius .'; -moz-border-radius: '. $border_radius .'; border-radius: '. $border_radius .';';
			} ?>

			<ul class="uw-ul uw-social-widget uw-social-<?php echo esc_attr( $social_style ); ?> <?php echo esc_attr( $transition ); ?>">
				<?php
				// Loop through each social service and display font icon
				foreach( $social_services as $key => $service ) {
					$link = !empty( $service['url'] ) ? $service['url'] : null;
					$name = $service['name'];
					if ( $link ) {
						if ( 'youtube' == $key ) {
							$key = 'youtube-play';
						}
						if ( 'skype' == $key ) {
							$target = 'self';
						} ?>
						<li class="social-widget-<?php echo esc_attr( $key ); ?>">
							<a href="<?php if('skype' == $key) { ?>skype:<?php echo esc_attr( $link ); ?>?call<?php } else { echo esc_url( $link ); } ?>" title="<?php echo esc_attr( $name ); ?>" target="_<?php echo esc_attr( $target ); ?>" style="<?php echo esc_attr( $style ); ?>">
								<i class="fa fa-<?php echo esc_attr( $key ); ?>"></i>
							</a>
						</li>
					<?php }
				} ?>
			</ul>
		<?php
		echo $after_widget;
	}

	/** @see WP_Widget::update */
	public function update( $new, $old ) {
		$instance = $old;
		$instance['title'] 				= !empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
		$instance['class_wrap'] 		= !empty( $new['class_wrap'] ) ? strip_tags( $new['class_wrap'] ) : '';
		$instance['social_style'] 		= !empty( $new['social_style'] ) ? strip_tags( $new['social_style'] ) : 'color';
		$instance['transition'] 		= !empty( $new['transition'] ) ? strip_tags( $new['transition'] ) : 'rotate';
		$instance['target'] 			= !empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
		$instance['width'] 				= !empty( $new['width'] ) ? strip_tags( $new['width'] ) : '';
		$instance['height'] 			= !empty( $new['height'] ) ? strip_tags( $new['height'] ) : '';
		$instance['line_height'] 		= !empty( $new['line_height'] ) ? strip_tags( $new['line_height'] ) : '';
		$instance['font_size'] 			= !empty( $new['font_size'] ) ? strip_tags( $new['font_size'] ) : '';
		$instance['border_radius'] 		= !empty( $new['border_radius'] ) ? strip_tags( $new['border_radius'] ) : '';
		$instance['social_services'] 	= $new['social_services'];
		return $instance;
	}

	/** @see WP_Widget::form */
	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'				=> __('Follow Us','kho'),
			'class_wrap' 		=> '',
			'social_style'		=> __('Color','kho'),
			'transition'		=> __('Rotate','kho'),
			'target' 			=> 'blank',
			'width' 			=> '',
			'height' 			=> '',
			'line_height' 		=> '',
			'font_size' 		=> '',
			'border_radius' 	=> '',
			'social_services'	=> array(
				'behance' 		=> array(
					'name'		=> 'Behance',
					'url'		=> ''
				),
				'codepen'		=> array(
					'name'		=> 'CodePen',
					'url'		=> ''
				),
				'deviantart'	=> array(
					'name'		=> 'deviantART',
					'url'		=> ''
				),	
				'dribbble'		=> array(
					'name'		=> 'Dribbble',
					'url'		=> ''
				),
				'facebook'		=> array(
					'name'		=> 'Facebook',
					'url'		=> ''
				),
				'flickr'			=> array(
					'name'		=> 'Flickr',
					'url'		=> ''
				),
				'github'		=> array(
					'name'		=> 'GitHub',
					'url'		=> ''
				),
				'google-plus'	=> array(
					'name'		=> 'GooglePlus',
					'url'		=> ''
				),
				'instagram'		=> array(
					'name'		=> 'Instagram',
					'url'		=> ''
				),
				'linkedin' 		=> array(
					'name'		=> 'LinkedIn',
					'url'		=> ''
				),
				'pinterest' 	=> array(
					'name'		=> 'Pinterest',
					'url'		=> ''
				),
				'tumblr' 		=> array(
					'name'		=> 'Tumblr',
					'url'		=> ''
				),
				'twitter' 		=> array(
					'name'		=> 'Twitter',
					'url'		=> ''
				),
				'skype' 		=> array(
					'name'		=> 'Skype',
					'url'		=> ''
				),
				'stack-overflow'=> array(
					'name'		=> 'Stack Overflow',
					'url'		=> ''
				),
				'soundcloud'	=> array(
					'name'		=> 'SoundCloud',
					'url'		=> ''
				),
				'youtube' 		=> array(
					'name'		=> 'Youtube',
					'url'		=> ''
				),
				'reddit' 		=> array(
					'name'		=> 'Reddit',
					'url'		=> ''
				),
				'rss' 			=> array(
					'name'		=> 'RSS',
					'url'		=> ''
				),
				'vimeo-square'	=> array(
					'name'		=> 'Vimeo',
					'url'		=> ''
				),
				'vine'			=> array(
					'name'		=> 'Vine',
					'url'		=> ''
				),
			),
		)); ?>

		<script type="text/javascript" >
            jQuery(document).ready(function($) {
				$(document).ajaxSuccess(function(e, xhr, settings) {
					var widget_id_base = 'uw_social';
					if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
						uwSocialSortServices();
					}
				});
				function uwSocialSortServices() {
					$('.uw-services-list').each( function() {
						var id = $(this).attr('id');
						$('#'+ id).sortable({
							placeholder: "placeholder",
							opacity: 0.6
						});
					});
				}
				uwSocialSortServices();
			});
        </script>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','kho'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo $instance['class_wrap']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('social_style'); ?>"><?php _e('Style', 'kho'); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('social_style'); ?>" id="<?php echo $this->get_field_id('social_style'); ?>">
				<option value="light" <?php if($instance['social_style'] == 'light') { ?>selected="selected"<?php } ?>><?php _e( 'Light', 'kho' ); ?></option>
				<option value="color" <?php if($instance['social_style'] == 'color') { ?>selected="selected"<?php } ?>><?php _e( 'Color', 'kho' ); ?></option>
				<option value="3d" <?php if($instance['social_style'] == '3d') { ?>selected="selected"<?php } ?>><?php _e( '3D', 'kho' ); ?></option>
				<option value="just-icons" <?php if($instance['social_style'] == 'just-icons') { ?>selected="selected"<?php } ?>><?php _e( 'Just Icons', 'kho' ); ?></option>
			</select>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('transition'); ?>"><?php _e('Transition:', 'kho'); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('transition'); ?>" id="<?php echo $this->get_field_id('transition'); ?>">
				<option value="float" <?php if($instance['transition'] == 'float') { ?>selected="selected"<?php } ?>><?php _e( 'Float', 'kho' ); ?></option>
				<option value="rotate" <?php if($instance['transition'] == 'rotate') { ?>selected="selected"<?php } ?>><?php _e( 'Rotate', 'kho' ); ?></option>
				<option value="zoomout" <?php if($instance['transition'] == 'zoomout') { ?>selected="selected"<?php } ?>><?php _e( 'Zoom Out', 'kho' ); ?></option>
			</select>
		</p>
		
		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Link Target:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
				<option value="blank" <?php if($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'kho' ); ?></option>
				<option value="self" <?php if($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'kho'); ?></option>
			</select>
		</p>
		
		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" placeholder="<?php _e( '73px','kho' ); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" placeholder="<?php _e( '73px','kho' ); ?>" value="<?php echo $instance['height']; ?>" />
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id( 'line_height' ); ?>"><?php _e('Line Height:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'line_height' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'line_height' ); ?>" type="text" placeholder="<?php _e( '73px','kho' ); ?>" value="<?php echo $instance['line_height']; ?>" />
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id( 'font_size' ); ?>"><?php _e('Font Size:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'font_size' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'font_size' ); ?>" type="text" placeholder="<?php _e( '22px','kho' ); ?>" value="<?php echo $instance['font_size']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'border_radius' ); ?>"><?php _e('Border Radius:', 'kho'); ?></label>
			<input id="<?php echo $this->get_field_id( 'border_radius' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'border_radius' ); ?>" type="text" placeholder="<?php _e( '2px','kho' ); ?>" value="<?php echo $instance['border_radius']; ?>" />
		</p>

		<h3 style="margin-top:20px;margin-bottom:5px;clear: both;"><?php _e( 'Social Links','kho' ); ?></h3>  
		<small style="display:block;margin-bottom:10px;"><?php _e('Enter the full URL to your social profile','kho'); ?></small>
		<ul id="<?php echo $this->get_field_id( 'social_services' ); ?>" class="uw-services-list">
			<input type="hidden" id="<?php echo $this->get_field_name( 'social_services' ); ?>" value="<?php echo $this->get_field_name( 'social_services' ); ?>">
			<input type="hidden" id="<?php echo wp_create_nonce('uw_social_nonce'); ?>">
			<?php
			$social_services = $instance['social_services'];
			foreach( $social_services as $key => $service ) {
				$url=0;
				if(isset($service['url'])) $url = $service['url'];
				if(isset($service['name'])) $name = $service['name']; ?>
				<li class="<?php echo $this->get_field_id( 'social_services' ); ?>">
					<p>
						<label for="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-name"><?php echo $name; ?>:</label>
						<input type="hidden" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][name]'; ?>" value="<?php echo $name; ?>">
						<input type="url" class="widefat" id="<?php echo $this->get_field_id( 'social_services' ); ?>-<?php echo $key ?>-url" name="<?php echo $this->get_field_name( 'social_services' ).'['.$key.'][url]'; ?>" value="<?php echo $url; ?>" />
					</p>
				</li>
			<?php } ?>
		</ul>
		
	<?php
	}
}