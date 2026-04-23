<?php
/**
 * Service detail template.
 */

the_post();
get_header();

$post_id = get_the_ID();
$service_terms = get_the_terms($post_id, 'sh_service_category');
$service_term_ids = is_array($service_terms) ? wp_list_pluck($service_terms, 'term_id') : [];
$categories = get_terms([
    'taxonomy' => 'sh_service_category',
    'hide_empty' => false,
]);
if (is_wp_error($categories)) {
    $categories = [];
}
$image = sportshealing_media_url(sportshealing_field_value($post_id, 'sportshealing_service_detail_image'), 'assets/images/services/service-details/service-single-1.jpg');
$gallery = sportshealing_repeater_value($post_id, 'sportshealing_service_gallery', [
    ['url' => sportshealing_asset_url('assets/images/services/service-details/service-single-gallery-1.jpg')],
    ['url' => sportshealing_asset_url('assets/images/services/service-details/service-single-gallery-2.jpg')],
]);
$benefits = sportshealing_repeater_value($post_id, 'sportshealing_service_benefits');
$brochures = sportshealing_repeater_value($post_id, 'sportshealing_service_brochures');
$help_heading = sportshealing_meta_value($post_id, 'sportshealing_service_help_heading', 'Lorem Ipsum Dolor?');
$help_copy = sportshealing_meta_value($post_id, 'sportshealing_service_help_copy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
$help_phone = sportshealing_meta_value($post_id, 'sportshealing_service_help_phone', '+1 234 467 88');
$help_email = sportshealing_meta_value($post_id, 'sportshealing_service_help_email', 'info@example.com');

sportshealing_breadcrumb(get_the_title(), [__('Services', 'sportshealing') => sportshealing_listing_page_url('services')]);
?>
<section class="service-single-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row flex-lg-row-reverse">
            <div class="col-xl-8 col-md-12">
                <div class="service-single-post">
                    <div class="service-single-media">
                        <figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                    </div>
                    <div class="service-single-contain">
                        <div class="service-entry-content">
                            <h2><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                            <?php if (sportshealing_meta_value($post_id, 'sportshealing_service_benefits_heading')) : ?>
                                <h3 class="pt-10"><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_service_benefits_heading')); ?></h3>
                            <?php endif; ?>
                            <div class="row gy-4 mb-20">
                                <?php foreach (array_slice($gallery, 0, 2) as $gallery_item) : ?>
                                    <div class="col-sm-6">
                                        <div class="service-gallery">
                                            <figure class="image-anime"><img src="<?php echo esc_url(sportshealing_media_url($gallery_item, sportshealing_default_image_path())); ?>" alt=""></figure>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($benefits) : ?>
                                <div class="check-list mb-30">
                                    <ul>
                                        <?php foreach ($benefits as $benefit) : ?>
                                            <?php if (!empty($benefit['text'])) : ?>
                                                <li><?php echo esc_html($benefit['text']); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="widget-sidebar">
                    <div class="widget widget-categories-list">
                        <div class="widget-title"><h3><?php esc_html_e('Categories', 'sportshealing'); ?></h3></div>
                        <div class="widget-content">
                            <ul class="category-list">
                                <?php foreach ($categories as $category) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="<?php echo in_array($category->term_id, $service_term_ids, true) ? 'active' : ''; ?>">
                                            <span class="categories-name"><?php echo esc_html($category->name); ?></span>
                                            <span class="categories-count">(<?php echo esc_html((string) $category->count); ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php if ($brochures) : ?>
                        <div class="widget widget-company-profile">
                            <div class="widget-title"><h3><?php esc_html_e('Company Profile', 'sportshealing'); ?></h3></div>
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
<?php
get_template_part('templates-parts/content-media-rows', null, [
    'post_id' => $post_id,
    'enabled_field' => 'sportshealing_service_content_rows_enabled',
    'rows_field' => 'sportshealing_service_content_rows',
    'has_previous_content' => true,
]);

get_template_part('templates-parts/content-media-gallery', null, [
    'post_id' => $post_id,
    'enabled_field' => 'sportshealing_service_media_items_enabled',
    'items_field' => 'sportshealing_service_media_items',
    'has_previous_content' => true,
]);

// sportshealing_newsletter_cta();
get_footer();
