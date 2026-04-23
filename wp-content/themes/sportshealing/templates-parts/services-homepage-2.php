<?php
$service_posts = sportshealing_acf_section_posts('posts', 'sh_service', 4);
$more_services_copy = sportshealing_acf_section_text('copy');
$more_services_button_label = sportshealing_acf_section_text('button_label') ?: __('Browse All Services', 'sportshealing');
$more_services_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('services.html', ''));
?>
<!-- services section start -->
                <section class="services-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="services-shape-1">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', 'assets/images/services/services-shape-1.png')); ?>" alt="services shape one">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="service-list">
                                    <?php foreach ($service_posts as $index => $service_post) : ?>
                                        <?php
                                        $service_title = get_the_title($service_post);
                                        $service_copy = wp_trim_words(get_the_excerpt($service_post), 18);
                                        $service_icon = sportshealing_content_field_image_url((int) $service_post->ID, 'sportshealing_service_icon', 'assets/images/joint-icon-29.png');
                                        $service_image = sportshealing_content_field_image_url((int) $service_post->ID, 'sportshealing_service_detail_image', 'assets/images/services/services-2-' . (($index % 4) + 1) . '.jpg');
                                        ?>
                                        <div class="service-item wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                            <div class="service-title-box">
                                                <div class="service-icon">
                                                    <figure>
                                                        <img src="<?php echo esc_url($service_icon); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                                    </figure>
                                                </div>
                                                <div class="service-title">
                                                    <h3><?php echo esc_html($service_title); ?></h3>
                                                </div>
                                            </div>
                                            <div class="service-image">
                                                <a href="<?php echo esc_url(get_permalink($service_post)); ?>">
                                                    <figure>
                                                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                                    </figure>
                                                </a>
                                            </div>
                                            <div class="service-description">
                                                <p><?php echo esc_html($service_copy); ?></p>
                                            </div>
                                            <div class="service-button-wapper">
                                                <a href="<?php echo esc_url(get_permalink($service_post)); ?>" class="service-button-icon" aria-label="<?php echo esc_attr($service_title); ?>">
                                                    <i class="fa-solid fa-arrow-right-long"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-service-content wow fadeInUp" data-wow-delay=".7s">
                                    <?php if ($more_services_copy) : ?>
                                        <p><?php echo wp_kses_post($more_services_copy); ?></p>
                                    <?php endif; ?>
                                    <div class="service-button-wappper">
                                        <a href="<?php echo esc_url($more_services_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($more_services_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($more_services_button_label); ?>"><?php echo esc_html($more_services_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- services section end -->
