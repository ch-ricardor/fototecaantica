<?php
/*
Template Name: Autores
*/
?>
<?php get_header(); ?>

<?php
	// RRE 2020
	$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
	$ver = isset($_GET['ver']) ? $_GET['ver'] : '';
	$ini = isset($_GET['ini']) ? $_GET['ini'] : ''; //inicial

	if ($cat=='procesos') $categoria = "Proceso fotográfico";
	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autores";

?>

<div id="header2">
	<div class="wrap">
		<h2>Autores</h2>
		<h1><?php if ($ini=='') { echo '&nbsp;'; } else echo $ini; ?></h1>

		<a href="<?php echo get_option('home',''). "/catalogo/"; ?>/">Menú anterior</a>
	</div><!-- .wrap -->
</div><!-- #header2 -->

<div id="content">
<div class="wrap">

    <div id="iniciales">
    <ul>
    <?php
        $all_resultado = getIniciales();
        $i=1;
        foreach ($all_resultado as $resultado) {
            $inicial = $resultado->inicial;
        ?>

        <li><a href="<?php echo get_option('home',''); ?>/autores/?page=ft/fichas.php&cat=autores&ini=<?php echo $inicial; ?>"><?php echo $inicial; ?></a></li>

    <?php } ?>
    </ul>
    </div><!-- #iniciales -->

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
      <li><a href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=<?php echo $cat; ?>&ver=<?php echo $autorslug; ?>&ficha=<?php echo $autorslug; ?>"><?php echo $autor; ?></a></li>

    <?php } } ?>
    </ul>

    <?php if ( $ini=='' ) { ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="autorestexto"><?php the_content();?></div>

    <?php endwhile; endif; ?>
    <?php } ?>

</div><!-- #autores -->


<div style="clear:both;"></div>

</div> <!-- .wrap -->
</div> <!-- #content -->

<?php get_footer(); ?>