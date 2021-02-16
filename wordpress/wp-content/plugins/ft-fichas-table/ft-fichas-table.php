<?php
/**
 * Plugin Name:     Ft Fichas Table
 * Description:     Example of Fichas Fotograficas
 * Plugin URI:      http://adsmexico.com/
 * Author URI:      http://adsmexico.com/
 * Author:          Ricardo Rodriguez
 * Author URI:      http://mac-blog.org.ua/
 * Author:          Marchenko Alexandr
 * License:         Public Domain
 * Version:         1.2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * FT_FICHAS_TABLE_DB_VERSION - holds current database version
 * and used on plugin update to sync database tables
 * If you develop new version of plugin
 * just increment $ft_fichas_table_db_version variable
 * and add following block of code
 * Modify the version at the begning of the file
 */
// Current version number
if ( !defined( 'FT_FICHAS_TABLE_DB_VERSION' ) )
    define( 'FT_FICHAS_TABLE_DB_VERSION', '1.2' );

/**
    * PART 1. Defining Custom Database Table
    * ============================================================================
    *
    * In this part you are going to define custom database table,
    * create it, update, and fill with some dummy data
    *
    * http://codex.wordpress.org/Creating_Tables_with_Plugins
    *
    * In case your are developing and want to check plugin use:
    *
    * DROP TABLE IF EXISTS wp_cte;
    * DELETE FROM wp_options WHERE option_name = 'ft_fichas_table_install_data';
    *
    * to drop table and option
    */

/**
    */

// global $ft_fichas_table_db_version;
// $ft_fichas_table_db_version = '1.0'; // initial version
// // $ft_fichas_table_db_version = '1.1'; // version changed from 1.0 to 1.1


/**
    * register_activation_hook implementation
    *
    * will be called when user activates plugin first time
    * must create needed database tables
    */
