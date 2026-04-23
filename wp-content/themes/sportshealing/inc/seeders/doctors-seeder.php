<?php
/**
 * One-time setup for SportsHealing doctors.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create lorem ipsum doctor profiles for listing and detail routes.
 */
function sportshealing_seed_doctors(): void {
    $doctors = [
        ['Dr Lorem Ipsum', 'dr-lorem-ipsum'],
        ['Dr Dolor Sit', 'dr-dolor-sit'],
        ['Dr Amet Consectetur', 'dr-amet-consectetur'],
        ['Dr Adipiscing Elit', 'dr-adipiscing-elit'],
        ['Dr Integer Posuere', 'dr-integer-posuere'],
        ['Dr Praesent Commodo', 'dr-praesent-commodo'],
    ];

    foreach ($doctors as [$title, $slug]) {
        sportshealing_seed_content_post('sh_doctor', $title, $slug, [
            'sportshealing_doctor_role' => 'Lorem Ipsum Specialist',
            'sportshealing_doctor_biography_heading' => 'Biography',
            'sportshealing_doctor_info_list' => [
                ['label' => 'Occupation:', 'value' => 'Lorem Ipsum'],
                ['label' => 'Experience:', 'value' => 'Lorem Ipsum Years'],
                ['label' => 'Certificates:', 'value' => 'Lorem Ipsum Award'],
                ['label' => 'Skills:', 'value' => 'Lorem ipsum dolor sit amet'],
                ['label' => 'Location:', 'value' => 'Lorem Ipsum Street'],
                ['label' => 'Phone:', 'value' => '+1 234 467 88'],
                ['label' => 'Email:', 'value' => 'sample@example.com'],
            ],
            'sportshealing_doctor_awards_heading' => 'Awards & Hours',
            'sportshealing_doctor_awards_intro' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus.',
            'sportshealing_doctor_awards' => [
                ['label' => 'Lorem Ipsum Award', 'source' => 'Lorem Ipsum Society'],
                ['label' => 'Lorem Ipsum Award', 'source' => 'Lorem Ipsum Research'],
            ],
            'sportshealing_doctor_skills_heading' => 'My Skills',
            'sportshealing_doctor_skills_intro' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.',
            'sportshealing_doctor_skills' => [
                ['label' => 'Lorem Ipsum', 'percent' => 95],
                ['label' => 'Dolor Sit', 'percent' => 85],
                ['label' => 'Amet Consectetur', 'percent' => 92],
            ],
            'sportshealing_doctor_social_links' => [
                ['icon' => 'fa-brands fa-instagram', 'url' => '#'],
                ['icon' => 'fa-brands fa-facebook-f', 'url' => '#'],
                ['icon' => 'fa-brands fa-x-twitter', 'url' => '#'],
                ['icon' => 'fa-brands fa-pinterest-p', 'url' => '#'],
            ],
        ]);
    }
}

/**
 * Seed doctor posts once from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_doctors(): void {
    if (get_option('sportshealing_doctors_seeded')) {
        return;
    }

    sportshealing_seed_doctors();
    update_option('sportshealing_doctors_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_doctors');

/**
 * Backfill richer doctor fields for installs seeded before the full doctor detail layout existed.
 */
function sportshealing_backfill_doctor_detail_fields(): void {
    if (get_option('sportshealing_doctor_detail_fields_backfilled')) {
        return;
    }

    sportshealing_seed_doctors();
    update_option('sportshealing_doctor_detail_fields_backfilled', 1, false);
}
add_action('admin_init', 'sportshealing_backfill_doctor_detail_fields', 30);
