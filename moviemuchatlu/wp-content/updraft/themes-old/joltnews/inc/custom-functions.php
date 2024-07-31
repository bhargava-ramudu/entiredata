<?php
/**
 * Custom Functions.
 *
 * @package JoltNews
 */

if( !function_exists( 'joltnews_fonts_url' ) ) :

    //Google Fonts URL
    function joltnews_fonts_url(){

        $font_families = array(
            'Roboto:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700',
            'Source+Serif+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700',
        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);
    }

endif;

if( !function_exists( 'joltnews_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'joltnews_page_lists' ) ) :

    // Page List.
    function joltnews_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','joltnews' );
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'joltnews_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'joltnews_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function joltnews_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * JoltNews SVG Icon helper functions
 *
 * @package JoltNews
 * @since 1.0.0
 */
if ( ! function_exists( 'joltnews_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the JoltNews_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function joltnews_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return joltnews_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in joltnews_get_theme_svg();.

        }else{

            echo joltnews_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in joltnews_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'joltnews_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function joltnews_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            JoltNews_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;

if ( ! function_exists( 'joltnews_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function joltnews_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;

if( !function_exists('joltnews_post_format_icon') ):

    // Post Format Icon.
    function joltnews_post_format_icon( $format ){

        if( $format == 'video' ){
            $icon = joltnews_get_theme_svg( 'video' );
        }elseif( $format == 'audio' ){
            $icon = joltnews_get_theme_svg( 'audio' );
        }elseif( $format == 'gallery' ){
            $icon = joltnews_get_theme_svg( 'gallery' );
        }elseif( $format == 'quote' ){
            $icon = joltnews_get_theme_svg( 'quote' );
        }elseif( $format == 'image' ){
            $icon = joltnews_get_theme_svg( 'image' );
        }else{
            $icon = '';
        }

        return $icon;
    }

endif;

if( !function_exists( 'joltnews_social_menu_icon' ) ) :

    function joltnews_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'joltnews-social-menu' === $args->theme_location ) {

            $svg = JoltNews_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = joltnews_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'joltnews_social_menu_icon', 10, 4 );

if ( ! function_exists( 'joltnews_sub_menu_toggle_button' ) ) :

    function joltnews_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'joltnews-primary-menu' && isset( $args->show_toggles ) ) {
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';
            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'joltnews' ) . '</span>' . joltnews_get_theme_svg( 'chevron-down' ) . '</span></button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)
        } elseif ( $args->theme_location == 'joltnews-primary-menu' ) {
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = joltnews_get_theme_svg( 'chevron-down' ) . '</div>';
            } else {
                $args->before = '';
                $args->after  = '';
            }
        }
        return $args;

    }

    add_filter( 'nav_menu_item_args', 'joltnews_sub_menu_toggle_button', 10, 3 );

endif;


if( !function_exists( 'joltnews_post_category_list' ) ) :

    // Post Category List.
    function joltnews_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( 'Select Category','joltnews' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('joltnews_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function joltnews_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('joltnews_disable_post_views') ):

    /** Disable Post Views **/
    function joltnews_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', 'joltnews_disable_views_ed');

    }

endif;

if( !function_exists('joltnews_disable_views_ed') ):

    /** Disable Reaction **/
    function joltnews_disable_views_ed() {

        return false;

    }

endif;

if( !function_exists('joltnews_disable_post_read_time') ):

    /** Disable Read Time **/
    function joltnews_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', 'joltnews_disable_read_time');

    }

endif;

if( !function_exists('joltnews_disable_read_time') ):

    /** Disable Reaction **/
    function joltnews_disable_read_time() {

        return false;

    }

endif;

if( !function_exists('joltnews_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function joltnews_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', 'joltnews_disable_like_ed');

    }

endif;

if( !function_exists('joltnews_disable_like_ed') ):

    /** Disable Reaction **/
    function joltnews_disable_like_ed() {

        return false;

    }

endif;

if( !function_exists('joltnews_disable_post_author_box') ):

    /** Disable Author Box **/
    function joltnews_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed','joltnews_disable_ab_ed');

    }

