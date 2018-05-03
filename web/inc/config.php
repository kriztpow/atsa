<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
 * Contenido: conneccion
*/
include 'connect.php';

//DEFINICIONES HEAD Y SCRIPTS
define ( 'MAINCSSURL', 'css/style.css?3.1' );
define ( 'MAINNEWSCSSURL', 'css/style-news.css?3.0' );
define ( 'MAINSCRIPTJS', 'js/script.js?3.1' );
define ( 'DEFAULTDESCRIPTION', 'Asociación de trabajadores de la Sanidad Argentina, Buenos Aires. Somos Trabajadores que prestamos servicios en todo establecimiento dedicado a la generación y distribución de medicamentos y a la preservación o recuperación de la Salud. Nos unimos bajo el mismo gremio para defender nuestros derechos llevando las banderas de la UNIDAD y SOLIDARIDAD, con convicción y consciencia sindical.' );
//CARPETAS
define ( 'UPLOADS', dirname( __FILE__ ) . '/uploads' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/templates' );

