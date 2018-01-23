<?php 

$events = getAgenda( 4 );

if ($events) : 

$mesesAbr  = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
$meses  = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado');

?>

<!-- Carousel indicators -->
<div id="sh_carousel" class="carousel slide">
    <div class="carousel-indicators">
      
      <?php 
      $fechaLinks = '';
        for ($i=0; $i < count($events); $i++) { 
          $date = $events[$i]['agenda_fecha_in'];

          if ( $fechaLinks === date("Y-m-d", strtotime($date)) ) {
            continue;
          } else {
            $fechaLinks = date("Y-m-d", strtotime($date));
          }
          ?>
        
        <div class=" wow fadeInDown btn eventime_button graybtn graytxt" data-target="#sh_carousel" data-slide-to="<?php echo $i; ?>">
          <?php 
        
          $fechaEvento = $dias[date("w", strtotime($date))] . ' ' . date("d", strtotime($date)) .' de '. $mesesAbr[date("n", strtotime($date))-1];

          echo $fechaEvento;

          ?>
        
        </div>
        
      <?php }//for ?>
      
    </div>
    
    
    <div class="carousel-inner">

      <!-- Carousel items -->

      <?php 
      $diaIndice = '';

      for ($i=0; $i < count($events); $i++) { 
        $event = $events[$i];
        $date = $event['agenda_fecha_in'];

        if ( $diaIndice != date("Y-m-d", strtotime($date)) ) {
          //si el día no es igual entonces primero hay que crear el día
          $diaIndice = date("Y-m-d", strtotime($date));
          $dia = date("d", strtotime($date));
          $month = $meses[date("n", strtotime($date))-1];
          
          ?>
          <div class="item<?php if ($i == 0) { echo ' active'; } ?>">
          <p>
            <div class="schedule_date wow fadeInLeft">
               <?php echo $dia; ?>
            </div> 
            <div class="schedule_month wow fadeInRight">
                <?php echo $month; ?>
            </div>
          </p>
       
          <div class="mini_gap">
          </div>
          <!-- Accordion item -->

          <div id="accordion1">

            <?php 

              $dayEvents  = getEvensByTheDate ( $diaIndice );

              for ($a=0; $a < count($dayEvents); $a++) { ?> 
                <div class="wow fadeInDown panel">
                  <a data-toggle="collapse" data-parent="#accordion3" href="#four_one">
                  <div class="accordion_left">
                    <div class="accordions_titles">
                      <p class="accordion_date">
                         <?php 
                         $in = date('H:i', strtotime($dayEvents[$a]['agenda_fecha_in']));
                         $out = date('H:i', strtotime($dayEvents[$a]['agenda_fecha_out']));
                         echo $in . ' hs';
                         
                         if ( $dayEvents[$a]['agenda_fecha_out'] != '' && $dayEvents[$a]['agenda_fecha_in'] != $dayEvents[$a]['agenda_fecha_out']) {
                              echo ' - ';
                              echo $out . ' hs';
                            }
                         ?>
                      </p>
                    </div>
                  </div>
                  <div class="accordion_right">
                    <div class="accordions_titles">
                      <div class="accordion_description">
                         <p>
                           <?php echo $dayEvents[$a]['agenda_titulo']; ?>
                        </p>
                        <p class="name">
                          <?php 
                            if ( $dayEvents[$a]['agenda_descripcion'] != '' ) {
                              echo $dayEvents[$a]['agenda_descripcion']; 
                            }
                            ?>
                         </p>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>

              <?php }//for interno ?>
          
          </div> <!-- End of the accordion -->
           
          <a href="#reservation_menu" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Reservar
          </a>
          <?php }//if ?>

        </div><!-- End of the day -->

      <?php }//for ?>














      
          
        

        
        <!-- End of the day -->
      </div><!-- //Carousel items -->    
      

      <!-- Carousel nav -->
      <a class="left_arrow wow fadeInLeft" href="#sh_carousel" data-slide="prev">
      <svg width="26px" height="48">
      <polygon points="3.3,24.5 25.5,2.3 24,0.8 0.3,24.5 24,48.2 25.5,46.7"/>
      </svg>
      </a>
      <a class="right_arrow wow fadeInRight" href="#sh_carousel" data-slide="next">
      <svg width="26px" height="48">
      <polygon points="22.5,24.5 0.3,2.3 1.8,0.8 25.5,24.5 1.8,48.2 0.3,46.7"/>
      </svg>
      </a>
      <div class="gap">
      </div>
    </div>
    
    <div class="btn-calendario-wrapper">
      <a href="<?php echo URLBASE; ?>/calendario.php" target="_blank" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Ver calendario
      </a>
    </div>

  </div>
</div>

<?php else : ?>

  <div class="notes-wrapper">No hay ningun evento cargado.</div>
  <div class="btn-calendario-wrapper">
      <a href="<?php echo URLBASE; ?>/calendario.php" target="_blank" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Ver calendario
      </a>
    </div>

<?php endif;