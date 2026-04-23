<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<footer class="footer footer-1" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/footer/footer-1-1.png')); ?>">
    <?php if (!sportshealing_bool_field('sportshealing_hide_footer_top', $layout['post_id'])) : ?>
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <div class="footer-logo wow fadeInUp" data-wow-delay=".2s"><a href="<?php echo esc_url(home_url('/')); ?>"><figure><?php echo sportshealing_footer_logo(); ?></figure></a></div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-contact-info wow fadeInUp" data-wow-delay=".3s">
                                <div class="footer-contact-icon"><i class="fa-solid fa-phone-volume"></i></div>
                                <div class="footer-contact-content"><span><?php echo esc_html($layout['footer_phone_label']); ?></span><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $layout['phone'])); ?>"><?php echo esc_html($layout['phone']); ?></a></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-contact-info wow fadeInUp" data-wow-delay=".4s">
                                <div class="footer-contact-icon"><i class="fa-solid fa-envelope"></i></div>
                                <div class="footer-contact-content"><span><?php echo esc_html($layout['footer_email_label']); ?></span><a href="mailto:<?php echo esc_attr($layout['email']); ?>"><?php echo esc_html($layout['email']); ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-widget-wrap">
                <div class="row justify-content-between">
                    <?php if (!sportshealing_bool_field('sportshealing_hide_about_widget', $layout['post_id'])) : ?>
                        <div class="col-xl-4 col-lg-12">
                            <div class="footer-widget footer-widget-about wow fadeInUp" data-wow-delay=".2s">
                                <?php echo wp_kses_post(wpautop($layout['footer_about_html'])); ?>
                                <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
                                    <div class="footer-social-icon"><?php sportshealing_social_icons($layout['post_id']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_quick_links', $layout['post_id'])) : ?>
                        <div class="col-lg-2 col-sm-6">
                            <div class="footer-widget footer-widget-quick-links wow fadeInUp" data-wow-delay=".3s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_quick_title']); ?></h3>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_quick', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_services_links', $layout['post_id'])) : ?>
                        <div class="col-lg-2 col-sm-6">
                            <div class="footer-widget footer-widget-services wow fadeInUp" data-wow-delay=".4s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_services_title']); ?></h3>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_services', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_opening_hours', $layout['post_id'])) : ?>
                        <div class="col-xl-3 col-lg-4">
                            <div class="footer-widget footer-widget-opening-hours wow fadeInUp" data-wow-delay=".5s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_opening_hours_title']); ?></h3>
                                <div class="widget-opening-hours"><?php echo wp_kses_post($layout['opening_hours_html']); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="footer-copyright-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="copyright-text wow fadeInUp" data-wow-delay=".2s"><p class="m-0"><?php echo wp_kses_post($layout['copyright_html']); ?></p></div>
                    </div>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_legal_menu', $layout['post_id'])) : ?>
                        <div class="col-lg-6 text-lg-end"><?php sportshealing_render_menu('footer_legal', '<ul class="footer-bottom-nav wow fadeInUp" data-wow-delay=".3s">%3$s</ul>', 1); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php echo wp_kses_post($layout['custom_html_after']); ?>
