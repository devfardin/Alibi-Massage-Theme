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

                </div>
        </div>
    <?php
    

        return ob_get_clean();
    }
}