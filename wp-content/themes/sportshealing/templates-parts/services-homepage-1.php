<?php
$service_posts = sportshealing_acf_section_posts('posts', 'sh_service', 6);
?>
<!-- services section start -->
                <section class="services-section-1 background-one pt-100 md-pt-80 pb-100 md-pb-80" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/shape/bg-shape-1.png')); ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- section title area start -->
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="section-title-content wow fadeInRight" data-wow-delay=".2s">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                </div>
                                <!-- section title area end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="swiper services-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($service_posts as $index => $service_post) : ?>
                                            <?php
                                            $service_title = get_the_title($service_post);
                                            $service_copy = wp_trim_words(get_the_excerpt($service_post), 18);
                                            $service_icon = sportshealing_content_field_image_url((int) $service_post->ID, 'sportshealing_service_icon', 'assets/images/joint-icon-29.png');
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="service-items">
                                                    <div class="service-icon">
                                                        <figure>
                                                            <img src="<?php echo esc_url($service_icon); ?>" alt="<?php echo esc_attr($service_title); ?>">
                                                        </figure>
                                                    </div>
                                                    <div class="service-content">
                                                        <h2><?php echo esc_html($service_title); ?></h2>
                                                        <p><?php echo esc_html($service_copy); ?></p>
                                                        <a href="<?php echo esc_url(get_permalink($service_post)); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="swiper-actions text-center">
                                        <div class="dot"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- services section end -->
