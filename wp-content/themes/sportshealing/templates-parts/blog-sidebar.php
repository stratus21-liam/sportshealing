<?php
/**
 * Blog sidebar partial.
 */

$recent_posts = get_posts([
    'post_type' => 'post',
    'posts_per_page' => 3,
]);
?>
<div class="widget-sidebar">
    <div class="widget widget-search">
        <div class="widget-title"><h3><?php esc_html_e('Search', 'sportshealing'); ?></h3></div>
        <div class="widget-content">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                <div class="form-group mb-0">
                    <div class="form-floating field-inner">
                        <input id="widgetsearch" name="s" class="form-control white-field" placeholder="<?php esc_attr_e('Search here', 'sportshealing'); ?>" type="text" autocomplete="off">
                        <label for="widgetsearch"><?php esc_html_e('Search', 'sportshealing'); ?></label>
                        <button type="submit" aria-label="<?php esc_attr_e('Search submit', 'sportshealing'); ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="widget widget-categories-list">
        <div class="widget-title"><h3><?php esc_html_e('Categories List', 'sportshealing'); ?></h3></div>
        <div class="widget-content">
            <ul class="category-list">
                <?php foreach (get_categories(['hide_empty' => false]) as $category) : ?>
                    <li><a href="<?php echo esc_url(get_category_link($category)); ?>"><span class="categories-name"><?php echo esc_html($category->name); ?></span> <span class="categories-count">(<?php echo esc_html((string) $category->count); ?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="widget widget-recent-post">
        <div class="widget-title"><h3><?php esc_html_e('Recent Post', 'sportshealing'); ?></h3></div>
        <div class="widget-content">
            <?php foreach ($recent_posts as $recent_post) : ?>
                <?php $image = sportshealing_content_image_url($recent_post->ID, sportshealing_meta_value($recent_post->ID, 'sportshealing_blog_listing_image', 'assets/images/widgets/recent-post/recent-post-1.jpg')); ?>
                <div class="recent-post-item d-flex">
                    <div class="recent-post-image flex-shrink-0">
                        <figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title($recent_post)); ?>"></figure>
                    </div>
                    <div class="recent-post-content flex-grow-1 ms-3">
                        <h4><a href="<?php echo esc_url(get_permalink($recent_post)); ?>"><?php echo esc_html(get_the_title($recent_post)); ?></a></h4>
                        <p class="post-date"><i class="fa-solid fa-calendar-days"></i><?php echo esc_html(get_the_date('', $recent_post)); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
