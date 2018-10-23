<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.0
 * HEADER html del sitio
*/

global $pageActual;


?>
<header class="main-header">
    <!-- redes sociales submenu y busqueda-->
    <div id="header-submenus">
        <div class="container-fluid">
            
            <a href="\" title="Inicio">
                    <div class="brand-name">
                        <img src="assets/images/logos/logo.png" alt="logo ATSA">
                        <h5>Asociación de trabajadores<span> de la Sanidad Argentina</span></h5>
                        <h6>Buenos Aires</h6>
                    </div>
                </a>
            
            <button class="toggle-fixed">
                <span class="tog1-fixed"></span>
                <span class="tog2-fixed"></span>
                <span class="tog3-fixed"></span>
                <strong>MENU</strong>
            </button>
            <form id="search-form" name="search-form" method="post" action="inc/scripts/search.php">
                <input type="text" name="input-search" id="input-search" required placeholder="Buscar">
                <button type="submit"><span class="img-buscar"></span></button>
            </form>
            
            <nav class="header-sub-menu">
                <?php getTemplate( 'sub-menu' ); ?>
            </nav>
            <!-- SEARCH FORM Y CONTACT -->
            
            <div class="header-redes-sociales">
                <ul class="redes-sociales-header">
                    <li>
                        <a class="red-social red-social-facebook-header" href="http://www.facebook.com/pages/ATSA-Bs-As/116874221683810" target="_blank" rel="external">
                            <span class="sr-only">Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a class="red-social red-social-twitter-header" href="http://twitter.com/AtsaBsAs" target="_blank" rel="external">
                            <span class="sr-only">Twitter</span>
                        </a>
                    </li>
                    <li>
                        <a class="red-social red-social-youtube-header" href="http://www.youtube.com/user/atsabsas" target="_blank" rel="external">
                            <span class="sr-only">Youtube</span>
                        </a>
                    </li>
                    <li>
                        <a class="red-social red-social-instagram-header" href="https://www.instagram.com/AtsaBsAs/" target="_blank" rel="external">
                            <span class="sr-only">Instagram</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- // .container-fluid -->
    </div><!-- // #header-submenus -->
    
    <!-- logo y nav -->
    <div class="header-nav">
        <div class="container-fluid">
            
            <nav class="main-nav">
                <a href="\" title="Inicio">
                    <div class="brand-name-movil">
                        <img src="assets/images/logos/logo.png" alt="logo ATSA">
                        <h5>Asociación de trabajadores<span> de la Sanidad Argentina</span></h5>
                        <h6>Buenos Aires</h6>
                    </div>

                </a>
                <button class="toggle">
                    <span class="tog1"></span>
                    <span class="tog2"></span>
                    <span class="tog3"></span>
                </button>
                <?php getTemplate( 'menu' ); ?>
            </nav>
        </div><!-- // .container -->
    </div><!-- // .header-nav -->
    <?php 
        if ($pageActual != 'home' ) {
            
            if ($pageActual == 'hoteles-y-espacios-recreativos' || $pageActual == 'programas-prevencion' || $pageActual == 'trabajadores' || $pageActual == 'celeste-y-blanca' || $pageActual == 'torneos-y-eventos' || $pageActual == 'viajes' || $pageActual == 'peticion' || $pageActual == 'peticion-gracias' ) {
            ?>
            <!-- índice de navegacion -->
                <div class="nav-index-transparent">
                    <span class="nav-index-elements nav-index-item-now">
                        <?php echo $pageActual; ?>
                    </span>
                    <span class="nav-index-elements">
                        <a href="\" title="Volver al inicio">Inicio</a>
                    </span>
                </div>
                <?php
            } else {

                ?> 

                <!-- índice de navegacion -->
                <div class="nav-index">
                    <span class="nav-index-elements nav-index-item-now">
                        <?php echo $pageActual; ?>
                    </span>
                    <span class="nav-index-elements">
                        <a href="\" title="Volver al inicio">Inicio</a>
                    </span>
                </div>
                <?php


            }
        }
 
    ?>
    
</header>