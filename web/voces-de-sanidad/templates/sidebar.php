<?php
/*
 * Sitio web: Colegio Buenos Aires
 * @LaCueva.tv
 * Since 1.0
 * SIDEBAR TEMPLATE
 * Cada widget es un template también
*/

global $pageActual;
$widgets = array();

switch ( $pageActual ) {
	case 'inscripciones':
		$widgets = array( 
			'bienvenidos', 'niveles', 'noticias', 'campus', 'edad-feliz', 'xhendra', 'calendario'
		);
		break;

	case 'contacto':
		$widgets = array( 
			'bienvenidos', 'niveles', 'inscripciones', 'campus', 'noticias',);
		break;
	
	case 'institucional':
		$widgets = array( 
			'contacto', 'noticias', 'campus', 'calendario', 'edad-feliz', 'xhendra', 
		);
		break;

	case 'noticias':
		$widgets = array( 
			'bienvenidos', 'niveles', 'campus', 'inscripciones', 'edad-feliz', 'calendario', 'contacto'
		);
		break;

	case 'edad-feliz':
		$widgets = array( 
			'bienvenidos', 'niveles', 'campus', 'noticias', 'calendario', 'xhendra', 'contacto'
		);
		break;

	case 'niveles':
		$widgets = array( 
			'bienvenidos', 'campus', 'noticias', 'inscripciones', 'calendario', 'niveles','edad-feliz', 'xhendra', 'contacto'
		);
		break;

	case 'jornada-complementaria':
	case 'documentacion':
		$widgets = array( 
			'contacto', 'noticias', 'campus', 'xhendra', 
		);
	break;

	case 'campus-virtual':
		$widgets = array( 
			'bienvenidos', 'niveles', 'noticias', 'contacto', 'xhendra', 
		);
	break;

	case 'campo-deportes':
		$widgets = array( 
			'bienvenidos', 'niveles', 'campus', 'noticias', 'calendario', 'edad-feliz',
		);
		break;

	default:
		$widgets = array( 
			'bienvenidos', 'niveles', 'campus', 'noticias', 'calendario', 'edad-feliz', 'xhendra', 'contacto'
		);
		break;
}

?>

<ul class="sidebar-widgets">

<?php 

for ($i=0; $i < count($widgets); $i++) { 
	$widget = 'widget-' . $widgets[$i];
	echo '<li>';
		getTemplate( $widget );
	echo '</li>';
}

?>
</ul>