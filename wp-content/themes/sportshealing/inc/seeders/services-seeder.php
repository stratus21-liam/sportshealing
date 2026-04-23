<?php
/**
 * One-time setup for SportsHealing services.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create lorem ipsum services for the service listing and detail routes.
 */
function sportshealing_seed_services(): void {
    $services = [
        ['Knee Pain Assessment', 'knee-pain-assessment', 'Knee Treatments', 'Knee Pain'],
        ['ACL Rehabilitation', 'acl-rehabilitation', 'Knee Treatments', 'ACL Rehab'],
        ['Meniscus Treatment', 'meniscus-treatment', 'Knee Treatments', 'Meniscus Treatment'],
        ['Hip Pain Assessment', 'hip-pain-assessment', 'Hip Treatments', 'Hip Pain'],
        ['Hip Mobility Treatment', 'hip-mobility-treatment', 'Hip Treatments', 'Hip Mobility'],
        ['Groin Related Hip Treatment', 'groin-related-hip-treatment', 'Hip Treatments', 'Groin Related Hip Issues'],
    ];

    foreach ($services as [$title, $slug, $parent_category, $category]) {
        $post_id = sportshealing_seed_content_post('sh_service', $title, $slug, [
            'sportshealing_service_benefits_heading' => 'Lorem Ipsum Dolor Sit Amet',
            'sportshealing_service_benefits' => [
                ['text' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit'],
                ['text' => 'Integer posuere erat a ante venenatis dapibus'],
                ['text' => 'Praesent commodo cursus magna vel scelerisque nisl'],
                ['text' => 'Volatility lorem ipsum dolor sit amet'],
                ['text' => 'Correlation lorem ipsum dolor sit amet'],
            ],
            'sportshealing_service_brochures' => [
                ['label' => 'Lorem Ipsum PDF', 'file' => ['url' => '#']],
                ['label' => 'Lorem Ipsum DOC', 'file' => ['url' => '#']],
            ],
            'sportshealing_service_help_heading' => 'Lorem Ipsum Dolor?',
            'sportshealing_service_help_copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.',
            'sportshealing_service_help_phone' => '+1 234 467 88',
            'sportshealing_service_help_email' => 'info@example.com',
            'sportshealing_service_content_rows_enabled' => true,
            'sportshealing_service_content_rows' => [
                [
                    'eyebrow' => 'Expert Treatment',
                    'title' => $title . ' Support',
                    'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>',
                    'media_position' => 'right',
                    'media_type' => 'image',
                    'image' => '',
                    'video_image' => '',
                    'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                ],
                [
                    'eyebrow' => 'Watch And Learn',
                    'title' => 'How This Treatment Helps',
                    'content' => '<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis.</p>',
                    'media_position' => 'left',
                    'media_type' => 'video',
                    'image' => '',
                    'video_image' => '',
                    'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                ],
            ],
            'sportshealing_service_media_items_enabled' => true,
            'sportshealing_service_media_items' => [
                [
                    'title' => 'Treatment Image',
                    'media_type' => 'image',
                    'image' => '',
                    'video_image' => '',
                    'video_url' => '',
                ],
                [
                    'title' => 'Treatment Video',
                    'media_type' => 'video',
                    'image' => '',
                    'video_image' => '',
                    'video_url' => 'https://www.youtube.com/watch?v=Y-x0efG1seA',
                ],
            ],
        ]);

        if ($post_id) {
            sportshealing_seed_service_category($post_id, $category, $parent_category);
        }
    }
}

/**
 * Create listing pages for top-level service category branches.
 */
function sportshealing_seed_service_listing_pages(): void {
    $pages = [
        ['Knee Treatments', 'knee-treatments', 'Knee Treatments'],
        ['Hip Treatments', 'hip-treatments', 'Hip Treatments'],
    ];

    foreach ($pages as [$title, $slug, $parent_category]) {
        $term = term_exists($parent_category, 'sh_service_category');

        if (!$term) {
            $term = wp_insert_term($parent_category, 'sh_service_category');
        }

        if (is_wp_error($term) || !isset($term['term_id'])) {
            continue;
        }

        $page_id = sportshealing_seed_page($title, $slug, 'service-listing-template.php');

        if ($page_id) {
            sportshealing_seed_acf_value($page_id, 'sportshealing_page_heading', $title);
            sportshealing_seed_acf_value($page_id, 'sportshealing_service_listing_parent_category', (int) $term['term_id']);
        }
    }
}

/**
 * Seed service posts once from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_services(): void {
    if (get_option('sportshealing_services_seeded')) {
        return;
    }

    sportshealing_seed_services();
    sportshealing_seed_service_listing_pages();
    update_option('sportshealing_services_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_services');

/**
 * Backfill richer service fields and categories for installs seeded before service categories existed.
 */
function sportshealing_backfill_service_detail_fields(): void {
    if (get_option('sportshealing_service_detail_fields_backfilled')) {
        return;
    }

    sportshealing_seed_services();
    update_option('sportshealing_service_detail_fields_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_service_detail_fields', 30);

/**
 * Backfill the parent/child category model for installs that already ran the older service seeder.
 */
function sportshealing_backfill_service_category_hierarchy(): void {
    if (get_option('sportshealing_service_category_hierarchy_seeded')) {
        return;
    }

    sportshealing_seed_services();
    sportshealing_seed_service_listing_pages();
    update_option('sportshealing_service_category_hierarchy_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_service_category_hierarchy', 35);

/**
 * Backfill shared content/media sections for seeded service details.
 */
function sportshealing_backfill_service_shared_content_sections(): void {
    if (get_option('sportshealing_service_shared_content_sections_seeded')) {
        return;
    }

    sportshealing_seed_services();
    update_option('sportshealing_service_shared_content_sections_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_service_shared_content_sections', 40);
