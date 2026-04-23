<?php
/**
 * Template Name: Image Gallery
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_image_gallery_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_image_gallery_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_image_gallery_gallery_enabled')) : ?>
    <?php sportshealing_render_template_part('gallery.php', 'sportshealing_image_gallery_gallery'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_image_gallery_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta.php', 'sportshealing_image_gallery_cta'); ?>
<?php endif; ?>
<?php get_footer(); ?>
