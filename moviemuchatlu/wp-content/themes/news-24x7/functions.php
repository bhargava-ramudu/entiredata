<?php

require get_stylesheet_directory() . '/customizer/options-breaking-news.php';
require get_stylesheet_directory() . '/customizer/options-featured-posts.php';
require get_stylesheet_directory() . '/customizer/options-repeater-news-section.php';

require get_stylesheet_directory() . '/sections/breaking-news.php';
require get_stylesheet_directory() . '/sections/featured-posts.php';
require get_stylesheet_directory() . '/sections/news-section.php';

require get_stylesheet_directory() . '/repeater-news-sections/post-grid.php';
require get_stylesheet_directory() . '/repeater-news-sections/post-grid-2.php';
require get_stylesheet_directory() . '/repeater-news-sections/post-tab.php';
require get_stylesheet_directory() . '/repeater-news-sections/image.php';

add_action( 'wp_enqueue_scripts', 'news_24x7_chld_thm_parent_css' );
function news_24x7_chld_thm_parent_css() {

    $my_theme = wp_get_theme();
    
    $theme_version = $my_theme->get( 'Version' );

    wp_enqueue_style( 
    	'news_24x7_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );

    if ( is_rtl() ) {
        wp_enqueue_style( 
            'news_24x7_parent_rtl', 
            trailingslashit( get_template_directory_uri() ) . 'rtl.css'
        );
    }

    wp_enqueue_script( 'jquery-marquee', get_stylesheet_directory_uri() . '/js/jquery.marquee.js', array('jquery'), $theme_version );
    wp_enqueue_script( 'news_24x7_scripts', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), $theme_version );
    wp_localize_script( 'news_24x7_scripts', 'news_24x7_object',
        array( 
            'fresh_stories_slides_to_show' => bizberg_get_theme_mod( 'news_24x7_featured_news_slides_to_show_before_scroll' ),
        )
    );
    
}

add_filter( 'bizberg_primary_header_layout', 'news_24x7_primary_header_layout' );
function news_24x7_primary_header_layout(){
    return 'center';
}

add_filter( 'bizberg_primary_header_layout_bottom_border_color', 'news_24x7_primary_header_layout_bottom_border_color' );
add_filter( 'bizberg_top_bar_border_bottom_color', 'news_24x7_primary_header_layout_bottom_border_color' );
function news_24x7_primary_header_layout_bottom_border_color(){
    return '#eee';
}

add_filter( 'bizberg_top_bar_icon_color', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_top_bar_info_box_color', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_header_site_title_color_sticky_menu', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_header_site_tagline_color_sticky_menu', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_header_menu_toggle_color_mobile', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_sidebar_widget_title_color', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_header_menu_font_mobile', 'news_24x7_top_bar_icon_color' );
add_filter( 'bizberg_header_menu_text_color', 'news_24x7_top_bar_icon_color' );
function news_24x7_top_bar_icon_color(){
    return '#fff';
}

add_filter( 'bizberg_site_title_font', 'news_24x7_site_title_font' );
function news_24x7_site_title_font(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '700',
        'font-size'      => '50px',
        'line-height'    => '1.2',
        'letter-spacing' => '0px',
        'text-transform' => 'capitalize',
        'text-align'     => 'left',
    ];
}

add_filter( 'bizberg_site_tagline_font', 'news_24x7_site_tagline_font' );
function news_24x7_site_tagline_font(){
    return [
        'font-family'    => 'Poppins',
        'variant'        => '500',
        'font-size'      => '16px',
        'line-height'    => '1.8',
        'letter-spacing' => '0',
        'text-transform' => 'none',
        'text-align'     => 'left',
    ];
}

add_filter( 'bizberg_slider_banner_settings', 'news_24x7_slider_banner_settings' );
function news_24x7_slider_banner_settings(){
    return 'none';
}

add_filter( 'bizberg_header_button_padding', 'news_24x7_bizberg_header_button_padding' );
function news_24x7_bizberg_header_button_padding(){
    return array(
        'top'  => '4px',
        'bottom'  => '4px',
        'left' => '16px',
        'right' => '16px',
    );
}

