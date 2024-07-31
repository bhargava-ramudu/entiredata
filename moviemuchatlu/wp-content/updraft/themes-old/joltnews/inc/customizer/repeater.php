<?php
/**
* Sections Repeater Options.
*
* @package JoltNews
*/

$joltnews_post_category_list = joltnews_post_category_list();
$joltnews_defaults = joltnews_get_default_theme_options();
$home_sections = array(
        'content-rich-blocks' => esc_html__('Content Rich Block','joltnews'),
        'main-banner' => esc_html__('Sub-Banner Block','joltnews'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','joltnews'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','joltnews'),
        'advertise-blocks' => esc_html__('Advertise Block','joltnews'),
        'home-widget-area' => esc_html__('Widgets Area Block','joltnews'),
        'you-may-like-blocks' => esc_html__('You May Like Block','joltnews'),

    );

$joltnews_video_aspect_ratio = joltnews_video_aspect_ratio();
$joltnews_video_autoplay = joltnews_video_autoplay();

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'joltnews' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_joltnews_home_sections_5', array(
    'sanitize_callback' => 'joltnews_sanitize_repeater',
    'default' => json_encode( $joltnews_defaults['twp_joltnews_home_sections_5'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new JoltNews_Repeater_Controler( $wp_customize, 'twp_joltnews_home_sections_5', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_joltnews_home_sections_5',
        'joltnews_box_label' => esc_html__('New Section','joltnews'),
        'joltnews_box_add_control' => esc_html__('Add New Section','joltnews'),
        'joltnews_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'joltnews' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'joltnews' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs you-may-like-blocks-fields'
            ),
            'section_slide_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs you-may-like-blocks-fields'
            ),
             'tiles_post_per_page' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'joltnews' ),
                'options'     => array( 
                    '5' => 5,
                    '10' => 10,
                ),
                'class'       => 'home-repeater-fields-hs'
            ),
             'home_section_column_1' => array(
                  'type'        => 'seperator',
                  'seperator_text'       => esc_html__( 'Column 1', 'joltnews' ),
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_title_4' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Block Title', 'joltnews' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),

              'section_post_cat_1' => array(
                  'type'        => 'select',
                  'label'       => esc_html__( 'Select Category', 'joltnews' ),
                  'options'     => $joltnews_post_category_list,
                  'class'       => 'home-repeater-fields-hs main-banner-fields'
              ),
              'home_section_column_2' => array(
                   'type'        => 'seperator',
                   'seperator_text'       => esc_html__( 'Column 2', 'joltnews' ),
                   'class'       => 'home-repeater-fields-hs main-banner-fields'
               ),
             'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Slider Area Title', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'section_post_slide_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Slider Post Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),


            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'joltnews' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields main-banner-fields'
            ),

            'section_post_grid_post_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Grid Post Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            
            'section_post_list_post_cat' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'List Post Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),

            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_column_3' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 3', 'joltnews' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),
            'home_section_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Tab Area Title', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Block Title', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'content_rich_column_1' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 1', 'joltnews' ),
                 'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
             ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields content-rich-blocks-fields'
            ),
            'content_rich_column_2' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 2', 'joltnews' ),
                 'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
             ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields content-rich-blocks-fields'
            ),
            'cat_title_4' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Sub-Title Two Column', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
            ),
            'content_rich_column_3' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 3', 'joltnews' ),
                 'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
             ),
            'cat_title_3' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Three', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs content-rich-blocks-fields'
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields content-rich-blocks-fields'
            ),

            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_vertical_list_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Category', 'joltnews' ),
                'options'     => $joltnews_post_category_list,
                'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'section_video_ratio' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Video Aspect Ratio', 'joltnews' ),
                'options'     => $joltnews_video_aspect_ratio,
                'class'       => 'home-repeater-fields-hs latest-posts-blocks-fields'
            ),
            'section_video_autoplay' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Video Autoplay', 'joltnews' ),
                'options'     => $joltnews_video_autoplay,
                'class'       => 'home-repeater-fields-hs latest-posts-blocks-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'joltnews' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'joltnews_notice_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new JoltNews_Info_Notice_Control( 
        $wp_customize,
        'joltnews_notice_info',
        array(
            'settings' => 'joltnews_notice_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'joltnews' ),
        )
    )
);

$wp_customize->add_setting(
    'joltnews_premium_notice',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new JoltNews_Premium_Notice_Control( 
        $wp_customize,
        'joltnews_premium_notice',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'joltnews' ),
            'settings' => 'joltnews_premium_notice',
            'section'       => 'home_sections_repeater',
        )
    )
);