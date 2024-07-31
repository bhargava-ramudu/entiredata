<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JoltNews
 * @since 1.0.0
 */
?>

</div>


<?php if ( is_active_sidebar('joltnews-offcanvas-widget') ): ?>
    <div id="sidr-nav">
        <a class="skip-link-offcanvas-first" href="javascript:void(0)"></a>
        <a class="sidr-offcanvas-close" href="#sidr-nav">
           <span>
               <?php echo esc_html__('Close','joltnews'); ?>
            </span>
        </a>
        <div class="sidr-area">
            <?php dynamic_sidebar('joltnews-offcanvas-widget'); ?>
        </div>
        <a class="skip-link-offcanvas-last" href="javascript:void(0)"></a>
    </div>
<?php endif; ?>


<?php
/**
 * Toogle Contents
 * @hooked joltnews_header_toggle_search - 10
 * @hooked joltnews_content_offcanvas - 30
*/

do_action('joltnews_before_footer_content_action'); ?>

<footer id="site-footer" role="contentinfo">
    <?php
    /**
     * Footer Content
     * @hooked joltnews_footer_content_widget - 10
     * @hooked joltnews_footer_content_info - 20
    */

    do_action('joltnews_footer_content_action'); ?>

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
