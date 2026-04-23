<!-- testimonials section start -->
                <section class="testimonials-section-1 background-one pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-6 order-lg-1 order-2">
                                <!-- testimonials image start -->
                                <?php
                                $success_rate_review = sportshealing_acf_section_text('success_rate_review');
                                $success_rate_stars = (int) sportshealing_acf_section_text('success_rate_stars');
                                $success_rate_stars = max(0, min(5, $success_rate_stars ?: 5));
                                ?>
                                <div class="testimonials-image wow fadeInLeft" data-wow-delay=".2s">
                                    <figure>
                                        <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/testimonials/testimonial-1-1.jpg')); ?>" alt="testimonials image one">
                                    </figure>
                                    <?php if ($success_rate_review) : ?>
                                        <div class="success-rate">
                                            <div class="success-rate-review"><?php echo esc_html($success_rate_review); ?></div>
                                            <div class="success-rate-star">
                                                <?php for ($star = 1; $star <= 5; $star++) : ?>
                                                    <i class="fa-solid fa-star<?php echo $star <= $success_rate_stars ? ' active' : ''; ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <!-- testimonials image end -->
                            </div>
                            <div class="col-lg-6 order-lg-2 order-1">
                                <div class="testimonials-wapper">
                                    <!-- section title start -->
                                    <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <!-- section title end -->
                                    <!-- testimonials slider start --> 
                                    <div class="swiper testimonials-slider">
                                        <!-- swiper wrapper start -->
                                        <?php
                                        $testimonial_items = sportshealing_acf_section_items();
                                        $testimonial_fallbacks = [
                                            'assets/images/avatar/avatar-1.jpg',
                                            'assets/images/avatar/avatar-2.jpg',
                                            'assets/images/avatar/avatar-3.jpg',
                                            'assets/images/avatar/avatar-4.jpg',
                                        ];

                                        if (!$testimonial_items) {
                                            $testimonial_items = array_fill(0, count($testimonial_fallbacks), []);
                                        }
                                        ?>
                                        <div class="swiper-wrapper">
                                            <?php foreach ($testimonial_items as $index => $testimonial_item) : ?>
                                                <?php
                                                $avatar_fallback = $testimonial_fallbacks[$index] ?? 'assets/images/avatar/avatar-1.jpg';
                                                $avatar_url = sportshealing_media_url($testimonial_item['image'] ?? '', $avatar_fallback);
                                                $quote_url = sportshealing_media_url($testimonial_item['quote_image'] ?? '', 'assets/images/testimonials/quote.png');
                                                ?>
                                                <!-- swiper slide start -->
                                                <div class="swiper-slide">
                                                    <!-- testimonials item start -->
                                                    <div class="testimonials-item">
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
                                                            <p><?php echo wp_kses_post($testimonial_item['copy'] ?? ''); ?></p>
                                                        </div> 
                                                        <div class="testimonials-author">
                                                            <div class="testimonials-author-image">
                                                                <figure>
                                                                    <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($testimonial_item['author_name'] ?? 'avatar'); ?>">
                                                                </figure>
                                                            </div>
                                                            <div class="testimonials-author-content">
                                                                <h3><?php echo esc_html($testimonial_item['author_name'] ?? ($testimonial_item['title'] ?? '')); ?></h3>
                                                                <p><?php echo esc_html($testimonial_item['author_role'] ?? ''); ?></p>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <!-- testimonials item end -->
                                                </div>
                                                <!-- swiper slide end -->
                                            <?php endforeach; ?>
                                        </div>
                                        <!-- swiper wrapper end -->
                                        <!-- swiper actions start -->
                                        <div class="swiper-actions ms-2">
                                            <div class="dot"></div>                                         
                                        </div>
                                        <!-- swiper actions end -->
                                    </div> 
                                    <!-- testimonials slider end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- portfolio section end -->
