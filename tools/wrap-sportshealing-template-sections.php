<?php
/**
 * Add ACF show/hide guards around known static template sections.
 */

$theme_dir = dirname(__DIR__) . '/wp-content/themes/sportshealing';

$templates = [
    'templates/home/homepage-1.php' => 'homepage_1',
    'templates/home/homepage-2.php' => 'homepage_2',
    'templates/home/homepage-3.php' => 'homepage_3',
    'templates/pages/about.php' => 'about',
    'templates/pages/appointment.php' => 'appointment',
    'templates/pages/contact.php' => 'contact',
    'templates/pages/faq.php' => 'faq',
    'templates/pages/testimonials.php' => 'testimonials',
    'templates/gallery/image-gallery.php' => 'image_gallery',
    'templates/gallery/video-gallery.php' => 'video_gallery',
];

$aliases = [
    'our_results' => 'results',
    'video_gallery' => 'video_gallery',
    'image_gallery' => 'gallery',
    'gallery' => 'gallery',
    'blog_list' => 'blog',
    'contact_form' => 'contact_form',
    'contact' => 'contact_form',
];

foreach ($templates as $relative => $group_key) {
    $path = $theme_dir . '/' . $relative;
    $contents = file_get_contents($path);

    if ($contents === false || strpos($contents, "sportshealing_{$group_key}_") !== false) {
        continue;
    }

    $contents = preg_replace_callback(
        '/(\s*)(<!-- ([a-zA-Z0-9\-\s]+) section start -->)/',
        static function (array $matches) use ($group_key, $aliases): string {
            $section = trim(strtolower(str_replace(['-', ' '], '_', $matches[3])));
            $section = $aliases[$section] ?? $section;
            $field = "sportshealing_{$group_key}_{$section}_enabled";

            return "{$matches[1]}<?php if (sportshealing_section_enabled('{$field}')) : ?>\n{$matches[1]}{$matches[2]}";
        },
        $contents
    );

    $contents = preg_replace_callback(
        '/(\s*)(<!-- ([a-zA-Z0-9\-\s]+) section end -->)/',
        static function (array $matches): string {
            return "{$matches[1]}{$matches[2]}\n{$matches[1]}<?php endif; ?>";
        },
        $contents
    );

    file_put_contents($path, $contents);
}
