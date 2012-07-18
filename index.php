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
	echo 'var _gaq = _gaq || [];"'; //ensure the gaq is there, or make it
	if($_GET['p']) //viewing a post
	{
		$post_name = get_the_title($_GET['p']);
		echo "_gaq.push(['_trackEvent', 'Posts', 'View', ${$post_name}]);\n";
		
	}
	else if($_GET['page_id']) //viewing a page
	{
		$page_name = get_the_title($_GET['page_id']);
		echo "_gaq.push(['_trackEvent', 'Pages', 'View', ${$page_name}]);\n";
	}
	
	echo '</script>';
}

// if($post_type == 'post' || $post_type == 'page')
// {
	//$post_name_js = "_gaq.push(['_setCustomVar', 2, 'Post Name', '${"boo"}', 3]);  ";	
// }
//Set the Post Name custom var as a page-level scoped (3) var to index 2

	//$push = apply_filters('yoast-ga-push-before-pageview', $post_name_js);

	