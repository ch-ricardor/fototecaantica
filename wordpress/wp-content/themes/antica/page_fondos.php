<?php
/*
Template Name: Fondos
*/
?>
<?php get_header(); ?>
<body style="background: none;">

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
<div id="wrap">

<div id="cuadros">
  <ul>
    <li><a class="cuadro f1" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Daguerrotipos">Daguerrotipos</a></li>
    <li><a class="cuadro f2" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Ambrotipos">Ambrotipos</a></li>
    <li><a class="cuadro f3" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Ferrotipos">Ferrotipos</a></li>
    <li><a class="cuadro f4" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Carte de Visite">Cartes de Visite</a></li>
    <li><a class="cuadro f5" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Tarjetas Cabinet">Tarjetas Cabinet</a></li>
    <li><a class="cuadro f6" href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Vistas Estereoscópicas">Vistas Estereoscópicas</a></li>
  </ul>
</div>


</div> <!-- fin wrap -->
</div> <!-- fin content -->

<?php get_footer(); ?>