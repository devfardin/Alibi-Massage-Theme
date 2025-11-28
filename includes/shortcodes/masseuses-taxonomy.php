<?php

class MASSEUSES_TAXONOMY
{
    public function __construct()
    {
        add_shortcode('masseuses_taxonomy', array($this, 'render_masseuses_taxonomy'));
    }

    public function render_masseuses_taxonomy($atts)
    {
        ob_start();

        // Defaults

        // Get current term from URL
        $term = get_queried_object();

        // if ( ! $term || ! isset( $term->slug ) ) {
        //     echo "<h3 class='masseuses-list_no-masseuses'>No masseuses found.</h3>";
        //     return ob_get_clean();
        // }

        // Query posts assigned to this term
        $args = array(
            'post_type' => 'masseur', // change if needed
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'service',
                    'terms' => $term->slug,
                )
            )
        );

        $service_slug = get_query_var('service'); // get current taxonomy term slug

        $args = array(
            'post_type' => 'masseur',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'service',
                    'field' => 'slug',
                    'terms' => $service_slug,
                )
            )
        );

        $query = new WP_Query($args);
        ?>

        <div class="masseuses-list_wrap">
            <?php if (function_exists("rank_math_the_breadcrumbs"))
                rank_math_the_breadcrumbs(); ?>
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
                                <h3 class="masseuse-item_details_title"><?php echo esc_html(get_the_title()) ?></h3>

                                <div class="masseuse-item_details_location_address">
                                    <i class="icon icon-map-marker1"></i>
                                    <span class="masseuse-item_details_price-value">
                                        <?php echo esc_html(get_post_meta(get_the_ID(), 'location__address', true)); ?>
                                    </span>
                                </div>

                                <a href="<?php echo esc_attr(get_the_permalink()); ?>" class="masseuse-item_details_view-profile">
                                    View Profile <i class="icon icon-right-arrow"></i>
                                </a>
                            </div>

                        </div>

                    <?php endwhile; ?>
                </div>

            <?php else: ?>
                <h3 class="masseuses-list_no-masseuses">No masseuses found.</h3>
            <?php endif; ?>
        </div>

        <?php
        wp_reset_postdata();
        return ob_get_clean();
    }

}