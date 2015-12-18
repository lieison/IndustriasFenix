var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
	// Flickr Widget
	flickrWidget();
	// Login Widget
	loginWidget();
	// Menu Widget
	menuWidget();
	// Posts Slider Widget
	psliderWidget();
	// Slideshow Widget
	slideshowWidget();
	// Tabs Widget
	tabsWidget();
	// Testimonials Widget
	testimonialsWidget();
});

/* ==============================================
FLICKR WIDGET
============================================== */
function flickrWidget() {
	"use strict"
	$j('.uw-flickr-widget').each(function(){
		$j(this).jflickrfeed({
			limit: $j(this).data('num'),
			qstrings:{
				id: $j(this).data('id')
			},
			itemTemplate: $j(this).next().text()
		});
	});
}

/* ==============================================
LOGIN WIDGET
============================================== */
function loginWidget() {
	"use strict"
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
}

/* ==============================================
MENU WIDGET
============================================== */
function menuWidget() {
	"use strict"
	$j('.uw_menu_widget ul li.has-sub .uw-sub-icon, .uw_menu_widget ul li.has-sub a[href*=#]').on('click', function(e){
	    e.preventDefault();
	    if ($j(this).closest('li.has-sub').find("> ul.uw-sub-menu").is(":visible")){
			$j(this).closest('li.has-sub').find("> ul.uw-sub-menu").slideUp(200);
			$j(this).closest('li.has-sub').removeClass('open-sub');
		} else {
			$j(this).closest('li.has-sub').addClass('open-sub');
			$j(this).closest('li.has-sub').find("> ul.uw-sub-menu").slideDown(200);
		}
	});
}

/* ==============================================
POSTS SLIDER WIDGET
============================================== */
function psliderWidget() {
	"use strict"
	var slider 		= $j('.uw_slider_widget > .uw-posts-slider'),
		slideshow 	= slider.data("slideshow");
	slider.flexslider({
		selector: ".uw-flex-slides > li",
		animation: "fade",
		smoothHeight: false,
		slideshowSpeed: slideshow,
		animationSpeed: 600,
		pauseOnHover: true,
		directionNav: false,
		controlNav: false,
	});
	$j('.uw_slider_widget ul.uw-posts-slider-nav > li > .uw-posts-prev').on('click', function(){
	    slider.flexslider('prev')
	    return false;
	});
	$j('.uw_slider_widget ul.uw-posts-slider-nav > li > .uw-posts-next').on('click', function(){
	    slider.flexslider('next')
	    return false;
	});
}

/* ==============================================
SLIDESHOW WIDGET
============================================== */
function slideshowWidget() {
	"use strict"
	var slider 		= $j('.uw-widget-mini-slideshow'),
		slideshow 	= slider.data("slideshow");
	slider.flexslider({
		selector: ".uw-flex-slides > li",
		animation: "fade",
		smoothHeight: false,
		slideshowSpeed: slideshow,
		animationSpeed: 600,
		pauseOnHover: true,
		controlNav: false,
		directionNav: false,
	});
	$j('.uw-slideshow-prev').on('click', function(){
	    slider.flexslider('prev')
	    return false;
	});
	$j('.uw-slideshow-next').on('click', function(){
	    slider.flexslider('next')
	    return false;
	});
}

/* ==============================================
TABS WIDGET
============================================== */
function tabsWidget() {
	"use strict"
	var tabs = $j(".uw_tabs_widget .uw-tabs-wrap");
		tabs.hide();
	$j(".uw_tabs_widget ul.uw-posts-tabs > li:first").addClass("uw-active").show();
	$j(".uw_tabs_widget .uw-tabs-wrap:first").show(); 
	$j(".uw_tabs_widget ul > li.uw-tabs").click(function() {
		$j(".uw_tabs_widget ul.uw-posts-tabs > li").removeClass("uw-active");
		$j(this).addClass("uw-active");
		tabs.hide();
		var activeTab = $j(this).find("a").attr("href");
		$j(activeTab).slideDown();
		return false;
	});
}

/* ==============================================
TESTIMONIALS WIDGET
============================================== */
function testimonialsWidget() {
	"use strict"
	var slider 		= $j('.uw-testimonial-slider'),
		slidespeed 	= slider.data("slidespeed");
	slider.flexslider({
		selector: ".uw-flex-slides > li",
		animation: "fade",
		smoothHeight: false,
		slideshowSpeed: slidespeed,
		animationSpeed: 400,
		pauseOnHover: true,
		controlNav: false,
		directionNav: false
	});
	$j('.uw-testimonial-prev').on('click', function(){
	    slider.flexslider('prev')
	    return false;
	});
	$j('.uw-testimonial-next').on('click', function(){
	    slider.flexslider('next')
	    return false;
	});
}