function ft_fichas_table_plugin_activation()
{
    global $wpdb;
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // global $ft_fichas_table_db_version;
	// Installed version number

    $charset_collate = $wpdb->get_charset_collate();

    $table_name = $wpdb->prefix . 'ft_fichas'; // do not forget about tables prefix

    // sql to create your table
    // NOTICE that:
    // 1. each field MUST be in separate line
    // 2. There must be two spaces between PRIMARY KEY and its name
    //    Like this: PRIMARY KEY[space][space](id)
    // otherwise dbDelta will not work
    $sql = "CREATE TABLE " . $table_name . " (
        id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        inicial VARCHAR(20) NOT NULL,
        autor VARCHAR(100) NOT NULL default 'No identificado',
        funcion VARCHAR(100) NOT NULL default 'No aplica',
        titulo  VARCHAR(100) default 'Sin Título',
        fecha  VARCHAR(100) default 'No identificada',
        lugar VARCHAR(100),
        proceso VARCHAR(100),
        tamano VARCHAR(100) default 'No aplica',
        inventario VARCHAR(100) NOT NULL,
        fondo VARCHAR(100),
        subfondo VARCHAR(100),
        serie  VARCHAR(100) default 'No aplica',
        descriptores VARCHAR(100),
        personaje  VARCHAR(100) default 'No aplica',
        topografica  VARCHAR(100) NOT NULL,
        autorslug VARCHAR(100) NOT NULL default '',
        completo VARCHAR(400) default '',
        tamanofondo VARCHAR(100),
        PRIMARY KEY (id),
        FULLTEXT KEY (completo)
    ) $charset_collate;";

    // we do not execute sql directly
    // we are calling dbDelta which cant migrate database
    dbDelta($sql);

    // save current database version for later use (on upgrade)
    // add_option('ft_fichas_table_db_version', $ft_fichas_table_db_version);

    $installed_ver = get_option('ft_fichas_table_db_version', '1.0' );

    update_option( 'ft_fichas_table_db_version', FT_FICHAS_TABLE_DB_VERSION );

    /**
        * Version 1.1
        * Adding Fulltext Search to the 'completo' field
        *   'completo' <=
        */
    // $installed_ver = get_option('ft_fichas_table_db_version');
    // if ( $installed_ver != FT_FICHAS_TABLE_DB_VERSION ) {
    if ( version_compare( $installed_ver , FT_FICHAS_TABLE_DB_VERSION ) < 0 ) {

        $sql = "CREATE TABLE " . $table_name . " (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            inicial VARCHAR(20) NOT NULL,
            autor VARCHAR(100) NOT NULL default 'No identificado',
            funcion VARCHAR(100) NOT NULL default 'No aplica',
            titulo  VARCHAR(100) default 'Sin Título',
            fecha  VARCHAR(100) default 'No identificada',
            lugar VARCHAR(100),
            proceso VARCHAR(100),
            tamano VARCHAR(100) default 'No aplica',
            inventario VARCHAR(100) NOT NULL,
            fondo VARCHAR(100),
            subfondo VARCHAR(100),
            serie  VARCHAR(100) default 'No aplica',
            descriptores VARCHAR(100),
            personaje  VARCHAR(100) default 'No aplica',
            topografica  VARCHAR(100) NOT NULL,
            autorslug VARCHAR(100) NOT NULL default '',
            completo VARCHAR(400) default '',
            tamanofondo VARCHAR(100),
            PRIMARY KEY (id),
            UNIQUE ('inventario'),
            FULLTEXT KEY (completo)
        ) $charset_collate;";

        dbDelta($sql);
    }

    /**
        * Version 1.2
        * Add Extra Fields
        *   http://fotobservatorio.mx/files/nmx-r-069-scfi-2016-3.pdf
        */
    // $installed_ver = get_option('ft_fichas_table_db_version');
    // if ( $installed_ver != FT_FICHAS_TABLE_DB_VERSION ) {
    if ( version_compare( $installed_ver , FT_FICHAS_TABLE_DB_VERSION ) < 0 ) {

        $sql = "CREATE TABLE " . $table_name . " (
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            inicial VARCHAR(20) NOT NULL,
            autor VARCHAR(100) NOT NULL default 'No identificado',
            funcion VARCHAR(100) NOT NULL default 'No aplica',
            titulo  VARCHAR(100) default 'Sin Título',
            fecha  VARCHAR(100) default 'No identificada',
            lugar VARCHAR(100),
            ciudad VARCHAR(100),
            estado VARCHAR(100),
            pais VARCHAR(100),
            proceso VARCHAR(100),
            tamano VARCHAR(100) default 'No aplica',
            inventario VARCHAR(100) NOT NULL,
            fondo VARCHAR(100),
            subfondo VARCHAR(100),
            serie  VARCHAR(100) default 'No aplica',
            descriptores VARCHAR(100),
            personaje  VARCHAR(100) default 'No aplica',
            topografica  VARCHAR(100) NOT NULL,
            autorslug VARCHAR(100) NOT NULL default '',
            completo VARCHAR(400) default '',
            tamanofondo VARCHAR(100),
            PRIMARY KEY (id),
            UNIQUE ('inventario'),
            FULLTEXT KEY (completo)
        ) $charset_collate;";

        dbDelta($sql);
    }

}

/**
    * register_activation_hook implementation
    *
    * [OPTIONAL]
    * additional implementation of register_activation_hook
    * to insert some dummy data In case Table is Empty
    * Test - Only
*/
function ft_fichas_table_install_data()
{
    global $wpdb;

    $table_name = $wpdb->prefix . 'ft_fichas'; // do not forget about tables prefix

    $hasRecords = $wpdb->get_results("SELECT autor FROM " . $table_name . " WHERE `autor` IS NOT NULL");
    if(count($hasRecords) != 0)
    {
        return;
    }

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AM-011',
        'autor' => 'Barney, Juan B.',
        'autorslug' => 'Barney, Juan B.',
        'inicial' => 'B',
        'lugar' => 'Durango',
        'tamanofondo' => 'Daguerrotipos',
    ));

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AM-012',
        'autor' => 'Carney, Juan B.',
        'autorslug' => 'Carney, Juan B.',
        'inicial' => 'C',
        'lugar' => 'Durango Guerrero',
        'tamanofondo' => 'Ambrotipos',
    ));

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AM-013',
        'autor' => 'Carney, Juan B.',
        'autorslug' => 'Carney, Juan B.',
        'inicial' => 'C',
        'lugar' => 'Durango',
        'tamanofondo' => 'Ambrotipos',
    ));

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AAL-001',
        'autor' => 'Carney, Carlos B.',
        'autorslug' => 'Carney, Carlos B.',
        'inicial' => 'C',
        'lugar' => 'Durango',
        'tamanofondo' => 'Ambrotipos',
    ));

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AAL-002',
        'autor' => 'Darney, Juan B.',
        'autorslug' => 'Darney, Juan B.',
        'inicial' => 'D',
        'lugar' => 'Durango Guerrero',
        'tamanofondo' => 'Ambrotipos',
    ));

    $wpdb->replace($table_name, array(
        'inventario' => 'CDV-AAL-003',
        'autor' => 'Carney, Juan B.',
        'autorslug' => 'Carney, Juan B.',
        'inicial' => 'C',
        'lugar' => 'Durango',
        'tamanofondo' => 'Ambrotipos',
    ));
}

