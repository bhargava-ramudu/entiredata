<?php
/**
* Header Options.
*
* @package JoltNews
*/

$joltnews_default = joltnews_get_default_theme_options();
$joltnews_post_category_list = joltnews_post_category_list();
$wp_customize->add_section( 'breaking_news_setting',
    array(
    'title'      => esc_html__( 'Breaking News Settings', 'joltnews' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $joltnews_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Breaking Posts', 'joltnews'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $joltnews_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Breaking Section Title', 'joltnews' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'joltnews_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'joltnews_sanitize_select',
    )
);
$wp_customize->add_control( 'joltnews_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Breaking Posts Category', 'joltnews' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'select',
    'choices'     => $joltnews_post_category_list,
    )
);

$wp_customize->add_setting('ed_ticker_slider_autoplay',
    array(
        'default' => $joltnews_default['ed_ticker_slider_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_slider_autoplay',
    array(
        'label' => esc_html__('Enable Breaking Posts Autoplay', 'joltnews'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);



$wp_customize->add_section( 'date_breaking_news_setting',
	array(
	'title'      => esc_html__( 'Header Extras Settings (date, clock)', 'joltnews' ),
	'priority'   => 13,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_ticker_bar',
    array(
        'default' => $joltnews_default['ed_ticker_bar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar',
    array(
        'label' => esc_html__('Enable Breaking Bar', 'joltnews'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_read_later',
    array(
        'default' => $joltnews_default['ed_post_read_later'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_read_later',
    array(
        'label' => esc_html__('Enable Favourites', 'joltnews'),
        'description' => esc_html__('Booster Extension Plugin Required', 'joltnews'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_bar_social_nav',
    array(
        'default' => $joltnews_default['ed_ticker_bar_social_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_social_nav',
    array(
        'label' => esc_html__('Enable Social Nav', 'joltnews'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_ticker_bar_date',
    array(
        'default' => $joltnews_default['ed_ticker_bar_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'joltnews_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_ticker_bar_date',
    array(
        'label' => esc_html__('Enable Current Date', 'joltnews'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ticker_date_format',
    array(
    'default'           => $joltnews_default['ticker_date_format'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ticker_date_format',
    array(
    'label'       => esc_html__( 'Breaking Date Format', 'joltnews' ),
    'section'     => 'date_breaking_news_setting',
    'type'        => 'text',
    )
);
