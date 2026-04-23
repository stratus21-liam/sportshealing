<?php
/**
 * One-time setup for SportsHealing blog posts.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create lorem ipsum blog posts for the Blog template and single post view.
 */
function sportshealing_seed_blog_posts(): void {
    $posts = [
        ['Lorem Ipsum Sports Recovery', 'lorem-ipsum-sports-recovery', 'Sports Health', 'assets/images/blog/blog-1.jpg'],
        ['Lorem Ipsum Injury Prevention', 'lorem-ipsum-injury-prevention', 'Rehabilitation', 'assets/images/blog/blog-2.jpg'],
        ['Lorem Ipsum Movement Therapy', 'lorem-ipsum-movement-therapy', 'Performance', 'assets/images/blog/blog-3.jpg'],
        ['Lorem Ipsum Wellness Planning', 'lorem-ipsum-wellness-planning', 'Sports Health', 'assets/images/blog/blog-4.jpg'],
    ];

    foreach ($posts as [$title, $slug, $category, $image]) {
        $post_id = sportshealing_seed_content_post('post', $title, $slug, [
            'sportshealing_blog_listing_image' => $image,
            'sportshealing_post_subtitle' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit.',
        ]);

        if ($post_id) {
            sportshealing_seed_post_category($post_id, $category);
        }
    }
}

/**
 * Seed blog posts once from wp-admin when the theme is already active.
 */
function sportshealing_maybe_seed_blog_posts(): void {
    if (get_option('sportshealing_blog_posts_seeded')) {
        return;
    }

    sportshealing_seed_blog_posts();
    update_option('sportshealing_blog_posts_seeded', 1, false);
}
add_action('admin_init', 'sportshealing_maybe_seed_blog_posts');
