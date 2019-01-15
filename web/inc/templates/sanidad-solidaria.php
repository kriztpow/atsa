<?php 
$pagina = getPageData(8);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];
$texto2 = $pagina['page_extra'];

?>
<article id="sanidad-solidaria" class="wrapper-home">
    <header class="header-solidaria">

    <div class="title-wrapper">
        
        <h1>
            <?php echo $titulo; ?>
        </h1>
        <p>
            <?php echo $texto2; ?>
        </p>
    </div>

        <?php 
        if ( $pagina['page_imagen'] != '') { ?>
            
            <img src="<?php echo urlBase() . '/uploads/images/' . $pagina['page_imagen']; ?>" alt="Sanidad solidaria" class="header-image-solidaria"> 

        <?php } ?>
            
    </header>

    <div class="wrapper-sanidad">
    
        <div class="contenido-texto">
            <div class="container">
                <?php echo $texto; ?>
            </div>
        </div>

        <div class="proyectos-wrapper">
            <div class="container">
                <h2>
                    ¡Conoce nuestros proyectos!
                </h2>

                <ul class="lista-proyectos">
                    <?php 
                        $proyectos = array(
                            array(
                                'imagen'=> 'proyecto1-foto.jpg',
                                'titulo'=> 'Día del niño solidario',
                                'href'=> 'dia-del-nino-solidario',
                            ),
                            array(
                                'imagen'=> 'proyecto1-foto.jpg',
                                'titulo'=> 'Sanidad todo terreno',
                                'href'=> 'sanidad-todo-terreno',
                            ),
                            array(
                                'imagen'=> 'proyecto3-foto.jpg',
                                'titulo'=> 'Enseñá Sanidad',
                                'href'=> 'ensena-sanidad',
                            ),
                            array(
                                'imagen'=> 'proyecto4-foto.jpg',
                                'titulo'=> 'Colecta navideña',
                                'href'=> 'colecta-navidena',
                            ),
                            array(
                                'imagen'=> 'proyecto5-foto.jpg',
                                'titulo'=> 'Colecta de invierno',
                                'href'=> 'colecta-de-invierno',
                            ),
                        );
                        foreach ($proyectos as $proyecto) { ?>
                            <li>
                                <a href="<?php echo urlBase() . '/' . $proyecto['href']; ?>">
                                    <article class="proyecto-solidaria">
                                        <figure class="image-solidaria">
                                            <img src="<?php echo urlBase() . '/uploads/images/' . $proyecto['imagen']; ?>" alt="<?php echo $proyecto['titulo']; ?>">
                                            <span class="shutter"></span>
                                        </figure>

                                        <h1>
                                            <?php echo $proyecto['titulo']; ?>
                                        </h1>
                                    </article>
                                </a>
                            </li>
                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="wrapper-form">
            <div class="container">
                <h2>
                    ¿Te gustaría participar?
                </h2>

                <p>
                    ¡Completá el formulario y nos ponemos en contacto con vos!
                </p>
            </div>
            <form method="POST" name="sanidad_formulario" id="sanidad_formulario">
                <div class="container">
                    <label for="nombre">
                        <span class="label">Nombre:</span>
                        <input type="text" name="nombre">
                    </label>
                    <label for="apellido">
                        <span class="label">Apellido:</span>
                        <input type="text" name="apellido">
                    </label>
                    <label for="dni">
                        <span class="label">DNI:</span>
                        <input type="text" name="dni">
                    </label>
                    <label for="email">
                        <span class="label">Email:</span>
                        <input type="email" name="email">
                    </label>
                    <label for="telefono">
                        <span class="label">Teléfono:</span>
                        <input type="text" name="telefono">
                    </label>
                    <label for="mensaje">
                        <span class="label">Mensaje:</span>
                        <input type="text" name="mensaje">
                    </label>
                    
                    <div class="wrapper-submit">
                        <button type="submit">Enviar</button>
                    </div>

                    <div class="msj-exito">Mensaje enviado con éxito</div>
                    <div class="msj-error">Falló al enviar su mensaje, intente de nuevo</div>
                </div>
            </form>
            
        </div><!---wrapper-form-->

        <div class="solidaria-comedor-wrapper">
            <div class="container">
                <div class="upper">
                    <div class="video-wrapper">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/J2-oQO6y_7o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="contenido">
                        <h2>
                            Sanidad Solidaria<br>
                            Comedor "Papa Francisco"
                        </h2>
                        
                        <a href="#">
                            Ver más
                        </a>
                    </div>
                </div>
                <div class="galeria-fotos">
                    <ul id="galeria-comedor" class="owl-carousel">
                        <?php 
                        $imagenes = array(
                            array('src'=>'cpf-foto1.jpg', 'alt'=> 'Comedor "Papa Francisco"' ),
                            array('src'=>'cpf-foto2.jpg', 'alt'=> 'Comedor "Papa Francisco"' ),
                            array('src'=>'cpf-foto3.jpg', 'alt'=> 'Comedor "Papa Francisco"' ),
                            array('src'=>'cpf-foto4.jpg', 'alt'=> 'Comedor "Papa Francisco"' ),
                            array('src'=>'cpf-foto5.jpg', 'alt'=> 'Comedor "Papa Francisco"' ),
                        );

                        foreach ($imagenes as $imagen ) { ?>
                            <li>
                                <img src="<?php echo urlBase() . '/uploads/images/' . $imagen['src']; ?>" alt="<?php echo $imagen['alt']; ?>">
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</article>
<script src="<?php echo urlBase() . '/js/owl.carousel.min.js'; ?>"></script>
<script>
    $(window).on('load', function(){

        $('#galeria-comedor').owlCarousel({
            loop:true,
            margin:50,
            autoplay:true,
            autoplayTimeout:3000,
            nav:false,
            //navText : ['<span class="icon-arrow icon-arrow-left"></span>','<span class="icon-arrow icon-arrow-right"></span>'],
            //dots:true,
            responsive:{
                0:{
                    items:2
                },
                992:{
                    items:5
                },
            },
        });
    });
</script>