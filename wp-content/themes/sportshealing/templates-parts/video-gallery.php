<!-- video gallery section start -->
                <div class="video-gallery-section pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <?php
                        $video_items = sportshealing_acf_section_items();
                        $video_fallbacks = [
                            'assets/images/video-gallery/video-gallery-1.jpg',
                            'assets/images/video-gallery/video-gallery-2.jpg',
                            'assets/images/video-gallery/video-gallery-3.jpg',
                            'assets/images/video-gallery/video-gallery-4.jpg',
                            'assets/images/video-gallery/video-gallery-5.jpg',
                            'assets/images/video-gallery/video-gallery-6.jpg',
                            'assets/images/video-gallery/video-gallery-7.jpg',
                            'assets/images/video-gallery/video-gallery-8.jpg',
                            'assets/images/video-gallery/video-gallery-9.jpg',
                        ];

                        if (!$video_items) {
                            $video_items = array_fill(0, count($video_fallbacks), []);
                        }

                        $items_per_page = (int) sportshealing_acf_section_value('items_per_page');
                        $items_per_page = $items_per_page > 0 ? $items_per_page : 12;
                        $current_page = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
                        $total_items = count($video_items);
                        $total_pages = (int) ceil($total_items / $items_per_page);
                        $video_items = array_slice($video_items, ($current_page - 1) * $items_per_page, $items_per_page, true);
                        ?>
                        <div class="row">
                            <?php foreach ($video_items as $index => $video_item) : ?>
                                <?php
                                $fallback_image = $video_fallbacks[$index] ?? 'assets/images/video-gallery/video-gallery-1.jpg';
                                $video_image = sportshealing_media_url($video_item['image'] ?? '', $fallback_image);
                                $video_url = !empty($video_item['url']) ? (string) $video_item['url'] : 'https://www.youtube.com/watch?v=Y-x0efG1seA';
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <!-- video gallery item start -->
                                    <div class="video-gallery-item">
                                        <a href="<?php echo esc_url($video_url); ?>" class="video-popup">
                                            <figure>
                                                <img src="<?php echo esc_url($video_image); ?>" alt="<?php echo esc_attr($video_item['title'] ?? 'video gallery'); ?>">
                                            </figure>
                                            <div class="play-button"><i class="fas fa-play"></i></div>
                                        </a>
                                    </div>
                                    <!-- video gallery item end -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($total_pages > 1) : ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="pagination justify-content-center mt-0">
                                        <nav aria-label="<?php esc_attr_e('video gallery page navigation', 'sportshealing'); ?>">
                                            <ul class="page-list">
                                                <?php
                                                $pagination_links = paginate_links([
                                                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                                    'format' => '',
                                                    'current' => $current_page,
                                                    'total' => $total_pages,
                                                    'type' => 'array',
                                                    'prev_text' => __('Previous Page', 'sportshealing'),
                                                    'next_text' => __('Next Page', 'sportshealing'),
                                                ]);
                                                ?>
                                                <?php foreach ($pagination_links ?: [] as $link) : ?>
                                                    <li><?php echo wp_kses_post($link); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- video gallery section end -->
