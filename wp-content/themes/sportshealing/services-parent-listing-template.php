<?php
/**
 * Template Name: Service Parent Listing
 *
 * Top-level service category listing template.
 */

$listing_title = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_heading', get_the_title());
$service_parent_categories = get_terms([
    'taxonomy' => 'sh_service_category',
    'hide_empty' => false,
    'parent' => 0,
    'orderby' => 'name',
    'order' => 'ASC',
]);

if (!is_wp_error($service_parent_categories) && $service_parent_categories) {
    $service_parent_categories = array_filter($service_parent_categories, static function (WP_Term $category): bool {
        $child_categories = get_terms([
            'taxonomy' => 'sh_service_category',
            'hide_empty' => false,
            'parent' => (int) $category->term_id,
            'fields' => 'ids',
            'number' => 1,
        ]);

        return !is_wp_error($child_categories) && !empty($child_categories);
    });

    $linked_parent_categories = array_filter($service_parent_categories, static function (WP_Term $category): bool {
        return sportshealing_service_parent_category_page_url($category) !== sportshealing_service_category_filter_url($category);
    });

    if ($linked_parent_categories) {
        $service_parent_categories = array_values($linked_parent_categories);
    } else {
        $service_parent_categories = array_values($service_parent_categories);
    }
}

get_header();
sportshealing_breadcrumb($listing_title);
?>
<section class="services-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <?php if (!is_wp_error($service_parent_categories) && $service_parent_categories) : ?>
                <?php foreach ($service_parent_categories as $category) : ?>
                    <?php
                    $category_services = new WP_Query([
                        'post_type' => 'sh_service',
                        'posts_per_page' => 1,
                        'fields' => 'ids',
                        'tax_query' => [
                            [
                                'taxonomy' => 'sh_service_category',
                                'field' => 'term_id',
                                'terms' => (int) $category->term_id,
                                'include_children' => true,
                            ],
                        ],
                    ]);
                    $service_count = (int) $category_services->found_posts;
                    wp_reset_postdata();
                    ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="service-items background-one">
                            <div class="service-icon">
                                <figure><img src="<?php echo esc_url(sportshealing_asset_url('assets/images/joint-icon-29.png')); ?>" alt="<?php echo esc_attr($category->name); ?>"></figure>
                            </div>
                            <div class="service-content">
                                <h2><a href="<?php echo esc_url(sportshealing_service_parent_category_page_url($category)); ?>"><?php echo esc_html($category->name); ?></a></h2>
                                <?php if ($category->description) : ?>
                                    <p><?php echo esc_html($category->description); ?></p>
                                <?php else : ?>
                                    <p><?php echo esc_html(sprintf(_n('%s treatment available', '%s treatments available', $service_count, 'sportshealing'), number_format_i18n($service_count))); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo esc_url(sportshealing_service_parent_category_page_url($category)); ?>" class="read-more-btn"><?php esc_html_e('View Treatments', 'sportshealing'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2><?php esc_html_e('No service categories found', 'sportshealing'); ?></h2>
                        <p><?php esc_html_e('Please add top-level service categories such as Knee Treatments or Hip Treatments.', 'sportshealing'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (trim(get_the_content()) !== '') : ?>
                    <div class="row pt-60 md-pt-40">
                        <div class="col-lg-10">
                            <div class="service-entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
