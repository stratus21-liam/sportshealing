<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<footer class="footer footer-2">
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-widget-wrap">
                <div class="row">
                    <?php if (!sportshealing_bool_field('sportshealing_hide_about_widget', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-about wow fadeInUp" data-wow-delay=".2s">
                                <div class="footer-logo mb-30"><a href="<?php echo esc_url(home_url('/')); ?>"><figure><?php echo sportshealing_footer_logo(); ?></figure></a></div>
                                <?php echo wp_kses_post(wpautop($layout['footer_about_html'])); ?>
                                <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
                                    <div class="footer-social-icon"><?php sportshealing_social_icons($layout['post_id']); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_quick_links', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-quick-links wow fadeInUp" data-wow-delay=".3s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_quick_title']); ?></h3>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_quick', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_services_links', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-services wow fadeInUp" data-wow-delay=".4s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_services_title']); ?></h3>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_services', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_contact_widget', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-contact wow fadeInUp" data-wow-delay=".5s">
                                <h3 class="footer-widget-title"><?php echo esc_html($layout['footer_contact_title']); ?></h3>
                                <div class="widget-contact">
                                    <ul class="contact-info">
                                        <li><p><i class="fa-solid fa-location-dot"></i> <?php echo esc_html($layout['address']); ?></p></li>
                                        <li><p><i class="fa-solid fa-envelope"></i> <?php echo esc_html($layout['email']); ?></p></li>
                                        <li><p><i class="fa-solid fa-phone-volume"></i> <?php echo esc_html($layout['phone']); ?></p></li>
                                        <li><p><i class="fa-solid fa-clock"></i> <?php echo esc_html($layout['hours']); ?></p></li>
                                    </ul>
                                </div>
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
                    <?php if (!sportshealing_bool_field('sportshealing_hide_payment', $layout['post_id'])) : ?>
                        <div class="col-lg-6">
                            <div class="footer-payment wow fadeInUp" data-wow-delay=".3s">
                                <span class="label"><?php echo esc_html($layout['footer_payment_label']); ?></span>
                                <img src="<?php echo esc_url(sportshealing_asset_url('assets/images/footer/footer-payment.png')); ?>" alt="<?php esc_attr_e('payment', 'sportshealing'); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php echo wp_kses_post($layout['custom_html_after']); ?>
