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
$daj_gax_DEVELOPMENT_ENV = true;


function daj_gax_output_dev_js(){
	global $daj_gax_DEVELOPMENT_ENV;
	if($daj_gax_DEVELOPMENT_ENV){
		//echo '<script type="text/javascript">';
		echo "_gaq.push(['_setDomainName', 'none']);";
		//echo '</script>';
	}
}


add_action('wp_head', daj_gax_setup);

function daj_gax_setup(){
		
}

add_action('wp_footer', daj_gax_footer);

function daj_gax_footer(){
	$ua_code = 'UA-33319912-1';
	if($_GET['preview']==true) //Don't track previews
	{
		return;
	}
	if($_GET['p']) //viewing a post
	{
		$post_name = get_the_title($_GET['p']);

	}
	else if($_GET['page_id']) //viewing a page
	{
		$post_name = "PAGE: ".get_the_title($_GET['page_id']);
	}
	if($post_name)
	{
		$current_user_id = wp_get_current_user()->ID;
		if(0 == $current_user_id )
		{
			$current_user_id = "Anonymous";
		}
		//echo "*****STARRRRRRRTTTTT*****\n";
		echo '<script type="text/javascript">';
		echo "\nvar _gaq = _gaq || [];\n"; //ensure the gaq is there, or make it
		//set the visitor level user_name custom var and track the page view
		
		daj_gax_output_dev_js();
		echo "
		_gaq.push(
				['_setAccount', ${ua_code}],
				['_trackPageview', '${post_name}']
		);\n";
		
		echo "(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();";
		
		echo '</script>';
		//echo "\n*****ENDDDDDD*****";
	}
}

	