endif;

if( !function_exists('joltnews_disable_ab_ed') ):

    /** Disable Reaction **/
    function joltnews_disable_ab_ed() {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'joltnews_disable_social_share');

if( !function_exists('joltnews_disable_social_share') ):

    /** Disable Reaction **/
    function joltnews_disable_social_share() {

        return false;

    }

endif;

if( !function_exists('joltnews_disable_post_reaction') ):

    /** Disable Reaction **/
    function joltnews_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', 'joltnews_disable_reaction_cb');

    }

endif;

if( !function_exists('joltnews_disable_reaction_cb') ):

    /** Disable Reaction **/
    function joltnews_disable_reaction_cb() {

        return false;

    }

endif;

if( !function_exists( 'joltnews_header_ad' ) ):

    function joltnews_header_ad(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_header_ad = get_theme_mod( 'ed_header_ad',$joltnews_default['ed_header_ad'] );
        $header_ad_image = get_theme_mod( 'header_ad_image' );
        $ed_header_link = get_theme_mod( 'ed_header_link' );

        if( $ed_header_ad ){

            ?>

            <div class="theme-header-ads">
                <div class="wrapper">
                    <?php if ($header_ad_image) { ?>
                        <a target="_blank" href="<?php echo esc_url($ed_header_link); ?>">
                            <img src="<?php echo esc_url($header_ad_image); ?>" title="<?php esc_attr_e('Header AD Image', 'joltnews'); ?>" alt="<?php esc_attr_e('Header AD Image', 'joltnews'); ?>"/>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <?php

        }
    }

endif;

if( !function_exists('joltnews_post_floating_nav') ):

    function joltnews_post_floating_nav(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$joltnews_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'joltnews'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'joltnews'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'joltnews_navigation_action','joltnews_post_floating_nav',10 );

if( !function_exists('joltnews_single_post_navigation') ):

    function joltnews_single_post_navigation(){

        $joltnews_default = joltnews_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $joltnews_header_trending_page = get_theme_mod( 'joltnews_header_trending_page' );
        $joltnews_header_popular_page = get_theme_mod( 'joltnews_header_popular_page' );
        $joltnews_archive_layout = esc_attr( get_theme_mod( 'joltnews_archive_layout', $joltnews_default['joltnews_archive_layout'] ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $joltnews_default['twp_navigation_type']);
        }

        if( $joltnews_header_trending_page != $current_id && $joltnews_header_popular_page != $current_id ){

            if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

                if( $twp_navigation_type == 'norma-navigation' ){ ?>

                    <div class="navigation-wrapper">
                        <?php
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => '<span class="arrow" aria-hidden="true">' . joltnews_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'joltnews') . '</span><span class="post-title">%title</span>',
                            'next_text' => '<span class="arrow" aria-hidden="true">' . joltnews_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'joltnews') . '</span><span class="post-title">%title</span>',
                        )); ?>
                    </div>
                    <?php

                }else{
                    $next_post = get_next_post();
                    if( isset( $next_post->ID ) ){

                        $next_post_id = $next_post->ID;
                        echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                    }
                }

            }

        }

    }

endif;

add_action( 'joltnews_navigation_action','joltnews_single_post_navigation',30 );


