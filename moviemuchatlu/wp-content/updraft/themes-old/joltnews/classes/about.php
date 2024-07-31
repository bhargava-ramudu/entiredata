<?php

/**
 * JoltNews About Page
 * @package JoltNews
 *
*/

if( !class_exists('JoltNews_About_page') ):

	class JoltNews_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'joltnews_backend_menu'),999);

		}

		// Add Backend Menu
        function joltnews_backend_menu(){

            add_theme_page(esc_html__( 'JoltNews','joltnews' ), esc_html__( 'JoltNews','joltnews' ), 'activate_plugins', 'joltnews-about', array($this, 'joltnews_main_page'),1);

        }

        // Settings Form
        function joltnews_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new JoltNews_About_page();

endif;