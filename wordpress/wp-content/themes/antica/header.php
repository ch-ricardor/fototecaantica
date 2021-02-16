<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es-MX">

<head profile="http://gmpg.org/xfn/11">

    <meta charset="<?php bloginfo('charset'); ?>">
    <title>Fototeca Antica<?php if ( is_single() or is_page() or is_archive() ) { wp_title(); } ?></title>

    <link rel="Shortcut Icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="title" content="Fototeca Antica<?php if ( is_single() or is_page() or is_archive() ) { wp_title(); } ?>" />
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Zared y Zabdiel" />
    <meta name="generator" content="PoeticaVisual" />
    <meta name="owner" content="Jorge Carretero Madrid" />
    <meta name="copyright" content="Fototeca Antica A.C." />

    <meta property="og:locale" content="es_MX" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Fototeca Antica" />
    <meta property="og:title" content="Fototeca Antica" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php bloginfo('url'); ?>" />
    <meta property="og:image" content="http://catalogo.fototecaantica.net/Catalogo-Fototeca-Antica.jpg" />

    <!-- WP -->
    <?php
        // RRE 2020 - WP Recommendation
        // Step 1. Change bloginfo to get_template_directory_uri()
        // Step 2. Todo: Remove JQuery nivo slider Dependencies

        // NOTE: Ommited by the designer, calls are necessary to run other Plugins
        //  EED plugin js and css
        //  XMLRPC pingback bloginfo('pingback_url') (Removed from the Original Header)
        //  Global site tag gtag.js included if installed on the Site (Removed from the Original Header)
        wp_head();
    ?>


    <!-- Custom Styles Moved to Functions -->

<?php if ( is_home() ) {

  	/* <!-- RRE 2020 -->
       <!-- Styles moved to functions -->
      <!-- JQuery / color removed -->
    */
 } else {
    // <!-- Nivo-Slider Styles moved to functions -->
 } ?>

    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">

</head>

<?php
    /**
        RRE 2020 Adaptation add WordPress functionalities
        Changing original design
    */
?>

<body <?php body_class();?>
        oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">

    <?php if (! is_home() ) : get_template_part('template-parts/header/header','menu'); endif; ?>
