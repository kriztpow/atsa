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


include 'header.php';

if ($pageActual == 'inicio' ) {
	/*
	 * Pagina inicio
	*/
	
	getTemplate( 'hero-slider' );

} elseif ($pageActual == 'contacto' || $pageActual == 'suscribirse' ) {
	/*
	 * Pagina Contacto o suscripcion
	*/

	getTemplate( 'contact' );

} else {
	/*
	 * Pagina de archivo o single
	*/
	
	getTemplate( 'archivo' );
}

include 'footer.php';