<?php
/**
 * Pagination Settings
 *
 * @package JoltNews
 */

$joltnews_default = joltnews_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'joltnews_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'joltnews' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'joltnews_pagination_layout',
	array(
	'default'           => $joltnews_default['joltnews_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'joltnews_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'joltnews' ),
	'section'     => 'joltnews_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','joltnews'),
		'numeric' => esc_html__('Numeric Method','joltnews'),
		'load-more' => esc_html__('Ajax Load More Button','joltnews'),
		'auto-load' => esc_html__('Ajax Auto Load','joltnews'),
	),
	)
);