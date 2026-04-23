<?php
/**
 * Template Name: Services
 *
 * Service listing template.
 */

$listing_title = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_heading', get_the_title());
$selected_service_category = isset($_GET['service-category']) ? sanitize_title(wp_unslash((string) $_GET['service-category'])) : '';
$service_parent_category = sportshealing_field_value(get_the_ID(), 'sportshealing_service_listing_parent_category');
$service_parent_category_id = 0;

if ($service_parent_category instanceof WP_Term) {
    $service_parent_category_id = (int) $service_parent_category->term_id;
} elseif (is_array($service_parent_category) && isset($service_parent_category['term_id'])) {
    $service_parent_category_id = (int) $service_parent_category['term_id'];
} elseif (is_numeric($service_parent_category)) {
    $service_parent_category_id = (int) $service_parent_category;
}

$service_parent_category_term = $service_parent_category_id ? get_term($service_parent_category_id, 'sh_service_category') : null;
$service_parent_category_name = $service_parent_category_term instanceof WP_Term ? $service_parent_category_term->name : __('Services', 'sportshealing');
$selected_service_category_term = $selected_service_category ? get_term_by('slug', $selected_service_category, 'sh_service_category') : null;

if ($selected_service_category && !($selected_service_category_term instanceof WP_Term)) {
    $selected_service_category = '';
}

if (
    $service_parent_category_id
    && $selected_service_category_term instanceof WP_Term
    && (int) $selected_service_category_term->term_id !== $service_parent_category_id
    && !term_is_ancestor_of($service_parent_category_id, (int) $selected_service_category_term->term_id, 'sh_service_category')
) {
    $selected_service_category = '';
    $selected_service_category_term = null;
}

$service_categories = get_terms([
    'taxonomy' => 'sh_service_category',
    'hide_empty' => false,
    'parent' => $service_parent_category_id,
]);
$services_query_args = [
    'post_type' => 'sh_service',
    'posts_per_page' => 9,
    'paged' => max(1, (int) get_query_var('paged')),
    'orderby' => 'menu_order title',
    'order' => 'ASC',
];

if ($selected_service_category_term instanceof WP_Term) {
    $services_query_args['tax_query'] = [
        [
            'taxonomy' => 'sh_service_category',
            'field' => 'term_id',
            'terms' => (int) $selected_service_category_term->term_id,
            'include_children' => true,
        ],
    ];
} elseif ($service_parent_category_id) {
    $services_query_args['tax_query'] = [
        [
            'taxonomy' => 'sh_service_category',
            'field' => 'term_id',
            'terms' => $service_parent_category_id,
            'include_children' => true,
        ],
    ];
}

$services_query = new WP_Query($services_query_args);
$all_services_count_args = [
    'post_type' => 'sh_service',
    'posts_per_page' => 1,
    'fields' => 'ids',
];

if ($service_parent_category_id) {
    $all_services_count_args['tax_query'] = [
        [
            'taxonomy' => 'sh_service_category',
            'field' => 'term_id',
            'terms' => $service_parent_category_id,
            'include_children' => true,
        ],
    ];
}

$all_services_count_query = new WP_Query($all_services_count_args);
$all_services_count = (int) $all_services_count_query->found_posts;
$previous_wp_query = $GLOBALS['wp_query'];
$GLOBALS['wp_query'] = $services_query;

get_header();
sportshealing_breadcrumb($listing_title);
?>
<section class="services-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <?php if (!is_wp_error($service_categories) && $service_categories) : ?>
            <div class="row justify-content-center mb-50">
                <div class="col-lg-10">
                    <div class="widget widget-categories-list">
                        <div class="widget-content">
                            <ul class="category-list">
                                <li>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="<?php echo $selected_service_category ? '' : 'active'; ?>">
                                        <span class="categories-name"><?php echo esc_html(sprintf(__('All %s', 'sportshealing'), $service_parent_category_name)); ?></span>
                                        <span class="categories-count">(<?php echo esc_html((string) $all_services_count); ?>)</span>
                                    </a>
                                </li>
                                <?php foreach ($service_categories as $category) : ?>
                                    <li>
                                        <a href="<?php echo esc_url(sportshealing_service_category_filter_url($category, get_the_ID())); ?>" class="<?php echo $selected_service_category === $category->slug ? 'active' : ''; ?>">
                                            <span class="categories-name"><?php echo esc_html($category->name); ?></span>
                                            <span class="categories-count">(<?php echo esc_html((string) $category->count); ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php if ($services_query->have_posts()) : ?>
            <?php while ($services_query->have_posts()) : $services_query->the_post(); ?>
                <?php $icon = sportshealing_media_url(sportshealing_field_value(get_the_ID(), 'sportshealing_service_icon'), 'assets/images/joint-icon-29.png'); ?>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="service-items background-one">
                        <div class="service-icon">
                            <figure><img src="<?php echo esc_url($icon); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                        </div>
                        <div class="service-content">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(get_the_excerpt()); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php else : ?>
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2><?php esc_html_e('No services found', 'sportshealing'); ?></h2>
                        <p><?php esc_html_e('Please choose another service category.', 'sportshealing'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php sportshealing_pagination(); ?>
    </div>
</section>
<?php
wp_reset_postdata();
$GLOBALS['wp_query'] = $previous_wp_query;
// sportshealing_newsletter_cta();
get_footer();
