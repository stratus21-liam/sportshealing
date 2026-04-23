<!-- faq section start -->
                <section class="faq-section-1 pt-100 md-pt-80">
                    <div class="container">
                        <!-- faq wapper start -->
                        <div class="faq-wapper">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- section title start -->
                                    <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <!-- section title end -->
                                    <!-- faq image start -->
                                    <div class="faq-image wow fadeInUp" data-wow-delay=".3s">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/faqs/faqs-1-1.jpg')); ?>" alt="faq image one">
                                        </figure>
                                    </div>
                                    <!-- faq image end -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- faq-content start -->
                                    <div class="faq-content wow fadeInUp" data-wow-delay=".2s">
                                        <!-- accordion start -->
                                        <?php
                                        $faq_items = sportshealing_acf_section_items();
                                        $accordion_id = 'accordion-' . sanitize_html_class(sportshealing_current_section_key() ?: 'faq');
                                        ?>
                                        <div class="accordion" id="<?php echo esc_attr($accordion_id); ?>">
                                            <?php foreach ($faq_items as $index => $faq_item) : ?>
                                                <?php
                                                $heading_id = $accordion_id . '-heading-' . ($index + 1);
                                                $collapse_id = $accordion_id . '-collapse-' . ($index + 1);
                                                $is_open = $index === 0;
                                                ?>
                                                <!-- accordion item start -->
                                                <div class="accordion-item">
                                                    <!-- accordion-header start -->
                                                    <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                                                        <button class="accordion-button<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                                            <?php echo esc_html($faq_item['title'] ?? ''); ?>
                                                        </button>
                                                    </h2>
                                                    <!-- accordion header end -->
                                                    <!-- accordion collapse start -->
                                                    <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-bs-parent="#<?php echo esc_attr($accordion_id); ?>">
                                                        <!-- accordion body start -->
                                                        <div class="accordion-body">
                                                            <div class="inner">
                                                                <div class="accordion-content">
                                                                    <p><?php echo wp_kses_post($faq_item['copy'] ?? ''); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- accordion body end -->
                                                    </div>
                                                    <!-- accordion collapse end -->
                                                </div>
                                                <!-- accordion item end -->
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- accordion end -->
                                    </div>
                                    <!-- faq-content end -->
                                </div>
                            </div>
                        </div>
                        <!-- faq wapper end -->
                    </div>
                </section>
                <!-- faq section end -->
