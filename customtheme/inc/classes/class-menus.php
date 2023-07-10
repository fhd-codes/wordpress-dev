<?php

namespace CUSTOM_THEME\Inc\Classes;

use CUSTOM_THEME\Inc\Traits\Singleton;

class Menus{
    use Singleton;

    protected function __construct(){
        $this->setupHooks();

    }


    protected function setupHooks(){
        add_action( "init", [$this, "registerMenus"]);
    }


    public function registerMenus(){
        register_nav_menus(
            [
              'custom-header-menu' => esc_html__( 'Header Menu' ),
              'custom-footer-menu' => esc_html__( 'Footer Menu' )
            ]
        );
        
    }

    
    public function getMenuID($menu_location){  
        /**
         * This method is used to get the menu id. This menu id will be used in the wp_get_nav_menu_items() function in the nav.php file
        */
        $locations = get_nav_menu_locations(  );    // it gives all the menu names and ids
        $menu_id = $locations[$menu_location];   // from the above array, we will use the menu name to find their corrosponding id

        return !empty($menu_id) ? $menu_id : "" ;

    }


    public function getChildMenuItems( $menu_array, $parent_id ){
        /**
         * To make the dropdown list of the parent child menu items, we are finding the child menus here.
         * It is because the menu array that we got does not have menu arranged in the child-parent relation.
         * We only have the parent id if that menu belongs to any parent menu item
        */

        $child_menus = [];

        if(!empty($menu_array) && is_array($menu_array)){   // doing error handeling
            foreach($menu_array as $menu_item){ // iterating over each menu item and checking if their parent_id matches with the id that we have added
                if(intval($menu_item->menu_item_parent) === $parent_id){
                    array_push($child_menus, $menu_item);
                }
            }
        }

        return $child_menus;

    }
    
}