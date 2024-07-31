<?php

add_action( 'init' , 'news_24x7_repeater_news' );
function news_24x7_repeater_news(){

	Kirki::add_section( 'news_24x7_repeater_news_sections', array(
        'title' => esc_html__( 'News Sections', 'news-24x7' ),
        'panel' => 'news_24x7_frontpage_sections'
    ) );

    Kirki::add_field( 'bizberg', array(
    	'type'        => 'advanced-repeater',
    	'label'       => esc_html__( 'Select News Layout', 'news-24x7' ),
	    'section'     => 'news_24x7_repeater_news_sections',
	    'settings'    => 'news_24x7_repeater_news',
	    'default'     => json_encode(
	    	apply_filters( 'news_24x7_repeater_news_default_value', [] )
	    ),
	    'choices' => [
	    	'limit' => 7,
	        'button_label' => esc_html__( 'Add News Section', 'news-24x7' ),
	        'row_label' => [
	            'value' => esc_html__( 'News Section', 'news-24x7' ),
	        ],
	        'fields' => apply_filters( 'news_24x7_repeater_news_fields', [
	        	'layout'  => [
	                'type'        => 'select',
	                'label'       => esc_html__( 'Layout', 'news-24x7' ),
	                'default'     => apply_filters( 'news_24x7_repeater_news_default', '1' ),
	                'choices'     => apply_filters( 'news_24x7_repeater_news_choices', array() ),
	            ],
	        ]),
	    ]
    ));

}