<!------------ noticias recientes ------------>
<section class="hidden-xs hidden-sm section-sidebar">
	<h2 class="title-sidebar">
		Noticias Recientes
	</h2>
	<ul class="loop-recientes">
		<?php NoticiasRecientesHTML( 5 ); ?>
	</ul>
</section>

<!------------ etiquetas ------------>
<!--<section class="hidden-xs section-sidebar">
	<h2 class="title-sidebar">
		Etiquetas
	</h2>
	<div class="etiquetas-noticias">

		<?php //printTags(); ?>
		
	</div>
</section>-->

<!------------ twitter ------------>
<section class="hidden-xs hidden-sm section-sidebar">
	<h2 class="title-sidebar">
		Twitter
	</h2>
	<div class="twitter-noticias">

		<a class="twitter-timeline" data-height="550" href="https://twitter.com/AtsaBsAs?ref_src=twsrc%5Etfw">Tweets by AtsaBsAs</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
		
	</div>
</section>


<!------------ archivo noticias ------------>
<section class="hidden-xs hidden-sm section-sidebar archivo-noticias-menu">
	<h2>
		Archivo Noticias
	</h2>
	<div id="accordion-archivo">
	
	<?php archivoNoticias (); ?>

	</div><!-- //#accordion -->
</section>
<!------- scripts de esta pagina ------>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-archivo" ).accordion({
    		collapsible: true,
    		active : false,
    		heightStyle: "content",
    	});
    });//ready
</script>