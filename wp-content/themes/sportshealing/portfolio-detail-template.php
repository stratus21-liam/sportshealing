<?php
/**
 * Portfolio detail template.
 */

the_post();
get_header();

$post_id = get_the_ID();
$image = sportshealing_media_url(sportshealing_field_value($post_id, 'sportshealing_portfolio_detail_image'), 'assets/images/portfolio/portfolio-details-img-1.jpg');
$project_information = sportshealing_repeater_value($post_id, 'sportshealing_project_information');
$brochures = sportshealing_repeater_value($post_id, 'sportshealing_portfolio_brochures');
$help_heading = sportshealing_meta_value($post_id, 'sportshealing_portfolio_help_heading', 'Lorem Ipsum Dolor?');
$help_copy = sportshealing_meta_value($post_id, 'sportshealing_portfolio_help_copy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$help_phone = sportshealing_meta_value($post_id, 'sportshealing_portfolio_help_phone', '+1 234 467 88');
$help_email = sportshealing_meta_value($post_id, 'sportshealing_portfolio_help_email', 'info@example.com');
$related_items = sportshealing_repeater_value($post_id, 'sportshealing_portfolio_related_items');
$related_ids = [];

foreach ($related_items as $related_item) {
    $related_id = $related_item['portfolio_item'] ?? 0;

    if ($related_id instanceof WP_Post) {
        $related_id = $related_id->ID;
    }

    $related_id = (int) $related_id;

    if ($related_id && $related_id !== $post_id) {
        $related_ids[] = $related_id;
    }
}

$related_ids = array_values(array_unique($related_ids));

sportshealing_breadcrumb(get_the_title(), [__('Portfolio', 'sportshealing') => sportshealing_listing_page_url('portfolio')]);
?>
<section class="portfolio-single-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <div class="col-xl-8 col-md-12">
                <div class="portfolio-single-post">
                    <div class="portfolio-single-media">
                        <figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                    </div>
                    <div class="portfolio-single-contain">
                        <div class="portfolio-entry-content">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="widget-sidebar">
                    <?php if ($project_information) : ?>
                        <div class="widget widget-project-info">
                            <div class="widget-title"><h3><?php esc_html_e('Project Information', 'sportshealing'); ?></h3></div>
                            <div class="widget-content">
                                <ul class="project-info-list">
                                    <?php foreach ($project_information as $info) : ?>
                                        <li>
                                            <div class="project-info-icon"><i class="<?php echo esc_attr($info['icon'] ?? 'fas fa-layer-group'); ?>"></i></div>
                                            <div class="project-info-content">
                                                <span><?php echo esc_html($info['label'] ?? 'Lorem Ipsum'); ?></span>
                                                <p><?php echo esc_html($info['value'] ?? 'Lorem Ipsum'); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($brochures) : ?>
                        <div class="widget widget-company-profile">
                            <div class="widget-title"><h3><?php esc_html_e('Brochure', 'sportshealing'); ?></h3></div>
                            <div class="widget-content">
                                <ul class="company-profile-list">
                                    <?php foreach ($brochures as $brochure) : ?>
                                        <li>
                                            <a href="<?php echo esc_url(sportshealing_media_url($brochure['file'] ?? '#', '#')); ?>">
                                                <span class="company-profile-icon d-flex align-items-center justify-content-center flex-shrink-0"><i class="fa-solid fa-file-pdf" aria-hidden="true"></i></span>
                                                <span class="download-content"><?php echo esc_html($brochure['label'] ?? 'Lorem Ipsum'); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="widget widget-cta">
                        <div class="widget-title"><h3><?php echo esc_html($help_heading); ?></h3></div>
                        <div class="widget-content">
                            <p><?php echo esc_html($help_copy); ?></p>
                            <div class="service-cta-item">
                                <div class="service-cta-list d-flex gap-3">
                                    <div class="service-cta-icon d-flex align-items-center justify-content-center flex-shrink-0"><i class="fa-solid fa-phone-volume"></i></div>
                                    <div class="service-cta-content flex-grow-1">
                                        <p><?php esc_html_e('Phone Number', 'sportshealing'); ?></p>
                                        <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $help_phone)); ?>"><?php echo esc_html($help_phone); ?></a>
                                    </div>
                                </div>
                                <div class="service-cta-list d-flex gap-3">
                                    <div class="service-cta-icon d-flex align-items-center justify-content-center flex-shrink-0"><i class="fa-solid fa-envelope"></i></div>
                                    <div class="service-cta-content flex-grow-1">
                                        <p><?php esc_html_e('Email Address', 'sportshealing'); ?></p>
                                        <a href="<?php echo esc_url('mailto:' . $help_email); ?>"><?php echo esc_html($help_email); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($related_ids) : ?>
    <section class="portfolio-section-2 background-one pt-100 md-pt-80 pb-100 md-pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span class="sub-title"><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_portfolio_related_eyebrow', 'Related Portfolio')); ?></span>
                        <h2><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_portfolio_related_heading', 'Lorem Ipsum Dolor Sit Amet')); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="swiper related-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($related_ids as $related_id) : ?>
                                <div class="swiper-slide">
                                    <div class="portfolio-items">
                                        <div class="portfolio-image">
                                            <figure class="image-anime"><img src="<?php echo esc_url(sportshealing_content_field_image_url($related_id, 'sportshealing_portfolio_listing_image', 'assets/images/portfolio/portfolio-3-1.jpg')); ?>" alt="<?php echo esc_attr(get_the_title($related_id)); ?>"></figure>
                                        </div>
                                        <div class="portfolio-content">
                                            <p><?php echo esc_html(sportshealing_meta_value($related_id, 'sportshealing_portfolio_category', 'Lorem Ipsum')); ?></p>
                                            <h3><a href="<?php echo esc_url(get_permalink($related_id)); ?>"><?php echo esc_html(get_the_title($related_id)); ?></a></h3>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php
// sportshealing_newsletter_cta();
get_footer();
