<!-- appointment section start -->
                <section class="appointment-section-4 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row flex-lg-row-reverse justify-content-between align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="appointment-content wow fadeInLeft" data-wow-delay=".2s">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="section-title">
                                                <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                                <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="default-form appointment-form">
                                        <?php $appointment_form_shortcode = sportshealing_acf_section_text('form_shortcode'); ?>
                                        <?php if ($appointment_form_shortcode) : ?>
                                            <?php echo do_shortcode($appointment_form_shortcode); ?>
                                        <?php elseif (current_user_can('edit_pages')) : ?>
                                            <p><?php esc_html_e('Add a Contact Form 7 shortcode in the Appointment section to show the form here.', 'sportshealing'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="appointment-image wow fadeInRight" data-wow-delay=".2s">
                                    <div class="shape-1"><img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', 'assets/images/shape/shape-1.png')); ?>" alt="appointment shape"></div>
                                    <div class="img1">
                                        <figure>
                                            <img class="appointment-large" src="<?php echo esc_url(sportshealing_acf_section_named_image_url('large_image', 'assets/images/appointment/appointment-4-1.jpg')); ?>" alt="appointment large">
                                        </figure>
                                    </div>
                                    <div class="img2">
                                        <figure>
                                            <img class="appointment-small" src="<?php echo esc_url(sportshealing_acf_section_named_image_url('small_image', 'assets/images/appointment/appointment-4-2.jpg')); ?>" alt="appointment small">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- appointment section end -->
