<?php
/**
 * Description:     Fichas Fotograficas CRUD
 * Plugin URI:      http://adsmexico.com/
 * Author URI:      http://adsmexico.com/
 * Author:          Ricardo Rodriguez
 * License:         Public Domain
 * Version:         1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
    * Table Object based on WP_List_Table
    * ============================================================================
    *
    * In this part you are going to define custom table list class,
    * that will display your database records in nice looking table
    *
    * http://codex.wordpress.org/Class_Reference/WP_List_Table
    * http://wordpress.org/extend/plugins/custom-list-table-example/
    */
    
require_once( plugin_dir_path(__FILE__) . '/ft-fichas-table-record.php');

/**
    * List page handler
    *
    * This function renders our custom table
    * Notice how we display message about successfull deletion
    * Actualy this is very easy, and you can add as many features
    * as you want.
    *
    * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
    */

require_once( plugin_dir_path(__FILE__) . '/ft-fichas-table-record-list.php');


/**
    * Form for adding and or editing row
    * ============================================================================
    *
    * In this part you are going to add admin page for adding and or editing items
    * You cant put all form into this function, but in this example form will
    * be placed into meta box, and if you want you can split your form into
    * as many meta boxes as you want
    *
    * http://codex.wordpress.org/Data_Validation
    * http://codex.wordpress.org/Function_Reference/selected
    */

require_once( plugin_dir_path(__FILE__) . '/ft-fichas-table-form.php');
require_once( plugin_dir_path(__FILE__) . '/ft-fichas-table-record-update.php');
