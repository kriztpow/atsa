<?php 
global $userStatus;
if ($userStatus != '0' && $userStatus != '1' ) {
	echo 'No tiene permisos para ver esta sección';
  	
  	exit;
}
load_module( 'agenda' );
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<h1 class="titulo-modulo">
			Agenda, Complejo Cultural
		</h1>
		<div class="container">
			
			contenido agenda
			
		</div>
	</div>
	<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
</div>