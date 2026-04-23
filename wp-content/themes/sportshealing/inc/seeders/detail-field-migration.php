<?php
/**
 * One-time migration for legacy generic detail field names.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Read a legacy ACF/meta value without creating a public template dependency.
 */
function sportshealing_legacy_detail_field_value(int $post_id, string $key) {
    if (function_exists('get_field')) {
        $value = get_field($key, $post_id);

        if ($value !== null && $value !== '' && $value !== false) {
            return $value;
        }
    }

    return get_post_meta($post_id, $key, true);
}

/**
 * Copy a legacy field value to its new content-type-specific field name when needed.
 */
function sportshealing_migrate_detail_field(int $post_id, string $old_key, string $new_key): void {
    $new_value = sportshealing_legacy_detail_field_value($post_id, $new_key);

    if ($new_value !== null && $new_value !== '' && $new_value !== false && $new_value !== []) {
        return;
    }

    $old_value = sportshealing_legacy_detail_field_value($post_id, $old_key);

    if ($old_value === null || $old_value === '' || $old_value === false || $old_value === []) {
        return;
    }

    sportshealing_seed_acf_value($post_id, $new_key, $old_value);
}

/**
 * Copy previously seeded generic detail fields into their unique post-type fields.
 */
function sportshealing_migrate_unique_detail_fields(): void {
    if (get_option('sportshealing_unique_detail_fields_migrated')) {
        return;
    }

    $maps = [
        'post' => [
            'sportshealing_image_fallback' => 'sportshealing_blog_listing_image',
        ],
        'sh_doctor' => [
        ],
        'sh_service' => [
            'sportshealing_benefits_heading' => 'sportshealing_service_benefits_heading',
            'sportshealing_benefits' => 'sportshealing_service_benefits',
            'sportshealing_brochures' => 'sportshealing_service_brochures',
            'sportshealing_help_heading' => 'sportshealing_service_help_heading',
            'sportshealing_help_copy' => 'sportshealing_service_help_copy',
            'sportshealing_help_phone' => 'sportshealing_service_help_phone',
            'sportshealing_help_email' => 'sportshealing_service_help_email',
        ],
        'sh_portfolio' => [
            'sportshealing_brochures' => 'sportshealing_portfolio_brochures',
            'sportshealing_help_heading' => 'sportshealing_portfolio_help_heading',
            'sportshealing_help_copy' => 'sportshealing_portfolio_help_copy',
            'sportshealing_help_phone' => 'sportshealing_portfolio_help_phone',
            'sportshealing_help_email' => 'sportshealing_portfolio_help_email',
        ],
    ];

    foreach ($maps as $post_type => $field_map) {
        $post_ids = get_posts([
            'post_type' => $post_type,
            'post_status' => 'any',
            'fields' => 'ids',
            'numberposts' => -1,
        ]);

        foreach ($post_ids as $post_id) {
            foreach ($field_map as $old_key => $new_key) {
                sportshealing_migrate_detail_field((int) $post_id, $old_key, $new_key);
            }
        }
    }

    update_option('sportshealing_unique_detail_fields_migrated', 1, false);
}
add_action('admin_init', 'sportshealing_migrate_unique_detail_fields', 40);

/**
 * Remove seeded path strings from fields that are now image upload controls.
 */
function sportshealing_clear_legacy_image_path_values(): void {
    if (get_option('sportshealing_legacy_image_path_values_cleared')) {
        return;
    }

    $image_fields = [
        'sh_doctor' => [
            'sportshealing_doctor_listing_image',
            'sportshealing_doctor_detail_image',
        ],
        'sh_service' => [
            'sportshealing_service_icon',
            'sportshealing_service_detail_image',
            'sportshealing_service_gallery',
        ],
        'sh_portfolio' => [
            'sportshealing_portfolio_listing_image',
            'sportshealing_portfolio_detail_image',
        ],
    ];

    foreach ($image_fields as $post_type => $fields) {
        $post_ids = get_posts([
            'post_type' => $post_type,
            'post_status' => 'any',
            'fields' => 'ids',
            'numberposts' => -1,
        ]);

        foreach ($post_ids as $post_id) {
            foreach ($fields as $field) {
                $value = sportshealing_legacy_detail_field_value((int) $post_id, $field);

                if (is_string($value) && str_starts_with($value, 'assets/')) {
                    delete_post_meta((int) $post_id, $field);
                    delete_post_meta((int) $post_id, '_' . $field);
                }

                if (
                    is_array($value)
                    && $field === 'sportshealing_service_gallery'
                    && $value
                    && array_reduce($value, static function (bool $carry, $item): bool {
                        return $carry && is_array($item) && empty($item['ID']) && empty($item['id']) && isset($item['url']) && is_string($item['url']);
                    }, true)
                ) {
                    delete_post_meta((int) $post_id, $field);
                    delete_post_meta((int) $post_id, '_' . $field);
                }
            }

            if ($post_type !== 'sh_doctor') {
                continue;
            }

            $awards = sportshealing_legacy_detail_field_value((int) $post_id, 'sportshealing_doctor_awards');

            if (!is_array($awards)) {
                continue;
            }

            $changed = false;

            foreach ($awards as &$award) {
                if (isset($award['image']) && is_string($award['image']) && str_starts_with($award['image'], 'assets/')) {
                    unset($award['image']);
                    $changed = true;
                }
            }
            unset($award);

            if ($changed) {
                sportshealing_seed_acf_value((int) $post_id, 'sportshealing_doctor_awards', $awards);
            }
        }
    }

    update_option('sportshealing_legacy_image_path_values_cleared', 1, false);
}
add_action('admin_init', 'sportshealing_clear_legacy_image_path_values', 42);

/**
 * Remove the legacy shared ACF group if it exists from an earlier database import.
 */
function sportshealing_remove_legacy_entry_content_acf_group(): void {
    if (get_option('sportshealing_legacy_entry_content_group_removed')) {
        return;
    }

    $groups = get_posts([
        'post_type' => 'acf-field-group',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'title' => 'SportsHealing Entry Content',
    ]);

    foreach ($groups as $group) {
        $fields = get_posts([
            'post_type' => 'acf-field',
            'post_status' => 'any',
            'post_parent' => $group->ID,
            'posts_per_page' => -1,
        ]);

        foreach ($fields as $field) {
            wp_delete_post($field->ID, true);
        }

        wp_delete_post($group->ID, true);
    }

    update_option('sportshealing_legacy_entry_content_group_removed', 1, false);
}
add_action('admin_init', 'sportshealing_remove_legacy_entry_content_acf_group', 45);
