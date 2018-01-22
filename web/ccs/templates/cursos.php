<div id="speakers" class="photo_carousel carousel slide wow fadeInUp">

  <!-- Indicators -->
  <div class="carousel-indicators">

    <?php 
      $frames = count($data) / 2;
      for ($i=0; $i < $frames; $i++) { 
          $div = '<div data-target="#speakers" data-slide-to="';
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
          <figure class="eventime_img">
            <?php if ( $data[$i]['curso_imagen'] != '' ) : ?>
            <img src="<?php echo UPLOADCONTENT . '/'. $data[$i]['curso_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
            <?php else : ?>
              <img src="<?php echo URLBASE; ?>/images/complejo/generico.png" alt="Complejo Cultural Sanidad "/>
            <?php endif; ?>
          <figcaption>
          <h2>
            <?php echo $data[$i]['curso_titulo']; ?>
          </h2>
          <p>
             <?php echo $data[$i]['curso_subtitulo']; ?>
          </p>
          <a href="#myModal<?php echo $i+1; ?>" data-toggle="modal">
          ver</a>
          </figcaption>
          </figure>
          
          <?php if ( count($data) >= $i+2 ) : ?>

            <figure class="eventime_img">
              <?php if ( $data[$i+1]['curso_imagen'] != '' ) : ?>
              <img src="<?php echo UPLOADCONTENT . '/'. $data[$i+1]['curso_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
              <?php else : ?>
                <img src="<?php echo URLBASE; ?>/images/complejo/generico.png" alt="Complejo Cultural Sanidad "/>
              <?php endif; ?>
            <figcaption>
            <h2>
              <?php echo $data[$i+1]['curso_titulo']; ?>
            </h2>
            <p>
               <?php echo $data[$i+1]['curso_subtitulo']; ?>
            </p>
            <a href="#myModal<?php echo $i+2; ?>" data-toggle="modal">
            ver</a>
            </figcaption>
            </figure>
          <?php endif; ?>
          
        </div>
      </div>

    <?php } ?>

   <!-- cierre div carrousel --> 
  </div>

  
  <!-- Carousel nav -->
  <a class="left_arrow" href="#speakers" data-slide="prev">
  <svg width="26px" height="48">
  <polygon points="3.3,24.5 25.5,2.3 24,0.8 0.3,24.5 24,48.2 25.5,46.7"/>
  </svg>
  </a>
  <a class="right_arrow" href="#speakers" data-slide="next">
  <svg width="26px" height="48">
  <polygon points="22.5,24.5 0.3,2.3 1.8,0.8 25.5,24.5 1.8,48.2 0.3,46.7"/>
  </svg>
  </a>
</div>