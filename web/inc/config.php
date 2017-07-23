<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.0
 * CONFIG
 * Contenido: conneccion
*/
include 'connect.php';
require_once 'data.php';

//DEFINICIONES HEAD Y SCRIPTS
define ( 'MAINCSSURL', 'css/style.css?2.0' );
define ( 'MAINNEWSCSSURL', 'css/style-news.css?2.0' );
define ( 'MAINSCRIPTJS', 'js/script.js?2.0' );
//CARPETAS
define ( 'UPLOADS', dirname( __FILE__ ) . '/uploads' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/templates' );

