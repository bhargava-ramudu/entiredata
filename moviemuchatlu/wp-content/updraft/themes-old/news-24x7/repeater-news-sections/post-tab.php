<?php

add_filter( 'news_24x7_repeater_news_choices', function( $choices ){
	$choices[2] = esc_html__( 'Post Tabs', 'news-24x7' );
	return $choices;
});

add_filter( 'news_24x7_repeater_news_fields', function( $fields ){
	
	$fields['layout_2_title'] = [
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'news-24x7' ),
        'default'     => esc_html__( 'Exclusive content', 'news-24x7' ),
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '2'
            ]
        ],
    ];

    $fields['layout_2_categories'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Categories', 'news-24x7' ),
        'choices'     => bizberg_get_post_categories(),
        'multiple'    => 1,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '2'
            ]
        ],
    ];

    $fields['layout_2_limit'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Post Limit', 'news-24x7' ),
        'default'     => 7,
        'choices'     => [
        	5 => 5,
        	7 => 7,
        	9 => 9,
        	11 => 11,
        	13 => 13,
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '2'
            ]
        ],
    ];

    $fields['layout_2_columns'] = [
        'type'        => 'select',
        'label'       => esc_html__( 'Columns', 'news-24x7' ),
        'default'     => '33% | 33% | 33%',
        'choices'     => [
            '33%|33%|33%' => '33% | 33% | 33%',
            '50%|25%|25%' => '50% | 25% | 25%',
            '60%|20%|20%' => '60% | 20% | 20%',
            '75%|25%'     => '75% | 25%',
            '65%|35%'     => '65% | 35%',
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '2'
            ]
        ],
    ];

    $fields['layout_2_thumbnail_status'] = [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Hide Thumbnail', 'news-24x7' ),
        'default'     => false,
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '2'
            ]
        ],
    ];

    return $fields;

});