add_filter( 'bizberg_header_button_color', 'news_24x7_bizberg_header_button_color' );
add_filter( 'bizberg_header_button_color_hover', 'news_24x7_bizberg_header_button_color' );
function news_24x7_bizberg_header_button_color(){
    return '#000';
}

add_action( 'init', 'news_24x7_colors' );
function news_24x7_colors(){

    $options = array(
        'bizberg_slider_title_box_highlight_color',
        'bizberg_slider_arrow_background_color',
        'bizberg_slider_dot_active_color',
        'bizberg_read_more_background_color',
        'bizberg_theme_color',
        'bizberg_link_color_hover',
        'bizberg_blog_listing_pagination_active_hover_color',
        'bizberg_sidebar_widget_link_color_hover',
        'bizberg_footer_social_icon_color',
        'bizberg_footer_copyright_background',
        'bizberg_header_menu_color_hover_sticky_menu',
        'bizberg_shop_quick_view_background',
        'bizberg_shop_price_color',
        'bizberg_header_navbar_background_1',
        'bizberg_link_color',
        'bizberg_background_color_2',
        'bizberg_background_color_1',
        'bizberg_header_navbar_background_2',
        'bizberg_header_menu_background_hover_mobile'
    );

    foreach ( $options as $value ) {
        
        add_filter( $value , function(){
            return '#2962ff';
        });

    }

}

add_filter( 'bizberg_header_2_spacing', 'news_24x7_header_2_spacing' );
function news_24x7_header_2_spacing(){
    return [
        'padding-top'  => '0px',
        'padding-bottom'  => '0px',
    ];
}

add_action( 'customize_register', 'news_24x7_customizer_options', 100 );
function news_24x7_customizer_options( $wp_customize ){

    $wp_customize->get_control('header_site_title_color_sticky_menu')->label = esc_html__( 'Site Title Color ( Mobile / Tablet )', 'news-24x7' );
    $wp_customize->get_control('header_site_tagline_color_sticky_menu')->label = esc_html__( 'Site Tagline Color ( Mobile / Tablet )', 'news-24x7' );

    /**
    * Remove sections/panels/control of parent theme
    */
    
    $wp_customize->remove_section("transparent_header");
    $wp_customize->remove_section("progress_bar");

    $wp_customize->remove_control("header_menu_color_hover_sticky_menu");
    $wp_customize->remove_control("header_menu_separator_sticky_menu");
    $wp_customize->remove_control("header_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_2_sticky_menu");
    $wp_customize->remove_control("header_navbar_background_1_sticky_menu");
    $wp_customize->remove_control("header_sticky_menu_options_heading");
    $wp_customize->remove_control("header_menu_child_menu_background_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_border_sticky_menu");
    $wp_customize->remove_control("header_menu_child_menu_text_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_sticky_menu");
    $wp_customize->remove_control("header_button_color_hover_sticky_menu");
    $wp_customize->remove_control("header_button_border_color_sticky_menu");
    $wp_customize->remove_control("header_menu_slide_in_animation");
    $wp_customize->remove_control("main_menu_dropdown_height");

}

add_filter( 'bizberg_sticky_header_status', 'news_24x7_sticky_header_status' );
function news_24x7_sticky_header_status(){
    return 'false';
}

add_filter( 'bizberg_sidebar_spacing_status', 'news_24x7_sidebar_spacing_status' );
function news_24x7_sidebar_spacing_status(){
    return '0px';
}

add_filter( 'bizberg_sidebar_widget_background_color', 'news_24x7_sidebar_widget_background_color' );
add_filter( 'bizberg_sidebar_widget_border_color', 'news_24x7_sidebar_widget_background_color' );
function news_24x7_sidebar_widget_background_color(){
    return 'rgba(251,251,251,0)';
}

add_filter( 'bizberg_body_typo_heading_1_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_body_typo_heading_2_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_body_typo_heading_3_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_body_typo_heading_4_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_body_content_typo_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_woo_product_color_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_sidebar_widget_heading_font_size_status', 'news_24x7_body_typo_heading_2_status' );
add_filter( 'bizberg_slick_slider_status', 'news_24x7_body_typo_heading_2_status' );
function news_24x7_body_typo_heading_2_status(){
    return true;
}

