<?php
/**
 * Description:     Fichas Fotograficas List
 * Plugin URI:      http://adsmexico.com/
 * Author URI:      http://adsmexico.com/
 * Author:          Ricardo Rodriguez
 * License:         Public Domain
 * Version:         1.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

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
function ft_fichas_table_page_handler()
{
    global $wpdb;

    $table = new Ft_Fichas_Table_List_Table();
    $table->prepare_items();

    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'ft_fichas_table'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
<div class="wrap">

    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Fichas', 'ft_fichas_table')?>
        <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=fichas_form');?>">
            <?php _e('Add new', 'ft_fichas_table')?></a>
    </h2>
    <?php echo $message; ?>

    <form id="persons-table" method="GET">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
        <?php $table->display() ?>
    </form>

</div>
<?php
}
