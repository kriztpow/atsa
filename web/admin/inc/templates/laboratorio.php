<?php
/*
 * Editar sección laboratorio de simulacion
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
				<button class="btn btn-warning btn-sm new-laboratorio-btn">Crear nueva item</button>
			</div>

			<div id="laboratorioAcorddion">

				<?php showLaboratorioAdmin(); ?>

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