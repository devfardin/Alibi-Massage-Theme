<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class MASSEUSES
{
    public function __construct()
    {
        add_shortcode('masseuses_list', array($this, 'render_masseuses_list'));
    }

    public function render_masseuses_list($atts)
    {
        ob_start();
        // Shortcode attributes with defaults
        $atts = shortcode_atts(array(
            'count' => 30,
        ), $atts, 'masseuses_list');

        // Query masseuses custom post type
        $args = array(
            'post_type' => 'masseur',
            'post_status' => 'publish',
            'posts_per_page' => intval($atts['count']),
        );
        $query = new WP_Query($args); ?>

        <div class="masseuses-list_wrap">
            <?php if ($query->have_posts()): ?>
                <div class="masseuses-list_row">
                    <?php while ($query->have_posts()):
                        $query->the_post(); ?>
                        <div href="<?php echo esc_attr(get_the_permalink()); ?>" class="masseuse-item_wrap">
                            <div class="masseuse-item_feature-img">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                                <div class="hover_over_details">
                                    <div class="hover_over_details_list">
                                        <span>Age: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'age', true)); ?></span>
                                    </div>
                                    <div class="hover_over_details_list">
                                        <span>Height: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'height', true)); ?></span>
                                    </div>
                                    <div class="hover_over_details_list">
                                        <span>Weight: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'weight', true)); ?></span>
                                    </div>
                                    <div class="hover_over_details_list">
                                        <span>Breasts: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'breasts', true)); ?></span>
                                    </div>
                                    <div class="hover_over_details_list">
                                        <span>Hair Color: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'hair_color', true)); ?></span>
                                    </div>
                                    <div class="hover_over_details_list">
                                        <span>Eye Color: </span>
                                        <span><?php echo esc_html(get_post_meta(get_the_ID(), 'eye_color', true)); ?></span>
                                    </div>

                                </div>
                            </div>

                            <div class="masseuse-item_details">
                                <h3 class="masseuse-item_details_title"> <?php echo esc_html(get_the_title()) ?> </h3>

                                <div class="masseuse-item_details_location_address">
                                    <i aria-hidden="true" class="icon icon-map-marker1"></i>
                                    <span class="masseuse-item_details_price-value">
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'location__address', true)); ?>
                                    </span>
                                </div>
                                <!-- View Profile Button -->
                                <a href="<?php echo esc_attr(get_the_permalink()); ?>" class="masseuse-item_details_view-profile">
                                    View Profile <i aria-hidden="true" class="icon icon-right-arrow"></i>
                                </a>
                                <!-- End View Profile Button -->
                            </div>

                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h3 class='masseuses-list_no-masseuses'> No masseuses found. </h3>
                <?php endif; ?>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php return ob_get_clean();
    }
}

?>

