<?php
/**
 * JoltNews Theme Customizer
 *
 * @package JoltNews
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('joltnews_customize_register')) :

function joltnews_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/active-callback.php';
	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/layout.php';
	require get_template_directory() . '/inc/customizer/preloader.php';
	require get_template_directory() . '/inc/customizer/date-ticker-header.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/repeater.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';

	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','joltnews');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'static_front_page' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';
    

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.header-titles .custom-logo-name',
			'render_callback' => 'joltnews_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'joltnews_customize_partial_blogdescription',
		) );
	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'joltnews' ),
			'priority'   => 200,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'joltnews' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'joltnews' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'JoltNews_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new JoltNews_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'JoltNews Pro', 'joltnews' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'joltnews' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/joltnews-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'joltnews_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('joltnews_customizer_scripts')) :

    function joltnews_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('joltnews-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('joltnews-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('joltnews_customizer_ajax_nonce');
        wp_localize_script( 
		    'joltnews-customizer', 
		    'joltnews_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'joltnews_customizer_scripts');
add_action('customize_controls_init', 'joltnews_customizer_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */
function joltnews_customizer_repearer(){   
	
	wp_enqueue_style('joltnews-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    wp_enqueue_script('joltnews-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

    $joltnews_post_category_list = joltnews_post_category_list();

    $cat_option = '';

    if( $joltnews_post_category_list ){
	    foreach( $joltnews_post_category_list as $key => $cats ){
	    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
	    }
	}

    wp_localize_script( 
        'joltnews-repeater', 
        'joltnews_repeater',
        array(
            'optionns'   => "
            				<option selected='selected' value='content-rich-blocks'>". esc_html__('Content Rich Block','joltnews')."</option>
            				<option value='main-banner'>". esc_html__('Sub-Banner Block','joltnews')."</option>
            				<option value='banner-blocks-1'>". esc_html__('Slider & Tab Block','joltnews')."</option>
            				<option value='latest-posts-blocks'>". esc_html__('Latest Posts Block','joltnews')."</option>
        					<option value='advertise-blocks'>". esc_html__('Advertise Block','joltnews')."</option>
            				<option value='home-widget-area'>". esc_html__('Widgets Area Block','joltnews')."</option
        					<option value='you-may-like-blocks'>". esc_html__('You May Like Block','joltnews')."</option>",
           	'categories'   => $cat_option,
            'new_section'   =>  esc_html__('New Section','joltnews'),
            'upload_image'   =>  esc_html__('Choose Image','joltnews'),
            'use_image'   =>  esc_html__('Select','joltnews'),
         )
    );

    wp_localize_script( 
        'joltnews-customizer', 
        'joltnews_customizer',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
         )
    );
}

add_action('customize_controls_enqueue_scripts', 'joltnews_customizer_repearer');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('joltnews_customize_partial_blogname')) :

	function joltnews_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('joltnews_customize_partial_blogdescription')) :

	function joltnews_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function joltnews_customize_preview_js() {
	wp_enqueue_script( 'joltnews-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'joltnews_customize_preview_js' );