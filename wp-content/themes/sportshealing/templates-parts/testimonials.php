<!-- testimonials section start -->
                <section class="testimonials-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <?php
                        $testimonial_items = sportshealing_acf_section_items();
                        $testimonial_fallbacks = [
                            'assets/images/avatar/avatar-1.jpg',
                            'assets/images/avatar/avatar-2.jpg',
                            'assets/images/avatar/avatar-3.jpg',
                            'assets/images/avatar/avatar-4.jpg',
                            'assets/images/avatar/avatar-5.jpg',
                            'assets/images/avatar/avatar-6.jpg',
                            'assets/images/avatar/avatar-7.jpg',
                            'assets/images/avatar/avatar-1.jpg',
                            'assets/images/avatar/avatar-9.jpg',
                        ];

                        if (!$testimonial_items) {
                            $testimonial_items = array_fill(0, count($testimonial_fallbacks), []);
                        }
                        ?>
                        <div class="row">
                            <?php foreach ($testimonial_items as $index => $testimonial_item) : ?>
                                <?php
                                $avatar_fallback = $testimonial_fallbacks[$index] ?? 'assets/images/avatar/avatar-1.jpg';
                                $avatar_url = sportshealing_media_url($testimonial_item['image'] ?? '', $avatar_fallback);
                                $quote_url = sportshealing_media_url($testimonial_item['quote_image'] ?? '', 'assets/images/testimonials/quote.png');
                                ?>
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <!-- testimonials item start -->
                                    <div class="testimonials-item background-one"> 
                                        <div class="testimonials-meta"> 
                                            <div class="testimonials-rating">
                                                <i class="fa-solid fa-star active"></i>
                                                <i class="fa-solid fa-star active"></i>
                                                <i class="fa-solid fa-star active"></i>
                                                <i class="fa-solid fa-star active"></i>
                                                <i class="fa-solid fa-star active"></i>
                                            </div> 
                                            <div class="testimonials-quote">
                                                <figure>
                                                    <img src="<?php echo esc_url($quote_url); ?>" alt="quote">
                                                </figure>
                                            </div> 
                                        </div> 
                                        <div class="testimonials-content">
                                            <h2><?php echo esc_html($testimonial_item['title'] ?? ''); ?></h2>
                                            <p><?php echo wp_kses_post($testimonial_item['copy'] ?? ''); ?></p>
                                        </div> 
                                        <div class="testimonials-author">
                                            <div class="testimonials-author-image">
                                                <figure>
                                                    <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($testimonial_item['author_name'] ?? 'avatar'); ?>">
                                                </figure>
                                            </div>
                                            <div class="testimonials-author-content">
                                                <h3><?php echo esc_html($testimonial_item['author_name'] ?? ''); ?></h3>
                                                <p><?php echo esc_html($testimonial_item['author_role'] ?? ''); ?></p>
                                            </div>
                                        </div> 
                                    </div>
                                    <!-- testimonials item end -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- pagination start -->
                                <div class="pagination justify-content-center mt-0">
                                    <nav aria-label="page navigation">
                                        <ul class="page-list">
                                            <li><a aria-current="page" class="page-numbers current" href="#">1</a></li>
                                            <li><a class="page-numbers" href="#">2</a></li>
                                            <li><a class="next page-numbers" href="#">Next Page</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- pagination end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- portfolio section end -->
