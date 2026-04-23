<?php
$video_button_label = sportshealing_acf_section_text('button_label') ?: __('Explore More', 'sportshealing');
$video_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('about.html', ''));
$video_url = sportshealing_acf_section_text('video_url') ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';
?>
<!-- video section start -->
                <section class="video-section pt-100 md-pt-80" data-img-src="<?php echo esc_url(sportshealing_acf_section_named_image_url('background_image', 'assets/images/video/video-3-1.jpg')); ?>">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-5">
                                <div class="video-content wow fadeInUp" data-wow-delay=".2s">
                                    <div class="section-title">
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="video-button-wapper">
                                        <a href="<?php echo esc_url($video_button_url); ?>" class="theme-button style-4" aria-label="<?php echo esc_attr($video_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($video_button_label); ?>"><?php echo esc_html($video_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="video-circle wow fadeInUp" data-wow-delay=".3s">
                                    <a class="video-popup video-play play-center" href="<?php echo esc_url($video_url); ?>" aria-label="<?php esc_attr_e('Play video', 'sportshealing'); ?>">
                                        <span class="icon"><i class="fa-solid fa-play"></i></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- video section end -->
