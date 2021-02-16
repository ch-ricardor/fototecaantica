<?php
/*
 * Template Name: Home
*/
get_header(); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
    <div class="container">

        <div id="home">
        </div><!-- #home -->

        <div id="logo">
        </div><!-- #logo -->

        <?php
        while (have_posts()) :
            the_post(); ?>

            <div id="texto-home">

                <?php the_content();?>

            </div><!-- #texto-home -->

        <?php
        endwhile
        ?>

    </div><!-- .container -->
</div><!-- #content -->

<?php get_footer();
