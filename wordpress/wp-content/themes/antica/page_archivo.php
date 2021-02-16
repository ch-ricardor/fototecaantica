<?php
/*
Template Name: Archivo
*/
?>
<?php get_header(); ?>

<body style="background: none;">

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<?php
	if ( empty($ver) ) { $ver = $_POST['ver']; } 
	if ( !empty($_GET['ver']) ) { $ver = $_GET['ver'] ; }

	$cat = $_GET['cat'];
	$ini = $_GET['ini']; //inicial

	$tr = $_GET['tr']; // total de registros
	$tp = $_GET['tp']; // total de paginas

	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autor";
	if ($cat=='buscar') { $categoria = "Buscar"; 
		$ver = strtolower($ver); // convertir a minusculas
		$ver = trim($ver); // quitar espacios al inicio y final
		$ver = preg_replace('/( ){2,}/u',' ',$ver); // quitar dobles espacios
	} 

	$TAMANO_PAGINA = 8;
	if ( !isset($tr) and $ver<>'' ) { 
		$num_total_registros = getArchivoCount($cat,$ver);
		$total_paginas = ceil(abs($num_total_registros) / $TAMANO_PAGINA);
	} else {
		$num_total_registros = $tr;
		$total_paginas = $tp;
	}

	if ( $cat=='buscar' ) $pag = 'buscar'; else $pag = 'archivo';
	$url = get_settings('home')."/".$pag."/?cat=".$cat."&ver=".$ver."&tr=".$num_total_registros."&tp=".$total_paginas;
?>

<div id="header2">
<div id="wrap">
	<h2><?php echo $categoria; ?></h2>
	<h1><?php if ($cat == "autores") echo getAutor($ver); elseif ( $ver=='Estereoscópica' ) { echo 'Vistas Estereoscópicas'; } elseif ($ver=='') { echo '&nbsp;'; } else echo $ver; ?></h1>

<?php if ( $cat=='buscar' ) { ?>
	<div id="buscar">
		<form method="POST" action="<?php echo get_settings('home')."/archivo/?cat=buscar"; ?>">
			<input type="text" name="ver" value="<?php echo $ver; ?>" class="input buscar" />
			<input type="submit" name="submit" value="Buscar" class="boton" />
		</form>
	</div>
<?php } else { ?>
	<a href="<?php echo get_settings('home'). "/". $cat; ?>/">Menú anterior</a>
<?php }  ?>

<div id="pagenavi">

<?php // pagenavi
if ( abs($num_total_registros) > 0 and $ver<>'' ) {	
	$pagina = false;

	if (isset($_GET["pagina"])) $pagina = $_GET["pagina"];

	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else { $inicio = ($pagina - 1) * $TAMANO_PAGINA; }

	if ( $total_paginas<=10 ) {
		$rango1 = 1;
		$rango2 = $total_paginas;
	}

	if ( $total_paginas>10 ) {
		if ( $pagina<=10 ) $rango1 = 1;
		elseif ( $pagina>10 ) $rango1 = $pagina-9;

		if ( $pagina>10 ) $rango2 = $pagina;
		elseif ( $pagina<=10 ) $rango2 = 10;
	}

	if ($total_paginas > 1) {
		if ($pagina != 1) echo '<a href="'.$url.'">‹1</a><a class="ocultar" href="'.$url.'&pagina='.($pagina-1).'">«</a>';
		for ($i=$rango1;$i<=$rango2;$i++) {
			if ($pagina == $i) echo '<strong>'.$pagina.'</strong>';
			else echo '  <a href="'.$url.'&pagina='.$i.'">'.$i.'</a>  ';
		}
		if ($pagina != $total_paginas) echo '<a class="ocultar" href="'.$url.'&pagina='.($pagina+1).'">»</a>';
		if ($pagina < $total_paginas) echo '<a href="'.$url.'&pagina='.$total_paginas.'">'.$total_paginas.'›</a>';
	}

} // fin paginavi
?>
</div>

</div><!-- fin wrap -->
</div>

<div id="content">
<div id="wrap">

<?php if ( $_REQUEST['action'] == 'buscar' or $ver<>'' ) { ?>

<div id="fichas">

<?php

	if ( $num_total_registros<0 ) $signo = -1; else $signo = 1; // identificar signo
	$all_resultado = getArchivo($cat,$ver,$inicio,$signo*$TAMANO_PAGINA);
	$i=1;
	foreach ($all_resultado as $resultado) {
	?>
	
<div id="fotitos" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
	<?php
	$autor = $resultado->autor; if ( $autor=='No identificado' ) $autor = ''; 
	$inventario = $resultado->inventario; 
	$url = get_settings('home').'/miniaturas/'. $inventario .'.jpg';
	if ( @getimagesize( $url ) ) {
		list($ancho, $alto, $tipo, $atrib) = getimagesize( $url );
		$proporcion = $ancho/$alto;
		if ($proporcion>.7) { $formatoimagen = 'miniaturaancha'; $referencia = 'referenciacentro'; }
		else { $formatoimagen = 'miniaturachica'; $referencia = 'referenciaizq'; }
	} else { 
		$url = get_settings('home').'/pendiente.jpg'; 
		$formatoimagen = 'miniaturaancha'; $referencia = 'referenciacentro';
	} ?>
		<a href="<?php echo get_settings('home'); ?>/ficha/?page=ft/fichas.php&cat=<?php echo $cat; ?>&ver=<?php echo $ver; ?>&ficha=<?php echo $inventario; ?>"><?php echo '<img src="'. $url .'" class="'.$formatoimagen.'">'; ?>
	<?php if ($proporcion>.7) { echo '<div style="clear:both;"></div>'; } echo '<div class="'. $referencia .'">'.$autor; 
	if ($referencia=='referenciaizq' and $autor!='' ) echo '<br>';
	if ($referencia=='referenciacentro' and $autor!='' ) { echo ' - '; }
	
	echo $inventario; ?></div></a>
</div>

<?php } ?>

</div> <!-- fin fichas -->

<?php } // fin action buscar ?>

</div> <!-- fin wrap -->
</div> <!-- fin content -->

<?php get_footer(); ?>