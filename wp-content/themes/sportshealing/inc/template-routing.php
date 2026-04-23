<?php
/**
 * Template routing for organized theme folders.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return a theme template path when the file exists.
 */
function sportshealing_template_path(string $relative_path): string {
    $path = get_template_directory() . '/' . ltrim($relative_path, '/');

    return is_readable($path) ? $path : '';
}

/**
 * Route custom post type listing templates to the root CMS template files.
 */
function sportshealing_listing_template(string $template): string {
    if (is_post_type_archive('sh_service')) {
        return sportshealing_template_path('service-listing-template.php') ?: $template;
    }

    if (is_post_type_archive('sh_portfolio')) {
        return sportshealing_template_path('portfolio-listing-template.php') ?: $template;
    }

    if (is_post_type_archive('sh_doctor')) {
        return sportshealing_template_path('doctor-listing-template.php') ?: $template;
    }

    return $template;
}
add_filter('archive_template', 'sportshealing_listing_template');

/**
 * Route custom post type single templates to the root detail template files.
 */
function sportshealing_single_template(string $template): string {
    if (is_singular('post')) {
        return sportshealing_template_path('blog-detail-template.php') ?: $template;
    }

    if (is_singular('sh_service')) {
        return sportshealing_template_path('service-detail-template.php') ?: $template;
    }

    if (is_singular('sh_portfolio')) {
        return sportshealing_template_path('portfolio-detail-template.php') ?: $template;
    }

    if (is_singular('sh_doctor')) {
        return sportshealing_template_path('doctor-detail-template.php') ?: $template;
    }

    return $template;
}
add_filter('single_template', 'sportshealing_single_template');

/**
 * Keep older selected page-template filenames working after the cleanup.
 */
function sportshealing_page_template(string $template): string {
    $legacy_template = get_page_template_slug();
    $map = [
        'templates/home/homepage-1.php' => 'homepage-1-template.php',
        'templates/home/homepage-2.php' => 'homepage-2-template.php',
        'templates/home/homepage-3.php' => 'homepage-3-template.php',
        'templates/pages/about.php' => 'about-template.php',
        'templates/pages/appointment.php' => 'appointment-template.php',
        'templates/pages/contact.php' => 'contact-template.php',
        'templates/pages/error.php' => 'error-template.php',
        'templates/pages/faq.php' => 'faq-template.php',
        'templates/pages/testimonials.php' => 'testimonials-template.php',
        'templates/blog/blog-listing-template.php' => 'blog-listing-template.php',
        'templates/gallery/image-gallery.php' => 'image-gallery-template.php',
        'templates/gallery/video-gallery.php' => 'video-gallery-template.php',
        'templates/services/service-listing-template.php' => 'service-listing-template.php',
        'templates/portfolio/portfolio-listing-template.php' => 'portfolio-listing-template.php',
        'templates/doctors/doctor-listing-template.php' => 'doctor-listing-template.php',
        'homepage-1.php' => 'homepage-1-template.php',
        'homepage-2.php' => 'homepage-2-template.php',
        'homepage-3.php' => 'homepage-3-template.php',
        'about.php' => 'about-template.php',
        'appointment.php' => 'appointment-template.php',
        'contact.php' => 'contact-template.php',
        'error.php' => 'error-template.php',
        'faq.php' => 'faq-template.php',
        'image-gallery.php' => 'image-gallery-template.php',
        'testimonials.php' => 'testimonials-template.php',
        'video-gallery.php' => 'video-gallery-template.php',
        'template-index.php' => 'homepage-1-template.php',
        'template-index-2.php' => 'homepage-2-template.php',
        'template-index-3.php' => 'homepage-3-template.php',
        'template-about.php' => 'about-template.php',
        'template-appointment.php' => 'appointment-template.php',
        'template-contact.php' => 'contact-template.php',
        'template-error.php' => 'error-template.php',
        'template-faq.php' => 'faq-template.php',
        'template-testimonials.php' => 'testimonials-template.php',
        'template-blog.php' => 'blog-listing-template.php',
        'template-image-gallery.php' => 'image-gallery-template.php',
        'template-video-gallery.php' => 'video-gallery-template.php',
    ];

    if (isset($map[$legacy_template])) {
        return sportshealing_template_path($map[$legacy_template]) ?: $template;
    }

    return $template;
}
add_filter('page_template', 'sportshealing_page_template');
