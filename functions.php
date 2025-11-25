<?php

// Security Constants
define('ALIBI_THEME_VERSION', '1.0.0');
define('ALIBI_NONCE_KEY', 'alibi_security_nonce');
define('ALIBI_MAX_LOGIN_ATTEMPTS', 3);
define('ALIBI_TEMPLATE_DIR', __DIR__ . '/includes/');

class FUNCTIONS
{
    public function __construct()
    {
        $this->load_depandency();
        $this->init();
    }

    public function load_depandency()
    {
        // Load required files
        require_once(ALIBI_TEMPLATE_DIR . 'enqueue.php');
        require_once ALIBI_TEMPLATE_DIR . 'security.php';
        require_once ALIBI_TEMPLATE_DIR . 'custom-post-types.php';
        require_once ALIBI_TEMPLATE_DIR . 'additional-service.php';
        require_once ALIBI_TEMPLATE_DIR . 'cmb2/init.php';
        require_once ALIBI_TEMPLATE_DIR . 'cmb2/init.php';
    }

    public function init()
    {
        new ALIBI_Assets();
        new ALIBI_Security();
        new ALIBI_CUSTOM_POST_TYPES();
        new ADDITIONAL_SERVICE();
    }
}
new FUNCTIONS();