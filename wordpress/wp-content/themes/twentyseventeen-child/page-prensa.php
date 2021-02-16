<?php
/*
Template Name: Prensa
*/
?>
<?php get_header(); ?>

<div id="antica-content">
    <div class="container">

    <?php if (have_posts()) : ?>

    <div class="slider-wrapper theme-default column-slider" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
        <div id="slider" class="nivoSlider">
            <?php $foto1 = get_post_custom_values("foto1"); if (isset($foto1[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto1", true); ?>" >
            <?php } ?>

            <?php $foto2 = get_post_custom_values("foto2"); if (isset($foto2[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto2", true); ?>" >
            <?php } ?>

            <?php $foto3 = get_post_custom_values("foto3"); if (isset($foto3[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto3", true); ?>" >
            <?php } ?>

            <?php $foto4 = get_post_custom_values("foto4"); if (isset($foto4[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto4", true); ?>" >
            <?php } ?>

            <?php $foto5 = get_post_custom_values("foto5"); if (isset($foto5[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto5", true); ?>" >
            <?php } ?>

            <?php $foto6 = get_post_custom_values("foto6"); if (isset($foto6[0])) { ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto6", true); ?>" >
            <?php } ?>
        </div><!-- #slider .nivoSlider -->
    </div> <!-- .slider-wrapper -->

    <div id="textos" class="column-page">
        <h1>Prensa</h1><br>

        <?php $page = (get_query_var('paged')) ? get_query_var('paged') : 1; query_posts("showposts=10&paged=$page"); while ( have_posts() ) : the_post() ?>

        <h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <p><?php
            $texter = get_the_excerpt();
            if(strlen($texter ) > 500) {
            $texter = substr($texter , 0, 500);
            }
            echo ''.$texter.'';
        ?>
        </p>

        <div style="clear:both;"></div><br>

        <?php endwhile; ?>

    </div><!-- #textos -->

    <?php endif; ?>

    </div> <!-- .wrap -->
</div> <!-- #content -->

<!-- RRE 2020 Slider equeued in functions.php -->

<?php get_footer();
