<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.0
 * HEAD
 * Contenido: etiqueta <head>
*/
require_once 'inc/functions.php';


//toma la variable que viene del index.php para saber en que página se está navegando
global $pageActual;


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SeoTitlePage($pageActual); ?></title>
<meta name="keywords" content="ATSA, Buenos Aires, trabajadores, sindical, gremio, medicamentos, salud, FATSA">
<meta name="description" content="Asociación de trabajadores de la Sanidad Argentina, Buenos Aires. Somos Trabajadores que prestamos servicios en todo establecimiento dedicado a la generación y distribución de medicamentos y a la preservación o recuperación de la Salud. Nos unimos bajo el mismo gremio para defender nuestros derechos llevando las banderas de la UNIDAD y SOLIDARIDAD, con convicción y consciencia sindical.">
<base href="<?php echo urlBase(); ?>" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">
    <!-- bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php 
    	if ( $pageActual == 'noticias' ) {
    		echo MAINNEWSCSSURL;
    	} else {
			echo MAINCSSURL;
    	}
    ?>" rel="stylesheet">

<!--[if lt IE 9]>
	<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/modernizr.custom.26633.js"></script>

</head>
<body>