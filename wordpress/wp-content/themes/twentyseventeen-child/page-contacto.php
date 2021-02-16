<?php
/*
  Page-Contacto
*/
?>
<?php get_header(); ?>

<div id="antica-content">
    <div class="container">

        <?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>

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
                </div><!-- #slider .nivoSlider -->
            </div> <!-- .slider-wrapper -->

            <div id="textoslong" class="column-page">

                <div id="paginacion">
                    <?php wp_link_pages('before=<span>&after=</span>
                                        &next_or_number=next
                                        &nextpagelink=<div class="sig">English</div>
                                        &previouspagelink=<div class="atr">Español</div>
                                        '); ?>
                </div> <!-- #paginacion -->

                <!--<h1><?php //the_title(); ?></h1>-->

                <?php the_content();?>

                <form action="<?php echo get_option('siteurl'); ?>/mail.php" method="post" id="contacto">
                    <input type="text" name="author" class="input author"
                        value="<?php echo __('Nombre','antica'); ?>"
                        onfocus="if (this.value == '<?php echo __('Nombre','antica');?>') {this.value = '';}"
                        onblur="if (this.value == '') {this.value = '<?php echo __('Nombre','antica');?>';}" />
                    <input type="text" name="email" class="input email"
                        value="<?php echo __('Correo electrónico','antica');?>"
                        onfocus="if (this.value == '<?php echo __('Correo electrónico','antica');?>') {this.value = '';}"
                        onblur="if (this.value == '') {this.value = '<?php echo __('Correo electrónico','antica');?>';}" />

                    <textarea name="comment" class="input comment" rows="3"></textarea>

                    <textarea name="fotos" class="input fotos" ><?php echo __('Claves seleccionadas','antica');?>:</textarea>

                    <input type="text" name="autores" class="input autores" 
                        value="<?php echo __('Autores seleccionados','antica');?>" 
                        onfocus="if (this.value == '<?php echo __('Autores seleccionados','antica');?>') {this.value = '';}" 
                        onblur="if (this.value == '') {this.value = '<?php echo __('Autores seleccionados','antica');?>';}" />

                    <input type="text" name="temas" class="input temas" 
                        value="<?php echo __('Temas de interés','antica');?>" 
                        onfocus="if (this.value == '<?php echo __('Temas de interés','antica');?>') {this.value = '';}" 
                        onblur="if (this.value == '') {this.value = '<?php echo __('Temas de interés','antica');?>';}" />

                    <input type="hidden" name="ubicacion" id="ubicacion" value="<? echo $_SERVER [ 'REMOTE_ADDR' ]; ?>" />
                    <input name="submit" type="submit" class="boton" value="Enviar comentario" />

                    <?php do_action('comment_form', $post->ID); ?>
                </form><!-- #contacto -->

            </div><!-- #textoslong -->

        <?php
        endwhile; endif; ?>

    </div> <!-- .container -->
</div> <!-- #content -->

<!-- RRE 2020 Slider equeued in functions.php -->

<?php get_footer();
