<?php
$blog_posts = sportshealing_acf_section_posts('posts', 'post', 2);
$blog_fallbacks = ['assets/images/blog/blog-1.jpg', 'assets/images/blog/blog-2.jpg'];
?>
<!-- blog section start -->
                <section class="blog-section pt-100 md-pt-80 pb-70 md-pb-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title text-center wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($blog_posts as $index => $blog_post) : ?>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="blog-grid-item-3 wow fadeInUp" data-wow-delay="<?php echo esc_attr('.' . ($index + 3) . 's'); ?>">
                                        <div class="blog-grid-image">
                                            <figure>
                                                <img src="<?php echo esc_url(sportshealing_content_image_url((int) $blog_post->ID, $blog_fallbacks[$index] ?? 'assets/images/blog/blog-1.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($blog_post)); ?>">
                                            </figure>
                                        </div>
                                        <div class="blog-grid-content">
                                            <ul class="blog-meta">
                                                <li>
                                                    <a href="<?php echo esc_url(get_author_posts_url((int) $blog_post->post_author)); ?>">
                                                        <i class="fa-solid fa-user"></i>
                                                        <span><?php echo esc_html(get_the_author_meta('display_name', (int) $blog_post->post_author)); ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <span><?php echo esc_html(get_the_date('', $blog_post)); ?></span>
                                                </li>
                                            </ul>
                                            <div class="blog-title">
                                                <h3><?php echo esc_html(get_the_title($blog_post)); ?></h3>
                                            </div>
                                            <div class="blog-grid-button">
                                                <a href="<?php echo esc_url(get_permalink($blog_post)); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <!-- blog section end -->
