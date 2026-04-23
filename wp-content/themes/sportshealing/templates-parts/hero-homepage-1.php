<?php
$hero_primary_label = sportshealing_acf_section_text('primary_button_label') ?: __('Book Appointment', 'sportshealing');
$hero_primary_url = sportshealing_acf_section_page_url('primary_button_page', sportshealing_static_url('appointment.html', ''));
$hero_secondary_label = sportshealing_acf_section_text('secondary_button_label') ?: __('Our Services', 'sportshealing');
$hero_secondary_url = sportshealing_acf_section_page_url('secondary_button_page', sportshealing_static_url('services.html', ''));
?>
<!-- hero section start -->
                <section class="hero-section-1" data-img-src="<?php echo esc_url(sportshealing_acf_section_named_image_url('background_image', 'assets/images/hero/banner_bg.png')); ?>">
                    <div class="hero-shape">
                        <img class="hero-shape-one" src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', 'assets/images/shape/shape-4.png')); ?>" alt="hero shape one">
                        <img class="hero-shape-two" src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_2', 'assets/images/shape/square-blue.png')); ?>" alt="hero shape two">
                        <img class="hero-shape-three" src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_3', 'assets/images/shape/plus-orange.png')); ?>" alt="hero shape three">
                    </div>
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-5">
                                <div class="hero-content wow fadeInUp" data-wow-delay=".2s">
                                    <div class="section-title">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h1><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h1>
                                        <p class="text-black"><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="hero-button-wappper">
                                        <a href="<?php echo esc_url($hero_primary_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($hero_primary_label); ?>">
                                            <span data-text="<?php echo esc_attr($hero_primary_label); ?>"><?php echo esc_html($hero_primary_label); ?></span>
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </a>
                                        <a href="<?php echo esc_url($hero_secondary_url); ?>" class="theme-button style-2" aria-label="<?php echo esc_attr($hero_secondary_label); ?>">
                                            <span data-text="<?php echo esc_attr($hero_secondary_label); ?>"><?php echo esc_html($hero_secondary_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="hero-image wow fadeInUp" data-wow-delay=".3s">
                                    <div class="row align-items-end">
                                        <div class="col-6">
                                            <div class="hero-image-left">
                                                <figure class="image-anime">
                                                    <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('left_image', 'assets/images/hero/hero-1-1.jpg')); ?>" alt="hero image one">
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="hero-image-right">
                                                <div class="hero-image-right-top">
                                                    <figure class="image-anime">
                                                        <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('top_right_image', 'assets/images/hero/hero-1-2.jpg')); ?>" alt="hero image two">
                                                    </figure>
                                                </div>
                                                <div class="hero-image-right-bottom">
                                                    <figure class="image-anime">
                                                        <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('bottom_right_image', 'assets/images/hero/hero-1-3.jpg')); ?>" alt="hero image three">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="round-shape">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- hero section end -->
