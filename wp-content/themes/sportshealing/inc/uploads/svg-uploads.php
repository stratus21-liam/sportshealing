<?php
/**
 * SVG upload support for trusted administrators.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Allow SVG files in the media library for users who can manage options.
 */
function sportshealing_upload_mimes(array $mimes): array {
    if (current_user_can('manage_options')) {
        $mimes['svg'] = 'image/svg+xml';
    }

    return $mimes;
}
add_filter('upload_mimes', 'sportshealing_upload_mimes');

/**
 * Correct WordPress filetype checks for SVG uploads.
 */
function sportshealing_check_svg_filetype(array $data, string $file, string $filename, $mimes = null, $real_mime = null): array {
    if (!current_user_can('manage_options')) {
        return $data;
    }

    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if (strtolower($extension) !== 'svg') {
        return $data;
    }

    $data['ext'] = 'svg';
    $data['type'] = 'image/svg+xml';

    return $data;
}
add_filter('wp_check_filetype_and_ext', 'sportshealing_check_svg_filetype', 10, 5);

/**
 * Detect whether an attachment or file path points to an SVG.
 */
function sportshealing_is_svg($attachment_or_file): bool {
    if (is_numeric($attachment_or_file)) {
        return get_post_mime_type((int) $attachment_or_file) === 'image/svg+xml';
    }

    return strtolower(pathinfo((string) $attachment_or_file, PATHINFO_EXTENSION)) === 'svg';
}

/**
 * Skip WordPress image sub-size generation for SVG uploads.
 */
function sportshealing_skip_svg_metadata(array $metadata, int $attachment_id): array {
    if (sportshealing_is_svg($attachment_id)) {
        return [];
    }

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'sportshealing_skip_svg_metadata', 10, 2);

/**
 * Avoid the big-image threshold resize process for SVG uploads.
 */
function sportshealing_skip_svg_big_image_threshold($threshold, array $imagesize, string $file, int $attachment_id) {
    if (sportshealing_is_svg($attachment_id) || sportshealing_is_svg($file)) {
        return false;
    }

    return $threshold;
}
add_filter('big_image_size_threshold', 'sportshealing_skip_svg_big_image_threshold', 10, 4);

/**
 * Prevent thumbnail/intermediate-size generation for SVG attachments.
 */
function sportshealing_skip_svg_intermediate_sizes(array $sizes, array $metadata, int $attachment_id): array {
    if (sportshealing_is_svg($attachment_id)) {
        return [];
    }

    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'sportshealing_skip_svg_intermediate_sizes', 10, 3);

/**
 * Provide basic media-library preview data for SVG attachments.
 */
function sportshealing_prepare_svg_attachment(array $response, WP_Post $attachment): array {
    if (get_post_mime_type($attachment) !== 'image/svg+xml') {
        return $response;
    }

    $url = wp_get_attachment_url($attachment->ID);
    $response['type'] = 'image';
    $response['subtype'] = 'svg+xml';
    $response['icon'] = $url;
    $response['sizes'] = [
        'full' => [
            'url' => $url,
            'width' => 0,
            'height' => 0,
            'orientation' => 'landscape',
        ],
    ];

    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'sportshealing_prepare_svg_attachment', 10, 2);
