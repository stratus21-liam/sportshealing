<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<div class="header-lower">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between g-0">
            <div class="col-12">
                <div class="header-content d-flex justify-content-between align-items-center">
                    <div class="logo-box">
                        <div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>"><figure><?php echo sportshealing_site_logo(); ?></figure></a></div>
                    </div>
                    <div class="header-navigation d-flex align-items-center">
                        <div class="main-menu"><nav id="mobile-menu"><?php sportshealing_render_menu('primary'); ?></nav></div>
                    </div>
                    <div class="header-right d-flex align-items-center gap-lg-4 gap-3">
                        <?php if (!sportshealing_bool_field('sportshealing_hide_cta_button', $layout['post_id'])) : ?>
                            <div class="header-button">
                                <a href="<?php echo esc_url($layout['button_url']); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($layout['cta_label']); ?>">
                                    <span data-text="<?php echo esc_attr($layout['cta_label']); ?>"><?php echo esc_html($layout['cta_label']); ?></span>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if ($layout['variant'] === 'two') : ?>
                            <?php require get_template_directory() . '/inc/header-footer/partials/header-cart.php'; ?>
                        <?php endif; ?>
                        <?php if ($layout['variant'] === 'three' && !sportshealing_bool_field('sportshealing_hide_call', $layout['post_id'])) : ?>
                            <div class="header-call">
                                <div class="header-call-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                <div class="header-call-content">
                                    <span><?php esc_html_e('For emergency, Call now', 'sportshealing'); ?></span>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $layout['phone'])); ?>"><?php echo esc_html($layout['phone']); ?></a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!sportshealing_bool_field('sportshealing_hide_offcanvas', $layout['post_id'])) : ?>
                            <div class="header-sidebar">
                                <a class="sidebar-toggler color-one" data-bs-toggle="offcanvas" href="#offcanvas-sidebar" aria-label="<?php esc_attr_e('sidebar toggler', 'sportshealing'); ?>" role="button" aria-controls="offcanvas-sidebar">
                                    <span></span><span></span><span></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
