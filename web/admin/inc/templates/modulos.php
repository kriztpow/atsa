<?php
/*
 * Modulos individuales de administracion:
 * busca el template del modulo correpondiente y lo envia al html
 * Since 2.0
 * template gral
*/
require_once("../functions.php");
global $modulo;

$moduloaBuscar = $modulo;
$url = isset($_POST['url'])?$_POST['url']:'none';

switch ($moduloaBuscar) {
	
	//noticias
	case 'noticias':
	//html
	
	getTemplate( 'noticias' );
	
	break;//noticias

	//noticias
	case 'editar-noticias':
	//html
	if ( $url != 'none') {
		global $slug;
		$slug = $url;
	}
	getTemplate( 'editar-noticias' );
	
	break;//noticias

	//galeria de imagenes
	case 'galeria':
	//html
	
	getTemplate( 'galeria-imagenes-admin' );
	
	break;//galeria de imagenes

	//programas
	case 'programas':
	//html
	
	getTemplate( 'programas-admin' );

	break;//programas

	//Links y pdfs
	case 'links':
	//html
	
	getTemplate( 'links-pdfs-admin' );

	break;//Links y pdfs

	//Promociones (popup)
	case 'popups':
	//html
	
	getTemplate( 'promociones-admin' );

	break;//Promociones (popup)

	//otras ocpiones
	case 'otros':
	//html
	
	getTemplate( 'otros-opciones-admin' );

	break;//otras ocpiones

	//quienes somos
	case 'staff':
	//html
	
	getTemplate( 'staff-admin' );

	break;//quienes somos

	//nuevo usuario
	case 'nuevo-usuario':
	//html
	
	getTemplate( 'nuevo-usuario' );

	break;//cambiar password

	case 'change-password':
	//html
	
	getTemplate( 'change-password' );

	break;//cambiar passwords

	case 'sliders':
	//html
	
	getTemplate( 'sliders' );

	break;//sliders

	case 'editar-slider':
	//html
	if ( $url != 'none') {
		global $slug;
		$slug = $url;
	}
		getTemplate( 'editar-slider' );

	break;
}//cierre switch