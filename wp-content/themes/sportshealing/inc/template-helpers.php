<?php
/**
 * Shared template rendering helpers for CMS-backed pages.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return the global image fallback requested for missing CMS media.
 */
function sportshealing_default_image_path(): string {
    return 'assets/images/1903x500.jpg';
}

/**
 * Return a theme asset URL unless a post thumbnail is available.
 */
function sportshealing_content_image_url(int $post_id, string $fallback): string {
    $thumbnail = get_the_post_thumbnail_url($post_id, 'full');

    return $thumbnail ? $thumbnail : sportshealing_asset_url($fallback ?: sportshealing_default_image_path());
}

/**
 * Return an uploaded ACF image first, then the post thumbnail, then a bundled asset fallback.
 */
function sportshealing_content_field_image_url(int $post_id, string $field_key, string $fallback): string {
    $field_value = sportshealing_field_value($post_id, $field_key);

    if ($field_value !== null && $field_value !== '' && $field_value !== false && $field_value !== []) {
        return sportshealing_media_url($field_value, $fallback);
    }

    return sportshealing_content_image_url($post_id, $fallback);
}

/**
 * Return a raw ACF/meta value with a simple fallback.
 */
function sportshealing_field_value(int $post_id, string $key, $fallback = '') {
    $value = function_exists('get_field') ? get_field($key, $post_id) : get_post_meta($post_id, $key, true);

    if ($value === null || $value === '' || $value === false) {
        $value = get_post_meta($post_id, $key, true);
    }

    return $value !== null && $value !== '' && $value !== false ? $value : $fallback;
}

/**
 * Return an ACF/meta value as a string with a simple fallback.
 */
function sportshealing_meta_value(int $post_id, string $key, string $fallback = ''): string {
    $value = sportshealing_field_value($post_id, $key, $fallback);

    return is_scalar($value) && $value !== '' ? (string) $value : $fallback;
}

/**
 * Return a repeater-style field as an array, including seeded meta fallback values.
 */
function sportshealing_repeater_value(int $post_id, string $key, array $fallback = []): array {
    $value = sportshealing_field_value($post_id, $key, $fallback);

    return is_array($value) && $value ? $value : $fallback;
}

/**
 * Return a readable label for supported Font Awesome brand social icons.
 */
function sportshealing_social_icon_label(string $icon): string {
    $labels = [
        'fa-brands fa-facebook-f' => __('Facebook', 'sportshealing'),
        'fa-brands fa-instagram' => __('Instagram', 'sportshealing'),
        'fa-brands fa-x-twitter' => __('X', 'sportshealing'),
        'fa-brands fa-linkedin-in' => __('LinkedIn', 'sportshealing'),
        'fa-brands fa-youtube' => __('YouTube', 'sportshealing'),
        'fa-brands fa-tiktok' => __('TikTok', 'sportshealing'),
        'fa-brands fa-pinterest-p' => __('Pinterest', 'sportshealing'),
    ];

    return $labels[$icon] ?? __('Social media', 'sportshealing');
}

/**
 * Render social links from an ACF repeater containing icon and url rows.
 */
function sportshealing_render_social_links($social_links, string $list_class = 'social-icon'): void {
    if (!is_array($social_links)) {
        return;
    }

    $social_links = array_filter($social_links, static function ($item) {
        return is_array($item) && !empty($item['url']);
    });

    if (!$social_links) {
        return;
    }
    ?>
    <ul<?php echo $list_class ? ' class="' . esc_attr($list_class) . '"' : ''; ?>>
        <?php foreach ($social_links as $social_link) : ?>
            <?php
            $social_icon = !empty($social_link['icon']) ? (string) $social_link['icon'] : 'fa-brands fa-facebook-f';
            $social_url = (string) $social_link['url'];
            ?>
            <li>
                <a href="<?php echo esc_url($social_url); ?>" aria-label="<?php echo esc_attr(sportshealing_social_icon_label($social_icon)); ?>" target="_blank" rel="noopener">
                    <i class="<?php echo esc_attr($social_icon); ?>"></i>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}

/**
 * Convert an ACF image/file value, attachment ID, URL, or theme path into a usable URL.
 */
