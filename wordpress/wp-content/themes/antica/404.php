<?php get_header(); ?>

<div id="content">
    <div class="wrap">

        <div id="textos">

                <section class="error-404 not-found">
                    <div class="page-content">
                        <h1 class="page-title"><?php _e( 'Página no encontrada.', 'antica' ); ?></h1>
                        <p><?php _e( 'No se encontró lo solicitao. Posiblemente en Buscar?', 'antica' ); ?></p>

                        <?php // get_search_form(); ?>

                    </div><!-- .page-content -->
                </section><!-- .error-404 -->
        </div><!-- #textos -->

    </div> <!-- .wrap -->
</div> <!-- #content -->

<?php get_footer();
