<?php

define('ALIBI_STYLE_URI', get_stylesheet_directory_uri() . '/assets/css/');
define('ALIBI_SCRIPT_URI', get_stylesheet_directory_uri() . '/assets/js/');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class ALIBI_Assets
{
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('wp_ajax_nopriv_post_data_ajax', [$this, 'post_data_ajax']);
        add_action('wp_ajax_post_data_ajax', [$this, 'post_data_ajax']);
    }

    public function enqueue_styles()
    {

        wp_enqueue_style('alibi-main', ALIBI_STYLE_URI . 'main.css', [], ALIBI_THEME_VERSION, 'all');
        wp_enqueue_style('alibi-masseuses-style', ALIBI_STYLE_URI . 'masseuses.css', [], ALIBI_THEME_VERSION, 'all');

    }
    public function enqueue_scripts()
    {
        wp_enqueue_script('filterable_gallery', ALIBI_SCRIPT_URI . 'gallery.js', [], ALIBI_THEME_VERSION, true);

        $masseuses_data = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('filterable_gallery_nonce'),

        );
        wp_localize_script('filterable_gallery', 'filterable_gallery_params', $masseuses_data);

    }
    public function post_data_ajax()
    {
        check_ajax_referer('filterable_gallery_nonce', 'nonce');

        $args = array(
            'post_type' => 'masseur',
            'post_status' => 'publish',
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $posts_data = array();
            while ($query->have_posts()) {
                $query->the_post();
                $posts_data[] = array(
                    'ID' => get_the_ID(),
                    'title' => get_the_title(),
                    'link' => get_permalink(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
                );
            }
            wp_send_json_success($posts_data);
        } else {
            wp_send_json_error('No posts found');
        }

        wp_die();
    }

}