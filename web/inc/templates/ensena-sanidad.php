<?php 
//$pagina = getPageData(8);
$titulo = 'Enseña Sanidad';//$pagina['page_titulo']
$texto = '<p style="text-align:center">Realizamos talleres, charlas informativas y actividades de concientización sobre distintas temáticas, relacionadas a la salud de chicos, chicas, adolescentes, adultos y mayores. Contamos con una oferta de capacitaciones en salud, emergencias, higiene,sexualidad, etc, para trabajar en donde sea necesario. Además, tomamos los datos recolectados durante las actividades <strong>Sanidad Todo Terreno</strong> y así atendemos las necesidades encontradas.</p>';//$pagina['page_text']
$imagen = 'sanidad-solidaria-header2.jpg';//$pagina['page_imagen']

?>
<article id="sanidad-solidaria" class="wrapper-home">
    <header class="header-solidaria-individual">

    <?php 
        if ( $imagen != '') { ?>
            
            <img src="<?php echo urlBase() . '/uploads/images/' . $imagen; ?>" alt="Sanidad solidaria" class="header-image-solidaria-individual"> 

        <?php } ?>

    <div class="title-wrapper">
        
        <img src="<?php echo urlBase() . '/assets/images/logos/logo-solidaria.png'; ?>" alt="Logo Sanidad Solidaria">
        <h1>
            <?php echo $titulo; ?>
        </h1>
    </div>

        
            
    </header>

    <div class="wrapper-sanidad">
    
        <div class="contenido-texto">
            <div class="container">
                <?php echo $texto; ?>
            </div>
        </div>

        <div class="galeria-fotos">
            <div class="container">
                <ul id="galeria-comedor" class="owl-carousel">
                    <?php 
                    $imagenes = array(
                        array('src'=>'es1.jpg', 'alt'=> 'Enseña Sanidad' ),
                        array('src'=>'es2.jpg', 'alt'=> 'Enseña Sanidad' ),
                        //array('src'=>'es3.jpg', 'alt'=> 'Enseña Sanidad' ),
                        //array('src'=>'es4.jpg', 'alt'=> 'Enseña Sanidad' ),
                        //array('src'=>'es5.jpg', 'alt'=> 'Enseña Sanidad' ),
                    );

                    foreach ($imagenes as $imagen ) { ?>
                        <li>
                            <img src="<?php echo urlBase() . '/uploads/images/' . $imagen['src']; ?>" alt="<?php echo $imagen['alt']; ?>">
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    
        <div class="solidaria-comedor-wrapper solidaria-fondo-suave">
            <div class="container">
                <div class="upper">
                    <div class="video-wrapper">
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/AlUgLQRFsmc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="contenido">
                        <h2>
                            Sanidad Solidaria<br>
                            <strong>Enseñá</strong>
                        </h2>
                        
                        <a href="#">
                            Ver más
                        </a>
                    </div>
                </div>
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