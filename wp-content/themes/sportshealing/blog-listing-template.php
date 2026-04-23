<?php
/**
 * Template Name: Blog
 *
 * Blog listing template.
 */

$listing_title = sportshealing_option_value('sportshealing_blog_listing_title');

get_header();

if (sportshealing_section_enabled('sportshealing_blog_breadcrumb_enabled')) {
    sportshealing_breadcrumb($listing_title);
}

$blog_query = is_home() && have_posts() ? null : new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 4,
    'paged' => max(1, (int) get_query_var('paged')),
]);

$loop = $blog_query ?: $GLOBALS['wp_query'];
?>
<?php if (sportshealing_section_enabled('sportshealing_blog_blog_list_enabled')) : ?>
<section class="blog-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-posts">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php $image = sportshealing_content_image_url(get_the_ID(), sportshealing_meta_value(get_the_ID(), 'sportshealing_blog_listing_image', 'assets/images/blog/blog-1.jpg')); ?>
                        <div class="single-blog-post">
                            <div class="post-image">
                                <a href="<?php the_permalink(); ?>">
                                    <figure><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                                </a>
                            </div>
                            <div class="post-content">
                                <ul class="post-meta">
                                    <li><a href="<?php echo esc_url(get_author_posts_url((int) get_the_author_meta('ID'))); ?>"><i class="fa-solid fa-user"></i><span><?php echo esc_html(sprintf(__('By: %s', 'sportshealing'), get_the_author())); ?></span></a></li>
                                    <li><i class="fa-solid fa-calendar-days"></i><span><?php echo esc_html(get_the_date()); ?></span></li>
                                </ul>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php the_excerpt(); ?>
                                <div class="blog-list-button">
                                    <a href="<?php the_permalink(); ?>" class="theme-button style-1" aria-label="<?php esc_attr_e('Read More', 'sportshealing'); ?>">
                                        <span data-text="<?php esc_attr_e('Read More', 'sportshealing'); ?>"><?php esc_html_e('Read More', 'sportshealing'); ?></span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php sportshealing_pagination(); ?>
            </div>
            <div class="col-lg-4">
                <?php get_template_part('templates-parts/blog-sidebar'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php
wp_reset_postdata();
get_footer();
