<?php
/**
 * Content Rich Widget
 *
 * @package JoltNews
 */
if (!function_exists('joltnews_content_rich_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function joltnews_content_rich_widget()
    {
        register_widget('JoltNews_widget_Content_Rich');
    }
endif;
add_action('widgets_init', 'joltnews_content_rich_widget');
// Article Widget Layout 1
if (!class_exists('JoltNews_widget_Content_Rich')) :
    /**
     * Article Widget Layout 1
     *
     * @since 1.0.0
     */
    class JoltNews_widget_Content_Rich extends JoltNews_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'joltnews_widget_content_rich',
                'description' => esc_html__('Displays post form selected category in different styles', 'joltnews'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Section Title:', 'joltnews'),
                    'default' => esc_html__('Widget Section Title:', 'joltnews'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_1' => array(
                    'label' => esc_html__('Select First Column Category:', 'joltnews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'joltnews'),
                ),
                'enable_meta_1' => array(
                    'label' => esc_html__('Enable Categories:', 'joltnews'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_category_2' => array(
                    'label' => esc_html__('Select Second Column Category:', 'joltnews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'joltnews'),
                ),
                'title_2' => array(
                    'label' => esc_html__('Sub Title Second Column:', 'joltnews'),
                    'default' => esc_html__('Secondary Column-2 Title:', 'joltnews'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'enable_meta_2' => array(
                    'label' => esc_html__('Enable Categories:', 'joltnews'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_category_3' => array(
                    'label' => esc_html__('Select Third Column Category:', 'joltnews'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'joltnews'),
                ),
                'enable_meta_3' => array(
                    'label' => esc_html__('Enable Categories:', 'joltnews'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
            );
            parent::__construct('joltnews-content-rich-widget', esc_html__('JoltNews: Content Rich Widget', 'joltnews'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . esc_html($params['title']) . $args['after_title'];
            }
            $qargs_1 = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'post__not_in' => get_option("sticky_posts"),
            );
            if (absint($params['post_category_1']) > 0) {
                $qargs_1['cat'] = absint($params['post_category_1']);
            }
            $style_1_posts_query = new WP_Query($qargs_1);
            $qargs_2 = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => get_option("sticky_posts"),
            );
            if (absint($params['post_category_2']) > 0) {
                $qargs_2['cat'] = absint($params['post_category_2']);
            }
            $style_2_posts_query = new WP_Query($qargs_2);
            $qargs_3 = array(
                'post_type' => 'post',
                'posts_per_page' => 4,
                'post__not_in' => get_option("sticky_posts"),
            );
            if (absint($params['post_category_3']) > 0) {
                $qargs_3['cat'] = absint($params['post_category_3']);
            }
            $style_3_posts_query = new WP_Query($qargs_3);
            ?>
            <div class="widget-content theme-widget-content">
                <div class="column-row column-row-collapse">
                    <?php if ($style_1_posts_query->have_posts()) : ?>
                        <div class="column column-3 column-sm-12">
                            <div class="column-panel-body">
                                <?php while ($style_1_posts_query->have_posts()) :
                                    $style_1_posts_query->the_post(); ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>
                                        <div class="article-content theme-article-content">
                                                <?php if (($params['enable_meta_1']) == 1) { ?>
                                                    <div class="entry-meta">
                                                        <?php joltnews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                <?php } ?>
                                                <h3 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
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
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($style_2_posts_query->have_posts()) : ?>
                        <div class="column column-7 column-sm-12 column-border-lr">
                                <div class="column-panel-body">
                                    <div class="column-row">
                                        <div class="column column-6 column-sm-12">
                                            <?php $first = true;
                                            $featured_image = array();
                                            while ($style_2_posts_query->have_posts()) :
                                                $style_2_posts_query->the_post(); ?>
                                                <?php if ($first == true) {
                                                $featured_image[0] = get_the_post_thumbnail_url(); ?>
                                                <div class="block-sub-area block-upper-area">
                                                    <article class="theme-news-article">
                                                        <div class="theme-article-detail">
                                                            <div class="entry-meta-top entry-meta-category">
                                                                <?php joltnews_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                            </div>
                                                            <h3 class="entry-title entry-title-big">
                                                                <a href="<?php the_permalink(); ?>">
                                                                    <?php the_title(); ?>
                                                                </a>
                                                            </h3>
                                                            <div class="theme-article-content">
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
                                                                        echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                                        echo '</p>';
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div class="block-sub-area block-lower-area">
                                                    <?php if (!empty($params['title_2'])) { ?>
                                                        <header class="block-title-wrapper">
                                                            <h2 class="block-title">
                                                                <span><?php echo esc_html($params['title_2']); ?></span>
                                                            </h2>
                                                        </header>
                                                    <?php } ?>
                                                    <div class="theme-panel-body">
                                                            <?php $first = false;
                                                             } else { ?>
                                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list news-article-list-alt'); ?>>
                                                                    <?php joltnews_theme_svg('diamond'); ?>
                                                                        <h3 class="entry-title entry-title-small">
                                                                            <a href="<?php the_permalink(); ?>">
                                                                                <?php the_title(); ?>
                                                                            </a>
                                                                        </h3>
                                                                </article>
                                                            <?php } ?>
                                                            <?php if ($style_2_posts_query->current_post + 1 == $style_2_posts_query->post_count) { ?>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                        <div class="column column-6 column-sm-12">
                                            <div class="data-bg data-bg-big img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <?php
                                                $format = get_post_format(get_the_ID()) ?: 'standard';
                                                $icon = joltnews_post_format_icon($format);
                                                if (!empty($icon)) { ?>
                                                    <span class="top-right-icon"><?php echo joltnews_svg_escape($icon); ?></span>
                                                <?php } ?>
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($style_3_posts_query->have_posts()) : ?>
                        <div class="column column-2 column-sm-12">
                            <div class="column-panel-body">
                                <?php while ($style_3_posts_query->have_posts()) :
                                    $style_3_posts_query->the_post(); ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>
                                        <div class="article-content theme-article-content">
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php joltnews_posted_by(); ?>
                                                <?php joltnews_post_view_count(); ?>
                                            </div>
                                        </div>
                                    </article>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
    }
endif;