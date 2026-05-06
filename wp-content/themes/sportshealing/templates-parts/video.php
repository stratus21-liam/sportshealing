<?php
$video_button_label = sportshealing_acf_section_text('button_label') ?: __('Explore More', 'sportshealing');
$video_button_url = sportshealing_acf_section_page_url('button_page', sportshealing_static_url('about.html', ''));
$video_source = sportshealing_acf_section_text('video_source') ?: 'youtube';
$video_url = sportshealing_acf_section_text('video_url') ?: 'https://www.youtube.com/watch?v=Y-x0efG1seA';
$video_file = sportshealing_acf_section_value('video_file');
$video_file_url = '';

if (is_array($video_file)) {
    $video_file_url = isset($video_file['url']) ? (string) $video_file['url'] : '';
} elseif (is_numeric($video_file)) {
    $video_file_url = (string) wp_get_attachment_url((int) $video_file);
} elseif (is_scalar($video_file)) {
    $video_file_url = (string) $video_file;
}

$video_uses_file = $video_source === 'file' && $video_file_url;
$video_display = sportshealing_acf_section_text('video_display') ?: 'modal';
$video_uses_background = $video_uses_file && $video_display === 'background';
$video_popup_class = $video_uses_file ? 'video-file-popup video-play play-center' : 'video-popup video-play play-center';
$video_popup_url = $video_uses_file ? '#sportshealing-video-file-popup' : $video_url;
$video_section_classes = 'video-section pt-100 md-pt-80' . ($video_uses_background ? ' has-background-video' : '');
$video_background_image = sportshealing_acf_section_named_image_url('background_image', 'assets/images/video/video-3-1.jpg');
?>
<!-- video section start -->
                <section class="<?php echo esc_attr($video_section_classes); ?>"<?php echo $video_uses_background ? '' : ' data-img-src="' . esc_url($video_background_image) . '"'; ?>>
                    <?php if ($video_uses_background) : ?>
                        <video class="sportshealing-background-video" autoplay muted loop playsinline preload="metadata">
                            <source src="<?php echo esc_url($video_file_url); ?>">
                        </video>
                    <?php endif; ?>
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-5">
                                <div class="video-content wow fadeInUp" data-wow-delay=".2s">
                                    <div class="section-title">
                                        <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                        <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                    </div>
                                    <div class="video-button-wapper">
                                        <a href="<?php echo esc_url($video_button_url); ?>" class="theme-button style-4" aria-label="<?php echo esc_attr($video_button_label); ?>">
                                            <span data-text="<?php echo esc_attr($video_button_label); ?>"><?php echo esc_html($video_button_label); ?></span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php if (!$video_uses_background) : ?>
                                <div class="col-lg-5">
                                    <div class="video-circle wow fadeInUp" data-wow-delay=".3s">
                                        <a class="<?php echo esc_attr($video_popup_class); ?>" href="<?php echo esc_attr($video_popup_url); ?>"<?php echo $video_uses_file ? ' data-mfp-src="' . esc_attr($video_popup_url) . '"' : ''; ?> aria-label="<?php esc_attr_e('Play video', 'sportshealing'); ?>">
                                            <span class="icon"><i class="fa-solid fa-play"></i></span>
                                        </a>
                                        <?php if ($video_uses_file) : ?>
                                            <div id="sportshealing-video-file-popup" class="sportshealing-video-file-popup mfp-hide">
                                                <video controls preload="metadata">
                                                    <source src="<?php echo esc_url($video_file_url); ?>">
                                                    <?php esc_html_e('Your browser does not support the video tag.', 'sportshealing'); ?>
                                                </video>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <!-- video section end -->
