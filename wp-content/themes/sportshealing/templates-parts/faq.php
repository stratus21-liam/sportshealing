<!-- faq section start -->
<section class="faq-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <span class="sub-title"><?php echo esc_html(sportshealing_acf_section_text('eyebrow')); ?></span>
                    <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                </div>
                <!-- section title end -->
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- form start -->
                <form action="#" class="mb-30">
                    <div class="form-group">
                        <div class="form-floating field-inner">
                            <input id="faqsearch" name="faqsearch" class="form-control" placeholder="Search Here..." type="text" autocomplete="off">
                            <label for="faqsearch">Search</label>
                            <button type="submit" aria-label="faq submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
                <!-- form end -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- faq wapper start -->
                <div class="faq-wapper">
                    <!-- accordion start -->
                    <?php
                    $faq_items = sportshealing_acf_section_items();
                    $accordion_id = 'accordion-' . sanitize_html_class(sportshealing_current_section_key() ?: 'faq');
                    ?>
                    <div class="accordion" id="<?php echo esc_attr($accordion_id); ?>">
                        <?php foreach ($faq_items as $index => $faq_item) : ?>
                            <?php
                            $heading_id = $accordion_id . '-heading-' . ($index + 1);
                            $collapse_id = $accordion_id . '-collapse-' . ($index + 1);
                            $is_open = $index === 0;
                            ?>
                            <!-- accordion item start -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="<?php echo esc_attr($heading_id); ?>">
                                    <button class="accordion-button<?php echo $is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                        <?php echo esc_html($faq_item['title'] ?? ''); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse<?php echo $is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-bs-parent="#<?php echo esc_attr($accordion_id); ?>">
                                    <div class="accordion-body">
                                        <div class="inner">
                                            <div class="accordion-content">
                                                <p><?php echo wp_kses_post($faq_item['copy'] ?? ''); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item end -->
                        <?php endforeach; ?>
                    </div>
                    <!-- accordion end -->
                </div>
                <!-- faq wapper end -->
            </div>
        </div>
    </div>
</section>
<!-- faq section end -->
