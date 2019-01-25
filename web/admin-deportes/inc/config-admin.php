<?php
// BASE DE DATOS
define('DB_SERVER', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASS', '123');
define('DB_NAME', 'deportes');
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates' );
define ( 'MODULOSDIR', dirname( __FILE__ ) . '/modulos' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../contenido' );
define ( 'UPLOADSIMAGES', UPLOADS . '' );
define ( 'UPLOADSFILES', UPLOADS . '' );
//URL
define ('CARPETASERVIDOR', '' );//esta variable se define si el sitio no está en el root del dominio y si está en una subcarpeta
define ('MAINURL', 'http://' . $_SERVER['HTTP_HOST'] . CARPETASERVIDOR );
define ('URLADMINISTRADOR', MAINURL . '/admin-deportes' );//esta variable define la carpeta del administrador - también debe cambianser en el .js
define ('UPLOADSURL', MAINURL . '/uploads');//carpeta donde esta el contenido subido por el usuario
define ('UPLOADSURLIMAGES', UPLOADSURL . '/images');//carpeta  de imagenes (por si tiene distintas carpetas de contenido)
define ('UPLOADSURLFILES', UPLOADSURL . '/pdfs');//carpeta de archivos (por si tiene distintas carpetas de contenido)

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'ATSA Deportes' );
define ( 'DATEPUBLISHED', '2019');
define ('LOGOSITE' , URLADMINISTRADOR . '/assets/images/logo.png');
define ( 'SITETITLE', 'ATSA - Panel de control deportes' );
define ( 'FAVICONICO', URLADMINISTRADOR . '/favicon.ico' );
define ('POSTPERPAG', 2);

//variables tipo de usuario
global $usertype;
$usertype = array(
	array( 'status' => '0', 'nombre' => 'Administrador'),
	array( 'status' => '1', 'nombre' => 'Editor'),
	array( 'status' => 'a', 'nombre' => 'default'),
	array( 'status' => 'f', 'nombre' => 'deportes'),
);

//variables de categorias de galeria de imagenes / si existen
global $categoriasGalerias;//define las categorias para cargar galerias
$categoriasGalerias = array(
	array( 'slug' => 'galeria1', 'nombre' => 'Galeria 1'),
	array( 'slug' => 'galeria2', 'nombre' => 'Galeria 2'),
);

global $archivos;
$archivos = array(
    array(
        'label' => 'PDF 1',
        'optionName' => 'pdf-1',
    ),
    
);

global $menuModulos;
$menuModulos = array(
	array(
		'titulo' => 'Partidos',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'partidos',
		'slug' => '',
		'user' => 'f',
	),
	array(
		'titulo' => 'Liga',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'liga',
		'slug' => '',
		'user' => 'f',
	),
	array(
		'titulo' => 'Equipos',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'equipos',
		'slug' => '',
		'user' => 'f',
	),
	array(
		'titulo' => 'Contenidos',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'posts',
		'slug' => '',
		'user' => 'f',
	),
	array(
		'titulo' => 'Deporte',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'deporte',
		'slug' => '',
		'user' => 'f',
	),
	array(
		'titulo' => 'Archivos',
		'texto' => 'Administrar los contenidos de los partidos.',
		'template' => 'archivos',
		'slug' => '',
		'user' => 'f',
	),
	/*array(
		'titulo' => 'Galería de Imágenes',
		'texto' => 'Manipular las distintas galerias de imagenes.',
		'template' => 'galeria-imagenes',
		'slug' => '',
		'user' => 'a',
	),
	array(
		'titulo' => 'Archivos descargas',
		'texto' => 'Administrar los archivos de descargas (pdfs).',
		'template' => 'archivos-descargas',
		'slug' => '',
		'user' => 'a',
	),
	array(
		'titulo' => 'Slider Inicio',
		'texto' => 'Modificar los sliders actuales.',
		'template' => 'editar-slider',
		'slug' => 'home',
		'user' => 'a',
	),
	array(
		'titulo' => 'Popups',
		'texto' => 'Activar o desactivar popups.',
		'template' => 'editar-slider',
		'slug' => '',
		'user' => 'a',
	),
	array(
		'titulo' => 'Biblioteca de medios',
		'texto' => 'Subir, borrar y manipular archivos e imagenes.',
		'template' => 'biblioteca-medios',
		'slug' => '',
		'user' => 'a',
	),*/
);