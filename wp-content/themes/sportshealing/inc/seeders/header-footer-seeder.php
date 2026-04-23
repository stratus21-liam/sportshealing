<?php
/**
 * One-time setup for editable layout records.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create the default Header/Footer option records once.
 */
function sportshealing_seed_layout_posts(): void {
    $layouts = [
        'one' => [
            'label' => __('Option 1', 'sportshealing'),
            'variant' => 'one',
        ],
        'two' => [
            'label' => __('Option 2', 'sportshealing'),
            'variant' => 'two',
        ],
        'three' => [
            'label' => __('Option 3', 'sportshealing'),
            'variant' => 'three',
        ],
    ];

    foreach ($layouts as $option => $config) {
        foreach (['sh_header' => 'Header', 'sh_footer' => 'Footer'] as $post_type => $type_label) {
            $existing = get_posts([
                'post_type' => $post_type,
                'post_status' => 'any',
                'posts_per_page' => 1,
                'meta_key' => 'sportshealing_layout_option',
                'meta_value' => $option,
            ]);

            if ($existing) {
                continue;
            }

            $post_id = wp_insert_post([
                'post_type' => $post_type,
                'post_status' => 'publish',
                'post_title' => sprintf('%s - %s', $type_label, $config['label']),
                'menu_order' => array_search($option, array_keys($layouts), true),
            ]);

            if (is_wp_error($post_id) || !$post_id) {
                continue;
            }

            update_post_meta($post_id, 'sportshealing_layout_option', $option);
            update_post_meta($post_id, $post_type === 'sh_header' ? 'sportshealing_header_variant' : 'sportshealing_footer_variant', $config['variant']);
            sportshealing_seed_layout_default_meta($post_id, $post_type);
        }
    }
}

/**
 * Seed default editable Header/Footer fields when they are missing.
 */
function sportshealing_seed_layout_default_meta(int $post_id, string $post_type): void {
    $defaults = [
        'sportshealing_address' => '123 Serenity Lane, Suite 101, Hometown, CA 12345',
        'sportshealing_email' => 'info@example.com',
        'sportshealing_phone' => '+1 234 467 88',
        'sportshealing_hours' => 'Mon - Fri 8:00 - 6:30',
        'sportshealing_cta_label' => 'Book Appointment',
        'sportshealing_instagram_url' => '#',
        'sportshealing_facebook_url' => '#',
        'sportshealing_twitter_url' => '#',
        'sportshealing_pinterest_url' => '#',
    ];

    if ($post_type === 'sh_footer') {
        $defaults += [
            'sportshealing_footer_about_html' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor asin cididunt ut labore et dolore magna ali qua.',
            'sportshealing_opening_hours_html' => '<ul class="opening-list"><li><p>Monday - Friday: <span class="time">8:00am - 4:00pm</span></p></li><li><p>Saturday: <span class="time">8:00am - 12:00pm</span></p></li><li><p>Sunday: <span class="time">8:00am - 10:00am</span></p></li></ul>',
            'sportshealing_copyright_html' => '&#169; Copyright 2025 SportsHealing All Rights Reserved',
            'sportshealing_footer_phone_label' => 'Have Any Question?',
            'sportshealing_footer_email_label' => 'Send Email',
            'sportshealing_footer_quick_title' => 'Quick Links',
            'sportshealing_footer_services_title' => 'Our Services',
            'sportshealing_footer_opening_hours_title' => 'Opening Hours',
            'sportshealing_footer_contact_title' => 'Get In Touch',
            'sportshealing_footer_newsletter_title' => 'Newsletter',
            'sportshealing_footer_newsletter_placeholder' => 'Your Email',
            'sportshealing_footer_newsletter_button_label' => 'Send',
            'sportshealing_footer_payment_label' => 'We Accept Payments',
        ];
    }

    foreach ($defaults as $key => $value) {
        if (get_post_meta($post_id, $key, true) === '') {
            update_post_meta($post_id, $key, $value);
        }
    }
}

/**
 * Seed layout records from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_layout_posts(): void {
    if (get_option('sportshealing_layout_posts_seeded')) {
        return;
    }

    sportshealing_seed_layout_posts();
    update_option('sportshealing_layout_posts_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_layout_posts');

/**
 * Rename older homepage-based layout records to option-based records.
 */
function sportshealing_migrate_layout_posts_to_options(): void {
    if (get_option('sportshealing_layout_posts_option_migrated')) {
        return;
    }

    $legacy_contexts = [
        'home_index_one' => ['option' => 'one', 'number' => 1],
        'home_index_two' => ['option' => 'two', 'number' => 2],
        'home_index_three' => ['option' => 'three', 'number' => 3],
    ];

    foreach (['sh_header' => 'Header', 'sh_footer' => 'Footer'] as $post_type => $type_label) {
        foreach ($legacy_contexts as $context => $config) {
            $posts = get_posts([
                'post_type' => $post_type,
                'post_status' => 'any',
                'posts_per_page' => -1,
                'meta_key' => 'sportshealing_home_context',
                'meta_value' => $context,
            ]);

            foreach ($posts as $post) {
                update_post_meta($post->ID, 'sportshealing_layout_option', $config['option']);
                delete_post_meta($post->ID, 'sportshealing_home_context');
                sportshealing_seed_layout_default_meta($post->ID, $post_type);
                wp_update_post([
                    'ID' => $post->ID,
                    'post_title' => sprintf('%s - %s %d', $type_label, __('Option', 'sportshealing'), $config['number']),
                    'menu_order' => $config['number'] - 1,
                ]);
            }
        }
    }

    update_option('sportshealing_layout_posts_option_migrated', 1, false);
}
add_action('admin_init', 'sportshealing_migrate_layout_posts_to_options', 15);

/**
 * Backfill missing editable layout fields for existing Header/Footer records.
 */
function sportshealing_backfill_layout_default_meta(): void {
    if (get_option('sportshealing_layout_default_meta_backfilled')) {
        return;
    }

    foreach (['sh_header', 'sh_footer'] as $post_type) {
        $posts = get_posts([
            'post_type' => $post_type,
            'post_status' => 'any',
            'posts_per_page' => -1,
        ]);

        foreach ($posts as $post) {
            sportshealing_seed_layout_default_meta($post->ID, $post_type);
        }
    }

    update_option('sportshealing_layout_default_meta_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_layout_default_meta', 20);
