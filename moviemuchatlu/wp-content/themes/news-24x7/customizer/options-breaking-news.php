<?php

add_action( 'init' , 'news_24x7_breaking_news' );
function news_24x7_breaking_news(){

	Kirki::add_section( 'news_24x7_breaking_news_sections', array(
        'title' => esc_html__( 'Breaking News', 'news-24x7' ),
        'panel' => 'news_24x7_frontpage_sections'
    ) );

    Kirki::add_field( 'bizberg', [
		'type'        => 'checkbox',
		'settings'    => 'news_24x7_breaking_news_status',
		'label'       => esc_html__( 'Show / Hide Breaking News', 'news-24x7' ),
		'section'     => 'news_24x7_breaking_news_sections',
		'default'     => true
	] );

    Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'news_24x7_breaking_news_title',
		'label'    => esc_html__( 'Title', 'news-24x7' ),
		'section'  => 'news_24x7_breaking_news_sections',
		'default'  => esc_html__( 'Breaking News', 'news-24x7' ),
		'active_callback'    => array(
            array(
                'setting'  => 'news_24x7_breaking_news_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
        'partial_refresh'    => [
			'news_24x7_breaking_news_title' => [
				'selector'        => '.breaking-news-in .row h3.title',
				'render_callback' => 'news_24x7_homepage_breaking_news_title'
			]
		],
	] );

	Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'news_24x7_breaking_news_post_settings',
	    'section'     => 'news_24x7_breaking_news_sections',
	    'default'     => '<div class="bizberg_customizer_custom_heading">' . esc_html__( 'Post Settings', 'news-24x7' ) . '</div>',
	    'active_callback' => [
	        [
	            'setting'  => 'news_24x7_breaking_news_status',
	            'operator' => '==',
	            'value'    => true,
	        ]
	    ],
	) );

	Kirki::add_field( 'bizberg', array(
        'type'        => 'select',
        'settings'    => 'news_24x7_breaking_news_category',
        'label'       => esc_html__( 'Select Post Category', 'news-24x7' ),
        'section'     => 'news_24x7_breaking_news_sections',
        'multiple'    => 1,
        'choices'     => bizberg_get_post_categories(),
        'active_callback'    => array(
            array(
                'setting'  => 'news_24x7_breaking_news_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
    ) );

    Kirki::add_field( 'bizberg', [
		'type'        => 'toggle',
		'settings'    => 'news_24x7_breaking_news_image_status',
		'label'       => esc_html__( 'Show / Hide Image', 'news-24x7' ),
		'section'     => 'news_24x7_breaking_news_sections',
		'default'     => '1',
		'active_callback'    => array(
            array(
                'setting'  => 'news_24x7_breaking_news_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
	] );

	Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'news_24x7_breaking_news_limit',
		'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
		'section'     => 'news_24x7_breaking_news_sections',
		'description' => esc_html__( 'If value is 0, it will show all the post from the selected category.', 'news-24x7' ),
		'default'     => 10,
		'choices'     => [
			'min'  => 0,
			'max'  => 20,
			'step' => 1,
		],
		'active_callback'    => array(
            array(
                'setting'  => 'news_24x7_breaking_news_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
	] );

	Kirki::add_field( 'bizberg', [
		'type'        => 'select',
		'settings'    => 'news_24x7_breaking_news_visibility',
		'label'       => esc_html__( 'Visibility', 'news-24x7' ),
		'description' => esc_html__( 'Get post not older than selected day.', 'news-24x7' ),
		'section'     => 'news_24x7_breaking_news_sections',
		'default'     => 'all',
		'multiple'    => 1,
		'choices'     => [
			'-1 day'   => esc_html__( '1 Day', 'news-24x7' ),
			'-2 days'  => esc_html__( '2 Day', 'news-24x7' ),
			'-3 days'  => esc_html__( '3 Day', 'news-24x7' ),
			'-4 days'  => esc_html__( '4 Day', 'news-24x7' ),
			'-5 days'  => esc_html__( '5 Day', 'news-24x7' ),
			'-6 days'  => esc_html__( '6 Day', 'news-24x7' ),
			'-7 days'  => esc_html__( '7 Day', 'news-24x7' ),
			'-8 days'  => esc_html__( '8 Day', 'news-24x7' ),
			'-9 days'  => esc_html__( '9 Day', 'news-24x7' ),
			'-10 days' => esc_html__( '10 Day', 'news-24x7' ),
			'all'      => esc_html__( 'All', 'news-24x7' ),
		],
		'active_callback'    => array(
            array(
                'setting'  => 'news_24x7_breaking_news_status',
                'operator' => '==',
                'value'    => true
            ),
        ),
	] );

}