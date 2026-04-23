<?php
/**
 * Template Name: Homepage 1
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_homepage_1_hero_enabled')) : ?>
    <?php sportshealing_render_template_part('hero-homepage-1.php', 'sportshealing_homepage_1_hero'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_micon_enabled')) : ?>
    <?php sportshealing_render_template_part('micon.php', 'sportshealing_homepage_1_micon'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_about_enabled')) : ?>
    <?php sportshealing_render_template_part('about-homepage-1.php', 'sportshealing_homepage_1_about'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_services_enabled')) : ?>
    <?php sportshealing_render_template_part('services-homepage-1.php', 'sportshealing_homepage_1_services'); ?>
<?php endif; ?>

                <!-- why-section start -->
                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_why_choose_enabled')) : ?>
    <?php sportshealing_render_template_part('why-choose-homepage-1.php', 'sportshealing_homepage_1_why_choose'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_appointment_enabled')) : ?>
    <?php sportshealing_render_template_part('appointment-homepage-1.php', 'sportshealing_homepage_1_appointment'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_product_enabled')) : ?>
    <?php sportshealing_render_template_part('product.php', 'sportshealing_homepage_1_product'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_portfolio_enabled')) : ?>
    <?php sportshealing_render_template_part('portfolio-homepage-1.php', 'sportshealing_homepage_1_portfolio'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_testimonials_enabled')) : ?>
    <?php sportshealing_render_template_part('testimonials-homepage-1.php', 'sportshealing_homepage_1_testimonials'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_marquee_ticker_enabled')) : ?>
    <?php sportshealing_render_template_part('marquee-ticker-homepage-1.php', 'sportshealing_homepage_1_marquee_ticker'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_doctor_enabled')) : ?>
    <?php sportshealing_render_template_part('doctor-homepage-1.php', 'sportshealing_homepage_1_doctor'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta-homepage-1.php', 'sportshealing_homepage_1_cta'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_faq_enabled')) : ?>
    <?php sportshealing_render_template_part('faq-homepage-1.php', 'sportshealing_homepage_1_faq'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_pricing_enabled')) : ?>
    <?php sportshealing_render_template_part('pricing-homepage-1.php', 'sportshealing_homepage_1_pricing'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_1_blog_enabled')) : ?>
    <?php sportshealing_render_template_part('blog-homepage-1.php', 'sportshealing_homepage_1_blog'); ?>
<?php endif; ?>
<?php get_footer(); ?>
