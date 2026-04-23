<?php
$about_features = sportshealing_acf_section_items();
$about_button_label = sportshealing_acf_section_text('button_label') ?: __('More About Us', 'sportshealing');
$about_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('about.html', ''));
?>
<!-- about section start -->
                <section class="about-section-1 pb-100 md-pb-80">
                    <div class="about-shape-1">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', sportshealing_acf_section_image_url('assets/images/about/about-shape-1.png'))); ?>" alt="about shape one">
                        </figure>
                    </div>
                    <div class="about-shape-2">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_2', 'assets/images/about/about-shape-2.png')); ?>" alt="about shape two">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12">
                                <!-- section title start -->
                                <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                </div>
                                <!-- section title end -->
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                                <!-- about image start -->
                                <div class="about-image">
                                    <div class="about-img-1 text-center">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('left_image', 'assets/images/about/about-1-1.jpg')); ?>" alt="about image one">
                                        </figure>
                                    </div>
                                </div>
                                <!-- about image end -->
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
                                <!-- about content start -->
                                <div class="about-content">
                                    <div class="about-features-wappper">
                                        <?php foreach ($about_features as $index => $about_feature) : ?>
                                            <div class="about-features-item">
                                                <div class="about-features-icon">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($about_feature['image'] ?? '', ['assets/images/joint-icon-29.png', 'assets/images/joint-icon-29.png', 'assets/images/joint-icon-29.png'][$index] ?? 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($about_feature['title'] ?? __('About feature', 'sportshealing')); ?>">
                                                    </figure>
                                                </div>
                                                <div class="about-features-title">
                                                    <h3><?php echo esc_html($about_feature['title'] ?? ''); ?></h3>
                                                    <p><?php echo esc_html($about_feature['copy'] ?? ''); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="about-button-wappper">
                                        <a href="<?php echo esc_url($about_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($about_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($about_button_label); ?>"><?php echo esc_html($about_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- about content end -->
                            </div>
                            <div class="col-lg-4 wow fadeInUp" data-wow-delay=".5s">
                                <!-- about image start -->
                                <div class="about-image">
                                    <div class="about-img-2">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('right_image', 'assets/images/about/about-1-2.jpg')); ?>" alt="about image two">
                                        </figure>
                                    </div>
                                </div>
                                <!-- about image end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- about section end -->
