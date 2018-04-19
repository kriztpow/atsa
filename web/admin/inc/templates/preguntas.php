<?php
/*
 * Editar sección preguntas frecuentes
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="btn-main-wapper">
				<button class="btn btn-warning btn-sm new-pregunta-btn">Crear nueva pregunta</button>
			</div>

			<div id="preguntasAcorddion">

				<?php showPreguntasAdmin(); ?>

			</div><!-- // accordion -->
		</div><!-- // container -->
		
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->