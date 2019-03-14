
<article class="resumen-wrapper" data-id="<?php echo $data['post_ID']; ?>">
    <h1 class="titulo-resumen">
        <?php echo $data['post_titulo']; ?>
    </h1>
    
    <div class="contenido-wrapper">
    
    <?php if ( $data['post_contenido'] != '' ) : 
        
        echo $data['post_contenido'];
    
    else : ?>   

        <p>
            <?php echo $data['post_resumen']; ?>
        </p>

    <?php endif; ?>

    </div>  


    <?php if ( $data['post_imagenesGal'] != '' || $data['post_imagen'] != '' || $data['post_video'] != '') : ?>

    <div class="wrapper-medios">
        <?php if ( $data['post_imagenesGal'] != '' || $data['post_imagen'] != '') : ?>
            
            <div class="wrapper-fotos">
                <ul class="owl-carousel nuevocarousel">
                    <?php
                    if ( $data['post_imagen'] != '' ) {
                        echo '<li>';
                        echo '<img src="'.urlBase() . '/uploads/images/'. $data['post_imagen']. '" alt="Atsa Torneos">';
                        echo '</li>';
                     } 
                    if ( $data['post_imagenesGal'] != '' ) {
                        $imagenes = unserialize( $data['post_imagenesGal'] );
                        for ($i=0; $i < count($imagenes); $i++) { 
                            echo '<img src="'.urlBase() . '/uploads/images/'. $imagenes[$i].'" alt="Atsa Torneos">';
                        }
                    }
                    ?>
                </ul>
                
            </div>

        <?php endif; ?>
        
        <?php if ( $data['post_video'] != '' ) : ?>

        <div class="wrapper-video">
            
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo sanitizevideoUrl($data['post_video']); ?>?rel=0" frameborder="0" allowfullscreen></iframe>

        </div>

        <?php endif; ?>
    </div>

    <?php endif; ?>
</article>