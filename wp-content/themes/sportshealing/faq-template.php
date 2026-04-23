<?php
/**
 * Template Name: FAQ
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_faq_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_faq_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_faq_faq_enabled')) : ?>
    <?php sportshealing_render_template_part('faq.php', 'sportshealing_faq_faq'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_faq_cta_enabled')) : ?>
    <?php sportshealing_render_template_part('cta.php', 'sportshealing_faq_cta'); ?>
<?php endif; ?>
<?php get_footer(); ?>
