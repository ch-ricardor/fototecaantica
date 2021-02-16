<?php 
/**
 *  Page Intro
 * @package Antica
*/

get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

	<div class="antica-intro">
    <!-- RRE 2020 Todo: Audio Not playing in Chrome -->
    <embed src="<?php echo get_stylesheet_directory_uri() . '/media/sonido45.ogg'; ?>" hidden="true" loop="true" type="audio/ogg">

    <div id="fondo"></div>

    <div id="titulo"></div>
    <div id="logo"></div>
    <div id="epigrafe"></div>
    <div id="rojo"></div>
    <div id="cuadro"></div>
    <div id="circulo"></div>
    <div id="punto"></div>
    <div id="vertical"></div>
    <div id="horizontal"></div>

    <div id="fotoa"></div>
    <div id="fotob"></div>
    <div id="fotoc"></div>
    <div id="fotod"></div>
    <div id="fotoe"></div>
    <div id="fotof"></div>

    <div id="fotohome"></div>

    <div><a id="saltar" href="<?php echo get_option('home',''); ?>/portada/"></a></div>

    <!-- RRE 2020 Scripts moved to functions -->

    <script type="text/javascript">
        // RRE 2020 Animation moved to js/antica_intro.js - Loaded conditionally
        function redireccionarPagina() {
            // RRE - 2020 get_settings
            window.location = "<?php echo get_option('home',''); ?>/portada/";
        }
        setTimeout("redireccionarPagina()", 44800);
    </script>

	</div><!-- antica-intro -->
	</main><!-- #main -->
</div><!-- #primary -->

<aside id="secondary">
</aside>

<?php
get_footer();
