<?php
/**
 * Login Widget
*/
class uw_login extends WP_Widget {

	public function __construct() {

        parent::__construct(
            'uw_login',
            $name = __( 'UW - Login', 'kho' ),
            array(
                'classname'		=> 'uw_widget_wrap uw_login_widget',
				'description'	=> __( 'Displays Login/Register Form.', 'kho' )
            )
        );

        if ( is_active_widget(false, false, $this->id_base) ) {
			if ( '1' !== uw_option( 'minify_css', '1' ) ) {
				add_action( 'wp_enqueue_scripts', array(&$this,'uw_login_script'), 15);
			}
			if ( '1' !== uw_option( 'minify_js', '1' ) ) {
				add_action( 'wp_footer', array(&$this,'uw_login_js'));
			}
		}

    }

	public function uw_login_script() {
		wp_enqueue_style( 'uw-login', uw_plugin_url( 'assets/css/styles/widgets/login.css' ) );
	}

	public function uw_login_js() {
		wp_enqueue_script('uw-login-js', uw_plugin_url( 'assets/js/widgets/login.js' ), UW_VERSION );
	}
	
	// display the widget in the theme
	public function widget($args, $instance) {
		extract($args);
		$title 			= apply_filters('widget_title', $instance['title']);
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$redirect 		= $instance['redirect'];
		$title_logged 	= $instance['title_logged'];
		$display_avatar = $instance['display_avatar'];
		$avatar_link 	= $instance['avatar_link'];
		$username_link 	= $instance['username_link'];
		$user_menu 		= $instance['user_menu'];
		$logout 		= $instance['logout'];

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

			<?php // Var
			global $current_user;
	      	get_currentuserinfo();

	      	// Url redirect
	      	if ( $redirect ) {
	      		$redirect_to = $redirect;
			} else {
	      		$redirect_to = home_url( '/' );
			}

			// Avatar link
	      	if ( $avatar_link ) {
	      		$a_link = $avatar_link;
			} else if ( $avatar_link == "#" ) {
				$a_link = '';
			} else {
	      		$a_link = admin_url( 'profile.php' );
			}

			// Username link
	      	if ( $username_link ) {
	      		$u_link = $username_link;
			} else if ( $username_link == "#" ) {
				$u_link = '';
			} else {
	      		$u_link = admin_url( 'profile.php' );
			} ?>
				<?php if( $title && !is_user_logged_in() ) { ?>
					<h3 class="uw-title">
						<span><?php echo esc_attr( $title ); ?></span>
					</h3>
				<?php } else if( $title_logged && is_user_logged_in() ) { ?>
					<h3 class="uw-title">
						<span><?php echo esc_attr( $title_logged ); ?></span>
					</h3>
				<?php } ?>

			<?php if ( is_user_logged_in() ) { ?>
				<div class="uw_logged_in">
					<?php if ( $display_avatar == '1' ) { ?>
						<div class="uw-user-avatar">
							<?php if ( $avatar_link !== "#" ) { ?><a href="<?php echo esc_url( $a_link ); ?>"><?php } ?>
								<?php echo get_avatar( $current_user->ID, apply_filters( 'uw_login_avatar_size', 250 ) ); ?>
							<?php if ( $avatar_link !== "#" ) { ?></a><?php } ?>
						</div>
					<?php } ?>
					<div class="uw-user-content">
						<h2 class="title">
							<?php if ( $username_link !== "#" ) { ?><a href="<?php echo esc_url( $u_link ); ?>"><?php } ?>
								<?php echo $current_user->display_name; ?>
							<?php if ( $username_link !== "#" ) { ?></a><?php } ?>
						</h2>
						<?php if($user_menu != '0') { ?>
							<ul>
								<?php wp_nav_menu( array(
									'menu'				=> $user_menu,
									'container'       	=> false,
									'fallback_cb'		=> false,
									'items_wrap'      	=> '%3$s',
									'depth'           	=> 0,
									'walker'          	=> new UW_Dropdown_Walker_Nav_Menu()
								)); ?>
							</ul>
						<?php }
						if ( $logout == '1' ) { ?>
							<div class="uw-link uw-logout">
								<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Logout', 'kho' ); ?></a>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<form name="loginform" class="uw-loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
					<div class="uw-form-wrap">
						<label for="user_login" class="label"><?php _e( 'Username', 'kho' ); ?></label>
						<input type="text" name="log" class="user_login input" value="" size="20">
					</div>
					<div class="uw-form-wrap">
						<label for="user_pass" class="label"><?php _e( 'Password', 'kho' ); ?><a href="#" class="uw-lost-link"><?php _e( "forget?", 'kho' ); ?></a></label>
						<div class="input-append">
							<input type="password" name="pwd" class="user_pass input" value="" size="20">
							<div class="show-pass">
								<input name="show-password" type="checkbox" role="checkbox" tabindex="0" class="show-password" value="1">
								<label for="show-password" title="Show Password"><?php _e( "Show", 'kho' ); ?></label>
							</div>
						</div>
					</div>
					<?php do_action( 'login_form' ); ?>
					<div class="rememberme">
						<input name="rememberme" type="checkbox" value="forever">
						<label for="rememberme"><?php _e( "Remember Me", 'kho' ); ?></label>
					</div>
					<div class="bottom">
						<input type="submit" name="submit_button" class="login uw-button" value="<?php _e( "Log In", 'kho' );?>">
					</div>
					<?php if ( get_option( 'users_can_register' ) ) { ?>
						<div class="uw-link">
							<a href="#" class="uw-register-link"><?php _e( "Create an account", 'kho' ); ?></a>
						</div>
					<?php } ?>
					<input type="hidden" value="login" name="form_action">
					<input type="hidden" value="do_action" name="action">
					<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_to ); ?>" />
				</form>

				<?php if ( get_option( 'users_can_register' ) ) { ?>
					<form name="registerform" class="uw-registerform" action="<?php echo esc_url( site_url('wp-login.php?action=register', 'login_post') ); ?>" method="post" novalidate="novalidate">
						<div class="uw-form-wrap">
							<label for="user_login" class="label"><?php _e( 'Username', 'kho' ); ?><span class="required">*</span></label>
							<input type="text" name="user_login" class="user_login input" value="" size="20">
						</div>
						<div class="uw-form-wrap">
							<label for="user_email" class="label"><?php _e( 'E-mail', 'kho' ); ?><span class="required">*</span></label>
							<input type="email" name="user_email" class="user_email input" value="" size="25">
						</div>
						<?php do_action( 'register_form' ); ?>
						<div class="uw-reg-passmail"><?php _e( 'A password will be e-mailed to you.', 'kho' ) ?></div>
						<br class="clear">
						<div class="bottom">
							<input type="submit" name="submit" class="signup login-button" value="<?php _e( "Create Account", 'kho' );?>">
						</div>
						<div class="uw-link">
							<a href="#" class="uw-login-link"><?php _e( "Already a member?", 'kho' ); ?></a>
						</div>
						<input type="hidden" name="user-cookie" value="1" />
						<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>?register=true" />
					</form>
				<?php } ?>

				<form name="lostpasswordform" class="uw-lostpasswordform" action="<?php echo esc_url( network_site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>" method="post">
					<div class="uw-form-wrap">
						<label class="label"><?php _e( 'Your Username or E-mail', 'kho' ); ?></label>
						<input type="text" name="user_login" class="user_login input" value="" size="20">
					</div>
					<?php do_action( 'lostpassword_form' ); ?>
					<div class="bottom">
						<input type="submit" name="submit" class="recover login-button" value="<?php _e( "Get New Password", 'kho' );?>">
					</div>
					<div class="uw-link">
						<a href="#" class="uw-login-link"><?php _e( "I remember!", 'kho' ); ?></a>
					</div>
					<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
				</form>
			<?php } ?>

		<?php echo $after_widget;
	}
	