function sportshealing_media_url($value, string $fallback = ''): string {
    if (is_array($value)) {
        $candidate = $value['url'] ?? '';
    } elseif (is_numeric($value)) {
        $candidate = wp_get_attachment_url((int) $value);
    } else {
        $candidate = is_string($value) ? $value : '';
    }

    if ($candidate === '#' || ($candidate && preg_match('#^https?://#', $candidate))) {
        return $candidate;
    }

    $resolved_fallback = $fallback ?: sportshealing_default_image_path();

    if (!$candidate && preg_match('#^https?://#', $resolved_fallback)) {
        return $resolved_fallback;
    }

    return sportshealing_asset_url($candidate ?: $resolved_fallback);
}

/**
 * Render a reusable image/video media block for content sections.
 */
function sportshealing_render_content_media_item(array $item): void {
    $media_type = $item['media_type'] ?? 'image';
    $image_fallback = !empty($item['image_fallback']) ? (string) $item['image_fallback'] : 'assets/images/about/about-1-1.jpg';
    $video_fallback = !empty($item['video_fallback']) ? (string) $item['video_fallback'] : 'assets/images/video-gallery/video-gallery-1.jpg';
    $image = sportshealing_media_url($item['image'] ?? '', $image_fallback);
    $video_url = !empty($item['video_url']) ? (string) $item['video_url'] : '';
    $video_image = sportshealing_media_url($item['video_image'] ?? '', $video_fallback);
    $title = !empty($item['title']) ? (string) $item['title'] : __('Content media', 'sportshealing');

    if ($media_type === 'video' && $video_url) {
        ?>
        <div class="video-gallery-item">
            <a href="<?php echo esc_url($video_url); ?>" class="video-popup">
                <figure>
                    <img src="<?php echo esc_url($video_image); ?>" alt="<?php echo esc_attr($title); ?>">
                </figure>
                <div class="play-button"><i class="fas fa-play"></i></div>
            </a>
        </div>
        <?php
        return;
    }
    ?>
    <div class="photo-gallery">
        <div class="photo-gallery-image">
            <figure class="image-anime">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
            </figure>
        </div>
        <div class="photo-gallery-icon">
            <a class="photo-popup" href="<?php echo esc_url($image); ?>" aria-label="<?php echo esc_attr($title); ?>"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>
    <?php
}

/**
 * Return the CMS listing page URL for a content area.
 */
function sportshealing_listing_page_url(string $slug): string {
    $page = get_page_by_path($slug);

    return $page ? get_permalink($page) : home_url(trailingslashit($slug));
}

/**
 * Return an ACF option value with a plain WordPress option fallback.
 */
function sportshealing_option_value(string $key, string $fallback = ''): string {
    $value = function_exists('get_field') ? get_field($key, 'option') : get_option($key, '');

    return is_scalar($value) && $value !== '' ? (string) $value : $fallback;
}

/**
 * Check whether a template section is enabled for the current page or options record.
 */
function sportshealing_section_enabled(string $key, $post_id = null): bool {
    $target = $post_id ?? get_the_ID();

    if (is_numeric($target) && !metadata_exists('post', (int) $target, $key)) {
        return true;
    }

    $value = function_exists('get_field') ? get_field($key, $target) : get_post_meta((int) $target, $key, true);

    return $value === null || $value === '' ? true : (bool) $value;
}

/**
 * Return the current template section key used while rendering a partial.
 */
function sportshealing_current_section_key(): string {
    return isset($GLOBALS['sportshealing_current_section_key']) ? (string) $GLOBALS['sportshealing_current_section_key'] : '';
}

/**
 * Return the current post ID used for page-template section fields.
 */
function sportshealing_current_section_post_id(): int {
    return isset($GLOBALS['sportshealing_current_section_post_id']) ? (int) $GLOBALS['sportshealing_current_section_post_id'] : (int) get_the_ID();
}

/**
 * Return the base ACF section field prefix for the current template part.
 */
function sportshealing_section_field_prefix(string $section_key = ''): string {
    $section_key = $section_key ?: sportshealing_current_section_key();

    return preg_replace('/_enabled$/', '', $section_key) ?: $section_key;
}

/**
 * Return a raw ACF section value from the current page edit screen.
 */
function sportshealing_acf_section_value(string $field) {
    $prefix = sportshealing_section_field_prefix();

    if (!$prefix || !function_exists('get_field')) {
        return '';
    }

    $field_name = "{$prefix}_{$field}";
    $post_id = sportshealing_current_section_post_id();
    $value = get_field($field_name, $post_id);

    if ($value !== null && $value !== '' && $value !== false) {
        return $value;
    }

    $field_object = function_exists('get_field_object') ? get_field_object($field_name, $post_id) : false;

    return is_array($field_object) && array_key_exists('default_value', $field_object) ? $field_object['default_value'] : '';
}

