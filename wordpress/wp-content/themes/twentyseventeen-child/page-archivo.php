<?php
/*
    Template Name: Archivo
*/
?>
<?php get_header(); ?>

<?php
    // RRE 2020
    if ( isset($_GET['ver']) ) {
        $ver = $_GET['ver'];
    } else {
        if (  isset($_POST['ver']) ) {
            $ver = $_POST['ver'];
        } else { $ver = '';
        }
    }

	// RRE 2020
	$cat = isset($_GET['cat']) ? $_GET['cat'] : 'buscar'; // Buscar Option is an Empty Page -> Template Archivo
	$ini = isset($_GET['ini']) ? $_GET['ini'] : ''; //inicial

    // RRE 2020
	$tr = isset($_GET['tr']) ? $_GET['tr'] : NULL; // total de registros
	$tp = isset($_GET['tp']) ? $_GET['tp'] : 0; // total de paginas

	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autor";
	if ($cat=='buscar') { $categoria = "Buscar";
        // nonce Search form Validation
        if ( ! empty($ver) ) {
            // Call from the Form
            if ( ! isset( $_POST['search_nonce_field'] )
                || ! wp_verify_nonce( $_POST['search_nonce_field'],'buscar_action' )
            ) {
                // Call from href
                if ( ! isset ( $_GET['_wpnonce'] )
                  || ! wp_verify_nonce( $_GET['_wpnonce'], 'buscar_action' )
                ) {
                    exit;
                }
            }

            $ver = strtolower($ver); // convertir a minusculas
            $ver = trim($ver); // quitar espacios al inicio y final
            $ver = preg_replace('/( ){2,}/u',' ',$ver); // quitar dobles espacios

        }

		$ver = strtolower($ver); // convertir a minusculas
		$ver = trim($ver); // quitar espacios al inicio y final
		$ver = preg_replace('/( ){2,}/u',' ',$ver); // quitar dobles espacios
	}

	$TAMANO_PAGINA = 8;
	if ( !isset($tr) and $ver<>'' ) {
		$num_total_registros = anticaGetArchivoCount($cat,$ver);
		$total_paginas = ceil(abs($num_total_registros) / $TAMANO_PAGINA);
	} else {
		$num_total_registros = $tr;
		$total_paginas = $tp;
	}

	if ( $cat == 'buscar' ) {
        $pag = 'buscar';
    }
    else {
        $pag = 'archivo';
    }
	$url = get_option('home','')."/".$pag."/?cat=".$cat."&ver=".$ver."&tr=".$num_total_registros."&tp=".$total_paginas;
    // add nonce
    $url = wp_nonce_url($url,'buscar_action');
?>

<div id="header2">
    <div class="container">

        <h2><?php echo $categoria; ?></h2>
        <h1><?php
        if ($cat == "autores") echo anticaGetAutor($ver);
        elseif ( $ver=='Estereoscópica' ) { echo __('Vistas Estereoscópicas','antica'); }
            elseif ($ver=='') { echo '&nbsp;'; }
                else echo $ver; ?>
        </h1>

        <div class="container">

            <?php
            if ( $cat == 'buscar' ) {
                $referer = wp_get_referer();
            ?>
            <a href="<?php echo $referer ?>" class="button-back"><?php echo __('Regresar','antica'); ?></a>

            <div class="header2-col-left">
                <form id="buscar" method="POST" action="<?php echo get_option('home','')."/buscar/?cat=buscar"; ?>">
                    <input type="text" name="ver" value="<?php echo $ver; ?>" class="input buscar" />
                    <input type="submit" name="submit" value="Buscar" class="boton" />
                    <?php wp_nonce_field( 'buscar_action', 'search_nonce_field' ); ?>
                </form>
            <?php
            } else {
                // $referer = wp_get_referer();
                $referer = '';
                if ( empty( $referer ) ) {
                    $referer = get_option('home','') . "/" . $cat;
                }
            ?>
                <a href="<?php echo $referer ?>" class="button-back"><?php echo __('Menú anterior','antica'); ?></a>
            <?php
            }
            ?>

            </div><!-- .header2-col-left -->

            <div class="header2-col-left">
                <div id="pagenavi">
                <?php
                // pagenavi
                /**
                 *  RRE 2020
                 *		No existia condicion si no hay registros
                */
                if ( abs($num_total_registros) == 0 and $ver<>'' ) {
                    $inicio = 0;
                }

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
                // fin pagenavi
                ?>

                </div><!-- #pagenavi -->


            </div><!-- .header2-col-left -->

        </div><!-- .container -->

    </div><!-- .container -->
</div><!-- #header2 -->

<div style="clear:both;"></div>

