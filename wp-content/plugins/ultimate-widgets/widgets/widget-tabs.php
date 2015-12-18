<?php
/**
 * Tabs Widget
*/
class uw_tabs extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_tabs',
            $name = __( 'UW - Tabs', 'kho' ),
            array(
                'description'	=> __( 'Displays Recent, Comments and Tags.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_tabs_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_tabs_js'));
			}
		}

    }

	public function uw_tabs_script() {
		wp_enqueue_style( 'uw-tabs', uw_plugin_url( 'assets/css/styles/widgets/tabs.css' ) );
	}

	public function uw_tabs_js() {
		wp_enqueue_script('uw-tabs-js', uw_plugin_url( 'assets/js/widgets/tabs.js' ), UW_VERSION );
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$posts_number 	= $instance['posts_number']; ?>

		<div class="uw_tabs_widget">
			<div class="uw-top">
				<ul class="uw-posts-tabs uw-ul">
				<?php
					$tabs_order = 'r,c,t';
					if( !empty( $instance['tabs_order'] ) ){
						$tabs_order = $instance['tabs_order'];
					}
					$tabs_order_array = explode( ',' , $tabs_order );
					foreach ( $tabs_order_array as $tab ){
											
						if( $tab == 'r' ) {
							echo '<li class="uw-tabs"><a href="#uw-tab1">'. __( 'Recent' ) .'</a></li>';	
						}
							
						if( $tab == 'c' ) {
							echo '<li class="uw-tabs"><a href="#uw-tab2">'. __( 'Comments' ) .'</a></li>';	
						}
							
						if( $tab == 't' ) {
							echo '<li class="uw-tabs"><a href="#uw-tab3">'. __( 'Tags' ) .'</a></li>';
						}
					}
				?>
				</ul>
			</div>
			
			<?php foreach ( $tabs_order_array as $tab ) {
			
			if( $tab == 'r' ) : ?>
				<div id="uw-tab1" class="uw-tabs-wrap">
					<ul>
						<?php uw_last_posts( $posts_number )?>	
					</ul>
				</div>
			<?php endif; 
			
			if( $tab == 'c' ) : ?>
				<div id="uw-tab2" class="uw-tabs-wrap">
					<ul>
						<?php uw_most_commented( $posts_number );?>
					</ul>
				</div>
			<?php endif;
			
			if( $tab == 't' ) : ?>
				<div id="uw-tab3" class="uw-tabs-wrap uw-tagcloud">
					<?php wp_tag_cloud( $args = array('largest' => 8,'number' => 25,'orderby'=> 'count', 'order' => 'DESC' )); ?>
				</div>
			<?php endif; } ?>

		</div>
	<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['posts_number'] 	= strip_tags( $new_instance['posts_number'] );
		$instance['tabs_order'] 	= strip_tags( $new_instance['tabs_order'] );
		return $instance;
	}

	public function form( $instance ) {
		$uw_random_id 	= substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
		$id 			= explode("-", $this->get_field_id("widget_id"));
		$widget_id 		=  $id[1]. "-"  .$uw_random_id;
		$instance 		= wp_parse_args( (array) $instance, array( 'posts_number' => 5 )); ?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$( "#<?php echo esc_attr($widget_id); ?>-order" ).sortable({
					placeholder: "placeholder",
					stop: function(event, ui) {
						var data = "";

						$( "#<?php echo esc_attr($widget_id) ?>-order li" ).each(function(i, el){
							var p = jQuery( this ).data( 'tab' );
							data += p+",";
						});

						$("#<?php echo esc_attr($widget_id) ?>-tabs-order").val(data.slice(0, -1));
					}
				});
			});
		</script>
		
		<div id="<?php echo esc_attr($widget_id) ?>-tabs">
			<p>
				<label for="<?php echo $this->get_field_id( 'tabs_order' ); ?>"><?php _e( 'Order Of Tabs:' , 'kho') ?></label>
				<?php if( $id[2] == '__i__' ) echo '<p style="background-color: #ffe9e9;padding: 5px;color: #D04544;border: 1px solid #E7A9A9;" class"uw_message_hint">'. __( "click Save button to be able to change the order of tabs ." , "kho").'</p>'?>
				
				<input id="<?php echo $widget_id ?>-tabs-order" name="<?php echo $this->get_field_name( 'tabs_order' ); ?>" value="<?php if( !empty($instance['tabs_order']) ) echo $instance['tabs_order']; ?>" type="hidden" />

				<ul id="<?php echo $widget_id ?>-order" class="tab_sortable" <?php if( $id[2] == '__i__' ) echo 'style="opacity:.5;"'?>>
				<?php
					$tabs_order = 'r,c,t';
					if( !empty( $instance['tabs_order'] ) ){
						$tabs_order = $instance['tabs_order'];
					}
					$tabs_order_array = explode( ',' , $tabs_order );
					foreach ( $tabs_order_array as $tab ){
			
						if( $tab == 'r' ) {
							echo '<li data-tab="r"> '. __( "Recent" ) .' </li>';
						}
							
						if( $tab == 'c' ) {
							echo '<li data-tab="c"> '. __( "Comments" ) .' </li>';
						}
							
						if( $tab == 't' ) {
							echo '<li data-tab="t"> '. __( "Tags" ) .' </li>';
						}
					}
				?>
				</ul>
			</p>	
		</div>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_number' ); ?>"><?php _e( 'Number Of Items To Show:' , 'kho') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" value="<?php if( !empty($instance['posts_number']) ) echo $instance['posts_number']; ?>" size="3" type="text" />
		</p>

	<?php
	}
}