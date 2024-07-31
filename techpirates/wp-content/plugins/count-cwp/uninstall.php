<?php
/* ======================================================
 # Count Characters, Words and Paragraphs while typing for WordPress - v1.0.6 (free version)
 # -------------------------------------------------------
 # For WordPress
 # Author: Web357
 # Copyright @ 2014-2023 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://www.web357.com/product/count-words-characters-paragraphs-wordpress-plugin
 # Support: support@web357.com
 # Last modified: Thursday 18 April 2024, 03:49:42 AM
 ========================================================= */
 
/**
 * Fired when the plugin is uninstalled.
 */

// If uninstall not called from WordPress, then exit.
if (
	!defined( 'WP_UNINSTALL_PLUGIN' )
	||
	!WP_UNINSTALL_PLUGIN
	||
	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) )
) {
	status_header( 404 );
	exit;
}

// Delete the options from database
delete_option('count_cwp_options');