<!-- error section start -->
                <section class="error-section pt-100 md-pt-80 pb-100 md-pb-80">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="error-box text-center">
                                    <div class="error-image">
                                        <img src="<?php echo esc_url(sportshealing_acf_section_image_url('assets/images/error/error.jpg')); ?>" alt="error image">
                                    </div>
                                    <div class="error-content pt-50">
                                        <div class="section-title">
                                            <h2><?php echo esc_html(sportshealing_acf_section_text('heading')); ?></h2>
                                            <p><?php echo wp_kses_post(sportshealing_acf_section_text('copy')); ?></p>
                                        </div>
                                        <a href="<?php echo esc_url( sportshealing_static_url( 'index.html', '' ) ); ?>" class="theme-button style-1" aria-label="Back to Home">
                                            <span data-text="Back to Home">Back to Home</span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- error section end -->