<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="antica-site-info">

    <div id="footer-antica" role="contentinfo">
        <div class="container">

            <div class="logo-uno"></div><!-- .logo-uno -->
            <div class="logo-dos"></div><!-- .logo-dos -->
            <div class="logo-tres"></div><!-- .logo-tres -->

            <div>
                <p>PROYECTO APOYADO POR EL FONDO NACIONAL PARA LA CULTURA Y LAS ARTES.
                </p>
                <p>© 2020 Fototeca Antica A.C.</p>
            </div>

        </div><!-- .container -->
    </div><!-- #footer -->

	<?php
	if ( function_exists( 'the_privacy_policy_link' ) ) {
		the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
	}
	?>
</div><!-- .antica-site-info -->