if( !function_exists('joltnews_header_banner') ):

    function joltnews_header_banner(){

        global $post;

        if( have_posts() ):

            while (have_posts()) :
                the_post();

                global $post;
                
            endwhile;

        endif;
        
        $joltnews_post_layout = '';
        $joltnews_default = joltnews_get_default_theme_options();

        if( is_singular() ){

            $joltnews_post_layout = esc_html( get_post_meta( $post->ID, 'joltnews_post_layout', true ) );
            if( $joltnews_post_layout == '' || $joltnews_post_layout == 'global-layout' ){
                
                $joltnews_post_layout = get_theme_mod( 'joltnews_single_post_layout',$joltnews_default['joltnews_archive_layout'] );
            }

        }

        if( isset( $post->ID ) ){

            $joltnews_page_layout = esc_html( get_post_meta( $post->ID, 'joltnews_page_layout', true ) );

        }

        if( $joltnews_post_layout == 'layout-2' && is_singular('post') ) {

            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    $joltnews_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'joltnews_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $joltnews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    joltnews_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <div class="entry-meta">
                                                <?php
                                                joltnews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false);
                                                ?>
                                            </div>

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                        <div class="entry-meta">
                                            <?php
                                            joltnews_posted_by();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $joltnews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

        if( is_singular('page') && $joltnews_page_layout == 'layout-2' ) {

            if ( have_posts() ) :

                while ( have_posts() ) :

                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    
                    $joltnews_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'joltnews_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $joltnews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    joltnews_breadcrumb();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $joltnews_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

    }

endif;

if ( ! function_exists( 'joltnews_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function joltnews_header_toggle_search() { ?>

        <div class="header-searchbar">
            <div class="header-searchbar-inner">
                <div class="wrapper">
                    <div class="header-searchbar-panel">

                        <div class="header-searchbar-area">
                            <a class="skip-link-search-top" href="javascript:void(0)"></a>
                            <?php get_search_form(); ?>
                        </div>

                        <button type="button" id="search-closer" class="close-popup">
                            <?php joltnews_theme_svg('cross'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'joltnews_before_footer_content_action','joltnews_header_toggle_search',10 );


if( !function_exists('joltnews_date_clock_bar') ):

    function joltnews_date_clock_bar(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_ticker_bar = get_theme_mod( 'ed_ticker_bar', $joltnews_default['ed_ticker_bar'] );

        if( $ed_ticker_bar ){ ?>

            <div id="theme-extraarea" class="theme-extrabar">
                
                <?php joltnews_extra_area_render(); ?>

            </div>

        <?php
        }

    }

endif;

if( !function_exists('joltnews_extra_area_render') ):

    function joltnews_extra_area_render( $render = true ){

        ob_start();

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_ticker_bar = get_theme_mod( 'ed_ticker_bar', $joltnews_default['ed_ticker_bar'] );
        $ed_ticker_bar_date = get_theme_mod( 'ed_ticker_bar_date', $joltnews_default['ed_ticker_bar_date'] );
        $ticker_date_format = get_theme_mod( 'ticker_date_format', $joltnews_default['ticker_date_format'] );
        $ed_ticker_bar_social_nav = get_theme_mod( 'ed_ticker_bar_social_nav', $joltnews_default['ed_ticker_bar_social_nav'] );

        if( $ed_ticker_bar && ( has_nav_menu('joltnews-social-menu') || $ed_ticker_bar_date ) ){ ?>

            <div class="wrapper header-wrapper">
                <div class="header-item header-item-left">
                    <?php
                    if ($ed_ticker_bar_date) {
                     ?>
                        <div class="theme-extrabar-item theme-extrabar-date">
                            <span class="theme-extrabar-icon"><?php joltnews_theme_svg('calendar-full'); ?></span>
                            <span class="theme-extrabar-label"><?php echo esc_html(date( esc_attr($ticker_date_format))); ?></span>
                        </div>
                    <?php } ?>

                    <div class="theme-extrabar-item theme-extrabar-clock">
                        <span class="theme-extrabar-icon"><?php joltnews_theme_svg('clock'); ?></span>
                        <span class="theme-extrabar-label">
                            <div id="twp-time-clock"></div>
                        </span>
                    </div>

                </div>


                <div class="header-item header-item-right">
                    <?php joltnews_category_pin_posts_link(); ?>

                    <?php
                    if (has_nav_menu('joltnews-social-menu') && $ed_ticker_bar_social_nav) { ?>
                        <div class="topbar-social-navigation">
                            <?php
                            wp_nav_menu(

                                array(
                                    'theme_location' => 'joltnews-social-menu',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'container' => 'div',
                                    'container_class' => 'joltnews-social-menu',
                                    'depth' => 1,
                                )

                            ); ?>
                        </div>
                    <?php } ?>

                </div>
            </div>

        <?php
        }

        $html = ob_get_contents();
        ob_get_clean();

        if( $render ){

            echo $html;

        }else{

            return $html;

        }

    }

endif;

if( !function_exists('joltnews_content_offcanvas') ):

    // Offcanvas Contents
    function joltnews_content_offcanvas()
    {
        ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">

                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>

                    <div class="offcanvas-close">

                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'joltnews'); ?>
                            </span>

                            <span class="bars">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </span>
                        </button>
                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper">
                        <ul class="primary-menu theme-menu">

                            <?php
                            if( has_nav_menu('joltnews-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'joltnews-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new JoltNews_Walker_Page(),
                                    )
                                );

                            } ?>

                        </ul>
                    </nav>
                </div>

                <?php if (has_nav_menu('joltnews-social-menu')) { ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'joltnews-social-menu',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'container' => 'div',
                                'container_class' => 'joltnews-social-menu',
                                'depth' => 1,
                            )
                        ); ?>

                    </div>

                <?php }
                ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>

            </div>
        </div>

        <?php
    }

