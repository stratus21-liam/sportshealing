<?php
$about_tabs = sportshealing_acf_section_value('tabs');
$about_tabs = is_array($about_tabs) && $about_tabs ? $about_tabs : sportshealing_acf_section_items();
$about_section_id = sanitize_html_class(sportshealing_current_section_key() ?: 'about-homepage-3');
$about_button_label = sportshealing_acf_section_text('button_label') ?: __('More About', 'sportshealing');
$about_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('about.html', ''));
?>
<!-- about section start -->
                <section class="about-section-3 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="about-shape-3">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', sportshealing_acf_section_image_url('assets/images/about/about-shape-5.png'))); ?>" alt="about shape one">
                        </figure>
                    </div>
                    <div class="about-shape-4">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_2', 'assets/images/about/about-shape-6.png')); ?>" alt="about shape two">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 order-lg-1 order-2">
                                <div class="about-images-box wow fadeInLeft" data-wow-delay=".3s">
                                    <figure class="image-anime">
                                        <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('left_image', 'assets/images/about/about-3-1.jpg')); ?>" alt="about one">
                                    </figure>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-2 order-1">
                                <div class="about-content wow fadeInRight" data-wow-delay=".3s">
                                    <div class="about-tabs">
                                        <nav>
                                            <div class="nav nav-tabs" id="<?php echo esc_attr($about_section_id); ?>-tab" role="tablist">
                                                <?php foreach ($about_tabs as $index => $about_tab) : ?>
                                                    <?php
                                                    $tab_title = !empty($about_tab['title']) ? (string) $about_tab['title'] : sprintf(__('Tab %d', 'sportshealing'), $index + 1);
                                                    $tab_id = $about_section_id . '-tab-' . ($index + 1);
                                                    ?>
                                                    <button class="nav-link<?php echo $index === 0 ? ' active' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>-button" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($tab_title); ?></button>
                                                <?php endforeach; ?>
                                            </div>
                                        </nav>
                                        <div class="tab-content">
                                            <?php foreach ($about_tabs as $index => $about_tab) : ?>
                                                <?php
                                                $tab_id = $about_section_id . '-tab-' . ($index + 1);
                                                $checklist = !empty($about_tab['checklist']) && is_string($about_tab['checklist']) ? array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $about_tab['checklist']))) : [];
                                                ?>
                                                <div class="tab-pane fade<?php echo $index === 0 ? ' active show' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>-button" tabindex="0">
                                                    <div class="tab-desc">
                                                        <p><?php echo esc_html($about_tab['copy'] ?? ''); ?></p>
                                                    </div>
                                                    <?php if ($checklist) : ?>
                                                        <div class="check-list-two-col">
                                                            <ul>
                                                                <?php foreach ($checklist as $checklist_item) : ?>
                                                                    <li><?php echo esc_html($checklist_item); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="about-button-wappper">
                                                        <a href="<?php echo esc_url($about_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($about_button_label); ?>">
                                                            <span data-text="<?php echo esc_attr($about_button_label); ?>"><?php echo esc_html($about_button_label); ?></span>
                                                            <i class="fa-solid fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="about-images-box">
                                        <figure class="image-anime">
                                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('right_image', 'assets/images/about/about-3-2.jpg')); ?>" alt="about two">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- about section end -->
