<?php
/*
Template Name: Catalogo
*/
?>
<?php get_header(); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
<div class="wrap">

<div id="cuadros">
    <ul>
        <!-- RRE 2020 Worpress recommendation change get_settings to get_option -->
        <li><a class="cuadro a1" href="<?php echo get_option('home',''); ?>/fondos/">Fondos</a></li>
        <li><a class="cuadro a2" href="<?php echo get_option('home',''); ?>/autores/?page=ft/fichas.php&cat=autores&ver=Autores">Autores</a></li>
        <li><a class="cuadro a3" href="<?php echo get_option('home',''); ?>/metodologia/">Metodología</a></li>
        <li><a class="cuadro a4" href="<?php echo get_option('home',''); ?>/acceso/">Acceso</a></li>
        <li><a class="cuadro a5" href="<?php echo get_option('home',''); ?>/creditos/">Créditos</a></li>
    </ul>
</div><!-- #cuadros -->


</div> <!-- .wrap -->
</div> <!-- #content -->

<?php get_footer(); ?>