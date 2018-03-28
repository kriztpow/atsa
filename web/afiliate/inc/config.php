<?php 
/*
 * Sitio web: TROOPS
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
*/
//BD
define('DB_SERVER', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', '123');
define('DB_NAME', 'atsa');
//DEFINICIONES HEAD Y SCRIPTS
define ( 'VERSION', '1.0' );
//CARPETAS
define ( 'UPLOADS', dirname( __FILE__ ) . '/../contenido' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
//urls
define ('CARPETASERVIDOR', '/afiliate' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINSURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('UPLOADSURL', MAINSURL . '/contenido');
define ('UPLOADSFILE', MAINSURL . '/contenido');
//META TAGS
define('SITETITLE', 'ATSA | Afiliate');
define('METADESCRIPTION', 'Asociación de trabajadores de la Sanidad Argentina, Buenos Aires. Somos Trabajadores que prestamos servicios en todo establecimiento dedicado a la generación y distribución de medicamentos y a la preservación o recuperación de la Salud. Nos unimos bajo el mismo gremio para defender nuestros derechos llevando las banderas de la UNIDAD y SOLIDARIDAD, con convicción y consciencia sindical.');
define('METAKEYS', '');
