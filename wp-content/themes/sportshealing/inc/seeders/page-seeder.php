<?php
/**
 * One-time setup for SportsHealing CMS pages.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create the seeded CMS pages for every public page template.
 */
function sportshealing_seed_pages(): void {
    $pages = [
        ['Homepage 1', 'home', 'homepage-1-template.php'],
        ['Homepage 2', 'home-index-two', 'homepage-2-template.php'],
        ['Homepage 3', 'home-index-three', 'homepage-3-template.php'],
        ['About', 'about', 'about-template.php'],
        ['Appointment', 'appointment', 'appointment-template.php'],
        ['Blog', 'blog', 'blog-listing-template.php'],
        ['Contact', 'contact', 'contact-template.php'],
        ['Default Content', 'default-content', 'default-content-template.php'],
        ['FAQ', 'faq', 'faq-template.php'],
        ['Image Gallery', 'image-gallery', 'image-gallery-template.php'],
        ['Service Areas', 'service-areas', 'services-parent-listing-template.php'],
        ['Services', 'services', 'service-listing-template.php'],
        ['Portfolio', 'portfolio', 'portfolio-listing-template.php'],
        ['Doctors', 'doctors', 'doctor-listing-template.php'],
        ['Testimonials', 'testimonials', 'testimonials-template.php'],
        ['Video Gallery', 'video-gallery', 'video-gallery-template.php'],
    ];

    foreach ($pages as [$title, $slug, $template]) {
        $page_id = sportshealing_seed_page($title, $slug, $template);

        if ($slug === 'home' && $page_id) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $page_id);
        }

        if ($slug === 'blog' && $page_id) {
            update_option('page_for_posts', $page_id);
        }
    }
}

/**
 * Seed pages once from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_pages(): void {
    if (get_option('sportshealing_pages_seeded')) {
        return;
    }

    sportshealing_seed_pages();
    update_option('sportshealing_pages_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_pages');

/**
 * Restore theme-seeded listing pages after moving listings back to CMS pages.
 */
function sportshealing_migrate_static_listing_pages(): void {
    if (get_option('sportshealing_listing_pages_restored')) {
        return;
    }

    foreach (['services', 'portfolio', 'doctors'] as $slug) {
        $page = sportshealing_seed_find_post('page', $slug);

        if ($page && $page->post_status === 'trash') {
            wp_untrash_post($page->ID);
        }
    }

    $blog_page = sportshealing_seed_find_post('page', 'blog');
    if ($blog_page) {
        update_post_meta($blog_page->ID, '_wp_page_template', 'blog-listing-template.php');
    }

    update_option('sportshealing_listing_pages_restored', 1, false);
}
add_action('admin_init', 'sportshealing_migrate_static_listing_pages', 20);

/**
 * Backfill listing pages for installs that already ran the first page seeder.
 */
