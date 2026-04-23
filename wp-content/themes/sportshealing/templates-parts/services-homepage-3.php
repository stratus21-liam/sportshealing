<?php
$service_posts = sportshealing_acf_section_posts('posts', 'sh_service', 4);
$services_button_label = sportshealing_acf_section_text('button_label') ?: __('View All Services', 'sportshealing');
$services_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('services.html', ''));
?>
<!-- services section start -->
                <section class="services-section-3 pt-100 md-pt-80 pb-70 md-pb-50" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/shape/bg-shape-1.png')); ?>">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-4">
                                <div class="services-content">
                                    <div class="section-title">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="service-button-wappper">
                                        <a href="<?php echo esc_url($services_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($services_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($services_button_label); ?>"><?php echo esc_html($services_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <?php foreach ($service_posts as $index => $service_post) : ?>
                                        <?php
                                        $service_title = get_the_title($service_post);
                                        $service_copy = wp_trim_words(get_the_excerpt($service_post), 14);
                                        $service_image = sportshealing_content_field_image_url((int) $service_post->ID, 'sportshealing_service_detail_image', 'assets/images/services/services-3-' . (($index % 6) + 1) . '.jpg');
                                        $service_icon = sportshealing_content_field_image_url((int) $service_post->ID, 'sportshealing_service_icon', 'assets/images/joint-icon-29.png');
                                        ?>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="service-item<?php echo $index === 0 ? ' active' : ''; ?> wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.2 + ($index * 0.1), 1)); ?>s">
                                                <div class="service-image">
                                                    <figure>
                                                        <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                                    </figure>
                                                </div>
                                                <div class="service-icon">
                                                    <figure>
                                                        <img src="<?php echo esc_url($service_icon); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                                    </figure>
                                                </div>
                                                <div class="service-content">
                                                    <h3><?php echo esc_html($service_title); ?></h3>
                                                    <p><?php echo esc_html($service_copy); ?></p>
                                                    <a href="<?php echo esc_url(get_permalink($service_post)); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- services section end -->
