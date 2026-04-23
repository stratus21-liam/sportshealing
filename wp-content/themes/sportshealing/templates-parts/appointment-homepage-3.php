<!-- appointment section start -->
                <section class="appointment-section-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appointment-box">
                                    <!-- appointment content start -->
                                    <div class="appointment-content wow fadeInUp" data-wow-delay=".2s">
                                        <!-- section title start -->
                                        <div class="section-title">
                                            <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                            <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        </div>
                                        <!-- section title end -->
                                        <!-- appointment image start -->
                                        <div class="appointment-image">
                                            <figure class="image-anime">
                                                <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/appointment/appointment-3-1.jpg')); ?>" alt="appointment image">
                                            </figure>
                                        </div>
                                        <!-- appointment image end -->
                                    </div>
                                    <!-- appointment content end -->
                                    <!-- appointment form box start -->
                                    <div class="appointment-form-box wow fadeInUp" data-wow-delay=".3s">
                                        <!-- default form start -->
                                        <div class="default-form appointment-form">
                                            <?php $appointment_form_shortcode = sportshealing_acf_section_text('form_shortcode'); ?>
                                            <?php if ($appointment_form_shortcode) : ?>
                                                <?php echo do_shortcode($appointment_form_shortcode); ?>
                                            <?php elseif (current_user_can('edit_pages')) : ?>
                                                <p><?php esc_html_e('Add a Contact Form 7 shortcode in the Appointment section to show the form here.', 'sportshealing'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <!-- default form end -->
                                    </div>
                                    <!-- appointment form box end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- appointment section end -->
