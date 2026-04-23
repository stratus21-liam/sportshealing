<?php

$theme = dirname(__DIR__) . '/wp-content/themes/sportshealing';
$files = glob($theme . '/*.php');

foreach ($files as $file) {
    $name = basename($file);
    if ($name === 'functions.php') {
        continue;
    }

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

