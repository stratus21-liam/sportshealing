<?php
/**
 * Theme colour presets that write CSS custom property overrides.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return the editable colour variables and their defaults.
 */
function sportshealing_theme_colour_fields(): array {
    return [
        'primary_color' => [
            'label' => __('Primary Colour', 'sportshealing'),
            'css_var' => '--primary-color',
            'default' => '#035E58',
        ],
        'white_color' => [
            'label' => __('White Colour', 'sportshealing'),
            'css_var' => '--white-color',
            'default' => '#FFFFFF',
        ],
        'black_color' => [
            'label' => __('Black Colour', 'sportshealing'),
            'css_var' => '--black-color',
            'default' => '#000000',
        ],
        'text_color' => [
            'label' => __('Body Text Colour', 'sportshealing'),
            'css_var' => '--text-color',
            'default' => '#525252',
        ],
        'body_color' => [
            'label' => __('Page Background Colour', 'sportshealing'),
            'css_var' => '--body-color',
            'default' => '#FFFFFF',
        ],
        'footer_color' => [
            'label' => __('Footer Background Colour', 'sportshealing'),
            'css_var' => '--footer-color',
            'default' => '#111821',
        ],
        'border_color_one' => [
            'label' => __('Light Border Colour', 'sportshealing'),
            'css_var' => '--border-color-one',
            'default' => '#F3F3F3',
        ],
        'border_color_two' => [
            'label' => __('Strong Border Colour', 'sportshealing'),
            'css_var' => '--border-color-two',
            'default' => '#D3D3D3',
        ],
        'background_one' => [
            'label' => __('Soft Section Background', 'sportshealing'),
            'css_var' => '--background-one',
            'default' => '#F9F9FF',
        ],
        'background_two' => [
            'label' => __('Tinted Section Background', 'sportshealing'),
            'css_var' => '--background-two',
            'default' => '#E6F9F8',
        ],
        'extra_color' => [
            'label' => __('Accent Tint', 'sportshealing'),
            'css_var' => '--extra-color',
            'default' => '#DDF6FA',
        ],
        'extra_color_one' => [
            'label' => __('Accent Tint One', 'sportshealing'),
            'css_var' => '--extra-color-one',
            'default' => '#FFF5F5',
        ],
        'extra_color_two' => [
            'label' => __('Accent Tint Two', 'sportshealing'),
            'css_var' => '--extra-color-two',
            'default' => '#DFFAFF',
        ],
        'extra_color_three' => [
            'label' => __('Accent Tint Three', 'sportshealing'),
            'css_var' => '--extra-color-three',
            'default' => '#FFFAEB',
        ],
        'extra_color_four' => [
            'label' => __('Accent Neutral Background', 'sportshealing'),
            'css_var' => '--extra-color-four',
            'default' => '#F2F4F5',
        ],
        'extra_color_five' => [
            'label' => __('Dark Accent Colour', 'sportshealing'),
            'css_var' => '--extra-color-five',
            'default' => '#0C193E',
        ],
        'extra_color_six' => [
            'label' => __('Dark Accent Colour Two', 'sportshealing'),
            'css_var' => '--extra-color-six',
            'default' => '#0e131a',
        ],
    ];
}

/**
 * Return the upload location for the generated CSS file.
 */
function sportshealing_theme_colours_css_file(): array {
    $uploads = wp_upload_dir();
    $directory = trailingslashit($uploads['basedir']) . 'sportshealing';

    return [
        'dir' => $directory,
        'path' => trailingslashit($directory) . 'theme-colours.css',
        'url' => trailingslashit($uploads['baseurl']) . 'sportshealing/theme-colours.css',
    ];
}

/**
 * Return the active theme colour post.
 */
function sportshealing_active_theme_colour_post(): ?WP_Post {
    $active_posts = get_posts([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby' => 'modified',
        'order' => 'DESC',
        'meta_key' => 'sportshealing_theme_colours_active',
        'meta_value' => '1',
    ]);

    if ($active_posts) {
        return $active_posts[0];
    }

    $posts = get_posts([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'ASC',
    ]);

    return $posts ? $posts[0] : null;
}

/**
 * Return default page loader settings.
 */
function sportshealing_theme_loader_defaults(): array {
    return [
        'enabled' => true,
        'text' => 'Sports',
        'image' => 'assets/images/loader.svg',
    ];
}

/**
 * Return page loader settings from the active theme colours preset.
 */
function sportshealing_theme_loader_settings(): array {
    $defaults = sportshealing_theme_loader_defaults();
    $post = sportshealing_active_theme_colour_post();

    if (!$post) {
        return $defaults;
    }

    $enabled = sportshealing_field_value((int) $post->ID, 'sportshealing_theme_colours_loader_enabled', $defaults['enabled']);
    $text = sportshealing_meta_value((int) $post->ID, 'sportshealing_theme_colours_loader_text', $defaults['text']);
    $image = sportshealing_field_value((int) $post->ID, 'sportshealing_theme_colours_loader_svg', $defaults['image']);

    return [
        'enabled' => (bool) $enabled,
        'text' => $text !== '' ? $text : $defaults['text'],
        'image' => $image ?: $defaults['image'],
    ];
}

