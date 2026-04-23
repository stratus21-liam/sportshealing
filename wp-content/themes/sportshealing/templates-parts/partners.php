<!-- partners section start -->
                <section class="partners-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container"> 
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- section title start -->
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                </div>
                                <!-- section title end -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- partners slider start --> 
                                <div class="swiper partners-slider">
                                    <!-- swiper wrapper start -->
                                    <?php
                                    $partner_items = sportshealing_acf_section_items();
                                    $partner_fallbacks = [
                                        'assets/images/partners/partners-1.png',
                                        'assets/images/partners/partners-2.png',
                                        'assets/images/partners/partners-3.png',
                                        'assets/images/partners/partners-4.png',
                                        'assets/images/partners/partners-5.png',
                                        'assets/images/partners/partners-6.png',
                                    ];

                                    if (!$partner_items) {
                                        $partner_items = array_fill(0, count($partner_fallbacks), []);
                                    }
                                    ?>
                                    <div class="swiper-wrapper">
                                        <?php foreach ($partner_items as $index => $partner_item) : ?>
                                            <?php
                                            $fallback_image = $partner_fallbacks[$index] ?? 'assets/images/partners/partners-1.png';
                                            $partner_image = sportshealing_media_url($partner_item['image'] ?? '', $fallback_image);
                                            ?>
                                            <!-- swiper slide start -->
                                            <div class="swiper-slide">
                                                <!-- partners item start -->
                                                <div class="partners-item">
                                                    <div class="partners-image text-center">
                                                        <figure>
                                                            <img src="<?php echo esc_url($partner_image); ?>" alt="<?php echo esc_attr($partner_item['title'] ?? 'partners'); ?>">
                                                        </figure>
                                                    </div>
                                                </div>
                                                <!-- partners item end -->
                                            </div>
                                            <!-- swiper slide end -->
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- swiper wrapper end -->
                                </div> 
                                <!-- partners slider end -->
                            </div>
                        </div> 
                    </div>
                </section>
                <!-- partners section end -->
