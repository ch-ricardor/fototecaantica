<?php
/*
Template Name: Catalogo
*/
?>
<?php get_header(); ?>
<body style="background: none;">

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
<div id="wrap">

<div id="cuadros">
  <ul>
    <li><a class="cuadro a1" href="<?php echo get_settings('home'); ?>/fondos/">Fondos</a></li>
    <li><a class="cuadro a2" href="<?php echo get_settings('home'); ?>/autores/?page=ft/fichas.php&cat=autores&ver=Autores">Autores</a></li>
    <li><a class="cuadro a3" href="<?php echo get_settings('home'); ?>/metodologia/">Metodología</a></li>
    <li><a class="cuadro a4" href="<?php echo get_settings('home'); ?>/acceso/">Acceso</a></li>
    <li><a class="cuadro a5" href="<?php echo get_settings('home'); ?>/creditos/">Créditos</a></li>
  </ul>
</div>


</div> <!-- fin wrap -->
</div> <!-- fin content -->

<?php get_footer(); ?>