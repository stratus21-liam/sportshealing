<?php
/**
 * Template Name: About
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_about_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_about_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_about_enabled')) : ?>
    <?php sportshealing_render_template_part('about.php', 'sportshealing_about_about'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_doctor_enabled')) : ?>
    <?php sportshealing_render_template_part('doctor.php', 'sportshealing_about_doctor'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_counter_enabled')) : ?>
    <?php sportshealing_render_template_part('counter.php', 'sportshealing_about_counter'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_testimonials_enabled')) : ?>
    <?php sportshealing_render_template_part('testimonials-about.php', 'sportshealing_about_testimonials'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_faq_enabled')) : ?>
    <?php sportshealing_render_template_part('faq-about.php', 'sportshealing_about_faq'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_about_partners_enabled')) : ?>
    <?php sportshealing_render_template_part('partners.php', 'sportshealing_about_partners'); ?>
<?php endif; ?>
<?php get_footer(); ?>
