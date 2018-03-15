<?php
// BASE DE DATOS
define('DB_SERVER', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', '123');
define('DB_NAME', 'voces-sanidad');
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
define ( 'MODULOSDIR', dirname( __FILE__ ) . '/modulos' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../contenido' );
define ( 'UPLOADSIMAGES', dirname( __FILE__ ) . '/../../contenido' );
define ( 'UPLOADSFILES', dirname( __FILE__ ) . '/../../contenido/archivos' );
//URL
define ('CARPETASERVIDOR', '/voces-de-sanidad' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINURL', 'https://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('URLADMINISTRADOR', MAINURL . '/cargar-noticias' );
define ('UPLOADSURL', MAINURL . '/contenido');
define ('UPLOADSURLIMAGES', MAINURL . '/contenido');
define ('UPLOADSURLFILES', MAINURL . '/contenido');

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'Voces de Sanidad' );
define ( 'DATEPUBLISHED', '2018');
define ('LOGOSITE' , URLADMINISTRADOR . '/assets/images/logo.jpg');
define ( 'SITETITLE', 'Nombre - Panel de control' );
define ( 'FAVICONICO', MAINURL . '/favicon.ico' );

//variables de definicion de administrador
global $categorias;
$categorias = array(
	array( 'slug' => 'editorial', 'nombre' => 'Editorial'),
	array( 'slug' => 'nacional', 'nombre' => 'Nacional'),
	array( 'slug' => 'internacional', 'nombre' => 'Internacional'),
);
