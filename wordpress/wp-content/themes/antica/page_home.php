<?php
/*
Template Name: Home
*/
get_header(); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
    <div class="wrap">

        <div id="logo">
        </div><!-- #logo -->

        <div id="home">
        </div><!-- #home -->

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <div id="texto-home">


                <?php the_content();?>

            </div><!-- #texto-home -->

        <?php endwhile; endif; ?> 
    </div> <!-- .wrap -->
</div> <!-- #content -->

<?php get_footer();