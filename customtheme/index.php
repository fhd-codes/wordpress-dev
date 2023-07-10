<?php
    get_header();
?>

<hr>
<center>
    This is the index.php file
</center>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <?php
            if(have_posts()){
        ?>
            <div class="container">
        <?php
                if(is_home() && !is_front_page()){
        ?>
                    <header class="mb-5">
                        <h1>
                            <center><?php single_post_title(); // getting the page title here ?></center>
                        </h1>
                    </header>
                    
        <?php
                }
        ?>
        <?php
                    $posts_per_row = 3;
                    $post_index = 0;
                    while(have_posts()): the_post();

                    $col_division = "col-". strval(12/$posts_per_row);

                    if($post_index % $posts_per_row == 0){
        ?>
                        <div class="row">
        <?php
                    }
        ?>
                            <div class="<?php echo $col_division;?> mb-3">                                
                               <?php get_template_part( "assets/templates/post-grid-element" ); ?>
                            </div>
        <?php
                    if($post_index % $posts_per_row == $posts_per_row-1){
        ?>
                        </div>
        <?php
                    }
                    $post_index = $post_index + 1;
        ?>
                       

                        <?php
                    
                endwhile;
        ?>
            </div>
        <?php
            }
        ?>

    </main>

</div>

<hr>

<?php
    get_footer();
    