/**
 * Return a text ACF section value from the current page edit screen.
 */
function sportshealing_acf_section_text(string $field): string {
    $value = sportshealing_acf_section_value($field);

    return is_scalar($value) ? (string) $value : '';
}

/**
 * Return a section image URL from the current page edit screen.
 */
function sportshealing_acf_section_image_url(string $fallback = ''): string {
    return sportshealing_media_url(sportshealing_acf_section_value('image'), $fallback ?: sportshealing_default_image_path());
}

/**
 * Return a named section image URL from the current page edit screen.
 */
function sportshealing_acf_section_named_image_url(string $field, string $fallback = ''): string {
    return sportshealing_media_url(sportshealing_acf_section_value($field), $fallback ?: sportshealing_default_image_path());
}

/**
 * Return a page URL from a section post object/page selector field.
 */
function sportshealing_acf_section_page_url(string $field, string $fallback = ''): string {
    $page = sportshealing_acf_section_value($field);
    $page_id = 0;

    if ($page instanceof WP_Post) {
        $page_id = (int) $page->ID;
    } elseif (is_array($page) && isset($page['ID'])) {
        $page_id = (int) $page['ID'];
    } elseif (is_numeric($page)) {
        $page_id = (int) $page;
    }

    return $page_id ? get_permalink($page_id) : $fallback;
}

/**
 * Return selected posts from a section post selector, with a latest-post fallback.
 */
