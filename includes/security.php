<?php 

class ALIBI_Security{
    public function __construct(){
        $this->init();
    }
    
    public function init() {
        add_action('init', [$this, 'security_headers']);
        add_filter('wp_headers', [$this, 'add_security_headers']);
        add_action('wp_login_failed', [$this, 'limit_login_attempts']);
    }
    
    public function security_headers() {
        if (!is_admin()) {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
        }
    }
    
    public function add_security_headers($headers) {
        $headers['Referrer-Policy'] = 'strict-origin-when-cross-origin';
        $headers['Content-Security-Policy'] = "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline';";
        return $headers;
    }
    
    public function limit_login_attempts($username) {
        $attempts = get_transient('login_attempts_' . sanitize_user($username));
        $attempts = $attempts ? $attempts + 1 : 1;
        
        if ($attempts >= ALIBI_MAX_LOGIN_ATTEMPTS) {
            wp_die('Too many failed login attempts. Please try again later.');
        }
        
        set_transient('login_attempts_' . sanitize_user($username), $attempts, 15 * MINUTE_IN_SECONDS);
    }
}