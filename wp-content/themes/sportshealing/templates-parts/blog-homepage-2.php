<?php
$blog_posts = sportshealing_acf_section_posts('posts', 'post', 3);
$blog_fallbacks = ['assets/images/blog/blog-2-1.jpg', 'assets/images/blog/blog-2-2.jpg', 'assets/images/blog/blog-2-3.jpg'];
?>
<!-- blog section start -->
                <section class="blog-section pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title-area">
                                    <div class="section-title wow fadeInLeft" data-wow-delay=".2s">
                                        <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php if (!empty($blog_posts[0])) : ?>
                                <?php $blog_post = $blog_posts[0]; ?>
                                <div class="col-xl-6 col-lg-12">
                                    <div class="blog-grid-item-2 highlighted-blog-grid wow fadeInUp" data-wow-delay=".3s">
                                        <div class="blog-grid-image">
                                            <a href="<?php echo esc_url(get_permalink($blog_post)); ?>">
                                                <figure class="image-anime">
                                                    <img src="<?php echo esc_url(sportshealing_content_image_url((int) $blog_post->ID, $blog_fallbacks[0])); ?>" alt="<?php echo esc_attr(get_the_title($blog_post)); ?>">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="blog-grid-content">
                                            <ul class="blog-meta">
                                                <li><a href="<?php echo esc_url(get_author_posts_url((int) $blog_post->post_author)); ?>"><i class="fa-solid fa-user"></i><span><?php echo esc_html(get_the_author_meta('display_name', (int) $blog_post->post_author)); ?></span></a></li>
                                                <li><i class="fa-solid fa-calendar-days"></i><span><?php echo esc_html(get_the_date('', $blog_post)); ?></span></li>
                                            </ul>
                                            <h3><?php echo esc_html(get_the_title($blog_post)); ?></h3>
                                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt($blog_post), 20)); ?></p>
                                            <div class="blog-grid-button">
                                                <a href="<?php echo esc_url(get_permalink($blog_post)); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-xl-6 col-lg-12">
                                <div class="blog-grid-box2">
                                    <?php foreach (array_slice($blog_posts, 1, 2) as $index => $blog_post) : ?>
                                        <div class="blog-grid-item-2 wow fadeInUp" data-wow-delay="<?php echo esc_attr('.' . ($index + 4) . 's'); ?>">
                                            <div class="blog-grid-image">
                                                <a href="<?php echo esc_url(get_permalink($blog_post)); ?>">
                                                    <figure class="image-anime">
                                                        <img src="<?php echo esc_url(sportshealing_content_image_url((int) $blog_post->ID, $blog_fallbacks[$index + 1] ?? 'assets/images/blog/blog-2-2.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($blog_post)); ?>">
                                                    </figure>
                                                </a>
                                            </div>
                                            <div class="blog-grid-content">
                                                <ul class="blog-meta">
                                                    <li><a href="<?php echo esc_url(get_author_posts_url((int) $blog_post->post_author)); ?>"><i class="fa-solid fa-user"></i><span><?php echo esc_html(get_the_author_meta('display_name', (int) $blog_post->post_author)); ?></span></a></li>
                                                    <li><i class="fa-solid fa-calendar-days"></i><span><?php echo esc_html(get_the_date('', $blog_post)); ?></span></li>
                                                </ul>
                                                <h3><?php echo esc_html(get_the_title($blog_post)); ?></h3>
                                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt($blog_post), 16)); ?></p>
                                                <div class="blog-grid-button">
                                                    <a href="<?php echo esc_url(get_permalink($blog_post)); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- blog section end -->
