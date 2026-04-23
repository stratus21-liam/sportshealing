<?php
$about_paragraphs = sportshealing_acf_section_value('paragraphs');
$about_paragraphs = is_array($about_paragraphs) ? $about_paragraphs : [];
$about_features = sportshealing_acf_section_items();
?>
<!-- about section start -->
                <section class="about-section-4 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-12">
                                <div class="section-title mb-20 wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-12">
                                <div class="about-content wow fadeInUp" data-wow-delay=".3s">
                                    <div class="about-content-text">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                        <?php foreach ($about_paragraphs as $about_paragraph) : ?>
                                            <?php if (!empty($about_paragraph['copy'])) : ?>
                                                <p><?php echo esc_html($about_paragraph['copy']); ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="about-features-wappper">
                                        <?php foreach ($about_features as $index => $about_feature) : ?>
                                            <div class="about-features-item">
                                                <div class="about-features-icon">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($about_feature['image'] ?? '', 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($about_feature['title'] ?? __('About feature', 'sportshealing')); ?>">
                                                    </figure>
                                                </div>
                                                <div class="about-features-title">
                                                    <h3><?php echo esc_html($about_feature['title'] ?? ''); ?></h3>
                                                    <p><?php echo esc_html($about_feature['copy'] ?? ''); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- about section end -->
