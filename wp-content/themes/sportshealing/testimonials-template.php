<?php
/**
 * Template Name: Testimonials
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_testimonials_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_testimonials_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_testimonials_testimonials_enabled')) : ?>
    <?php sportshealing_render_template_part('testimonials.php', 'sportshealing_testimonials_testimonials'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_testimonials_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta.php', 'sportshealing_testimonials_cta'); ?>
<?php endif; ?>
<?php get_footer(); ?>
