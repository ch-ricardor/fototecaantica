<?php
/*
Template Name: Single Download
	Easy Digital Downloads - Antica Product view
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
        // Load the EDD Object
        $anticaProduct = edd_get_download(get_the_ID());
    ?>

    <div id="header2">
        <div id="wrap">

            <h2><?php echo $anticaProduct->post_title;; ?></h2>
            <h1><?php echo $anticaProduct->post_excerpt; ?></h1>
            <a href="<?php echo get_option('home',''). '/portada'; ?>"><?php echo __('Regresar');?></a>

        </div><!-- #wrap -->
    </div><!-- #header2 -->

    <?php
		/**
		 *  RRE 2020 Test if the Fotograph file exists
		*/
		$url = get_template_directory_uri() . '/images/' . 'pendiente.jpg';
		$url2 = '';

		if ( file_exists( ABSPATH.'/miniaturas/'. $anticaProduct->post_title .'.jpg' ) ) {
			$url = get_option('home','').'/miniaturas/'. $anticaProduct->post_title .'.jpg';
		}

    ?>
    <div class="slider-wrapper theme-default" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
        <div id="slider" class="nivoSlider">
            <img src="<?php echo $url;?>" >
            <?php
                if ( file_exists( ABSPATH.'/miniaturas-r/'. $anticaProduct->post_title . '-r.jpg' ) ) {
                    $url2 = get_option('home','').'/miniaturas-r/'. $anticaProduct->post_title . '-r.jpg';
                    echo '<img src="' . $url2 . '">';
                }
            ?>
        </div>
        
    </div> <!-- .slider-wrapper -->

	<div id="textos">

    	<div id="paginacion">
            <?php wp_link_pages('before=<span>&after=</span>
                                &next_or_number=next
                                &nextpagelink=<div class="sig">English</div>
                                &previouspagelink=<div class="atr">Español</div>
                                '); ?>
        </div> <!-- fin paginacion -->

		<!--<h1><?php //the_title(); ?></h1>-->

		<?php the_content();?>

        <div style="float:right;">
            <?php
            the_post_navigation(
                array(
                    'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'antica' ) .
                        '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'antica' ) .
                        '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' .
                        'arrow-left' . '</span>%title</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'antica' ) .
                        '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'next' ) .
                        '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' .
                        'arrow-right' . '</span></span>',
                )
            );
            ?>
        </div>

    <?php get_sidebar(); ?>

	</div><!-- #textos -->

<?php

echo '<br>';
the_terms( $post->ID, 'download_category', 'Categories: ', ', ', '' );
echo '<br>';
// display download tags
the_terms( $post->ID, 'download_tag', 'Tags: ', ', ', '' );

echo edd_price_range( $post->ID );

?>


    <div class="product-image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('product-image'); ?>
        </a>
        <?php if(function_exists('edd_price')) { ?>
            <div class="product-price">
                <?php
                    if(edd_has_variable_prices(get_the_ID())) {
                        // if the download has variable prices, show the first one as a starting price
                        echo 'Starting at: '; edd_price(get_the_ID());
                    } else {
                        edd_price(get_the_ID());
                    }
                ?>
            </div><!--end .product-price-->
        <?php } ?>
    </div>

<?php endwhile; endif; ?>

</div> <!-- fin wrap -->
</div> <!-- fin content -->

<!-- RRE 2020 Slider equeued in functions.php -->

<?php get_footer();
