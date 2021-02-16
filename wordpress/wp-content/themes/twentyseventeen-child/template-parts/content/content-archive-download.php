<?php
/**
 * download archive template
 *
 * @package Vendd
 */

// todo: Chango to button on.click="back.history()"
$url_back_refr = wp_get_referer();

// if download taxonomy archive, output information about the term
if ( is_tax( 'download_category' ) || is_tax( 'download_tag' ) ) {
    $download_term = $wp_query->get_queried_object();

    // change the download archive page title based on the taxonomy
    if ( 'download_category' === $download_term->taxonomy ) {
        $term_type = _x( 'Categoría', 'download category archive page title', 'antica' ) . ': ';
    } elseif ( 'download_tag' === $download_term->taxonomy ) {
        $term_type = _x( 'Tag', 'download tag archive page title', 'antica' ) . ': ';
    }
    ?>

    <?php
    if ( ! empty( $term_type ) ) {
    ?>
        <div class="download-term-header">
            <div id="header2" class="single-download">
                <div class="container">

                    <h2><?php echo $term_type ?></h2>

                    <h1 class="term-title">
                        <span class="term-title-primary"><strong><?php echo $download_term->name; ?></strong>
                        <?php
                        if ( ! empty( $download_term->description ) ) {
                        ?>
                            <p class="term-subtitle"><?php echo $download_term->description; ?></p>
                        <?php
                        } ?>
                    </h1>

                    <div class="header2-col-left">
                    </div><!-- .header2-col-left -->

            </div><!-- #header2.single-download -->

        </div><!-- .download-term-header -->
    <?php
    }
}

if ( have_posts() ) :
    ?>
    <div id="store-front">
        <div class="edd_downloads_list edd_download_columns_4">

            <?php
            while ( have_posts() ) : the_post();?>
                <div itemscope itemtype="http://schema.org/Product" class="edd_download" id="edd_download_<?php echo get_the_ID(); ?>">
                    <div class="edd_download_inner">
                    <?php
                        /**
                         * These are the same template files used by the [downloads] shortcode.
                         * So making adjustments to those template files will affect this archive
                         * as well as the [downloads] shortcode.
                         *
                         * To make adjustments specifically to archive template download output,
                         * grab the contents of the relevant template file and put it in place of the
                         * appropriate call below that way your changes are focused here and not the
                         * [downloads] shortcode... unless that's what you want.
                         */

                        // Image is not loadded on the initial stage of the project to the EDD Object
                        // edd_get_template_part( 'shortcode', 'content-image' );
                        // Find the image in ft_ficha
                        // RRE 2020 Get the Ficha Record - TODO: Create the proper template
                        $antica_fichas = anticaGetFicha(get_the_title());
                        $antica_ficha = $antica_fichas[0];
                        $inventario = $antica_ficha->inventario;

                        if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( get_the_ID() ) ) { ?>
                            <div class="edd_download_image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
                                </a>
                            </div>
                        <?php
                        } else {
                            /**
                             *  RRE 2020 Test if the Fotography file exists
                            */
                            $url = get_stylesheet_directory_uri() . '/images/' . 'pendiente.jpg';

                            if ( file_exists( ABSPATH.'/miniaturas/'. $inventario .'.jpg' ) ) {
                                $url = get_option('home','').'/miniaturas/'. $inventario .'.jpg';
                            }
                        ?>

                            <div class="edd_download_image">
                                <a href="<?php the_permalink(); ?>">
                                <img width="96" height="96" src="<?php echo $url;?>" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
                                </a>
                            </div>
                        <?php
                        } // endif

                            edd_get_template_part( 'shortcode', 'content-title' );
                            edd_get_template_part( 'shortcode', 'content-excerpt' );
                            // edd_get_template_part( 'shortcode', 'content-price' );
                            // edd_get_template_part( 'shortcode', 'content-cart-button' );
                    ?>
                    </div>
                </div>
            <?php
            endwhile; ?>

        </div>

        <?php 
        if ( $wp_query->max_num_pages > 1 ) : ?>
            <div id="edd_download_pagination" class="store-pagination navigation">
                <?php
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, get_query_var( 'paged' ) ),
                        'total'     => $wp_query->max_num_pages,
                        'prev_text' => __( '&laquo; Previous', 'vendd' ),
                        'next_text' => __( 'Next  &raquo;', 'vendd' ),
                    ) );
                ?>
            </div><!-- #edd_download_pagination -->
        <?php 
        endif; ?>

    </div><!-- #store-front -->
    <?php
else :
    ?>
    <section class="store-404 not-found">
        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Oops! There\'s nothing to see here.', 'vendd' ); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'antica' ); ?></p>

            <?php get_search_form(); ?>

            <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

            <?php if ( twentyseventeen_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
            <div class="widget widget_categories">
                <h2 class="widget-title"><?php _e( 'Most Used Categories', 'vendd' ); ?></h2>
                <ul>
                <?php
                    wp_list_categories( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'show_count' => 1,
                        'title_li'   => '',
                        'number'     => 10,
                    ) );
                ?>
                </ul>
            </div><!-- .widget -->
            <?php endif; ?>

        </div><!-- .page-content -->
    </section><!-- .store-404 -->
    <?php
endif;
