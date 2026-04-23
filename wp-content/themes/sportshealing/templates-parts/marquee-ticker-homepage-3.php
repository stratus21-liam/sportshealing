<!-- marquee ticker section start -->
                <div class="marquee-ticker-section primary-bg">
                    <div class="marquee-ticker-box">
                        <?php
                        $marquee_items = sportshealing_acf_section_items();
                        $marquee_chunks = array_chunk(array_slice($marquee_items, 0, 10), 5);
                        ?>
                        <?php foreach ($marquee_chunks as $marquee_chunk) : ?>
                            <div class="marquee-content">
                                <?php foreach ($marquee_chunk as $index => $marquee_item) : ?>
                                    <?php
                                    $marquee_text = !empty($marquee_item['copy']) ? (string) $marquee_item['copy'] : '';
                                    $marquee_image = sportshealing_media_url($marquee_item['image'] ?? '', 'assets/images/joint-icon-29.png');
                                    ?>
                                    <?php if ($marquee_text) : ?>
                                        <div class="marquee-icon">
                                            <img src="<?php echo esc_url($marquee_image); ?>" alt="<?php echo esc_attr(sprintf(__('marquee image %d', 'sportshealing'), $index + 1)); ?>">
                                        </div>
                                        <p data-text="<?php echo esc_attr($marquee_text); ?>"><?php echo esc_html($marquee_text); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- marquee ticker section end -->
