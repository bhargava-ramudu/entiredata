<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JoltNews
 * @since 1.0.0
 */
get_header();

    $joltnews_default = joltnews_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $joltnews_default['global_sidebar_layout'] ) );
    $joltnews_archive_layout = esc_attr( get_theme_mod( 'joltnews_archive_layout', $joltnews_default['joltnews_archive_layout'] ) ); ?>

    <div class="theme-block theme-block-archive">
        <div class="wrapper">
            <div class="column-row">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        
                        <?php
                        if( have_posts() ): ?>

                            <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $joltnews_archive_layout ); ?>">

                                <?php while( have_posts() ):
                                    the_post();

                                    get_template_part( 'template-parts/content', get_post_format() );

                                endwhile; ?>

                            </div>

                            <?php do_action('joltnews_archive_pagination');

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>

                    </main>
                </div>

                <?php if( $sidebar != 'no-sidebar' ){

                    get_sidebar();
                    
                } ?>

            </div>
        </div>
    </div>

<?php
get_footer();
