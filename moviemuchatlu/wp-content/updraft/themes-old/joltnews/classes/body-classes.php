<?php
/**
* Body Classes.
*
* @package JoltNews
*/
 
 if (!function_exists('joltnews_body_classes')) :

    function joltnews_body_classes($classes) {

        $joltnews_default = joltnews_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
        
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$joltnews_default['global_sidebar_layout'] ) );

            if( is_single() || is_page() ){

                $joltnews_post_sidebar = esc_html( get_post_meta( $post->ID, 'joltnews_post_sidebar_option', true ) );

                if( $joltnews_post_sidebar == 'global-sidebar' || empty( $joltnews_post_sidebar ) ){

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $global_sidebar_layout );

                    }

                }else{

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $joltnews_post_sidebar );

                    }
                }
                
            }elseif( is_404() ){

                $classes[] = 'no-sidebar';

            }else{
                
                $classes[] = esc_attr( $global_sidebar_layout );
            }

        }

        if( is_page() ){

            $joltnews_header_trending_page = get_theme_mod( 'joltnews_header_trending_page' );
            $joltnews_header_popular_page = get_theme_mod( 'joltnews_header_popular_page' );

            if( $joltnews_header_trending_page == $post->ID || $joltnews_header_popular_page == $post->ID ){

                $joltnews_archive_layout = get_theme_mod( 'joltnews_archive_layout',$joltnews_default['joltnews_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$joltnews_default['ed_image_content_inverse'] );
                if( $joltnews_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $joltnews_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $joltnews_post_layout = esc_html( get_post_meta( $post->ID, 'joltnews_post_layout', true ) );

            if( $joltnews_post_layout == '' || $joltnews_post_layout == 'global-layout' ){
                
                $joltnews_post_layout = get_theme_mod( 'joltnews_single_post_layout',$joltnews_default['joltnews_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $joltnews_post_layout );

            if( $joltnews_post_layout == 'layout-2' ){
                
                $joltnews_header_overlay = esc_html( get_post_meta( $post->ID, 'joltnews_header_overlay', true ) );

                if( $joltnews_header_overlay == '' || $joltnews_header_overlay == 'global-layout' ){

                    $joltnews_post_layout2 = get_theme_mod( 'joltnews_single_post_layout',$joltnews_default['joltnews_archive_layout'] );

                    if( $joltnews_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = esc_html( get_post_meta( $post->ID, 'ed_header_overlay', true ) );
                        if( $ed_header_overlay == '' || $ed_header_overlay == 'global-layout' ){
                            
                            $ed_header_overlay = get_theme_mod( 'ed_header_overlay',$joltnews_default['ed_header_overlay'] );
                        }

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $joltnews_page_layout = get_post_meta( $post->ID, 'joltnews_page_layout', true );

            if( $joltnews_page_layout == ''  ){
                
                $joltnews_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $joltnews_page_layout );

            if( $joltnews_page_layout == 'layout-2' ){
                
                $joltnews_ed_header_overlay = get_post_meta( $post->ID, 'joltnews_ed_header_overlay', true );
                if( $joltnews_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $joltnews_archive_layout = get_theme_mod( 'joltnews_archive_layout',$joltnews_default['joltnews_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$joltnews_default['ed_image_content_inverse'] );
            if( $joltnews_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $joltnews_archive_layout );
            
        }

        if( is_singular('post') ){

            $joltnews_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'joltnews_ed_post_reaction', true ) );
            if( $joltnews_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }

        return $classes;
    }

endif;

add_filter('body_class', 'joltnews_body_classes');