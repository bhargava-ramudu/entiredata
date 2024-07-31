<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JoltNews
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $joltnews_default = joltnews_get_default_theme_options();
    $sidebar = get_theme_mod( 'global_sidebar_layout', $joltnews_default['global_sidebar_layout'] );
    $joltnews_post_sidebar = esc_attr( get_post_meta( $current_id, 'joltnews_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $joltnews_header_trending_page = get_theme_mod( 'joltnews_header_trending_page' );
    $joltnews_header_popular_page = get_theme_mod( 'joltnews_header_popular_page' );
    $joltnews_archive_layout = esc_attr( get_theme_mod( 'joltnews_archive_layout', $joltnews_default['joltnews_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $joltnews_default['twp_navigation_type']);
    }

    if( $joltnews_post_sidebar == 'global-sidebar' || empty( $joltnews_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $joltnews_post_sidebar;
    }
    $joltnews_post_layout = esc_attr( get_post_meta( $current_id, 'joltnews_post_layout', true ) );
    if( $joltnews_post_layout == '' || $joltnews_post_layout == 'global-layout' ){
        
        $joltnews_post_layout = get_theme_mod( 'joltnews_single_post_layout',$joltnews_default['joltnews_archive_layout'] );
    }
    if( $joltnews_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $joltnews_header_trending_page == $current_id || $joltnews_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($joltnews_archive_layout);
        $single_layout_class = '';
    }
    $joltnews_header_trending_page = get_theme_mod( 'joltnews_header_trending_page' );
    $joltnews_header_popular_page = get_theme_mod( 'joltnews_header_popular_page' );
    if( $joltnews_header_trending_page == get_the_ID() || $joltnews_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $joltnews_ed_post_rating = get_post_meta( $post->ID, 'joltnews_ed_post_rating', true ); ?>

    <div class="singular-main-block">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main <?php if( $joltnews_ed_post_rating ){ echo 'joltnews-no-comment'; } ?>" role="main">

                        <?php
                        if( !is_home() && !is_front_page() && ( isset( $breadcrumb ) || $joltnews_post_layout != 'layout-2' ) ) {
                            joltnews_breadcrumb();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                                <?php while (have_posts()) :
                                    the_post();

                                    get_template_part('template-parts/content', 'single');

                                    /**
                                     *  Output comments wrapper if it's a post, or if comments are open,
                                     * or if there's a comment number – and check for password.
                                    **/
                                    if ( $joltnews_header_trending_page != $current_id && $joltnews_header_popular_page != $current_id ) {

                                        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                            <div class="comments-wrapper">
                                                <?php comments_template(); ?>
                                            </div>

                                        <?php
                                        }
                                    }

                                endwhile; ?>

                            </div>

                        <?php
                        else :

                            get_template_part('template-parts/content', 'none');

                        endif;

                        /**
                         * Navigation
                         * 
                         * @hooked joltnews_post_floating_nav - 10
                         * @hooked joltnews_related_posts - 20  
                         * @hooked joltnews_single_post_navigation - 30  
                        */

                        do_action('joltnews_navigation_action'); ?>

                    </main>
                </div>

                <?php
                if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                    $sidebar_status = false;
                }else{
                    $sidebar_status = true;
                }
                if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
                    get_sidebar();
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
