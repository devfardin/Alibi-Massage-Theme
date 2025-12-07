<?php

class SINGLE_MASSAGE
{
    public function __construct()
    {
        add_shortcode('single_masseur', array($this, 'single_masseur_shortcode'));
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
                <div class="massage_information__wrap">
                    <div class="massage_feature_image">
                        <?php echo get_the_post_thumbnail(get_the_ID()) ?>
                    </div>
                    <div class="massage_title_des">
                        <h1><?php echo esc_html(get_the_title(get_the_ID())); ?></h1>

                        <div class="message_description">
                            <?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), 'massage_description', true))); ?>
                        </div>

                    </div>



                </div>
                <!-- Grid two Massage Procedure -->
                <div class="massage-procedure__info_wap">

                </div>

            </div>
        </div>
        <?php


        return ob_get_clean();
    }
}