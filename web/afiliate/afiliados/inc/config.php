<?php
// BASE DE DATOS
define('DB_SERVER', 'localhost');
define("DB_USER", "derechoc_coco");
define("DB_PASS", "d6m=fD1=ZqKt");
define('DB_NAME', 'atsa');
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
define ( 'MODULOSDIR', dirname( __FILE__ ) . '/modulos' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../../uploads' );
define ( 'UPLOADSIMAGES', dirname( __FILE__ ) . '/../../../uploads/images' );
define ( 'UPLOADSFILES', dirname( __FILE__ ) . '/../../../uploads/pdfs' );
//URL
define ('CARPETASERVIDOR', '/afiliate' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINURL', 'https://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('URLADMINISTRADOR', MAINURL . '/afiliados' );//esta variable define la carpeta del administrador - también debe cambianser en el .js
define ('UPLOADSURL', 'https://' . $_SERVER['HTTP_HOST'] . '/uploads' );//carpeta donde esta el contenido subido por el usuario
define ('UPLOADSURLIMAGES', UPLOADSURL . '/images');//carpeta  de imagenes (por si tiene distintas carpetas de contenido)
define ('UPLOADSURLFILES', UPLOADSURL . '/pdfs');//carpeta de archivos (por si tiene distintas carpetas de contenido)

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'Afiliados - ATSA' );
define ( 'DATEPUBLISHED', '2018');
define ('LOGOSITE' , URLADMINISTRADOR . '/assets/images/logosite.png');
define ( 'SITETITLE', 'ATSA - Panel de control' );
define ( 'FAVICONICO', URLADMINISTRADOR . '/favicon.ico' );
define ( 'CANTPOST', '10' );

//variables tipo de usuario
global $usertype;
$usertype = array(
	array( 'status' => 'a', 'nombre' => 'default'),
	array( 'status' => '0', 'nombre' => 'Administrador'),
	array( 'status' => '1', 'nombre' => 'Editor'),
);
//variables de tipos de estado de usuario
global $afiliadoStatus;
$afiliadoStatus = array(
	array( 'status' => '0', 'definicion' => 'No contactado'),
	array( 'status' => '1', 'definicion' => 'Contactado'),
	array( 'status' => '2', 'definicion' => 'Anulado'),
	array( 'status' => '3', 'definicion' => 'Firmado'),
);
