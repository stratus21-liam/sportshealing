<?php $counter_items = sportshealing_acf_section_items(); ?>
<!-- counter section start -->
                <section class="counter-section-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="counter-list">
                                    <?php foreach ($counter_items as $index => $counter_item) : ?>
                                        <div class="counter-item wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.2 + ($index * 0.1), 1)); ?>s">
                                            <div class="counter-content">
                                                <div class="counter-text"><span class="counter-value" data-stop="<?php echo esc_attr($counter_item['value'] ?? '0'); ?>" data-speed="3000">0</span><?php echo esc_html($counter_item['suffix'] ?? '+'); ?></div>
                                                <h2 class="counter-title"><?php echo esc_html($counter_item['title'] ?? ''); ?></h2>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- counter section end -->
