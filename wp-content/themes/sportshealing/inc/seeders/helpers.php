<?php
/**
 * Shared helpers for one-time SportsHealing content seeders.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return reusable lorem ipsum body copy for seeded content.
 */
function sportshealing_seed_lorem(int $paragraphs = 2): string {
    $text = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.</p>';
    $text .= '<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper.</p>';
    $text .= '<p>Maecenas faucibus mollis interdum. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>';

    return implode('', array_slice(explode('</p>', $text), 0, $paragraphs)) . '</p>';
}

/**
 * Find an existing post by slug and post type.
 */
function sportshealing_seed_find_post(string $post_type, string $slug): ?WP_Post {
    $post = get_page_by_path($slug, OBJECT, $post_type);

    return $post instanceof WP_Post ? $post : null;
}

/**
 * Create or update a seeded page and assign its template.
 */
function sportshealing_seed_page(string $title, string $slug, string $template): int {
    $existing = sportshealing_seed_find_post('page', $slug);
    $post_id = $existing ? $existing->ID : 0;

    $data = [
        'ID' => $post_id,
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_content' => sportshealing_seed_lorem(2),
    ];

    $post_id = $post_id ? wp_update_post($data) : wp_insert_post($data);

    if (!is_wp_error($post_id) && $post_id) {
        update_post_meta($post_id, '_wp_page_template', $template);
        update_post_meta($post_id, 'sportshealing_seeded', 1);
    }

    return is_wp_error($post_id) ? 0 : (int) $post_id;
}

/**
 * Save ACF data when ACF is available, with post meta fallback for non-ACF runs.
 */
function sportshealing_seed_acf_value(int $post_id, string $field_name, $value): void {
    if (function_exists('update_field')) {
        update_field($field_name, $value, $post_id);
        return;
    }

    update_post_meta($post_id, $field_name, $value);
}

/**
 * Create or update a seeded post for a public post type.
 */
function sportshealing_seed_content_post(string $post_type, string $title, string $slug, array $meta = []): int {
    $existing = sportshealing_seed_find_post($post_type, $slug);
    $post_id = $existing ? $existing->ID : 0;

    $data = [
        'ID' => $post_id,
        'post_type' => $post_type,
        'post_status' => 'publish',
        'post_title' => $title,
        'post_name' => $slug,
        'post_excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.',
        'post_content' => sportshealing_seed_lorem(3),
    ];

    $post_id = $post_id ? wp_update_post($data) : wp_insert_post($data);

    if (is_wp_error($post_id) || !$post_id) {
        return 0;
    }

    update_post_meta($post_id, 'sportshealing_seeded', 1);

    foreach ($meta as $key => $value) {
        sportshealing_seed_acf_value((int) $post_id, $key, $value);
    }

    return (int) $post_id;
}

/**
 * Assign a service category to a service post, creating the term when needed.
 */
function sportshealing_seed_service_category(int $post_id, string $category_name, string $parent_name = ''): void {
    $parent_id = 0;

    if ($parent_name !== '') {
        $parent_term = term_exists($parent_name, 'sh_service_category');

        if (!$parent_term) {
            $parent_term = wp_insert_term($parent_name, 'sh_service_category');
        }

        if (!is_wp_error($parent_term) && isset($parent_term['term_id'])) {
            $parent_id = (int) $parent_term['term_id'];
        }
    }

    $term = term_exists($category_name, 'sh_service_category', $parent_id);

    if (!$term) {
        $term = wp_insert_term($category_name, 'sh_service_category', [
            'parent' => $parent_id,
        ]);
    } elseif ($parent_id && !is_wp_error($term) && isset($term['term_id'])) {
        wp_update_term((int) $term['term_id'], 'sh_service_category', [
            'parent' => $parent_id,
        ]);
    }

    if (!is_wp_error($term) && isset($term['term_id'])) {
        wp_set_object_terms($post_id, [(int) $term['term_id']], 'sh_service_category', false);
    }
}

/**
 * Assign a category to a blog post, creating it when needed.
 */
function sportshealing_seed_post_category(int $post_id, string $category_name): void {
    $term = term_exists($category_name, 'category');

    if (!$term) {
        $term = wp_insert_term($category_name, 'category');
    }

    if (!is_wp_error($term) && isset($term['term_id'])) {
        wp_set_post_terms($post_id, [(int) $term['term_id']], 'category', true);
    }
}
