<?php
/**
 * One-time setup for SportsHealing portfolio items.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create lorem ipsum portfolio items for listing and detail routes.
 */
function sportshealing_seed_portfolio(): void {
    $items = [
        ['Lorem Ipsum Case Study', 'lorem-ipsum-case-study'],
        ['Lorem Ipsum Performance Plan', 'lorem-ipsum-performance-plan'],
        ['Lorem Ipsum Recovery Pathway', 'lorem-ipsum-recovery-pathway'],
        ['Lorem Ipsum Athlete Support', 'lorem-ipsum-athlete-support'],
        ['Lorem Ipsum Clinic Outcome', 'lorem-ipsum-clinic-outcome'],
    ];

    $portfolio_ids = [];

    foreach ($items as [$title, $slug]) {
        $post_id = sportshealing_seed_content_post('sh_portfolio', $title, $slug, [
            'sportshealing_portfolio_category' => 'Lorem Ipsum, Dolor Sit',
            'sportshealing_project_information' => [
                ['icon' => 'fas fa-user', 'label' => 'Client', 'value' => 'Lorem Ipsum Client'],
                ['icon' => 'fas fa-map-marker-alt', 'label' => 'Location', 'value' => 'Lorem Ipsum Street'],
                ['icon' => 'fas fa-calendar-days', 'label' => 'Project Date', 'value' => 'Lorem Ipsum 2026'],
                ['icon' => 'fas fa-layer-group', 'label' => 'Category', 'value' => 'Lorem Ipsum Category'],
                ['icon' => 'fas fa-dollar-sign', 'label' => 'Cost', 'value' => 'Lorem Ipsum'],
            ],
            'sportshealing_portfolio_brochures' => [
                ['label' => 'Lorem Ipsum PDF', 'file' => ['url' => '#']],
                ['label' => 'Lorem Ipsum DOC', 'file' => ['url' => '#']],
            ],
            'sportshealing_portfolio_help_heading' => 'Lorem Ipsum Dolor?',
            'sportshealing_portfolio_help_copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.',
            'sportshealing_portfolio_help_phone' => '+1 234 467 88',
            'sportshealing_portfolio_help_email' => 'info@example.com',
        ]);

        if ($post_id) {
            $portfolio_ids[$slug] = $post_id;
        }
    }

    $ids = array_values($portfolio_ids);
    $count = count($ids);

    foreach ($ids as $index => $post_id) {
        $related_rows = [];

        for ($offset = 1; $offset <= min(4, max(0, $count - 1)); $offset++) {
            $related_id = $ids[($index + $offset) % $count];

            if ($related_id !== $post_id) {
                $related_rows[] = ['portfolio_item' => $related_id];
            }
        }

        sportshealing_seed_acf_value($post_id, 'sportshealing_portfolio_related_eyebrow', 'Related Portfolio');
        sportshealing_seed_acf_value($post_id, 'sportshealing_portfolio_related_heading', 'Lorem Ipsum Dolor Sit Amet');
        sportshealing_seed_acf_value($post_id, 'sportshealing_portfolio_related_items', $related_rows);
    }
}

/**
 * Seed portfolio posts once from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_portfolio(): void {
    if (get_option('sportshealing_portfolio_seeded')) {
        return;
    }

    sportshealing_seed_portfolio();
    update_option('sportshealing_portfolio_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_portfolio');

/**
 * Backfill richer portfolio fields for installs seeded before sidebar widgets were rebuilt.
 */
function sportshealing_backfill_portfolio_detail_fields(): void {
    if (get_option('sportshealing_portfolio_detail_fields_backfilled')) {
        return;
    }

    sportshealing_seed_portfolio();
    update_option('sportshealing_portfolio_detail_fields_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_portfolio_detail_fields', 30);

/**
 * Backfill explicit related portfolio rows for installs seeded before related controls existed.
 */
function sportshealing_backfill_portfolio_related_items(): void {
    if (get_option('sportshealing_portfolio_related_items_backfilled')) {
        return;
    }

    sportshealing_seed_portfolio();
    update_option('sportshealing_portfolio_related_items_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_portfolio_related_items', 35);
