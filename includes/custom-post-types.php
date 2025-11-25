<?php 
class ALIBI_Custom_Post_Types{
    public function __construct(){
        $this->init();
    }
    
    public function init() {
        add_action('init', [$this, 'register_custom_post_types']);
    }
    
    public function register_custom_post_types() {
        // Register 'service' custom post type
        register_post_type('service', [
            'labels' => [
                'name' => 'Services',
                'singular_name' => 'Service',
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_icon' => 'dashicons-admin-tools',
        ]);
        
        // Register 'testimonial' custom post type
        register_post_type('testimonial', [
            'labels' => [
                'name' => 'Testimonials',
                'singular_name' => 'Testimonial',
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'menu_icon' => 'dashicons-testimonial',
        ]);
    }
}