endif;

add_action( 'joltnews_before_footer_content_action','joltnews_content_offcanvas',30 );


if( !function_exists('joltnews_footer_content_widget') ):

    function joltnews_footer_content_widget(){

        $joltnews_default = joltnews_get_default_theme_options();
        if (is_active_sidebar('joltnews-footer-widget-0') || 
            is_active_sidebar('joltnews-footer-widget-1') || 
            is_active_sidebar('joltnews-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 4 && is_active_sidebar('joltnews-footer-widget-3')) {
                    $footer_sidebar++;
                }
                if ($x == 3 && is_active_sidebar('joltnews-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('joltnews-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('joltnews-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 4);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } elseif ($footer_sidebar == 3) {
                $footer_sidebar_class = 4;
            }else {
                $footer_sidebar_class = 3;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $joltnews_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if (is_active_sidebar('joltnews-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-6 column-xs-12">
                                <?php dynamic_sidebar('joltnews-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('joltnews-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-6 column-xs-12">
                                <?php dynamic_sidebar('joltnews-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('joltnews-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-6 column-xs-12">
                                <?php dynamic_sidebar('joltnews-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('joltnews-footer-widget-3')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-6 column-xs-12">
                                <?php dynamic_sidebar('joltnews-footer-widget-3'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

    }

endif;

add_action( 'joltnews_footer_content_action','joltnews_footer_content_widget',10 );

if( !function_exists('joltnews_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function joltnews_footer_content_info(){

        $joltnews_default = joltnews_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-6 column-sm-12">
                        <div class="footer-copyright">
                            <?php
                            $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $joltnews_default['footer_copyright_text'] ) );
                            echo esc_html__('Copyright ', 'joltnews') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html( get_bloginfo( 'name', 'display' ) ) . '. </span></a> ' . esc_html( $footer_copyright_text );

                            echo '<br>';
                            echo esc_html__('Theme: ', 'joltnews') . 'JoltNews ' . esc_html__('By ', 'joltnews') . '<a href="' . esc_url('https://www.themeinwp.com/theme/joltnews') . '"  title="' . esc_attr__('Themeinwp', 'joltnews') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'joltnews') . '</span></a>';
                            echo esc_html__('Powered by ', 'joltnews') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'joltnews') . '" target="_blank"><span>' . esc_html__('WordPress.', 'joltnews') . '</span></a>';
                            
                            ?>
                        </div>
                    </div>


                    <?php
                    if (has_nav_menu('joltnews-social-menu')) { ?>
                        <div class="column column-6 column-sm-12">
                            <div class="footer-social-navigation">
                                <?php
                                wp_nav_menu(

                                    array(
                                        'theme_location' => 'joltnews-social-menu',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'container' => 'div',
                                        'container_class' => 'joltnews-social-menu',
                                        'depth' => 1,
                                    )

                                ); ?>

                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <?php joltnews_footer_go_to_top(); ?>
        </div>

    <?php
    }

endif;

add_action( 'joltnews_footer_content_action','joltnews_footer_content_info',20 );


if( !function_exists('joltnews_footer_go_to_top') ):

    // Scroll to Top render content
    function joltnews_footer_go_to_top(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_scroll_top_button = get_theme_mod( 'ed_scroll_top_button', $joltnews_default['ed_scroll_top_button'] );

        if( $ed_scroll_top_button ){
            
            ?>

            <div class="hide-no-js">
                <button type="button" class="scroll-up">
                    <?php joltnews_theme_svg('chevron-up'); ?>
                </button>
            </div>

            <?php

        }

    }

endif;


if( !function_exists( 'joltnews_post_view_count' ) ):

    function joltnews_post_view_count(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_post_views = get_theme_mod( 'ed_post_views', $joltnews_default['ed_post_views'] );
        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) ? esc_html( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) : '';
        if( $twp_be_enable_post_visit_tracking && class_exists( 'Booster_Extension_Class' ) ): ?>

            <div class="entry-meta-item entry-meta-views">
                <span class="entry-meta-icon views-icon">
                    <?php joltnews_theme_svg('viewer'); ?>
                </span>
                <a href="<?php the_permalink(); ?>">
                    <span class="post-view-count">
                       <?php
                       echo do_shortcode('[booster-extension-visit-count count_only="count" label="'.esc_html__('Views','joltnews').'"]');
                       ?>
                    </span>
                 </a>
            </div>
        
        <?php
        endif;
    }
endif;

if( !function_exists( 'joltnews_post_like_dislike' ) ):

    function joltnews_post_like_dislike(){

        $joltnews_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'joltnews_ed_post_like_dislike', true ) );
        if( class_exists( 'Booster_Extension_Class' ) && !$joltnews_ed_post_like_dislike ): ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
            </div>
        
        <?php
        endif;
    }
endif;


add_action('wp_ajax_joltnews_tab_posts_callback', 'joltnews_tab_posts_callback');
add_action('wp_ajax_nopriv_joltnews_tab_posts_callback', 'joltnews_tab_posts_callback');

if( !function_exists( 'joltnews_tab_posts_callback' ) ):
    // Masonry Post Ajax Call Function.

    function joltnews_tab_posts_callback() {

        if(  isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'joltnews_ajax_nonce' ) && isset( $_POST['category'] ) ){

            $category = sanitize_text_field( wp_unslash( $_POST['category'] ) );

            $tab_post_query = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 7,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            $tab_post_query_1 = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 7,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            if ($tab_post_query->have_posts()): ?>

                <div class="column-row">
                    <div class="column column-6 column-xs-12">

                        <?php
                        $post_count = 1;
                        while ($tab_post_query->have_posts()) {
                            $tab_post_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                            <article
                                    id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                <div class="data-bg data-bg-medium  img-hover-slide"
                                     data-background="<?php echo esc_url($featured_image); ?>">

                                    <?php
                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                    $icon = joltnews_post_format_icon($format);
                                    if (!empty($icon)) { ?>
                                        <span class="top-right-icon">
                                            <?php echo joltnews_svg_escape($icon); ?>
                                        </span>
                                    <?php } ?>
                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                    <div class="article-content article-content-overlay">
                                        <div class="entry-meta">
                                            <?php joltnews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="article-content theme-article-content">
                                    <h3 class="entry-title entry-title-medium">
                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-meta">
                                        <?php joltnews_posted_by(); ?>
                                        <?php joltnews_post_view_count(); ?>
                                    </div>
                                </div>
                            </article>

                            <?php
                            if ($post_count == 2) {
                                break;
                            }

                            $post_count++;

                        }
                        wp_reset_postdata(); ?>

                    </div>

                    <div class="column column-6 column-xs-12">
                        <?php
                        $post_count = 1;
                        while ($tab_post_query_1->have_posts()) {
                            $tab_post_query_1->the_post();

                            if ($post_count != 1 && $post_count != 2) {

                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>


                                <article
                                        id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>

                                    <?php if ($featured_image) { ?>
                                        <div class="data-bg  img-hover-slide"
                                             data-background="<?php echo esc_url($featured_image); ?>">

                                            <?php
                                            $format = get_post_format(get_the_ID()) ?: 'standard';
                                            $icon = joltnews_post_format_icon($format);
                                            if (!empty($icon)) { ?>
                                                <span class="top-right-icon">
                                                                    <?php echo joltnews_svg_escape($icon); ?>
                                                                </span>
                                            <?php } ?>
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>

                                        </div>
                                    <?php } ?>

                                    <div class="article-content">
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                               title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="entry-meta-wrapper">
                                            <div class="entry-meta entry-meta-default">
                                                <?php joltnews_posted_on($icon = true); ?>
                                            </div>
                                            <div class="entry-meta">
                                                <?php joltnews_post_view_count(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>


                                <?php
                            }

                            $post_count++;

                        } ?>
                    </div>
                </div>


                <?php
                wp_reset_postdata();

            endif;
        }

        wp_die();
    }

endif;

if( !function_exists( 'joltnews_header_ticker_posts' ) ):

    function joltnews_header_ticker_posts(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_header_ticker_posts = get_theme_mod( 'ed_header_ticker_posts',$joltnews_default['ed_header_ticker_posts'] );
        $ed_header_ticker_posts_title = get_theme_mod( 'ed_header_ticker_posts_title',$joltnews_default['ed_header_ticker_posts_title'] );
        $joltnews_header_ticker_cat = get_theme_mod( 'joltnews_header_ticker_cat' );
        $slider_autoplay = get_theme_mod( 'ed_ticker_slider_autoplay',$joltnews_default['ed_ticker_slider_autoplay'] );
        
        if( $slider_autoplay ){
            $autoplay = 'true';
        }else{
            $autoplay = 'false';
        }

        if( $ed_header_ticker_posts ){ ?>

            <div class="theme-ticker-area hide-no-js">
                <?php if( $ed_header_ticker_posts_title ){ ?>
                    <div class="theme-ticker-components theme-ticker-left">
                        <div class="theme-ticker-title"><?php echo esc_html( $ed_header_ticker_posts_title ); ?></div>
                    </div>
                <?php } ?>

                <?php
                $ticker_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($joltnews_header_ticker_cat)));

                if( $ticker_posts_query->have_posts() ): ?>

                    <div class="theme-ticker-component theme-ticker-right">
                        <div class="ticker-slides theme-slick-resize" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>}'>
                            <?php
                            while ($ticker_posts_query->have_posts()):
                                $ticker_posts_query->the_post(); ?>


                                        <a class="ticker-slides-item" href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                            <?php if (has_post_thumbnail()) {
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';?>
                                                <span class="data-bg ticker-data-bg" data-background="<?php echo esc_url( $featured_image ); ?>"></span>
                                            <?php } ?>
                                            <span class="ticker-title"><?php the_title(); ?></span>
                                        </a>


                                <?php
                            endwhile; ?>
                        </div>
                    </div>

                    <?php
                    wp_reset_postdata();
                endif; ?>
            </div>

        <?php
        }

    }

endif;


if( class_exists('WooCommerce') ){

    remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
    add_action('woocommerce_before_main_content','joltnews_woo_before_main_content',5);
    add_action('woocommerce_after_main_content','joltnews_woo_after_main_content',15);

}
if( !function_exists('joltnews_woo_before_main_content') ):

    function joltnews_woo_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( !function_exists('joltnews_woo_after_main_content') ):

    function joltnews_woo_after_main_content(){

        $joltnews_default = joltnews_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $joltnews_default['global_sidebar_layout'] ) );
        if( $sidebar != 'no-sidebar' ){

            get_sidebar();
            
        }

        echo '</div>';
        echo '</div>';

    }

