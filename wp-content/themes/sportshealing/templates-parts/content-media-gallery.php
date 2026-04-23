<?php
/**
 * Reusable image/video gallery grid.
 *
 * Expected args:
 * - post_id
 * - items_field
 * - enabled_field
 * - has_previous_content
 */

$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();
$enabled_field = isset($args['enabled_field']) ? (string) $args['enabled_field'] : '';
$items_field = isset($args['items_field']) ? (string) $args['items_field'] : '';
$has_previous_content = !empty($args['has_previous_content']);
$enabled = $enabled_field ? (bool) sportshealing_field_value($post_id, $enabled_field, true) : true;
$media_items = $items_field ? sportshealing_repeater_value($post_id, $items_field) : [];

if (!$enabled || !$media_items) {
    return;
}

$section_classes = $has_previous_content
    ? 'content-media-gallery-section video-gallery-section pb-100 md-pb-80'
    : 'content-media-gallery-section video-gallery-section pt-100 md-pt-80 pb-100 md-pb-80';
?>
<section class="<?php echo esc_attr($section_classes); ?>">
    <div class="container">
        <div class="row">
            <?php foreach ($media_items as $item) : ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <?php
                    sportshealing_render_content_media_item(array_merge([
                        'image_fallback' => 'assets/images/gallery/gallery-1.jpg',
                        'video_fallback' => 'assets/images/video-gallery/video-gallery-1.jpg',
                    ], $item));
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
