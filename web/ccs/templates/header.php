<?php
$sliders = getSliders('home');

?>

<header id="home_slider" class="carousel slide">
<!-- Wrapper for Slides -->
<div class="carousel-inner">
  
  <?php 
  for ($i=0; $i < count($sliders); $i++) { ?>
    <div class="item <?php if ($i == 0 ) {echo 'active'; }?>">
    <!-- Set the first background image using inline CSS below. -->
    <div class="fill" style="background-image:url('<?php echo UPLOADCONTENT . '/'. $sliders[$i]['slider_imagen']; ?>');">
    </div>
    <div class="fill_mask">
      <div class="description ">
        <h2 class="details wow fadeInDown">
         <?php echo $sliders[$i]['slider_titulo']; ?>
         </h2>
        <div class="details wow fadeInUp">
          
          <p>
             
          </p>
        </div>
        <div class="details wow fadeInUp">
          <p>
            <?php echo $sliders[$i]['slider_texto']; ?>
          </p>
        </div>
        <div class="buttons ">
          <a class="wow fadeInLeft btn eventime_button" href="<?php echo $sliders[$i]['slider_link']; ?>" role="button">
            <?php echo $sliders[$i]['slider_textoLink']; ?>
          </a>
           
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

</div>
<a class="wow fadeInLeft left_arrow" href="#home_slider" data-slide="prev">
<svg width="26px" height="48">
<polygon points="3.3,24.5 25.5,2.3 24,0.8 0.3,24.5 24,48.2 25.5,46.7"/>
</svg>
</a>
<a class="wow fadeInRight right_arrow" href="#home_slider" data-slide="next">
<svg width="26px" height="48">
<polygon points="22.5,24.5 0.3,2.3 1.8,0.8 25.5,24.5 1.8,48.2 0.3,46.7"/>
</svg>
</a>
</header>