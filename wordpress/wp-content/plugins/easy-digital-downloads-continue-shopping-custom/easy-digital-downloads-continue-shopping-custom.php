<?php
/*
 * Plugin Name: Easy Digital Downloads - Continue Shopping Button
 * Description: Adds a "Continue Shopping" button to the left of the Update/Save Cart buttons on checkout.
 * Author: Chris Klosowski
 * Author URI: https://easydigitaldownloads.com/
 * Version: 1.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

function antica_edd_continue_shopping_button() {

    // Easier way to do it. - not the best one
    if ( wp_get_referer() == edd_get_checkout_uri() ) {
        $antica_prev_uri = esc_url( get_permalink( get_page_by_title( 'catalogo' ) ) );
    } else {
        $antica_prev_uri = wp_get_referer();
    }

    $color = edd_get_option( 'checkout_color', 'green' );
    $color = ( $color == 'inherit' ) ? '' : $color;

?>
    <a href="<?php echo $antica_prev_uri; ?>"><div class="edd-submit button<?php echo ' ' . $color; ?>">
    <?php _e( 'Continue Shopping', 'edd' ); ?></div></a>

<?php

}
// add_action( 'edd_before_checkout_cart', 'antica_edd_continue_shopping_button' );
// add_action( 'edd_after_checkout_cart', 'antica_edd_continue_shopping_button' );
// add_action( 'edd_checkout_form_top', 'antica_edd_continue_shopping_button', 1 );
// add_action( 'edd_checkout_form_bottom', 'antica_edd_continue_shopping_button', 1 );
// add_action( 'edd_cart_footer_buttons', 'antica_edd_continue_shopping_button', 1 );
// add_action( 'edd_checkout_cart_top', 'antica_edd_continue_shopping_button', 1 );
add_action( 'edd_checkout_cart_bottom', 'antica_edd_continue_shopping_button', 1 );


/*
 * Add if the cart is empty
 * It will allow to return to the previous Page
 */
function antica_edd_custom_empty_cart_message($message) {
    $color = edd_get_option( 'checkout_color', 'green' );
    $color = ( $color == 'inherit' ) ? '' : $color;

    if ( wp_get_referer() == edd_get_checkout_uri() ) {
        $antica_prev_uri = esc_url( get_permalink( get_page_by_title( 'catalogo' ) ) );
    } else {
        $antica_prev_uri = wp_get_referer();
    }

    $antica_section = '';
    $antica_section = $antica_section . '<a href="' . $antica_prev_uri . '">' .
        '<div class="edd-submit button">' . __($message, 'edd') . ' ' . __('Continue Shopping', 'edd') .
        '</div>' . '</a>';

    return $antica_section;
}
add_filter( 'edd_empty_cart_message', 'antica_edd_custom_empty_cart_message' );




// Add The dashicons fonts
function antica_load_dashicons() {
    wp_enqueue_style( 'dashicons' );    
}
add_action('wp_enqueue_scripts','antica_load_dashicons');

