<!-- appointment homepage 1 section start -->
                <section class="appointment-section-1">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-1 order-2">
                                <!-- appointment image start -->
                                <div class="appointment-image">
                                    <figure>
                                        <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/appointment/appointment-1-1.png')); ?>" alt="appointment image one">
                                    </figure>
                                </div>
                                <!-- appointment image end -->
                            </div>
                            <div class="col-lg-6 order-lg-2 order-1">
                                <!-- appointment wapper start -->
                                <div class="appointment-wapper">
                                    <!-- section-title start -->
                                    <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <!-- section-title end -->
                                    <!-- default form start -->
                                    <div class="default-form appointment-form wow fadeInUp" data-wow-delay=".3s">
                                        <?php $appointment_form_shortcode = sportshealing_acf_section_text('form_shortcode'); ?>
                                        <?php if ($appointment_form_shortcode) : ?>
                                            <?php echo do_shortcode($appointment_form_shortcode); ?>
                                        <?php elseif (current_user_can('edit_pages')) : ?>
                                            <p><?php esc_html_e('Add a Contact Form 7 shortcode in the Appointment section to show the form here.', 'sportshealing'); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <!-- default form end -->
                                </div>
                                <!-- appointment wapper end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- appointment section end -->
