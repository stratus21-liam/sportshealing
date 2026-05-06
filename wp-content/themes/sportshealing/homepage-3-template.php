<?php
/**
 * Template Name: Homepage 3
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_homepage_3_hero_enabled')) : ?>
    <?php sportshealing_render_template_part('hero-homepage-3.php', 'sportshealing_homepage_3_hero'); ?>
<?php endif; ?>

<?php if (sportshealing_section_enabled('sportshealing_homepage_3_marquee_ticker_enabled')) : ?>
    <?php sportshealing_render_template_part('marquee-ticker-homepage-3.php', 'sportshealing_homepage_3_marquee_ticker'); ?>
<?php endif; ?>

<?php if (sportshealing_section_enabled('sportshealing_homepage_3_video_enabled')) : ?>
    <?php sportshealing_render_template_part('video.php', 'sportshealing_homepage_3_video'); ?>
<?php endif; ?>

<?php if (sportshealing_section_enabled('sportshealing_homepage_3_about_enabled')) : ?>
    <?php sportshealing_render_template_part('about-homepage-3.php', 'sportshealing_homepage_3_about'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_counter_enabled')) : ?>
    <?php sportshealing_render_template_part('counter-homepage-3.php', 'sportshealing_homepage_3_counter'); ?>
<?php endif; ?>



                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_services_enabled')) : ?>
    <?php sportshealing_render_template_part('services-homepage-3.php', 'sportshealing_homepage_3_services'); ?>
<?php endif; ?>

                <!-- why-section start -->
                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_why_choose_enabled')) : ?>
    <?php sportshealing_render_template_part('why-choose-homepage-3.php', 'sportshealing_homepage_3_why_choose'); ?>
<?php endif; ?>
                 
                <!-- how it work start -->
                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_how_it_work_enabled')) : ?>
    <?php sportshealing_render_template_part('how-it-work.php', 'sportshealing_homepage_3_how_it_work'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_appointment_enabled')) : ?>
    <?php sportshealing_render_template_part('appointment-homepage-3.php', 'sportshealing_homepage_3_appointment'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_testimonials_enabled')) : ?>
    <?php sportshealing_render_template_part('testimonials-homepage-3.php', 'sportshealing_homepage_3_testimonials'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_doctor_enabled')) : ?>
    <?php sportshealing_render_template_part('doctor.php', 'sportshealing_homepage_3_doctor'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_pricing_enabled')) : ?>
    <?php sportshealing_render_template_part('pricing-homepage-3.php', 'sportshealing_homepage_3_pricing'); ?>
<?php endif; ?> 

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_faq_enabled')) : ?>
    <?php sportshealing_render_template_part('faq-homepage-3.php', 'sportshealing_homepage_3_faq'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta-homepage-3.php', 'sportshealing_homepage_3_cta'); ?>
<?php endif; ?> 

                <?php if (sportshealing_section_enabled('sportshealing_homepage_3_blog_enabled')) : ?>
    <?php sportshealing_render_template_part('blog-homepage-3.php', 'sportshealing_homepage_3_blog'); ?>
<?php endif; ?>
<?php get_footer(); ?>
