<?php
/*
Description: Example of Fichas Fotograficas
Plugin URI: http://adsmexico.com/
Author URI: http://adsmexico.com/
Author: Ricardo Rodriguez
License: Public Domain
Version: 1.0
*/

// if uninstall.php is not called by WordPress, die
defined( 'ABSPATH' ) or die( 'No script !' );

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$option_name = 'ft_fichas_table_db_version';
 
delete_option($option_name);
 
// for site options in Multisite
delete_site_option($option_name);
 
// drop a custom database table
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}ft_fichas");


