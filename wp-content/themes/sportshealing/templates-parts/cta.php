<!-- cta section start -->
<?php
$cta_heading = sportshealing_acf_section_text('heading');
$cta_copy = sportshealing_acf_section_text('copy');
$cta_button_label = sportshealing_acf_section_text('button_label') ?: __('Book Appointment', 'sportshealing');
$cta_button_page = sportshealing_acf_section_value('button_page');
$cta_button_page_id = 0;

if ($cta_button_page instanceof WP_Post) {
    $cta_button_page_id = (int) $cta_button_page->ID;
} elseif (is_array($cta_button_page) && isset($cta_button_page['ID'])) {
    $cta_button_page_id = (int) $cta_button_page['ID'];
} elseif (is_numeric($cta_button_page)) {
    $cta_button_page_id = (int) $cta_button_page;
}

$cta_button_url = $cta_button_page_id ? get_permalink($cta_button_page_id) : sportshealing_static_url('appointment.html');
?>
                <section class="cta-section-3 pb-100 md-pb-80">
                    <div class="container">
                        <div class="cta-wapper" data-img-src="<?php echo esc_url( sportshealing_asset_url( 'assets/images/cta/background-cta-shape.png' ) ); ?>">
                            <div class="row align-items-end justify-content-between">
                                <div class="col-lg-5">
                                    <div class="cta-content">
                                        <!-- section title start -->
                                        <div class="section-title">
                                            <?php if ($cta_heading) : ?>
                                                <h2><?php echo esc_html($cta_heading); ?></h2>
                                            <?php endif; ?>
                                            <?php if ($cta_copy) : ?>
                                                <p><?php echo wp_kses_post($cta_copy); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="cta-form">
                                        <div class="cta-shape"><img src="<?php echo esc_url(sportshealing_asset_url('assets/images/cta/cta-shape-1.png')); ?>" alt=""></div>
                                        <a href="<?php echo esc_url($cta_button_url); ?>" class="theme-button style-3" aria-label="<?php echo esc_attr($cta_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($cta_button_label); ?>"><?php echo esc_html($cta_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- cta section end -->