endif;


if( !function_exists('joltnews_content_loading') ){

    function joltnews_content_loading(){ ?>

        <div class="content-loading-status">
            <div class="theme-ajax-loader"></div>
            <div class="screen-reader-text">
                <?php esc_html_e('Content Loading','joltnews'); ?>
            </div>
        </div>
    
    <?php
    }
}


function joltnews_hex2rgb( $colour,$opacity = 1 ) {

    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

}

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','joltnews_after_content_pagination');

}

if( !function_exists('joltnews_after_content_pagination') ):

    function joltnews_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'joltnews' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;

if( ! function_exists( 'joltnews_iframe_escape' ) ):
    
    /** Escape Iframe **/
    function joltnews_iframe_escape( $input ){

        $all_tags = array(
            'iframe'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'frameborder'=>array(),
                'allow'=>array(),
                'allowfullscreen'=>array(),
            ),
            'video'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'style'=>array(),
                'controls'=>array(),
            )
        );

        return wp_kses($input,$all_tags);
        
    }

endif;

if( ! function_exists( 'joltnews_post_permalink' ) ):
    
    function joltnews_post_permalink(){
        ?><div class="entry-read-more"><a href="<?php the_permalink(); ?>" class="theme-button theme-button-filled theme-button-small"><?php esc_html_e('Read More','joltnews'); ?></a></div><?php
    }

