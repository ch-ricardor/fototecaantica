<?php
/*
Template Name: Links
*/
?>
<?php get_header(); ?>

<div id="content">
    <div id="wrap">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div class="slider-wrapper theme-default" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
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
        </div><!-- #slider .nivoSlider -->
    </div><!-- .slider-wrapper -->

    <div id="textos">

        <h1><?php the_title(); ?></h1>
        <?php the_content();?>

        <ul>
        <?php
            // RRE 2020 Deprecated
            //  get_links(-1, '<li>', '</li>', ' <br> ')
            wp_list_bookmarks( array(
                'title_li'  => '',
                'show_description'  => true,
            ));
        ?>

        </ul>

    </div><!-- #textos -->

    <?php endwhile; endif; ?>

    </div> <!-- .wrap -->
</div> <!-- #content -->

<!-- RRE 2020 Slider equeued in functions.php -->

<?php get_footer();