<?php

add_filter( 'news_24x7_repeater_news_choices', function( $choices ){
	$choices[1] = esc_html__( 'Post Grid 1', 'news-24x7' );
	return $choices;
});

add_filter( 'news_24x7_repeater_news_fields', function( $fields ){
	
	$fields['layout_1_title'] = [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'news-24x7' ),
        'default'     => esc_html__( 'Featured News', 'news-24x7' ),
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    $fields['layout_1_categories'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Categories', 'news-24x7' ),
        'choices'     => bizberg_get_post_categories(),
        'multiple'    => 1,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    $fields['layout_1_limit'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
        'default'     => 12,
        'choices'     => [
        	2 => 2,
        	3 => 3,
        	4 => 4,
        	5 => 5,
        	6 => 6,
            7 => 7,
            8 => 8,
            9 => 9,
            10 => 10,
            11 => 11,
            12 => 12,
            13 => 13,
            14 => 14,
            15 => 15,
            16 => 16,
            17 => 17,
            18 => 18,
            19 => 19,
            20 => 20,
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    $fields['layout_1_columns'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Columns', 'news-24x7' ),
        'default'     => '4|4',
        'choices'     => [
            '2|3' => '2 | 3',
            '2|4' => '2 | 4',
            '3|3' => '3 | 3',
            '3|4' => '3 | 4',
            '4|4' => '4 | 4',
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    $fields['layout_1_background_image_height'] = [
        'type'        => 'number',
        'label'       => esc_html__( 'Background Image Height (px)', 'news-24x7' ),
        'default'     => 350,
        'choices'     => [
            'min'  => 300,
            'max'  => 500,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    $fields['layout_1_thumbnail_status'] = [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Hide Thumbnail', 'news-24x7' ),
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '1'
            ]
        ],
    ];

    return $fields;

});