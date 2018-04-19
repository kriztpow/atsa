<?php
/*
 * Slider
 * Lista los sliders hechos
 * Since 3.0
 * 
*/

require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="row">
				<!-- col -->
				<div class="col-md-12 col-sm-12">
					<ul class="list-sliders">
						<?php listaSliders (); ?>
					</ul>
				</div><!-- //col -->
			</div><!-- //row -->
		</div><!-- // container -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->