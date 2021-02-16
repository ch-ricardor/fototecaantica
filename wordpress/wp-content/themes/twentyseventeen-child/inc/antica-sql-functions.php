<?php
/**
 * Returns record count of a table
 *
 * @package Antica
 * @param strin $cat
 * @param string $ver
 * @param string $ft_table
 * @return int
 */
function anticaGetArchivoCount($cat,$ver, $ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT count(autor) as registros".
        " FROM {$wpdb->prefix}" . $ft_table;

    switch ($cat ) {
      case "fondos" : 
        $ft_sql .= " WHERE tamanofondo='$ver'";
        break;
      case "autores" :
        $ft_sql .= " WHERE autorslug='$ver'";
        break;
      case "buscar" :
        /**
         * FULL Text - Reconstruction
         *  - Option If full text index is not available
         *  Words need to be tokenized to allow fulltext or Like clauses
         */
        $busquedas = explode(" ", $ver);
        $sql_palabras = "";
        $sql_fulltext_palabras = "";
        foreach( $busquedas as $busqueda => $palabra ) {
            if ( empty( $sql_palabras ) ){
                $sql_palabras = " WHERE LOWER (completo) LIKE '%$palabra%'";
                $sql_fulltext_palabras = " WHERE MATCH (completo) AGAINST ('";
            } else {
                $sql_palabras .= " OR LOWER (completo) LIKE '%$palabra%'";
                // Spacer
                $sql_fulltext_palabras .= ' ';
            }
            // Suffix * equivalent to Like %
            $sql_fulltext_palabras .= trim($palabra) .'*';
        }
        if ( empty( $sql_palabras ) ) {
            // No Records
            return 0;
        }
        /**
         * Complete the Full Text Expression
         *  FullText Search Try Catch
         *  Could be the possibility that the Index Doesn't Exist. (Installation - Performance)
         */
        $sql_fulltext_palabras .= " ' IN BOOLEAN MODE )"; // Closing Fulltext Clause

        $wpdb->suppress_errors(); // Do not display the SQL error
        $total_registros = $wpdb->query($ft_sql . $sql_fulltext_palabras);
        if ( $total_registros === FALSE ) {
            // Like Option
            $total_registros = $wpdb->get_var($ft_sql . $sql_palabras);
            // echo '<br> Run Like ' . $total_registros;
        } else {
            $total_registros = $wpdb->get_var($ft_sql . $sql_fulltext_palabras);
            // echo '<br> Run Ok ' . $total_registros;
        }

        $wpdb->show_errors(); // Activate wpdb Errors
        return $total_registros;

      default : // Invalid Call
        return 0;
        break;
    }

    // Count records Regular options
    $total_registros = $wpdb->get_var($ft_sql);

    return $total_registros;
}

/**
 * Returns records
 *
 * @param strin $cat - Category
 * @param string $ver
 * @param int   $inicio
 * @param int   $TAMANO_PAGINA
 * @param string $ft_table
 * @return Records
 */
