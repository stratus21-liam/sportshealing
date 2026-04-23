<!-- micon section start -->
                <section class="micon-section pt-100 md-pt-80 pb-70 md-pb-50">
                    <div class="container">
                        <?php
                        $micon_items = sportshealing_acf_section_items();
                        $micon_fallbacks = [
                            'assets/images/joint-icon-29.png',
                            'assets/images/joint-icon-29.png',
                            'assets/images/joint-icon-29.png',
                        ];
                        $micon_classes = ['micon-items-one', 'micon-items-two', 'micon-items-three'];
                        ?>
                        <div class="row">
                            <?php foreach (array_slice($micon_items, 0, 3) as $index => $micon_item) : ?>
                                <?php
                                $micon_title = !empty($micon_item['title']) ? (string) $micon_item['title'] : '';
                                $micon_copy = !empty($micon_item['copy']) ? (string) $micon_item['copy'] : '';
                                $micon_url = !empty($micon_item['url']) ? (string) $micon_item['url'] : '';
                                $micon_image = sportshealing_media_url($micon_item['image'] ?? '', $micon_fallbacks[$index] ?? 'assets/images/joint-icon-29.png');
                                $micon_class = $micon_classes[$index] ?? 'micon-items-one';
                                $micon_background_colour = !empty($micon_item['background_colour']) && sanitize_hex_color($micon_item['background_colour']) ? sanitize_hex_color($micon_item['background_colour']) : '';
                                ?>
                                <div class="col-lg-4 col-md-12">
                                    <!-- micon items start -->
                                    <div class="micon-items <?php echo esc_attr($micon_class); ?> wow fadeInUp" data-wow-delay="<?php echo esc_attr('.' . ($index + 2) . 's'); ?>"<?php echo $micon_background_colour ? ' style="background-color: ' . esc_attr($micon_background_colour) . ';"' : ''; ?>>
                                        <div class="micon-icon">
                                            <figure>
                                                <img src="<?php echo esc_url($micon_image); ?>" alt="<?php echo esc_attr($micon_title ?: __('Micon item', 'sportshealing')); ?>">
                                            </figure>
                                        </div>
                                        <div class="micon-content">
                                            <?php if ($micon_title) : ?>
                                                <h2><?php echo esc_html($micon_title); ?></h2>
                                            <?php endif; ?>
                                            <?php if ($micon_copy) : ?>
                                                <p><?php echo esc_html($micon_copy); ?></p>
                                            <?php endif; ?>
                                            <?php if ($micon_url) : ?>
                                                <div class="micon-button">
                                                    <a href="<?php echo esc_url($micon_url); ?>" class="read-more-btn"><?php esc_html_e('Read More', 'sportshealing'); ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- micon items end -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <!-- micon section end -->
