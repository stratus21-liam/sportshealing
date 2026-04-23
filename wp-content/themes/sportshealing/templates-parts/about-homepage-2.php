<?php
$about_checklist_items = sportshealing_acf_section_value('checklist_items');
$about_checklist_items = is_array($about_checklist_items) ? $about_checklist_items : [];
$about_button_label = sportshealing_acf_section_text('button_label') ?: __('More About', 'sportshealing');
$about_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('about.html', ''));
$about_contact_label = sportshealing_acf_section_text('contact_label') ?: __('Need help? Call us', 'sportshealing');
$about_contact_phone = sportshealing_acf_section_text('contact_phone') ?: '+1 234 467 88';
$about_stat_label = sportshealing_acf_section_text('stat_label') ?: __('Years of Experience', 'sportshealing');
$about_stat_value = sportshealing_acf_section_text('stat_value') ?: '25+';
?>
<!-- about section start -->
                <section class="about-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="about-shape-1">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', sportshealing_acf_section_image_url('assets/images/about/about-shape-3.png'))); ?>" alt="about shape one">
                        </figure>
                    </div>
                    <div class="about-shape-2">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_2', 'assets/images/about/about-shape-4.png')); ?>" alt="about shape two">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <!-- about content start -->
                                <div class="about-content">
                                    <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <?php if ($about_checklist_items) : ?>
                                        <div class="check-list-two-col wow fadeInUp" data-wow-delay=".3s">
                                            <ul>
                                                <?php foreach ($about_checklist_items as $about_checklist_item) : ?>
                                                    <?php if (!empty($about_checklist_item['text'])) : ?>
                                                        <li><?php echo esc_html($about_checklist_item['text']); ?></li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="about-footer wow fadeInUp" data-wow-delay=".4s">
                                        <div class="about-button-wappper">
                                            <a href="<?php echo esc_url($about_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($about_button_label); ?>">
                                                <span data-text="<?php echo esc_attr($about_button_label); ?>"><?php echo esc_html($about_button_label); ?></span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                        <div class="about-contact-box">
                                            <div class="icon-box">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="about-contact-box-content">
                                                <p><?php echo esc_html($about_contact_label); ?></p>
                                                <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $about_contact_phone)); ?>"><?php echo esc_html($about_contact_phone); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- about content end -->
                            </div>
                            <div class="col-lg-6">
                                <!-- about images box start -->
                                <div class="about-images-box">
                                    <div class="about-images-top wow fadeInUp" data-wow-delay=".2s">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('top_image', 'assets/images/about/about-2-1.jpg')); ?>" alt="about one">
                                        </figure>
                                    </div>
                                    <div class="about-images-bottom">
                                        <div class="about-year-counter wow fadeInLeft" data-wow-delay=".3s">
                                            <div class="about-year-icon">
                                                <figure>
                                                    <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('stat_icon', 'assets/images/joint-icon-29.png')); ?>" alt="about statistic icon">
                                                </figure>
                                            </div>
                                            <div class="about-year-content">
                                                <p><?php echo esc_html($about_stat_label); ?></p>
                                                <h3><?php echo esc_html($about_stat_value); ?></h3>
                                            </div>
                                        </div>
                                        <div class="about-year-images wow fadeInRight" data-wow-delay=".4s">
                                            <figure class="image-anime">
                                                <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('bottom_image', 'assets/images/about/about-2-2.jpg')); ?>" alt="about two">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <!-- about images box end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- about section end -->
