<!DOCTYPE html>
<html lang="<?php language_attributes( );?>" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title tag is dynamically added from theme class file using theme-supprt -->
    
    
    <?php 
    wp_head(); //The enqueued files are typically added to the head section using wp_head()
    ?>

</head>

<body>
    <?php 
    if (function_exists("wp_body_open")){
        wp_body_open();
    }
    ?>

    <div id="page">
        <header id="master-header" class="site-header" role="banner"> 
            <?php get_template_part('assets/templates/nav'); ?>
        </header>

        <div id="content" class="site-content">

        


    
    