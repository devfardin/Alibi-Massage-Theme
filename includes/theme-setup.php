<?php 

if(!defined('ABSPATH')){
    exit;
}
class THEME_SETUP {
    public function __construct() {
        add_action( 'after_setup_theme', [$this, 'custom_theme_setup'] );
    }

   function custom_theme_setup() {
    add_image_size( 'masseur-medium', 485, 640, true ); // 600px wide, auto height, no hard crop
}
}