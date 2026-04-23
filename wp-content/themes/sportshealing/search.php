<?php
/**
 * Search results template.
 */

$search_query = get_search_query();

get_header();
sportshealing_breadcrumb(
    $search_query
        ? sprintf(__('Search Results for: %s', 'sportshealing'), $search_query)
        : __('Search Results', 'sportshealing')
);
?>
<section class="services-section-1 pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="row">
                <?php while (have_posts()) : ?>
                    <?php the_post(); ?>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="service-items background-one">
                            <div class="service-content">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php esc_html_e('More Details', 'sportshealing'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php sportshealing_pagination(); ?>
        <?php else : ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2><?php esc_html_e('No results found', 'sportshealing'); ?></h2>
                        <p><?php esc_html_e('Please try another search term.', 'sportshealing'); ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
