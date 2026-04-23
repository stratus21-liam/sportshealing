<?php
/**
 * Template Name: 404 Error
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_error_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_error_breadcrumb'); ?>
<?php endif; ?>
<?php if (sportshealing_section_enabled('sportshealing_error_error_enabled')) : ?>
    <?php sportshealing_render_template_part('error.php', 'sportshealing_error_error'); ?>
<?php endif; ?>
<?php get_footer(); ?>
