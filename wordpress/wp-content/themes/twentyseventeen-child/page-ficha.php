<?php
/*
    Template Name: Ficha
*/
get_header();

	$cat = $_GET['cat'];
	$ver = $_GET['ver'];
	$ficha = $_GET['ficha'];

	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autor";
	if ($cat=='buscar') $categoria = "Buscar";
?>

<div id="header2">
	<div class="container">
		<h2><?php echo $categoria; ?></h2>
		<h1><?php if ($cat == "autores") echo anticaGetAutor($ver); else echo $ver; ?></h1>
        <div class="container">
            <?php
            $back_url = get_option('home',''). "/archivo/?page=ft/fichas.php&cat=". $cat ."&ver=". $ver;
            // Add nonce
            if ( isset( $_GET['_wpnonce'] ) ||  isset( $_POST['_wpnonce'] ) ) {
               $back_url = wp_nonce_url($back_url,'buscar_action');
            }
            ?>
            <div class="header2-col-left">
                <a href="<?php echo $back_url ?>"><?php echo __('Menú anterior','antica'); ?></a>
            </div><!-- .header2-col-left -->
        </div><!-- .container -->
	</div><!-- .container -->
</div><!-- #header2 -->

<div id="antica-content">
    <div class="container">

    <div id="fichas">

        <?php
        $all_resultado = anticaGetFicha($ficha);
        $i=1;
        foreach ($all_resultado as $resultado) {
            $inventario = $resultado->inventario;
            $personaje_ficha = (strtolower($resultado->personaje)=='no aplica' ? '' : $resultado->personaje );
            $title_img = ( !empty($personaje_ficha) ? $personaje_ficha : $inventario );

            /**
             *  RRE 2020 Test if the Fotography file exists
            */
            $url = get_stylesheet_directory_uri() . '/images/' . 'pendiente.jpg';
            $url2 = ''; $formatoimagen2 = 'alta';

            /**
             * RRE 2020
             *  Fotografia Main Image
             *  Fotography directory - WordpressDirectory/miniaturas/
            */
            if ( file_exists( ABSPATH.'/miniaturas/'. $inventario .'.jpg' ) ) {
                $url = get_option('home','').'/miniaturas/'. $inventario .'.jpg';
            }
            if ( @getimagesize( $url ) ) {
                list($ancho, $alto, $tipo, $atrib) = getimagesize( $url );
                $proporcion = $ancho/$alto; if ($proporcion>1.1) $formatoimagen = 'ancha'; else $formatoimagen = 'alta';
            }

            /**
             * RRE 2020
             *  Reverso de la fotografia
             *  Reverse of the fotography directory - WordpressDirectory/miniaturas-r/
            */
            if ( file_exists( ABSPATH.'/miniaturas-r/'. $inventario .'-r.jpg' ) ) {
                $url2 = get_option('home','').'/miniaturas-r/'. $inventario .'-r.jpg';

                if ( @getimagesize( $url2 ) ) {
                    list($ancho2, $alto2, $tipo2, $atrib2) = getimagesize( $url2 );
                    $proporcion2 = $ancho2/$alto2; if ($proporcion2>1.1) $formatoimagen2 = 'ancha'; else $formatoimagen2 = 'alta';
                }
            }

            /**
             * RRE - 2020uri EDD Store
             *
             */
            $uri_edd = '';
            if (class_exists('EDD_Download')) {
                $edd_ficha = edd_get_download(strtolower($resultado->inventario));
                if ( ! empty( $edd_ficha ) && $edd_ficha->post_status === 'publish' ) {
                    $uri_edd = get_option('home','') . '/downloads/' . strtolower($resultado->inventario);
                    // Add nonce
                    $uri_edd = wp_nonce_url($uri_edd,'buscar_action');
                }
            }

        ?>

        <div id="foto" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
            <img id="fichaFrontImg" src="<?php echo $url; ?>" class="miniatura" title="<?php echo $title_img ?>">
        <?php
            /**
             *  Reverso de la fotografia
            */
            if ( !empty($url2) ) {
                    if ( $ancho2==null ) {
                        echo '		<img id="fichaRearImg" >';
                    } else {
                        echo '		<img id="fichaRearImg" src="' . $url2 . '" class="miniaturareverso'. $formatoimagen2. '">';
                    }
            } else {
                echo '		<img id="fichaRearImg" >';
            }
        ?>
        </div><!-- #foto -->

        <div id="ficha">

            <div class="inventario"><?php echo $inventario; ?></div>
            <div class="registro ocultar">Número de inventario</div>
            <div class="registro siver">Núm. inventario</div>

            <div class="linea"></div>

            <div class="bloque">
                <p class="campo">Autor</p><?php $autor = $resultado->autor; $autorslug = $resultado->autorslug; ?>
                <a href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=autores&ver=<?php echo $autorslug; ?>"><?php echo $autor; ?></a>

                <p class="campo">Función</p>
                <span><?php echo $resultado->funcion; ?></span>

                <p class="campo">Título de origen</p>
                <span><?php echo $resultado->titulo; ?></span>

                <p class="campo">Fecha de la imagen física</p>
                <span><?php echo $resultado->fecha; ?></span>

                <p class="campo">Lugar de la imagen visual</p>
                <span><?php echo $resultado->lugar; ?></span>
            </div><!-- .bloque -->

            <div class="bloque">
                <p class="campo">Proceso fotográfico</p>
                <span><?php echo $resultado->proceso; ?></span>

                <p class="campo">Tamaño</p>
                <span><?php echo $resultado->tamano; ?></span>

                <p class="campo">Fondo</p>
                <span><?php echo $resultado->fondo; ?></span>

                <p class="campo">Subfondo</p>
                <span><?php echo $resultado->subfondo; ?></span>

                <?php $serie = $resultado->serie; if($serie!='No aplica') { ?>
                  <p class="campo">Serie</p>
                    <span><?php echo $serie; } ?></span>
            </div><!-- .bloque -->

            <div style="clear:both;"></div>

            <div class="linea ocultar"></div>
                <p class="campo">Descriptores</p>
                <span><?php echo $resultado->descriptores; ?></span><br>

                <?php $personaje = $resultado->personaje; if($personaje!='No aplica') { ?>
                <p class="campo">Nombre del personaje</p>
                <span><?php echo $personaje; } ?></span>

                <?php
                // Link to EDD
                if ( ! empty( $uri_edd ) ) {
                    // View the EDD Product
                    $ft_html = '<div>';
                    $ft_html .= '<a href="' . $uri_edd . '">';
                    // $ft_html .= '<button class="edd-submit button">' . __('Comprar','antica') . ' ' . $inventario .'</button></a>';
                    $ft_html .= '<button class="antica-submit button">' . __('Comprar','antica') . ' ' . $inventario .'</button></a>';
                    $ft_html .= '</div>';
                    echo $ft_html;

                    // View the EDD Product Option 2
                    $ft_html = '<div>';
                    $ft_html .= '<a href="' . $uri_edd . '">';
                    $ft_html .= '<button class="edd-submit button">' . __('Comprar','antica') . ' ' . $resultado->topografica .'</button></a>';
                    $ft_html .= '</div>';
                    echo $ft_html;
                }
                ?>

        </div><!-- #ficha -->

        <div id="modalFront" class="modal" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
          <span class="antica-modal-close">&times;</span>
          <img class="modal-content <?php echo $formatoimagen; ?>" id="img01">
        </div><!-- #myModal .modal -->

        <div id="modalRear" class="modal" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
          <span class="antica-modal-close 2">&times;</span>
          <img class="modal-content <?php echo $formatoimagen2; ?>" id="img02">
        </div><!-- #myModal 2 .modal -->

        <div style="clear:both;"></div>

        <?php } ?>

    </div><!-- #fichas -->
    </div> <!-- .container -->
</div> <!-- #content -->

<script>
// Get the modal
var modal = document.getElementById('modalFront');
var img = document.getElementById('fichaFrontImg');
var modalImg = document.getElementById("img01");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
}
var span = document.getElementsByClassName("antica-modal-close")[0];
span.onclick = function() {
    modal.style.display = "none";
}

var modal = document.getElementById('modalRear');
var img = document.getElementById('fichaRearImg');
var modalImg = document.getElementById("img02");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
}
var span = document.getElementsByClassName("antica-modal-close 2")[0];
span.onclick = function() {
    modal.style.display = "none";
}

</script>

<?php get_footer();
