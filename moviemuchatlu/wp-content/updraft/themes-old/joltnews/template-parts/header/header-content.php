<?php
/**
 * Header Layout 2
 *
 * @package JoltNews
 */
$joltnews_default = joltnews_get_default_theme_options();
$ed_header_new_entry_posts = get_theme_mod( 'ed_header_new_entry_posts', $joltnews_default['ed_header_new_entry_posts'] );
$joltnews_header_bg_size = get_theme_mod( 'joltnews_header_bg_size', $joltnews_default['joltnews_header_bg_size'] );
$ed_header_bg_fixed = get_theme_mod( 'ed_header_bg_fixed', $joltnews_default['ed_header_bg_fixed'] );
$ed_header_bg_overlay = get_theme_mod( 'ed_header_bg_overlay', $joltnews_default['ed_header_bg_overlay'] ); ?>

<header id="site-header" class="theme-header <?php if( $ed_header_bg_overlay ){ echo 'header-overlay-enabled'; } ?>" role="banner">

    <div class="header-mainbar <?php if( get_header_image() ){ if( $ed_header_bg_fixed ){ echo 'data-bg-fixed'; } ?> data-bg header-bg-<?php echo esc_attr( $joltnews_header_bg_size ); ?> <?php } ?> "  <?php if( get_header_image() ){ ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <div class="header-titles">
                    <?php
                    joltnews_site_logo();
                    joltnews_site_description();
                    ?>
                </div>
            </div>
            <?php  if ($ed_header_new_entry_posts) { ?>
                <div class="header-item header-item-right hidden-sm-element ">
                    <div class="header-latest-entry">
                        <?php joltnews_content_new_entry_news_render(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php joltnews_date_clock_bar(); ?>
    
    <div class="header-navbar">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <?php if (is_active_sidebar('joltnews-offcanvas-widget')): ?>
                    <div id="widgets-nav" class="icon-sidr">
                        <a href="javascript:void(0)" id="hamburger-one">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                <?php endif; ?>
                <div class="header-navigation-wrapper">
                    <div class="site-navigation">
                        <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'joltnews'); ?>" role="navigation">
                            <ul class="primary-menu theme-menu">
                                <?php
                                if( has_nav_menu('joltnews-primary-menu') ){

                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'joltnews-primary-menu',
                                            'walker' => new joltnews\JoltNews_Walkernav(),
                                        )
                                    );

                                }else{

                                    wp_list_pages(
                                        array(
                                            'match_menu_classes' => true,
                                            'show_sub_menu_icons' => true,
                                            'title_li' => false,
                                            'walker' => new JoltNews_Walker_Page(),
                                        )
                                    );

                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>

            <div class="header-item header-item-right">
                <?php main_navigation_extras(); ?>
            </div>
        </div>
        <div class="twp-progress-bar" id="progressbar"></div>
    </div>

    <div class="theme-tickerbar hidden-xs-element">
        <div class="wrapper header-wrapper">
            <div class="header-item header-item-left">
                <?php joltnews_header_ticker_posts(); ?>
            </div>
            <div class="header-item header-item-right">
                <div class="ticker-controls">
                    <button type="button" class="slide-btn theme-aria-button slide-prev-ticker">
                        <span class="btn__content" tabindex="-1">
                            <?php joltnews_theme_svg('chevron-left'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-play">
                        <span class="btn__content" tabindex="-1">
                            <?php joltnews_theme_svg('play'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button ticker-control ticker-control-pause pp-button-active">
                        <span class="btn__content" tabindex="-1">
                            <?php joltnews_theme_svg('pause'); ?>
                        </span>
                    </button>

                    <button type="button" class="slide-btn theme-aria-button slide-next-ticker">
                        <span class="btn__content" tabindex="-1">
                            <?php joltnews_theme_svg('chevron-right'); ?>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
