<?php
/*
Template Name: Estantes
*/
?>
<?php get_header(); ?>

<?php if (is_user_logged_in()) { ?>
<?php
	$ver = $_GET['ver'];
?>

<div id="header2">
	<div class="wrap">
		<h2>Estantes</h2>
		<h1 class="sans"><?php if ($ver=='') { echo 'Total de fichas'; } else echo $ver; ?></h1>

		<a href="<?php echo get_option('home',''). "/estantes/"; ?>/">Menú anterior</a>
	</div><!-- .wrap -->
</div><!-- #header2 -->

<div id="content">
<div class="wrap">

<div id="estantes">
<table>
<thead>
  <tr>
    <th>Estantes /<br> Contenedores</th><th>E1</th><th>E2</th><th>E3</th><th>E4</th><th>E5</th><th>E6</th><th>E7</th><th>E8</th><th>E9</th><th>E10</th><th>E11</th><th>E12</th><th>E13</th><th>E14</th><th>E15</th><th>E16</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Album</td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E5-A1">E5-A1</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-A1">E11-A1</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C1</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C1">E3-C1</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C1">E4-C1</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E5-C1">E5-C1</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E6-C1">E6-C1</a></td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C1">E9-C1</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C1">E11-C1</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C2</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C2">E3-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C2">E4-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E5-C2">E5-C2</a></td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C2">E9-C2</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C2">E11-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E12-C2">E12-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E13-C2">E13-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E14-C2">E14-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E15-C2">E15-C2</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E16-C2">E16-C2</a></td>
  </tr>
  <tr>
    <td>C3</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C3">E3-C3</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C3">E4-C3</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C3">E9-C3</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C3">E11-C3</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C4</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C4">E3-C4</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C4">E4-C4</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C4">E9-C4</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C4">E11-C4</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C5</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C5">E3-C5</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C5">E4-C5</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C5">E9-C5</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C5">E11-C5</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C6</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C6">E3-C6</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C6">E4-C6</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C6">E9-C6</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C6">E11-C6</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C7</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C7">E3-C7</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C7">E4-C7</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C7">E9-C7</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C7">E11-C7</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C8</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C8">E3-C8</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C8">E4-C8</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C8">E9-C8</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C8">E11-C8</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C9</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C9">E3-C9</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C9">E4-C9</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C9">E9-C9</a></td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E11-C9">E11-C9</a></td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C10</td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E3-C10">E3-C10</a></td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E4-C10">E4-C10</a></td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C10">E9-C10</a></td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C11</td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C11">E9-C11</a></td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  <tr>
    <td>C12</td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
    <td><a href="<?php echo get_option('home',''); ?>/estantes/?page=ft/fichas.php&ver=E9-C12">E9-C12</a></td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td><td> </td>
  </tr>
  </tr>
</tbody>
</table>

</div><!-- #estantes -->
<div style="clear:both;"></div>


<table class="ajustada">
<thead>
  <tr>
    <th>No.</th><th>Autor</th><th>Clave topográfica ...<?php echo $ver; ?></th><th>Fichas</th>
  </tr>
</thead>
<tbody>
<?php
	$all_resultado = getEstante($ver);
	$i=0; $total = 0;
	foreach ($all_resultado as $resultado) { $i++; $registros = $resultado->registros; $total = $registros + $total;
	?>
  <tr>
    <td><?php echo $i; ?></td><td><?php echo $resultado->autor; ?></td><td><?php echo $resultado->topografica; ?></td><td><?php echo $registros; ?></td>
  </tr>
<?php } ?>
</tbody>
<tfoot>
	<tr>
    <td colspan="3"></td><td><?php echo $total; ?></td>
  </tr>
</tfoot>
</table>

<div style="clear:both;"></div>

</div> <!-- .wrap -->
</div> <!-- #content -->
<?php } else { include(TEMPLATEPATH . '/homeshort.php'); } ?>
<?php get_footer(); ?>