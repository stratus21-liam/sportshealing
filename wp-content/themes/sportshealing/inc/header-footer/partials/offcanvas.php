<?php
if (!defined('ABSPATH') || sportshealing_bool_field('sportshealing_hide_offcanvas', $layout['post_id'])) {
    return;
}
?>
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvas-sidebar" aria-labelledby="offcanvas-sidebar">
    <div class="offcanvas-header">
        <div class="offcanvas-logo">
            <figure><?php echo sportshealing_site_logo(); ?></figure>
        </div>
        <button type="button" class="offcanvas-close bg-transparent" data-bs-dismiss="offcanvas" aria-label="<?php esc_attr_e('Close', 'sportshealing'); ?>"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body">
        <div class="mobile-menu"></div>
        <?php if (!sportshealing_bool_field('sportshealing_hide_offcanvas_intro', $layout['post_id'])) : ?>
            <div class="offcanvas-about d-none d-xl-block"><?php echo wp_kses_post(wpautop($layout['offcanvas_intro'])); ?></div>
        <?php endif; ?>
        <?php if (!sportshealing_bool_field('sportshealing_hide_offcanvas_contact', $layout['post_id'])) : ?>
            <div class="offcanvas-contact">
                <div class="widget widget-contact">
                    <div class="widget-title"><h3><?php esc_html_e('Contact Info', 'sportshealing'); ?></h3></div>
                    <div class="widget-content">
                        <div class="offcanvas-cta-item">
                            <div class="offcanvas-cta-list">
                                <div class="offcanvas-cta-icon"><i class="fa-solid fa-location-dot"></i></div>
                                <div class="offcanvas-cta-content"><p><?php echo esc_html($layout['address']); ?></p></div>
                            </div>
                            <div class="offcanvas-cta-list">
                                <div class="offcanvas-cta-icon"><i class="fa-solid fa-envelope"></i></div>
                                <div class="offcanvas-cta-content"><a href="mailto:<?php echo esc_attr($layout['email']); ?>"><?php echo esc_html($layout['email']); ?></a></div>
                            </div>
                            <div class="offcanvas-cta-list">
                                <div class="offcanvas-cta-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                <div class="offcanvas-cta-content"><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $layout['phone'])); ?>"><?php echo esc_html($layout['phone']); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!sportshealing_bool_field('sportshealing_hide_cta_button', $layout['post_id'])) : ?>
            <div class="offcanvas-button-wapper">
                <a href="<?php echo esc_url($layout['button_url']); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($layout['cta_label']); ?>">
                    <span data-text="<?php echo esc_attr($layout['cta_label']); ?>"><?php echo esc_html($layout['cta_label']); ?></span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
        <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
            <div class="offcanvas-social">
                <div class="widget widget-social-media">
                    <div class="widget-content"><?php sportshealing_social_icons($layout['post_id']); ?></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
