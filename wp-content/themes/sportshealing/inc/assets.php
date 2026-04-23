<?php
/**
 * Global stylesheet and script registration for SportsHealing.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue theme stylesheets once through WordPress.
 */
function sportshealing_theme_head(): void {
    wp_enqueue_style('sportshealing-fontawesome', sportshealing_asset_url('assets/css/all.min.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-bootstrap', sportshealing_asset_url('assets/css/bootstrap.min.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-swiper', sportshealing_asset_url('assets/css/swiper-bundle.min.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-twentytwenty', sportshealing_asset_url('assets/css/twentytwenty.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-magnific', sportshealing_asset_url('assets/css/magnific-popup.min.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-animate', sportshealing_asset_url('assets/css/animate.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-main', sportshealing_asset_url('assets/css/main.css'), [], '1.0.0');
    wp_enqueue_style('sportshealing-style', get_stylesheet_uri(), ['sportshealing-main'], wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'sportshealing_theme_head');

/**
 * Enqueue theme JavaScript files once through WordPress.
 */
function sportshealing_theme_scripts(): void {
    wp_enqueue_script('jquery');
    wp_enqueue_script('sportshealing-bootstrap', sportshealing_asset_url('assets/js/bootstrap.bundle.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-meanmenu', sportshealing_asset_url('assets/js/jquery.meanmenu.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-swiper', sportshealing_asset_url('assets/js/swiper-bundle.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-wow', sportshealing_asset_url('assets/js/wow.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-validate', sportshealing_asset_url('assets/js/validate.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-ajax-form', sportshealing_asset_url('assets/js/ajax-form.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-event-move', sportshealing_asset_url('assets/js/jquery.event.move.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-twentytwenty', sportshealing_asset_url('assets/js/jquery.twentytwenty.js'), ['jquery', 'sportshealing-event-move'], '1.0.0', true);
    wp_enqueue_script('sportshealing-appear', sportshealing_asset_url('assets/js/jquery.appear.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-magnific', sportshealing_asset_url('assets/js/jquery.magnific-popup.min.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-smooth-scroll', sportshealing_asset_url('assets/js/SmoothScroll.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-main', sportshealing_asset_url('assets/js/main.js'), ['jquery'], '1.0.0', true);
    wp_enqueue_script('sportshealing-faq-search', sportshealing_asset_url('assets/js/faq-search.js'), [], wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'sportshealing_theme_scripts');
