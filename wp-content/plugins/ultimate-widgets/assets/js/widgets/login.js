var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
	var check 	= $j('.uw_login_widget .input-append .show-pass input[type=checkbox]'),
		pass 	= $j('.uw_login_widget .input-append .user_pass'),
		login 	= $j('.uw_login_widget .uw-loginform');

	check.on('click', function(){
		if ( check.is(':checked') ){
	        pass.attr('type', 'text');
	    } else {
	        pass.attr('type', 'password');
	    }
	});

	// Register
	$j('.uw_login_widget .uw-link a.uw-register-link').on('click', function(e){
	    e.preventDefault();
	    login.hide();
	    $j('.uw_login_widget .uw-registerform').fadeIn(200);
	});

	// Lost password
	$j('.uw_login_widget a.uw-lost-link').on('click', function(e){
	    e.preventDefault();
	    login.hide();
	    $j('.uw_login_widget .uw-lostpasswordform').fadeIn(200);
	});

	// Return to login
	$j('.uw_login_widget .uw-link a.uw-login-link').on('click', function(e){
	    e.preventDefault();
	    $j('.uw_login_widget .uw-registerform, .uw_login_widget .uw-lostpasswordform').hide();
	    login.fadeIn(200);
	});

	// Open sub menu
	$j('.uw_login_widget .uw-user-content li.has-sub .uw-sub-icon, .uw_login_widget .uw-user-content li.has-sub a[href*=#]').on('click', function(e){
	    e.preventDefault();
	    if ($j(this).closest('li.has-sub').find("> ul.uw-sub-menu").is(':visible')){
			$j(this).closest('li.has-sub').find("> ul.uw-sub-menu").slideUp(200);
			$j(this).closest('li.has-sub').removeClass('open-sub');
		} else {
			$j(this).closest('li.has-sub').addClass('open-sub');
			$j(this).closest('li.has-sub').find("> ul.uw-sub-menu").slideDown(200);
		}
	});
});