/**
 * Return the page loader image URL.
 */
function sportshealing_theme_loader_image_url($image = null): string {
    $defaults = sportshealing_theme_loader_defaults();

    return sportshealing_media_url($image ?: $defaults['image'], $defaults['image']);
}

/**
 * Return default eyebrow icon settings.
 */
function sportshealing_theme_eyebrow_icon_defaults(): array {
    return [
        'enabled' => true,
        'image' => 'assets/images/icon-sub-heading.svg',
    ];
}

/**
 * Return eyebrow icon settings from the active theme colours preset.
 */
function sportshealing_theme_eyebrow_icon_settings(?int $post_id = null): array {
    $defaults = sportshealing_theme_eyebrow_icon_defaults();
    $post_id = $post_id ?: (sportshealing_active_theme_colour_post()->ID ?? 0);

    if (!$post_id) {
        return $defaults;
    }

    $enabled = sportshealing_field_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon_enabled', $defaults['enabled']);
    $image = sportshealing_field_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon', $defaults['image']);

    return [
        'enabled' => (bool) $enabled,
        'image' => $image ?: $defaults['image'],
    ];
}

/**
 * Convert a hex colour into an rgba value.
 */
function sportshealing_hex_to_rgba(string $hex, float $alpha): string {
    $hex = ltrim($hex, '#');

    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    if (!preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
        $hex = '035E58';
    }

    $red = hexdec(substr($hex, 0, 2));
    $green = hexdec(substr($hex, 2, 2));
    $blue = hexdec(substr($hex, 4, 2));

    return sprintf('rgba(%d, %d, %d, %.2F)', $red, $green, $blue, $alpha);
}

/**
 * Build the CSS custom property override content.
 */
function sportshealing_build_theme_colours_css(?int $post_id = null): string {
    $post_id = $post_id ?: (sportshealing_active_theme_colour_post()->ID ?? 0);
    $lines = [
        '/**',
        ' * Generated by SportsHealing Theme Colours.',
        ' * Do not edit directly; update the active Theme Colours post instead.',
        ' */',
        ':root {',
    ];

    $primary_colour = '#035E58';

    foreach (sportshealing_theme_colour_fields() as $field_key => $field) {
        $field_name = 'sportshealing_theme_colours_' . $field_key;
        $value = $post_id ? sportshealing_field_value($post_id, $field_name, $field['default']) : $field['default'];
        $value = is_string($value) && sanitize_hex_color($value) ? sanitize_hex_color($value) : $field['default'];

        if ($field_key === 'primary_color') {
            $primary_colour = $value;
        }

        $lines[] = sprintf('    %s: %s;', $field['css_var'], $value);
    }

    $lines[] = sprintf('    --primary-rgb-05: %s;', sportshealing_hex_to_rgba($primary_colour, 0.10));
    $lines[] = '}';
    $lines[] = '';

    $eyebrow_icon = sportshealing_theme_eyebrow_icon_settings($post_id);

    if (!empty($eyebrow_icon['enabled'])) {
        $lines[] = '.section-title .sub-title::before {';
        $lines[] = sprintf('    background-image: url("%s");', esc_url_raw(sportshealing_media_url($eyebrow_icon['image'], sportshealing_theme_eyebrow_icon_defaults()['image'])));
        $lines[] = '    background-size: contain;';
        $lines[] = '    background-repeat: no-repeat;';
        $lines[] = '    background-position: center;';
        $lines[] = '    width: 24px;';
        $lines[] = '    height: 24px;';
        $lines[] = '}';
        $lines[] = '@media (max-width: 767px) {';
        $lines[] = '    .section-title .sub-title::before {';
        $lines[] = '        width: 20px;';
        $lines[] = '        height: 20px;';
        $lines[] = '    }';
        $lines[] = '}';
    } else {
        $lines[] = '.section-title .sub-title {';
        $lines[] = '    padding-left: 15px;';
        $lines[] = '}';
        $lines[] = '.section-title .sub-title::before {';
        $lines[] = '    display: none;';
        $lines[] = '}';
    }

    $lines[] = '';

    return implode("\n", $lines);
}

/**
 * Write the active colour preset CSS file.
 */
function sportshealing_write_theme_colours_css(?int $post_id = null): bool {
    $file = sportshealing_theme_colours_css_file();

    if (!wp_mkdir_p($file['dir'])) {
        return false;
    }

    return (bool) file_put_contents($file['path'], sportshealing_build_theme_colours_css($post_id));
}

/**
 * Keep only one colour preset active.
 */
