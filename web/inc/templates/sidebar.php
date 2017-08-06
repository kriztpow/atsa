<!------------ noticias recientes ------------>
<section class="section-sidebar">
	<h2 class="title-sidebar">
		Noticias Recientes
	</h2>
	<ul class="loop-recientes">
		<?php NoticiasRecientesHTML( 5 ); ?>
	</ul>
</section>

<!------------ etiquetas ------------>
<section class="hidden-xs section-sidebar">
	<h2 class="title-sidebar">
		Etiquetas
	</h2>
	<div class="etiquetas-noticias">

		<?php printTags(); ?>
		
	</div>
</section>

<!------------ archivo noticias ------------>
<section class="hidden-xs section-sidebar archivo-noticias-menu">
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