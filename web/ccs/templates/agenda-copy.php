<?php 

$agenda =    [
         "VIERNES 01 SEP","01", "Septiembre",
         "VIERNES 08 SEP","08", "Septiembre",
         "SABADO 09 SEP", "09", "Septiembre", 
         "SABADO 16 SEP", "16",  "Septiembre"
         ];
/*
1 COL: HORA
2 COL: TEXTO
3 COL: SUBTITULO
4 COL: Color: green, violet, lightblue o lo que se quiera poner
*/
 
$dia1 = [  
        "21:00 hs | La Peña de la Sanidad| | blue",
        "21:00 hs | La Peña de la Sanidad| | blue",
        "21:00 hs | La Peña de la Sanidad| | blue",

     ];



 $dia2 = [ 
        "19:30 hs | Muestra de pintura y escultura | 'En el principio...' de Alfredo Bravo | violet"
    ]; 


 $dia3 = [
    "20:00 hs | Obra de teatro 'Los años oscuros' | En 1978 un grupo de jóvenes universitarios busca intensamente a su amigo Eduardo.    En Argentina, el mundial escondía la obra macabra de muertes y desapariciones orquestada por  la dictadura militar. En honor a la verdad y la justicia, los protagonistas asumen el compromiso de informar lo que está sucediendo poniendo en peligro sus vidas. Los gritos del pueblo festejando los goles se contraponen a los gritos desgarradores de aquellos que están siendo torturados. Entonces solo queda emprender una lucha desigual y peligrosa para resistir y encontrar al fin la luz.    
  | violet"
    ];

     
$dia4 = [  
    "20:00 hs | Obra de Títeres para adultos 'Oscar' | Óscar Adelmar Ortiga, quizás el arquero más recordado por unos pocos, pero el menos recordado por unos cuantos. Sueños y frustraciones de un arquero de fútbol que no pudo ser. Óscar es la historia de un deportista que pudo llegar a estar en lo más alto de su categoría pero que por esas vicisitudes de la vida, terminó en lo más bajo de un desolado bar de Liniers. Es aquí donde Óscar, una noche, encuentra a alguien que lo escucha, un simple pibe de barrio que está de turno en aquel sucucho. | violet"
    ];
