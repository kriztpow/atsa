<?php
/*
 * Editar sanidad numeros
 * editar pagina
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

$id = $_GET['id'];
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container page-admin-wrapper">

			<?php showPageAdmin ( $id ); ?>

		</div><!-- // container -->
		
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->