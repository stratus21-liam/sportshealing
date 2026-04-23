<?php
/**
 * Template Name: Homepage 2
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_homepage_2_hero_enabled')) : ?>
    <?php sportshealing_render_template_part('hero-homepage-2.php', 'sportshealing_homepage_2_hero'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_about_enabled')) : ?>
    <?php sportshealing_render_template_part('about-homepage-2.php', 'sportshealing_homepage_2_about'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_services_enabled')) : ?>
    <?php sportshealing_render_template_part('services-homepage-2.php', 'sportshealing_homepage_2_services'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_results_enabled')) : ?>
    <?php sportshealing_render_template_part('results.php', 'sportshealing_homepage_2_results'); ?>
<?php endif; ?>
                 
                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_appointment_enabled')) : ?>
    <?php sportshealing_render_template_part('appointment-homepage-2.php', 'sportshealing_homepage_2_appointment'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_testimonials_enabled')) : ?>
    <?php sportshealing_render_template_part('testimonials-homepage-2.php', 'sportshealing_homepage_2_testimonials'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_portfolio_enabled')) : ?>
    <?php sportshealing_render_template_part('portfolio-homepage-2.php', 'sportshealing_homepage_2_portfolio'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_doctor_enabled')) : ?>
    <?php sportshealing_render_template_part('doctor-homepage-2.php', 'sportshealing_homepage_2_doctor'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_pricing_enabled')) : ?>
    <?php sportshealing_render_template_part('pricing-homepage-2.php', 'sportshealing_homepage_2_pricing'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_faq_enabled')) : ?>
    <?php sportshealing_render_template_part('faq-homepage-2.php', 'sportshealing_homepage_2_faq'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_blog_enabled')) : ?>
    <?php sportshealing_render_template_part('blog-homepage-2.php', 'sportshealing_homepage_2_blog'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_2_instagram_enabled')) : ?>
    <?php sportshealing_render_template_part('instagram.php', 'sportshealing_homepage_2_instagram'); ?>
<?php endif; ?>
<?php get_footer(); ?>