<div id="antica-content">
    <div class="container">

    <?php
        // RRE 2020
        $theAction = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
        if ( $theAction == 'buscar' or $ver<>'' ) {
    ?>

    <div id="fichas">

    <?php

        if ( $num_total_registros<0 ) $signo = -1; else $signo = 1; // identificar signo

        $all_resultado = anticaGetArchivo($cat,$ver,$inicio,$signo*$TAMANO_PAGINA);
        $i=1;
        foreach ($all_resultado as $resultado) {
            // Photo Ficha NMX-R-069-SCFI-2016
            $inventario = $resultado->inventario; // Link field to EDD Store (SKU)
            $autor = ( strtolower($resultado->autor)=='no identificado' ? '' : $resultado->autor );
            $url_img = get_option('home','').'/miniaturas/'. $inventario .'.jpg';
            $title_ficha = ( strtolower($resultado->titulo) == 'sin título' ? '' : $resultado->titulo );
            $fecha_ficha = $resultado->fecha;
            $proceso_ficha = $resultado->proceso;
            $personaje_ficha = (strtolower($resultado->personaje)=='no aplica' ? '' : $resultado->personaje );

            $title_img = ( !empty($personaje_ficha) ? $personaje_ficha : $inventario );

            $referencia_NMX_html = (!empty($autor) ? $autor : '');
            if (!empty($title_ficha)) {
                if (empty($referencia_NMX_html)) {
                    $referencia_NMX_html .= $title_ficha;
                } else {
                    $referencia_NMX_html .= '<br>' . $title_ficha;
                }
            }
            if (!empty($fecha_ficha)) {
                if (empty($referencia_NMX_html)) {
                    $referencia_NMX_html .= $fecha_ficha;
                } else {
                    $referencia_NMX_html .= '<br>' . $fecha_ficha;
                }
            }
            if (!empty($proceso_ficha)) {
                if (empty($referencia_NMX_html)) {
                    $referencia_NMX_html .= $proceso_ficha;
                } else {
                    $referencia_NMX_html .= '<br>' . $proceso_ficha;
                }
            }

            // Define format of the image - Portrait - Landscape
            if ( @getimagesize( $url_img ) ) {
                list($ancho, $alto, $tipo, $atrib) = getimagesize( $url_img );
                $proporcion = $ancho/$alto;
                if ($proporcion>.7) {
                    $formatoimagen = 'miniaturaancha';
                    $referencia = 'referenciacentro';
                } else {
                    $formatoimagen = 'miniaturachica';
                    $referencia = 'referenciaizq';
                    $referencia = 'referenciacentro'; // Forced
                    // EDD Store Plugin
                    if ( class_exists('EDD_Download') ) {
                        $referencia = 'referenciacentro';
                    }
                }
            } else {
                $url_img = get_stylesheet_directory_uri().'/images/pendiente.jpg';
                $formatoimagen = 'miniatura';
                $referencia = 'referenciacentro';
                $proporcion = 0.8;
            }

            // uri Ficha
            $uri_ficha = get_option('home','') . '/ficha/?page=ft/fichas.php&cat=' . $cat. '&ver=' . $ver. '&ficha=' . $inventario;
            // Add nonce
            $uri_ficha = wp_nonce_url($uri_ficha,'buscar_action');

            // uri EDD Store
            $uri_edd = '';
            if (class_exists('EDD_Download')) {
                $edd_ficha = edd_get_download(strtolower($resultado->inventario));
                if ( !empty( $edd_ficha ) && $edd_ficha->post_status === 'publish' ) {
                    $uri_edd = get_option('home','') . '/downloads/' . strtolower($resultado->inventario);
                    // Add nonce
                    $uri_edd = wp_nonce_url($uri_edd,'buscar_action');
                }
            }
        ?>

            <div id="fotitos" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
                    <a href="<?php echo $uri_ficha; ?>">
                        <?php
                        // Ficha Image
                        $ft_html = '<img src="'. $url_img .'" class="'.$formatoimagen.'"';
                        $ft_html .= ' title="' . $title_img . '"';
                        $ft_html .= ' alt="' . $autor . ' ' . $inventario . '"';
                        $ft_html .= '>';
                        echo $ft_html;
                        ?>
                    </a>
                <?php

                if ($proporcion>.7) {
                    echo '<div style="clear:both;"></div>';
                }

                echo '<div class="'. $referencia .'">'.
                    $referencia_NMX_html;

                // Link to EDD
                if ( !empty( $uri_edd ) ) {
                    // View the EDD Product
                    $ft_html = '<div>';
                    $ft_html .= '<a href="' . $uri_edd . '">';
                    // $ft_html .= '<button class="edd-submit button">' . __('Detalles','antica') . ' ' . $inventario .'</button></a>';
                    $ft_html .= '<button class="antica-submit button">' . __('Detalles','antica') . ' ' . $inventario .'</button></a>';
                    $ft_html .= '</div>';
                    echo $ft_html;
                } else {
                    // View File NMX-R-069-SCFI-2016
                    $ft_html = '<div>';
                    $ft_html .= '<a href="' . $uri_ficha . '">';
                    $ft_html .= '<button class="antica-submit button">' . __('Ficha','antica') . ' ' . $inventario .'</button></a>';
                    $ft_html .= '</div>';
                    echo $ft_html;
                }
                echo '</div>';
                ?>
            </div><!-- #fotitos -->

 <?php  } // End foreach ?>

    </div><!-- #fichas -->

<?php } // fin action buscar ?>

    </div> <!-- .container -->
</div> <!-- #antica-content -->

<?php get_footer();
