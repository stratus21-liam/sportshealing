<!-- contact section start -->
                <section class="contact-section pt-100 md-pt-80 md-pb-50">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <!-- section title start -->
                                <div class="section-title wow fadeInUp" data-wow-delay=".2s">
                                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2> 
                                </div>
                                <!-- section title end -->
                                <?php $contact_items = sportshealing_acf_section_items(); ?>
                                <!-- contact item wrapper start -->
                                <div class="contact-item-wrapper">
                                    <?php foreach (array_slice($contact_items, 0, 3) as $index => $item) : ?>
                                        <?php $icon = !empty($item['icon']) ? (string) $item['icon'] : 'fa-solid fa-circle-info'; ?>
                                        <?php $item_url = !empty($item['url']) ? (string) $item['url'] : ''; ?>
                                        <div class="contact-item wow fadeInUp" data-wow-delay="<?php echo esc_attr('.' . (5 - $index) . 's'); ?>">
                                            <div class="contact-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
                                            <div class="contact-content">
                                                <?php if (!empty($item['copy'])) : ?>
                                                    <p><?php echo esc_html((string) $item['copy']); ?></p>
                                                <?php endif; ?>
                                                <?php if (!empty($item['title'])) : ?>
                                                    <h3>
                                                        <?php if ($item_url) : ?>
                                                            <a href="<?php echo esc_url($item_url, ['http', 'https', 'mailto', 'tel']); ?>"><?php echo esc_html((string) $item['title']); ?></a>
                                                        <?php else : ?>
                                                            <?php echo esc_html((string) $item['title']); ?>
                                                        <?php endif; ?>
                                                    </h3>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- contact item wrapper end -->

                                <?php
                                $follow_text = sportshealing_acf_section_text('follow_text');
                                $social_links = sportshealing_acf_section_value('social_links');
                                $social_links = is_array($social_links) ? array_filter($social_links, static function ($item) {
                                    return is_array($item) && !empty($item['url']);
                                }) : [];
                                ?>
                                <?php if ($social_links) : ?>
                                    <div class="contact-social-links wow fadeInUp" data-wow-delay=".6s">
                                        <?php if ($follow_text) : ?>
                                            <span class="follow-text"><?php echo esc_html($follow_text); ?></span>
                                        <?php endif; ?>
                                        <?php sportshealing_render_social_links($social_links); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-6"> 
                                <!-- contact form box start -->
                                <div class="contact-form-box">  
                                    <div class="section-title">
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('form_title') ?: __('Get In Touch', 'sportshealing')); ?></h2>
                                    </div>
                                    <!-- default-form start -->
                                    <div class="default-form contact-form">
                                        <?php $contact_form_shortcode = sportshealing_acf_section_text('shortcode'); ?>
                                        <?php if ($contact_form_shortcode) : ?>
                                            <?php echo do_shortcode($contact_form_shortcode); ?>
                                        <?php elseif (current_user_can('edit_pages')) : ?>
                                            <div class="section-title">
                                                <p><?php esc_html_e('Add a Contact Form 7 shortcode in the Contact Form tab to show the form here.', 'sportshealing'); ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <!-- default-form end -->
                                </div>
                                <!-- contact form box end -->
                            </div>
                        </div> 
                    </div>
                </section>
                <!-- contact section end -->

