<?php
/**
 * One-time setup for ACF page template field defaults.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return every page template field group loaded from local ACF JSON.
 */
function sportshealing_seed_page_template_groups(): array {
    $groups = [];

    foreach (glob(get_template_directory() . '/acf-json/group_sportshealing_template_*.json') as $file) {
        $group = json_decode((string) file_get_contents($file), true);

        if (is_array($group)) {
            $groups[] = $group;
        }
    }

    return $groups;
}

/**
 * Resolve how many repeater rows a section partial currently consumes.
 */
function sportshealing_seed_section_item_counts(): array {
    $counts = [];

    foreach (glob(get_template_directory() . '/*-template.php') as $template_file) {
        $template = (string) file_get_contents($template_file);

        preg_match_all("/sportshealing_render_template_part\\('([^']+)',\\s*'([^']+)'\\)/", $template, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $partial = get_template_directory() . '/templates-parts/' . $match[1];

            if (!is_readable($partial)) {
                continue;
            }

            $html = (string) file_get_contents($partial);
            preg_match_all('/sportshealing_acf_section_item_(?:value|image_url|url)\\((\\d+)/', $html, $item_matches);

            if (!empty($item_matches[1])) {
                $counts[$match[2]] = max(array_map('intval', $item_matches[1])) + 1;
            }
        }
    }

    return $counts;
}

/**
 * Build one lorem ipsum repeater row from an ACF repeater field definition.
 */
function sportshealing_seed_repeater_row(array $field): array {
    $row = [];

    foreach (($field['sub_fields'] ?? []) as $sub_field) {
        $name = $sub_field['name'] ?? '';

        if (!$name) {
            continue;
        }

        $row[$name] = $sub_field['default_value'] ?? '';
    }

    return $row;
}

/**
 * Return the default value that should be saved for one ACF field.
 */
function sportshealing_seed_field_default(array $field, array $item_counts) {
    $type = $field['type'] ?? '';
    $name = $field['name'] ?? '';

    if ($type === 'true_false') {
        return array_key_exists('default_value', $field) ? (bool) $field['default_value'] : true;
    }

    if ($type === 'repeater') {
        $prefix = preg_replace('/_items$/', '', $name);
        $row_count = max(1, $item_counts[$prefix] ?? 3);
        $row = sportshealing_seed_repeater_row($field);

        return array_fill(0, $row_count, $row);
    }

    return $field['default_value'] ?? '';
}

/**
 * Seed missing ACF defaults into existing CMS pages assigned to root templates.
 */
