<?php
/**
 * Template Name: Appointment
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_appointment_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_appointment_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_appointment_appointment_enabled')) : ?>
    <?php sportshealing_render_template_part('appointment.php', 'sportshealing_appointment_appointment'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_appointment_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta.php', 'sportshealing_appointment_cta'); ?>
<?php endif; ?>
<?php get_footer(); ?>
