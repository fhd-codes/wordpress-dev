<?php

namespace CUSTOM_THEME\Inc\Classes;

use CUSTOM_THEME\Inc\Traits\Singleton;

class CUSTOM_THEME{
    use Singleton;

    protected function __construct(){
        // wp_die("hello fhd");  // un-comment this line to see this printed on the screen. If this msg is printed, it means that your class has successfully been loaded

        /**
         * In order to make this file clean, we have moved the style and script enqueue to a new class file name class-assets.php
         * and in the __construct() of our main theme class, we have called an instance of this class. Now, all the scripts and styles
         * have been added to our theme. 
         * Since we will be adding more functionality to our theme, we will make a separate class file, define the functionality there
         * and call the instance inside this class.
         */

        Assets::get_instance(); // getting the theme styles and scripts from class-assets.php file
        Menus::get_instance();  // getting the custom registered menus
        Metaboxes::get_instance();  // getting the custom registered metaboxes

        $this->setupHooks();
    }

   
    protected function setupHooks(){
        add_action( "after_setup_theme", [$this, "setupTheme"] );
        add_action( "after_setup_theme", [$this, "postThumbnailSize"] );
    }


    public function setupTheme(){
        // this adds the title tag in the header section of the html page. The title tag is displayed on the browser window tab...
        add_theme_support( "title-tag");

        add_theme_support( "custom-logo", [ // use the_custom_logo() function in the nav bar html
            'height'               => 50,
            'width'                => 50,
            'flex-height'          => true, // flex height and width, if false, will keep the image crop box ratio maintained
            'flex-width'           => true,
            'header-text'          => array('site-title', 'site-description' ),
            'unlink-homepage-logo' => true, 
        ]);

        add_theme_support('custom-background', [
            'default-color' => 'ffffff',
            'default-image' => ''
        ] );

        add_theme_support('post-thumbnails');
        add_theme_support('customize-selective-refresh-widget'); // it refreshes the wordpress widgets without refreshes the whole page
        add_theme_support('automatic-feed-links');
        
        add_theme_support('html5', [ 
            'comment-list', 
            'comment-form', 
            'search-form', 
            'gallery', 
            'caption', 
            'style', 
            'script' ] 
        );

        add_editor_style();
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');   // when an image is added in the post block, we get an option to align it wide to the screen width

        global $content_width;  // setting the maximum width of the content that is used in the frontend
        if (! isset($content_width)){
            $content_width = 1240;  // adjust this value according to your website's width
        }

    }


    public function postThumbnailSize() {
        add_image_size('post-thumbnail-size', 416, 200, false);
    }


}



