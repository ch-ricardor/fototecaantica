<header>

<nav id="navigation">
<div class="wrap">

	<div class="control-menu">
		<a href="#navigation" class="open"><span>MENU</span></a>
		<a href="#" class="close"><span>CERRAR</span></a>
	</div>

	<?php
        // RRE 2020 Wordpress warning get_settings deprecated ...
        // Changed to get_option
    ?>

	<ul id="nav" class="nav-items">
        <li><a href="<?php echo get_option('home',''); ?>">Inicio</a></li>
        <li><a href="#">Quiénes somos</a>
            <ul>
                <li><a href="<?php echo get_option('home',''); ?>/mision/">Misión</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/trayectoria/">Trayectoria</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/servicios/">Servicios</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/el-coleccionista/">El Coleccionista</a></li>
            </ul>
        </li>
        <li><a href="<?php echo get_option('home',''); ?>/fondos-tematicos/">Acervo</a>
            <ul>
                <li><a href="<?php echo get_option('home',''); ?>/fondos-tematicos/">Fondos temáticos</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/fondos-por-autor/">Fondos por autor</a></li>
            </ul>
        </li>
        <li><a href="#">Catálogo</a>
            <ul>
                <li><a href="<?php echo get_option('home',''); ?>/catalogo/">Catálogo en línea</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/fondos/">Fondos</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/autores/?page=ft/fichas.php&cat=autores&ver=Autores">Autores</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/metodologia/">Metodología</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/acceso/">Acceso</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/creditos/">Créditos</a></li>
            </ul>
        </li>
        <li><a href="<?php echo get_option('home',''); ?>/sede/">Sede</a></li>
        <li><a href="#">Enlaces</a>
            <ul>
                <li><a href="<?php echo get_option('home',''); ?>/enlaces/">Enlaces</a></li>
                <li><a href="<?php echo get_option('home',''); ?>/prensa/">Prensa</a></li>
            </ul>
        </li>
        <li><a href="<?php echo get_option('home',''); ?>/contacto/">Contacto</a></li>
        <li class="buscar"><a href="<?php echo get_option('home',''); ?>/archivo/?cat=buscar">Buscar</a></li>
    </ul>
</div> <!-- .wrap -->
</nav><!-- #navifation -->

</header>