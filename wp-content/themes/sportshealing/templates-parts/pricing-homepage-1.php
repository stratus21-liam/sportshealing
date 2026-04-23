<!-- pricing section start -->
                <section class="pricing-section-1 bg-section pt-100 md-pt-80 pb-70 md-pb-50">
                    <div class="container">
                        <?php
                        $pricing_groups = sportshealing_acf_section_value('groups');
                        $pricing_groups = is_array($pricing_groups) ? $pricing_groups : [];
                        $section_id = sanitize_title(sportshealing_current_section_key());
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- section title area start -->
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="section-title-content wow fadeInRight" data-wow-delay=".2s">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                </div>
                                <!-- section title area end -->
                            </div>
                        </div>
                        <?php if ($pricing_groups) : ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- pricing tabs start -->
                                    <div class="pricing-tabs wow fadeInUp" data-wow-delay=".3s">
                                        <!-- nav start -->
                                        <nav>
                                            <div class="nav nav-tabs" id="<?php echo esc_attr($section_id); ?>-tab" role="tablist">
                                                <?php foreach ($pricing_groups as $group_index => $pricing_group) : ?>
                                                    <?php $tab_id = $section_id . '-' . sanitize_title($pricing_group['group_name'] ?? 'group-' . $group_index); ?>
                                                    <button class="nav-link<?php echo $group_index === 0 ? ' active' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($tab_id); ?>" type="button" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $group_index === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($pricing_group['group_name'] ?? __('Pricing', 'sportshealing')); ?></button>
                                                <?php endforeach; ?>
                                            </div>
                                        </nav>
                                        <!-- nav end -->
                                    </div>
                                    <!-- pricing tabs end -->
                                </div>
                            </div>
                            <!-- tab content start -->
                            <div class="tab-content wow fadeInUp" data-wow-delay=".4s">
                                <?php foreach ($pricing_groups as $group_index => $pricing_group) : ?>
                                    <?php
                                    $tab_id = $section_id . '-' . sanitize_title($pricing_group['group_name'] ?? 'group-' . $group_index);
                                    $pricing_items = !empty($pricing_group['items']) && is_array($pricing_group['items']) ? $pricing_group['items'] : [];
                                    ?>
                                    <!-- tab pane start -->
                                    <div class="tab-pane fade<?php echo $group_index === 0 ? ' active show' : ''; ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>-tab" tabindex="0">
                                        <div class="row align-items-center">
                                            <?php foreach ($pricing_items as $pricing_item) : ?>
                                                <?php
                                                $is_highlighted = !empty($pricing_item['highlighted']);
                                                $button_label = !empty($pricing_item['button_label']) ? (string) $pricing_item['button_label'] : 'Choose Plan';
                                                $button_url = !empty($pricing_item['button_url']) ? (string) $pricing_item['button_url'] : sportshealing_static_url('pricing.html', '');
                                                $features = !empty($pricing_item['features']) ? preg_split('/\r\n|\r|\n/', (string) $pricing_item['features']) : [];
                                                ?>
                                                <div class="col-lg-4 col-md-12">
                                                    <!-- pricing item start -->
                                                    <div class="pricing-item<?php echo $is_highlighted ? ' tagged' : ''; ?>">
                                                        <!-- pricing content start -->
                                                        <div class="pricing-content">
                                                            <!-- pricing text start -->
                                                            <div class="pricing-text">
                                                                <?php if (!empty($pricing_item['label'])) : ?><p class="pricing-plan-title"><?php echo esc_html((string) $pricing_item['label']); ?></p><?php endif; ?>
                                                                <h3 class="pricing-plan-price monthly_text"><?php echo esc_html((string) ($pricing_item['price'] ?? '')); ?><?php if (!empty($pricing_item['price_suffix'])) : ?><span><?php echo esc_html((string) $pricing_item['price_suffix']); ?></span><?php endif; ?></h3>
                                                                <?php if (!empty($pricing_item['description'])) : ?><p<?php echo $is_highlighted ? ' class="text-white"' : ''; ?>><?php echo esc_html((string) $pricing_item['description']); ?></p><?php endif; ?>
                                                            </div>
                                                            <!-- pricing text end -->
                                                            <!-- pricing list start -->
                                                            <div class="pricing-list">
                                                                <?php if (!empty($pricing_item['feature_intro'])) : ?><p class="<?php echo $is_highlighted ? 'text-white' : 'text-black'; ?>"><?php echo esc_html((string) $pricing_item['feature_intro']); ?></p><?php endif; ?>
                                                                <?php if ($features) : ?>
                                                                    <div class="check-list mb-30"><ul><?php foreach ($features as $feature) : ?><?php if (trim($feature) !== '') : ?><li><?php echo esc_html(trim($feature)); ?></li><?php endif; ?><?php endforeach; ?></ul></div>
                                                                <?php endif; ?>
                                                                <!-- pricing button wapper start -->
                                                                <div class="pricing-button-wapper">
                                                                    <a href="<?php echo esc_url($button_url); ?>" class="theme-button <?php echo $is_highlighted ? 'style-4' : 'style-2'; ?>" aria-label="<?php echo esc_attr($button_label); ?>">
                                                                        <span data-text="<?php echo esc_attr($button_label); ?>"><?php echo esc_html($button_label); ?></span>
                                                                        <i class="fa-solid fa-arrow-right"></i>
                                                                    </a>
                                                                </div>
                                                                <!-- pricing button wapper end -->
                                                            </div>
                                                            <!-- pricing list end -->
                                                        </div>
                                                        <!-- pricing content end -->
                                                    </div>
                                                    <!-- pricing item end -->
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- tab pane end -->
                                <?php endforeach; ?>
                            </div>
                            <!-- tab content end -->
                        <?php endif; ?>
                    </div>
                </section>
                <!-- pricing section end -->
