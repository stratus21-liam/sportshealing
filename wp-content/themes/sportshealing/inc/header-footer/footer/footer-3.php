<?php
if (!defined('ABSPATH')) {
    return;
}
?>
<?php echo wp_kses_post($layout['custom_html_before']); ?>
<footer class="footer footer-3" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/footer/footer-3-1.png')); ?>">
    <?php if (!sportshealing_bool_field('sportshealing_hide_footer_top', $layout['post_id'])) : ?>
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-wrap">
                    <div class="row align-items-center">
                        <?php if (!sportshealing_bool_field('sportshealing_hide_social', $layout['post_id'])) : ?>
                            <div class="col-lg-6 col-md-12"><div class="footer-social-icon wow fadeInLeft" data-wow-delay=".2s"><?php sportshealing_social_icons($layout['post_id']); ?></div></div>
                        <?php endif; ?>
                        <?php if (!sportshealing_bool_field('sportshealing_hide_newsletter', $layout['post_id'])) : ?>
                            <div class="col-lg-6 col-md-12">
                                <div class="widget-subscribe wow fadeInRight" data-wow-delay=".3s">
                                    <h4 class="footer-widget-title"><?php echo esc_html($layout['footer_newsletter_title']); ?></h4>
                                    <form action="#">
                                        <div class="form-group">
                                            <div class="form-floating field-inner">
                                                <input type="email" id="emailid" name="emailid" class="form-control" placeholder="<?php echo esc_attr($layout['footer_newsletter_placeholder']); ?>" autocomplete="off">
                                                <label for="emailid"><?php echo esc_html($layout['footer_newsletter_placeholder']); ?></label>
                                            </div>
                                        </div>
                                        <button type="submit" class="theme-button style-1"><span data-text="<?php echo esc_attr($layout['footer_newsletter_button_label']); ?>"><?php echo esc_html($layout['footer_newsletter_button_label']); ?></span></button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-widget-wrap">
                <div class="row">
                    <?php if (!sportshealing_bool_field('sportshealing_hide_about_widget', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-about wow fadeInUp" data-wow-delay=".2s">
                                <div class="footer-logo mb-30"><a href="<?php echo esc_url(home_url('/')); ?>"><figure><?php echo sportshealing_footer_logo(); ?></figure></a></div>
                                <?php echo wp_kses_post(wpautop($layout['footer_about_html'])); ?>
                                <?php if (!sportshealing_bool_field('sportshealing_hide_cta_button', $layout['post_id'])) : ?>
                                    <div class="button-wapper"><a href="<?php echo esc_url($layout['button_url']); ?>" class="theme-button style-3" aria-label="<?php echo esc_attr($layout['cta_label']); ?>"><span data-text="<?php echo esc_attr($layout['cta_label']); ?>"><?php echo esc_html($layout['cta_label']); ?></span><i class="fa-solid fa-arrow-right"></i></a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_quick_links', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-quick-links wow fadeInUp" data-wow-delay=".3s">
                                <h4 class="footer-widget-title"><?php echo esc_html($layout['footer_quick_title']); ?></h4>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_quick', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_services_links', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-services wow fadeInUp" data-wow-delay=".4s">
                                <h4 class="footer-widget-title"><?php echo esc_html($layout['footer_services_title']); ?></h4>
                                <div class="widget-link"><?php sportshealing_render_menu('footer_services', '<ul class="link">%3$s</ul>', 1, '<i class="fa-solid fa-chevron-right"></i> '); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!sportshealing_bool_field('sportshealing_hide_contact_widget', $layout['post_id'])) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="footer-widget footer-widget-contact wow fadeInUp" data-wow-delay=".5s">
                                <h4 class="footer-widget-title"><?php echo esc_html($layout['footer_contact_title']); ?></h4>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text text-center wow fadeInUp" data-wow-delay=".2s"><p class="m-0"><?php echo wp_kses_post($layout['copyright_html']); ?></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php echo wp_kses_post($layout['custom_html_after']); ?>
