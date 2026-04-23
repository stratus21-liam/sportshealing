<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<?php require get_template_directory() . '/inc/header-footer/partials/offcanvas.php'; ?>
<header class="header header-3">
    <?php if (!sportshealing_bool_field('sportshealing_hide_top_bar', $layout['post_id'])) : ?>
        <div class="header-top d-none d-xl-block">
            <div class="container-fluid">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto">
                        <div class="header-top-left">
                            <div class="header-coupon">
                                <div class="header-coupon-icon"><i class="fa-solid fa-truck-medical"></i></div>
                                <div class="header-coupon-content"><p><?php echo esc_html($layout['coupon_text']); ?></p></div>
                            </div>
                        </div>
                    </div>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
                        <div class="col-auto">
                            <div class="header-top-center"><div class="header-social-icon"><?php sportshealing_social_icons($layout['post_id']); ?></div></div>
                        </div>
                    <?php endif; ?>
                    <div class="col-auto">
                        <div class="header-top-right">
                            <?php require get_template_directory() . '/inc/header-footer/partials/header-search.php'; ?>
                            <?php require get_template_directory() . '/inc/header-footer/partials/header-cart.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php require get_template_directory() . '/inc/header-footer/partials/header-lower.php'; ?>
</header>
<?php echo wp_kses_post($layout['custom_html_after']); ?>
