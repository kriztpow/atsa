<?php
/*
 * Sitio web: COLEGIO DE BUENOS AIRES
 * @LaCueva.tv
 * Since 1.0
 * HEADER
*/

global $menuItems;
global $pageActual;
global $metaDescription;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo SeoTitlePage(cleanUri()); ?></title>
    <!-- Forces user OUT of IE's compatibility mode and removes "broken page" icon --> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--favicon-->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo MAINSURL; ?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo MAINSURL; ?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo MAINSURL; ?>/favicon-16x16.png">
<link rel="manifest" href="<?php echo MAINSURL; ?>/manifest.json">
<link rel="mask-icon" href="<?php echo MAINSURL; ?>/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

<!-- SEO SECCTION -->
    <meta name="keywords" content="<?php echo METAKEYS; ?>">
    <meta name="description" content="<?php echo metaDescriptionText($metaDescription); ?>">
    <link rel="canonical" href="<?php echo MAINSURL . '/'; ?>" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo SeoTitlePage(cleanUri()); ?>" />
    <meta property="og:description" content="<?php echo metaDescriptionText($metaDescription); ?>" />
    <meta property="og:url" content="<?php echo MAINSURL . '/'; ?>" />
    <meta property="og:site_name" content="<?php echo SITETITLE; ?>" />
    <meta property="og:image" content="<?php echo MAINSURL . "/galeria/2017-11-21-533-imagen.jpg"; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo metaDescriptionText($metaDescription); ?>" />
    <meta name="twitter:title" content="<?php echo SeoTitlePage(cleanUri()); ?>" />
    <meta name="twitter:image" content="<?php echo MAINSURL . '/galeria/2017-11-21-533-imagen.jpg'; ?>" />
<!-- // SEO SECCTION -->

<!-- OWL -->
    <link href="<?php echo MAINSURL; ?>/inc/lib/owl/assets/owl.carousel.min.css" rel="stylesheet">
<!-- Custom CSS -->
    <link href="<?php echo MAINSURL; ?>/assets/css/style.css?<?php echo VERSION; ?>" rel="stylesheet">

<!--- modernizr -->
    <script src="<?php echo MAINSURL; ?>/assets/js/modernizr-custom.js"></script>

</head>
<body data-page="<?php echo $pageActual; ?>">
<div class="wrapper-site">
    <aside class="loader">
        <?php getTemplate( 'widget-frases' ); ?>
        <img src="<?php echo MAINSURL; ?>/assets/images/logo-transparente.png" class="animation-element fade-in">
    </aside>
    <?php
        openPopUp($pageActual);

    ?>
<!--- header ---------------------->
    <header class="header-site">
<!--- nav ---------------------->
        <div class="header-data">
            <ul class="social-media-header container-der">
                <?php getTemplate( 'social-items' ); ?>
            </ul>

            <!--<div class="container-der">
                <a href="mailto:<?php echo COLEGIOEMAIL; ?>">
                    <span class="icon icon-email"></span><?php echo COLEGIOEMAIL; ?>
                </a>
            </div>-->

            <a href="tel:11<?php echo str_replace(' ', '', TELCOLEGIO); ?>">
                <h5 class="tel-data-header">
                    <span class="icon-tel"></span><?php echo TELCOLEGIO; ?>
                </h5>
            </a>

        </div>

        <nav class="main-nav">
            <div class="container">
                <a href="<?php echo MAINSURL; ?>" title="<?php echo SITETITLE; ?>">
                    <img class="brand-name" src="<?php echo MAINSURL; ?>/assets/images/logo.png" alt="Logo Colegio De Buenos Aires">
                </a>

                <button class="toggle">
                    <span class="sr-only">Menu</span>
                    <span class="tog1"></span>
                    <span class="tog2"></span>
                    <span class="tog3"></span>
                </button>
                <ul class="main-menu" role="navigation">
                    <?php showMenu( $menuItems, $pageActual ); 
                    ?>
                </ul>
            </div>
            <button class="scroll-top-button">
                <span class="sr-only">Ir arriba</span>
                <span class="up1"></span>
                <span class="up2"></span>
            </button>
        </nav>
        
    </header>

    <main role="main">
    <!--- .main-wrapper -->
        <div class="main-wrapper">
