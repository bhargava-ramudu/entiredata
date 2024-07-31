<?php
/**
 * Widget FUnctions.
 *
 * @package JoltNews
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function joltnews_widgets_init(){

    $joltnews_default = joltnews_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'joltnews'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'joltnews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Offcanvas Widget', 'joltnews'),
        'id' => 'joltnews-offcanvas-widget',
        'description' => esc_html__('Add widgets here.', 'joltnews'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));

    $twp_joltnews_home_sections_5 = get_theme_mod('twp_joltnews_home_sections_5', json_encode($joltnews_default['twp_joltnews_home_sections_5']));
    $twp_joltnews_home_sections_5 = json_decode($twp_joltnews_home_sections_5);

    foreach( $twp_joltnews_home_sections_5 as $joltnews_home_section ){

        $home_section_type = isset( $joltnews_home_section->home_section_type ) ? $joltnews_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 1', 'joltnews'),
                        'id' => 'front-page-3-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 2', 'joltnews'),
                        'id' => 'front-page-3-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 3 Column - Col 3', 'joltnews'),
                        'id' => 'front-page-3-column-col-3',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));


                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 1', 'joltnews'),
                        'id' => 'front-page-2-column-col-1',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 2', 'joltnews'),
                        'id' => 'front-page-2-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page 2 Column - Col 2', 'joltnews'),
                        'id' => 'front-page-2-column-col-2',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                    register_sidebar(array(
                        'name' => esc_html__('Front Page Fullwidth', 'joltnews'),
                        'id' => 'front-page-fullwidth',
                        'description' => esc_html__('Add widgets here.', 'joltnews'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<div class="column-panel-head"><header class="block-title-wrapper"><h2 class="block-title"><span>',
                        'after_title' => '</span></h2></header></div>',
                    ));

                }

                break;

            default:

                break;

        }

    }

    $joltnews_default = joltnews_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $joltnews_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'joltnews');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'joltnews');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'joltnews');
        }
        if ($i == 3) {
            $count = esc_html__('Four', 'joltnews');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'joltnews') . $count,
            'id' => 'joltnews-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'joltnews'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>',
        ));

    }

}

add_action('widgets_init', 'joltnews_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/widget-style-1.php';
require get_template_directory() . '/inc/widgets/widget-style-2.php';
require get_template_directory() . '/inc/widgets/widget-content-rich.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/featured-category-widget.php';