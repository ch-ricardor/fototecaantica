<?php

// ocultar favorite action (drow para agregar entradas desde header) 
function custom_favorite_menu($actions) {
   echo '<style type="text/css">
            #favorite_actions { display: none !important; }
          </style>';
}
add_filter('favorite_actions', 'custom_favorite_menu');

// administrador de links
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

// ocultar admin bar 
if ( !(current_user_can('level_10')) ) {
	show_admin_bar(false);
}
//remove_action('init', 'wp_admin_bar_init');

// deshabilitar cargador flash
function disable_flash_uploader() {
	return false;
}
add_filter( 'flash_uploader', 'disable_flash_uploader', 1 );


// activar miniaturas
add_theme_support( 'post-thumbnails', array( 'page' ) );

// campos en lista de entradas
add_filter('manage_posts_columns', 'scompt_columns');
function scompt_columns($columns){
   $columns = array(
      "cb" 			=> "<input type=\"checkbox\" />",
      "title" 		=> "Titulo de la publicacion",
      "categories" 	=> "Seccion",
	  "tags" 		=> "Tema",
	  "date" 		=> "Fecha",
	);
return $columns;
}

// campos en lista de paginas
add_filter('manage_pages_columns', 'scompt_columns_page');
function scompt_columns_page($columns){
   $columns = array(
      "cb" 			=> "<input type=\"checkbox\" />",
      "title" 		=> "Titulo de la publicacion"
	);
return $columns;
}

function shortcode_linea() {
	return '<div style="clear:both;"></div>';
}
add_shortcode('linea', 'shortcode_linea');

// ocultar menus que no se requieren Suscriptor 
if ( current_user_can('editor') ) {
  //show_admin_bar(false);

  add_action( 'admin_init', 'my_remove_menu_pages' );
 
  function my_remove_menu_pages() {
    remove_menu_page('upload.php'); // Multimedia
    remove_menu_page('edit.php'); // Páginas
    remove_menu_page('tools.php'); // Herramientas
    remove_menu_page('edit-comments.php'); // Comentarios
  }
}

function description() {
    global $post;
    $thumbID = get_post_thumbnail_id( $post->ID );
    $img_attributes = wp_get_attachment_image_src( $thumbID, 'full' );
    return $img_attributes[0];
}

////////////////////// fototeca ////////////////////

function getArchivoCount($cat,$ver) {
  global $wpdb;

  if( $cat=='fondos' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *, count(autor) as registros
      FROM {$wpdb->prefix}ft_fichas
      WHERE tamanofondo='$ver'
    ");
    foreach ($all_resultados as $resultado) { $total_registros = $resultado->registros; }
  } elseif( $cat=='autores' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *, count(autor) as registros
      FROM {$wpdb->prefix}ft_fichas
      WHERE autorslug ='$ver'
    ");
    foreach ($all_resultados as $resultado) { $total_registros = $resultado->registros; }
  } elseif( $cat=='buscar' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *, count(autor) as registros
      FROM {$wpdb->prefix}ft_fichas
      WHERE MATCH (completo) AGAINST ('$ver')
    ");

    /*elseif( $cat=='buscar' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *, count(autor) as registros
      FROM {$wpdb->prefix}ft_fichas
      WHERE LOWER (completo) LIKE  '%$ver%'
    ");*/
    foreach ($all_resultados as $resultado) { $total_registros = $resultado->registros; }
    if ( $total_registros==0 ) {
      $palabra = explode(" ", $ver);
      $busquedas = count($palabra);
      if ( $busquedas==2 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *, count(autor) as registros
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%'
      ");
      } elseif ( $busquedas==3 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *, count(autor) as registros
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%' AND LOWER (completo) LIKE '%$palabra[2]%'
      ");
      } elseif ( $busquedas>=4 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *, count(autor) as registros
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%' AND LOWER (completo) LIKE '%$palabra[2]%' AND LOWER (completo) LIKE '%$palabra[3]%'
      ");
      }
    foreach ($all_resultados as $resultado) { $total_registros = (-1)*$resultado->registros; }
    } // fin si no hay registros
  }
  return $total_registros;
}