function anticaGetArchivo($cat,$ver,$inicio,$TAMANO_PAGINA, $ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT * FROM {$wpdb->prefix}" . $ft_table;
    $ft_sql_limit = " LIMIT $inicio, $TAMANO_PAGINA";

    switch ($cat ) {
      case "fondos" : 
        $ft_sql .= " WHERE tamanofondo='$ver'" .
            " ORDER BY inventario ASC" .
            $ft_sql_limit;
        break;
      case "autores" :
        $ft_sql .= " WHERE autorslug='$ver'" .
            " ORDER BY inventario ASC" .
            $ft_sql_limit;
        break;
      case "buscar" :
        /**
         * FULL Text - Reconstruction
         *  - Option If full text index is not available
         *  Words need to be tokenized to allow fulltext or Like clauses
         */
        /**
         * Todo: check - 
         * Initial condition
         * functionallity. Tests never got to use  $TAMANO_PAGINA < 0
            if ( $TAMANO_PAGINA > 0 ) {
                $ft_sql .= " WHERE MATCH (completo) AGAINST ('$ver')";
            } else {elseif( $cat=='buscar' and $TAMANO_PAGINA<0 )
                $TAMANO_PAGINA = -$TAMANO_PAGINA;
         *
         */
        $busquedas = explode(" ", $ver);
        $sql_palabras = "";
        $sql_fulltext_palabras = "";
        foreach( $busquedas as $busqueda => $palabra ) {
            if ( empty( $sql_palabras ) ){
                $sql_palabras = " WHERE LOWER (completo) LIKE '%$palabra%'";
                $sql_fulltext_palabras = " WHERE MATCH (completo) AGAINST ('";
            } else {
                $sql_palabras .= " OR LOWER (completo) LIKE '%$palabra%'";
                // Spacer
                $sql_fulltext_palabras .= ' ';
            }
            // Suffix * equivalent to Like %
            $sql_fulltext_palabras .= trim($palabra) .'*';
        }
        if ( empty( $sql_palabras ) ) {
            // No Records
            return null;
        }
        /**
         * Complete the Full Text Expression
         *  FullText Search Try Catch
         *  Could be the possibility that the Index Doesn't Exist. (Installation - Performance)
         */
        $sql_fulltext_palabras .= " ' IN BOOLEAN MODE )"; // Closing Fulltext Clause

        $wpdb->suppress_errors(); // Do not display the SQL error

        $all_resultados = $wpdb->query( $ft_sql . $sql_fulltext_palabras . $ft_sql_limit );
        if ( $all_resultados === FALSE ) {
            // Like Option
            $all_resultados = $wpdb->get_results( $ft_sql . $sql_palabras . $ft_sql_limit );
            // echo '<br> Run Like ';
        } else {
            $all_resultados = $wpdb->get_results($ft_sql . $sql_fulltext_palabras . $ft_sql_limit );
            // echo '<br> Run Ok ';
        }

        $wpdb->show_errors(); // Activate wpdb Errors
        return $all_resultados;
        break;
      default : // Invalid Call
        return null;
        break;
    }

    // Records Found Regular Options
    $all_resultados = $wpdb->get_results($ft_sql);

    return $all_resultados;
}

/**
 * Returns record
 *
 * @param strin $ficha
 * @param string $ft_table
 * @return Record
 */
function anticaGetFicha($ficha, $ft_table = "ft_fichas") {
  global $wpdb;

  $ft_sql = "SELECT * FROM {$wpdb->prefix}" . $ft_table;
  $all_resultados = $wpdb->get_results($ft_sql .
    " WHERE inventario='$ficha'
    LIMIT 1
  ");
  return $all_resultados;
}

function anticaGetIniciales($ft_table = "ft_fichas") {
  global $wpdb;

  $ft_sql = "SELECT *, count(inicial) as iniciales FROM {$wpdb->prefix}" . $ft_table;
  $all_resultados = $wpdb->get_results($ft_sql .
    " GROUP BY inicial ASC");
  return $all_resultados;
}

function anticaGetAutores($inicial, $ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT inicial, autor, autorslug FROM {$wpdb->prefix}" . $ft_table;
  
  if ($inicial!='') {
      $all_resultados = $wpdb->get_results($ft_sql .
        " WHERE inicial='$inicial'
        GROUP BY autor ASC
      ");
  }
  return $all_resultados;
}

function anticaGetAutor($autorslug, $ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT autor, autorslug FROM {$wpdb->prefix}" . $ft_table;
    $all_resultados = $wpdb->get_results($ft_sql . 
    " WHERE autorslug='$autorslug'
    GROUP BY autor ASC
    ");
    foreach ($all_resultados as $resultado) {
        $autor = $resultado->autor;
    }
    return $autor;
}

function anticaGetEstante($ver, $ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT autor, topografica, count(autor) as registros FROM {$wpdb->prefix}". $ft_table;

    $all_resultados = $wpdb->get_results($ft_sql .
        " WHERE LOWER (topografica) LIKE '%$ver'
        GROUP BY autor ASC
    ");
    return $all_resultados;
}

function anticaGetTodo($ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT * FROM {$wpdb->prefix}". $ft_table;

    $all_resultados = $wpdb->get_results($ft_sql .
    " ORDER BY inventario ASC
    ");
    return $all_resultados;
}

function anticaGetHorizontales($ft_table = "ft_fichas") {
  global $wpdb;

    $ft_sql = "SELECT * FROM {$wpdb->prefix}". $ft_table;

    $all_resultados = $wpdb->get_results($ft_sql .
    " WHERE tamanofondo!='Vistas Estereoscópicas'
    ORDER BY inventario ASC
    ");
    return $all_resultados;
}
//WHERE fondo=''
//ORDER BY inventario ASC
//GROUP BY inventario ASC
