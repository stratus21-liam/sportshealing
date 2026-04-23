<?php
/**
 * Theme Customizer controls for SportsHealing.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return published layout records as Customizer choices.
 */
function sportshealing_customizer_layout_choices(string $post_type): array {
    $label = $post_type === 'sh_header' ? __('Header Option', 'sportshealing') : __('Footer Option', 'sportshealing');
    $choices = [
        0 => __('Use automatic fallback', 'sportshealing'),
    ];

    $posts = get_posts([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => ['menu_order' => 'ASC', 'title' => 'ASC'],
    ]);

    foreach (array_values($posts) as $index => $post) {
        $choices[$post->ID] = sprintf('%s %d', $label, $index + 1);
    }

    return $choices;
}

/**
 * Add logo and global layout controls to the Theme Customizer.
 */
function sportshealing_customize_register(WP_Customize_Manager $wp_customize): void {
    $wp_customize->remove_control('custom_logo');

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'custom_logo', [
        'label' => __('Logo', 'sportshealing'),
        'description' => __('Used by header and offcanvas variations. SVG uploads are supported for administrators.', 'sportshealing'),
        'section' => 'title_tagline',
        'mime_type' => 'image',
    ]));

    $wp_customize->add_setting('sportshealing_footer_logo', [
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'sportshealing_footer_logo', [
        'label' => __('Footer Logo', 'sportshealing'),
        'description' => __('Optional logo used only in footer variations. Header logos continue to use the main Site Identity logo.', 'sportshealing'),
        'section' => 'title_tagline',
        'mime_type' => 'image',
    ]));

    $wp_customize->add_section('sportshealing_layouts', [
        'title' => __('Header/Footer Layouts', 'sportshealing'),
        'priority' => 35,
    ]);

    $wp_customize->add_setting('sportshealing_selected_header', [
        'default' => 0,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('sportshealing_selected_header', [
        'label' => __('Global Header', 'sportshealing'),
        'description' => __('Choose the Header record used across the site.', 'sportshealing'),
        'section' => 'sportshealing_layouts',
        'type' => 'select',
        'choices' => sportshealing_customizer_layout_choices('sh_header'),
    ]);

    $wp_customize->add_setting('sportshealing_selected_footer', [
        'default' => 0,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control('sportshealing_selected_footer', [
        'label' => __('Global Footer', 'sportshealing'),
        'description' => __('Choose the Footer record used across the site.', 'sportshealing'),
        'section' => 'sportshealing_layouts',
        'type' => 'select',
        'choices' => sportshealing_customizer_layout_choices('sh_footer'),
    ]);
}
add_action('customize_register', 'sportshealing_customize_register');
