<?php 
//$pagina = getPageData(8);
$titulo = 'Día del niño Solidario';//$pagina['page_titulo']
$texto = '<p style="text-align:center">El día del niño es una fecha donde se celebra la infancia y se reivindican los derechos d elos niños y niñas. Todos los años desde el sindicato organizamos un festiejo por el Dïa del Niño para nuestros afiliados y sus familias. Lamentablemente, hay muchos chicos que viven en barrios vulnerables en nuestra Ciudad, con grandes necesidades, y que no cuentan con la oportunidad de celebrar su día. Por eso, desde Sanidad Solidaria decidimos organizar y festejar el Día del Niño también en estos barrios.</p>';//$pagina['page_text']
$imagen = 'sanidad-solidaria-header5.jpg';//$pagina['page_imagen']

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
                        array('src'=>'dns1.jpg', 'alt'=> 'Día del niño solidario' ),
                        array('src'=>'dns2.jpg', 'alt'=> 'Día del niño solidario' ),
                        array('src'=>'dns3.jpg', 'alt'=> 'Día del niño solidario' ),
                        array('src'=>'dns4.jpg', 'alt'=> 'Día del niño solidario' ),
                        //array('src'=>'dns5.jpg', 'alt'=> 'Día del niño solidario' ),
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
                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/J2-oQO6y_7o" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="contenido">
                        <h2>
                            Sanidad Solidaria<br>
                            <strong>Bajo Flores</strong>
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