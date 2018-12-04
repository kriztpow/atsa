<?php
/*
 * Editar sección instituto:
 * Instituto fue separado de cursos desde: 8.4
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			
			<div id="cursosacordion">

				<h3 class="text-center">Instituto Amado olmos</h3>
				<div>
					<div class="container-fluid">
						<ul class="lista-cursos" id="contenedor-instituto">
                            <?php showInstitutoAdmin ( 'instituto' ); ?>
						</ul>
					</div>
				</div><!-- // accordion item -->
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