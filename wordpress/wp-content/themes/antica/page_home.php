<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>
<body>

<?php include(TEMPLATEPATH . '/menu.php'); ?>

<div id="content" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
<div id="wrap">

<div id="logo"></div>

<div id="home"></div>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
    <div id="texto-home">


		<?php the_content();?>

	</div>

<?php endwhile; endif; ?> 
</div> <!-- fin wrap -->
</div> <!-- fin content -->

<?php get_footer(); ?>