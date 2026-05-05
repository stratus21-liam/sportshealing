<?php
/**
 * Reusable 50/50 text and image/video rows.
 *
 * Expected args:
 * - post_id
 * - rows_field
 * - enabled_field
 * - has_previous_content
 */

$post_id = isset($args['post_id']) ? (int) $args['post_id'] : get_the_ID();
$enabled_field = isset($args['enabled_field']) ? (string) $args['enabled_field'] : '';
$rows_field = isset($args['rows_field']) ? (string) $args['rows_field'] : '';
$has_previous_content = !empty($args['has_previous_content']);
$enabled = $enabled_field ? (bool) sportshealing_field_value($post_id, $enabled_field, true) : true;
$content_rows = $rows_field ? sportshealing_repeater_value($post_id, $rows_field) : [];

if (!$enabled || !$content_rows) {
    return;
}

$section_classes = $has_previous_content
    ? 'content-media-rows-section pb-70 md-pb-50'
    : 'content-media-rows-section pt-100 md-pt-80 pb-70 md-pb-50';
?>
<section class="<?php echo esc_attr($section_classes); ?>">
    <div class="container">
        <?php foreach ($content_rows as $index => $row) : ?>
            <?php
            $media_position = $row['media_position'] ?? 'right';
            $media_type = $row['media_type'] ?? 'image';
            $has_media = $media_type !== 'none';
            $text_classes = !$has_media ? 'col-lg-12' : ($media_position === 'left' ? 'col-lg-6 order-lg-2' : 'col-lg-6');
            $media_classes = $media_position === 'left' ? 'col-lg-6 order-lg-1' : 'col-lg-6';
            ?>
            <div class="row align-items-center <?php echo $index ? 'pt-80 md-pt-50' : ''; ?>">
                <div class="<?php echo esc_attr($text_classes); ?>">
                    <div class="section-title mb-20">
                        <?php if (!empty($row['eyebrow'])) : ?>
                            <span class="sub-title"><?php echo esc_html((string) $row['eyebrow']); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($row['title'])) : ?>
                            <h2><?php echo esc_html((string) $row['title']); ?></h2>
                        <?php endif; ?>
                        <?php if (!empty($row['content'])) : ?>
                            <div class="service-entry-content">
                                <?php echo wp_kses_post((string) $row['content']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($has_media) : ?>
                    <div class="<?php echo esc_attr($media_classes); ?>">
                        <div class="content-media-rows-media">
                            <?php sportshealing_render_content_media_item($row); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
