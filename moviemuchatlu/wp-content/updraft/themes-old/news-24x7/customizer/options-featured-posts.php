<?php

add_action( 'init' , 'news_24x7_featured_news' );
function news_24x7_featured_news(){

	Kirki::add_section( 'news_24x7_featured_news_sections', array(
        'title' => esc_html__( 'Featured News', 'news-24x7' ),
        'panel' => 'news_24x7_frontpage_sections'
    ) );

    Kirki::add_field( 'bizberg', array(
	    'type'        => 'custom',
	    'settings'    => 'news_24x7_featured_news_popular_news_blank_content',
	    'section'     => 'news_24x7_featured_news_sections',
	    'default'     => '',
	) );

    Kirki::add_section( 'news_24x7_featured_news_scrolling_posts', array(
        'title'   => esc_html__( 'Scrolling Posts', 'news-24x7' ),
        'section' => 'news_24x7_featured_news_sections'
    ) );

	Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'news_24x7_featured_news_scrolling_posts_title',
		'label'    => esc_html__( 'Title', 'news-24x7' ),
		'section'  => 'news_24x7_featured_news_scrolling_posts',
		'default'  => esc_html__( 'Fresh Stories', 'news-24x7' ),
        'partial_refresh'    => [
			'news_24x7_featured_news_scrolling_posts_title' => [
				'selector'        => '.news-stories .news-stories-title h3',
				'render_callback' => 'news_24x7_homepage_featured_posts_scrolling_posts_title'
			]
		],
	] );

	Kirki::add_field( 'bizberg', array(
        'type'        => 'select',
        'settings'    => 'news_24x7_featured_news_category',
        'label'       => esc_html__( 'Select Post Categories', 'news-24x7' ),
        'section'     => 'news_24x7_featured_news_scrolling_posts',
        'multiple'    => 99,
        'choices'     => bizberg_get_post_categories()
    ) );

    Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'news_24x7_featured_news_limit',
		'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
		'section'     => 'news_24x7_featured_news_scrolling_posts',
		'description' => esc_html__( 'If value is 0, it will show all the post from the selected categories.', 'news-24x7' ),
		'default'     => 10,
		'choices'     => [
			'min'  => 0,
			'max'  => 20,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'news_24x7_featured_news_slides_to_show_before_scroll',
		'label'       => esc_html__( 'Posts to show before scroll', 'news-24x7' ),
		'section'     => 'news_24x7_featured_news_scrolling_posts',
		'default'     => 4,
		'choices'     => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	] );

	Kirki::add_section( 'news_24x7_featured_news_main_news', array(
        'title'   => esc_html__( 'Main News', 'news-24x7' ),
        'section' => 'news_24x7_featured_news_sections'
    ) );

    Kirki::add_field( 'bizberg', array(
        'type'        => 'select',
        'settings'    => 'news_24x7_featured_news_main_news_categories',
        'label'       => esc_html__( 'Select Post Categories', 'news-24x7' ),
        'section'     => 'news_24x7_featured_news_main_news',
        'multiple'    => 99,
        'choices'     => bizberg_get_post_categories(),
        'partial_refresh'    => [
			'news_24x7_featured_news_main_news_categories' => [
				'selector'        => '.news-main-m .row',
				'render_callback' => 'news_24x7_homepage_featured_posts_main_news'
			]
		],
    ) );

    Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'news_24x7_featured_news_main_news_limit',
		'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
		'section'     => 'news_24x7_featured_news_main_news',
		'default'     => 3,
		'choices'     => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
		'partial_refresh'    => [
			'news_24x7_featured_news_main_news_limit' => [
				'selector'        => '.news-main-m .row',
				'render_callback' => 'news_24x7_homepage_featured_posts_main_news'
			]
		],
	] );

	Kirki::add_section( 'news_24x7_featured_news_popular_news', array(
        'title'   => esc_html__( 'Popular News', 'news-24x7' ),
        'section' => 'news_24x7_featured_news_sections'
    ) );

    Kirki::add_field( 'bizberg', [
		'type'     => 'text',
		'settings' => 'news_24x7_featured_news_popular_news_title',
		'label'    => esc_html__( 'Title', 'news-24x7' ),
		'section'  => 'news_24x7_featured_news_popular_news',
		'default'  => esc_html__( 'Popular News', 'news-24x7' ),
        'partial_refresh'    => [
			'news_24x7_featured_news_popular_news_title' => [
				'selector'        => '.news-popular h3.title',
				'render_callback' => 'news_24x7_homepage_featured_posts_get_popular_title'
			]
		],
	] );

    Kirki::add_field( 'bizberg', array(
        'type'        => 'select',
        'settings'    => 'news_24x7_featured_news_popular_news_categories',
        'label'       => esc_html__( 'Select Post Categories', 'news-24x7' ),
        'section'     => 'news_24x7_featured_news_popular_news',
        'multiple'    => 99,
        'choices'     => bizberg_get_post_categories(),
        'partial_refresh'    => [
			'news_24x7_featured_news_popular_news_categories' => [
				'selector'        => '.news-popular .news-popular-in',
				'render_callback' => 'news_24x7_homepage_featured_posts_get_popular_posts'
			]
		],
    ) );

    Kirki::add_field( 'bizberg', [
		'type'        => 'slider',
		'settings'    => 'news_24x7_featured_news_popular_news_limit',
		'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
		'section'     => 'news_24x7_featured_news_popular_news',
		'default'     => 4,
		'choices'     => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
		'partial_refresh'    => [
			'news_24x7_featured_news_popular_news_limit' => [
				'selector'        => '.news-popular .news-popular-in',
				'render_callback' => 'news_24x7_homepage_featured_posts_get_popular_posts'
			]
		],
	] );

}