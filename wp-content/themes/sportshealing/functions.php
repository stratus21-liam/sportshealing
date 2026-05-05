<?php
/**
 * SportsHealing theme setup.
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once get_template_directory() . '/inc/header-footer/loader.php';
require_once get_template_directory() . '/inc/header-footer/acf-fields.php';
require_once get_template_directory() . '/inc/template-helpers.php';
require_once get_template_directory() . '/inc/assets.php';
require_once get_template_directory() . '/inc/theme-colours.php';
require_once get_template_directory() . '/inc/seeders/helpers.php';
require_once get_template_directory() . '/inc/seeders/header-footer-seeder.php';
require_once get_template_directory() . '/inc/seeders/page-seeder.php';
require_once get_template_directory() . '/inc/seeders/page-template-fields-seeder.php';
require_once get_template_directory() . '/inc/seeders/blog-seeder.php';
require_once get_template_directory() . '/inc/seeders/services-seeder.php';
require_once get_template_directory() . '/inc/seeders/portfolio-seeder.php';
require_once get_template_directory() . '/inc/seeders/doctors-seeder.php';
require_once get_template_directory() . '/inc/seeders/detail-field-migration.php';
require_once get_template_directory() . '/inc/customizer/site-identity.php';
require_once get_template_directory() . '/inc/uploads/svg-uploads.php';
require_once get_template_directory() . '/inc/template-routing.php';

/**
 * Register theme support and navigation menu locations.
 */
function sportshealing_setup(): void {
    register_nav_menus([
        'primary' => __('Primary Menu', 'sportshealing'),
        'footer_quick' => __('Footer Quick Links', 'sportshealing'),
        'footer_services' => __('Footer Services Links', 'sportshealing'),
        'footer_legal' => __('Footer Legal Links', 'sportshealing'),
    ]);

    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('site-icon');
    add_theme_support('title-tag');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
}
add_action('after_setup_theme', 'sportshealing_setup');

/**
 * Ensure ACF WYSIWYG editors expose the heading formats needed by CMS content rows.
 */
function sportshealing_acf_wysiwyg_toolbars(array $toolbars): array {
    foreach (['Full', 'Basic'] as $toolbar_name) {
        if (isset($toolbars[$toolbar_name])) {
            $toolbars[$toolbar_name][1] = $toolbars[$toolbar_name][1] ?? [];

            if (!in_array('formatselect', $toolbars[$toolbar_name][1], true)) {
                array_unshift($toolbars[$toolbar_name][1], 'formatselect');
            }
        }
    }

    return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'sportshealing_acf_wysiwyg_toolbars');

/**
 * Limit the format dropdown to paragraph and H1-H3 for ACF editors.
 */
function sportshealing_tiny_mce_block_formats(array $settings): array {
    $settings['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3';

    return $settings;
}
add_filter('tiny_mce_before_init', 'sportshealing_tiny_mce_block_formats');

/**
 * Add a text-only option to default content text/media rows even before ACF JSON is synced.
 */
function sportshealing_default_content_row_media_type_field(array $field): array {
    $field['instructions'] = __('Choose None for a full-width text row. Choose Image to use the Image field. Choose Video to use the Video URL and Video Thumbnail fields.', 'sportshealing');
    $field['choices'] = array_merge([
        'none' => __('None', 'sportshealing'),
    ], $field['choices'] ?? []);

    return $field;
}
add_filter('acf/load_field/key=field_default_content_row_media_type', 'sportshealing_default_content_row_media_type_field');

/**
 * Build a URL to a bundled theme asset.
 */
function sportshealing_asset_url(string $path): string {
    return trailingslashit(get_template_directory_uri()) . ltrim($path, '/');
}

/**
 * Convert old static HTML links into live WordPress URLs.
 */
function sportshealing_static_url(string $file, string $fragment = ''): string {
    $map = [
        'index.html' => '',
        'index-2.html' => 'home-index-two',
        'index-3.html' => 'home-index-three',
        'about.html' => 'about',
        'appointment.html' => 'appointment',
        'blog.html' => 'blog',
        'blog-details.html' => 'blog-details',
        'contact.html' => 'contact',
        'doctor.html' => 'doctors',
        'doctor-details.html' => 'doctors',
        'error.html' => '404-error',
        'faq.html' => 'faq',
        'image-gallery.html' => 'image-gallery',
        'portfolio.html' => 'portfolio',
        'portfolio-details.html' => 'portfolio',
        'services.html' => 'services',
        'services-details.html' => 'services',
        'testimonials.html' => 'testimonials',
        'video-gallery.html' => 'video-gallery',
        'cart.html' => 'cart',
        'checkout.html' => 'checkout',
        'forget-password.html' => 'forget-password',
        'pricing.html' => 'pricing',
        'register.html' => 'register',
        'shop.html' => 'shop',
        'shop-details.html' => 'shop',
        'sign-in.html' => 'sign-in',
        'wishlist.html' => 'wishlist',
    ];

    $slug = $map[$file] ?? str_replace('.html', '', $file);

    if ($slug === '') {
        return home_url('/' . $fragment);
    }

    $page = get_page_by_path($slug);
    if ($page) {
        return get_permalink($page) . $fragment;
    }

    return home_url(trailingslashit($slug) . $fragment);
}

/**
 * Register public content types and private layout editor records.
 */
function sportshealing_register_content_types(): void {
    $types = [
        'sh_service' => [
            'singular' => __('Service', 'sportshealing'),
            'plural' => __('Services', 'sportshealing'),
            'slug' => 'services',
            'menu_icon' => 'dashicons-heart',
        ],
        'sh_portfolio' => [
            'singular' => __('Portfolio Item', 'sportshealing'),
            'plural' => __('Portfolio', 'sportshealing'),
            'slug' => 'portfolio',
            'menu_icon' => 'dashicons-portfolio',
        ],
        'sh_doctor' => [
            'singular' => __('Doctor', 'sportshealing'),
            'plural' => __('Doctors', 'sportshealing'),
            'slug' => 'doctors',
            'menu_icon' => 'dashicons-businessperson',
        ],
        'sh_header' => [
            'singular' => __('Header', 'sportshealing'),
            'plural' => __('Headers', 'sportshealing'),
            'slug' => 'sportshealing-headers',
            'menu_icon' => 'dashicons-editor-kitchensink',
        ],
        'sh_footer' => [
            'singular' => __('Footer', 'sportshealing'),
            'plural' => __('Footers', 'sportshealing'),
            'slug' => 'sportshealing-footers',
            'menu_icon' => 'dashicons-align-wide',
        ],
        'sh_theme_colour' => [
            'singular' => __('Theme Colour', 'sportshealing'),
            'plural' => __('Theme Colours', 'sportshealing'),
            'slug' => 'sportshealing-theme-colours',
            'menu_icon' => 'dashicons-art',
        ],
    ];

    foreach ($types as $post_type => $config) {
        $is_layout = in_array($post_type, ['sh_header', 'sh_footer', 'sh_theme_colour'], true);

        register_post_type($post_type, [
            'labels' => [
                'name' => $config['plural'],
                'singular_name' => $config['singular'],
                'add_new_item' => sprintf(__('Add New %s', 'sportshealing'), $config['singular']),
                'edit_item' => sprintf(__('Edit %s', 'sportshealing'), $config['singular']),
                'new_item' => sprintf(__('New %s', 'sportshealing'), $config['singular']),
                'view_item' => sprintf(__('View %s', 'sportshealing'), $config['singular']),
                'search_items' => sprintf(__('Search %s', 'sportshealing'), $config['plural']),
            ],
            'public' => !$is_layout,
            'publicly_queryable' => !$is_layout,
            'exclude_from_search' => $is_layout,
            'show_ui' => true,
            'show_in_menu' => true,
            'has_archive' => false,
            'hierarchical' => false,
            'menu_icon' => $config['menu_icon'],
            'rewrite' => $is_layout ? false : [
                'slug' => $config['slug'],
                'with_front' => false,
            ],
            'show_in_rest' => true,
            'supports' => $is_layout ? ['title'] : ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        ]);
    }
}
add_action('init', 'sportshealing_register_content_types');

/**
 * Include public SportsHealing content in the frontend search results.
 */
function sportshealing_search_query(WP_Query $query): void {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }

    $query->set('post_type', ['post', 'page', 'sh_service', 'sh_portfolio', 'sh_doctor']);
    $query->set('posts_per_page', 9);
}
add_action('pre_get_posts', 'sportshealing_search_query');

