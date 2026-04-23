<?php
/**
 * CMS-managed header and footer loader.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Read an ACF field with a default when ACF or the value is unavailable.
 */
function sportshealing_get_field(string $name, int $post_id = 0, $default = '') {
    if ($post_id && function_exists('get_field')) {
        $value = get_field($name, $post_id);
        return $value !== null && $value !== '' ? $value : $default;
    }

    return $default;
}

/**
 * Read an ACF true/false field as a strict boolean.
 */
function sportshealing_bool_field(string $name, int $post_id): bool {
    return (bool) sportshealing_get_field($name, $post_id, false);
}

/**
 * Resolve which homepage family the current template belongs to.
 */
function sportshealing_theme_home_context(): string {
    if (is_page_template('homepage-2-template.php') || is_page_template('template-index-2.php')) {
        return 'home_index_two';
    }

    if (is_page_template('homepage-3-template.php') || is_page_template('template-index-3.php')) {
        return 'home_index_three';
    }

    return 'home_index_one';
}

/**
 * Convert the stored variant slug into the Carenix numeric class suffix.
 */
function sportshealing_variant_number(string $variant): string {
    if ($variant === 'two') {
        return '2';
    }

    if ($variant === 'three') {
        return '3';
    }

    return '1';
}

/**
 * Find a selected Header/Footer record from the Customizer.
 */
function sportshealing_selected_layout_post(string $post_type): int {
    $setting = $post_type === 'sh_header' ? 'sportshealing_selected_header' : 'sportshealing_selected_footer';
    $post_id = (int) get_theme_mod($setting);

    if (!$post_id) {
        return 0;
    }

    return get_post_type($post_id) === $post_type && get_post_status($post_id) === 'publish' ? $post_id : 0;
}

/**
 * Find the selected or first published Header/Footer option record.
 */
function sportshealing_find_layout_post(string $post_type, string $context = ''): int {
    $selected_post_id = sportshealing_selected_layout_post($post_type);

    if ($selected_post_id) {
        return $selected_post_id;
    }

    $posts = get_posts([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    ]);

    return $posts ? (int) $posts[0]->ID : 0;
}

/**
 * Pick the default layout variant for a homepage context.
 */
function sportshealing_default_variant_for_context(string $context): string {
    if ($context === 'home_index_two') {
        return 'two';
    }

    if ($context === 'home_index_three') {
        return 'three';
    }

    return 'one';
}

/**
 * Build the PHP partial path for a header or footer variant.
 */
function sportshealing_layout_path(string $type, string $variant): string {
    $variant_number = sportshealing_variant_number($variant);

    return get_template_directory() . "/inc/header-footer/{$type}/{$type}-{$variant_number}.php";
}

/**
 * Gather shared ACF values used by header and footer partials.
 */