function sportshealing_keep_single_active_theme_colour(int $post_id): void {
    $is_active = sportshealing_field_value($post_id, 'sportshealing_theme_colours_active', false);

    if (!$is_active) {
        return;
    }

    $other_posts = get_posts([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'fields' => 'ids',
        'post__not_in' => [$post_id],
        'meta_key' => 'sportshealing_theme_colours_active',
        'meta_value' => '1',
    ]);

    foreach ($other_posts as $other_post_id) {
        sportshealing_seed_acf_value((int) $other_post_id, 'sportshealing_theme_colours_active', 0);
    }
}

/**
 * Rebuild CSS after ACF has saved the colour picker values.
 */
function sportshealing_save_theme_colours($post_id): void {
    if (!is_numeric($post_id)) {
        return;
    }

    $post_id = (int) $post_id;

    if (wp_is_post_revision($post_id) || get_post_type($post_id) !== 'sh_theme_colour') {
        return;
    }

    sportshealing_keep_single_active_theme_colour($post_id);

    $active_post = sportshealing_active_theme_colour_post();
    sportshealing_write_theme_colours_css($active_post ? (int) $active_post->ID : $post_id);
}
add_action('acf/save_post', 'sportshealing_save_theme_colours', 20);

/**
 * Load generated colour overrides after the main theme stylesheet.
 */
function sportshealing_enqueue_theme_colours(): void {
    $file = sportshealing_theme_colours_css_file();

    if (!file_exists($file['path'])) {
        sportshealing_write_theme_colours_css();
    }

    if (!file_exists($file['path'])) {
        return;
    }

    wp_enqueue_style('sportshealing-theme-colours', $file['url'], ['sportshealing-style'], (string) filemtime($file['path']));
}
add_action('wp_enqueue_scripts', 'sportshealing_enqueue_theme_colours', 30);

/**
 * Seed a single default colour preset and write the first CSS file.
 */
function sportshealing_seed_theme_colours(): void {
    if (get_option('sportshealing_theme_colours_seeded')) {
        return;
    }

    $existing = sportshealing_seed_find_post('sh_theme_colour', 'default-theme-colours');
    $post_id = $existing ? $existing->ID : wp_insert_post([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'publish',
        'post_title' => 'Default Theme Colours',
        'post_name' => 'default-theme-colours',
    ]);

    if (is_wp_error($post_id) || !$post_id) {
        return;
    }

    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_active', 1);
    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_enabled', 1);
    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_text', 'Sports');
    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_svg', 'assets/images/loader.svg');
    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon_enabled', 1);
    sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon', 'assets/images/icon-sub-heading.svg');

    foreach (sportshealing_theme_colour_fields() as $field_key => $field) {
        sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_' . $field_key, $field['default']);
    }

    sportshealing_write_theme_colours_css((int) $post_id);
    update_option('sportshealing_theme_colours_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_seed_theme_colours', 20);

/**
 * Add page loader defaults to existing theme colour presets.
 */
function sportshealing_backfill_theme_loader_settings(): void {
    if (get_option('sportshealing_theme_loader_settings_seeded')) {
        return;
    }

    $posts = get_posts([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'fields' => 'ids',
    ]);

    foreach ($posts as $post_id) {
        if (!metadata_exists('post', (int) $post_id, 'sportshealing_theme_colours_loader_enabled')) {
            sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_enabled', 1);
        }

        if (!metadata_exists('post', (int) $post_id, 'sportshealing_theme_colours_loader_text')) {
            sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_text', 'Sports');
        }

        if (!metadata_exists('post', (int) $post_id, 'sportshealing_theme_colours_loader_svg')) {
            sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_loader_svg', 'assets/images/loader.svg');
        }
    }

    update_option('sportshealing_theme_loader_settings_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_theme_loader_settings', 21);

/**
 * Add eyebrow icon defaults to existing theme colour presets.
 */
function sportshealing_backfill_theme_eyebrow_icon_settings(): void {
    if (get_option('sportshealing_theme_eyebrow_icon_settings_seeded')) {
        return;
    }

    $posts = get_posts([
        'post_type' => 'sh_theme_colour',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'fields' => 'ids',
    ]);

    foreach ($posts as $post_id) {
        if (!metadata_exists('post', (int) $post_id, 'sportshealing_theme_colours_eyebrow_icon_enabled')) {
            sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon_enabled', 1);
        }

        if (!metadata_exists('post', (int) $post_id, 'sportshealing_theme_colours_eyebrow_icon')) {
            sportshealing_seed_acf_value((int) $post_id, 'sportshealing_theme_colours_eyebrow_icon', 'assets/images/icon-sub-heading.svg');
        }
    }

    sportshealing_write_theme_colours_css();
    update_option('sportshealing_theme_eyebrow_icon_settings_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_theme_eyebrow_icon_settings', 22);
