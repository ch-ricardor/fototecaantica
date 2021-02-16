<?php
/*
 *  Author: Ricardo | @ricardo
 *  URL: fototecaantica.net | @fototecaantica
 *  Custom functions
 */

// Load antica styles
add_action('wp_enqueue_scripts', 'antica_styles'); // Add Theme Stylesheet


/**
 * The Parent loads the styles with get_stylesheet
 * Needs to load BOTH styles
 *
 **/
add_action( 'wp_enqueue_scripts', 'antica_theme_enqueue_styles' );
function antica_theme_enqueue_styles() {
    $parenthandle = 'twentyseventeen-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
	$childhandle = 'antica-style'; 				 // This is 'antica-style' for the Antica theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( $childhandle, get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version'), // this only works if you have Version in the style header
		'screen'
    );
    wp_enqueue_style( 'antica-responsive-style', get_stylesheet_directory_uri() . '/css/responsive.css',
        array($childhandle),
        $theme->get('Version'), // this only works if you have Version in the style header
		'screen'
    );
}

/**
 * The Parent loads the styles with get_template_directory
 * Needs to load ONLY Child styles
 *
 **/
/*
add_action( 'wp_enqueue_scripts', 'antica_theme_enqueue_styles' );
function antica_theme_enqueue_styles() {
    $parenthandle = 'twentyseventeen-style'; // This is 'twentyseventeen-style' for the Twenty Fifteen theme.
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}
*/

/**
 *  Load antica styles
 * NOTE: These should be enqueued BEFORE the style.css
 * 	It loads 3rd party libraries css
 *
 */
function antica_styles()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    // Theme Styles
    // Conditional Styles
    if ( is_home() || is_page( ['intro'] ) ) {
        wp_register_style('anticaintro', get_stylesheet_directory_uri() . '/css/antica_intro.css', array(), $theme_version, 'screen');
        wp_enqueue_style('anticaintro'); // Enqueue it!
    } else {
        // All Pages
        // Todo: Validate against Template Used
        wp_register_style('nivoslider', get_stylesheet_directory_uri() . '/css/lib/nivo-slider.css', array(), '1.3', 'screen');
        wp_enqueue_style('nivoslider'); // Enqueue it!

        wp_register_style('nivosliderdefault', get_stylesheet_directory_uri() . '/css/lib/nivo-default.css', array(), '1.3', 'screen');
        wp_enqueue_style('nivosliderdefault'); // Enqueue it!
    }

}


/**
 * Load antica conditional scripts
 */
add_action('wp_print_scripts', 'antica_conditional_scripts'); // Add Conditional Page Scripts
function antica_conditional_scripts()
{
    $theme_version = wp_get_theme()->get( 'Version' );

    // Conditional script(s)
    if ( is_home() || is_page( ['intro'] ) ) {
        wp_register_script('anticaintro', get_stylesheet_directory_uri() . '/js/antica_intro.js', array('jquery'), $theme_version, false );
        wp_enqueue_script('anticaintro'); // Enqueue it!
    } else {
        // All Pages
        wp_register_script('anticascripts', get_stylesheet_directory_uri() . '/js/antica_scripts.js', array('jquery'), $theme_version, false );
        wp_enqueue_script('anticascripts'); // Enqueue it!

        wp_register_script('nivoslider', get_stylesheet_directory_uri() . '/js/lib/jquery.nivo.slider.js', array('jquery'), '1.3', false );
        wp_enqueue_script('nivoslider'); // Enqueue it!
    }

    // Example of specific Pages
    if ( is_page(['servicios','mision']) ) {
    }

}


/*------------------------------------*\
	Functions - SQL
\*------------------------------------*/

// require_once get_parent_theme_file_path( '/inc/antica-sql-functions.php' );
// require_once get_template_directory( '/inc/antica-sql-functions.php' ); // parent theme
require_once get_stylesheet_directory() . '/inc/antica-sql-functions.php'; // child theme


/*------------------------------------*\
	Functions - Helpers
\*------------------------------------*/

require_once get_stylesheet_directory() . '/inc/antica-helpers.php';


/**
 * EDD - Antica Adaptations
 *
 */
 
// Change the number of Posts to display
function antica_pages_EDDindex( $query ) {
    // get the global query var object
    global $wp_query;

    //  echo print_r($query);
    // echo '<br>' . get_post_type();
    if ( ! is_admin() && class_exists('EDD_Download') ) {
        if ( $query->is_main_query() ) {

            // Display Multiple EDD Images
            if ( $query->is_archive() ) {
                if ( $query->is_tax('download_tag') ||  $query->is_tax('download_category') ) {
                    $query->set( 'posts_per_page', 12 );
                    $query->set( 'orderby', 'title' );
                    $query->set( 'order', 'ASC' );
                }
            }
        }

    }
}


add_filter( 'next_post_link', 'antica_next_prev_post_link',10,6); // Add GET arg to return to caller
add_filter( 'previous_post_link', 'antica_next_prev_post_link',10,6); // Add GET arg to return to caller

function antica_next_prev_post_link ($output, $format, $link, $post, $adjacent) {
    $previous = $adjacent;

    // Only applies changes if EDDis active
    if ( ! class_exists('EDD_Download') ) {
        return $output;
    }
    if ( ! is_single() || ! get_post_type() == "download" ) {
        return $output;
    }

    /**
     * Saving the initial Referrer
     *  To allow scroll the posts and
     *  return to the original caller
     *  Option 2 - onclick="history.back()" Easier
     *  The page should verify $_GET['back_refr']
     */

    $url_back_refr = '';
    // If GET is set the same Template
    if ( isset( $_GET['back_refr'] ) ) {
        $url_back_refr = $_GET['back_refr'];
        // echo '<br>Original: ' . $url_back_refr;

    } else {
        if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
            // $back_pth = parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_PATH );
            // $back_qry = parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_QUERY );
            // echo '<br>Initial: ' . $back_qry;
            // $url_back_refr = add_query_arg( 'back_refr' , base64_encode ( $back_pth . $back_qry ) );
            // $url_back_refr = base64_encode ( $back_pth . $back_qry );
            $url_back_refr = base64_encode ( $_SERVER['HTTP_REFERER'] );
            // echo '<br>Aditional: ' . $url_back_refr ;
        }
    }

    // echo '<br>encoded: ' . $url_back_refr . '<----';
    // echo '<br>decoded: ' . base64_decode($url_back_refr) . '<----';
    /**
     * https://developer.wordpress.org/reference/functions/get_adjacent_post_link/
     */
    if ( ! $post ) {
        $output = '';
    } else {
        $title = $post->post_title;

        if ( empty( $post->post_title ) ) {
            $title = $previous ? __( 'Previous Post' ) : __( 'Next Post' );
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $title, $post->ID );

        $date = mysql2date( get_option( 'date_format' ), $post->post_date );
        $rel  = $previous ? 'prev' : 'next';

        $string = '<a href="';
        $string .= get_permalink( $post ) ;
        $string .= '?back_refr=' . $url_back_refr;
        $string .= '" rel="' . $rel . '">';
        $inlink = str_replace( '%title', $title, $link );
        $inlink = str_replace( '%date', $date, $inlink );
        $inlink = $string . $inlink . '</a>';

        $output = str_replace( '%link', $inlink, $format );
    }

    return $output;
}

