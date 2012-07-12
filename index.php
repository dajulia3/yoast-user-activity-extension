<?php
/*
Plugin Name: Yoast Extension: User views Google Analytics Tracking
Plugin URI: http://davidjulia.wordpress.com
Description: Allows you to run yoast plugin and have it push google analytics data on localhost
Version: .01
Author: David Julia
Author URI: http://davidjulia.wordpress.com
License: GPL2
*/

$js_code = "_gaq.push(['_setDomainName', 'none']);";
$push = apply_filters('yoast-ga-push-before-pageview',$js_code);