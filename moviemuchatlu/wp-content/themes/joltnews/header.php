<?php
/**
 * Header file for the JoltNews WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package JoltNews
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if (function_exists('wp_body_open')) {
    wp_body_open();
} ?>

<?php
$joltnews_default = joltnews_get_default_theme_options();

$ed_preloader = get_theme_mod('ed_preloader', $joltnews_default['ed_preloader']);
if ($ed_preloader) { ?>

    <div class="preloader hide-no-js">
        <div class="preloader-wrapper">
            <div class="loader-content">
                <div class="loader-dot dot-1"></div>
                <div class="loader-dot dot-2"></div>
                <div class="loader-dot dot-3"></div>
                <div class="loader-dot dot-4"></div>
                <div class="loader-dot dot-5"></div>
                <div class="loader-dot dot-6"></div>
                <div class="loader-dot dot-7"></div>
                <div class="loader-dot dot-8"></div>
                <div class="loader-dot dot-center"></div>
            </div>
        </div>
    </div>

<?php } ?>

<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'joltnews'); ?></a>

    <?php joltnews_header_ad(); ?>

    <?php
    get_template_part('template-parts/header/header', 'content'); ?>

    <?php joltnews_header_banner(); ?>

    <div id="content" class="site-content">