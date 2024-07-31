<?php
/**
* Header Options.
*
* @package JoltNews
*/

$joltnews_default = joltnews_get_default_theme_options();
$joltnews_page_lists = joltnews_page_lists();
$joltnews_post_category_list = joltnews_post_category_list();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'joltnews' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $joltnews_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'joltnews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'joltnews' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'joltnews_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'joltnews'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'joltnews_header_ad_ac',
    )
);


$wp_customize->add_setting('ed_header_new_entry_posts',
    array(
        'default' => $joltnews_default['ed_header_new_entry_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_new_entry_posts',
    array(
        'label' => esc_html__('Enable New Entry Posts', 'joltnews'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_new_entry_posts_title',
    array(
    'default'           => $joltnews_default['ed_header_new_entry_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_new_entry_posts_title',
    array(
    'label'       => esc_html__( 'New Entry Section Title', 'joltnews' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'joltnews_header_new_entry_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'joltnews_sanitize_select',
    )
);
$wp_customize->add_control( 'joltnews_header_new_entry_cat',
    array(
    'label'       => esc_html__( 'New Entry Posts Category', 'joltnews' ),
    'section'     => 'main_header_setting',
    'type'        => 'select',
    'choices'     => $joltnews_post_category_list,
    )
);



// Archive Layout.
$wp_customize->add_setting(
    'joltnews_header_bg_size',
    array(
        'default'           => $joltnews_default['joltnews_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('joltnews_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'joltnews' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'joltnews' ),
                '2'  => esc_html__( 'Medium', 'joltnews' ),
                '3'  => esc_html__( 'Large', 'joltnews' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $joltnews_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'joltnews'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $joltnews_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'joltnews'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);