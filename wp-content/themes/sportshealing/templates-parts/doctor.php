<?php
$doctor_posts = sportshealing_acf_section_posts('posts', 'sh_doctor', 4);
$doctor_fallbacks = ['assets/images/doctor/doctor-1.jpg', 'assets/images/doctor/doctor-2.jpg', 'assets/images/doctor/doctor-3.jpg', 'assets/images/doctor/doctor-4.jpg'];
?>
<!-- doctor section start -->
                <section class="doctor-section-3 pt-100 md-pt-80 pb-70 md-pb-50">
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
                            <?php foreach ($doctor_posts as $index => $doctor_post) : ?>
                                <?php
                                $doctor_social_links = sportshealing_repeater_value((int) $doctor_post->ID, 'sportshealing_doctor_social_links');
                                $doctor_role = sportshealing_meta_value((int) $doctor_post->ID, 'sportshealing_doctor_role');
                                $doctor_review = sportshealing_meta_value((int) $doctor_post->ID, 'sportshealing_doctor_review_text');
                                ?>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <!-- doctor items start -->
                                    <div class="doctor-items wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                        <!-- doctor image start -->
                                        <div class="doctor-image">
                                            <a href="<?php echo esc_url(get_permalink($doctor_post)); ?>">
                                                <figure class="image-anime">
                                                    <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $doctor_post->ID, 'sportshealing_doctor_listing_image', $doctor_fallbacks[$index] ?? 'assets/images/doctor/doctor-1.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($doctor_post)); ?>">
                                                </figure>
                                            </a>
                                            <div class="doctor-share">
                                                <?php sportshealing_render_social_links($doctor_social_links, 'social-icon social-vertical'); ?>
                                                <div class="doctor-share-icon">
                                                    <i class="fa-solid fa-share-nodes"></i>
                                                </div>
                                            </div>
                                            <?php if ($doctor_review) : ?>
                                                <div class="doctor-review">
                                                    <p><?php echo esc_html($doctor_review); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <!-- doctor image end -->
                                        <!-- doctor content start -->
                                        <div class="doctor-content">
                                            <h3><a href="<?php echo esc_url(get_permalink($doctor_post)); ?>"><?php echo esc_html(get_the_title($doctor_post)); ?></a></h3>
                                            <p><?php echo esc_html($doctor_role); ?></p>
                                        </div>
                                        <!-- doctor content end -->
                                    </div>
                                    <!-- doctor items end -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <!-- doctor section end -->
