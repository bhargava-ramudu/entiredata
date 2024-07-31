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
 * Define the internationalization functionality
 */
class CountCWP_i18n {

	/**
	 * Load the plugin text domain for translation.
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'count-cwp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages'
		);

	}
}