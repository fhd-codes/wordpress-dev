<?php
/**
 * This is displayed on the blog home page.
 * By default, the home page will be of 3x3 grid of blog posts.
 * The loop of making this grid is in the php file dealing the home page layout
 * 
 * This below code is a template to display items of the post in that grid.
 * It is for a single post.
 */

    $post_id = get_the_ID();
    $has_post_thumbnail = get_the_post_thumbnail($post_id);
?>

<div class="container" style="width: 416px; height: 200px;">
    <?php
        if($has_post_thumbnail){
    ?>
    <div class="mb-3">
        <center>
            <?php the_post_thumbnail("post-thumbnail-size"); ?>
        </center>
    </div>
    
    <?php 
        } 
    ?>
</div>

<div class="container">
    <center>
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
    </center>
</div>