endif;

if( !function_exists('main_navigation_extras') ):

    function main_navigation_extras(){

        $joltnews_default = joltnews_get_default_theme_options(); ?>
        <div class="navbar-controls hide-no-js">
        
            <button type="button" class="navbar-control navbar-control-search">
                <span class="navbar-control-trigger" tabindex="-1"><?php joltnews_theme_svg('search'); ?></span>
            </button>

            <button type="button" class="navbar-control navbar-control-offcanvas">
                <span class="navbar-control-trigger" tabindex="-1"><?php joltnews_theme_svg('menu'); ?></span>
            </button>

        </div>

    <?php
    }

endif;



if( !function_exists('joltnews_video_aspect_ratio') ):

    function joltnews_video_aspect_ratio(){

        return $joltnews_video_aspect_ratio = array(
            'global' => esc_html__( 'Global', 'joltnews' ),
            'default' => esc_html__( 'Default', 'joltnews' ),
            'square' => esc_html__( 'Square', 'joltnews' ),
            'portrait' => esc_html__( 'Portrait', 'joltnews' ),
            'landscape' => esc_html__( 'Landscape', 'joltnews' ),
        );

    }

endif;

if( !function_exists('joltnews_video_autoplay') ):

    function joltnews_video_autoplay(){

        return $joltnews_video_autoplay = array(
            'global' => esc_html__( 'Global', 'joltnews' ),
            'autoplay-disable' => esc_html__( 'Disable Autoplay', 'joltnews' ),
            'autoplay-enable' => esc_html__( 'Enable Autoplay', 'joltnews' ),
            
        );

    }

