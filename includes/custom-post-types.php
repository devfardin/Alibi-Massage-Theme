<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class ALIBI_CUSTOM_POST_TYPES
{
    public function __construct()
    {
        add_filter('enter_title_here', [$this, 'customize_title_placeholder'], 10, 2);
    }
    public function customize_title_placeholder($title, $post)
    {
        if ($post->post_type == 'masseur') {
            $my_title = "Masseur Name";
            return $my_title;
        }
        return $title;
    }

}