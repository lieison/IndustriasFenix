var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";
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
});