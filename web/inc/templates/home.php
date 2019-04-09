<?php 
/*pagina de inicio autoadministrable
 * @since 4.0
 *
 *   1.ESPACIO AUDIOVISUAL:
 *   Título, video, parrafo
 *   2. VOCES:
 *   imagen, parrafo
 *   3. AFILIATE:
 *   titulo, texto, imagen, url
 *   4. BANNERS CUADRADOS:
 *   Cambio de fotos
 *   5. CONECTADOS:
 *   Texto y video
 *   6. FRASE (ya que estamos):
 *  texto
 *
*/



$homeContent = getHome();

//videos
$audiovisualVideo = explode('=', $homeContent['audiovisual']['video']);
$conectadosVideo = explode('=', $homeContent['conectados']['video']);


?>
<article id="home-page" class="wrapper-home">
    <!--------- header -------------->
    <header class="header-home">
        <?php
            getSliders( 'home' );
        ?>
        <nav class="menu-shorcuts-wrapper">
            <div class="container">
                <ul class="menu-shortcuts">
                    <li>
                        <a href="/ccs/" target="_blank" title="Complejo Cultural Sanidad">
                        <img src="assets/images/logos/ccs-logo-nuevo.png" alt="logo">
                            <span class="sr-only">Complejo Cultural</span>
                        </a>
                    </li>
                    <li>
                        <a href="instituto-amado-olmos" title="Instituto Amado Olmos">
                            <img src="assets/images/logos/instituto-logo.png" alt="logo">
                            <span class="sr-only">Escuela de enfermería</span>
                        </a>
                    </li>
                    <li>
                        <a href="laboratorio-simulacion" title="Laboratorio de Simulación">
                            <img src="assets/images/logos/cesica-logo.png" alt="logo">
                            <span class="sr-only">Laboratorio de Simulación</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <!--------- section: otros links -------------->
    <section class="otros-links-home-wrapper">
        <div class="container-fluid">
            <ul class="otros-links-home">
                <li>
                    <article class="article-otro-link" id="espacio-audiovisual">
                        <div class="wrapper-iframe-video">
                            <iframe src="https://www.youtube.com/embed/<?php echo $audiovisualVideo[1]; ?>?rel=0" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="data-link">
                                <div class="container-fluid">
                                    <h1>
                                        <?php echo $homeContent['audiovisual']['titulo']; ?>
                                    </h1>
                                    <p>
                                        <?php echo $homeContent['audiovisual']['parrafo']; ?>
                                    </p>
                                </div>
                            </div>
                    </article>
                </li>
                
                 <li>
                    <article class="article-otro-link">
                        <figure>
                            <img src="uploads/images/<?php echo $homeContent['voces']['imagen']; ?>" alt="Espacio Audiovisual">
                        </figure>
                        <div class="data-link">
                            <div class="container-fluid">
                                <h1>
                                    <?php echo $homeContent['voces']['titulo']; ?>
                                </h1>
                                <p>
                                    <?php echo $homeContent['voces']['parrafo']; ?>
                                </p>
                                <a href="<?php echo $homeContent['voces']['url']; ?>" target="_blank" class="read-more-btn">¡Visitanos!</a>
                                <form method="post" id="subscribe-form" name="subscribe-form">
                                    <input type="email" name="email-subs" placeholder="ingresa tu email" required>
                                    <input type="submit" value="Subscribirse">
                                    <span class="load-ajax-suscribe">Gracias por suscribirse, revisa tu bandeja de entrada</span>
                                </form>
                            </div>
                        </div>
                    </article>
                </li>
                
                 <li>
                    <a href="<?php echo $homeContent['afiliate']['url']; ?>" title="Afiliate">
                        <article class="article-otro-link">
                            <figure>
                                <img src="uploads/images/<?php echo $homeContent['afiliate']['imagen']; ?>" alt="Afiliate a ATSA">
                            </figure>
                            <div class="data-link">
                                <div class="container-fluid">
                                    <h1>
                                        <?php echo $homeContent['afiliate']['titulo']; ?>
                                    </h1>
                                    <p>
                                        <?php echo $homeContent['afiliate']['parrafo']; ?>
                                    </p>
                                    <a href="<?php echo $homeContent['afiliate']['url']; ?>" class="read-more-btn">Afiliate aquí</a>
                                </div>
                            </div>
                        </article>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    
    <!--------- section: otras noticias -------------->
    <section>
        <div class="noticias-destacadas-wrapper">
            <div class="container-fluid">
                <ul class="noticias-destacadas">
                    <li>
                        <a href="sanidad-solidaria">
                        <article class="noticia-destacada">
                            <figure>
                                <img src="uploads/images/<?php echo $homeContent['banners'][0]; ?>" class="img-responsive">
                            </figure>
                        </article>
                        </a>
                    </li>
                    <li>
                        <a href="celeste-y-blanca">
                        <article class="noticia-destacada">
                            <figure>
                                <img src="uploads/images/<?php echo $homeContent['banners'][1]; ?>" class="img-responsive">
                            </figure>
                        </article>
                        </a>
                    </li>
                    <li>
                        <a href="programas-prevencion">
                        <article class="noticia-destacada">
                            <figure>
                                <img src="uploads/images/<?php echo $homeContent['banners'][2]; ?>" class="img-responsive">
                            </figure>
                        </article>
                        </a>
                    </li>
                    <li>
                        <a href="trabajadores">
                        <article class="noticia-destacada">
                            <figure>
                                <img src="uploads/images/<?php echo $homeContent['banners'][3]; ?>" class="img-responsive">
                            </figure>
                        </article>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    
    <!--------- section: conectados -------------->
    
    <section>
        <div class="secction-conectados-wrapper">
            <div class="container-fluid" style="width:100%">
                <div class="conectados-content">
                    <?php echo $homeContent['conectados']['texto']; ?>
                    
                    <p><a href="<?php echo $homeContent['conectados']['url']; ?>" target="_blank" rel="external">Ver más videos</a></p>
                </div>
                
                <div class="conectados-video">
                    <div class="wrapper-iframe-video">
                        <iframe src="https://www.youtube.com/embed/<?php echo $conectadosVideo[1]; ?>" frameborder="0" allowfullscreen></iframe>
                     </div>
                </div>
            </div>
        </div>
    
    </section>
    
    <!--------- section: quote - footer del home -------------->
    <footer class="footer-home">
        
        <q>
            <div class="container-fluid">
                <?php echo $homeContent['frase']; ?>
            </div>
        </q>
    </footer>
    <aside>
        <div id="ri-grid" class="ri-grid ri-grid-size-2">
            <img class="ri-loading-image" src="assets/images/loading.gif"/>
            <ul>
                <li><a href="#"><img src="uploads/images/grid-home/01.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/02.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/03.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/04.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/05.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/06.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/07.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/08.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/09.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/10.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/11.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/12.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/13.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/14.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/15.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/16.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/10.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/11.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/12.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/13.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/14.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/15.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/16.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/17.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/18.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/19.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/20.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/21.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/22.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/23.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/24.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/25.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/26.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/27.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/28.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/29.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/30.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/31.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/32.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/33.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/34.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/35.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/36.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/37.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/38.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/39.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/40.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/41.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/42.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/43.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/44.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/45.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/46.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/47.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/48.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/49.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/50.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/51.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/52.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/53.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/54.jpg"/></a></li>
                <li><a href="#"><img src="uploads/images/grid-home/55.jpg"/></a></li>
            </ul>

        </div>
    </aside>
</article><!-- // .wraper-home -->

<script src="js/jquery.gridrotator.js"></script>
<script>
    $(function() {
            
                $( '#ri-grid' ).gridrotator( {
                    rows        : 2,
                    columns     : 10,
                    animType    : 'fadeInOut',
                    animSpeed   : 1000,
                    interval    : 600,
                    step        : 1,
                    w320        : {
                        rows    : 3,
                        columns : 4
                    },
                    w240        : {
                        rows    : 3,
                        columns : 4
                    }
                } );
            
            });
</script>
