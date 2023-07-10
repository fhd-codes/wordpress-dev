<?php

namespace CUSTOM_THEME\Inc\Classes;

use CUSTOM_THEME\Inc\Traits\Singleton;

class Metaboxes{
    use Singleton;

    protected function __construct(){
        $this->setupHooks();

    }


    protected function setupHooks(){
        add_action("add_meta_boxes", [$this, "customMetabox"]); // making custom metabox
        add_action("save_post", [$this, "savePostMetaData"]); // saving the metabox data
    }

    
    public function customMetabox(){
        $post_types = ['post']; // if there are other post type that needs this metabox, we can add it in this array
        
        foreach($post_types as $post_type){
            add_meta_box( 
                'hide-page-title',
                __( 'Hide page title' ),
                [$this, 'renderHidePageTitleMB'],   // since we are dealing with class, this is how to mention a callback function
                $post_type,
                'side'  // if this is not passed, it will show the metabox at the bottom
            );
        }

    }


    public function renderHidePageTitleMB( $post ){
        // Retrieve the saved meta value, if it exists
        $hide_title_value = get_post_meta($post->ID, '_hide_page_title', true);
        ?>
        <!-- html for the meta box -->
    
        <label for="hide-page-title"><?php  esc_html_e("Hide Page Title"); ?></label>
        <select id="hide-page-title" name="hide_page_title" class="postbox">
            <option value=""><?php esc_html_e("Select Option"); ?></option>
            <option value="yes" <?php selected( $hide_title_value, "yes" ); ?> >
                <?php esc_html_e("Yes"); ?>
            </option>
            <option value="no" <?php selected( $hide_title_value, "no" ); ?> >
                <?php esc_html_e("No"); ?>
            </option>
        </select>
    
        <?php
    }


    public function savePostMetaData($post_id){
        /**
         * Once the metaboxes are made, we need to save them in our database. This function will do that job
        */
        if(array_key_exists('hide_page_title', $_POST)){
            update_post_meta($post_id, '_hide_page_title', $_POST['hide_page_title']);
        }

    }
        
    
}