function sportshealing_seed_page_template_fields(): void {
    if (get_option('sportshealing_page_template_fields_seeded')) {
        return;
    }

    $item_counts = sportshealing_seed_section_item_counts();

    foreach (sportshealing_seed_page_template_groups() as $group) {
        $template = $group['location'][0][0]['value'] ?? '';

        if (!$template) {
            continue;
        }

        $pages = get_posts([
            'post_type' => 'page',
            'post_status' => 'any',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'meta_key' => '_wp_page_template',
            'meta_value' => $template,
        ]);

        foreach ($pages as $page_id) {
            foreach (($group['fields'] ?? []) as $field) {
                $name = $field['name'] ?? '';

                if (!$name || metadata_exists('post', (int) $page_id, $name)) {
                    continue;
                }

                sportshealing_seed_acf_value((int) $page_id, $name, sportshealing_seed_field_default($field, $item_counts));
            }
        }
    }

    update_option('sportshealing_page_template_fields_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_seed_page_template_fields', 35);

/**
 * Build seeded pricing groups for homepage pricing sections.
 */
function sportshealing_seed_pricing_groups(string $price_suffix, bool $include_promo = false, bool $include_colour = false): array {
    $plans = [
        ['Basic Plan', '$30', false],
        ['Standard Plan', '$70', true],
        ['Premium Plan', '$90', false],
    ];

    if ($price_suffix === '/Yearly') {
        $plans = [
            ['Basic Plan', '$310', false],
            ['Standard Plan', '$790', true],
            ['Premium Plan', '$1030', false],
        ];
    }

    $items = [];

    foreach ($plans as $index => [$label, $price, $highlighted]) {
        $item = [
            'label' => $label,
            'price' => $price,
            'price_suffix' => $price_suffix,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'feature_intro' => 'What is included?',
            'features' => "Routine Checkups\nMedical Specialist\nNutritional Guidance\nProfessional Consultation\nOnline Booking\nEmergency Care",
            'button_label' => 'Choose Plan',
            'button_url' => sportshealing_static_url('pricing.html', ''),
            'highlighted' => $highlighted,
        ];

        if ($include_colour) {
            $item['colour_class'] = ['pricing-one', 'pricing-two', 'pricing-three'][$index] ?? 'pricing-one';
        }

        if ($include_promo && $index === 0) {
            $item['card_type'] = 'promo';
            $item['promo_label'] = 'Save More';
            $item['promo_heading'] = $price_suffix === '/Yearly' ? 'Save More With Yearly Care' : 'Save More With Monthly Care';
            $item['image'] = '';
        } elseif ($include_promo) {
            $item['card_type'] = 'plan';
            $item['promo_label'] = '';
            $item['promo_heading'] = '';
            $item['image'] = '';
        }

        $items[] = $item;
    }

    return $items;
}

/**
 * Seed the pricing group repeater added after the generic template seeder existed.
 */
function sportshealing_backfill_homepage_pricing_groups(): void {
    if (get_option('sportshealing_homepage_pricing_groups_seeded')) {
        return;
    }

    $homepages = [
        [
            'slug' => 'home',
            'field' => 'sportshealing_homepage_1_pricing_groups',
            'include_promo' => false,
            'include_colour' => false,
        ],
        [
            'slug' => 'home-index-two',
            'field' => 'sportshealing_homepage_2_pricing_groups',
            'include_promo' => false,
            'include_colour' => true,
        ],
        [
            'slug' => 'home-index-three',
            'field' => 'sportshealing_homepage_3_pricing_groups',
            'include_promo' => true,
            'include_colour' => false,
        ],
    ];

    foreach ($homepages as $homepage) {
        $page = sportshealing_seed_find_post('page', $homepage['slug']);

        if (!$page) {
            continue;
        }

        sportshealing_seed_acf_value((int) $page->ID, $homepage['field'], [
            [
                'group_name' => 'Monthly',
                'items' => sportshealing_seed_pricing_groups('/Monthly', (bool) $homepage['include_promo'], (bool) $homepage['include_colour']),
            ],
            [
                'group_name' => 'Yearly',
                'items' => sportshealing_seed_pricing_groups('/Yearly', (bool) $homepage['include_promo'], (bool) $homepage['include_colour']),
            ],
        ]);
    }

    update_option('sportshealing_homepage_pricing_groups_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_homepage_pricing_groups', 45);

/**
 * Build seeded service rows that match each homepage service layout.
 */
function sportshealing_seed_homepage_services_rows(int $homepage): array {
    $services = [
        'Sports Medicine',
        'Knee Treatments',
        'Hip Treatments',
        'Rehabilitation',
        'Joint Injections',
        'Physiotherapy',
    ];

    $rows = [];

    foreach ($services as $index => $title) {
        $row = [
            'title' => $title,
            'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'url' => sportshealing_static_url('services-details.html', ''),
        ];

        if ($homepage === 1) {
            $row['image'] = '';
            $row['button_label'] = 'More Details';
        } elseif ($homepage === 2) {
            $row['icon_image'] = '';
            $row['image'] = '';
        } else {
            $row['icon_image'] = '';
            $row['image'] = '';
            $row['active'] = $index === 0;
            $row['button_label'] = 'More Details';
        }

        $rows[] = $row;
    }

    return $rows;
}

/**
 * Add newer per-card service fields to already-seeded homepage repeater rows.
 */
function sportshealing_backfill_homepage_services_rows(): void {
    if (get_option('sportshealing_homepage_services_rows_seeded')) {
        return;
    }

    $homepages = [
        1 => [
            'slug' => 'home',
            'field' => 'sportshealing_homepage_1_services_items',
            'button_label' => '',
            'button_url' => '',
        ],
        2 => [
            'slug' => 'home-index-two',
            'field' => 'sportshealing_homepage_2_services_items',
            'button_label' => 'sportshealing_homepage_2_services_button_label',
            'button_url' => 'sportshealing_homepage_2_services_button_url',
        ],
        3 => [
            'slug' => 'home-index-three',
            'field' => 'sportshealing_homepage_3_services_items',
            'button_label' => 'sportshealing_homepage_3_services_button_label',
            'button_url' => 'sportshealing_homepage_3_services_button_url',
        ],
    ];

    foreach ($homepages as $homepage => $config) {
        $page = sportshealing_seed_find_post('page', $config['slug']);

        if (!$page) {
            continue;
        }

        $field = $config['field'];
        $seed_rows = sportshealing_seed_homepage_services_rows((int) $homepage);
        $current_rows = function_exists('get_field') ? get_field($field, $page->ID) : get_post_meta($page->ID, $field, true);
        $current_rows = is_array($current_rows) && $current_rows ? $current_rows : [];

        foreach ($seed_rows as $index => $seed_row) {
            $current_row = isset($current_rows[$index]) && is_array($current_rows[$index]) ? $current_rows[$index] : [];
            $current_rows[$index] = array_merge($seed_row, array_filter($current_row, static function ($value) {
                return $value !== null && $value !== '' && $value !== false;
            }));
        }

        sportshealing_seed_acf_value((int) $page->ID, $field, $current_rows ?: $seed_rows);

        if ($config['button_label']) {
            sportshealing_seed_acf_value((int) $page->ID, $config['button_label'], $homepage === 2 ? 'Browse All Services' : 'View All Services');
        }

        if ($config['button_url']) {
            sportshealing_seed_acf_value((int) $page->ID, $config['button_url'], sportshealing_static_url('services.html', ''));
        }
    }

    update_option('sportshealing_homepage_services_rows_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_homepage_services_rows', 46);

/**
 * Backfill optional background colours for the Homepage 1 micon cards.
 */
function sportshealing_backfill_homepage_1_micon_colours(): void {
    if (get_option('sportshealing_homepage_1_micon_colours_seeded')) {
        return;
    }

    $page = sportshealing_seed_find_post('page', 'home');

    if (!$page) {
        return;
    }

    $field = 'sportshealing_homepage_1_micon_items';
    $colours = ['#fff5f5', '#dffaff', '#fffaeb'];
    $items = function_exists('get_field') ? get_field($field, $page->ID) : get_post_meta($page->ID, $field, true);
    $items = is_array($items) && $items ? $items : array_fill(0, 3, []);

    foreach ($colours as $index => $colour) {
        $items[$index] = isset($items[$index]) && is_array($items[$index]) ? $items[$index] : [];
        $items[$index]['background_colour'] = $items[$index]['background_colour'] ?? $colour;
    }

    sportshealing_seed_acf_value((int) $page->ID, $field, $items);
    update_option('sportshealing_homepage_1_micon_colours_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_homepage_1_micon_colours', 47);

/**
 * Return seeded post IDs for a content type.
 */
function sportshealing_seed_post_ids(string $post_type, int $limit = 6): array {
    return get_posts([
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'fields' => 'ids',
        'orderby' => 'date',
        'order' => 'ASC',
    ]);
}

/**
 * Return a seeded page ID by slug.
 */
function sportshealing_seed_page_id(string $slug): int {
    $page = sportshealing_seed_find_post('page', $slug);

    return $page ? (int) $page->ID : 0;
}

/**
 * Backfill structured section data added after the initial generic item model.
 */
function sportshealing_backfill_structured_template_fields(): void {
    if (get_option('sportshealing_structured_template_fields_seeded')) {
        return;
    }

    if (function_exists('sportshealing_seed_blog_posts')) {
        sportshealing_seed_blog_posts();
    }

    if (function_exists('sportshealing_seed_services')) {
        sportshealing_seed_services();
    }

    if (function_exists('sportshealing_seed_portfolio')) {
        sportshealing_seed_portfolio();
    }

    if (function_exists('sportshealing_seed_doctors')) {
        sportshealing_seed_doctors();
    }

    $page_ids = [
        'home' => sportshealing_seed_page_id('home'),
        'home_2' => sportshealing_seed_page_id('home-index-two'),
        'home_3' => sportshealing_seed_page_id('home-index-three'),
        'about' => sportshealing_seed_page_id('about'),
        'appointment' => sportshealing_seed_page_id('appointment'),
        'contact' => sportshealing_seed_page_id('contact'),
    ];

    $service_ids = sportshealing_seed_post_ids('sh_service', 6);
    $portfolio_ids = sportshealing_seed_post_ids('sh_portfolio', 6);
    $doctor_ids = sportshealing_seed_post_ids('sh_doctor', 5);
    $blog_ids = sportshealing_seed_post_ids('post', 4);

    $about_page = sportshealing_seed_page_id('about');
    $appointment_page = sportshealing_seed_page_id('appointment');
    $services_page = sportshealing_seed_page_id('services');
    $portfolio_page = sportshealing_seed_page_id('portfolio');
    $doctors_page = sportshealing_seed_page_id('doctors');
    $contact_page = sportshealing_seed_page_id('contact');

    if ($page_ids['home']) {
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_hero_primary_button_page', $appointment_page);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_hero_secondary_button_page', $services_page);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_services_posts', array_slice($service_ids, 0, 6));
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_why_choose_items', [
            ['image' => 'assets/images/joint-icon-29.png', 'title' => 'Expert Care', 'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
            ['image' => 'assets/images/joint-icon-29.png', 'title' => 'Focused Recovery', 'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
        ]);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_why_choose_checklist_items', [
            ['text' => 'Strategic care planning'],
            ['text' => 'Highly skilled medical team'],
        ]);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_why_choose_circle_page', $about_page);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_product_items', sportshealing_seed_homepage_product_rows());
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_portfolio_posts', array_slice($portfolio_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_portfolio_button_page', $portfolio_page);
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_doctor_posts', array_slice($doctor_ids, 0, 5));
        sportshealing_seed_acf_value($page_ids['home'], 'sportshealing_homepage_1_blog_posts', array_slice($blog_ids, 0, 3));
    }

    if ($page_ids['home_2']) {
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_hero_primary_button_page', $appointment_page);
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_hero_secondary_button_page', $services_page);
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_hero_round_button_page', $contact_page);
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_services_posts', array_slice($service_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_services_button_page', $services_page);
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_results_before_image', 'assets/images/results/transformation-img-1.jpg');
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_results_after_image', 'assets/images/results/transformation-img-2.jpg');
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_appointment_items', sportshealing_seed_process_rows('assets/images/joint-icon-29.png', 3));
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_appointment_form_eyebrow', 'Appointment');
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_appointment_form_title', 'Book Appointment');
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_portfolio_posts', array_slice($portfolio_ids, 0, 6));
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_doctor_posts', array_slice($doctor_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_faq_video_url', 'https://www.youtube.com/watch?v=Y-x0efG1seA');
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_blog_posts', array_slice($blog_ids, 0, 3));
        sportshealing_seed_acf_value($page_ids['home_2'], 'sportshealing_homepage_2_instagram_items', sportshealing_seed_instagram_rows());
    }

    if ($page_ids['home_3']) {
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_hero_primary_button_page', $contact_page);
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_hero_secondary_button_page', $doctors_page);
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_hero_slides', [
            ['eyebrow' => 'Lorem Ipsum', 'title' => 'Lorem Ipsum Dolor Sit Amet', 'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'image' => 'assets/images/hero/hero-3-2.png'],
        ]);
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_counter_items', sportshealing_seed_counter_rows());
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_video_button_page', $about_page);
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_video_video_url', 'https://www.youtube.com/watch?v=Y-x0efG1seA');
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_services_posts', array_slice($service_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_services_button_page', $services_page);
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_why_choose_tabs', sportshealing_seed_why_choose_tabs());
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_how_it_work_items', sportshealing_seed_process_rows('assets/images/joint-icon-29.png', 3));
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_doctor_posts', array_slice($doctor_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['home_3'], 'sportshealing_homepage_3_blog_posts', array_slice($blog_ids, 0, 2));
    }

    if ($page_ids['about']) {
        sportshealing_seed_acf_value($page_ids['about'], 'sportshealing_about_about_paragraphs', [
            ['copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
            ['copy' => 'Integer posuere erat a ante venenatis dapibus posuere velit aliquet.'],
        ]);
        sportshealing_seed_acf_value($page_ids['about'], 'sportshealing_about_about_items', [
            ['image' => 'assets/images/joint-icon-29.png', 'title' => 'Lorem Ipsum', 'copy' => 'Lorem ipsum dolor sit amet.'],
            ['image' => 'assets/images/joint-icon-29.png', 'title' => 'Lorem Ipsum', 'copy' => 'Lorem ipsum dolor sit amet.'],
        ]);
        sportshealing_seed_acf_value($page_ids['about'], 'sportshealing_about_doctor_posts', array_slice($doctor_ids, 0, 4));
        sportshealing_seed_acf_value($page_ids['about'], 'sportshealing_about_counter_items', sportshealing_seed_counter_rows());
    }

    if ($page_ids['appointment']) {
        sportshealing_seed_acf_value($page_ids['appointment'], 'sportshealing_appointment_appointment_shape_1', 'assets/images/shape/shape-1.png');
        sportshealing_seed_acf_value($page_ids['appointment'], 'sportshealing_appointment_appointment_large_image', 'assets/images/appointment/appointment-4-1.jpg');
        sportshealing_seed_acf_value($page_ids['appointment'], 'sportshealing_appointment_appointment_small_image', 'assets/images/appointment/appointment-4-2.jpg');
    }

    if ($page_ids['contact']) {
        sportshealing_seed_acf_value($page_ids['contact'], 'sportshealing_contact_contact_form_form_title', 'Get In Touch');
    }

    update_option('sportshealing_structured_template_fields_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_structured_template_fields', 80);

/**
 * Seed generic process rows with clear image/title/copy keys.
 */
function sportshealing_seed_process_rows(string $image_prefix, int $count): array {
    $rows = [];

    for ($index = 1; $index <= $count; $index++) {
        $rows[] = [
            'image' => preg_match('/\.(png|jpe?g|svg|webp)$/i', $image_prefix) ? $image_prefix : $image_prefix . $index . '.png',
            'title' => 'Lorem Ipsum',
            'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ];
    }

    return $rows;
}

/**
 * Seed counter rows with number and label fields.
 */
function sportshealing_seed_counter_rows(): array {
    return [
        ['value' => '90', 'suffix' => '+', 'title' => 'Lorem Ipsum'],
        ['value' => '26', 'suffix' => '+', 'title' => 'Lorem Ipsum'],
        ['value' => '35', 'suffix' => '+', 'title' => 'Lorem Ipsum'],
        ['value' => '10', 'suffix' => '+', 'title' => 'Lorem Ipsum'],
    ];
}

/**
 * Seed homepage product rows with one row per product card.
 */
function sportshealing_seed_homepage_product_rows(): array {
    $badges = ['sale.png', 'bestseller.png', 'sale.png', 'bestseller.png'];
    $rows = [];

    for ($index = 1; $index <= 4; $index++) {
        $rows[] = [
            'title' => 'Lorem Ipsum Product',
            'image' => 'assets/images/product/product-' . $index . '.png',
            'badge_image' => 'assets/images/product/' . $badges[$index - 1],
            'badge_label' => $index % 2 ? 'Sale' : 'Bestseller',
            'price' => '$120.00',
            'rating' => '4.9 (25)',
            'url' => sportshealing_static_url('shop.html', ''),
            'cart_url' => sportshealing_static_url('cart.html', ''),
            'wishlist_url' => sportshealing_static_url('wishlist.html', ''),
        ];
    }

    return $rows;
}

/**
 * Seed homepage Instagram image rows.
 */
function sportshealing_seed_instagram_rows(): array {
    $rows = [];

    for ($index = 1; $index <= 6; $index++) {
        $rows[] = [
            'title' => 'Instagram Image ' . $index,
            'image' => 'assets/images/instagram/instagram-' . $index . '.jpg',
            'url' => '',
        ];
    }

    return $rows;
}

/**
 * Seed Homepage 3 why choose tab rows.
 */
function sportshealing_seed_why_choose_tabs(): array {
    return [
        [
            'tab_title' => 'Our Emergency Case',
            'icon' => 'assets/images/joint-icon-29.png',
            'title' => 'Lorem Ipsum Dolor Sit Amet',
            'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'image' => 'assets/images/why-choose/why-choose-img-2-1.jpg',
            'details' => [
                ['title' => 'Lorem Ipsum', 'copy' => 'Lorem ipsum dolor sit amet.'],
                ['title' => 'Lorem Ipsum', 'copy' => 'Lorem ipsum dolor sit amet.'],
            ],
            'stats' => [],
            'lines' => '',
        ],
        [
            'tab_title' => 'Professional Skills',
            'icon' => 'assets/images/joint-icon-29.png',
            'title' => 'Lorem Ipsum Dolor Sit Amet',
            'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'image' => 'assets/images/joint-icon-29.png',
            'details' => [],
            'stats' => [
                ['label' => 'Empathy', 'percent' => '95%'],
                ['label' => 'Technique', 'percent' => '85%'],
                ['label' => 'Operation', 'percent' => '92%'],
            ],
            'lines' => '',
        ],
        [
            'tab_title' => 'Opening Hours',
            'icon' => 'assets/images/joint-icon-29.png',
            'title' => 'Lorem Ipsum Dolor Sit Amet',
            'copy' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'image' => 'assets/images/joint-icon-29.png',
            'details' => [],
            'stats' => [],
            'lines' => "Monday - Friday: 8:00 - 18:00\nSaturday: 9:00 - 14:00\nSunday: Closed",
        ],
    ];
}
