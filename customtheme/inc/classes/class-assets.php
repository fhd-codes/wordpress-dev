<?php

namespace CUSTOM_THEME\Inc\Classes;

use CUSTOM_THEME\Inc\Traits\Singleton;

class Assets{
    use Singleton;

    protected function __construct(){
        $this->setupHooks();

    }


    protected function setupHooks(){
        // add hooks to register styles and scripts
        add_action("wp_enqueue_scripts", [$this, "registerStyles"]);
        add_action("wp_enqueue_scripts", [$this, "registerScripts"]);
    }

    
    public function registerStyles(){
        $version = wp_get_theme()->get('Version'); // this will get the version number from css file
    
        wp_enqueue_style('fhd-css', get_stylesheet_uri(), array('fhd-bootstrap'), "1.2.3", "all"); // it wil load style.css file
        
        wp_enqueue_style('fhd-bootstrap-css', "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css", array(), "5.2.3", "all");
        wp_enqueue_style('fhd-fontawesome', "https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css", array(), "6.2.1", "all");    
    }
    
    
    public function registerScripts(){
        wp_enqueue_script('fhd-js', THEME_DIR_URI . "/assets/js/app.js", array(), "1.0", true);
        wp_enqueue_script('fhd-jquery', "https://code.jquery.com/jquery-3.4.1.slim.min.js", array(), "3.4.1", true);
        wp_enqueue_script('fhd-popper', "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js", array(), "1.16.0", true);
        wp_enqueue_script('fhd-bootstrap-js', "https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js", array(), "4.4.1", true);

    }
}