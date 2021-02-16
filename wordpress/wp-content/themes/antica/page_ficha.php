<?php
/*
Template Name: Ficha
*/
?>
<?php get_header(); ?>
<body style="background: none;">

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<?php
	$cat = $_GET['cat'];
	$ver = $_GET['ver'];
	$ficha = $_GET['ficha'];

	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autor";
	if ($cat=='buscar') $categoria = "Buscar";
?>

<div id="header2">
	<div id="wrap">
		<h2><?php echo $categoria; ?></h2>
		<h1><?php if ($cat == "autores") echo getAutor($ver); else echo $ver; ?></h1>

		<a href="<?php echo get_settings('home'). "/archivo/?page=ft/fichas.php&cat=". $cat ."&ver=". $ver; ?>">Menú anterior</a>
	</div>
</div>

<div id="content">
<div id="wrap">

<div id="fichas">

	<?php
		$all_resultado = getFicha($ficha);
		$i=1;
		foreach ($all_resultado as $resultado) {
		?>
		
	<div id="foto" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
	<?php
		$inventario = $resultado->inventario; 
		$url = get_settings('home').'/miniaturas/'. $inventario .'.jpg';
		$url2 = get_settings('home').'/miniaturas-r/'. $inventario .'-r.jpg';

		if ( @getimagesize( $url ) ) {
			list($ancho, $alto, $tipo, $atrib) = getimagesize( $url ); 
			$proporcion = $ancho/$alto; if ($proporcion>1.1) $formatoimagen = 'ancha'; else $formatoimagen = 'alta';
		} else { 
			$url = get_settings('home').'/pendiente.jpg'; 
		}
		if ( @getimagesize( $url2 ) ) {
			list($ancho2, $alto2, $tipo2, $atrib2) = getimagesize( $url2 ); 
			$proporcion2 = $ancho2/$alto2; if ($proporcion2>1.1) $formatoimagen2 = 'ancha'; else $formatoimagen2 = 'alta';
		}
	?>
		<img id="myImg" src="<?php echo $url; ?>" class="miniatura">
	
	<?php if ( $ancho2==null ) { echo '<img id="myImg 2" >'; } else { ?>
		<img id="myImg 2" src="<?php echo $url2; ?>" class="miniaturareverso<?php echo $formatoimagen2; ?>">
	 <?php } ?>

	</div>

	<div id="ficha">

		<div class="inventario"><?php echo $inventario; ?></div>
		<div class="registro ocultar">Número de inventario</div>
		<div class="registro siver">Núm. inventario</div>

		<div class="linea"></div>

		<div class="bloque">
			<p class="campo">Autor</p><?php $autor = $resultado->autor; $autorslug = $resultado->autorslug; ?>
			<a href="<?php echo get_settings('home'); ?>/archivo/?page=ft/fichas.php&cat=autores&ver=<?php echo $autorslug; ?>"><?php echo $autor; ?></a>

			<p class="campo">Función</p>
			<?php echo $resultado->funcion; ?>

			<p class="campo">Título de origen</p>
			<?php echo $resultado->titulo; ?>

			<p class="campo">Fecha de la imagen física</p>
			<?php echo $resultado->fecha; ?>

			<p class="campo">Lugar de la imagen visual</p>
			<?php echo $resultado->lugar; ?>
		</div>

		<div class="bloque">
			<p class="campo">Proceso fotográfico</p>
			<?php echo $resultado->proceso; ?>

			<p class="campo">Tamaño</p>
			<?php echo $resultado->tamano; ?>

			<p class="campo">Fondo</p>
			<?php echo $resultado->fondo; ?>

			<p class="campo">Subfondo</p>
			<?php echo $resultado->subfondo; ?>

			<?php $serie = $resultado->serie; if($serie!='No aplica') { ?>
			  <p class="campo">Serie</p>
			<?php echo $serie; } ?>
		</div>

		<div style="clear:both;"></div>

		<div class="linea ocultar"></div>
			<p class="campo">Descriptores</p>
			<?php echo $resultado->descriptores; ?><br>

			<?php $personaje = $resultado->personaje; if($personaje!='No aplica') { ?>
			<p class="campo">Nombre del personaje</p>
			<?php echo $personaje; } ?>

	</div>

	<div id="myModal" class="modal" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
	  <span class="close">&times;</span>
	  <img class="modal-content <?php echo $formatoimagen; ?>" id="img01">
	</div>

	<div id="myModal 2" class="modal" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
	  <span class="close 2">&times;</span>
	  <img class="modal-content <?php echo $formatoimagen2; ?>" id="img02">
	</div>

	<div style="clear:both;"></div>

	<?php } ?>

</div>
</div> <!-- fin wrap -->
</div> <!-- fin content -->

<script>
// Get the modal
var modal = document.getElementById('myModal');
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
}
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
    modal.style.display = "none";
}

var modal = document.getElementById('myModal 2');
var img = document.getElementById('myImg 2');
var modalImg = document.getElementById("img02");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
}
var span = document.getElementsByClassName("close 2")[0];
span.onclick = function() { 
    modal.style.display = "none";
}

</script>

<?php get_footer(); ?>