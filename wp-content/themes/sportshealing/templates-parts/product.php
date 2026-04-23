<?php
$product_items = sportshealing_acf_section_items();
?>
<!-- product section start -->
                <section class="product-section background-one pt-100 md-pt-50 pb-70 md-pb-50">
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
                            <?php foreach ($product_items as $index => $product_item) : ?>
                                <?php
                                $product_title = !empty($product_item['title']) ? (string) $product_item['title'] : '';
                                $product_price = !empty($product_item['price']) ? (string) $product_item['price'] : '';
                                $product_rating = !empty($product_item['rating']) ? (string) $product_item['rating'] : '';
                                $product_url = !empty($product_item['url']) ? (string) $product_item['url'] : sportshealing_static_url('shop.html', '');
                                $cart_url = !empty($product_item['cart_url']) ? (string) $product_item['cart_url'] : sportshealing_static_url('cart.html', '');
                                ?>
                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="product-grid-item-1 wow fadeInUp" data-wow-delay="<?php echo esc_attr(number_format(0.3 + ($index * 0.1), 1)); ?>s">
                                        <?php if (!empty($product_item['badge_image'])) : ?>
                                            <div class="product-tags">
                                                <div class="product-tags-sale">
                                                    <figure>
                                                        <img src="<?php echo esc_url(sportshealing_media_url($product_item['badge_image'], 'assets/images/product/sale.png')); ?>" alt="<?php echo esc_attr($product_item['badge_label'] ?? __('Product badge', 'sportshealing')); ?>">
                                                    </figure>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="product-grid-image">
                                            <figure>
                                                <img src="<?php echo esc_url(sportshealing_media_url($product_item['image'] ?? '', 'assets/images/product/product-' . ($index + 1) . '.png')); ?>" alt="<?php echo esc_attr($product_title); ?>">
                                            </figure>
                                            <div class="product-grid-action">
                                                <a href="<?php echo esc_url($product_url); ?>" class="icon-btn" aria-label="<?php esc_attr_e('View product', 'sportshealing'); ?>">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <a href="<?php echo esc_url($product_url); ?>" class="icon-btn" aria-label="<?php esc_attr_e('Save product', 'sportshealing'); ?>">
                                                    <i class="fa-solid fa-bookmark"></i>
                                                </a>
                                                <a href="<?php echo esc_url(!empty($product_item['wishlist_url']) ? (string) $product_item['wishlist_url'] : $product_url); ?>" class="icon-btn" aria-label="<?php esc_attr_e('Add to wishlist', 'sportshealing'); ?>">
                                                    <i class="fa-solid fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-grid-content">
                                            <h2><?php echo esc_html($product_title); ?></h2>
                                            <ul class="product-price-list">
                                                <li class="price"><?php echo esc_html($product_price); ?></li>
                                                <?php if ($product_rating) : ?>
                                                    <li><i class="fas fa-star active"></i><?php echo esc_html($product_rating); ?></li>
                                                <?php endif; ?>
                                            </ul>
                                            <div class="product-buton-wapper">
                                                <a href="<?php echo esc_url($cart_url); ?>" class="theme-button style-1" aria-label="<?php esc_attr_e('Add To Cart', 'sportshealing'); ?>">
                                                    <span data-text="<?php esc_attr_e('Add To Cart', 'sportshealing'); ?>"><?php esc_html_e('Add To Cart', 'sportshealing'); ?></span>
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
                <!-- product section end -->