?>
<!-- Carousel indicators -->
<div id="sh_carousel" class="carousel slide">
    <div class="carousel-indicators">
      <div class=" wow fadeInDown btn eventime_button graybtn graytxt" data-target="#sh_carousel" data-slide-to="0">
         <?php
	     	echo $agenda[0];    
	     ?>
      </div>
      <div class=" wow fadeInDown btn eventime_button graybtn graytxt" data-target="#sh_carousel" data-slide-to="1">
         <?php
	     	echo $agenda[3];    
	     ?>
      </div>
      <div class=" wow fadeInDown btn eventime_button graybtn graytxt" data-target="#sh_carousel" data-slide-to="2">
         <?php
	     	echo $agenda[6];    
	     ?>
      </div>
        <div class=" wow fadeInDown btn eventime_button graybtn graytxt" data-target="#sh_carousel" data-slide-to="3">
         <?php
	     	echo $agenda[9];    
	     ?>      
	     </div>
    </div>
    
    <!-- Carousel items -->
    <div class="carousel-inner">
      <div class="active item">
        <!-- DAY FOUR -->
        <p>
        <div class="schedule_date wow fadeInLeft">
           <?php
	           echo $agenda[1];
	           ?>
        </div> 
        <div class="schedule_month wow fadeInRight">
            <?php
	           echo $agenda[2];
	           ?>
        </div></p>
       
        <!-- Accordion item -->
        
        
       
        <div class="mini_gap">
        </div>
        <div id="accordion1">
	        
	         <?php
	       foreach($dia1 as $dia)
	    	{
		     $split = preg_split("/[|]+/", $dia);
	    ?>
          <div class="wow fadeInDown panel">
            <a data-toggle="collapse" data-parent="#accordion3" href="#four_one">
            <div class="accordion_left">
              <div class="accordions_titles">
                <p class="accordion_date">
                   <?php echo($split[0]); ?>
                </p>
              </div>
            </div>
            <div class="accordion_right">
              <div class="accordions_titles">
                <div class="accordion_description">
                   <p style="color:<?php echo $split[3] ?>">
                     <?php echo($split[1]); ?>
                  </p>
                  <p class="name">
                    <?php echo($split[2]); ?>
                   </p>
                </div>
              </div>
            </div>
            </a>
          </div>
         
           <?php
	           }
	       ?>
            
          
          <a href="#reservation_menu" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Reservar
          </a>
          <!-- End of the accordion -->
        </div>
        <!-- End of the day -->
      </div>
      
      
      
      
      <div class="item">
        <!-- DAY FOUR -->
        <p>
        <div class="schedule_date wow fadeInLeft">
             <?php
	           echo $agenda[4];
	           ?>

        </div> 
       
        <div class="schedule_month wow fadeInRight">
             <?php
	           echo $agenda[5];
	           ?>

        </div></p>
        <!-- Accordion item -->
        <div class="mini_gap">
        </div>
        <div id="accordion2">
           <?php
	       foreach($dia2 as $dia)
	    	{
		     $split = preg_split("/[|]+/", $dia);
	    ?>
          <div class="wow fadeInDown panel">
            <a data-toggle="collapse" data-parent="#accordion3" href="#four_one">
            <div class="accordion_left">
              <div class="accordions_titles">
                <p class="accordion_date">
                   <?php echo($split[0]); ?>
                </p>
              </div>
            </div>
            <div class="accordion_right">
              <div class="accordions_titles">
                <div class="accordion_description">
                   <p style="color:<?php echo $split[3] ?>">
                     <?php echo($split[1]); ?>
                  </p>
                  <p class="name">
                    <?php echo($split[2]); ?>
                   </p>
                </div>
              </div>
            </div>
            </a>
          </div>
         
           <?php
	           }
	       ?>
	       
	        <a href="#reservation_menu" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Reservar
          </a>

        </div>
        <!-- End of the day -->
      </div>
      
      
      
      <div class="item">
        <!-- DAY FOUR -->
        <p>
        <div class="schedule_date wow fadeInLeft">
             <?php
	           echo $agenda[7];
	           ?>

        </div> 
        <div class="schedule_month wow fadeInRight">
             <?php
	           echo $agenda[8];
	           ?>

        </div></p>
       
        <!-- Accordion item -->
        <div class="mini_gap">
        </div>
        <div id="accordion3">
         
            <?php
	       foreach($dia3 as $dia)
	    	{
		     $split = preg_split("/[|]+/", $dia);
	    ?>
          <div class="wow fadeInDown panel">
            <a data-toggle="collapse" data-parent="#accordion3" href="#four_one">
            <div class="accordion_left">
              <div class="accordions_titles">
                <p class="accordion_date">
                   <?php echo($split[0]); ?>
                </p>
              </div>
            </div>
            <div class="accordion_right">
              <div class="accordions_titles">
                <div class="accordion_description">
                   <p style="color:<?php echo $split[3] ?>">
                     <?php echo($split[1]); ?>
                  </p>
                  <p class="name">
                    <?php echo($split[2]); ?>
                   </p>
                </div>
              </div>
            </div>
            </a>
          </div>
         
           <?php
	           }
	       ?>

         
           <a href="#reservation_menu" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Reservar
          </a>
          <!-- End of the accordion -->
        </div>
        <!-- End of the day -->
      </div>

      
      
      <div class="item">
        <!-- DAY FOUR -->
        <p>
        <div class="schedule_date wow fadeInLeft">
             <?php
	           echo $agenda[10];
	           ?>

        </div> 
        <div class="schedule_month wow fadeInRight">
             <?php
	           echo $agenda[11];
	           ?>

        </div></p>
       
        <!-- Accordion item -->
        <div class="mini_gap">
        </div>
        <div id="accordion4">
             <?php
	       foreach($dia4 as $dia)
	    	{
		     $split = preg_split("/[|]+/", $dia);
	    ?>
          <div class="wow fadeInDown panel">
            <a data-toggle="collapse" data-parent="#accordion3" href="#four_one">
            <div class="accordion_left">
              <div class="accordions_titles">
                <p class="accordion_date">
                   <?php echo($split[0]); ?>
                </p>
              </div>
            </div>
            <div class="accordion_right">
              <div class="accordions_titles">
                <div class="accordion_description">
                   <p style="color:<?php echo $split[3] ?>">
                     <?php echo($split[1]); ?>
                  </p>
                  <p class="name">
                    <?php echo($split[2]); ?>
                   </p>
                </div>
              </div>
            </div>
            </a>
          </div>
         
           <?php
	           }
	       ?>
           
          
          <a href="#reservation_menu" class="schedule_reservation wow btn eventime_button  fadeInRight">
           Reservar
          </a>
          <!-- End of the accordion -->
        </div>
        <!-- End of the day -->
      </div>     

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