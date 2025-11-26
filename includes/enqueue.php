<?php

define('ALIBI_STYLE_URI', get_stylesheet_directory_uri() . '/assets/css/');

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
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_scripts()
    {

        wp_enqueue_style('alibi-main', ALIBI_STYLE_URI . 'main.css', [], ALIBI_THEME_VERSION, 'all');
        wp_enqueue_style('alibi-masseuses-style', ALIBI_STYLE_URI . 'masseuses.css', [], ALIBI_THEME_VERSION, 'all');

    }

}