/**
 * Register taxonomies used by SportsHealing content types.
 */
function sportshealing_register_taxonomies(): void {
    register_taxonomy('sh_service_category', ['sh_service'], [
        'labels' => [
            'name' => __('Service Categories', 'sportshealing'),
            'singular_name' => __('Service Category', 'sportshealing'),
        ],
        'public' => true,
        'hierarchical' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'service-category',
            'with_front' => false,
        ],
    ]);
}
add_action('init', 'sportshealing_register_taxonomies');

/**
 * Service listing pages should be assigned to top-level service category branches.
 */
function sportshealing_service_listing_parent_category_query(array $args, array $field, int $post_id): array {
    $args['parent'] = 0;

    return $args;
}
add_filter('acf/fields/taxonomy/query/name=sportshealing_service_listing_parent_category', 'sportshealing_service_listing_parent_category_query', 10, 3);

/**
 * Return the first Services page assigned to a parent service category.
 */
function sportshealing_service_parent_category_page_url(WP_Term $term): string {
    $pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'meta_key' => 'sportshealing_service_listing_parent_category',
        'meta_value' => (string) $term->term_id,
    ]);

    if ($pages) {
        return get_permalink((int) $pages[0]);
    }

    return sportshealing_service_category_filter_url($term);
}

/**
 * Return the CMS Services page URL filtered by a service category.
 */
function sportshealing_service_category_filter_url(WP_Term $term, int $page_id = 0): string {
    $base_url = $page_id ? get_permalink($page_id) : sportshealing_listing_page_url('services');

    return add_query_arg('service-category', $term->slug, $base_url);
}

/**
 * Send service category links to the Services CMS page filter.
 */
function sportshealing_service_category_link(string $termlink, WP_Term $term, string $taxonomy): string {
    if ($taxonomy !== 'sh_service_category') {
        return $termlink;
    }

    return sportshealing_service_category_filter_url($term);
}
add_filter('term_link', 'sportshealing_service_category_link', 10, 3);

/**
 * Flush rewrite rules and create starter content after theme activation.
 */
function sportshealing_rewrite_flush(): void {
    sportshealing_register_content_types();
    sportshealing_register_taxonomies();
    sportshealing_seed_layout_posts();
    sportshealing_seed_pages();
    sportshealing_seed_blog_posts();
    sportshealing_seed_services();
    sportshealing_seed_portfolio();
    sportshealing_seed_doctors();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'sportshealing_rewrite_flush');

/**
 * Flush rewrite rules once for existing installs after content routes change.
 */
function sportshealing_maybe_flush_content_rewrites(): void {
    if (get_option('sportshealing_content_routes_flushed_v2')) {
        return;
    }

    sportshealing_register_content_types();
    sportshealing_register_taxonomies();
    flush_rewrite_rules();
    update_option('sportshealing_content_routes_flushed_v2', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_flush_content_rewrites', 20);
