<?php
/**
 * Generate the ACF import JSON for SportsHealing template/content fields.
 */

$theme_dir = dirname(__DIR__) . '/wp-content/themes/sportshealing';
$groups = [];

/**
 * Capture ACF local groups while running outside WordPress.
 */
function acf_add_local_field_group(array $group): void {
    global $groups;

    $group['active'] = $group['active'] ?? true;
    $groups[] = $group;
}

/**
 * Provide a minimal translation stub for CLI JSON generation.
 */
function __(string $text, string $domain = 'default'): string {
    return $text;
}

/**
 * Ignore WordPress action registration while generating JSON from CLI.
 */
function add_action(string $hook, string $callback, int $priority = 10, int $accepted_args = 1): void {
}

define('ABSPATH', dirname(__DIR__) . '/');

require $theme_dir . '/inc/acf-template-fields.php';

sportshealing_register_acf_template_fields();

@mkdir($theme_dir . '/acf-import', 0775, true);
@mkdir($theme_dir . '/acf-json', 0775, true);

foreach (glob($theme_dir . '/acf-json/group_sportshealing_*.json') ?: [] as $existing_file) {
    unlink($existing_file);
}

file_put_contents($theme_dir . '/acf-import/sportshealing-acf-field-groups.json', json_encode($groups, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

foreach ($groups as $group) {
    file_put_contents($theme_dir . '/acf-json/' . $group['key'] . '.json', json_encode($group, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}
