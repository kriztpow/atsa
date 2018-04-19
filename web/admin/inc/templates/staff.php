<?php
/*
 * Editar o agregar personas
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
			
			<div id="accordionStaff">
				<h3>Secretario General</h3>
				<div>
					<?php showDelegadosAdmin( 'secretario_general' ); ?>
				</div>
				<h3>Comisión Directiva</h3>
				<div>
					<?php showDelegadosAdmin( 'comision_directiva' ); ?>
				</div>
				<h3>Vocales Titulares</h3>
				<div>
					<?php showDelegadosAdmin( 'vocales_titulares' ); ?>
				</div>
				<h3>Vocales Suplentes</h3>
				<div>
					<?php showDelegadosAdmin( 'vocales_suplentes' ); ?>
				</div>
				<h3>Revisores de cuenta</h3>
				<div>
					<?php showDelegadosAdmin( 'revisores_de_cuenta' ); ?>
				</div>
				<h3>Delegados Gremiales</h3>
				<div>
					<?php showDelegadosAdmin( 'delegados_gremiales' ); ?>
				</div>
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