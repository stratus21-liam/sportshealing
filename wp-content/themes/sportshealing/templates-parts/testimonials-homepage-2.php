<!-- testimonials section start -->
                <section class="testimonials-section-2 background-one pt-100 md-pt-80 pb-100 md-pb-80" data-img-src="<?php echo esc_url( sportshealing_asset_url( 'assets/images/testimonials/testimonials-bg.svg' ) ); ?>">
                    <div class="container">
                        <div class="row section-row">
                            <div class="col-lg-12">
                                <!-- section title start -->
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                </div>
                                <!-- section title end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- testimonials slider two start --> 
                                <div class="swiper testimonials-slider-two">
                                    <!-- swiper wrapper start -->
                                    <?php
                                    $testimonial_items = sportshealing_acf_section_items();
                                    $testimonial_fallbacks = [
                                        'assets/images/avatar/avatar-5.jpg',
                                        'assets/images/avatar/avatar-6.jpg',
                                        'assets/images/avatar/avatar-7.jpg',
                                        'assets/images/avatar/avatar-1.jpg',
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
                                            <!-- swiper-slide start -->
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
                                                        <h2><?php echo esc_html($testimonial_item['title'] ?? ''); ?></h2>
                                                        <p><?php echo wp_kses_post($testimonial_item['copy'] ?? ''); ?></p>
                                                    </div> 
                                                    <div class="testimonials-author">
                                                        <div class="testimonials-author-image">
                                                            <figure>
                                                                <img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($testimonial_item['author_name'] ?? 'testimonials avatar'); ?>">
                                                            </figure>
                                                        </div>
                                                        <div class="testimonials-author-content">
                                                            <h3><?php echo esc_html($testimonial_item['author_name'] ?? ''); ?></h3>
                                                            <p><?php echo esc_html($testimonial_item['author_role'] ?? ''); ?></p>
                                                        </div>
                                                    </div>
                                                    <!-- testimonials author end -->
                                                </div>
                                                <!-- testimonials item end -->
                                            </div>
                                            <!-- swiper-slide end -->
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- swiper wrapper end -->
                                    <!-- swiper actions start -->
                                    <div class="swiper-actions text-center">
                                        <div class="dot"></div>                                         
                                    </div>
                                    <!-- swiper actions end -->
                                </div> 
                                <!-- testimonials slider two end -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- portfolio section end -->