function sportshealing_acf_section_posts(string $field, string $post_type = 'post', int $limit = 3): array {
    $selected = sportshealing_acf_section_value($field);
    $posts = [];

    if ($selected instanceof WP_Post || is_numeric($selected)) {
        $selected = [$selected];
    }

    if (is_array($selected)) {
        foreach ($selected as $post) {
            $post_id = $post instanceof WP_Post ? (int) $post->ID : (is_array($post) && isset($post['ID']) ? (int) $post['ID'] : (is_numeric($post) ? (int) $post : 0));

            if ($post_id) {
                $resolved = get_post($post_id);

                if ($resolved && $resolved->post_type === $post_type && $resolved->post_status === 'publish') {
                    $posts[] = $resolved;
                }
            }
        }
    }

    if ($posts) {
        return array_slice($posts, 0, $limit);
    }

    return get_posts([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
}

/**
 * Return the current page edit screen's section item repeater rows.
 */
function sportshealing_acf_section_items(): array {
    $items = sportshealing_acf_section_value('items');

    return is_array($items) ? $items : [];
}

/**
 * Return one value from the current page edit screen's section item repeater.
 */
function sportshealing_acf_section_item_value(int $index, string $field): string {
    $items = sportshealing_acf_section_items();
    $value = $items[$index][$field] ?? '';

    return is_scalar($value) ? (string) $value : '';
}

/**
 * Return one image URL from the current page edit screen's section item repeater.
 */
function sportshealing_acf_section_item_image_url(int $index, string $fallback = ''): string {
    $items = sportshealing_acf_section_items();

    return sportshealing_media_url($items[$index]['image'] ?? '', $fallback ?: sportshealing_default_image_path());
}

/**
 * Return one URL from the current page edit screen's section item repeater.
 */
function sportshealing_acf_section_item_url(int $index): string {
    $items = sportshealing_acf_section_items();
    $value = $items[$index]['url'] ?? '';

    return is_scalar($value) ? (string) $value : '';
}

/**
 * Render a template part with the current page's ACF section context.
 */
function sportshealing_render_template_part(string $file, string $section_key): void {
    $previous_key = $GLOBALS['sportshealing_current_section_key'] ?? null;
    $previous_post = $GLOBALS['sportshealing_current_section_post_id'] ?? null;
    $GLOBALS['sportshealing_current_section_key'] = $section_key;
    $GLOBALS['sportshealing_current_section_post_id'] = (int) get_the_ID();

    if ($file === 'breadcrumb.php') {
        sportshealing_dynamic_breadcrumb();
    } else {
        $path = get_theme_file_path('templates-parts/' . ltrim($file, '/'));

        if (file_exists($path)) {
            include $path;
        }
    }

    if ($previous_key === null) {
        unset($GLOBALS['sportshealing_current_section_key']);
    } else {
        $GLOBALS['sportshealing_current_section_key'] = $previous_key;
    }

    if ($previous_post === null) {
        unset($GLOBALS['sportshealing_current_section_post_id']);
    } else {
        $GLOBALS['sportshealing_current_section_post_id'] = $previous_post;
    }
}

/**
 * Render the standard breadcrumb from WordPress page context.
 */
function sportshealing_dynamic_breadcrumb(): void {
    $title = is_singular() || is_page() ? get_the_title() : wp_get_document_title();
    sportshealing_breadcrumb($title ?: get_bloginfo('name'), [], sportshealing_acf_section_image_url('assets/images/breadcrumb/breadcrumb.png'));
}

/**
 * Print the standard breadcrumb band for CMS-backed templates.
 */
function sportshealing_breadcrumb(string $title, array $parents = [], string $image_url = ''): void {
    $image_url = $image_url ?: sportshealing_asset_url('assets/images/breadcrumb/breadcrumb.png');
    ?>
    <section class="breadcrumb-section" data-img-src="<?php echo esc_url($image_url); ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="breadcrumb-title wow fadeInUp" data-wow-delay=".2s">
                            <h1><?php echo esc_html($title); ?></h1>
                        </div>
                        <nav aria-label="<?php esc_attr_e('breadcrumb', 'sportshealing'); ?>" class="wow fadeInUp" data-wow-delay=".3s">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'sportshealing'); ?></a></li>
                                <?php foreach ($parents as $parent_title => $parent_url) : ?>
                                    <li class="breadcrumb-item"><a href="<?php echo esc_url($parent_url); ?>"><?php echo esc_html($parent_title); ?></a></li>
                                <?php endforeach; ?>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo esc_html($title); ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-shape">
            <img class="breadcrumb-shape-one" src="<?php echo esc_url(sportshealing_asset_url('assets/images/shape/shape-4.png')); ?>" alt="">
            <img class="breadcrumb-shape-two" src="<?php echo esc_url(sportshealing_asset_url('assets/images/shape/square-blue.png')); ?>" alt="">
            <img class="breadcrumb-shape-three" src="<?php echo esc_url(sportshealing_asset_url('assets/images/shape/plus-orange.png')); ?>" alt="">
        </div>
    </section>
    <?php
}

/**
 * Print the reusable newsletter CTA from the source HTML.
 */
function sportshealing_newsletter_cta(): void {
    $heading = sportshealing_option_value('sportshealing_cta_heading', 'Lorem Ipsum Dolor Sit Amet');
    $intro = sportshealing_option_value('sportshealing_cta_intro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.');
    $button_label = sportshealing_option_value('sportshealing_cta_button_label', 'Submit Now');

    if (!$heading && !$intro && !$button_label) {
        return;
    }
    ?>
    <section class="cta-section-3 pb-100 md-pb-80">
        <div class="container">
            <div class="cta-wapper" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/cta/background-cta-shape.png')); ?>">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-5">
                        <div class="cta-content">
                            <div class="section-title">
                                <?php if ($heading) : ?>
                                    <h2><?php echo esc_html($heading); ?></h2>
                                <?php endif; ?>
                                <?php if ($intro) : ?>
                                    <p><?php echo esc_html($intro); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cta-form">
                            <div class="cta-shape"><img src="<?php echo esc_url(sportshealing_asset_url('assets/images/cta/cta-shape-1.png')); ?>" alt=""></div>
                            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                <div class="form-group mb-0">
                                    <div class="form-floating field-inner">
                                        <input id="subscribe" name="s" class="form-control white-field" placeholder="<?php esc_attr_e('Enter Address', 'sportshealing'); ?>" type="text" autocomplete="off">
                                        <label for="subscribe"><?php esc_html_e('Enter Address', 'sportshealing'); ?></label>
                                        <button type="submit" class="theme-button style-3" aria-label="<?php echo esc_attr($button_label); ?>">
                                            <span data-text="<?php echo esc_attr($button_label); ?>"><?php echo esc_html($button_label); ?></span>
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * Print pagination with the Carenix page-list class.
 */
function sportshealing_pagination(): void {
    $links = paginate_links([
        'type' => 'array',
        'prev_text' => __('Previous Page', 'sportshealing'),
        'next_text' => __('Next Page', 'sportshealing'),
    ]);

    if (!$links) {
        return;
    }
    ?>
    <div class="pagination justify-content-center mt-0">
        <nav aria-label="<?php esc_attr_e('Page navigation', 'sportshealing'); ?>">
            <ul class="page-list">
                <?php foreach ($links as $link) : ?>
                    <li><?php echo wp_kses_post($link); ?></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <?php
}
