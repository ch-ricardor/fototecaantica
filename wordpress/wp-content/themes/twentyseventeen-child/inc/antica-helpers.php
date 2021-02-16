<?php
/**
 * Custom helper functions for this theme.
 *
 * @package  Functions
 * @category Core
 * @author   Ricardo
 * @since    1.0.0
 */

/**
 * Return the size to use for featured images.
 *
 * @since  1.0.0
 *
 * @return string Returns the feature image size.
 */
function antica_get_featured_image_size() {

    /**
     * Filter the size to use for featured images.
     *
     * @var string
     */
    return (string) apply_filters( 'antica_featured_image_size', 'antica-featured' );

}


/*------------------------------------*\
	Functions - NMX-r-069-scfi-2016-3
\*------------------------------------*/
/**
 * Returns Image - Title 
 *
 * @package Antica
 * @param array $fichaRecord
 * @return string
 */
function anticaNmxTituloImage($fichaRecord) {
    $imgText = '';
    if ( ($imgText = ( strtolower($fichaRecord->titulo) == 'sin título' ? '' : $fichaRecord->titulo) ) == '' ) {
        if ( ($imgText = ( strtolower($fichaRecord->personaje) == 'no aplica' ? '' : $fichaRecord->personaje) ) == '' ) {
            if ( ($imgText = ( strtolower($fichaRecord->autor) == 'no identificado' ? '' : $fichaRecord->autor) ) == '' ) {
                if ( ($imgText = ( strtolower($fichaRecord->fecha) == 'no identificada' ? '' : $fichaRecord->fecha) ) == '' ) {
                    $imgText = $fichaRecord->inventario;
                }
            }
        }
    }

    return $imgText;
}

?>
