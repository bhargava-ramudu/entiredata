<?php
/**
 *
 * Front Page
 *
 * @package JoltNews
 */

get_header();


    $joltnews_default = joltnews_get_default_theme_options();
    $joltnews_default = joltnews_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $joltnews_default['global_sidebar_layout'] ) );
    

    if( is_single() || is_page() ){

        $joltnews_post_sidebar = esc_attr( get_post_meta( $post->ID, 'joltnews_post_sidebar_option', true ) );
        if( $joltnews_post_sidebar == 'global-sidebar' || empty( $joltnews_post_sidebar ) ){

            $sidebar = $sidebar;
        }else{
            $sidebar = $joltnews_post_sidebar;
        }

    }
    $twp_joltnews_home_sections_5 = get_theme_mod( 'twp_joltnews_home_sections_5', json_encode( $joltnews_default['twp_joltnews_home_sections_5'] ) );
    $repeat_times = 1;
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_joltnews_home_sections_5 = json_decode( $twp_joltnews_home_sections_5 );

    if( $twp_joltnews_home_sections_5 ){ ?>

        <?php
        foreach ( $twp_joltnews_home_sections_5 as $joltnews_home_section ) {

            $home_section_type = isset( $joltnews_home_section->home_section_type ) ? $joltnews_home_section->home_section_type : '';

            switch ($home_section_type) {

                case 'main-banner':

                    $ed_slider_blocks = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                        joltnews_main_banner( $joltnews_home_section , $repeat_times);
                    }

                break;

                case 'latest-posts-blocks':

                    $ed_latest_posts_blocks = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_latest_posts_blocks == 'yes' ) {
                        joltnews_latest_blocks( $joltnews_home_section  , $repeat_times);
                    }

                break;

                case 'content-rich-blocks':

                    $ed_tiles_block = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_tiles_block == 'yes' && $paged_active ) {
                        joltnews_tiles_block_section( $joltnews_home_section , $repeat_times);
                    }

                break;

                case 'banner-blocks-1':

                    $ed_banner_blocks_1 = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                        joltnews_banner_block_1_section( $joltnews_home_section , $repeat_times);
                    }

                break;

                case 'advertise-blocks':

                    $ed_advertise_blocks = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                        joltnews_advertise_block( $joltnews_home_section , $repeat_times);
                    }
                    
                break;

                case 'home-widget-area':

                    $ed_home_widget_area = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                        joltnews_case_home_widget_area_block( $joltnews_home_section , $repeat_times);
                    }
                    
                break;

                case 'you-may-like-blocks':

                    $ed_you_may_like_area = isset( $joltnews_home_section->section_ed ) ? $joltnews_home_section->section_ed : '';
                    if ( $ed_you_may_like_area == 'yes' && $paged_active ) {
                        joltnews_you_may_like_block_section( $joltnews_home_section , $repeat_times);
                    }
                    
                break;

                default:

                break;

            }

        $repeat_times++;
        } 
        ?>

    <?php
    }

get_footer();
