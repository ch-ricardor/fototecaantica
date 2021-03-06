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
    * Form page handler checks is there some data posted and tries to save it
    * Also it renders basic wrapper in which we are callin meta box render
    */
function ft_fichas_table_form_page_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'ft_fichas'; // do not forget about tables prefix

    $message = '';
    $notice = '';

    // this is default $item which will be used for new records
    $default = array(
        'inventario' => '',
        'autor' => '',
        'lugar' => '',
    );

    // here we are verifying does this request is post back and have correct nonce
    if ( wp_verify_nonce($_REQUEST['nonce'], basename(__FILE__)) ) {
        // combine our default item with request params
        $item = shortcode_atts($default, $_REQUEST);
        // validate data, and if all ok save item to database
        // if id is zero insert otherwise update
        
        $item_valid = ft_fichas_table_validate_ficha($item);
        
        if ($item_valid === true) {
            if ($item['id'] == 0) {
                $result = $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
                if ($result) {
                    $message = __('Item was successfully saved', 'ft_fichas_table');
                } else {
                    $notice = __('There was an error while saving item', 'ft_fichas_table');
                }
            } else {
                $result = $wpdb->update($table_name, $item, array('id' => $item['id']));
                if ($result) {
                    $message = __('Item was successfully updated', 'ft_fichas_table');
                } else {
                    $notice = __('There was an error while updating item', 'ft_fichas_table');
                }
            }
        } else {
            // if $item_valid not true it contains error message(s)
            $notice = $item_valid;
        }
    }
    else {
        // if this is not post back we load item to edit or give new one to create
        $item = $default;
        if (isset($_REQUEST['id'])) {
            $item = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $_REQUEST['id']), ARRAY_A);
            if (!$item) {
                $item = $default;
                $notice = __('Ficha no encontrada', 'ft_fichas_table');
            }
        }
    }

    // here we adding our custom meta box
    add_meta_box('fichas_form_meta_box', // id
        __('data Ficha Fotográfica'), // title 
        'ft_fichas_table_form_meta_box_handler', // Callback fills the content
        'ficha', // Screen
        'normal', // context
        'default' // priority
        );

    ?>
<div class="wrap">
    <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
    <h2><?php _e('Ficha', 'ft_fichas_table')?>
        <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=fichas');?>"><?php _e('regresar a la lista', 'ft_fichas_table')?></a>
    </h2>

    <?php if (!empty($notice)): ?>
    <div id="notice" class="error"><p><?php echo $notice ?></p></div>
    <?php endif;?>
    <?php if (!empty($message)): ?>
    <div id="message" class="updated"><p><?php echo $message ?></p></div>
    <?php endif;?>

    <form id="form" method="POST">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(basename(__FILE__))?>"/>
        <?php /* NOTICE: here we storing id to determine will be item added or updated */ ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>"/>

        <div class="metabox-holder" id="poststuff">
            <div id="post-body">
                <div id="post-body-content">
                    <?php /* And here we call our custom meta box */ ?>
                    <?php do_meta_boxes('ficha', 'normal', $item); ?>
                    <input type="submit" value="<?php _e('Save', 'ft_fichas_table')?>" id="submit" class="button-primary" name="submit">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
}
