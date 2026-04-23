<?php
/**
 * Normalize converted templates to use global header.php and footer.php.
 */

$theme_dir = dirname(__DIR__) . '/wp-content/themes/sportshealing';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($theme_dir . '/templates', FilesystemIterator::SKIP_DOTS));

foreach ($files as $file_info) {
    if ($file_info->getExtension() !== 'php') {
        continue;
    }

    $path = $file_info->getPathname();
    $contents = file_get_contents($path);

    if ($contents === false || strpos($contents, '<!DOCTYPE html>') === false) {
        continue;
    }

    if (!preg_match('/^(<\?php\s*\/\*\*.*?\*\/\s*\?>)/s', $contents, $header_match)) {
        continue;
    }

    if (!preg_match('/<main class="main">\s*(.*?)\s*<\/main>/s', $contents, $main_match)) {
        continue;
    }

    $main = rtrim($main_match[1]);
    $new_contents = $header_match[1] . "\n<?php get_header(); ?>\n" . $main . "\n<?php get_footer(); ?>\n";

    file_put_contents($path, $new_contents);
}
