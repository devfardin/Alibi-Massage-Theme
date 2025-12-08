<?php

class SINGLE_MASSAGE
{
    public function __construct()
    {
        add_shortcode('single_massage', array($this, 'single_masseur_shortcode'));
    }
    public function single_masseur_shortcode()
    {
        ob_start(); ?>
        <!-- signle page wrapper -->
        <div class="alibi-single-massage__wrapper">
            <!-- breadcrumbs -->
            <?php if (function_exists("rank_math_the_breadcrumbs"))
                rank_math_the_breadcrumbs(); ?>
            <!-- Massage wrapper grid -->
            <div class="alibi-single-massage__inner">
                <!-- Grid one Massage information     -->
                <div>
                    <div class="massage_information__wrap">
                        <div class="massage_feature_image">
                            <?php echo get_the_post_thumbnail(get_the_ID()) ?>
                        </div>
                        <div class="massage_title_des">
                            <h1><?php echo esc_html(get_the_title(get_the_ID())); ?></h1>

                            <div class="message_description">
                                <?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), 'massage_description', true))); ?>
                            </div>
                            <button class="massage_show_more_btn">Show More</button>

                        </div>
                    </div>
                </div>

                <!-- Grid two Massage Procedure -->
                <div class="massage-procedure__info_wap">
                    <?php $additional_services = get_option('massage_procedure_settings'); ?>
                    <div class="massage-procedure__list">
                        <h2 class="massage-procedure__header"> <?php echo esc_html($additional_services['procedure_title']); ?>
                        </h2>
                        <?php foreach ($additional_services['procedure_steps'] as $service): ?>
                            <div class="massage-procedure__list__item">
                                <img src="<?php echo esc_url($service['image']); ?>" alt="">
                                <span class="massage-procedure__des">
                                    <?php echo wpautop(wp_kses_post($service['description'])); ?>
                                </span>
                                <span>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Price Section here -->
            <div class="massage_singe_price">
                <h2 class="pricing_heading">Price</h2>
            </div>
            <div class="massage_singe_price_wrapper">
                <div class="price-table-header">
                    <div class="header-cell">Minutes</div>
                    <div class="header-cell">1 Masseuse</div>
                    <div class="header-cell">2 Masseuses</div>
                </div>
                <div class="price-table-body">
                    <div class="price-table-row">
                        <div class="price-cell">30 Minutes</div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '30_minutes_1_masseuse_price', true); ?>
                        </div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '30_minutes_2_masseuse_price', true); ?>
                        </div>
                    </div>
                    <div class="price-table-row">
                        <div class="price-cell">60 Minutes</div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '60_minutes_1_masseuse_price', true); ?>
                        </div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '60_minutes_2_masseuse_price', true); ?>
                        </div>
                    </div>
                    <div class="price-table-row">
                        <div class="price-cell">90 Minutes</div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '90_minutes_1_masseuse_price', true); ?>
                        </div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '90_minutes_2_masseuse_price', true); ?>
                        </div>
                    </div>
                    <div class="price-table-row">
                        <div class="price-cell">120 Minutes</div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '120_minutes_1_masseuse_price', true); ?>
                        </div>
                        <div class="price-cell"><?php echo get_post_meta(get_the_ID(), '120_minutes_2_masseuse_price', true); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php


        return ob_get_clean();
    }
}