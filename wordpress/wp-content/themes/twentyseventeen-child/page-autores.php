<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
	// RRE 2020
	$cat = isset($_GET['cat']) ? $_GET['cat'] : '';
	$ver = isset($_GET['ver']) ? $_GET['ver'] : '';
	$ini = isset($_GET['ini']) ? $_GET['ini'] : ''; //inicial

	if ($cat=='procesos') $categoria = "Proceso fotográfico";
	if ($cat=='fondos') $categoria = "Fondo";
	if ($cat=='autores') $categoria = "Autores";

?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	<div id="header2">
		<div class="container">
			<h2>Autores</h2>
			<h1><?php if ($ini=='') { echo '&nbsp;'; } else echo $ini; ?></h1>

            	<div class="header2-col-left">
                	<a href="<?php echo get_option('home',''). "/catalogo/"; ?>/" class="button-back"><?php echo __('Menú anterior','antica'); ?></a>
            	</div><!-- .header2-col-left -->

        	<div class="container">
        	</div><!-- .container -->

		</div><!-- .container -->
	</div><!-- #header2 -->

    <div class="container">

        <div class="iniciales">
            <ul>
            <?php
                $all_resultado = anticaGetIniciales();
                $i=1;
                foreach ($all_resultado as $resultado) {
                    $inicial = $resultado->inicial;
                ?>

                <li><a href="<?php echo get_option('home',''); ?>/autores/?page=ft/fichas.php&cat=autores&ini=<?php echo $inicial; ?>"><?php echo $inicial; ?></a></li>

            <?php } ?>
            </ul>
        </div><!-- #iniciales -->

    <div style="clear:both;"></div>

    <div class="autores">
        <ul>
        <?php
            if ($ini!='') {
            $all_resultado = anticaGetAutores($ini);
            $i=1;
            foreach ($all_resultado as $resultado) {
            ?>

          <?php $autor = $resultado->autor; $autorslug = $resultado->autorslug; ?>
          <li><a href="<?php echo get_option('home',''); ?>/archivo/?page=ft/fichas.php&cat=<?php echo $cat; ?>&ver=<?php echo $autorslug; ?>&ficha=<?php echo $autorslug; ?>"><?php echo $autor; ?></a></li>

        <?php } } ?>
        </ul>

        <?php
		if ( $ini == '' ) {
        	while (have_posts()) :
			the_post();
		?>
            <div class="container">
                <div class="autorestexto"><?php the_content();?></div>
            </div>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

        endwhile;
        }
		?>

    </div><!-- #autores -->

    <div style="clear:both;"></div>

    </div> <!-- .container -->


		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php
get_footer();
