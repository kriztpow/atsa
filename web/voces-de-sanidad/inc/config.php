<?php 
/*
 * Sitio web: Colegio Buenos Aires
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
 * Contenido: conneccion
*/
define ( 'VERSION', '1.0' );
define ( 'CANTPOST', 3 );
//CARPETAS
define ( 'UPLOADS', dirname( __FILE__ ) . '/../contenido' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
//urls
define ('CARPETASERVIDOR', '/voces-de-sanidad' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINSURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('UPLOADSURL', MAINSURL . '/contenido');
//base de datos
define("DB_SERVER", "localhost");
define("DB_USER", "dbuser");
define("DB_PASS", "123");
define("DB_NAME", "voces-sanidad");
//META TAGS
define('SITETITLE', 'Voces de Sanidad');
define('METADESCRIPTION', 'Todas las voces de nuestro gremio se unen en este espacio. Dirigentes, delegad@s, compañer@s, artistas y especialistas narran historias, comparten reflexiones y proponen caminos para enfrentar nuevas realidades con innovación, solidaridad y, sobre todo, unidad.');
define('METAKEYS', 'ATSA, Buenos Aires, Hector Daer, FATSA, Sanidad, trabajadores de la salud,');

//LINKS:
define('LINK_FACEBOOK', 'http://www.facebook.com/pages/ATSA-Bs-As/116874221683810');
define('LINK_INSTAGRAM', '#');
define('LINK_TWITTER', 'http://twitter.com/AtsaBsAs');
define('LINK_YOUTUBE', '#');
define('EMAIL', 'voces@atsa.org.ar');

//textos:
define('ABOUTUS', 'Todas las voces de nuestro gremio se unen en este espacio. Dirigentes, delegad@s, compañer@s, artistas y especialistas narran historias, comparten reflexiones y proponen caminos para enfrentar nuevas realidades con innovación, solidaridad y, sobre todo, unidad.');

//categoria para hacer loop
global $categorias;
$categorias = array(
	array( 'slug' => 'editorial', 'nombre' => 'Editorial'),
	array( 'slug' => 'internacional', 'nombre' => 'Internacional'),
	array( 'slug' => 'nacional', 'nombre' => 'Nacional'),
);
