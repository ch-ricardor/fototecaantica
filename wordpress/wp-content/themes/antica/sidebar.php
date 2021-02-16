<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Antica_Store
 * @since 1.0
 * @version 1.0
 */

if ( ! is_active_sidebar( 'sidebar-antica' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'antica' ); ?>">
    <?php dynamic_sidebar( 'sidebar-antica' ); ?>
</aside><!-- #secondary .widget-area -->
