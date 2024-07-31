<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @package Newsup
 */
get_header(); ?>
<!--==================== Newsup breadcrumb section ====================-->
    <div id="content" class="container-fluid home">
        <!--row-->
        <div class="row">
            <?php do_action('newsup_action_main_content_layouts'); ?>
        </div>
        <!--/row-->
    </div>
<?php
get_footer();