<?php
/**
 * Doctor detail template.
 */

the_post();
get_header();

$post_id = get_the_ID();
$image = sportshealing_media_url(sportshealing_field_value($post_id, 'sportshealing_doctor_detail_image'), 'assets/images/doctor/single-doctor-1.jpg');
$role = sportshealing_meta_value($post_id, 'sportshealing_doctor_role', 'Lorem Ipsum Specialist');
$social_links = sportshealing_repeater_value($post_id, 'sportshealing_doctor_social_links');
$info_list = sportshealing_repeater_value($post_id, 'sportshealing_doctor_info_list');
$awards = sportshealing_repeater_value($post_id, 'sportshealing_doctor_awards');
$skills = sportshealing_repeater_value($post_id, 'sportshealing_doctor_skills');

sportshealing_breadcrumb(get_the_title(), [__('Doctors', 'sportshealing') => sportshealing_listing_page_url('doctors')]);
?>
<section class="doctor-single-section pt-100 md-pt-80 pb-100 md-pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="doctor-single-left">
                    <div class="image-1 mb-30">
                        <figure class="image-anime"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>"></figure>
                    </div>
                    <div class="section-title gap-2 mb-30">
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo esc_html($role); ?></p>
                    </div>
                    <?php if ($social_links) : ?>
                        <?php sportshealing_render_social_links($social_links); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="doctor-single-right">
                    <div class="doctor-biography">
                        <h3><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_doctor_biography_heading', 'Biography')); ?></h3>
                        <div class="desc"><?php the_content(); ?></div>
                        <?php if ($info_list) : ?>
                            <ul class="doctor-info-list">
                                <?php foreach ($info_list as $info) : ?>
                                    <li>
                                        <span class="text-black fw-bold"><?php echo esc_html($info['label'] ?? 'Lorem Ipsum:'); ?></span>
                                        <span><?php echo esc_html($info['value'] ?? 'Lorem Ipsum'); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="doctor-awards">
                        <h3><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_doctor_awards_heading', 'Awards & Hours')); ?></h3>
                        <p class="desc"><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_doctor_awards_intro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
                        <?php if ($awards) : ?>
                            <div class="doctor-awards-wappper">
                                <?php foreach ($awards as $award) : ?>
                                    <div class="doctor-awards-item">
                                        <div class="doctor-awards-icon">
                                            <figure><img src="<?php echo esc_url(sportshealing_media_url($award['image'] ?? '', 'assets/images/doctor/awards-1.png')); ?>" alt=""></figure>
                                        </div>
                                        <div class="doctor-awards-content">
                                            <p class="black-color fw-bold mb-0"><?php echo esc_html($award['label'] ?? 'Lorem Ipsum'); ?></p>
                                            <p class="mb-0"><?php echo esc_html($award['source'] ?? 'Lorem Ipsum'); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="doctor-skills">
                        <h3><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_doctor_skills_heading', 'My Skills')); ?></h3>
                        <p><?php echo esc_html(sportshealing_meta_value($post_id, 'sportshealing_doctor_skills_intro', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')); ?></p>
                        <?php if ($skills) : ?>
                            <div class="skill-progress-wapper pt-10">
                                <?php foreach ($skills as $skill) : ?>
                                    <?php $percent = max(0, min(100, (int) ($skill['percent'] ?? 0))); ?>
                                    <div class="single-progressbar">
                                        <div class="progress-title"><?php echo esc_html($skill['label'] ?? 'Lorem Ipsum'); ?></div>
                                        <div class="progressbar">
                                            <div class="progress-bar-count counted" data-percent="<?php echo esc_attr($percent . '%'); ?>"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//sportshealing_newsletter_cta();
get_footer();
