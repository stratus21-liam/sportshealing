<!-- gallery section start -->
                <div class="gallery-section pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <?php
                        $gallery_items = sportshealing_acf_section_items();
                        $gallery_fallbacks = [
                            'assets/images/gallery/gallery-1.jpg',
                            'assets/images/gallery/gallery-2.jpg',
                            'assets/images/gallery/gallery-3.jpg',
                            'assets/images/gallery/gallery-4.jpg',
                            'assets/images/gallery/gallery-5.jpg',
                            'assets/images/gallery/gallery-6.jpg',
                            'assets/images/gallery/gallery-7.jpg',
                            'assets/images/gallery/gallery-8.jpg',
                            'assets/images/gallery/gallery-9.jpg',
                        ];

                        if (!$gallery_items) {
                            $gallery_items = array_fill(0, count($gallery_fallbacks), []);
                        }

                        $items_per_page = (int) sportshealing_acf_section_value('items_per_page');
                        $items_per_page = $items_per_page > 0 ? $items_per_page : 12;
                        $current_page = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));
                        $total_items = count($gallery_items);
                        $total_pages = (int) ceil($total_items / $items_per_page);
                        $gallery_items = array_slice($gallery_items, ($current_page - 1) * $items_per_page, $items_per_page, true);
                        ?>
                        <div class="row">
                            <?php foreach ($gallery_items as $index => $gallery_item) : ?>
                                <?php
                                $fallback_image = $gallery_fallbacks[$index] ?? 'assets/images/gallery/gallery-1.jpg';
                                $gallery_image = sportshealing_media_url($gallery_item['image'] ?? '', $fallback_image);
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <!-- photo-gallery start -->
                                    <div class="photo-gallery">
                                        <div class="photo-gallery-image">
                                            <figure class="image-anime">
                                                <img src="<?php echo esc_url($gallery_image); ?>" alt="<?php echo esc_attr($gallery_item['title'] ?? 'photo gallery'); ?>">
                                            </figure>
                                        </div>
                                        <div class="photo-gallery-icon">
                                            <a class="photo-popup" href="<?php echo esc_url($gallery_image); ?>" aria-label="photo gallery"><i class="fa-solid fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <!-- photo-gallery end -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($total_pages > 1) : ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="pagination justify-content-center mt-0">
                                        <nav aria-label="<?php esc_attr_e('gallery page navigation', 'sportshealing'); ?>">
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
                <!-- gallery section end -->
