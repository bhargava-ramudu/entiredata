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
 
class w357CountCWP
{
	/**
	 * Sets up all the filters and actions.
	 */
	public function run()
	{
		add_filter( 'mce_external_plugins', array($this, 'w357_tinymce_plugin') );
	}

	function w357_tinymce_plugin($init) {
		$init['keyup_event'] = plugins_url( 'count-cwp' ) . '/admin/js/tinymce-keyup.min.js';
		return $init;
	}
}

$plugin = new w357CountCWP();
$plugin->run();