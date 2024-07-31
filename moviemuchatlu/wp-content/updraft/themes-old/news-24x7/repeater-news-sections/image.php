<?php

add_filter( 'news_24x7_repeater_news_choices', function( $choices ){
	$choices[3] = esc_html__( 'Image', 'news-24x7' );
	return $choices;
});

add_filter( 'news_24x7_repeater_news_fields', function( $fields ){

	$fields['layout_3_image'] = [
        'type'        => 'image',
        'label'       => esc_html__( 'Image', 'news-24x7' ),
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '3'
            ]
        ],
    ];

    $fields['layout_3_link'] = [
        'type'        => 'text',
        'label'       => esc_html__( 'Link', 'news-24x7' ),
        'default'     => '',
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '3'
            ]
        ],
    ];

    $fields['layout_3_target'] = [
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Open in a new tab', 'news-24x7' ),
        'default'     => 'true',
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '3'
            ],
            [
                'setting'  => 'layout_3_link',
                'operator' => '!=',
                'value'    => ''
            ]
        ],
    ];

    $fields['layout_3_spacing_top'] = [
        'type'        => 'number',
        'label'       => esc_html__( 'Spacing Top (px)', 'news-24x7' ),
        'default'     => 20,
        'choices'     => [
            'min'  => 5,
            'max'  => 80,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '3'
            ]
        ],
    ];

    $fields['layout_3_spacing_bottom'] = [
        'type'        => 'number',
        'label'       => esc_html__( 'Spacing Bottom (px)', 'news-24x7' ),
        'default'     => 20,
        'choices'     => [
            'min'  => 5,
            'max'  => 80,
            'step' => 5,
        ],
        'active_callback' => [
            [
                'setting'  => 'layout',
                'operator' => '==',
                'value'    => '3'
            ]
        ],
    ];

    return $fields;

});