add_filter( 'bizberg_typography_h1', 'news_24x7_bizberg_typography_h1' );
function news_24x7_bizberg_typography_h1(){
    return [
        'font-family'    => 'PT Serif',
        'variant'        => '700',
        'font-size'      => '54.93px',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h1_tablet', 'news_24x7_typography_h1_tablet' );
add_filter( 'bizberg_typography_h1_mobile', 'news_24x7_typography_h1_tablet' );
function news_24x7_typography_h1_tablet(){
    return 48.83;
}

add_filter( 'bizberg_typography_h2', 'news_24x7_bizberg_typography_h2' );
function news_24x7_bizberg_typography_h2(){
    return [
        'font-family'    => 'PT Serif',
        'variant'        => '700',
        'font-size'      => '43.95px',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h2_tablet', 'news_24x7_typography_h2_tablet' );
add_filter( 'bizberg_typography_h2_mobile', 'news_24x7_typography_h2_tablet' );
function news_24x7_typography_h2_tablet(){
    return 39.06;
}

add_filter( 'bizberg_typography_h3', 'news_24x7_bizberg_typography_h3' );
function news_24x7_bizberg_typography_h3(){
    return [
        'font-family'    => 'PT Serif',
        'variant'        => '700',
        'font-size'      => '35.16px',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h3_tablet', 'news_24x7_typography_h3_tablet' );
add_filter( 'bizberg_typography_h3_mobile', 'news_24x7_typography_h3_tablet' );
function news_24x7_typography_h3_tablet(){
    return 31.25;
}


add_filter( 'bizberg_typography_h4', 'news_24x7_bizberg_typography_h4' );
function news_24x7_bizberg_typography_h4(){
    return [
        'font-family'    => 'PT Serif',
        'variant'        => '700',
        'font-size'      => '28.13px',
        'line-height'    => '1.2',
        'letter-spacing' => '0',
        'text-transform' => 'inherit'
    ];
}

add_filter( 'bizberg_typography_h4_tablet', 'news_24x7_typography_h4_tablet' );
add_filter( 'bizberg_typography_h4_mobile', 'news_24x7_typography_h4_tablet' );
function news_24x7_typography_h4_tablet(){
    return 25.00;
}

add_filter( 'bizberg_theme_text_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_sidebar_widget_link_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_link_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_heading_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_header_menu_background_mobile', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_header_site_title_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_header_site_tagline_color', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_header_menu_color_hover', 'news_24x7_theme_text_color' );
add_filter( 'bizberg_header_menu_child_menu_text_color', 'news_24x7_theme_text_color' );
function news_24x7_theme_text_color(){
    return '#000';
}

add_filter( 'bizberg_typography_body_content', 'news_24x7_typography_body_content' );
function news_24x7_typography_body_content(){
    return [
        'font-family'    => 'Nunito Sans',
        'variant'        => 'regular',
        'font-size'      => '18px',
        'line-height'    => '1.8'
    ];
}

add_filter( 'bizberg_single_post_layout', 'news_24x7_single_post_layout' );
function news_24x7_single_post_layout(){
    return 2;
}

add_filter( 'bizberg_typography_body_content_output_css', 'news_24x7_typography_body_content_output_css' );
function news_24x7_typography_body_content_output_css( $css ){
    $css[] = [
        'element' => 'p'
    ];
    return $css;
}

add_filter( 'bizberg_excerpt_length', 'news_24x7_excerpt_length' );
function news_24x7_excerpt_length(){
    return 25;
}

add_filter( 'bizberg_sticky_sidebar_margin_top_status', 'news_24x7_sticky_sidebar_margin_top_status' );
function news_24x7_sticky_sidebar_margin_top_status(){
    return 30;
}

add_filter( 'bizberg_link_color_hover_output_css', 'news_24x7_link_color_hover_output_css' );
function news_24x7_link_color_hover_output_css( $css ){
    $css[] = array(
        'element'  => '.bizberg_grid_mode_two_col .blog_listing_grid_two_column h2.entry-title a:hover, .single_post_layout_2 .related_posts_wrapper .related_posts h2 a:hover',
        'property'      => 'background',
        'value_pattern' => 'linear-gradient(to right, $, $)'
    );
    $css[] = array(
        'element'       => '.news-stories-date a, .news-popular-content-title a, .news-stories button.slick-arrow:hover:before, body .news_24_section_1_wrapper .grid_small .list h4 a:hover, .news_24_section_2_wrapper .tab_content .column.right .list .meta h4 a:hover, .news_24x7_post_grid_2 .section_wrapper .column.right .list h4 a:hover, .news_24x7_post_grid_2 .section_wrapper .column.right .list .time_ago small a:hover',
        'property'      => 'color',
        'value_pattern' => '$'
    );
    $css[] = array(
        'element'       => '.news-main-m-info p a, .news_24_section_1_wrapper .meta-info .post-category, .news_24_section_2_wrapper .rt-post-tab .post-cat-tab a.current, .news_24_section_2_wrapper .rt-post-tab .post-cat-tab a:hover, .news_24_section_2_wrapper .tab_content .column.left .post_list .meta-info a.post-category, .news_24x7_post_grid_2 .section_wrapper .column.left .post_list .meta-info a.post-category',
        'property'      => 'background',
        'value_pattern' => '$'
    );
    return $css;
}

add_filter( 'bizberg_link_color_output_css', 'news_24x7_link_color_output_css' );
function news_24x7_link_color_output_css( $css ){
    $css[] = array(
        'element'  => '.bizberg_grid_mode_two_col .blog_listing_grid_two_column h2.entry-title a, .single_post_layout_2 .related_posts_wrapper .related_posts h2 a',
        'property'      => 'background',
        'value_pattern' => 'linear-gradient(to right, $, $)'
    );
    return $css;
}

add_filter( 'bizberg_theme_output_css', 'news_24x7_theme_output_css' );
function news_24x7_theme_output_css( $css ){
    $css[] = array(
        'element'       => '.bizberg_sidebar #sidebar .widget h2::after,.bizberg_sidebar #sidebar .wp-block-search .wp-block-search__label::after',
        'property'      => 'border-top-color',
        'value_pattern' => '$'
    );
    $css[] = array(
        'element'           => '.bizberg_sidebar #sidebar .widget h2, .bizberg_sidebar #sidebar .wp-block-search .wp-block-search__label',
        'property'          => 'background'
    );
    $css[] = array(
        'element'       => '.breaking-news-in .row h3.title,.news-stories-title h3::before,.news-popular h3::before, .news_24_section_1_wrapper h4.main_title, .news_24_section_2_wrapper h4.related-title .title, .news_24_section_2_wrapper .section-title .related-title .titledot, .section-title.news24x7 .related-title .title, .section-title.news24x7 .related-title .titledot',
        'property'      => 'background',
        'value_pattern' => '$'
    );
    $css[] = array(
        'element'       => '.breaking-news-in .row h3.title::before',
        'property'      => 'border-left-color',
        'value_pattern' => '$'
    );
    $css[] = array(
        'element'       => 'body.rtl .breaking-news-in .row h3.title::before',
        'property'      => 'border-right-color',
        'value_pattern' => '$'
    );
    return $css;
}

function news_24x7_adjust_brightness_09( $hexCode, $adjustPercent = '0.9' ) {

    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);

}

add_filter( 'bizberg_number_setting_desktop_sidebar_widget_heading_font_sizes', 'news_24x7_number_setting_desktop_sidebar_widget_heading_font_sizes' );
add_filter( 'bizberg_number_setting_tablet_sidebar_widget_heading_font_sizes', 'news_24x7_number_setting_desktop_sidebar_widget_heading_font_sizes' );
add_filter( 'bizberg_number_setting_mobile_sidebar_widget_heading_font_sizes', 'news_24x7_number_setting_desktop_sidebar_widget_heading_font_sizes' );
function news_24x7_number_setting_desktop_sidebar_widget_heading_font_sizes(){
    return 22;
}

add_action( 'after_setup_theme', 'news_24x7_setup_theme' );
function news_24x7_setup_theme() {

    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );

    $starter_content = array(
        'posts' => array(
            'home',
            'about',
            'contact',
            'blog'
        ),
        'options' => array(
            'show_on_front' => 'posts'
        ),
        'nav_menus' => array(
            'menu-1' => array(
                'name' => __( 'Main Menu', 'news-24x7' ),
                'items' => array(
                    'page_home',
                    'page_about',
                    'page_blog',
                    'page_news'
                ),
            ),
            'footer' => array(
                'name' => __( 'Footer Menu', 'news-24x7' ),
                'items' => array(
                    'page_home',
                    'page_about',
                    'page_blog',
                    'page_news'
                ),
            ),
        ),
        'widgets' => array(
            'bizberg_header' => array( 
                'my_media_image' => array(
                    'media_image',  
                    array(
                       'size'   => 'full',
                       'width'  => 800,
                       'height' => 90,
                       'url'    => get_stylesheet_directory_uri() . '/images/ads.jpg',
                    )
                )
            )
        ),
        'theme_mods' => array(
            'news_24x7_breaking_news_title'                 => esc_html__( 'Breaking News', 'news-24x7' ),
            'news_24x7_featured_news_scrolling_posts_title' => esc_html__( 'Fresh Stories', 'news-24x7' ),
            'news_24x7_featured_news_popular_news_title'    => esc_html__( 'Popular News', 'news-24x7' ),
            'news_24x7_repeater_news'                       => array(
                array(
                    'layout'                  => 3,
                    'layout_3_image'          => get_stylesheet_directory_uri() . '/images/ads.jpg',
                    'layout_3_spacing_top'    => 20,
                    'layout_3_spacing_bottom' => 20
                ),
                array(
                    'layout_1_title'          => esc_html__( 'Editor Choice', 'news-24x7' ),
                    'layout'                  => 1,
                    'layout_1_limit'          => 12,
                    'layout_1_columns'        => '4|4',
                ),
                array(
                    'layout'                  => 3,
                    'layout_3_image'          => get_stylesheet_directory_uri() . '/images/ads.jpg',
                    'layout_3_spacing_top'    => 20,
                    'layout_3_spacing_bottom' => 20
                ),
                array(
                    'layout_2_title'          => esc_html__( 'Exclusive', 'news-24x7' ),
                    'layout'                  => 2,
                    'layout_2_limit'          => 7
                ),
                array(
                    'layout'                  => 3,
                    'layout_3_image'          => get_stylesheet_directory_uri() . '/images/ads.jpg',
                    'layout_3_spacing_top'    => 20,
                    'layout_3_spacing_bottom' => 20
                ),
                array(
                    'layout_4_title'          => esc_html__( 'In Spotlight', 'news-24x7' ),
                    'layout'                  => 4,
                    'layout_4_limit'          => 5,
                    'layout_4_columns'        => '50%|25%|25%',
                ),
                array(
                    'layout'                  => 3,
                    'layout_3_image'          => get_stylesheet_directory_uri() . '/images/ads.jpg',
                    'layout_3_spacing_top'    => 20,
                    'layout_3_spacing_bottom' => 20
                ),
            )
        )
    );

    add_theme_support( 'starter-content', $starter_content );

}

add_filter( 'bizberg_plugins', 'news_24x7_plugins', 999 );
function news_24x7_plugins(){

    $plugins = array(
        array(
            'slug' => 'one-click-demo-import/one-click-demo-import.php',
            'zip'  => 'one-click-demo-import'
        ), 
        array(
            'slug' => 'cyclone-demo-importer/index.php',
            'zip'  => 'cyclone-demo-importer'
        )           
    );

    return $plugins;

}

add_filter( 'bizberg_recommended_plugins', 'news_24x7_recommended_plugins' );
function news_24x7_recommended_plugins( $plugins ){

    $plugins = array(

        array(
            'name'     => esc_html__( 'One Click Demo Import', 'news-24x7' ),
            'slug'     => 'one-click-demo-import',
            'required' => false,
        ),
        array(
            'name'     => esc_html__( 'Cyclone Demo Importer', 'news-24x7' ),
            'slug'     => 'cyclone-demo-importer',
            'required' => false
        )

    );

    return $plugins;

}

add_filter( 'bizberg_sticky_content_sidebar' , 'news_24x7_sticky_content_sidebar' );
add_filter( 'bizberg_footer_social_links' , 'news_24x7_sticky_content_sidebar' );
function news_24x7_sticky_content_sidebar(){
    return false;
}

add_filter( 'body_class', 'news_24x7_body_class' );
function news_24x7_body_class( $classes ){
    return array_merge( $classes, array( 'news_24x7' ) );
}

add_filter( 'bizberg_header_columns_middle_style', 'news_24x7_header_columns' );
function news_24x7_header_columns(){
    return 'col-sm-2|col-sm-8|col-sm-2';
}

add_filter( 'bizberg_theme_container_width', 'news_24x7_theme_container_width' );
function news_24x7_theme_container_width(){
    return 1300;
}

add_action( 'init' , 'news_24x7_customizer_sections' );
function news_24x7_customizer_sections(){
    Kirki::add_panel( 'news_24x7_frontpage_sections', array(
        'title'          => esc_html__( 'Homepage News Sections', 'news-24x7' ),
        'priority'       => 1,
    ) );
}

function news_24x7_time_elapsed_string( $datetime ) {
    return sprintf( esc_html__( '%s ago', 'news-24x7' ), human_time_diff( strtotime($datetime), current_time( 'timestamp' ) ) );
}

add_filter( 'bizberg_header_background_image', 'news_24x7_header_background_image' );
function news_24x7_header_background_image(){
    return [
        'background-color'      => '#eee',
        'background-image'      => '',
        'background-repeat'     => 'repeat',
        'background-position'   => 'center center',
        'background-size'       => 'cover',
        'background-attachment' => 'scroll',
    ];
}

add_filter( 'bizberg_primary_header_layout_top_border_color', 'news_24x7_primary_header_layout_top_border_color' );
function news_24x7_primary_header_layout_top_border_color(){
    return 'rgba(237,237,237,0)';
}

add_filter( 'bizberg_header_2_position', 'news_24x7_header_2_position' );
function news_24x7_header_2_position(){
    return 'left';
}

add_filter( 'bizberg_last_item_header', 'news_24x7_last_item_header' );
function news_24x7_last_item_header(){
    return 'widget';
}

add_filter( 'bizberg_primary_header_layout_bottom_border_size', 'news_24x7_primary_header_layout_bottom_border_size' );
function news_24x7_primary_header_layout_bottom_border_size(){
    return 5;
}

add_filter( 'news_24x7_repeater_news_default_value', 'news_24x7_repeater_news_default_value_1' );
function news_24x7_repeater_news_default_value_1( $data ){

    $grid = [];
    $grid['layout']           = 1;
    $grid['layout_1_title']   = esc_html__( 'Editor Choice', 'news-24x7' );
    $grid['layout_1_limit']   = 12;
    $grid['layout_1_columns'] = '4|4';
    array_push( $data, $grid );
    return $data;
}

add_filter( 'news_24x7_repeater_news_default_value', 'news_24x7_repeater_news_default_value_2' );
function news_24x7_repeater_news_default_value_2( $data ){

    $grid = [];
    $grid['layout']         = 2;
    $grid['layout_2_title']   = esc_html__( 'Exclusive', 'news-24x7' );
    $grid['layout_2_limit'] = 7;
    array_push( $data, $grid );
    return $data;
}

add_filter( 'news_24x7_repeater_news_default_value', 'news_24x7_repeater_news_default_value_3' );
function news_24x7_repeater_news_default_value_3( $data ){

    $grid = [];
    $grid['layout']                  = 4;
    $grid['layout_4_limit']          = 5;
    $grid['layout_4_title']          = esc_html__( 'In Spotlight', 'news-24x7' );
    $grid['layout_4_columns']        = '50%|25%|25%';
    array_push( $data, $grid );
    return $data;

}

add_filter( 'bizberg_getting_started_screenshot', 'news_24x7_getting_started_screenshot' );
function news_24x7_getting_started_screenshot(){
    return true;
}