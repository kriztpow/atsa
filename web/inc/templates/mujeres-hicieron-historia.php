<article id="mujeres" class="wrapper-home">
    <div class="wrapper-image-header">
        <h1 class="sr-only">Mujeres q hicieron historia</h1>
        <figure>
            <img src="assets/images/mujeres-header.jpg" alt="Mujeres que hicieron historia banner">
        </figure>

        <p class="headliner">
            Un homenaje a las compañeras que forjaron la historia de nuestro país y que hoy siguen vivas en nuestra lucha cotidiana por una sociedad más justa e igualitaria.
        </p>
        
    </div>

    <div class="wrapper-mujeres">
        <div class="container">
            <ul class="mujeres">
            <?php 
            $mujeres = showMujeresHistoria();

            if ( $mujeres != null ) :

                foreach ( $mujeres as $mujer ) {

                    if ( $mujer['imagen'] != '' ) {
                        $imgSRC = urlBase() . '/uploads/images/' . $mujer['imagen'];
                    } else {
                        $imgSRC = urlBase() . '/assets/images/';
                    }
                    
                    
                    ?>

                    <li>
                        <article class="mujer" data-id="<?php echo $mujer['id']; ?>">
                            <figure class="imagen-mujer">
                                <?php
                                if ( $mujer['imagen'] != '' ) {
                                    echo '<img src="' . urlBase() . '/uploads/images/' . $mujer['imagen'] . '">';
                                    echo '<span class="shutter"></span>';
                                }
                                ?>
                            </figure>
                            <div class="data-mujer">
                                <span class="titulo">
                                    <?php echo $mujer['titulo']; ?>
                                </span>
                                <span class="fecha">
                                    <?php 
                                    if ( $mujer['fecha'] != '' ) {
                                        echo '(' . $mujer['fecha'] . ')';
                                    }
                                    ?>
                                </span>
                            </div>

                            <span class="leer-hover">Leer más</span>

                            <div class="contenido"><?php echo $mujer['texto']; ?></div>
                            
                        </article>
                    </li>

                <?php }

            endif;
            ?>
            </ul>
        </div>

        <div id="mujer_info">
            <div class="wrapper">
                <div class="wrapper-mujer-contenido">
                    <button class="close-button"></button>
                    <div class="mujer-contenido">
                        hola
                    </div>
                </div>
            </div>
        </div>

    </div>
</article>