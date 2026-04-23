<?php
$why_features = sportshealing_acf_section_items();
$why_checklist = sportshealing_acf_section_value('checklist_items');
$why_checklist = is_array($why_checklist) ? $why_checklist : [];
$why_about_url = sportshealing_acf_section_page_url('circle_page', sportshealing_static_url('about.html', ''));
?>
<!-- why-section start -->
                <section class="why-choose-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12">
                                <div class="why-content">
                                    <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="why-choose-box-list wow fadeInUp" data-wow-delay=".3s">
                                        <?php foreach (array_slice($why_features, 0, 2) as $index => $why_feature) : ?>
                                            <div class="why-choose-box">
                                                <div class="icon-box">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($why_feature['image'] ?? '', 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($why_feature['title'] ?? __('Why choose item', 'sportshealing')); ?>">
                                                    </figure>
                                                </div>
                                                <div class="why-choose-box-content">
                                                    <h3><?php echo esc_html($why_feature['title'] ?? ''); ?></h3>
                                                    <p><?php echo esc_html($why_feature['copy'] ?? ''); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ($why_checklist) : ?>
                                        <div class="why-choose-list wow fadeInUp" data-wow-delay=".4s">
                                            <ul>
                                                <?php foreach ($why_checklist as $why_checklist_item) : ?>
                                                    <?php if (!empty($why_checklist_item['text'])) : ?>
                                                        <li><?php echo esc_html($why_checklist_item['text']); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="why-choose-image">
                                    <div class="why-choose-img-1">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('image_1', 'assets/images/why-choose/why-choose-img-1-1.jpg')); ?>" alt="why choose image one">
                                        </figure>
                                    </div>
                                    <div class="why-choose-img-2">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('image_2', 'assets/images/why-choose/why-choose-img-1-2.jpg')); ?>" alt="why choose image two">
                                        </figure>
                                    </div>
                                    <div class="why-choose-about-circle">
                                        <a class="about-circle" href="<?php echo esc_url($why_about_url); ?>" aria-label="<?php esc_attr_e('About us', 'sportshealing'); ?>">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('circle_image', 'assets/images/shape/round-about-us.png')); ?>" alt="round about us">
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- why-section end -->
