<?php 

define('ALIBI_STYLE_URI', get_stylesheet_directory_uri() . '/assets/css/');
class ALIBI_Assets{
    public function __construct(){
        $this->init();
    }
    
    public function init() {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }
    
    public function enqueue_scripts() {
        wp_enqueue_style('alibi-main', ALIBI_STYLE_URI . 'main.css', [], ALIBI_THEME_VERSION, 'all');
    }
}