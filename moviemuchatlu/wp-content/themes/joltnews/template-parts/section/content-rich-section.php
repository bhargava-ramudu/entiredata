<?php
/**
 * Tiles Blocks
 *
 * @package JoltNews
 */
if (!function_exists('joltnews_tiles_block_section')):
    function joltnews_tiles_block_section($joltnews_home_section, $repeat_times)
    {
        $cat_title_1 = isset($joltnews_home_section->cat_title_1) ? $joltnews_home_section->cat_title_1 : '';
        $cat_title_2 = isset($joltnews_home_section->cat_title_2) ? $joltnews_home_section->cat_title_2 : '';
        $cat_title_4 = isset($joltnews_home_section->cat_title_4) ? $joltnews_home_section->cat_title_4 : '';
        $cat_title_3 = isset($joltnews_home_section->cat_title_3) ? $joltnews_home_section->cat_title_3 : '';
        $section_category_1 = esc_html(isset($joltnews_home_section->section_category_1) ? $joltnews_home_section->section_category_1 : '');
        $section_category_2 = esc_html(isset($joltnews_home_section->section_category_2) ? $joltnews_home_section->section_category_2 : '');
        $section_category_3 = esc_html(isset($joltnews_home_section->section_category_3) ? $joltnews_home_section->section_category_3 : '');
        $crs_post_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_1)));
        $crs_post_query_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_2)));
        $crs_post_query_2_2 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'offset' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_2)));
        $crs_post_query_3 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_3))); ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-content-rich">
            <div class="wrapper">
                <div class="column-row column-row-collapse">
                    <?php if ($crs_post_query_1->have_posts()) { ?>
                        <div class="column column-5 column-sm-12">
                            <?php if (!empty($cat_title_1)) { ?>
                                <div class="column-panel-head">
                                    <header class="block-title-wrapper">
                                        <h2 class="block-title"><?php echo esc_html($cat_title_1); ?></h2>
                                    </header>
                                </div>
                            <?php } ?>
                            <div class="column-panel-body">
                                <div class="block-sub-area block-left-area">
                                    <?php $first = true;
                                    while ($crs_post_query_1->have_posts()) {
                                        $crs_post_query_1->the_post();
                                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <?php if ($first == true) { ?>
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>
                                                <div class="article-content theme-article-content no-padding">
                                                    <div class="entry-meta">
                                                        <?php joltnews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                    <h3 class="entry-title entry-title-large">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                    <div class="entry-footer">
                                                        <div class="entry-meta">
                                                            <?php joltnews_posted_by(); ?>
                                                            <?php joltnews_post_view_count(); ?>
                                                        </div>
                                                    </div>
                                                    <div class="entry-content hidden-xs-element entry-content-muted">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                            echo '</p>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>
                                            <?php $first = false;
                                        } else { ?>
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>
                                                <div class="data-bg img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = joltnews_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <span class="top-right-icon"><?php echo joltnews_svg_escape($icon); ?></span>
                                                    <?php } ?>
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                                <div class="article-content theme-article-content">
                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                    <div class="entry-meta">
                                                        <?php joltnews_posted_by(); ?>
                                                        <?php joltnews_post_view_count(); ?>
                                                    </div>
                                                    <div class="entry-content hidden-xs-element entry-content-muted">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                            echo '</p>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata();
                    } ?>
                    <?php if ($crs_post_query_2->have_posts()) { ?>
                        <div class="column column-4 column-sm-12 column-border-lr">
                            <?php if (!empty($cat_title_2)) { ?>
                                <div class="column-panel-head">
                                    <header class="block-title-wrapper">
                                        <h2 class="block-title"><?php echo esc_html($cat_title_2); ?></h2>
                                    </header>
                                </div>
                            <?php } ?>
                            <div class="column-panel-body">
                                <div class="block-sub-area block-upper-area">
                                    <div class="content-rich-slider">
                                        <?php while ($crs_post_query_2->have_posts()) {
                                            $crs_post_query_2->the_post();
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <div class="theme-slide-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                                    <div class="data-bg data-bg-big img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                        <?php
                                                        $format = get_post_format(get_the_ID()) ?: 'standard';
                                                        $icon = joltnews_post_format_icon($format);
                                                        if (!empty($icon)) { ?>
                                                            <span class="top-right-icon"><?php echo joltnews_svg_escape($icon); ?></span>
                                                        <?php } ?>
                                                        <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                    </div>
                                                    <div class="theme-block-bottom">
                                                        <article class="theme-news-article">
                                                            <div class="theme-article-detail">
                                                                <h3 class="entry-title entry-title-medium">
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <?php the_title(); ?>
                                                                    </a>
                                                                </h3>
                                                                <div class="theme-article-content">
                                                                    <div class="entry-content hidden-xs-element entry-content-muted">
                                                                        <?php
                                                                        if (has_excerpt()) {
                                                                            the_excerpt();
                                                                        } else {
                                                                            echo '<p>';
                                                                            echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                                            echo '</p>';
                                                                        } ?>
                                                                    </div>
                                                                    <div class="entry-meta">
                                                                        <?php joltnews_posted_by(); ?>
                                                                        <?php joltnews_post_view_count(); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </article>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="block-sub-area block-lower-area">
                                    <?php if (!empty($cat_title_4)) { ?>
                                        <header class="block-title-wrapper">
                                            <h2 class="block-title">
                                                <span><?php echo esc_html($cat_title_4); ?></span>
                                            </h2>
                                        </header>
                                    <?php } ?>
                                    <?php while ($crs_post_query_2_2->have_posts()) {
                                        $crs_post_query_2_2->the_post(); ?>
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list news-article-list-alt'); ?>>
                                            <?php joltnews_theme_svg('diamond'); ?>
                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                        </article>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php wp_reset_postdata();
                    } ?>
                    <?php if ($crs_post_query_3->have_posts()) { ?>
                        <div class="column column-3 column-sm-12 column-highlight-bg">
                            <?php if (!empty($cat_title_3)) { ?>
                                <div class="column-panel-head">
                                    <header class="block-title-wrapper">
                                        <h2 class="block-title"><?php echo esc_html($cat_title_3); ?></h2>
                                    </header>
                                </div>
                            <?php } ?>
                            <div class="column-panel-body">
                                <?php while ($crs_post_query_3->have_posts()) {
                                    $crs_post_query_3->the_post(); ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>
                                        <div class="article-content theme-article-content">
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php joltnews_posted_by(); ?>
                                                <?php joltnews_post_view_count(); ?>
                                            </div>
                                            <div class="entry-content hidden-xs-element entry-content-muted">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    echo '<p>';
                                                    echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                    echo '</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    </article>
                                <?php } ?>
                            </div>
                        </div>
                        <?php wp_reset_postdata();
                    } ?>
                </div>
            </div>
        </div>
        <?php
    }
endif;