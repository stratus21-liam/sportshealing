<?php
$portfolio_posts = sportshealing_acf_section_posts('posts', 'sh_portfolio', 4);
$portfolio_button_label = sportshealing_acf_section_text('button_label') ?: __('View All Portfolio', 'sportshealing');
$portfolio_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('portfolio.html', ''));
$portfolio_more_copy = sportshealing_acf_section_text('more_copy');
$portfolio_fallbacks = ['assets/images/portfolio/portfolio-1-1.jpg', 'assets/images/portfolio/portfolio-1-2.jpg', 'assets/images/portfolio/portfolio-1-3.jpg', 'assets/images/portfolio/portfolio-1-4.jpg'];
?>
<!-- portfolio section start -->
                <section class="portfolio-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                    <div class="section-title-content wow fadeInRight" data-wow-delay=".2s">
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($portfolio_posts as $index => $portfolio_post) : ?>
                                <?php
                                $portfolio_title = get_the_title($portfolio_post);
                                $portfolio_categories = array_filter(array_map('trim', explode(',', sportshealing_meta_value((int) $portfolio_post->ID, 'sportshealing_portfolio_category'))));
                                ?>
                                <div class="col-lg-6">
                                    <div class="portfolio-items wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                        <div class="portfolio-image">
                                            <figure>
                                                <img src="<?php echo esc_url(sportshealing_content_field_image_url((int) $portfolio_post->ID, 'sportshealing_portfolio_listing_image', $portfolio_fallbacks[$index] ?? 'assets/images/portfolio/portfolio-1-1.jpg')); ?>" alt="<?php echo esc_attr($portfolio_title); ?>">
                                            </figure>
                                        </div>
                                        <div class="portfolio-content">
                                            <div class="portfolio-title">
                                                <h3><?php echo esc_html($portfolio_title); ?></h3>
                                                <?php if ($portfolio_categories) : ?>
                                                    <ul class="portfolio-meta">
                                                        <?php foreach (array_slice($portfolio_categories, 0, 2) as $portfolio_category) : ?>
                                                            <li><?php echo esc_html($portfolio_category); ?></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                            <div class="portfolio-button-wapper">
                                                <a href="<?php echo esc_url(get_permalink($portfolio_post)); ?>" class="portfolio-button-icon" aria-label="<?php echo esc_attr($portfolio_title); ?>">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="more-portfolio-content wow fadeInUp" data-wow-delay=".7s">
                                    <?php if ($portfolio_more_copy) : ?>
                                        <p><?php echo esc_html($portfolio_more_copy); ?></p>
                                    <?php endif; ?>
                                    <div class="service-button-wappper">
                                        <a href="<?php echo esc_url($portfolio_button_url); ?>" class="theme-button style-1" aria-label="<?php echo esc_attr($portfolio_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($portfolio_button_label); ?>"><?php echo esc_html($portfolio_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- portfolio section end -->
