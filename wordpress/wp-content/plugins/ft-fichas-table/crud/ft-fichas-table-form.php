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
    * This function renders our custom meta box
    * $item is row
    *
    * @param $item
    */
function ft_fichas_table_form_meta_box_handler($item)
{
    ?>

<table cellspacing="2" cellpadding="5" style="width: 100%;" class="form-table">
    <tbody>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="inventario"><?php _e('Inventario', 'ft_fichas_table')?></label>
        </th>
        <td>
            <input id="inventario" name="inventario" type="text" style="width: 95%" value="<?php echo esc_attr($item['inventario'])?>"
                    size="50" class="code" placeholder="<?php _e('Ingrese el codigo de inventario', 'ft_fichas_table')?>" required>
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="autor"><?php _e('Autor', 'ft_fichas_table')?></label>
        </th>
        <td>
            <input id="autor" name="autor" type="text" style="width: 95%" value="<?php echo esc_attr($item['autor'])?>"
                    size="50" class="code" placeholder="<?php _e('Ingrese el nombre del Autor', 'ft_fichas_table')?>">
        </td>
    </tr>
    <tr class="form-field">
        <th valign="top" scope="row">
            <label for="lugar"><?php _e('Lugar', 'ft_fichas_table')?></label>
        </th>
        <td>
            <input id="lugar" name="lugar" type="text" style="width: 95%" value="<?php echo esc_attr($item['lugar'])?>"
                    size="50" class="code" placeholder="<?php _e('Ingrese el lugar de la imagen visual', 'ft_fichas_table')?>" required>
        </td>
    </tr>
    </tbody>
</table>
<?php
}

/**
    * Simple function that validates data and retrieve bool on success
    * and error message(s) on error
    *
    * @param $item
    * @return bool|string
    */
function ft_fichas_table_validate_ficha($item)
{
    $messages = array();

    if (empty($item['inventario'])) $messages[] = __('Codigo de Inventario es requerido', 'ft_fichas_table');
    if (empty($item['autor'])) $messages[] = __('Nombre de Autor es requerido', 'ft_fichas_table');
    //if(!empty($item['age']) && !absint(intval($item['age'])))  $messages[] = __('Age can not be less than zero');
    //if(!empty($item['age']) && !preg_match('/[0-9]+/', $item['age'])) $messages[] = __('Age must be number');
    //...

    if (empty($messages)) return true;
    return implode('<br />', $messages);
}
