<?php get_header(); ?>

<script type="text/javascript">
	//var audioElement = document.createElement('audio');
	//audioElement.setAttribute('src', 'sonido45.ogg');
	//audioElement.setAttribute('autoplay', 'autoplay');
</script>
<embed src="sonido45.ogg" hidden="true" loop="true">
<body style="overflow:hidden;" oncontextmenu="return false;" onmousedown="return false;" onselectstart="return false;">
        
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

        <div><a id="saltar" href="<?php echo get_settings('home'); ?>/portada/"></a></div>

        <script type="text/javascript" src="jquery-1.3.2.js"></script>
        <script type="text/javascript" src="jquery.color.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#saltar').animate({'opacity':1}, 10);

                $('#rojo').animate({'backgroundColor':'#A02140'}, 500, function(){
                    
                    $('#cuadro').animate({'top':'100%','opacity':0}, 500);
                    $('#cuadro').animate({'top':'45%','opacity':0.5}, 500, function(){

                        $('#circulo').animate({'top':'45%','opacity':1}, 500);
                        $('#circulo').animate({'left':'80%','opacity':1}, 500);
                        $('#punto').animate({'top':'45%','opacity':1}, 800);
                        $('#horizontal').animate({'left':'60%','opacity':1}, 800);
                        $('#horizontal').animate({'left':'50%','opacity':1}, 800);
                        $('#vertical').animate({'top':'45%','opacity':1}, 800);

                    });
                    $('#cuadro').animate({'top':'45%','opacity':1}, 1500);
                    $('#cuadro').animate({'top':'-600px','opacity':0}, 400, function(){
                        $('#punto').animate({'left':'50%','opacity':1}, 400);
                        $('#punto').animate({'left':'50%','opacity':0}, 800);
                        $('#vertical').animate({'top':'45%','opacity':0}, 600);
                        $('#circulo').animate({'left':'0%','opacity':0}, 500);
                        $('#horizontal').animate({'left':'100%','opacity':0}, 800, function(){
                            $('#epigrafe').animate({'opacity':0}, 300);
                            $('#epigrafe').animate({'opacity':1}, 900);
                            $('#epigrafe').animate({'opacity':1}, 7000);
                            $('#epigrafe').animate({'opacity':0}, 600);
                            $('#circulo').animate({'left':'0%','opacity':0}, 9000, function(){
                                $('#rojo').animate({'opacity':0}, 800);
                                $('#titulo').animate({'top':'50%','opacity':1}, 1000);
                                $('#logo').animate({'top':'50%','opacity':1}, 800, function(){
                                    $('#titulo').animate({'top':'50%','opacity':1}, 3800);

                                    $('#logo').animate({'top':'50%','opacity':1}, 3800, function(){
                                        
                                        $('#titulo').animate({'top':'50%','opacity':0}, 800);
$('#logo').animate({'top':'50%','opacity':0}, 600, function(){
        $('#fotoa').animate({'left':'50%','opacity':1}, 1000);
        $('#fotoa').animate({'left':'50%','opacity':1}, 1300);
        $('#fotoa').animate({'left':'50%','opacity':0}, 600, function(){
            $('#fotob').animate({'left':'50%','opacity':1}, 1000);
            $('#fotob').animate({'left':'50%','opacity':1}, 1300);
            $('#fotob').animate({'left':'50%','opacity':0}, 600, function(){
                $('#fotoc').animate({'left':'50%','opacity':1}, 1000);
                $('#fotoc').animate({'left':'50%','opacity':1}, 1300);
                $('#fotoc').animate({'left':'50%','opacity':0}, 600, function(){
                    $('#fotod').animate({'left':'50%','opacity':1}, 1000);
                    $('#fotod').animate({'left':'50%','opacity':1}, 1300);
                    $('#fotod').animate({'left':'50%','opacity':0}, 600, function(){
                        $('#fotoe').animate({'left':'50%','opacity':1}, 1000);
                        $('#fotoe').animate({'left':'50%','opacity':1}, 1300);
                        $('#fotoe').animate({'left':'50%','opacity':0}, 600, function(){
                            $('#fotof').animate({'left':'50%','opacity':1}, 1000);
                            $('#fotof').animate({'left':'50%','opacity':1}, 1300);
                            $('#fotof').animate({'left':'50%','opacity':0}, 600, function(){
                                $('#fotohome').animate({'top':'50%','opacity':1}, 800);
                                $('#fotohome').animate({'top':'50%','opacity':1}, 3400);
                                $('#fotohome').animate({'top':'50%','opacity':0}, 3600);
                            });
                        });
                    });
                });
            });
        });
});

                                    });
                                });
                            });
                        });
                    });
                });
            });
            function redireccionarPagina() {
                window.location = "<?php echo get_settings('home'); ?>/portada/";
            }
            setTimeout("redireccionarPagina()", 44800);
        </script>

<?php get_footer(); ?>