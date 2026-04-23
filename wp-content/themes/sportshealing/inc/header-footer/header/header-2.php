<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<?php require get_template_directory() . '/inc/header-footer/partials/offcanvas.php'; ?>
<header class="header header-2">
    <?php if (!sportshealing_bool_field('sportshealing_hide_top_bar', $layout['post_id'])) : ?>
        <div class="header-top d-none d-xl-block">
            <div class="container-fluid">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto">
                        <div class="header-top-left">
                            <div class="logo-box">
                                <div class="logo"><a href="<?php echo esc_url(home_url('/')); ?>"><figure><?php echo sportshealing_site_logo(); ?></figure></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-top-center"><?php require get_template_directory() . '/inc/header-footer/partials/header-search.php'; ?></div>
                    </div>
                    <div class="col-auto">
                        <div class="header-top-right">
                            <?php if (!sportshealing_bool_field('sportshealing_hide_login', $layout['post_id'])) : ?>
                                <div class="header-login"><a href="<?php echo esc_url(sportshealing_static_url('sign-in.html')); ?>"><?php esc_html_e('Login / Register', 'sportshealing'); ?></a></div>
                            <?php endif; ?>
                            <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
                                <div class="header-social-icon"><?php sportshealing_social_icons($layout['post_id']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php require get_template_directory() . '/inc/header-footer/partials/header-lower.php'; ?>
</header>
<?php echo wp_kses_post($layout['custom_html_after']); ?>
