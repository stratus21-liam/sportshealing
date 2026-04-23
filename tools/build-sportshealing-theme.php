<?php

$root = dirname(__DIR__);
$source = $root . '/carenix-html';
$theme = $root . '/wp-content/themes/sportshealing';

$ignored = [
    'sign-in.html',
    'wishlist.html',
    'shop.html',
    'shop-details.html',
    'register.html',
    'pricing.html',
    'forget-password.html',
    'cart.html',
    'checkout.html',
];

$template_names = [
    'index.html' => ['name' => 'Homepage 1', 'path' => 'templates/home/homepage-1.php'],
    'index-2.html' => ['name' => 'Homepage 2', 'path' => 'templates/home/homepage-2.php'],
    'index-3.html' => ['name' => 'Homepage 3', 'path' => 'templates/home/homepage-3.php'],
    'about.html' => ['name' => 'About', 'path' => 'templates/pages/about.php'],
    'appointment.html' => ['name' => 'Appointment', 'path' => 'templates/pages/appointment.php'],
    'contact.html' => ['name' => 'Contact', 'path' => 'templates/pages/contact.php'],
    'error.html' => ['name' => '404 Error', 'path' => 'templates/pages/error.php'],
    'faq.html' => ['name' => 'FAQ', 'path' => 'templates/pages/faq.php'],
    'image-gallery.html' => ['name' => 'Image Gallery', 'path' => 'templates/gallery/image-gallery.php'],
    'testimonials.html' => ['name' => 'Testimonials', 'path' => 'templates/pages/testimonials.php'],
    'video-gallery.html' => ['name' => 'Video Gallery', 'path' => 'templates/gallery/video-gallery.php'],
];

function ensure_dir(string $path): void {
    if (!is_dir($path)) {
        mkdir($path, 0775, true);
    }
}

function recurse_copy(string $src, string $dst): void {
    ensure_dir($dst);
    $items = scandir($src);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $from = $src . '/' . $item;
        $to = $dst . '/' . $item;
        if (is_dir($from)) {
            recurse_copy($from, $to);
            continue;
        }
        copy($from, $to);
    }
}

function convert_html(string $html): string {
    $html = preg_replace_callback(
        '/\b(href|src|data-img-src)=["\'](assets\/[^"\']+)["\']/',
        static function ($matches) {
            return $matches[1] . '="<?php echo esc_url( sportshealing_asset_url( \'' . addslashes($matches[2]) . '\' ) ); ?>"';
        },
        $html
    );

    $html = preg_replace(
        '/\bhref=["\']style\.css["\']/',
        'href="<?php echo esc_url( get_stylesheet_uri() ); ?>"',
        $html
    );

    $html = preg_replace_callback(
        '/\bhref=["\']([^"\']+\.html)(#[^"\']*)?["\']/',
        static function ($matches) {
            $file = addslashes($matches[1]);
            $fragment = isset($matches[2]) ? addslashes($matches[2]) : '';
            return 'href="<?php echo esc_url( sportshealing_static_url( \'' . $file . '\', \'' . $fragment . '\' ) ); ?>"';
        },
        $html
    );

    $html = str_replace('<html lang="en">', '<html <?php language_attributes(); ?>>', $html);
    $html = preg_replace('/<meta charset="UTF-8">/', '<meta charset="<?php bloginfo( \'charset\' ); ?>">', $html, 1);
    $html = str_replace('</head>', "        <?php wp_head(); ?>\n    </head>", $html);
    $html = str_replace('</body>', "        <?php wp_footer(); ?>\n    </body>", $html);

    return $html;
}

function write_php_template(string $path, string $template_name, string $html): void {
    ensure_dir(dirname($path));
    $content = "<?php\n/**\n * Template Name: {$template_name}\n */\n?>\n" . convert_html($html);
    file_put_contents($path, $content);
}

