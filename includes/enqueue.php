<?php 

class ALIBI_Assets{
    public function __construct(){
        $this->init();
    }
    
    public function init() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    public function enqueue_scripts() {
        // wp_enqueue_script('alibi-main', get_template_directory_uri() . '/assets/js/main.js', [], ALIBI_THEME_VERSION, true);
        wp_enqueue_style('alibi-main', get_template_directory_uri() . '/assets/css/main.css', [], ALIBI_THEME_VERSION, 'all');
    }
}