<?php
/*
Template Name: Autores
*/
?>
<?php get_header(); ?>
<body style="background: none;">

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<?php
	$cat = $_GET['cat'];
	$ver = $_GET['ver'];
	$ini = $_GET['ini']; //inicial

	if ($cat=='procesos') $categoria = "Proceso fotográfico";
	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autores";
?>

<div id="header2">
	<div id="wrap">
		<h2>Autores</h2>
		<h1><?php if ($ini=='') { echo '&nbsp;'; } else echo $ini; ?></h1>

		<a href="<?php echo get_settings('home'). "/catalogo/"; ?>/">Menú anterior</a>
	</div>
</div>

<div id="content">
<div id="wrap">

<div id="iniciales">
<ul>
<?php
	$all_resultado = getIniciales();
	$i=1;
	foreach ($all_resultado as $resultado) {
		$inicial = $resultado->inicial;
	?>
	
  	<li><a href="<?php echo get_settings('home'); ?>/autores/?page=ft/fichas.php&cat=autores&ini=<?php echo $inicial; ?>"><?php echo $inicial; ?></a></li>

<?php } ?>
</ul>
</div>

<div style="clear:both;"></div>

<div id="autores">
<ul>
<?php
	if ($ini!='') {
	$all_resultado = getAutores($ini);
	$i=1;
	foreach ($all_resultado as $resultado) {
	?>

  <?php $autor = $resultado->autor; $autorslug = $resultado->autorslug; ?>
  <li><a href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=<?php echo $cat; ?>&ver=<?php echo $autorslug; ?>&ficha=<?php echo $autorslug; ?>"><?php echo $autor; ?></a></li>

<?php } } ?>
</ul>

<?php if ( $ini=='' ) { ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div id="autorestexto"><?php the_content();?></div>

<?php endwhile; endif; ?> 
<?php } ?>

</div>



<div style="clear:both;"></div>

</div> <!-- fin wrap -->
</div> <!-- fin content -->

<?php get_footer(); ?>