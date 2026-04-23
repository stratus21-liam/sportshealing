<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<?php require get_template_directory() . '/inc/header-footer/partials/offcanvas.php'; ?>
<header class="header header-1">
    <?php if (!sportshealing_bool_field('sportshealing_hide_top_bar', $layout['post_id'])) : ?>
        <div class="header-top d-none d-xl-block">
            <div class="container-fluid">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto">
                        <div class="header-top-left">
                            <div class="header-contact-info">
                                <ul>
                                    <li><p><i class="fa-solid fa-location-dot"></i> <?php echo esc_html($layout['address']); ?></p></li>
                                    <li><p><i class="fa-solid fa-envelope"></i> <?php echo esc_html($layout['email']); ?></p></li>
                                    <li><p><i class="fa-solid fa-clock"></i> <?php echo esc_html($layout['hours']); ?></p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
