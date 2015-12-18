var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
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
});