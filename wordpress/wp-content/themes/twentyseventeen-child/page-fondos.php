<?php
/*
Template Name: Fondos
*/
?>
<?php get_header(); ?>

<div id="antica-content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
	<div class="container">

		<div id="cuadros">
			<ul>
    			<li><a class="cuadro f1" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Daguerrotipos">Daguerrotipos</a></li>
    			<li><a class="cuadro f2" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Ambrotipos">Ambrotipos</a></li>
    			<li><a class="cuadro f3" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Ferrotipos">Ferrotipos</a></li>
    			<li><a class="cuadro f4" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Carte de Visite">Cartes de Visite</a></li>
    			<li><a class="cuadro f5" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Tarjetas Cabinet">Tarjetas Cabinet</a></li>
				<li><a class="cuadro f6" href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=fondos&ver=Vistas Estereoscópicas">Vistas Estereoscópicas</a></li>
  			</ul>
		</div><!-- #cuadros -->

	</div> <!-- .container -->
</div> <!-- #antica-content -->

<?php get_footer();