function sportshealing_layout_data(int $post_id, string $variant, string $type): array {
    $button_page_id = (int) sportshealing_get_field('sportshealing_header_button_page', $post_id, 0);

    return [
        'post_id' => $post_id,
        'variant' => $variant,
        'variant_number' => sportshealing_variant_number($variant),
        'type' => $type,
        'address' => sportshealing_get_field('sportshealing_address', $post_id, '123 Serenity Lane, Suite 101, Hometown, CA 12345'),
        'email' => sportshealing_get_field('sportshealing_email', $post_id, 'info@example.com'),
        'phone' => sportshealing_get_field('sportshealing_phone', $post_id, '+1 234 467 88'),
        'hours' => sportshealing_get_field('sportshealing_hours', $post_id, 'Mon - Fri 8:00 - 6:30'),
        'cta_label' => sportshealing_get_field('sportshealing_cta_label', $post_id, 'Book Appointment'),
        'button_url' => $button_page_id ? get_permalink($button_page_id) : sportshealing_static_url('appointment.html'),
        'coupon_text' => sportshealing_get_field('sportshealing_coupon_text', $post_id, 'Use Coupon Code LDW20 for 20% off.'),
        'offcanvas_intro' => sportshealing_get_field('sportshealing_offcanvas_intro', $post_id, 'There are many variations of passages available sure there majority have suffered alteration in some form.'),
        'footer_about_html' => sportshealing_get_field('sportshealing_footer_about_html', $post_id, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor asin cididunt ut labore et dolore magna ali qua.'),
        'opening_hours_html' => sportshealing_get_field('sportshealing_opening_hours_html', $post_id, '<ul class="opening-list"><li><p>Monday - Friday: <span class="time">8:00am - 4:00pm</span></p></li><li><p>Saturday: <span class="time">8:00am - 12:00pm</span></p></li><li><p>Sunday: <span class="time">8:00am - 10:00am</span></p></li></ul>'),
        'copyright_html' => sportshealing_get_field('sportshealing_copyright_html', $post_id, '&#169; Copyright 2025 SportsHealing All Rights Reserved'),
        'footer_phone_label' => sportshealing_get_field('sportshealing_footer_phone_label', $post_id, 'Have Any Question?'),
        'footer_email_label' => sportshealing_get_field('sportshealing_footer_email_label', $post_id, 'Send Email'),
        'footer_quick_title' => sportshealing_get_field('sportshealing_footer_quick_title', $post_id, 'Quick Links'),
        'footer_services_title' => sportshealing_get_field('sportshealing_footer_services_title', $post_id, 'Our Services'),
        'footer_opening_hours_title' => sportshealing_get_field('sportshealing_footer_opening_hours_title', $post_id, 'Opening Hours'),
        'footer_contact_title' => sportshealing_get_field('sportshealing_footer_contact_title', $post_id, 'Get In Touch'),
        'footer_newsletter_title' => sportshealing_get_field('sportshealing_footer_newsletter_title', $post_id, 'Newsletter'),
        'footer_newsletter_placeholder' => sportshealing_get_field('sportshealing_footer_newsletter_placeholder', $post_id, 'Your Email'),
        'footer_newsletter_button_label' => sportshealing_get_field('sportshealing_footer_newsletter_button_label', $post_id, 'Send'),
        'footer_payment_label' => sportshealing_get_field('sportshealing_footer_payment_label', $post_id, 'We Accept Payments'),
        'custom_html_before' => sportshealing_get_field('sportshealing_custom_html_before', $post_id),
        'custom_html_after' => sportshealing_get_field('sportshealing_custom_html_after', $post_id),
    ];
}

/**
 * Return image markup for a Customizer media setting.
 */
function sportshealing_customizer_image(int $attachment_id, string $class = 'custom-logo'): string {
    if (!$attachment_id) {
        return '';
    }

    if (get_post_mime_type($attachment_id) === 'image/svg+xml') {
        return sprintf(
            '<img src="%s" class="%s" alt="%s">',
            esc_url(wp_get_attachment_url($attachment_id)),
            esc_attr($class),
            esc_attr(get_bloginfo('name'))
        );
    }

    $image = wp_get_attachment_image($attachment_id, 'full', false, [
        'class' => $class,
        'alt' => get_bloginfo('name'),
    ]);

    return $image ?: '';
}

/**
 * Return the WordPress Site Identity logo markup.
 */
function sportshealing_site_logo(): string {
    return sportshealing_customizer_image((int) get_theme_mod('custom_logo'));
}

/**
 * Return the footer-specific Site Identity logo markup.
 */
function sportshealing_footer_logo(): string {
    $footer_logo = sportshealing_customizer_image((int) get_theme_mod('sportshealing_footer_logo'), 'sportshealing-footer-logo');

    return $footer_logo ?: sportshealing_site_logo();
}

/**
 * Render a WordPress menu only when the requested location is assigned.
 */
function sportshealing_render_menu(string $location, string $items_wrap = '<ul>%3$s</ul>', int $depth = 3, string $link_before = ''): void {
    if (!has_nav_menu($location)) {
        return;
    }

    wp_nav_menu([
        'theme_location' => $location,
        'container' => false,
        'fallback_cb' => false,
        'items_wrap' => $items_wrap,
        'depth' => $depth,
        'link_before' => $link_before,
    ]);
}

/**
 * Add Carenix dropdown icons to WordPress primary-menu parent links.
 */
function sportshealing_nav_menu_item_icon(string $item_output, WP_Post $item, int $depth, stdClass $args): string {
    if (isset($args->theme_location) && strpos((string) $args->theme_location, 'footer_') === 0) {
        return $item_output;
    }

    if (!in_array('menu-item-has-children', (array) $item->classes, true)) {
        return $item_output;
    }

    $icon_class = $depth === 0 ? 'fa-angle-down' : 'fa-chevron-right';
    $icon = ' <i class="fa-solid ' . esc_attr($icon_class) . '"></i>';

    return str_replace('</a>', $icon . '</a>', $item_output);
}
add_filter('walker_nav_menu_start_el', 'sportshealing_nav_menu_item_icon', 10, 4);

/**
 * Add Carenix submenu classes to WordPress primary-menu dropdowns.
 */
function sportshealing_nav_submenu_classes(array $classes, stdClass $args): array {
    if (isset($args->theme_location) && strpos((string) $args->theme_location, 'footer_') === 0) {
        return $classes;
    }

    $classes[] = 'submenu';

    return array_values(array_unique($classes));
}
add_filter('nav_menu_submenu_css_class', 'sportshealing_nav_submenu_classes', 10, 2);

/**
 * Add Carenix parent-item dropdown classes to WordPress primary-menu items.
 */
function sportshealing_nav_item_classes(array $classes, WP_Post $item, stdClass $args): array {
    if (isset($args->theme_location) && strpos((string) $args->theme_location, 'footer_') === 0) {
        return $classes;
    }

    if (in_array('menu-item-has-children', $classes, true)) {
        $classes[] = 'has-dropdown';
        $classes[] = 'dropdown';
    }

    return array_values(array_unique($classes));
}
add_filter('nav_menu_css_class', 'sportshealing_nav_item_classes', 10, 3);

/**
 * Render social-icon links from the current Header/Footer record.
 */
function sportshealing_social_icons(int $post_id): void {
    $links = [
        'instagram' => sportshealing_get_field('sportshealing_instagram_url', $post_id),
        'facebook-f' => sportshealing_get_field('sportshealing_facebook_url', $post_id),
        'x-twitter' => sportshealing_get_field('sportshealing_twitter_url', $post_id),
        'pinterest-p' => sportshealing_get_field('sportshealing_pinterest_url', $post_id),
    ];
    ?>
    <ul class="social-icon">
        <?php foreach ($links as $icon => $url) : ?>
            <?php if ($url) : ?>
                <li><a href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($icon); ?>"><i class="fa-brands fa-<?php echo esc_attr($icon); ?>"></i></a></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php
}

/**
 * Load the selected CMS-managed header variant for the current page.
 */
function sportshealing_render_header(): void {
    $context = sportshealing_theme_home_context();
    $post_id = sportshealing_find_layout_post('sh_header', $context);
    $variant = sportshealing_get_field('sportshealing_header_variant', $post_id, sportshealing_default_variant_for_context($context));
    $layout = sportshealing_layout_data($post_id, $variant, 'header');
    $path = sportshealing_layout_path('header', $variant);

    if (is_readable($path)) {
        require $path;
    }
}

/**
 * Load the selected CMS-managed footer variant for the current page.
 */
function sportshealing_render_footer(): void {
    $context = sportshealing_theme_home_context();
    $post_id = sportshealing_find_layout_post('sh_footer', $context);
    $variant = sportshealing_get_field('sportshealing_footer_variant', $post_id, sportshealing_default_variant_for_context($context));
    $layout = sportshealing_layout_data($post_id, $variant, 'footer');
    $path = sportshealing_layout_path('footer', $variant);

    if (is_readable($path)) {
        require $path;
    }
}
