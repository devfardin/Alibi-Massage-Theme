<?php

class SINGLE_MASSEUR
{
    public function __construct()
    {
        add_shortcode('single_masseur', array($this, 'single_masseur_shortcode'));
    }
    public function single_masseur_shortcode()
    {
        ob_start(); ?>
        <!-- signle page wrapper -->
        <div class="alibi-single-masseur__wrapper">
            <!-- breadcrumbs -->
            <?php if (function_exists("rank_math_the_breadcrumbs"))
                rank_math_the_breadcrumbs(); ?>

            <div class="alibi-single-masseur__inner">
                <!-- grid 1 -->
                <div class="masseur-profile__wrap">
                    <div class="masseur-profile__inner">
                        <div class="masseur-profile__img">
                            <img src="<?php echo esc_attr(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                        <div class="masseur-profile__info">
                            <h1 class="masseur__title">
                              <?php echo esc_html(the_title()); ?>
                            </h1>

                            <div class="masseur-profile__details">
                                <div class="masseur-profile__detail-item">
                                    <span> <i class="fas fa-birthday-cake"></i>
                                        Age:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'age', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-ruler"></i>
                                        Height:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'height', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-balance-scale"></i>
                                        Weight:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'weight', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-heart"></i>
                                        Breasts:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'breasts', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-palette"></i>
                                        Hair Color:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'hair_color', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-eye"></i>
                                        Eye Color:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'eye_color', true)); ?>
                                    </span>
                                </div>
                                <div class="masseur-profile__detail-item">
                                    <span>
                                        <i class="fas fa-language"></i>
                                        Language:
                                    </span>
                                    <span>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'language', true)); ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Button wrapper here -->
                            <div class="masseur-profile__btns">

                                <a class="masseur-profile__btn primary-btn contact-btn">
                                    Book Appointment
                                </a>
                                <a href="https://wa.me/420773590108" target='_blank' class="masseur-profile__btn whatsapp-btn">
                                    <i class="fab fa-whatsapp"></i>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- grid 2 -->
                <div class="masseur-details_wrap">

                    <!-- About me  -->
                    <div class="masseur-details__item">
                        <h1 class="item_title">
                            <i class="fa fa-user-edit"></i>
                            About Me
                        </h1>
                        <div class="profile_description">
                            <?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), 'profile_description', true))); ?>
                        </div>
                    </div>

                    <!-- This Week's Schedule  -->
                    <div class="masseur-details__item">
                        <h1 class="item_title">
                            <i class="far fa-calendar-alt"></i>
                            This Week's Schedule
                        </h1>
                        <div class="list_of_week_schedule">
                            <?php $days = array(
                                'monday' => 'Monday',
                                'tuesday' => 'Tuesday',
                                'wednesday' => 'Wednesday',
                                'thursday' => 'Thursday',
                                'friday' => 'Friday',
                                'saturday' => 'Saturday',
                                'sunday' => 'Sunday'
                            );

                            foreach ($days as $day_key => $day_name):
                                $schedule = get_post_meta(get_the_ID(), 'opening_hours_' . $day_key, true);
                                if ($schedule): ?>
                                    <div
                                        class="list_of_week_schedule-item <?php echo esc_attr($schedule) == 'Off' ? 'off-mark' : ''; ?>">
                                        <span>
                                            <?php echo $day_name; ?>:
                                        </span>
                                        <span>
                                            <?php echo esc_html($schedule); ?>
                                        </span>
                                    </div>
                                <?php endif;
                            endforeach; ?>
                        </div>
                    </div>

                    <!-- Services Included  -->
                    <div class="masseur-details__item">
                        <h1 class="item_title">
                            <i class="icon icon-server-2"></i>
                            Services Included
                        </h1>
                        <div class="services_offered-list">
                            <?php
                            $services = get_the_terms(get_the_ID(), 'service');
                            if ($services && !is_wp_error($services)):
                                foreach ($services as $service): ?>
                                    <a class="services_offered-list__item"
                                        href="<?php echo esc_attr(get_tag_link($service->term_id)) ?>" class="service-tag">
                                        <i class="fas fa-check-circle"></i>
                                        <?php echo esc_html($service->name); ?>
                                    </a>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    </div>

                    <!-- Additional Services  -->
                    <div class="masseur-details__item">
                        <h1 class="item_title">
                            <i class="icon icon-list"></i>
                            Additional Services
                        </h1>

                        <div class="additional-services__list">
                            <?php $additional_services = get_option('additional_services_settings');
                            foreach ($additional_services['service_group'] as $service): ?>
                                <div class="additional-services__list__item">
                                    <span>
                                        <?php echo esc_html($service['title']); ?>
                                    </span>
                                    <span>
                                        <?php
                                        $value = $service['price'];
                                        $value = floatval(str_replace(',', '', $value));

                                        echo esc_html(number_format($value, 0)) ?> CZK
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Image Gallery  -->
                    <div class="masseur-details__item">
                        <h1 class="item_title">
                            <i class="fas fa-images"></i>
                            Image Gallery
                        </h1>
                        <div>
                            <?php
                            wp_enqueue_style('photoswipe-css');
                            $image_ids = get_post_meta(get_the_ID(), 'image_gallery', true);
                            if (!empty($image_ids)): ?>
                                <div class="masseur-image-gallery">
                                    <?php foreach ($image_ids as $image_id):
                                        $image_url = wp_get_attachment_image_url($image_id, 'large'); ?>

                                        <a href='<?php echo $image_url ?>' data-lightbox="example-set" class='item example-image-link'>
                                            <img src="<?php echo esc_attr($image_url) ?>"
                                                alt="<?php echo esc_attr(get_the_title()); ?>">
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <?php
                                wp_enqueue_script('photoswipe');
                            endif; ?>
                        </div>
                    </div>
                    <!-- Image Gallery end -->
                </div>
            </div>
        </div>
        <!-- signle page wrapper -->
        <?php return ob_get_clean();
    }

}