function integrate_layout_partials(string $theme): void {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($theme, FilesystemIterator::SKIP_DOTS));

    foreach ($files as $file_info) {
        if ($file_info->getExtension() !== 'php' || $file_info->getBasename() === 'functions.php') {
            continue;
        }

        $file = $file_info->getPathname();
        $contents = file_get_contents($file);
        $updated = preg_replace(
            '/\s*<!-- offcanvas sidebar start -->.*?<!-- header end-->\s*/s',
            "\n            <?php sportshealing_render_header(); ?>\n\n",
            $contents
        );
        $updated = preg_replace(
            '/\s*<!-- footer start -->.*?<!-- footer end -->\s*/s',
            "\n            <?php sportshealing_render_footer(); ?>\n",
            $updated
        );

        if ($updated !== $contents) {
            file_put_contents($file, $updated);
        }
    }
}

ensure_dir($theme);
recurse_copy($source . '/assets', $theme . '/assets');

$original_style = file_get_contents($source . '/style.css');
$style_header = <<<CSS
/*
Theme Name: SportsHealing
Theme URI: https://sportshealing.local/
Author: SportsHealing
Description: WordPress conversion of the Carenix HTML template for SportsHealing.
Version: 1.0.0
Text Domain: sportshealing
*/

CSS;
file_put_contents($theme . '/style.css', $style_header . $original_style);

foreach ($template_names as $file => $template) {
    $html = file_get_contents($source . '/' . $file);
    $destination = $theme . '/' . $template['path'];
    write_php_template($destination, $template['name'], $html);
}

$singles = [
    'services-details.html' => 'templates/services/service-detail-template.php',
    'portfolio-details.html' => 'templates/portfolio/portfolio-detail-template.php',
    'doctor-details.html' => 'templates/doctors/doctor-detail-template.php',
];

foreach ($singles as $file => $destination) {
    $html = file_get_contents($source . '/' . $file);
    ensure_dir(dirname($theme . '/' . $destination));
    file_put_contents($theme . '/' . $destination, "<?php\n/**\n * Static detail foundation for " . str_replace(['-details.html', '.html'], '', $file) . " posts.\n */\n?>\n" . convert_html($html));
}

$listings = [
    'services.html' => 'templates/services/service-listing-template.php',
    'portfolio.html' => 'templates/portfolio/portfolio-listing-template.php',
    'doctor.html' => 'templates/doctors/doctor-listing-template.php',
];

foreach ($listings as $file => $destination) {
    $html = file_get_contents($source . '/' . $file);
    ensure_dir(dirname($theme . '/' . $destination));
    file_put_contents($theme . '/' . $destination, "<?php\n/**\n * Static listing foundation.\n */\n?>\n" . convert_html($html));
}

file_put_contents($theme . '/index.php', "<?php\n/**\n * Required WordPress fallback template.\n */\n\nget_template_part('templates/home/homepage-1');\n");

integrate_layout_partials($theme);

$ignored_list = implode("\n", array_map(static fn ($item) => '- `carenix-html/' . $item . '`', $ignored));
$readme = <<<MD
# SportsHealing Theme Phase 2 Notes

The first conversion phase intentionally ignores these Carenix templates:

{$ignored_list}

Phase 2 can convert these into WooCommerce/auth/account flows or custom WordPress templates once the CMS/content model is agreed.

Current foundation:

- Static page templates exist for the general pages and homepage variants.
- Three homepage templates are selectable in the CMS: Homepage 1, Homepage 2, and Homepage 3.
- Custom post types exist for Services, Portfolio, and Doctors.
- Detail pages for Services, Portfolio, and Doctors render through listing/detail template filenames.
- Headers and footers are rendered through shared theme functions so ACF Header/Footer records can select a homepage template family, variant, and show/hide individual HTML sections.

Next suggested phase:

- Replace static text/images in detail templates with WordPress fields.
- Wire listing cards to real CMS posts.
- Decide whether shop/cart/checkout should be WooCommerce or custom templates.
- Replace hard-coded menus with `wp_nav_menu()`.

MD;
file_put_contents($root . '/readme.md', $readme);
