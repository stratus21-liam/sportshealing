<?php
$cta_primary_label = sportshealing_acf_section_text('primary_button_label') ?: __('Get Appointment', 'sportshealing');
$cta_primary_url = sportshealing_acf_section_page_url('primary_button_page', sportshealing_static_url('appointment.html', ''));
$cta_secondary_label = sportshealing_acf_section_text('secondary_button_label') ?: __('Explore More', 'sportshealing');
$cta_secondary_url = sportshealing_acf_section_page_url('secondary_button_page', sportshealing_static_url('contact.html', ''));
$cta_video_url = sportshealing_acf_section_text('video_url') ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';
?>
<!-- cta section start -->
                <section class="cta-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="cta-content wow fadeInUp" data-wow-delay=".2s">
                                    <div class="section-title">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="cta-button-wapper">
                                        <a href="<?php echo esc_url($cta_primary_url); ?>" class="theme-button style-4" aria-label="<?php echo esc_attr($cta_primary_label); ?>">
                                            <span data-text="<?php echo esc_attr($cta_primary_label); ?>"><?php echo esc_html($cta_primary_label); ?></span>
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </a>
                                        <a href="<?php echo esc_url($cta_secondary_url); ?>" class="theme-button style-5" aria-label="<?php echo esc_attr($cta_secondary_label); ?>">
                                            <span data-text="<?php echo esc_attr($cta_secondary_label); ?>"><?php echo esc_html($cta_secondary_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cta-video-wapper wow fadeInUp" data-wow-delay=".2s">
                                    <a class="video-popup video-play play-center" href="<?php echo esc_url($cta_video_url); ?>" aria-label="<?php esc_attr_e('Play video', 'sportshealing'); ?>">
                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- cta section end -->
