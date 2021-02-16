<?php get_header(); ?>

<?php if (is_user_logged_in()) { ?>
<div id="content">
<div class="wrap">

	<div id="textos">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	
		<h1><?php the_title(); ?></h1>
		<?php the_content();?>
    
	<?php endwhile; endif; ?>

	</div>
    

</div> <!-- .wrap -->
</div> <!-- #content -->
<?php } else { include(TEMPLATEPATH . '/homeshort.php'); } ?>
<?php get_footer(); ?>