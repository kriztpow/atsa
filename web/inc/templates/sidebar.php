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
		<a href="/noticias/categoria/nacionales">nacionales</a>,
		<a href="/noticias/categoria/ATSA">ATSA</a>,
		<a href="/noticias/categoria/internacionales">internacionales</a>,
		<a>Cultura</a>,
		<a>Voces de Sanidad</a>,
		<a>Espacio Audiovisual</a>,
		<a>Convenios de trabajo</a>,
		<a>Beneficios</a>
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