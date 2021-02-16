<?php
/*
Template Name: Pendientes
*/
?>
<?php get_header(); ?>
<body <?php if (is_user_logged_in()) { ?> style="background: none;" <?php } ?> >

<?php include(TEMPLATEPATH . '/menu.php'); ?>
<?php if (is_user_logged_in()) { ?>
<div id="content">
<div id="wrap">
<br>
<table class="ajustada">
<thead>
  <tr>
    <th>No.</th><th>ID</th><th>Autor</th><th>Num. Inventario</th>
  </tr>
</thead>
<tbody>
<?php
	$all_resultado = getTodo();
	$i=0; $e = 0; $total = 0;
	foreach ($all_resultado as $resultado) { $i++; $inventario = $resultado->inventario;
		
		$url = get_settings('home').'/miniaturas/'. $inventario .'.jpg';

		list($ancho, $alto, $tipo, $atrib) = getimagesize( $url ); 
		if ($ancho<1) {
			$e++;
	?>
  <tr>
    <td><?php echo $e; ?></td><td><?php echo $i; ?></td><td><?php echo $resultado->autor; ?></td><td><a href="<?php echo get_settings('home'); ?>/ficha/?page=ft/fichas.php&cat=buscar&ver=<?php echo $inventario; ?>&ficha=<?php echo $inventario; ?>" target="_blank"><?php echo $inventario; ?></a></td>
  </tr>
<?php } } ?>
</tbody>
</table>

</div> <!-- fin wrap -->
</div> <!-- fin content -->
<?php } else { include(TEMPLATEPATH . '/homeshort.php'); } ?>
<?php get_footer(); ?>