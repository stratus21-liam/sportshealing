<?php
$hero_slides = sportshealing_acf_section_value('slides');
$hero_slides = is_array($hero_slides) ? $hero_slides : [];
array_unshift($hero_slides, [
    'eyebrow' => sportshealing_acf_section_text('eyebrow'),
    'title' => sportshealing_acf_section_text('heading'),
    'copy' => sportshealing_acf_section_text('copy'),
    'image' => sportshealing_acf_section_value('image'),
]);
$hero_primary_label = sportshealing_acf_section_text('primary_button_label') ?: __('Find A Consultant', 'sportshealing');
$hero_primary_url = sportshealing_acf_section_page_url('primary_button_page', sportshealing_static_url('contact.html', ''));
$hero_secondary_label = sportshealing_acf_section_text('secondary_button_label') ?: __('Meet Our Doctor', 'sportshealing');
$hero_secondary_url = sportshealing_acf_section_page_url('secondary_button_page', sportshealing_static_url('doctor.html', ''));
$hero_shape_fallbacks = [
    'shape_1' => ['hero-shape-one', 'assets/images/hero/hero-3-shape-1.svg'],
    'shape_2' => ['hero-shape-two', 'assets/images/hero/hero-3-shape-2.svg'],
    'shape_3' => ['hero-shape-three', 'assets/images/hero/hero-3-shape-3.svg'],
    'shape_4' => ['hero-shape-four', 'assets/images/hero/hero-3-shape-4.svg'],
    'shape_5' => ['hero-shape-five', 'assets/images/hero/hero-3-shape-5.svg'],
];
?>
<!-- hero section start -->
                <section class="hero-section-3" data-img-src="<?php echo esc_url(sportshealing_acf_section_named_image_url('background_image', 'assets/images/hero/bg-hero-3.jpg')); ?>">
                    <div class="swiper hero-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($hero_slides as $index => $hero_slide) : ?>
                                <?php
                                $slide_eyebrow = !empty($hero_slide['eyebrow']) ? (string) $hero_slide['eyebrow'] : '';
                                $slide_title = !empty($hero_slide['title']) ? (string) $hero_slide['title'] : '';
                                $slide_copy = !empty($hero_slide['copy']) ? (string) $hero_slide['copy'] : '';
                                $slide_image = sportshealing_media_url($hero_slide['image'] ?? '', $index === 0 ? 'assets/images/hero/hero-3-1.png' : 'assets/images/hero/hero-3-2.png');
                                ?>
                                <div class="swiper-slide">
                                    <div class="container">
                                        <div class="row align-items-end">
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="hero-content">
                                                    <div class="section-title">
                                                        <?php if ($slide_eyebrow) : ?>
                                                            <span class="sub-title"><?php echo esc_html($slide_eyebrow); ?></span>
                                                        <?php endif; ?>
                                                        <h1><?php echo esc_html($slide_title); ?></h1>
                                                        <p><?php echo wp_kses_post($slide_copy); ?></p>
                                                    </div>
                                                    <div class="hero-button-wappper">
                                                        <a href="<?php echo esc_url($hero_primary_url); ?>" class="theme-button style-4" aria-label="<?php echo esc_attr($hero_primary_label); ?>">
                                                            <span data-text="<?php echo esc_attr($hero_primary_label); ?>"><?php echo esc_html($hero_primary_label); ?></span>
                                                            <i class="fa-solid fa-arrow-right"></i>
                                                        </a>
                                                        <a href="<?php echo esc_url($hero_secondary_url); ?>" class="theme-button style-5" aria-label="<?php echo esc_attr($hero_secondary_label); ?>">
                                                            <span data-text="<?php echo esc_attr($hero_secondary_label); ?>"><?php echo esc_html($hero_secondary_label); ?></span>
                                                            <i class="fa-solid fa-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12">
                                                <div class="hero-image">
                                                    <figure class="hero-image-one">
                                                        <img src="<?php echo esc_url($slide_image); ?>" alt="<?php echo esc_attr($slide_title); ?>">
                                                    </figure>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-actions text-center">
                            <div class="dot"></div>
                        </div>
                    </div>
                    <div class="hero-shape">
                        <?php foreach ($hero_shape_fallbacks as $shape_key => [$shape_class, $shape_fallback]) : ?>
                            <figure class="<?php echo esc_attr($shape_class); ?>">
                                <img src="<?php echo esc_url(sportshealing_acf_section_named_image_url($shape_key, $shape_fallback)); ?>" alt="<?php echo esc_attr(str_replace('_', ' ', $shape_key)); ?>">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </section>
                <!-- hero section end -->
