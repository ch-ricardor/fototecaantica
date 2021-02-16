<div style="clear:both;"></div>

<div id="wrap">
<div id="footer">

	<div id="logo-uno"></div>
    <div id="logo-dos"></div>
    <div id="logo-tres"></div>
    
    <div>
        <p>PROYECTO APOYADO POR EL FONDO NACIONAL PARA LA CULTURA Y LAS ARTES.
        </p>
        
    </div>
    
</div>
</div> <!-- fin wrap -->

<script type="text/javascript" charset="utf-8">
$(function(){
	$('#nav li a').click(function(event){
		var elem = $(this).next();
		if(elem.is('ul')){
			event.preventDefault();
			$('#nav ul:visible').not(elem).slideUp();
			elem.slideToggle();
		}
	});
});
</script>

</body>
</html>