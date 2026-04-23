<?php
$portfolio_posts = sportshealing_acf_section_posts('posts', 'sh_portfolio', 6);
?>
<!-- portfolio section start -->
                <section class="portfolio-section-2 pt-100 md-pt-80 pb-70 md-pb-50">
                    <div class="portfolio-shape-1">
                        <figure>
                            <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url('shape_1', 'assets/images/portfolio/portfolio-shape-1.png')); ?>" alt="portfolio shape one">
                        </figure>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="section-title-content wow fadeInRight" data-wow-delay=".3s">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($portfolio_posts as $index => $portfolio_post) : ?>
                                <?php
                                $portfolio_title = get_the_title($portfolio_post);
                                $portfolio_copy = wp_trim_words(get_the_excerpt($portfolio_post), 12);
                                ?>
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="portfolio-items wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                        <div class="portfolio-image">
                                            <a href="<?php echo esc_url(get_permalink($portfolio_post)); ?>">
                                                <figure class="image-anime">
                                                    <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $portfolio_post->ID, 'sportshealing_portfolio_listing_image', 'assets/images/portfolio/portfolio-2-' . (($index % 6) + 1) . '.jpg')); ?>" alt="<?php echo esc_attr($portfolio_title); ?>">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="portfolio-content">
                                            <h3><?php echo esc_html($portfolio_title); ?></h3>
                                            <p><?php echo esc_html($portfolio_copy); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <!-- portfolio section end -->
