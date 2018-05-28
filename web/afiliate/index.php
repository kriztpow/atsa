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
	<div class="wrapper-background"></div>
	<div class="inner-wrapper">
		
		<?php 	
			switch ($pageActual) {
				case 'error':
					getTemplate('error');
					break;
				
				case 'bienvenidos':
					getTemplate('bienvenidos');
					break;

				case 'completar':
					getTemplate('completar' , '');
					break;

				case 'completar-datos':
					getTemplate('completar-datos' , '');
					break;

				default:
					# inicio: formularios
					
					getTemplate('intro-vivi-sanidad');

					getTemplate('wrapper-formularios');

					break;
			}
		?>

	</div>

</div>

<?php 
include 'footer.php';