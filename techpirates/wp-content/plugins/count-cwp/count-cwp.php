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
 * Plugin Name:       Count Characters, Spaces, Words and Paragraphs while typing
 * Plugin URI:        https://www.web357.com/product/count-words-characters-paragraphs-wordpress-plugin
 * Description:       Displays the count of Characters, Spaces, Words and Paragraphs, in real-time, while writing in the visual/text editor of posts/pages, or in custom textarea fields.
 * Version:           1.0.6
 * Author:            Web357
 * Author URI:        https://www.web357.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       count-cwp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
if ( !defined( 'COUNTCWP_VERSION' ) ) {
	define( 'COUNTCWP_VERSION', '1.0.6' );
}

/**
 * The code that runs during plugin activation.
 */
function activate_CountCWP() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	CountCWP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_CountCWP() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	CountCWP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_CountCWP' );
register_deactivation_hook( __FILE__, 'deactivate_CountCWP' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-main.php';

/**
 * Begins execution of the plugin.
 */
function run_CountCWP() 
{
	$plugin = new CountCWP();
	$plugin->run();
}
run_CountCWP();

// Load the main functionality of plugin
require_once (plugin_dir_path( __FILE__ ) . 'includes/class-w357-count-cwp.php');