function sportshealing_backfill_listing_pages(): void {
    if (get_option('sportshealing_listing_pages_backfilled')) {
        return;
    }

    $pages = [
        ['Default Content', 'default-content', 'default-content-template.php'],
        ['Service Areas', 'service-areas', 'services-parent-listing-template.php'],
        ['Services', 'services', 'service-listing-template.php'],
        ['Portfolio', 'portfolio', 'portfolio-listing-template.php'],
        ['Doctors', 'doctors', 'doctor-listing-template.php'],
    ];

    foreach ($pages as [$title, $slug, $template]) {
        sportshealing_seed_page($title, $slug, $template);
    }

    update_option('sportshealing_listing_pages_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_listing_pages', 25);

/**
 * Backfill the parent service category listing page added after the original page seed.
 */
function sportshealing_backfill_service_parent_listing_page(): void {
    if (get_option('sportshealing_service_parent_listing_page_seeded')) {
        return;
    }

    $page_id = sportshealing_seed_page('Service Areas', 'service-areas', 'services-parent-listing-template.php');

    if ($page_id) {
        sportshealing_seed_acf_value($page_id, 'sportshealing_page_heading', 'Treatments');
    }

    update_option('sportshealing_service_parent_listing_page_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_service_parent_listing_page', 26);

/**
 * Backfill the reusable default content page template.
 */
function sportshealing_backfill_default_content_page(): void {
    if (get_option('sportshealing_default_content_page_seeded')) {
        return;
    }

    $page_id = sportshealing_seed_page('Default Content', 'default-content', 'default-content-template.php');

    if ($page_id) {
        $appointment_page = sportshealing_seed_find_post('page', 'appointment');

        sportshealing_seed_acf_value($page_id, 'sportshealing_page_heading', 'Default Content Page');
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_breadcrumb_enabled', true);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_rows_enabled', true);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_rows', [
            [
                'eyebrow' => 'Expert Care',
                'title' => 'Flexible Content Section',
                'content' => '<p>Use this row for service explanations, patient information, team introductions, or location-specific SEO content.</p>',
                'media_position' => 'right',
                'media_type' => 'image',
                'image' => '',
                'video_image' => '',
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
            ],
            [
                'eyebrow' => 'Watch And Learn',
                'title' => 'Add Video Where It Helps',
                'content' => '<p>Flip the media left or right and choose between an image or a video for each row.</p>',
                'media_position' => 'left',
                'media_type' => 'video',
                'image' => '',
                'video_image' => '',
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
            ],
        ]);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_media_items_enabled', true);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_media_items', [
            [
                'title' => 'Gallery Image',
                'media_type' => 'image',
                'image' => '',
                'video_image' => '',
                'video_url' => '',
            ],
            [
                'title' => 'Gallery Video',
                'media_type' => 'video',
                'image' => '',
                'video_image' => '',
                'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
            ],
        ]);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_cta_enabled', true);
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_cta_heading', 'Ready To Get Started?');
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_cta_copy', 'Speak to our team and find the right next step for you.');
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_cta_button_label', 'Book Appointment');
        sportshealing_seed_acf_value($page_id, 'sportshealing_default_content_cta_button_page', $appointment_page ? (int) $appointment_page->ID : '');
    }

    update_option('sportshealing_default_content_page_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_default_content_page', 27);

/**
 * Update existing pages that still store old subfolder template paths.
 */
function sportshealing_migrate_page_template_paths(): void {
    if (get_option('sportshealing_page_template_paths_migrated')) {
        return;
    }

    $template_map = [
        'templates/home/homepage-1.php' => 'homepage-1-template.php',
        'templates/home/homepage-2.php' => 'homepage-2-template.php',
        'templates/home/homepage-3.php' => 'homepage-3-template.php',
        'templates/pages/about.php' => 'about-template.php',
        'templates/pages/appointment.php' => 'appointment-template.php',
        'templates/pages/contact.php' => 'contact-template.php',
        'templates/pages/error.php' => 'error-template.php',
        'templates/pages/faq.php' => 'faq-template.php',
        'templates/pages/testimonials.php' => 'testimonials-template.php',
        'templates/blog/blog-listing-template.php' => 'blog-listing-template.php',
        'templates/gallery/image-gallery.php' => 'image-gallery-template.php',
        'templates/gallery/video-gallery.php' => 'video-gallery-template.php',
        'templates/services/service-listing-template.php' => 'service-listing-template.php',
        'templates/portfolio/portfolio-listing-template.php' => 'portfolio-listing-template.php',
        'templates/doctors/doctor-listing-template.php' => 'doctor-listing-template.php',
        'homepage-1.php' => 'homepage-1-template.php',
        'homepage-2.php' => 'homepage-2-template.php',
        'homepage-3.php' => 'homepage-3-template.php',
        'about.php' => 'about-template.php',
        'appointment.php' => 'appointment-template.php',
        'contact.php' => 'contact-template.php',
        'error.php' => 'error-template.php',
        'faq.php' => 'faq-template.php',
        'image-gallery.php' => 'image-gallery-template.php',
        'testimonials.php' => 'testimonials-template.php',
        'video-gallery.php' => 'video-gallery-template.php',
    ];

    $pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'meta_key' => '_wp_page_template',
    ]);

    foreach ($pages as $page_id) {
        $stored_template = (string) get_post_meta((int) $page_id, '_wp_page_template', true);

        if (isset($template_map[$stored_template])) {
            update_post_meta((int) $page_id, '_wp_page_template', $template_map[$stored_template]);
        }
    }

    update_option('sportshealing_page_template_paths_migrated', 1, false);
}
add_action('admin_init', 'sportshealing_migrate_page_template_paths', 30);
