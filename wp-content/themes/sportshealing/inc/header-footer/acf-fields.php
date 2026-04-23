<?php
/**
 * ACF field groups for SportsHealing layout records.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Build the shared ACF contact fields for Header/Footer records.
 */
function sportshealing_acf_common_contact_fields(string $prefix): array {
    return [
        [
            'key' => "field_{$prefix}_address",
            'label' => __('Address', 'sportshealing'),
            'name' => 'sportshealing_address',
            'type' => 'text',
            'default_value' => '123 Serenity Lane, Suite 101, Hometown, CA 12345',
        ],
        [
            'key' => "field_{$prefix}_email",
            'label' => __('Email', 'sportshealing'),
            'name' => 'sportshealing_email',
            'type' => 'email',
            'default_value' => 'info@example.com',
        ],
        [
            'key' => "field_{$prefix}_phone",
            'label' => __('Phone', 'sportshealing'),
            'name' => 'sportshealing_phone',
            'type' => 'text',
            'default_value' => '+1 234 467 88',
        ],
        [
            'key' => "field_{$prefix}_hours",
            'label' => __('Opening Hours Summary', 'sportshealing'),
            'name' => 'sportshealing_hours',
            'type' => 'text',
            'default_value' => 'Mon - Fri 8:00 - 6:30',
        ],
    ];
}

/**
 * Build the shared ACF social URL fields for Header/Footer records.
 */
function sportshealing_acf_social_fields(string $prefix): array {
    return [
        [
            'key' => "field_{$prefix}_instagram_url",
            'label' => __('Instagram URL', 'sportshealing'),
            'name' => 'sportshealing_instagram_url',
            'type' => 'url',
            'default_value' => '#',
        ],
        [
            'key' => "field_{$prefix}_facebook_url",
            'label' => __('Facebook URL', 'sportshealing'),
            'name' => 'sportshealing_facebook_url',
            'type' => 'url',
            'default_value' => '#',
        ],
        [
            'key' => "field_{$prefix}_twitter_url",
            'label' => __('X/Twitter URL', 'sportshealing'),
            'name' => 'sportshealing_twitter_url',
            'type' => 'url',
            'default_value' => '#',
        ],
        [
            'key' => "field_{$prefix}_pinterest_url",
            'label' => __('Pinterest URL', 'sportshealing'),
            'name' => 'sportshealing_pinterest_url',
            'type' => 'url',
            'default_value' => '#',
        ],
    ];
}

/**
 * Register local ACF groups for CMS-managed Header/Footer records.
 */
