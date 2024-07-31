<?php
/**
 * Default Values.
 *
 * @package JoltNews
 */

if (!function_exists('joltnews_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function joltnews_get_default_theme_options(){

        $joltnews_defaults = array();

        $joltnews_defaults['twp_joltnews_home_sections_5'] = array(
            array(
                'home_section_type' => 'content-rich-blocks',
                'section_ed' => 'yes',
                'cat_title_1' => esc_html__('Column Title One','joltnews'),
                'section_category_1' => '',
                'cat_title_2' => esc_html__('Column Title Two','joltnews'),
                'section_category_2' => '',
                'cat_title_4' => esc_html__('Similar Post','joltnews'),
                'cat_title_3' => esc_html__('Column Title Three','joltnews'),
                'section_category_3' => '',
                'tiles_post_per_page' => 5,
            ),
            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'no',
                'home_section_title_1' => esc_html__('Column Title Two','joltnews'),
                'home_section_title_4' => esc_html__('Column Title One','joltnews'),
                'section_post_cat_1' => '',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'home_section_title_3' => esc_html__('Column Title Three','joltnews'),
                'section_category_3' => '',
            ),
            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'section_category_1' => '',
                'section_category_2' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
                'home_section_title_1' => esc_html__('Block Title One','joltnews'),
                'home_section_title_2' => esc_html__('Block Title Tab','joltnews'),
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
                'section_video_ratio' => 'default',
                'section_video_autoplay' => 'autoplay-disable',
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'you-may-like-blocks',
                'section_ed' => 'yes',
                'home_section_title' => '',
                'section_category' => '',
            ),
        );

        // header section
        $joltnews_defaults['ed_header_new_entry_posts'] = 1;
        $joltnews_defaults['ed_header_new_entry_posts_title'] = esc_html__('New Entry : From Editor', 'joltnews');
        $joltnews_defaults['joltnews_header_new_entry_cat'] = '';

        // Options.
        $joltnews_defaults['global_sidebar_layout'] = 'left-sidebar';
        $joltnews_defaults['joltnews_archive_layout'] = 'default';
        $joltnews_defaults['joltnews_pagination_layout'] = 'numeric';
        $joltnews_defaults['footer_column_layout'] = 3;
        $joltnews_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'joltnews');
        $joltnews_defaults['ed_ticker_slider_autoplay'] = 1;
        $joltnews_defaults['ed_header_ad'] = 0;
        $joltnews_defaults['ed_header_ticker_posts'] = 1;
        $joltnews_defaults['ticker_date_format'] = 'l, F jS, Y';
        $joltnews_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'joltnews');
        $joltnews_defaults['ed_image_content_inverse'] = 0;
        $joltnews_defaults['ed_related_post'] = 1;
        $joltnews_defaults['related_post_title'] = esc_html__('More Stories', 'joltnews');
        $joltnews_defaults['twp_navigation_type'] = 'norma-navigation';
        $joltnews_defaults['joltnews_single_post_layout'] = 'layout-1';
        $joltnews_defaults['ed_post_thumbnail'] = 0;
        $joltnews_defaults['ed_post_date'] = 1;
        $joltnews_defaults['ed_post_category'] = 1;
        $joltnews_defaults['ed_header_overlay'] = 0;
        $joltnews_defaults['ed_floating_next_previous_nav'] = 1;       
        $joltnews_defaults['joltnews_header_bg_size'] = 1;
        $joltnews_defaults['ed_preloader'] = 1;
        $joltnews_defaults['ed_header_bg_fixed'] = 0;
        $joltnews_defaults['ed_header_bg_overlay'] = 0;
        $joltnews_defaults['post_date_format'] = 'default';
        $joltnews_defaults['ed_fullwidth_layout'] = 'default';
        $joltnews_defaults['ed_post_views'] = 0;
        $joltnews_defaults['ed_scroll_top_button'] = 1;

        $joltnews_defaults['ed_ticker_bar']                  = 1;
        $joltnews_defaults['ed_ticker_bar_date']             = 1;
        $joltnews_defaults['ed_tags_wide_layout']             = 1;
        $joltnews_defaults['ed_post_tags']                   = 1;
        $joltnews_defaults['ed_post_read_later']             = 0;
        $joltnews_defaults['ed_ticker_bar_social_nav']             = 1;

        // Pass through filter.
        $joltnews_defaults = apply_filters('joltnews_filter_default_theme_options', $joltnews_defaults);

        return $joltnews_defaults;

    }

endif;
