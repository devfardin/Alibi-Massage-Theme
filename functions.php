<?php

// Security Constants
define('ALIBI_THEME_VERSION', '1.0.0');
define('ALIBI_TEMPLATE_DIR', __DIR__ . '/includes/');
define('ALIBI_SHORTCODES_DIR', __DIR__ . '/includes/shortcodes/');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class FUNCTIONS
{
    public function __construct()
    {
        $this->load_depandency();
        $this->init();
        $this->load_action();
    }
    public function load_action()
    {

        // Elementor support
        add_action('after_setup_theme', array($this, 'elementor_support'));
    }

    public function load_depandency()
    {
        // Load required files
        require_once(ALIBI_TEMPLATE_DIR . 'enqueue.php');
        require_once ALIBI_TEMPLATE_DIR . 'custom-post-types.php';
        require_once ALIBI_TEMPLATE_DIR . 'additional-service.php';
        require_once ALIBI_TEMPLATE_DIR . 'cmb2/init.php';
        require_once ALIBI_TEMPLATE_DIR . 'theme-setup.php';
        require_once ALIBI_SHORTCODES_DIR . 'masseuses.php';
        require_once ALIBI_SHORTCODES_DIR . 'single-masseur.php';
        require_once ALIBI_SHORTCODES_DIR . 'masseuses-taxonomy.php';
    }

    public function init()
    {
        new ALIBI_Assets();
        new ALIBI_CUSTOM_POST_TYPES();
        new ADDITIONAL_SERVICE();
        new MASSEUSES();
        new THEME_SETUP();
        new SINGLE_MASSEUR();
        new MASSEUSES_TAXONOMY();


    }

    public function elementor_support()
    {
        add_theme_support('elementor');
    }

}
new FUNCTIONS();