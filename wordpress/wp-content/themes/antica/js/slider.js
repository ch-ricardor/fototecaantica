/* global wp, jQuery */

( function( $ ) {
    $( document ).ready( function() {
    })

    /* Nivo-Slider */
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    
    /* Intro */
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
    

})( jQuery );