endif;

add_filter('comment_form_defaults','joltnews_comment_title_callback');

if( !function_exists('joltnews_comment_title_callback') ):


    function joltnews_comment_title_callback($defaults){

        $defaults['title_reply_before'] = '<header class="block-title-wrapper"><h3 class="block-title">';
        $defaults['title_reply_after'] = '</h3></header>';
        return $defaults;

    }

endif;


if( class_exists('Booster_Extension_Class') ):

    add_filter('booster_extension_ed_content','joltnews_read_letter_content_false');

    if( !function_exists('joltnews_read_letter_content_false') ):

        function joltnews_read_letter_content_false(){

            return false;

        }

    endif;

    add_action('booster_extension_read_later_post_content','joltnews_readletter_content',20);

    if( !function_exists('joltnews_readletter_content') ):

        function joltnews_readletter_content(){

            return get_template_part( 'template-parts/content', get_post_format() );

        }

    endif;
    
endif;

if( !function_exists('joltnews_category_pin_posts_link') ):

    function joltnews_category_pin_posts_link(){

        $joltnews_default = joltnews_get_default_theme_options();
        $ed_post_read_later = get_theme_mod('ed_post_read_later',$joltnews_default['ed_post_read_later']);

        if ( $ed_post_read_later && class_exists('Booster_Extension_Class') ):

            if( function_exists('booster_extension_get_read_letter_page_id') ){
            $page_id = booster_extension_get_read_letter_page_id();


            if ($page_id) {

                $page_link = get_page_link($page_id);
                ?>
                <div class="theme-extrabar-item theme-extrabar-bookmark">
                    <a href="<?php echo esc_url($page_link); ?>">
                        <span class="theme-extrabar-icon"><?php joltnews_theme_svg('bookmark'); ?></span>
                        <span class="theme-extrabar-label"><?php esc_html_e('Favourites', 'joltnews'); ?></span>
                    </a>
                </div>
            <?php

            }
        }

        endif;

    }

