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

getPage( $pageActual );