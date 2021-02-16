<?php
/*
 *  Author: Zabdiel | @zabdiel
 *  URL: poeticavisual.com | @poeticavisual
 *  Custom functions
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists('add_theme_support'))
{
    // activar miniaturas - NOTE: Needs to be called BEFORE init
    // add_theme_support( 'post-thumbnails', array( 'page' ) );
    add_theme_support( 'post-thumbnails', array( 'archive' ) );
    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    // add_theme_support( 'post-formats', array(
    //    'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
    // ) );
    
    // Localisation Support
    // Todo: Create antica.pot and translations
    // load_theme_textdomain('antica', get_template_directory() . '/languages');

}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

/*------------------------------------*\
	Actions
\*------------------------------------*/

// Load antica scripts (header.php)
function antica_header_scripts()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        // Custom scripts
    }

}

// Load antica conditional scripts
function antica_conditional_scripts()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    // Conditional script(s)
    if ( is_home() ) {
        wp_register_script('anticaintro', get_template_directory_uri() . '/js/antica_intro.js', array('jquery'), $theme_version, false );
        wp_enqueue_script('anticaintro'); // Enqueue it!
    } else {
        // All Pages
        wp_register_script('anticascripts', get_template_directory_uri() . '/js/antica_scripts.js', array('jquery'), $theme_version, false );
        wp_enqueue_script('anticascripts'); // Enqueue it!

        wp_register_script('nivoslider', get_template_directory_uri() . '/js/lib/jquery.nivo.slider.js', array('jquery'), '1.3', false );
        wp_enqueue_script('nivoslider'); // Enqueue it!
    }

    // Example of specific Pages
    if ( is_page(['servicios','mision']) ) {
    }

}

// Load antica styles
function antica_styles()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    // Theme Styles
    wp_register_style('mainstyle', get_template_directory_uri() . '/style.css', array(), $theme_version, 'screen' );
    wp_enqueue_style('mainstyle'); // Enqueue it!

    wp_register_style('responsive1024', get_template_directory_uri() . '/css/responsive-1024.css', array(), $theme_version, 'screen' );
    wp_enqueue_style('responsive1024'); // Enqueue it!

    wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css', array(), $theme_version, 'screen' );
    wp_enqueue_style('responsive'); // Enqueue it!

    wp_register_style('ztable', get_template_directory_uri() . '/css/ztable.css', array(), $theme_version, 'screen' );
    wp_enqueue_style('ztable'); // Enqueue it!

    wp_register_style('mainstyleprint', get_template_directory_uri() . '/styleprint.css', array(), $theme_version, 'print' );
    wp_enqueue_style('mainstyleprint'); // Enqueue it!

    // Conditional Styles
    if ( is_home() ) {
        wp_register_style('anticaintro', get_template_directory_uri() . '/css/antica_intro.css', array(), $theme_version, 'screen');
        wp_enqueue_style('anticaintro'); // Enqueue it!
    } else {
        // All Pages
        // Todo: Validate against Template Used
        wp_register_style('nivoslider', get_template_directory_uri() . '/css/lib/nivo-slider.css', array(), '1.3', 'screen');
        wp_enqueue_style('nivoslider'); // Enqueue it!

        wp_register_style('nivosliderdefault', get_template_directory_uri() . '/css/lib/nivo-default.css', array(), '1.3', 'screen');
        wp_enqueue_style('nivosliderdefault'); // Enqueue it!
    }

}

/*------------------------------------*\
    Wordpress Functionallity
    RRE 2020 Additional
\*------------------------------------*/

// Remove margin-top: 32px Admin
function remove_admin_login_header() {
    // remove_action('wp_head', '_admin_bar_bump_cb');
}

/**
 * Register Menus.
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 */
function antica_register_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Menu Principal' ),
      // 'extra-menu' => __( 'Extra Menu' )
     )
   );
 }
 
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function antica_widgets_init() {
    // If Dynamic Sidebar Exists
    if (function_exists('register_sidebar'))
    {
        register_sidebar(
            array(
                'name'          => __( 'Antica Sidebar', 'antica' ),
                'id'            => 'sidebar-antica',
                'description'   => __( 'Adicione los widgets aqui para que aparezcan en el sidebar de los Postsar y Páginas.', 'antica' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }
}

// Change the number of Posts to display
function antica_pages_blogindex( $query ) {
//      echo print_r($query);
    if ( $query->is_archive() ) {
        $query->set( 'posts_per_page', 12 );
    }
}

/*------------------------------------*\
    Wordpress Functionallity - Original
\*------------------------------------*/

// ocultar favorite action (drow para agregar entradas desde header)
function custom_favorite_menu($actions) {
   echo '<style type="text/css">
            #favorite_actions { display: none !important; }
          </style>';
}

// deshabilitar cargador flash
function disable_flash_uploader() {
	return false;
}

// campos en lista de entradas (Posts)
function scompt_columns($columns){
   $columns = array(
      "cb" 			=> "<input type=\"checkbox\" />",
      "title" 		=> __("Titulo de la publicacion",'antica'),
      "categories" 	=> __("Seccion",'antica'),
	  "tags" 		=> __("Tema",'antica'),
	  "date" 		=> __("Fecha",'antica'),
	);
return $columns;
}

// campos en lista de paginas (Pages)
function scompt_columns_page($columns){
   $columns = array(
      "cb" 			=> "<input type=\"checkbox\" />",
      "title" 		=> __("Titulo de la publicacion",'antica')
	);
return $columns;
}

function description() {
    global $post;
    $thumbID = get_post_thumbnail_id( $post->ID );
    $img_attributes = wp_get_attachment_image_src( $thumbID, 'full' );
    return $img_attributes[0];
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

////////////////////// fototeca ////////////////////

/*------------------------------------*\
	Functions - SQL
\*------------------------------------*/

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

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions

add_action('init', 'antica_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'antica_conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'antica_styles'); // Add Theme Stylesheet
add_action('get_header', 'remove_admin_login_header'); // Remove margin-top: 32px Admin

// RRE 2020 Additional Actions
add_action( 'init', 'antica_register_menus' );
add_action( 'widgets_init', 'antica_widgets_init' ); // Widgets Area to Enable EDD Widgets
add_action( 'pre_get_posts', 'antica_pages_blogindex' ); // Change the number of Posts to display

// Add Filters

// ocultar favorite action (drow para agregar entradas desde header)
add_filter('favorite_actions', 'custom_favorite_menu');
// administrador de links
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
// deshabilitar cargador flash
add_filter( 'flash_uploader', 'disable_flash_uploader', 1 );
// campos en lista de entradas (Posts)
add_filter('manage_posts_columns', 'scompt_columns');
// campos en lista de paginas
add_filter('manage_pages_columns', 'scompt_columns_page');

/**
    RRE Optional Disable Automatic Updates
    If activated update Procedure Manual
*/    
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
// add_filter( 'auto_update_plugin', '__return_false' );
// add_filter( 'auto_update_theme', '__return_false' );

// Remove Filters

// Shortcodes
add_shortcode('linea', 'shortcode_linea');

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

function shortcode_linea() {
	return '<div style="clear:both;"></div>';
}

/*------------------------------------*\
	Specific Configurations
\*------------------------------------*/

// RRE - Todo: Review
// ocultar admin bar
if ( !(current_user_can('level_10')) ) {
	show_admin_bar(false);
}

//remove_action('init', 'wp_admin_bar_init');
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
