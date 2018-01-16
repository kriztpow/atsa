<div class="rel_photos">
    <div id="photos" class="photo_carousel light carousel slide">
      <!-- Indicators -->
      <div class="carousel-indicators">

        <?php 
            $frames = count($data) / 2;
            for ($i=0; $i < $frames; $i++) { 
                $div = '<div data-target="#photos" data-slide-to="';
                $div .= $i;
                $div .= '" class="photo_carousel_ind';
                if ($i==0) {
                    $div .= ' active';    
                }
                $div .= '"></div>';

                echo $div;
            }
        ?>
        
      </div>
      <!-- Wrapper for Slides -->
      <div class="carousel-inner">
        
        <?php for ($i=0; $i < count($data); $i+=2) { ?>
            <div class="item <?php if ($i == 0) { echo 'active'; } ?>">
              <div class="photo_carousel_container">

                <?php if ( $data[$i]['slider_imagen'] != '' ) : ?>

                    <figure class="eventime_img">
                    <img src="<?php echo UPLOADCONTENT . '/'. $data[$i]['slider_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
                    <figcaption>
                    <h2>
                        <?php 
                            $titulo1 = explode('-', $data[$i]['slider_titulo']);

                            echo $titulo1[0] . '<span>' . $titulo1[1] , '</span>';
                        ?>
                    </h2>
                    <a href="#imgmodal_<?php echo $i+1?>" data-toggle="modal">
                    ver</a>
                    </figcaption>
                    </figure>

                <?php endif; ?>

                <?php if ( count($data) >= $i+2 ) : ?>
                    <?php if ( $data[$i+1]['slider_imagen'] != '' ) : ?>
                        <figure class="eventime_img">
                        <img src="<?php echo UPLOADCONTENT . '/'. $data[$i+1]['slider_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
                        <figcaption>
                        <h2>
                            <?php 
                                $titulo1 = explode('-', $data[$i+1]['slider_titulo']);

                                echo $titulo1[0] . '<span>' . $titulo1[1] , '</span>';
                            ?>
                        </h2>
                        <a href="#imgmodal_<?php echo $i+2?>" data-toggle="modal">
                        ver </a>
                        </figcaption>
                        </figure>
                    <?php endif; ?>
                <?php endif; ?>

              </div>
            </div>
        <?php } ?>
      
	</div>
      
    <!-- Carousel nav -->
      <a class="left_arrow" href="#photos" data-slide="prev">
      <svg width="26px" height="48">
      <polygon points="3.3,24.5 25.5,2.3 24,0.8 0.3,24.5 24,48.2 25.5,46.7"/>
      </svg>
      </a>
      <a class="right_arrow" href="#photos" data-slide="next">
      <svg width="26px" height="48">
      <polygon points="22.5,24.5 0.3,2.3 1.8,0.8 25.5,24.5 1.8,48.2 0.3,46.7"/>
      </svg>
      </a>
    </div>
</div>