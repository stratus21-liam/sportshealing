<?php
$work_items = sportshealing_acf_section_items();
$work_classes = ['work-process-one', 'work-process-two', 'work-process-three'];
?>
<!-- how it work start -->
                <section class="how-it-work-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="work-process-list">
                                    <?php foreach ($work_items as $index => $work_item) : ?>
                                        <div class="work-process-item <?php echo esc_attr($work_classes[$index] ?? ''); ?> wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                            <?php if ($index < 2) : ?>
                                                <div class="work-process-line">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('line_' . ($index + 1), 'assets/images/shape/line-' . ($index + 1) . '.png')); ?>" alt="<?php echo esc_attr(sprintf(__('Line %d', 'sportshealing'), $index + 1)); ?>">
                                                    </figure>
                                                </div>
                                            <?php endif; ?>
                                            <div class="work-process-icon">
                                                <div class="icon">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($work_item['image'] ?? '', 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($work_item['title'] ?? __('Work step', 'sportshealing')); ?>">
                                                    </figure>
                                                </div>
                                                <div class="work-process-num"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></div>
                                            </div>
                                            <div class="work-process-content">
                                                <h3><?php echo esc_html($work_item['title'] ?? ''); ?></h3>
                                                <p><?php echo esc_html($work_item['copy'] ?? ''); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- how it work end -->