register_activation_hook(__FILE__, 'ft_fichas_table_plugin_activation');
register_activation_hook(__FILE__, 'ft_fichas_table_install_data');

/**
 * Checking Plugin Version
*/
function ft_fichas_table_check_version()
{
    // global $ft_fichas_table_db_version;
    // if ( get_site_option('ft_fichas_table_db_version') != $ft_fichas_table_db_version ) {
    //    ft_fichas_table_install();
    // }
    if ( FT_FICHAS_TABLE_DB_VERSION != get_option('ft_fichas_table_db_version') ) {
        ft_fichas_table_plugin_activation();
    } 
}
add_action('plugins_loaded', 'ft_fichas_table_check_version');

// Deactivation
function ft_fichas_table_deactivation() {
    // moved to uninstall.php
	// delete_option('ft_fichas_table_db_version');
}
register_deactivation_hook(__FILE__, 'ft_fichas_table_deactivation');

/**
    * PART 2. Admin page
    * ============================================================================
    *
    * In this part you are going to add admin page for custom table
    *
    * http://codex.wordpress.org/Administration_Menus
    */

/**
    * admin_menu hook implementation, will add pages to list fichas and to add new one
    */
function ft_fichas_table_admin_menu()
{
    add_menu_page(__('Fichas', 'ft_fichas_table'), __('Fichas', 'ft_fichas_table'), 'activate_plugins', 'fichas', 'ft_fichas_table_page_handler');
    add_submenu_page('fichas', __('Fichas', 'ft_fichas_table'), __('Fichas', 'ft_fichas_table'), 'activate_plugins', 'fichas', 'ft_fichas_table_page_handler');
    // add new will be described in next part
    add_submenu_page('fichas', __('Add new', 'ft_fichas_table'), __('Add new', 'ft_fichas_table'), 'activate_plugins', 'fichas_form', 'ft_fichas_table_form_page_handler');
}

add_action('admin_menu', 'ft_fichas_table_admin_menu');

/**
    * PART 3. Defining Custom Table CRUD
    * ============================================================================
    *
    * In this part you are going to define custom table list class,
    * that will display your database records in nice looking table
    *
    * http://codex.wordpress.org/Class_Reference/WP_List_Table
    * http://wordpress.org/extend/plugins/custom-list-table-example/
    */

require_once( plugin_dir_path(__FILE__) . 'crud/ft-fichas-table-crud.php');

/**
    * Do not forget about translating your plugin, use __('english string', 'your_uniq_plugin_name') to retrieve translated string
    * and _e('english string', 'your_uniq_plugin_name') to echo it
    * in this example plugin your_uniq_plugin_name == custom_table_example
    *
    * to create translation file, use poedit FileNew catalog...
    * Fill name of project, add "." to path (ENSURE that it was added - must be in list)
    * and on last tab add "__" and "_e"
    *
    * Name your file like this: [my_plugin]-[ru_RU].po
    *
    * http://codex.wordpress.org/Writing_a_Plugin#Internationalizing_Your_Plugin
    * http://codex.wordpress.org/I18n_for_WordPress_Developers
    */
function ft_fichas_table_languages()
{
    load_plugin_textdomain('ft_fichas_table', false, dirname(plugin_basename(__FILE__)));
}

add_action('init', 'ft_fichas_table_languages');
