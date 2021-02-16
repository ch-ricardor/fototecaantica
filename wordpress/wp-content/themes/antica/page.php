<?php get_header(); ?>
<body>

<?php include(TEMPLATEPATH . '/menu.php'); ?>
<?php if (is_user_logged_in()) { ?>
<div id="content">
<div id="wrap">

	<div id="textos">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	
		<h1><?php the_title(); ?></h1>
		<?php the_content();?>
    
	<?php endwhile; endif; ?>

	</div>
    

</div> <!-- fin wrap -->
</div> <!-- fin content -->
<?php } else { include(TEMPLATEPATH . '/homeshort.php'); } ?>
<?php } get_footer(); ?>