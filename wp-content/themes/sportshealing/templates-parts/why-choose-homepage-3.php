<?php
$why_tabs = sportshealing_acf_section_value('tabs');
$why_tabs = is_array($why_tabs) ? $why_tabs : [];
$why_id = sanitize_html_class(sportshealing_current_section_key() ?: 'why-choose');
?>
<!-- why-section start -->
                <section class="why-choose-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="why-choose-shape-1">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', 'assets/images/why-choose/why-choose-shape-1.png')); ?>" alt="why choose shape one">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <div class="why-choose-tab">
                                    <div class="why-choose-top">
                                        <nav>
                                            <div class="nav nav-tabs" id="<?php echo esc_attr($why_id); ?>-tab" role="tablist">
                                                <?php foreach ($why_tabs as $index => $why_tab) : ?>
                                                    <?php $tab_id = $why_id . '-' . ($index + 1); ?>
                                                    <button class="nav-link<?php echo $index === 0 ? ' active' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>-button" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                                        <span class="nav-link-icon"><img src="<?php echo esc_url(sportshealing_media_url($why_tab['icon'] ?? '', 'assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($why_tab['tab_title'] ?? __('Why choose tab', 'sportshealing')); ?>"></span>
                                                        <?php echo esc_html($why_tab['tab_title'] ?? ''); ?>
                                                    </button>
                                                <?php endforeach; ?>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="tab-content">
                                        <?php foreach ($why_tabs as $index => $why_tab) : ?>
                                            <?php
                                            $tab_id = $why_id . '-' . ($index + 1);
                                            $details = !empty($why_tab['details']) && is_array($why_tab['details']) ? $why_tab['details'] : [];
                                            $stats = !empty($why_tab['stats']) && is_array($why_tab['stats']) ? $why_tab['stats'] : [];
                                            $lines = !empty($why_tab['lines']) && is_string($why_tab['lines']) ? array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $why_tab['lines']))) : [];
                                            ?>
                                            <div class="tab-pane fade<?php echo $index === 0 ? ' active show' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>-button" tabindex="0">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="why-choose-tab-content">
                                                            <h3><?php echo esc_html($why_tab['title'] ?? ''); ?></h3>
                                                            <p class="desc"><?php echo wp_kses_post($why_tab['copy'] ?? ''); ?></p>
                                                            <?php if ($details) : ?>
                                                                <div class="case-box-wapper">
                                                                    <?php foreach ($details as $detail) : ?>
                                                                        <div class="case-box-item">
                                                                            <h4><?php echo esc_html($detail['title'] ?? ''); ?></h4>
                                                                            <p><?php echo esc_html($detail['copy'] ?? ''); ?></p>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($stats) : ?>
                                                                <div class="skill-progress-wapper pt-10">
                                                                    <?php foreach ($stats as $stat) : ?>
                                                                        <div class="single-progressbar">
                                                                            <div class="progress-title"><?php echo esc_html($stat['label'] ?? ''); ?></div>
                                                                            <div class="progressbar">
                                                                                <div class="progress-bar-count counted" data-percent="<?php echo esc_attr($stat['percent'] ?? '0%'); ?>"></div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($lines) : ?>
                                                                <div class="opening-hours">
                                                                    <?php foreach ($lines as $line) : ?>
                                                                        <p><?php echo esc_html($line); ?></p>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="why-choose-tab-image">
                                                            <figure class="image-anime">
                                                                <img src="<?php echo esc_url(sportshealing_media_url($why_tab['image'] ?? '', 'assets/images/why-choose/why-choose-img-2-1.jpg')); ?>" alt="<?php echo esc_attr($why_tab['title'] ?? __('Why choose image', 'sportshealing')); ?>">
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- why-section end -->
