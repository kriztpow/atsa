<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * SLIDERS TEMPLATE
 * html de los sliders, los datos se la pasa la función getsliders()
*/
?>

<!-- #slider -->
<div class="slider-wrapper">
    <div class="">
        <div class="slider-recientes">

            <div class="loader-slider">
                <img src="assets/images/loader.gif">
            </div>
            <ul class="slides">
            <?php
            for ($i=0; $i < count($data); $i++) { ?>    
                <!-- slide item -->
                <li class="slide-item">
                    <?php if ( $data[$i]['post_url'] != '' ) { ?>
                    <a href="<?php echo urlBase() . '/noticias/' . $data[$i]['post_url'] ?>">
                    <?php } else { ?>
                    <a>
                    <?php } ?>
                        <article>
                            <figure class="slide-background-img">
                                <img src="uploads/images/<?php echo $data[$i]['post_imagen']; ?>">
                            </figure>
                            
                            <?php if ( $data[$i]['post_titulo'] != '' ) { ?>
                            <div class="slide-data slide-data-recientes">
                            <?php } else { ?>
                            <div class="slide-data slide-data-transparent">
                            <?php } ?>
                                <h1 class="slide-title slide-title-recientes">
                                    <a href="<?php echo urlBase() . '/noticias/' .$data[$i]['post_url'] ?>" title="Leer más">
                                    <?php echo $data[$i]['post_titulo'] ?>
                                        <?php if ( $data[$i]['post_url'] != '' ) { ?>
                                            <span class="slide-link-movil">Leer más</span>
                                        <?php } ?>
                                    </a>
                                </h1>
                                <p class="slide-text">
                                    <?php echo $data[$i]['post_bajada'] ?>
                                    <?php if ( $data[$i]['post_url'] != '' ) { ?>
                                        <a class="slide-link" href="<?php echo urlBase() . '/noticias/' . $data[$i]['post_url'] ?>">Leer más</a>
                                    <?php } ?>
                                </p>
                            </div>
                        </article>
                    </a>
                </li>
                <!-- // slide item -->
            <?php 
            }//for
            ?>                
                
            </ul>
            
            <ul>
                <li class="slider-control-left">
                    <span class="icon-control-left"></span>
                </li>
                <li class="slider-control-right">
                    <span class="icon-control-right"></span>
                </li>
            </ul>
            
        </div>
        
    </div>        
</div><!-- // #slider -->