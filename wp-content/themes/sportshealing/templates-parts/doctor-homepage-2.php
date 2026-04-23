<?php
$doctor_posts = sportshealing_acf_section_posts('posts', 'sh_doctor', 4);
$doctor_fallbacks = ['assets/images/doctor/doctor-1.jpg', 'assets/images/doctor/doctor-2.jpg', 'assets/images/doctor/doctor-3.jpg', 'assets/images/doctor/doctor-4.jpg'];
?>
<!-- doctor section start -->
                <section class="doctor-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="section-title-content wow fadeInRight" data-wow-delay=".2s">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="swiper doctor-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($doctor_posts as $index => $doctor_post) : ?>
                                            <?php $doctor_social_links = sportshealing_repeater_value((int) $doctor_post->ID, 'sportshealing_doctor_social_links'); ?>
                                            <div class="swiper-slide">
                                                <div class="doctor-item">
                                                    <div class="doctor-image">
                                                        <figure>
                                                            <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $doctor_post->ID, 'sportshealing_doctor_listing_image', $doctor_fallbacks[$index] ?? 'assets/images/doctor/doctor-1.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($doctor_post)); ?>">
                                                        </figure>
                                                        <div class="doctor-overlay">
                                                            <?php if ($doctor_social_links) : ?>
                                                                <div class="doctor-social-media">
                                                                    <?php sportshealing_render_social_links($doctor_social_links, ''); ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="doctor-content">
                                                        <h3><a href="<?php echo esc_url(get_permalink($doctor_post)); ?>"><?php echo esc_html(get_the_title($doctor_post)); ?></a></h3>
                                                        <p><?php echo esc_html(sportshealing_meta_value((int) $doctor_post->ID, 'sportshealing_doctor_role')); ?></p>
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
                <!-- doctor section end -->