	// update the widget when new options have been entered
	public function update( $new_instance, $old_instance ) {
		$instance 					= $old_instance;
		$instance['title'] 			= strip_tags($new_instance['title']);
		$instance['class_wrap'] 	= strip_tags($new_instance['class_wrap']);
		$instance['redirect'] 		= strip_tags($new_instance['redirect']);
		$instance['title_logged'] 	= strip_tags($new_instance['title_logged']);
		$instance['display_avatar'] = (int)$new_instance['display_avatar'];
		$instance['avatar_link'] 	= strip_tags($new_instance['avatar_link']);
		$instance['username_link'] 	= strip_tags($new_instance['username_link']);
		$instance['user_menu'] 		= (int)$new_instance['user_menu'];
		$instance['logout'] 		= (int)$new_instance['logout'];
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	public function form( $instance ) {
		$title 			= isset( $instance['title'] ) ? $instance['title'] : __('Login','kho');
		$class_wrap 	= isset( $instance['class_wrap'] ) ? $instance['class_wrap'] : '';
		$redirect 		= isset( $instance['redirect'] ) ? $instance['redirect'] : '';
		$title_logged 	= isset( $instance['title_logged'] ) ? $instance['title_logged'] : __('Welcome','kho');
		$display_avatar = isset( $instance['display_avatar'] ) ? $instance['display_avatar'] : __('Yes','kho');
		$avatar_link 	= isset( $instance['avatar_link'] ) ? $instance['avatar_link'] : '';
		$username_link 	= isset( $instance['username_link'] ) ? $instance['username_link'] : '';
		$user_menu 		= isset( $instance['user_menu'] ) ? $instance['user_menu'] : '';
		$logout 		= isset( $instance['logout'] ) ? $instance['logout'] : __('Yes','kho');

		// Get menus
		$menus = wp_get_nav_menus(); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('class_wrap'); ?>"><?php _e('Class Wrap (optional):', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('class_wrap'); ?>" name="<?php echo $this->get_field_name('class_wrap'); ?>" type="text" value="<?php echo esc_attr($class_wrap); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('redirect'); ?>"><?php _e('Url Redirect After Login:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('redirect'); ?>" name="<?php echo $this->get_field_name('redirect'); ?>" type="text" value="<?php echo esc_attr($redirect); ?>" />
			<small style="font-size: 11px;"><?php _e( 'Default is homepage', 'kho' ); ?></small>
		</p>

		<h3 style="margin-top:20px;margin-bottom:5px;clear: both;"><?php _e( 'User Logged In','kho' ); ?></h3>

		<p>
			<label for="<?php echo $this->get_field_id('title_logged'); ?>"><?php _e('Title:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('title_logged'); ?>" name="<?php echo $this->get_field_name('title_logged'); ?>" type="text" value="<?php echo esc_attr($title_logged); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('display_avatar'); ?>"><?php _e( 'Display Avatar:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('display_avatar'); ?>" id="<?php echo $this->get_field_id('display_avatar'); ?>">
				<option value="1" <?php if($display_avatar == '1') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'kho' ); ?></option>
				<option value="0" <?php if($display_avatar == '0') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'kho'); ?></option>
			</select>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('avatar_link'); ?>"><?php _e('Avatar Link:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('avatar_link'); ?>" name="<?php echo $this->get_field_name('avatar_link'); ?>" type="text" value="<?php echo esc_attr($avatar_link); ?>" />
			<small style="font-size: 11px;"><?php _e( 'Default is profile page', 'kho' ); ?></small>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('username_link'); ?>"><?php _e('Username Link:', 'kho'); ?></label>			
			<input class="widefat" id="<?php echo $this->get_field_id('username_link'); ?>" name="<?php echo $this->get_field_name('username_link'); ?>" type="text" value="<?php echo esc_attr($username_link); ?>" />
			<small style="font-size: 11px;"><?php _e( 'Default is profile page', 'kho' ); ?></small>
		</p>

		<p class="uw-left">
			<label for="<?php echo $this->get_field_id('user_menu'); ?>"><?php _e( 'User Menu:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('user_menu'); ?>" id="<?php echo $this->get_field_id('user_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
					<?php foreach ( $menus as $menu ) {
							echo '<option value="' . $menu->term_id . '"'
								. selected( $user_menu, $menu->term_id, false )
								. '>'. esc_html( $menu->name ) . '</option>';
						} ?>
			</select>
		</p>

		<p class="uw-right">
			<label for="<?php echo $this->get_field_id('logout'); ?>"><?php _e( 'Display Logout Link:', 'kho' ); ?></label>
			<select class='uw-widget-select widefat' name="<?php echo $this->get_field_name('logout'); ?>" id="<?php echo $this->get_field_id('logout'); ?>">
				<option value="1" <?php if($logout == '1') { ?>selected="selected"<?php } ?>><?php _e( 'Yes', 'kho' ); ?></option>
				<option value="0" <?php if($logout == '0') { ?>selected="selected"<?php } ?>><?php _e( 'No', 'kho'); ?></option>
			</select>
		</p>

	<?php
	}
}