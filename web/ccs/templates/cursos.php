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
    <!-- 
    <div class="item active">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/bateria.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Bateria <span> </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalbateria" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/canto1.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Canto 
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalcanto" data-toggle="modal">
        ver </a>
        </figcaption>
        </figure>
        
      </div>
    </div>
    <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Cerámica<span></span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalceramica" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Cerámica con experiencia<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalceramicaxp" data-toggle="modal">
        ver </a>
        </figcaption>
        </figure>
      </div>
    </div>
    
    <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/chikung.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Chi Kung <span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalchi" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Comedia Musical <span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalcomedia" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Danzas árabes<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalarabe" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/dinpintadu.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Dibujo y Pintura<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaldibujo" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Folklore<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalfolk" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/foto1.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Fotografía<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalfoto" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/guitarra.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Guitarra<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalguitarra" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/makeup.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Maquillaje artístico<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalmaq" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/makeup.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Maquillaje Social<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalms" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/salsa.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Salsa<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalsalsa" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
 
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/porce.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Porcelana Fría<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalpf" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/porce.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Porcelana Fría con experiencia<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalpfxp" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/yoga.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Yoga<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalyoga" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Zumba<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModalzumba" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
 
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/trompeta.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Trompeta<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltrom" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/tela.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Telas<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltel" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/tela.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Telas con experiencia<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltelxp" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Teatro<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltea" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/tango.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Tango<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltan" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/tee.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Taller de Escritura Literaria<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltal" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
 
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/chikung.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Tai chi<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltai" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Taller de Música madres e hijos<span>
        </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltmm" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
 
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/teatrotexto.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Teatro de textos<span>
          </span>
        </h2>
        <p>
           Jóvenes y Adultos
        </p>
        <a href="#myModaltte" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/canto1.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Canto<span>
        </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModalcan" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Cerámica<span>
          </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModalcer" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        folklore<span>
        </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModalflk" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/porce.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Porcelana Fría con experiencia<span>
          </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModalpfv" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/tee.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Taller de escritura literaria<span>
        </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModaltlv" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/tango.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Tango<span>
          </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModaltav" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/teatrov.jpg" alt="img10"/>
        <figcaption>
        <h2>
        Teatro<span>
        </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModaltev" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/yoga.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Yoga<span>
          </span>
        </h2>
        <p>
           Vitalicios
        </p>
        <a href="#myModalyov" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Juego, expresión y movimiento <span>
        </span>
        </h2>
        <p>
           Niños (3 a 5 años)
        </p>
        <a href="#myModaljun" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Iniciación al mundo de la música<span>
          </span>
        </h2>
        <p>
           Niños (3 a 5 años)
        </p>
        <a href="#myModalimm" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Iniciación al mundo de la danza  <span>
        </span>
        </h2>
        <p>
           Niños (3 a 5 años)
        </p>
        <a href="#myModalimd" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  <
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Acrobacia aérea<span>
          </span>
        </h2>
        <p>
           Niños
                         </p>
        <a href="#myModalaae" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Acrobacia aérea con experiencia<span>
        </span>
        </h2>
        <p>
           Niños
        </p>
        <a href="#myModalaaexp" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
  
  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/guitarra.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Guitarra<span>
          </span>
        </h2>
        <p>
           Niños (6 a 12 años)</p>
        <a href="#myModalgtr" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Dibujo y pintura<span>
        </span>
        </h2>
        <p>
           Niños
        </p>
        <a href="#myModaldyp" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>

  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img09"/>
        <figcaption>
        <h2>
        Gym y circo<span>
          </span>
        </h2>
        <p>
           Niños</p>
        <a href="#myModalgyc" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Iniciación musical y ensamble<span>
        </span>
        </h2>
        <p>
           Niños (6 a 9 años)
        </p>
        <a href="#myModalime" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>

  <div class="item">
      <div class="photo_carousel_container">
        <figure class="eventime_img">
        <img src="images/complejo/teatroiniciacioon.jpg" alt="img09"/>
        <figcaption>
        <h2>
        Teatro<span>
          </span>
        </h2>
        <p>
           Niños</p>
        <a href="#myModalten" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
        
        <figure class="eventime_img">
        <img src="images/complejo/generico.png" alt="img10"/>
        <figcaption>
        <h2>
        Danzas árabes <span>
        </span>
        </h2>
        <p>
           Niños               </p>
        <a href="#myModaldaz" data-toggle="modal">
        ver</a>
        </figcaption>
        </figure>
      </div>
    </div>
   -->  




    
    
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