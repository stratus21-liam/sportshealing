<?php
$hero_primary_label = sportshealing_acf_section_text('primary_button_label') ?: __('Book Appointment', 'sportshealing');
$hero_primary_url = sportshealing_acf_section_page_url('primary_button_page', sportshealing_static_url('appointment.html', ''));
$hero_secondary_label = sportshealing_acf_section_text('secondary_button_label') ?: __('Our Services', 'sportshealing');
$hero_secondary_url = sportshealing_acf_section_page_url('secondary_button_page', sportshealing_static_url('services.html', ''));
$hero_round_url = sportshealing_acf_section_page_url('round_button_page', sportshealing_static_url('contact.html', ''));
?>
<!-- hero section start -->
                <section class="hero-section-2">
                    <div class="container-fluid p-0">
                        <div class="row justify-content-between align-items-center g-0">
                            <div class="col-lg-12">
                                <div class="hero-items">
                                    <div class="hero-image">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/hero/hero-2-1.jpg')); ?>" alt="hero image one">
                                        </figure>
                                    </div>
                                    <div class="hero-content" data-img-src="<?php echo esc_url(sportshealing_acf_section_named_image_url('content_shape', 'assets/images/shape/bg-shape-1.png')); ?>">
                                        <div class="section-title">
                                            <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                            <h1><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h1>
                                            <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                        </div>
                                        <div class="hero-button-wappper">
                                            <a href="<?php echo esc_url($hero_primary_url); ?>" class="theme-button style-4" aria-label="<?php echo esc_attr($hero_primary_label); ?>">
                                                <span data-text="<?php echo esc_attr($hero_primary_label); ?>"><?php echo esc_html($hero_primary_label); ?></span>
                                                <i class="fa-solid fa-calendar-days"></i>
                                            </a>
                                            <a href="<?php echo esc_url($hero_secondary_url); ?>" class="theme-button style-5" aria-label="<?php echo esc_attr($hero_secondary_label); ?>">
                                                <span data-text="<?php echo esc_attr($hero_secondary_label); ?>"><?php echo esc_html($hero_secondary_label); ?></span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="hero-round">
                                    <a class="hero-round-text" href="<?php echo esc_url($hero_round_url); ?>" aria-label="<?php esc_attr_e('Contact us', 'sportshealing'); ?>">
                                        <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('round_image', 'assets/images/shape/round-contact-us.png')); ?>" alt="round contact us">
                                        <i class="fa-solid fa-arrow-down"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- hero section end -->
