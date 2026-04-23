<?php
$doctor_posts = sportshealing_acf_section_posts('posts', 'sh_doctor', 5);
$doctor_fallbacks = ['assets/images/doctor/doctor-1-1.png', 'assets/images/doctor/doctor-1-2.jpg', 'assets/images/doctor/doctor-1-3.jpg', 'assets/images/doctor/doctor-1-4.jpg', 'assets/images/doctor/doctor-1-5.jpg'];
?>
<!-- doctor section start -->
                <section class="doctor-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
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
                        <div class="row align-items-center">
                            <?php if (!empty($doctor_posts[0])) : ?>
                                <?php
                                $featured_doctor = $doctor_posts[0];
                                $featured_social_links = sportshealing_repeater_value((int) $featured_doctor->ID, 'sportshealing_doctor_social_links');
                                ?>
                                <div class="col-lg-5">
                                    <div class="doctor-image-wrapper wow fadeInUp" data-wow-delay=".3s">
                                        <div class="doctor-image-item">
                                            <figure>
                                                <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $featured_doctor->ID, 'sportshealing_doctor_listing_image', $doctor_fallbacks[0])); ?>" alt="<?php echo esc_attr(get_the_title($featured_doctor)); ?>">
                                            </figure>
                                            <div class="doctor-overlay">
                                                <div class="doctor-overlay-content">
                                                    <h3><?php echo esc_html(get_the_title($featured_doctor)); ?></h3>
                                                    <p><?php echo esc_html(sportshealing_meta_value((int) $featured_doctor->ID, 'sportshealing_doctor_role')); ?></p>
                                                    <div class="doctor-overlay-meta">
                                                        <?php if ($featured_social_links) : ?>
                                                            <div class="doctor-social-media">
                                                                <?php sportshealing_render_social_links($featured_social_links, ''); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-lg-7">
                                <div class="doctor-list">
                                    <?php foreach (array_slice($doctor_posts, 1, 4) as $index => $doctor_post) : ?>
                                        <div class="doctor-item wow fadeInUp" data-wow-delay="<?php echo esc_attr('.' . ($index + 4) . 's'); ?>">
                                            <div class="doctor-item-image">
                                                <a href="<?php echo esc_url(get_permalink($doctor_post)); ?>">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $doctor_post->ID, 'sportshealing_doctor_listing_image', $doctor_fallbacks[$index + 1] ?? 'assets/images/doctor/doctor-1-2.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($doctor_post)); ?>">
                                                    </figure>
                                                </a>
                                            </div>
                                            <div class="doctor-item-content">
                                                <h3><a href="<?php echo esc_url(get_permalink($doctor_post)); ?>"><?php echo esc_html(get_the_title($doctor_post)); ?></a></h3>
                                                <p><?php echo esc_html(sportshealing_meta_value((int) $doctor_post->ID, 'sportshealing_doctor_role')); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- doctor section end -->
