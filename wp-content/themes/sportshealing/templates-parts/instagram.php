<?php
$instagram_items = sportshealing_acf_section_items();
?>
<!-- instagram section start -->
                <section class="instagram-section">
                    <div class="container-fluid">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="instagram-wapper">
                                    <div class="instagram-title wow fadeInUp" data-wow-delay=".2s">
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="instagram-list">
                                        <?php foreach ($instagram_items as $index => $instagram_item) : ?>
                                            <?php $instagram_url = !empty($instagram_item['url']) ? (string) $instagram_item['url'] : ''; ?>
                                            <div class="instagram-item">
                                                <div class="instagram-image">
                                                    <?php if ($instagram_url) : ?>
                                                        <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener">
                                                    <?php endif; ?>
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($instagram_item['image'] ?? '', 'assets/images/instagram/instagram-' . ($index + 1) . '.jpg')); ?>" alt="<?php echo esc_attr($instagram_item['title'] ?? __('Instagram image', 'sportshealing')); ?>">
                                                    </figure>
                                                    <?php if ($instagram_url) : ?>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- instagram section end -->
