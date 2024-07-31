<?php
/**
 * Latest Posts
 *
 * @package JoltNews
 */
if( !function_exists('joltnews_latest_blocks') ):
    
    function joltnews_latest_blocks($joltnews_home_section,$repeat_times){

        global $post;
        $joltnews_default = joltnews_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $joltnews_default['global_sidebar_layout'] ) );

        $joltnews_archive_layout = esc_attr( get_theme_mod( 'joltnews_archive_layout', $joltnews_default['joltnews_archive_layout'] ) ); ?>
        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-archive">
            <div class="wrapper">
                <div class="column-row">
                    <div id="primary" class="content-area theme-top-sticky">
                        <main id="main" class="site-main" role="main">

                                <?php
                                if( !is_front_page() ) {
                                    joltnews_breadcrumb();
                                }

                                if( have_posts() ): ?>

                                    <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $joltnews_archive_layout ); ?>">
                                        <?php while (have_posts()) :
                                            the_post();

                                            if( !is_page() ){

                                                get_template_part( 'template-parts/content', get_post_format() );
                                                
                                            }else{
                                                get_template_part('template-parts/content', 'single');
                                            }


                                        endwhile; ?>
                                    </div>

                                    <?php if( !is_page() ): do_action('joltnews_archive_pagination'); endif;

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
    }
    
endif;