function sportshealing_register_acf_layout_fields(): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_sportshealing_header_layout',
        'title' => __('Header Layout Controls', 'sportshealing'),
        'fields' => array_merge([
            [
                'key' => 'field_sportshealing_header_variant',
                'label' => __('Header HTML Variant', 'sportshealing'),
                'name' => 'sportshealing_header_variant',
                'type' => 'select',
                'instructions' => __('Choose which built-in header HTML layout this Header record should use. This controls the frontend markup/design only: Header 1, Header 2, or Header 3. After saving this Header, assign it to the site in Appearance > Customize > Header/Footer Layouts by selecting it as the active header and publishing the customizer changes.', 'sportshealing'),
                'choices' => [
                    'one' => __('Header 1', 'sportshealing'),
                    'two' => __('Header 2', 'sportshealing'),
                    'three' => __('Header 3', 'sportshealing'),
                ],
                'default_value' => 'one',
                'return_format' => 'value',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_top_bar',
                'label' => __('Hide Top Bar', 'sportshealing'),
                'name' => 'sportshealing_hide_top_bar',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_search',
                'label' => __('Hide Search', 'sportshealing'),
                'name' => 'sportshealing_hide_search',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_cart',
                'label' => __('Hide Cart', 'sportshealing'),
                'name' => 'sportshealing_hide_cart',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_login',
                'label' => __('Hide Login/Register', 'sportshealing'),
                'name' => 'sportshealing_hide_login',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_social',
                'label' => __('Hide Social Icons', 'sportshealing'),
                'name' => 'sportshealing_hide_social',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_call',
                'label' => __('Hide Emergency Call Block', 'sportshealing'),
                'name' => 'sportshealing_hide_call',
                'type' => 'true_false',
                'ui' => 1,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_sportshealing_header_variant',
                            'operator' => '==',
                            'value' => 'three',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_sportshealing_hide_cta_button',
                'label' => __('Hide Header Button', 'sportshealing'),
                'name' => 'sportshealing_hide_cta_button',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_offcanvas',
                'label' => __('Hide Offcanvas Sidebar', 'sportshealing'),
                'name' => 'sportshealing_hide_offcanvas',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_offcanvas_intro',
                'label' => __('Hide Offcanvas Intro HTML', 'sportshealing'),
                'name' => 'sportshealing_hide_offcanvas_intro',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_offcanvas_contact',
                'label' => __('Hide Offcanvas Contact HTML', 'sportshealing'),
                'name' => 'sportshealing_hide_offcanvas_contact',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_cta_label',
                'label' => __('Header Button Label', 'sportshealing'),
                'name' => 'sportshealing_cta_label',
                'type' => 'text',
                'default_value' => 'Book Appointment',
            ],
            [
                'key' => 'field_sportshealing_header_button_page',
                'label' => __('Header Button Page', 'sportshealing'),
                'name' => 'sportshealing_header_button_page',
                'type' => 'post_object',
                'instructions' => __('Choose the page the header button should link to. If blank, it falls back to the Appointment page.', 'sportshealing'),
                'post_type' => ['page'],
                'return_format' => 'id',
                'ui' => 1,
                'allow_null' => 1,
            ],
            [
                'key' => 'field_sportshealing_coupon_text',
                'label' => __('Header 3 Coupon Text', 'sportshealing'),
                'name' => 'sportshealing_coupon_text',
                'type' => 'text',
                'default_value' => 'Use Coupon Code LDW20 for 20% off.',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_sportshealing_header_variant',
                            'operator' => '==',
                            'value' => 'three',
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_sportshealing_offcanvas_intro',
                'label' => __('Offcanvas Intro HTML', 'sportshealing'),
                'name' => 'sportshealing_offcanvas_intro',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'default_value' => 'There are many variations of passages available sure there majority have suffered alteration in some form by inject humour or randomised words which don\'t look even slightly believable.',
            ],
        ], sportshealing_acf_common_contact_fields('header'), sportshealing_acf_social_fields('header'), [
            [
                'key' => 'field_sportshealing_header_custom_html_before',
                'label' => __('Custom HTML Before Header', 'sportshealing'),
                'name' => 'sportshealing_custom_html_before',
                'type' => 'textarea',
                'new_lines' => '',
            ],
            [
                'key' => 'field_sportshealing_header_custom_html_after',
                'label' => __('Custom HTML After Header', 'sportshealing'),
                'name' => 'sportshealing_custom_html_after',
                'type' => 'textarea',
                'new_lines' => '',
            ],
        ]),
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'sh_header',
                ],
            ],
        ],
    ]);

    acf_add_local_field_group([
        'key' => 'group_sportshealing_footer_layout',
        'title' => __('Footer Layout Controls', 'sportshealing'),
        'fields' => array_merge([
            [
                'key' => 'field_sportshealing_footer_variant',
                'label' => __('Footer HTML Variant', 'sportshealing'),
                'name' => 'sportshealing_footer_variant',
                'type' => 'select',
                'choices' => [
                    'one' => __('Footer 1', 'sportshealing'),
                    'two' => __('Footer 2', 'sportshealing'),
                    'three' => __('Footer 3', 'sportshealing'),
                ],
                'default_value' => 'one',
                'return_format' => 'value',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_footer_top',
                'label' => __('Hide Footer Top Area', 'sportshealing'),
                'name' => 'sportshealing_hide_footer_top',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_about_widget',
                'label' => __('Hide About Widget', 'sportshealing'),
                'name' => 'sportshealing_hide_about_widget',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_quick_links',
                'label' => __('Hide Quick Links Menu', 'sportshealing'),
                'name' => 'sportshealing_hide_quick_links',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_services_links',
                'label' => __('Hide Services Menu', 'sportshealing'),
                'name' => 'sportshealing_hide_services_links',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_opening_hours',
                'label' => __('Hide Opening Hours Widget', 'sportshealing'),
                'name' => 'sportshealing_hide_opening_hours',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_contact_widget',
                'label' => __('Hide Contact Widget', 'sportshealing'),
                'name' => 'sportshealing_hide_contact_widget',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_footer_hide_social',
                'label' => __('Hide Social Icons', 'sportshealing'),
                'name' => 'sportshealing_hide_social',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_newsletter',
                'label' => __('Hide Newsletter Form', 'sportshealing'),
                'name' => 'sportshealing_hide_newsletter',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_footer_hide_cta_button',
                'label' => __('Hide Header Button', 'sportshealing'),
                'name' => 'sportshealing_hide_cta_button',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_legal_menu',
                'label' => __('Hide Legal Menu', 'sportshealing'),
                'name' => 'sportshealing_hide_legal_menu',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_hide_payment',
                'label' => __('Hide Payment Artwork', 'sportshealing'),
                'name' => 'sportshealing_hide_payment',
                'type' => 'true_false',
                'ui' => 1,
            ],
            [
                'key' => 'field_sportshealing_footer_about_html',
                'label' => __('About Widget HTML', 'sportshealing'),
                'name' => 'sportshealing_footer_about_html',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor asin cididunt ut labore et dolore magna ali qua. Lorem ipsum dolor sit amet.',
            ],
            [
                'key' => 'field_sportshealing_footer_phone_label',
                'label' => __('Footer Phone Label', 'sportshealing'),
                'name' => 'sportshealing_footer_phone_label',
                'type' => 'text',
                'default_value' => 'Have Any Question?',
            ],
            [
                'key' => 'field_sportshealing_footer_email_label',
                'label' => __('Footer Email Label', 'sportshealing'),
                'name' => 'sportshealing_footer_email_label',
                'type' => 'text',
                'default_value' => 'Send Email',
            ],
            [
                'key' => 'field_sportshealing_footer_quick_title',
                'label' => __('Quick Links Title', 'sportshealing'),
                'name' => 'sportshealing_footer_quick_title',
                'type' => 'text',
                'default_value' => 'Quick Links',
            ],
            [
                'key' => 'field_sportshealing_footer_services_title',
                'label' => __('Services Links Title', 'sportshealing'),
                'name' => 'sportshealing_footer_services_title',
                'type' => 'text',
                'default_value' => 'Our Services',
            ],
            [
                'key' => 'field_sportshealing_footer_opening_hours_title',
                'label' => __('Opening Hours Title', 'sportshealing'),
                'name' => 'sportshealing_footer_opening_hours_title',
                'type' => 'text',
                'default_value' => 'Opening Hours',
            ],
            [
                'key' => 'field_sportshealing_footer_contact_title',
                'label' => __('Contact Widget Title', 'sportshealing'),
                'name' => 'sportshealing_footer_contact_title',
                'type' => 'text',
                'default_value' => 'Get In Touch',
            ],
            [
                'key' => 'field_sportshealing_footer_newsletter_title',
                'label' => __('Newsletter Title', 'sportshealing'),
                'name' => 'sportshealing_footer_newsletter_title',
                'type' => 'text',
                'default_value' => 'Newsletter',
            ],
            [
                'key' => 'field_sportshealing_footer_newsletter_placeholder',
                'label' => __('Newsletter Placeholder', 'sportshealing'),
                'name' => 'sportshealing_footer_newsletter_placeholder',
                'type' => 'text',
                'default_value' => 'Your Email',
            ],
            [
                'key' => 'field_sportshealing_footer_newsletter_button_label',
                'label' => __('Newsletter Button Label', 'sportshealing'),
                'name' => 'sportshealing_footer_newsletter_button_label',
                'type' => 'text',
                'default_value' => 'Send',
            ],
            [
                'key' => 'field_sportshealing_footer_payment_label',
                'label' => __('Payment Label', 'sportshealing'),
                'name' => 'sportshealing_footer_payment_label',
                'type' => 'text',
                'default_value' => 'We Accept Payments',
            ],
            [
                'key' => 'field_sportshealing_opening_hours_html',
                'label' => __('Opening Hours HTML', 'sportshealing'),
                'name' => 'sportshealing_opening_hours_html',
                'type' => 'textarea',
                'new_lines' => '',
                'default_value' => '<ul class="opening-list"><li><p>Monday - Friday: <span class="time">8:00am - 4:00pm</span></p></li><li><p>Saturday: <span class="time">8:00am - 12:00pm</span></p></li><li><p>Sunday: <span class="time">8:00am - 10:00am</span></p></li></ul>',
            ],
            [
                'key' => 'field_sportshealing_copyright_html',
                'label' => __('Copyright HTML', 'sportshealing'),
                'name' => 'sportshealing_copyright_html',
                'type' => 'textarea',
                'new_lines' => '',
                'default_value' => '&#169; Copyright 2025 Carenix All Rights Reserved',
            ],
        ], sportshealing_acf_common_contact_fields('footer'), sportshealing_acf_social_fields('footer'), [
            [
                'key' => 'field_sportshealing_footer_custom_html_before',
                'label' => __('Custom HTML Before Footer', 'sportshealing'),
                'name' => 'sportshealing_custom_html_before',
                'type' => 'textarea',
                'new_lines' => '',
            ],
            [
                'key' => 'field_sportshealing_footer_custom_html_after',
                'label' => __('Custom HTML After Footer', 'sportshealing'),
                'name' => 'sportshealing_custom_html_after',
                'type' => 'textarea',
                'new_lines' => '',
            ],
        ]),
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'sh_footer',
                ],
            ],
        ],
    ]);
}
add_action('acf/init', 'sportshealing_register_acf_layout_fields');
