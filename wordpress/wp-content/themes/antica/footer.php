<?php
/**
 * The template for displaying the footer
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Antica_Store
 * @since 1.2
 * @version 1.2
 */

?>
<div style="clear:both;"></div>

<footer id="footer">
    <div class="wrap">

        <div class="logo-uno"></div><!-- .logo-uno -->
        <div class="logo-dos"></div><!-- .logo-dos -->
        <div class="logo-tres"></div><!-- .logo-tres -->

        <div>
            <p>PROYECTO APOYADO POR EL FONDO NACIONAL PARA LA CULTURA Y LAS ARTES.
            </p>
        </div>

    </div><!-- .wrap -->
</footer><!-- #footer -->

<script type="text/javascript" charset="utf-8">
(function($){
	$('#nav li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#nav ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>

<?php
    // RRE 2020 Enable to use EDD Ajax calls
    wp_footer(); ?>
</body>
</html>