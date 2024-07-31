<?php
/**
 * Homepage Main Widget Area
 *
 * @package JoltNews
 */

if (!function_exists('joltnews_case_home_widget_area_block')):

    function joltnews_case_home_widget_area_block($joltnews_home_section, $repeat_times)
    {


        ?>
        <?php if (is_active_sidebar('front-page-3-column-col-1') || is_active_sidebar('front-page-3-column-col-2') || is_active_sidebar('front-page-3-column-col-3') || is_active_sidebar('front-page-2-column-col-1') || is_active_sidebar('front-page-2-column-col-2') || is_active_sidebar('front-page-fullwidth')) { ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-widgetarea">
            <?php if (is_active_sidebar('front-page-3-column-col-1') || is_active_sidebar('front-page-3-column-col-2') || is_active_sidebar('front-page-3-column-col-3')) { ?>
                <div class="theme-widget-area upper-widget-area">
                    <div class="wrapper">
                        <div class="column-row column-row-collapse">

                            <?php
                            if (is_active_sidebar('front-page-3-column-col-1')) { ?>

                                <div class="column column-5 column-sm-12 theme-top-sticky">

                                    <?php dynamic_sidebar('front-page-3-column-col-1'); ?>

                                </div>

                            <?php } ?>
                            <?php
                            if (is_active_sidebar('front-page-3-column-col-2')) { ?>

                                <div class="column column-3 column-sm-12 column-border-lr theme-top-sticky">

                                    <?php dynamic_sidebar('front-page-3-column-col-2'); ?>

                                </div>

                            <?php } ?>
                            <?php
                            if (is_active_sidebar('front-page-3-column-col-3')) { ?>

                                <div class="column column-4 column-sm-12 theme-top-sticky">

                                    <?php dynamic_sidebar('front-page-3-column-col-3'); ?>

                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (is_active_sidebar('front-page-2-column-col-1') || is_active_sidebar('front-page-2-column-col-2')) { ?>
                <div class="theme-widget-area lower-widget-area">
                    <div class="wrapper">
                        <div class="column-row column-row-collapse">
                            <?php if (is_active_sidebar('front-page-2-column-col-1')) { ?>

                                <div class="column column-6 column-sm-12 theme-top-sticky">

                                    <?php dynamic_sidebar('front-page-2-column-col-1'); ?>

                                </div>

                            <?php } ?>
                            <?php
                            if (is_active_sidebar('front-page-2-column-col-2')) { ?>

                                <div class="column column-6 column-sm-12 theme-top-sticky">

                                    <?php dynamic_sidebar('front-page-2-column-col-2'); ?>

                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (is_active_sidebar('front-page-fullwidth')) { ?>
                <div class="theme-widget-area full-widget-area">
                    <div class="wrapper">
                        <?php dynamic_sidebar('front-page-fullwidth'); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>




        <?php
    }

endif;