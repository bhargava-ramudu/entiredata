<?php
/**
* Layouts Settings.
*
* @package JoltNews
*/

$joltnews_default = joltnews_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'joltnews' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $joltnews_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'joltnews_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'joltnews' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'joltnews' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'joltnews' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'joltnews' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'joltnews_archive_layout',
    array(
        'default' 			=> $joltnews_default['joltnews_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new JoltNews_Custom_Radio_Image_Control(
        $wp_customize,
        'joltnews_archive_layout',
        array(
            'settings'      => 'joltnews_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'joltnews' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $joltnews_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'joltnews'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'joltnews_header_archive_layout_ac',
    )
);

