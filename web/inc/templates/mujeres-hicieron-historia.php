<?php 
$pagina = getPageData(3);
$titulo = $pagina['page_titulo'];
$texto = $pagina['page_text'];
$extra = $pagina['page_extra'];

if ( $pagina['page_imagen'] != '') {
    $src = urlBase() . '/uploads/images/' . $pagina['page_imagen'];
} else {
    $src = urlBase() . '/assets/images/mujeres-header.jpg';
}

?>
<article id="mujeres" class="wrapper-home">
    <div class="wrapper-image-header">
        <h1 class="sr-only"><?php echo $titulo; ?></h1>
        <figure>
            <img src="<?php echo $src; ?>" alt="Mujeres que hicieron historia banner">
        </figure>

        <div class="headliner">
            <?php echo $extra; ?>
        </div>
        
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
                                } else {
                                    echo '<span class="name-default">'.$mujer['titulo'].'</span>';
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

            <div class="footliner">
                <?php echo $texto; ?>
            </div>
        </div>

        <div id="mujer_info">
            <div class="wrapper">
                <div class="wrapper-mujer-contenido">
                    <button class="close-button"></button>
                    <div class="mujer-contenido"></div>
                </div>
            </div>
        </div>

    </div>
</article>