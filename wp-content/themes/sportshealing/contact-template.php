<?php
/**
 * Template Name: Contact
 */
?>
<?php get_header(); ?>
<?php if (sportshealing_section_enabled('sportshealing_contact_breadcrumb_enabled')) : ?>
    <?php sportshealing_render_template_part('breadcrumb.php', 'sportshealing_contact_breadcrumb'); ?>
<?php endif; ?>

                <?php if (sportshealing_section_enabled('sportshealing_contact_contact_form_enabled')) : ?>
    <?php sportshealing_render_template_part('contact-form.php', 'sportshealing_contact_contact_form'); ?>
<?php endif; ?>

<?php if (sportshealing_section_enabled('sportshealing_contact_map_enabled')) : ?>
                <!-- Google Map start -->
                <div class="google-map">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 p-0">
                                <!-- google map iframe start -->
                                <div class="google-map-iframe">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2396791.478889806!2d-5.623982693932331!3d54.08054089214548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x25a3b1142c791a9%3A0xc4f8a0433288257a!2sUnited%20Kingdom!5e0!3m2!1sen!2sin!4v1746685564327!5m2!1sen!2sin"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        title="google map"
                                    ></iframe>
                                </div>
                                <!-- google map iframe end -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Google Map end -->
<?php endif; ?>
<?php get_footer(); ?>
