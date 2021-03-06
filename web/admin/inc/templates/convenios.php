<?php
/*
 * Editar sección convenios
 * subir nuevos pdfs o url
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			
			<div id="accordionConvenios">

				<?php showLinksConveniosAdmin(); ?>

			</div><!-- // accordion -->
		</div><!-- // container -->
		<div class="container">	
			
			<button class="btn btn-lg btn-success" id="new-section-convenios-btn">Crear nueva sección</button>
			<p><small>
				Este botón agrega una sección nueva para la página, primero pide un id que lo identificará en la base de datos y luego un texto que es el que aparece en la página.
			</small></p>
		</div><!-- // container -->
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->