endif;


if( !function_exists('joltnews_content_new_entry_news_render') ):

    function joltnews_content_new_entry_news_render(){
        $joltnews_default = joltnews_get_default_theme_options();
        $ed_header_new_entry_posts_title = get_theme_mod( 'ed_header_new_entry_posts_title', $joltnews_default['ed_header_new_entry_posts_title'] );
        $joltnews_header_new_entry_cat = get_theme_mod('joltnews_header_new_entry_cat');
        $new_entry_news_query = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => $joltnews_header_new_entry_cat,
            )
        );

        if( $new_entry_news_query->have_posts() ): ?>
            <div class="column-row">
                <div class="column column-4">

                    <header class="block-title-wrapper">
                        <h3 class="block-title">
                            <span><?php echo esc_html($ed_header_new_entry_posts_title); ?></span>
                        </h3>
                    </header>

                </div>
            <div class="column column-8">
                <div class="header-slide-arrow header-slide-prev">
                    <span class="header-slide-label"><?php esc_html_e('Prev Entry', 'joltnews'); ?></span>
                    <span class="header-slide-icon"><?php joltnews_theme_svg('chevron-up'); ?></span>
                </div>
                <div class="header-recent-entries theme-slick-resize theme-slider">
                    <?php
                    while( $new_entry_news_query->have_posts() ){
                        $new_entry_news_query->the_post();

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                        $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                        <div class="recent-entries-item">
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>
                                <?php if( $featured_image ){ ?>
                                    <div class="data-bg img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">

                                        <?php
                                        $format = get_post_format(get_the_ID()) ?: 'standard';
                                        $icon = joltnews_post_format_icon($format);
                                        if (!empty($icon)) { ?>
                                            <span class="top-right-icon"><?php echo joltnews_svg_escape($icon); ?></span>
                                        <?php } ?>
                                        <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>

                                    </div>
                                <?php } ?>

                                <div class="article-content theme-article-content">
                                    <h3 class="entry-title entry-title-small">
                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <div class="entry-meta">
                                        <?php joltnews_posted_on( $icon = true ); ?>
                                    </div>
                                </div>

                            </article>
                        </div>
                        <?php

                    } ?>
                </div>

                <div class="header-slide-arrow header-slide-next">
                    <span class="header-slide-label"><?php esc_html_e('Next Entry', 'joltnews'); ?></span>
                    <span class="header-slide-icon"><?php joltnews_theme_svg('chevron-down'); ?></span>
                </div>
            </div>
            </div>
            <?php
            wp_reset_postdata();

        endif;
    }

endif;