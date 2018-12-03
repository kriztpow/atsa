<?php
/*
 * Editar sección hoteles
 * cambiar textos e imagenes
 * Since 4.0
 * 
*/
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div id="hotelesyviajes">
		<!----- HOTELES ------------>
				<h3>Hoteles</h3>
				<div>
					<div class="container-fluid">
						
						<button class="btn btn-warning btn-sm" id="new-item-hotel">Crear nuevo hotel</button>
						<ul class="lista-hoteles-admin">
							<?php searchHotelesAdmin(); ?>
						</ul>

					</div>
				</div><!-- // cierre hoteles -->
			</div><!-- // accordion -->
		</div><!-- // container -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	    <div id="dialog"></div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->