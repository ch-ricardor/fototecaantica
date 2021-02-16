<?php
/*
Template Name: Slider
*/
?>
<?php get_header(); ?>
<body>

<?php include(TEMPLATEPATH . '/menu.php'); ?>

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

        <?php $foto5 = get_post_custom_values("foto5"); if (isset($foto5[0])) { ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto5", true); ?>" >
        <?php } ?>

        <?php $foto6 = get_post_custom_values("foto6"); if (isset($foto6[0])) { ?>
        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/slider/<?php echo get_post_meta($post->ID, "foto6", true); ?>" >
        <?php } ?>
    </div>
</div> <!-- fin wrapper -->

	<div id="textos">

    	<div id="paginacion">
            <?php wp_link_pages('before=<span>&after=</span>
                                &next_or_number=next
                                &nextpagelink=<div class="sig">English</div>
                                &previouspagelink=<div class="atr">Español</div>
                                '); ?>
        </div> <!-- fin paginacion -->

		<!--<h1><?php //the_title(); ?></h1>-->

		<?php the_content();?>

	</div>

<?php endwhile; endif; ?> 

</div> <!-- fin wrap -->
</div> <!-- fin content -->

<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

<?php get_footer(); ?>