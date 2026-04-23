<?php
/**
 * Template Name: Video Gallery
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_video_gallery_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_video_gallery_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_video_gallery_video_gallery_enabled')) : ?>
    <?php sportshealing_render_template_part('video-gallery.php', 'sportshealing_video_gallery_video_gallery'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_video_gallery_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta.php', 'sportshealing_video_gallery_cta'); ?>
<?php endif; ?>
<?php get_footer(); ?>
