<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class ALL_MASSAGES
{
    // create a short code and rander all the massages
    public function __construct()
    {
        add_shortcode('massages_list', array($this, 'render_massages_list'));
    }
    public function render_massages_list($atts)
    {
        ob_start();
        // Shortcode attributes with defaults
        $atts = shortcode_atts(array(
            'count' => 30,
        ), $atts, 'massages_list');

        // Query masseuses custom post type
        $args = array(
            'post_type' => 'massage',
            'post_status' => 'publish',
            'posts_per_page' => intval($atts['count']),
        );
        $query = new WP_Query($args); ?>
        <div class="massages-list_wrap">
            <?php if ($query->have_posts()): ?>
                <div class="massages-list_row">
                    <?php while ($query->have_posts()):
                        $query->the_post(); ?>
                        <div class="massages-item_wrap"
                            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 24.62%, rgba(0, 0, 0, 0.80) 83.54%), url(<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'large') ?>) lightgray -103.267px 0px / 118.649% 100% no-repeat;">


                            <div class="massages-item_details">
                                <div class="classmassages-item_details__title_des">
                                    <h3 class="massages-item_details_title"> <?php echo esc_html(get_the_title()) ?> </h3>
                                    <p>
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'short_description', true)); ?>
                                    </p>
                                </div>

                                <!-- Massages Footer -->
                                <div class="massages_footer_wrapper">
                                    <!-- Price Form -->
                                    <div class="massages_footer_price">
                                        <h4>
                                            From
                                            <?php
                                            $price_raw = get_post_meta(get_the_ID(), '30_minutes_1_masseuse_price', true);

                                            // Extract full currency groups like "2000 CZK", "87 €"
                                            preg_match_all('/\d+\s*[A-Za-z€]+/', $price_raw, $matches);

                                            if (!empty($matches[0])) {
                                                // If two prices found: "2000 CZK", "87 €"
                                                if (count($matches[0]) >= 2) {
                                                    echo esc_html($matches[0][0] . ' | ' . $matches[0][1]);
                                                }
                                                // If only one price found: "200 CZK"
                                                else {
                                                    echo esc_html($matches[0][0]);
                                                }
                                            } else {
                                                // Fallback: show raw value
                                                echo esc_html($price_raw);
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <!-- Permalink URL -->
                                    <a href="<?php echo esc_attr(get_the_permalink()); ?>" class="massages-item_details_view-profile">
                                        View More  <i aria-hidden="true" class="icon icon-right-arrow"></i>
                                    </a>
                                </div>

                                <!-- End View Profile Button -->
                            </div>

                            <?php echo get_the_post_thumbnail('large') ?>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h3 class='massages-list_no-masseuses'> No masseuses found. </h3>
                <?php endif; ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php return ob_get_clean();
    }

}