function getArchivo($cat,$ver,$inicio,$TAMANO_PAGINA) {
  global $wpdb;
  if( $cat=='fondos' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *
      FROM {$wpdb->prefix}ft_fichas
      WHERE tamanofondo='$ver'
      ORDER BY inventario ASC
      LIMIT $inicio, $TAMANO_PAGINA
    ");
  } elseif( $cat=='autores' ) {
    $all_resultados = $wpdb->get_results("
      SELECT *
      FROM {$wpdb->prefix}ft_fichas
      WHERE autorslug='$ver'
      ORDER BY inventario ASC
      LIMIT $inicio, $TAMANO_PAGINA
    ");
  } elseif( $cat=='buscar' and $TAMANO_PAGINA>0 ) {
    $all_resultados = $wpdb->get_results("
      SELECT *
      FROM {$wpdb->prefix}ft_fichas
      WHERE MATCH (completo) AGAINST ('$ver')
      LIMIT $inicio, $TAMANO_PAGINA
    ");
    //ALTER TABLE ft_fichas ADD FULLTEXT (completo)
    /*elseif( $cat=='buscar' and $TAMANO_PAGINA>0 ) {
    $all_resultados = $wpdb->get_results("
      SELECT *
      FROM {$wpdb->prefix}ft_fichas
      WHERE LOWER (completo) LIKE '%$ver%'
      LIMIT $inicio, $TAMANO_PAGINA
    ");*/
  } elseif( $cat=='buscar' and $TAMANO_PAGINA<0 ) {
    $TAMANO_PAGINA = -$TAMANO_PAGINA;
    $palabra = explode(" ", $ver);
    $busquedas = count($palabra);
    if ( $busquedas==2 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%'
        LIMIT $inicio, $TAMANO_PAGINA
      ");
    } elseif ( $busquedas==3 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%' AND LOWER (completo) LIKE '%$palabra[2]%'
        LIMIT $inicio, $TAMANO_PAGINA
      ");
    } elseif ( $busquedas>=4 ) {
      $all_resultados = $wpdb->get_results("
        SELECT *
        FROM {$wpdb->prefix}ft_fichas
        WHERE LOWER (completo) LIKE '%$palabra[0]%' AND LOWER (completo) LIKE '%$palabra[1]%' AND LOWER (completo) LIKE '%$palabra[2]%' AND LOWER (completo) LIKE '%$palabra[3]%'
        LIMIT $inicio, $TAMANO_PAGINA
      ");
    }

  }
  return $all_resultados;
}

function getFicha($ficha) {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT *
    FROM {$wpdb->prefix}ft_fichas
    WHERE inventario='$ficha'
    LIMIT 1
  ");
  return $all_resultados;
}

function getIniciales() {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT *, count(inicial) as iniciales
    FROM {$wpdb->prefix}ft_fichas
    GROUP BY inicial ASC
  ");
  return $all_resultados;
}

function getAutores($inicial) {
  global $wpdb;
  if ($inicial!='') {
  $all_resultados = $wpdb->get_results("
    SELECT inicial, autor, autorslug
    FROM {$wpdb->prefix}ft_fichas
    WHERE inicial='$inicial'
    GROUP BY autor ASC
  "); }
  return $all_resultados;
}

function getAutor($autorslug) {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT autor, autorslug
    FROM {$wpdb->prefix}ft_fichas
    WHERE autorslug='$autorslug'
    GROUP BY autor ASC
  ");
  foreach ($all_resultados as $resultado) {
    $autor = $resultado->autor;
  }
  return $autor;
}

function getEstante($ver) {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT autor, topografica, count(autor) as registros
    FROM {$wpdb->prefix}ft_fichas
    WHERE LOWER (topografica) LIKE '%$ver'
    GROUP BY autor ASC
  ");
  return $all_resultados;
}

function getTodo() {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT *
    FROM {$wpdb->prefix}ft_fichas
    ORDER BY inventario ASC
  ");
  return $all_resultados;
}

function getHorizontales() {
  global $wpdb;
  $all_resultados = $wpdb->get_results("
    SELECT *
    FROM {$wpdb->prefix}ft_fichas
    WHERE tamanofondo!='Vistas Estereoscópicas'
    ORDER BY inventario ASC
  ");
  return $all_resultados;
}
//WHERE fondo=''
//ORDER BY inventario ASC
//GROUP BY inventario ASC

?>