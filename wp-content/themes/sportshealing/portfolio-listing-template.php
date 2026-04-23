<?php
/**
 * Template Name: Portfolio
 *
 * Portfolio listing template.
 */

$listing_title = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_heading', get_the_title());
$listing_eyebrow = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_eyebrow');
$listing_intro = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_intro');
$portfolio_query = new WP_Query([
    'post_type' => 'sh_portfolio',
    'posts_per_page' => -1,
    'orderby' => 'menu_order title',
    'order' => 'ASC',
]);

get_header();
sportshealing_breadcrumb($listing_title);
?>
<section class="portfolio-section-2 pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area">
                    <div class="section-title">
                        <?php if ($listing_eyebrow) : ?>
                            <span class="sub-title"><?php echo esc_html($listing_eyebrow); ?></span>
                        <?php endif; ?>
                        <h2><?php echo esc_html($listing_title); ?></h2>
                    </div>
                    <?php if ($listing_intro) : ?>
                        <div class="section-title-content">
                            <p><?php echo esc_html($listing_intro); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
                <?php $image = sportshealing_content_field_image_url(get_the_ID(), 'sportshealing_portfolio_listing_image', 'assets/images/portfolio/portfolio-3-1.jpg'); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-items">
                        <div class="portfolio-image">
                            <a href="<?php the_permalink(); ?>"><figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure></a>
                        </div>
                        <div class="portfolio-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo esc_html(sportshealing_meta_value(get_the_ID(), 'sportshealing_portfolio_category')); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php sportshealing_pagination(); ?>
    </div>
</section>
<?php
wp_reset_postdata();
// sportshealing_newsletter_cta();
get_footer();
