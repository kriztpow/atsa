<?php
/*
 * Sitio web: ATSA - FORMULARIOS
 * @LaCueva.tv
 * Since 1.0
*/

global $pageActual;


?>

<div class="section-wrapper form-wrapper">
	<div class="loader"></div>
	
	<div class="container">

		<div class="contenedor-formulario">

			<?php 
				if ($pageActual == 'formulario1') {
					getTemplate( 'formulario1' ); 	
				}
				if ($pageActual == 'formulario2') {
					getTemplate( 'formulario2' ); 	
				}
				 
			?>

		</div>
		
	</div>

</div>