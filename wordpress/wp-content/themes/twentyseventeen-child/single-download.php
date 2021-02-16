<?php
/*
    Template Name: Single Download
    Easy Digital Downloads - Antica Product view
*/
get_header();

   /**
     * Saving the initial Referrer
     *  To allow scroll the posts and
     *  return to the original caller
     *  Option 2 - onclick="history.back()"
     *
     */
    $url_back_refr = get_option('home',''). '/';
    // If GET is set the same Template
    if ( isset( $_GET['back_refr'] ) ) {
        $url_back_refr = $_GET['back_refr'];
        $url_back_refr = base64_decode($url_back_refr);

    } else {
        if ( wp_get_referer() ) {
            $url_back_refr = wp_get_referer();
        }
    }

    while (have_posts()) :
        the_post();

        // Load the EDD Object
        $anticaProduct = edd_get_download(get_the_ID());

        // Title in EDD Downloads SHOULD NOT BE MODIFIED is the Link to ft_ficha
        $inventario = trim($anticaProduct->post_title);

        $url = get_stylesheet_directory_uri() . '/images/' . 'pendiente.jpg';
        $url2 = '';

        $title_img = '';
        /**
         * RRE 2020 Get the Ficha Record - TODO: Create the proper template
         * Feature Image is not loadded on the initial stage of the project to the EDD Object
         * edd_get_template_part( 'shortcode', 'content-image' );
         *
         * Find the image in ft_ficha
         */
        $antica_fichas = anticaGetFicha($inventario, "ft_fichas"); // EDD Link to the Ficha Table
        if (!empty($antica_fichas)) {
            $antica_ficha = $antica_fichas[0]; // Array
            // Principal
            if ( file_exists( ABSPATH.'/miniaturas/'. $anticaProduct->post_title .'.jpg' ) ) {
                $url = get_option('home','').'/miniaturas/'. $anticaProduct->post_title .'.jpg';
            }
            // Reverso
            if ( file_exists( ABSPATH.'/miniaturas-r/'. $anticaProduct->post_title . '-r.jpg' ) ) {
                $url2 = get_option('home','').'/miniaturas-r/'. $anticaProduct->post_title . '-r.jpg';
            }
            // Link to the Ficha
            $cat = 'autores';
            $ver = $antica_ficha->autorslug;
            // Title Construction Titulo -> Personaje -> Autor -> Proceso
            $title_img = anticaNmxTituloImage($antica_ficha);
        } else {
            $cat = '';
            $ver = '';
        }

        // get_template_part( 'template-parts/post/content', get_post_format() );

        ?>
        <div id="header2" class="single-download">
            <div class="container">
                <h2><?php echo $anticaProduct->post_title; ?></h2>

                <div class="header2-col-left" style="width:70%;">
                <?php
                    $prev_html = '<span class="dashicons dashicons-arrow-left-alt2"> </span>' . __( 'Siguiente: %title' );
                    $next_html =  __( 'Previa: %title', 'antica' ) .
                        '<span class="dashicons dashicons-arrow-right-alt2"></span>';

                    the_post_navigation(
                        array(
                            'prev_text' => $prev_html,
                            'next_text' => $next_html,
                            'taxonomy'  => 'download_category',
                            'screen_reader_text' => __( $title_img, 'antica' ),
                        )
                    );
                ?>
                    <div class="button-back">
                        <a href="<?php
                            echo $url_back_refr;?>"><?php echo __('Regresar','antica');?>
                        </a>
                    </div><!-- .button-back -->

                </div><!-- .header2-col-left -->

            </div><!-- .container -->

        </div><!-- #header2.single-download -->

    <div id="primary">
        <div class="container">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="product-image">

                    <div class="slider-wrapper theme-default column-slider" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
                        <div id="slider" class="nivoSlider">
                            <img src="<?php echo $url; ?>" title="<?php echo $title_img ?>">
                            <?php
                            // Reverso
                            if ( !empty( $url2 ) ) {
                                echo '<img src="' . $url2 . '" title="'. $title_img .'">';
                            }
                            // Thumbnail if exists
                            $url_thumb = get_the_post_thumbnail_url();
                            if ( !empty( $url_thumb ) ) {
                                echo '<img src="' . $url_thumb . '" title="'. $title_img .'">';
                            }
                            ?>
                        </div><!-- #slider .nivoSlider -->
                    </div> <!-- #slider-wrapper -->

                </div><!-- .product-image -->

                <div class="edd-column-page">
                    <?php
                    // uri Ficha
                    $uri_ficha = get_option('home','');
                    if ( !empty( $cat ) ) {
                        $uri_ficha .= '/ficha/?page=ft/fichas.php&cat=' . $cat. '&ver=' . $ver. '&ficha=' . $inventario;
                    } else {
                        $uri_ficha .= '/catalogo/';
                    }
                    ?>
                    <h2><?php echo __('Ficha','antica');?>: <a href="<?php echo $uri_ficha; ?>"><?php echo $inventario; ?></a></h2>

                <?php
                // echo get_post_format();

                    the_content(
                        sprintf(
                            /* translators: %s: Post title. */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'antica' ),
                            get_the_title()
                        )
                    );

                    wp_link_pages(
                        array(
                            'before'      => '<div class="page-links">' . __( 'Páginas:', 'antica' ),
                            'after'       => '</div>',
                            'link_before' => '<span class="page-number">',
                            'link_after'  => '</span>',
                        )
                    );

                ?>

                </div><!-- .container .textos -->

            </article><!-- #post-<?php the_ID(); ?> -->

        </div><!--.container -->
    </div><!-- #primary -->

    <?php
    endwhile; // end of the loop

    get_sidebar();
    ?>

<?php get_footer();
