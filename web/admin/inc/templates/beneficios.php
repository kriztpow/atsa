<?php
/*
 * Editar sección beneficios
 * subir nuevos imagenes y retocar textos
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
				<button class="btn btn-warning btn-sm new-beneficios-btn">Crear nuevo beneficios</button>
			</div>
			<div id="beneficiosAdmin">

				<?php showBeneficiosAdmin(); ?>

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