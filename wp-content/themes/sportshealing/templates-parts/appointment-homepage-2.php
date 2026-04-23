<?php
$appointment_steps = sportshealing_acf_section_items();
$appointment_form_title = sportshealing_acf_section_text('form_title') ?: __('Appointment', 'sportshealing');
?>
<!-- appointment section start -->
                <section class="appointment-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="appointment-box">
                                    <div class="appointment-process-content wow fadeInUp" data-wow-delay=".2s">
                                        <div class="section-title">
                                            <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                            <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        </div>
                                        <div class="appointment-process-list">
                                            <?php foreach ($appointment_steps as $index => $appointment_step) : ?>
                                                <div class="appointment-process-item">
                                                    <div class="appointment-process-icon">
                                                        <figure>
                                                            <img src="<?php echo esc_url(sportshealing_media_url($appointment_step['image'] ?? '', 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($appointment_step['title'] ?? __('Appointment step', 'sportshealing')); ?>">
                                                        </figure>
                                                    </div>
                                                    <div class="appointment-process-title">
                                                        <h3><?php echo esc_html($appointment_step['title'] ?? ''); ?></h3>
                                                        <p><?php echo esc_html($appointment_step['copy'] ?? ''); ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="request-quote-box wow fadeInUp" data-wow-delay=".3s">
                                        <div class="section-title">
                                            <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('form_eyebrow') ?: __('Appointment', 'sportshealing')); ?></span>
                                            <h2><?php echo esc_html($appointment_form_title); ?></h2>
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
                            </div>
                        </div>
                    </div>
                </section>
                <!-- appointment section end -->
