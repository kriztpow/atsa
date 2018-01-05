<?php
/*
 * Sitio web: Voces de Sanidad
 * @LaCueva.tv
 * Since 1.0
 * HEADER
*/

global $menuItems;
global $pageActual;
global $metaDescription;
global $isArchivo;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Forces user OUT of IE's compatibility mode and removes "broken page" icon --> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!-- SEO SECCTION -->

<?php if ($isArchivo) : 
    $slug2 = getSlug( cleanUri() );
    if ( $slug2 != '' ){
        $POSTHEADER = getSinglePost( $slug2 );
    }
?>
    <title><?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo $POSTHEADER['post_titulo']; } else { echo 'Voces de Sanidad - Publicaciones'; } ?></title>
    <link rel="canonical" href="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_url'] != '' ) { echo MAINSURL .'/publicaciones/'. $POSTHEADER['post_categoria'] .'/'. $POSTHEADER['post_url']; } else { echo MAINSURL . '/publicaciones'; } ?>" />
    <meta name="keywords" content="<?php echo METAKEYS; ?>">
    <meta name="description" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_resumen'] != '' ) { echo $POSTHEADER['post_resumen']; } else { echo METADESCRIPTION; } ?>">
    
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo $POSTHEADER['post_titulo']; } else { echo 'Voces de Sanidad - Publicaciones'; } ?>" />
    <meta property="og:description" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_resumen'] != '' ) { echo $POSTHEADER['post_resumen']; } else { echo METADESCRIPTION; } ?>" />
    <meta property="og:url" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_url'] != '' ) { echo MAINSURL .'/publicaciones/'. $POSTHEADER['post_categoria'] .'/'. $POSTHEADER['post_url']; } else { echo MAINSURL . '/publicaciones'; } ?>" />
    <meta property="og:site_name" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo $POSTHEADER['post_titulo']; } else { echo 'Voces de Sanidad - Publicaciones'; } ?>" />
    <meta property="og:image" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo UPLOADSURL .'/' . $POSTHEADER['post_imagen']; } else { echo MAINSURL . '/images/logo-dark.png'; } ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_resumen'] != '' ) { echo $POSTHEADER['post_resumen']; } else { echo METADESCRIPTION; } ?>" />
    <meta name="twitter:title" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo $POSTHEADER['post_titulo']; } else { echo 'Voces de Sanidad - Publicaciones'; } ?>" />
    <meta name="twitter:image" content="<?php if ( isset($POSTHEADER) && $POSTHEADER['post_titulo'] != '' ) { echo UPLOADSURL .'/' . $POSTHEADER['post_imagen']; } else { echo MAINSURL . '/images/logo-dark.png'; } ?>" />

<?php else : ?>
    <title><?php echo SITETITLE; ?></title>
    <link rel="canonical" href="<?php echo MAINSURL . '/'; ?>" />
    <meta name="keywords" content="<?php echo METAKEYS; ?>">
    <meta name="description" content="<?php echo metaDescriptionText($metaDescription); ?>">
    
    <meta property="og:locale" content="es_ES" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo SITETITLE; ?>" />
    <meta property="og:description" content="<?php echo metaDescriptionText($metaDescription); ?>" />
    <meta property="og:url" content="<?php echo MAINSURL . '/'; ?>" />
    <meta property="og:site_name" content="<?php echo SITETITLE; ?>" />
    <meta property="og:image" content="<?php echo MAINSURL . '/images/logo-dark.png'; ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="<?php echo metaDescriptionText($metaDescription); ?>" />
    <meta name="twitter:title" content="<?php echo SITETITLE; ?>" />
    <meta name="twitter:image" content="<?php echo MAINSURL . '/images/logo-dark.png'; ?>" />

<?php endif; ?>


<!-- // SEO SECCTION -->

<!-- Template CSS -->
    <link href="<?php echo MAINSURL; ?>/css/core.min.css" rel="stylesheet">
    <link href="<?php echo MAINSURL; ?>/css/skin.css" rel="stylesheet">
<!-- Custom CSS -->
    <link href="<?php echo MAINSURL; ?>/css/style.css?<?php echo VERSION; ?>" rel="stylesheet">

</head>
<body class="home-page" data-page="<?php echo $pageActual; ?>">
<?php
    openPopUp( $pageActual );
?>

    <!-- Side Navigation Menu -->
    <aside class="side-navigation-wrapper enter-right" data-no-scrollbar data-animation="scale-in">
        <div class="side-navigation-scroll-pane">
            <div class="side-navigation-inner">
                <div class="side-navigation-header">
                    <div class="navigation-hide side-nav-hide">
                        <a href="#">
                            <span class="icon-cancel medium"></span>
                        </a>
                    </div>
                </div>
                <nav class="side-navigation center">
                    <ul>
                        <li class="current">
                            <a href="#" class="contains-sub-menu">Voces de Sanidad</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo MAINSURL; ?>">Inicio</a>
                                </li>
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/publicaciones">Archivo</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="contains-sub-menu">Secciones</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/publicaciones/editorial">Editorial</a>
                                </li>
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/publicaciones/nacional">Nacional</a>
                                </li>
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/publicaciones/internacional">Internacional</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="contains-sub-menu">Institucional</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/contacto">Contacto</a>
                                </li>
                                <li>
                                    <a href="<?php echo MAINSURL; ?>/suscribirse">Suscribirse</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <div class="side-navigation-footer center">
                    <p class="copyright no-margin-bottom">&copy; ATSA BsAs.</p>
                </div>
            </div>
        </div>
    </aside>
    <!-- Side Navigation Menu End -->
    <div class="wrapper">
        <div class="wrapper-inner">

        <!-- Header -->
            <header class="header with-shadow header-absolute header-fixed-on-mobile header-transparent nav-dark" data-helper-in-threshold="300" data-helper-out-threshold="500"  data-sticky-threshold="300" data-bkg-threshold="300" data-compact-threshold="300">
                <div class="header-inner">
                    <div class="row nav-bar">
                        <div class="column width-12 nav-bar-inner">
                            <div class="logo">
                                <div class="logo-inner">
                                    <a href="<?php echo MAINSURL; ?>">
                                        <img src="<?php echo MAINSURL; ?>/images/logo-dark.png" alt="Link Inicio" />
                                    </a>
                                    <a href="<?php echo MAINSURL; ?>">
                                        <img src="<?php echo MAINSURL; ?>/images/logo.png" alt="Link Inicio" />
                                    </a>
                                </div>
                            </div>
                            <nav class="navigation nav-block secondary-navigation nav-right">
                                <ul>
                                    <li class="aux-navigation">
                                        <!-- Aux Navigation -->
                                        <a href="#" class="navigation-show side-nav-show nav-icon">
                                            <span class="icon-menu"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
        <!-- Header End -->
        <!-- Content -->
            <div class="content clearfix">