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
$noticiaSEO = false;
global $pageActual;
global $dataNoticia;

if ( count($dataNoticia) > 0 ) {
    $noticiaSEO = true;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo SeoTitlePage( $pageActual ); ?></title>

<!-- SEO SECCTION -->
<meta name="keywords" content="ATSA, Buenos Aires, trabajadores, sindical, gremio, medicamentos, salud, FATSA">
<meta name="description" content="<?php echo $dataNoticia['resumen']; ?>">
<?php  if ($noticiaSEO) { ?>

<link rel="canonical" href="<?php echo urlBase() . '/noticias/'. $dataNoticia['url']; ?>" />
<meta property="og:locale" content="es_ES" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo $dataNoticia['titulo']; ?>" />
<meta property="og:description" content="<?php echo $dataNoticia['resumen']; ?>" />
<meta property="og:url" content="<?php echo urlBase() . '/noticias/'. $dataNoticia['url']; ?>" />
<meta property="og:site_name" content="<?php echo urlBase(); ?>" />
<meta property="og:image" content="<?php echo urlBase() . '/uploads/images/'. $dataNoticia['imgDestacada']; ?>" />
<meta property="article:publisher" content="//www.facebook.com/pages/ATSA-Bs-As/116874221683810" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?php echo $dataNoticia['resumen']; ?>" />
<meta name="twitter:title" content="<?php echo $dataNoticia['titulo']; ?>" />
<meta name="twitter:image" content="<?php echo urlBase() . '/uploads/images/'. $dataNoticia['imgDestacada']; ?>" />

<?php } elseif ( $pageActual == 'nosomospresos' ) {
    
    $titulo = 'No a la pulsera Enfermería';
    $imagen = '/uploads/images/pulsera-header.jpg';
    $descripcion = 'Dicen que quieren mejorar la productividad, que hay que automatizar para ser más eficientes. Con la excusa del avance tecnológico, el discurso del progreso y de la modernización quieren retroceder en el tiempo y volver a épocas pasadas donde los derechos humanos no existían y la única ley que prevalecía era la de la explotación del hombre sobre el hombre. En pleno Siglo XXI, quieren poner pulseras en nuestras muñecas para perseguirnos, como si fuésemos criminales.';
    
    ?>
    <link rel="canonical" href="<?php echo urlBase() . '/'. $pageActual; ?>" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $titulo; ?>" />
    <meta property="og:description" content="<?php echo $descripcion; ?>" />
    <meta property="og:url" content="<?php echo urlBase() . '/'. $pageActual; ?>" />
    <meta property="og:site_name" content="<?php echo urlBase(); ?>" />
    <meta property="og:image" content="<?php echo urlBase() . $imagen; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo $descripcion; ?>" />
    <meta name="twitter:title" content="<?php echo $titulo; ?>" />
    <meta name="twitter:image" content="<?php echo urlBase() . $imagen; ?>" />

<?php } else { ?>

    <link rel="canonical" href="<?php echo urlBase() . '/'. $pageActual; ?>" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo SeoTitlePage( $pageActual ); ?>" />
    <meta property="og:description" content="<?php echo metaDescriptionText ( $pageActual, $noticia, $curso, $categoriaNoticias ); ?>" />
    <meta property="og:url" content="<?php echo urlBase() . '/'. $pageActual; ?>" />
    <meta property="og:site_name" content="<?php echo urlBase(); ?>" />
    <meta property="og:image" content="<?php echo urlBase() . '/assets/images/noticia-img-default.png'; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo metaDescriptionText ( $pageActual, $noticia, $curso, $categoriaNoticias ); ?>" />
    <meta name="twitter:title" content="<?php echo SeoTitlePage( $pageActual ); ?>" />
    <meta name="twitter:image" content="<?php echo urlBase() . '/assets/images/noticia-img-default.png'; ?>" />
<?php } ?>
<!-- // SEO SECCTION -->
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
    <link href="<?php echo urlBase(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php 
    	if ( $pageActual == 'noticias' ) {
    		echo urlBase() . '/' . MAINNEWSCSSURL;
    	} else {
			echo urlBase() . '/' . MAINCSSURL;
    	}
    ?>" rel="stylesheet">

<!--[if lt IE 9]>
	<script src="js/html5shiv/dist/html5shiv.js"></script>
<![endif]-->
<script src="<?php echo urlBase(); ?>/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo urlBase(); ?>/js/modernizr.custom.26633.js"></script>
</head>
<body>
    <!-- afiliate -->
    <div class="barrita-afiliate">
        <div class="button-close-wrapper">
            <button id="close-barrita"></button>
        </div>
        <a href="https://atsa.org.ar/afiliate" target="_blank">
            <div class="barrita-contents">
                <div class="barrita-content">
                    <span class="barrita-content-deco">
                        Afiliate online
                    </span>
                </div>

                <div class="barrita-content">
                    <span>
                        #Vivi Sanidad
                    </span>
                </div>
            </div>
        </a>
    </div>