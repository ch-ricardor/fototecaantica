<?php
/*
Template Name: Contacto
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
    </div>
</div> <!-- fin wrapper -->

	<div id="textoslong">

    	<div id="paginacion">
            <?php wp_link_pages('before=<span>&after=</span>
                                &next_or_number=next
                                &nextpagelink=<div class="sig">English</div>
                                &previouspagelink=<div class="atr">Español</div>
                                '); ?>
        </div> <!-- fin paginacion -->

		<!--<h1><?php //the_title(); ?></h1>-->

		<?php the_content();?>

        <form action="<?php echo get_option('siteurl'); ?>/mail.php" method="post" id="contacto">
            <input type="text" name="author" class="input author" value="Nombre" onfocus="if (this.value == 'Nombre') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Nombre';}" />
            <input type="text" name="email" class="input email" value="Correo electrónico" onfocus="if (this.value == 'Correo electrónico') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Correo electrónico';}" />
            <textarea name="comment" class="input coment" rows="3"></textarea>

            <textarea name="fotos" class="input fotos" >Claves seleccionadas:</textarea>

            <input type="text" name="autores" class="input autores" value="Autores seleccionados" onfocus="if (this.value == 'Autores seleccionados') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Autores seleccionados';}" />

            <input type="text" name="temas" class="input temas" value="Temas de interés" onfocus="if (this.value == 'Temas de interés') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Temas de interés';}" />

            <input type="hidden" name="ubicacion" id="ubicacion" value="<? echo $_SERVER [ 'REMOTE_ADDR' ]; ?>" />
            <input name="submit" type="submit" class="boton" value="Enviar comentario" />
            <?php do_action('comment_form', $post->ID); ?>
        </form>

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