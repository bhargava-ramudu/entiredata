<?php

add_filter( 'news_24x7_repeater_news_choices', function( $choices ){
	$choices[4] = esc_html__( 'Post Grid 2', 'news-24x7' );
	return $choices;
});

add_filter( 'news_24x7_repeater_news_fields', function( $fields ){

	$fields['layout_4_title'] = [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'news-24x7' ),
        'default'     => esc_html__( 'In Spotlight', 'news-24x7' ),
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_categories'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Categories', 'news-24x7' ),
        'choices'     => bizberg_get_post_categories(),
        'multiple'    => 99,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_limit'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
        'default'     => 5,
        'choices'     => [
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
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_bg_color'] = [
        'type'        => 'color',
        'label'       => esc_html__( 'Background Color', 'news-24x7' ),
        'default'     => '#f7f7f7',
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_title_line_color'] = [
        'type'        => 'color',
        'label'       => esc_html__( 'Title Horizontal Line Color', 'news-24x7' ),
        'default'     => '#cbc4c4',
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_columns'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Columns', 'news-24x7' ),
        'default'     => '50%|25%|25%',
        'choices'     => [
            '50%|25%|25%'     => '50% | 25% | 25%',
            '40%|20%|20%|20%' => '40% | 20% | 20% | 20%',
            '60%|20%|20%'     => '60% | 20% | 20%',
            '70%|30%'         => '70% | 30%',
            '80%|20%'         => '80% | 20%',
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    $fields['layout_4_thumbnail_status'] = [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Hide Thumbnail', 'news-24x7' ),
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '4'
            ]
        ],
    ];

    return $fields;

});