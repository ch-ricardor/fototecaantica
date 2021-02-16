/**
 *  Fototeca Antica scripts
 *  Adaptation from the original
*/

/*
    Antica NivoSlider Manual Activation
*/
(function ($, root, undefined) {

	$(function () {

        'use strict';

        // DOM ready, take it away
        /* Nivo-Slider */
        $(window).load(function() {
            $('#slider').nivoSlider();
        });

	});

    $(function(){

        $('#antica-menu li a').click(function(event){
            var elem = $(this).next();
            if(elem.is('ul')){
                event.preventDefault();
                $('#antica-menu ul:visible').not(elem).slideUp();
                elem.slideToggle();
            }
        });
    });


})(jQuery, this);
