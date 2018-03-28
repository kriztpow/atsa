<?php
/*
 * Sitio web: ATSA - AFILIATE
 * @LaCueva.tv
 * Since 1.0
*/

require_once 'inc/config.php';
require_once 'inc/functions.php';
global $pageActual;

$pageActual = pageActual( cleanUri() );

include 'header.php'; ?>

<div class="wrapper">

	<div class="inner-wrapper">
		
		<?php 
			
			switch ($pageActual) {
				case 'error':
					getTemplate('error');
					break;
				
				case 'bienvenidos':
					getTemplate('bienvenidos');
					break;

				default:
					# inicio: formularios
					
					getTemplate('intro-vivi-sanidad');

					getTemplate('formulario');

					break;
			}

		?>

	</div>

</div>

<?php 
include 'footer.php';