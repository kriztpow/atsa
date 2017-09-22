<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.3
 * SLIDERS TEMPLATE
 * html de los sliders, los datos se la pasa la función getsliders()
*/
?>

<!-- #slider -->
<div class="slider-wrapper">
    <div class="">
        <div class="slider">
            <div class="loader-slider">
                <img src="assets/images/loader.gif">
            </div>
            <ul class="slides">
            <?php
            for ($i=0; $i < count($data); $i++) { ?>    
                <!-- slide item -->
                <li class="slide-item">
                    <?php if ( $data[$i]['slider_link'] != '' ) { ?>
                    <a href="<?php echo $data[$i]['slider_link'] ?>">
                    <?php } else { ?>
                    <a>
                    <?php } ?>
                        <article>
                            <figure class="slide-background-img">
                                <img src="uploads/images/<?php echo $data[$i]['slider_imagen']; ?>">
                            </figure>
                            
                            <?php if ($data[$i]['slider_titulo'] != '' || $data[$i]['slider_texto'] != '') { ?>
                            <div class="slide-data">
                            <?php } else { ?>
                            <div class="slide-data slide-data-transparent">
                            <?php } ?>
                                <h1 class="slide-title">
                                    <a href="<?php echo $data[$i]['slider_link'] ?>" title="Leer más">
                                    <?php echo $data[$i]['slider_titulo'] ?>
                                        <?php if ( $data[$i]['slider_link'] != '' ) { ?>
                                            <span class="slide-link-movil">Leer más</span>
                                        <?php } ?>
                                    </a>
                                </h1>
                                <p class="slide-text">
                                    <?php echo $data[$i]['slider_texto'] ?>
                                    <?php if ( $data[$i]['slider_link'] != '' ) { ?>
                                        <a class="slide-link" href="<?php echo $data[$i]['slider_link'] ?>">Leer más</a>
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