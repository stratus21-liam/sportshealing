<?php
/**
 * Global theme document head and opening layout.
 */

if (!defined('ABSPATH')) {
    exit;
}

$sportshealing_loader = function_exists('sportshealing_theme_loader_settings') ? sportshealing_theme_loader_settings() : [
    'enabled' => true,
    'text' => 'Sports',
    'image' => 'assets/images/loader.svg',
];
$sportshealing_loader_text = trim((string) ($sportshealing_loader['text'] ?? 'Sports'));
$sportshealing_loader_letters = $sportshealing_loader_text !== '' ? preg_split('//u', $sportshealing_loader_text, -1, PREG_SPLIT_NO_EMPTY) : [];
$sportshealing_has_site_icon = function_exists('has_site_icon') && has_site_icon();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if (!$sportshealing_has_site_icon) : ?>
            <link rel="shortcut icon" href="<?php echo esc_url(sportshealing_asset_url('assets/images/favicon.png')); ?>" type="image/x-icon">
            <link rel="icon" href="<?php echo esc_url(sportshealing_asset_url('assets/images/favicon.png')); ?>" type="image/x-icon">
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div class="page-wrapper">
            <?php if (!empty($sportshealing_loader['enabled'])) : ?>
                <div class="preloader">
                    <div class="preloader-icon">
                        <img src="<?php echo esc_url(sportshealing_theme_loader_image_url($sportshealing_loader['image'] ?? '')); ?>" alt="<?php esc_attr_e('Loading', 'sportshealing'); ?>">
                    </div>
                    <?php if ($sportshealing_loader_letters) : ?>
                        <div class="preloader-text">
                            <?php foreach ($sportshealing_loader_letters as $sportshealing_loader_letter) : ?>
                                <p><?php echo esc_html($sportshealing_loader_letter); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <button id="back-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'sportshealing'); ?>">
                <i class="fa-solid fa-chevron-up"></i>
            </button>
            <div class="mouse-cursor cursor-outer"></div>
            <div class="mouse-cursor cursor-inner"></div>
            <?php sportshealing_render_header(); ?>
            <main class="main">
