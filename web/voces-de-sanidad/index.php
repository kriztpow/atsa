<?php
/*
 * Sitio web: Colegio Buenos Aires
 * @LaCueva.tv
 * Since 1.0
 *
*/
require_once 'inc/functions.php';
global $dispositivo;
$dispositivo = dispositivo();
global $pageActual;
$pageActual = pageActual( cleanUri() );
global $isArchivo;
$isArchivo = false;

if ($pageActual != 'inicio' && $pageActual != 'contact' && $pageActual != 'suscribirse') {
	$isArchivo = true;	
}

include 'header.php';

switch ($pageActual) {
	case 'inicio' :
		/*
		 * Pagina inicio
		*/
		
		getTemplate( 'hero-slider' );

		break;
	
	case 'contacto' :
	/*
	 * Pagina Contacto
	*/

	getTemplate( 'contact' );

	break;

	case 'suscribirse' :
	/*
	 * Pagina suscripcion
	*/

	getTemplate( 'suscribe' );

	break;
	
	default:
		getTemplate( 'archivo' );
		break;
}

include 'footer.php';