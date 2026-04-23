<?php
/**
 * Template Name: Doctors
 *
 * Doctor listing template.
 */

$listing_title = sportshealing_meta_value(get_the_ID(), 'sportshealing_page_heading', get_the_title());
$doctors_query = new WP_Query([
    'post_type' => 'sh_doctor',
    'posts_per_page' => -1,
    'orderby' => 'menu_order title',
    'order' => 'ASC',
]);

get_header();
sportshealing_breadcrumb($listing_title);
?>
<section class="doctor-section-3 pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <?php while ($doctors_query->have_posts()) : $doctors_query->the_post(); ?>
                <?php $image = sportshealing_content_field_image_url(get_the_ID(), 'sportshealing_doctor_listing_image', 'assets/images/doctor/doctor-1.jpg'); ?>
                <div class="col-xl-4 col-md-6">
                    <div class="doctor-items">
                        <div class="doctor-image">
                            <a href="<?php the_permalink(); ?>"><figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure></a>
                        </div>
                        <div class="doctor-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo esc_html(sportshealing_meta_value(get_the_ID(), 'sportshealing_doctor_role')); ?></p>
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
