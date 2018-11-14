<?php
// BASE DE DATOS
define('DB_SERVER', 'localhost');
define("DB_USER", "dbuser");
define("DB_PASS", "123");
define('DB_NAME', 'afiliate');
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
define ( 'MODULOSDIR', dirname( __FILE__ ) . '/modulos' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../../uploads' );
define ( 'UPLOADSIMAGES', dirname( __FILE__ ) . '/../../../uploads/images' );
define ( 'UPLOADSFILES', dirname( __FILE__ ) . '/../../../uploads/pdfs' );
//URL
define ('CARPETASERVIDOR', '/afiliate' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('URLADMINISTRADOR', MAINURL . '/afiliados' );//esta variable define la carpeta del administrador - también debe cambianser en el .js
define ('UPLOADSURL', 'http://' . $_SERVER['HTTP_HOST'] . '/uploads' );//carpeta donde esta el contenido subido por el usuario
define ('UPLOADSURLIMAGES', UPLOADSURL . '/images');//carpeta  de imagenes (por si tiene distintas carpetas de contenido)
define ('UPLOADSURLFILES', UPLOADSURL . '/pdfs');//carpeta de archivos (por si tiene distintas carpetas de contenido)

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'Afiliados - ATSA' );
define ( 'DATEPUBLISHED', '2018');
define ('LOGOSITE' , URLADMINISTRADOR . '/assets/images/logosite.png');
define ( 'SITETITLE', 'ATSA - Panel de control' );
define ( 'FAVICONICO', URLADMINISTRADOR . '/favicon.ico' );
define ( 'CANTPOST', '250' );

//variables tipo de usuario
global $usertype;
$usertype = array(
	array( 'status' => '0', 'nombre' => 'Administrador'),
	array( 'status' => '1', 'nombre' => 'Editor'),
	array( 'status' => 'a', 'nombre' => 'default'),
	array( 'status' => 'd', 'nombre' => 'delegado'),
);
//variables de tipos de estado de usuario
global $afiliadoStatus;
$afiliadoStatus = array(
	array( 'status' => '0', 'definicion' => 'No contactado'),
	array( 'status' => '1', 'definicion' => 'Contactado'),
	array( 'status' => '2', 'definicion' => 'Anulado'),
	array( 'status' => '3', 'definicion' => 'Firmado'),
);
