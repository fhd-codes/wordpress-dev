<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <?php
            if (function_exists("the_custom_logo")){
                the_custom_logo();
            }

            // getting menu items in form of an array

            $menu_class = \CUSTOM_THEME\Inc\Classes\Menus::get_instance();
            $header_menu_id = $menu_class->getMenuID("custom-header-menu");

            $header_menu_items_array = wp_get_nav_menu_items($header_menu_id);  // here, we are getting all the menus. Now we need to identify them as parent and child menu items
            
        ?>

        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- nav bar menus -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php
                    if(!empty($header_menu_items_array) && is_array($header_menu_items_array)){
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <?php
                    foreach ($header_menu_items_array as $menu_item){
                        if(! $menu_item -> menu_item_parent){    // if that item does not have (menu_item_parent) field, it means it is a parent menu
                            // find the child menu items

                            $child_menus = $menu_class->getChildMenuItems($header_menu_items_array, $menu_item->ID);
                            $has_children = !empty($child_menus) && is_array($child_menus); // this is a bool type variable
                            
                            if( ! $has_children ){
                ?>
                                <!-- if the menu does not have any child menus -->
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?php echo esc_url($menu_item->url);?>" >
                                    <?php echo $menu_item->title; ?>
                                </a>
                                </li>
                <?php
                            }
                            else{
                ?>
                                <!-- if the menu have some child menus in it -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url);?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" >
                                        <?php echo $menu_item->title; ?>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                            foreach($child_menus as $child_item){
                                        ?>
                                                <li><a class="dropdown-item" href="<?php echo esc_url($child_item->url);?>">
                                                    <?php echo $menu_item->title; ?>
                                                </a></li>
                                        <?php
                                            }
                                        ?>
                                    
                                    </ul>
                                </li>
                <?php

                            }
                ?>
                
                    
                    
                <?php
                        }
                    }
                ?>

                </ul>

                <?php
                    }
                ?>
                
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>

    </div>
</nav>


<?php
// wp_nav_menu(
//   array(
//     'theme_location' => 'custom-header-menu',
//     'container_class' => 'my_extra_menu_class'
//   )
// );
?>