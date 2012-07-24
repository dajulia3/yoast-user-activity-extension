<?php
/*
Plugin Name: Yoast Extension: User Views Google Analytics Tracking
Plugin URI: http://davidjulia.wordpress.com
Description: Allows you to run yoast plugin and have it push google analytics data on localhost
Version: .01
Author: David Julia
Author URI: http://davidjulia.wordpress.com
License: GPL2
*/
$DEVELOPMENT_ENV = true;
$ua_code = "UA-33319912-1";
if($DEVELOPMENT_ENV){
	$local_dev_js = "_gaq.push(['_setDomainName', 'none']);";
	$push = apply_filters('yoast-ga-push-before-pageview', $local_dev_js);
	
}

add_action('wp_head', 'daj_gax_add_event_tracking_js');

function daj_gax_add_event_tracking_js(){
	if($_GET['preview']==true) //Don't track previews
	{
		return;
	}
	
	echo '<script type="text/javascript">';
	echo "\nvar _gaq = _gaq || [];\n"; //ensure the gaq is there, or make it
	echo "_gaq.push(['_setAccount','${ua_code}'])";

	if($_GET['p']) //viewing a post
	{
		$post_name = get_the_title($_GET['p']);
		echo "_gaq.push(['_trackEvent', 'Posts', 'View', '${post_name}']);\n";
		
	}
	else if($_GET['page_id']) //viewing a page
	{
		$page_name = get_the_title($_GET['page_id']);
		echo "_gaq.push(['_trackEvent', 'Pages', 'View', '${page_name}']);\n";
	}
	
	echo '</script>';
}

// function daj_gax_output_event_tracking_js(){
// 	if($_GET['preview']==true) //Don't track previews
// 	{
// 		return "";
// 	}

// 	//echo '<script type="text/javascript">';
// 	$ga_js = "\nvar _gaq = _gaq || [];\n"; //ensure the gaq is there, or make it
// 	if($_GET['p']) //viewing a post
// 	{
// 		$post_name = get_the_title($_GET['p']);
// 		$ga_js.= "_gaq.push(['_trackEvent', 'Posts', 'View', '${post_name}']);\n";

// 	}
// 	else if($_GET['page_id']) //viewing a page
// 	{
// 		$page_name = get_the_title($_GET['page_id']);
// 		$ga_js.= "_gaq.push(['_trackEvent', 'Pages', 'View', '${page_name}']);\n";
// 	}

// 	return $ga_js;
// }

// 	$push = apply_filters('yoast-ga-push-before-pageview', daj_gax_output_event_tracking_js());

	