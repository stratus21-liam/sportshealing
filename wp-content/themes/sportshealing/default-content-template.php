<?php
/**
 * Template Name: Default Content
 *
 * Flexible content template for general SEO/content pages.
 */

$page_id = get_the_ID();
$listing_title = sportshealing_meta_value($page_id, 'sportshealing_page_heading', get_the_title());
$breadcrumb_enabled = (bool) sportshealing_field_value($page_id, 'sportshealing_default_content_breadcrumb_enabled', true);
$breadcrumb_image = sportshealing_media_url(
    sportshealing_field_value($page_id, 'sportshealing_default_content_breadcrumb_image'),
    'assets/images/breadcrumb/breadcrumb.png'
);
$has_page_content = trim((string) get_post_field('post_content', $page_id)) !== '';
$content_rows_enabled = (bool) sportshealing_field_value($page_id, 'sportshealing_default_content_rows_enabled', true);
$content_rows = sportshealing_repeater_value($page_id, 'sportshealing_default_content_rows');
$media_items_enabled = (bool) sportshealing_field_value($page_id, 'sportshealing_default_content_media_items_enabled', true);
$media_items = sportshealing_repeater_value($page_id, 'sportshealing_default_content_media_items');
$cta_enabled = (bool) sportshealing_field_value($page_id, 'sportshealing_default_content_cta_enabled', true);

if (!function_exists('sportshealing_default_content_render_cta')) {
function sportshealing_default_content_render_cta(int $page_id, bool $has_previous_content = true): void {
    $heading = sportshealing_meta_value($page_id, 'sportshealing_default_content_cta_heading', 'Ready To Get Started?');
    $copy = sportshealing_meta_value($page_id, 'sportshealing_default_content_cta_copy', 'Speak to our team and find the right next step for you.');
    $button_label = sportshealing_meta_value($page_id, 'sportshealing_default_content_cta_button_label', 'Book Appointment');
    $button_page = sportshealing_field_value($page_id, 'sportshealing_default_content_cta_button_page');
    $button_page_id = 0;

    if ($button_page instanceof WP_Post) {
        $button_page_id = (int) $button_page->ID;
    } elseif (is_array($button_page) && isset($button_page['ID'])) {
        $button_page_id = (int) $button_page['ID'];
    } elseif (is_numeric($button_page)) {
        $button_page_id = (int) $button_page;
    }

    $button_url = $button_page_id ? get_permalink($button_page_id) : home_url('/');

    if (!$heading && !$copy && !$button_label) {
        return;
    }

    $section_classes = trim(($has_previous_content ? '' : 'pt-100 md-pt-80 ') . 'cta-section-3 pb-100 md-pb-80');
    ?>
    <section class="<?php echo esc_attr($section_classes); ?>">
        <div class="container">
            <div class="cta-wapper" data-img-src="<?php echo esc_url(sportshealing_asset_url('assets/images/cta/background-cta-shape.png')); ?>">
                <div class="row align-items-end justify-content-between">
                    <div class="col-lg-5">
                        <div class="cta-content">
                            <div class="section-title">
                                <?php if ($heading) : ?>
                                    <h2><?php echo esc_html($heading); ?></h2>
                                <?php endif; ?>
                                <?php if ($copy) : ?>
                                    <p><?php echo esc_html($copy); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cta-form">
                            <div class="cta-shape"><img src="<?php echo esc_url(sportshealing_asset_url('assets/images/cta/cta-shape-1.png')); ?>" alt=""></div>
                            <?php if ($button_label) : ?>
                                <a href="<?php echo esc_url($button_url); ?>" class="theme-button style-3" aria-label="<?php echo esc_attr($button_label); ?>">
                                    <span data-text="<?php echo esc_attr($button_label); ?>"><?php echo esc_html($button_label); ?></span>
                                    <i class="fa-solid fa-paper-plane"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
}

get_header();

if ($breadcrumb_enabled) {
    sportshealing_breadcrumb($listing_title, [], $breadcrumb_image);
}
?>
<?php if ($has_page_content && have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php if (trim(get_the_content()) !== '') : ?>
            <section class="default-content-section pt-100 md-pt-80 pb-70 md-pb-50">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="service-entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_template_part('templates-parts/content-media-rows', null, [
    'post_id' => $page_id,
    'enabled_field' => 'sportshealing_default_content_rows_enabled',
    'rows_field' => 'sportshealing_default_content_rows',
    'has_previous_content' => $has_page_content,
]);

get_template_part('templates-parts/content-media-gallery', null, [
    'post_id' => $page_id,
    'enabled_field' => 'sportshealing_default_content_media_items_enabled',
    'items_field' => 'sportshealing_default_content_media_items',
    'has_previous_content' => $has_page_content || ($content_rows_enabled && (bool) $content_rows),
]);
?>

<?php
if ($cta_enabled) {
    sportshealing_default_content_render_cta(
        $page_id,
        $has_page_content || ($content_rows_enabled && (bool) $content_rows) || ($media_items_enabled && (bool) $media_items)
    );
}

get_footer();
