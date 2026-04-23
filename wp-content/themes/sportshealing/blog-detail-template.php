<?php
/**
 * Single blog post template.
 */

the_post();
get_header();
sportshealing_breadcrumb(get_the_title(), [__('Blog', 'sportshealing') => get_permalink((int) get_option('page_for_posts'))]);
$image = sportshealing_content_image_url(get_the_ID(), sportshealing_meta_value(get_the_ID(), 'sportshealing_blog_listing_image', 'assets/images/blog/blog-1.jpg'));
?>
<?php if (sportshealing_section_enabled('sportshealing_blog_detail_content_enabled')) : ?>
<section class="blog-single-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="single-blog-post">
                    <div class="post-image">
                        <figure><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                    </div>
                    <div class="post-content">
                        <ul class="post-meta">
                            <li><a href="<?php echo esc_url(get_author_posts_url((int) get_the_author_meta('ID'))); ?>"><i class="fa-solid fa-user"></i><span><?php echo esc_html(sprintf(__('By: %s', 'sportshealing'), get_the_author())); ?></span></a></li>
                            <li><i class="fa-solid fa-calendar-days"></i><span><?php echo esc_html(get_the_date()); ?></span></li>
                        </ul>
                        <h2><?php the_title(); ?></h2>
                        <div class="service-entry-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <?php get_template_part('templates-parts/blog-sidebar'); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
