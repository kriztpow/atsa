<!-- Modal HTML -->

<?php

for ($i=0; $i < count($data); $i++) { ?>
  
  <div id="myModal<?php echo $i+1; ?>" class="modal fade eventime_modal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times; </button>
          <h4 class="modal-title">
            <?php echo $data[$i]['curso_titulo']; ?>
          </h4>
          <small>
            <?php echo $data[$i]['curso_subtitulo']; ?>
          </small>
        </div>
        <div class="modal-body">
          <?php if ( $data[$i]['curso_imagen'] != '' ) : ?>
            <img src="<?php echo UPLOADCONTENT . '/'. $data[$i]['curso_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
            <?php else : ?>
              <img src="<?php echo URLBASE; ?>/images/complejo/generico.png" alt="Complejo Cultural Sanidad "/>
            <?php endif; ?>
          <div class="cursos_texto">
            <?php echo $data[$i]['curso_texto']; ?>
            <br>
          </div>
        </div>
        
        <div class="modal-footer">
          <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
          <a href="https://twitter.com/AtsaBsAs"    class="contact_icon fa fa-twitter graybtn graytxt"></a>
          <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
          <div class="cursos-horarios">
            <?php echo $data[$i]['curso_horarios']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>


<!--
<div id="myModalbateria" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Batería</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/bateria.jpg" alt="img10"/>
        <p>
          <br>
           Conceptos básicos e intermedios en ritmología, percusión y batería contemporánea. Estilos indistintos.
          <br>
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Martes<br/>16:00hs a 17:00hs<br/>18:00hs a 19:00hs<br/>19:00hs a 20:00hs<br/>
		<br>
		Jueves<br/>16:00hs a 17:00hs<br/>17:00hs a 18:00hs</div>
    </div>
  </div>
</div>

<div id="myModalcanto" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Canto</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/canto1.jpg" alt="img10"/>
        <p>
          <br>
          El cuerpo es la caja de resonancia, por donde podemos emitir nuestra voz a través de las cuerdas vocales.
Ahí es donde surge el canto sea individual o colectivo.
El canto es para mí, una forma de expresión artística y también un encuentro con lo primitivo, con lo ancestral, un contacto permanente con la tierra.
Nuestras sensaciones pueden ser expresadas a través de las diferentes canciones que elijamos para interpretar, a través del canto.
          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Viernes<br/>17:30hs a 18:30hs<br/>18:30hs a 19:30hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalceramica" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Ceramica</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Un espacio de recreación y aprendizaje al que todo aquel con interés puede acercarse a experimentar las diferentes posibilidades que los materiales cerámicos nos	 brindan.
El objetivo es estimular la creatividad y la expresión personal, conociendo e incorporando las diferentes técnicas de trabajo para la producción cerámica y la realización de piezas escultóricas.
          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Lunes<br/>10:00hs a 12:00hs<br/>17:30hs a 18:30hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalceramicaxp" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Cerámica con experiencia</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
         Es el espacio para seguir desarrollando técnicas de modelado y decorativas (patinas, engobes, esmaltes) donde el alumno puede ir encontrando su medio expresivo. El objetivo es desarrollar un proyecto artístico personal y un trabajo grupal.

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Lunes<br/>18:30hs a 19:30hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalchi" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Chi Kung</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/chikung.jpg" alt="img10"/>
        <p>
          <br>
          Se ha utilizado en China para mejorar la salud durante casi cinco mil años. Es la base del Tai Chi, las artes marciales y la medicina tradicional china. Es el manejo, el desarrollo y almacenamiento de la energía interna, ya sea para realizar ejercicios físicos externos (yang) o bien mantener la vitalidad de los órganos internos (yin), mediante ejercicios simples (similares al Tai Chi) y una correcta respiración.

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Martes<br/>15:00hs a 16:00hs<br/>16:00hs a 17:00hs
	 </div>
    </div>
  </div>
</div>

<div id="myModalcomedia" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Comedia Musical</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
          El curso ensambla las 3 disciplinas: Teatro, canto y danza. El entrenamiento está enfocado en el desarrollo de cada técnico partiendo de un descubrimiento individual integrado a conceptos de ensamble y trabajo en equipo atrás ves de proyectos creativos, de investigación y exposición.

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Lunes<br/>19:30hs a 21:00hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalarabe" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Danzas Arabes</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Incorporar los movimientos básicos de la danza, relajar la postura corporal propia de la vida cotidiana. Asociar los movimientos corporales con los sonidos musicales. Memorizar secuencias coreográficas. Estimular la movilidad articular vinculándola con la disociación. Conocer la técnica de la danza árabe.  

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Viernes<br/>19:30hs a 21:00hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModaldibujo" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Dibujo y Pintura</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/dinpintadu.jpg" alt="img10"/>
        <p>
          <br>
           El arte plástico en su expresión más natural. Todos podemos dibujar y acá tenes tu oportunidad de comenzar. No hace falta tener experiencia.

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Miércoles<br/>18:30hs a 20:00hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalfolk" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Folklore</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Este taller hará foco en el aspecto popular de este patrimonio y por ende en su matriz de diversidad cultural en la que confluyen saberes originarios, españoles, afro y criollos. De manera que intentaremos reconstruir nuestra identidad basada en un ‘ser nacional’.
Abordaremos las siguientes danzas: Gato, Gato cuyano, Chacarera, Chacarera Doble, Zapateos básicos, Bailecito Coya, Bailecito Norteño, Escondido, Zamba, entre otras.  

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Jueves<br/>18:30hs a 20:00hs<br/>Viernes<br/>10:00hs a 11:30hs<br/>
	 </div>
    </div>
  </div>
</div>

<div id="myModalfoto" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Fotografía</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/foto1.jpg" alt="img10"/>
        <p>
          <br>
           Para aquellas personas que no poseen ningún conocimiento teórico ni practico de fotografía y deseen comenzar a explorar el terreno de una de las artes visuales más al alcance de todos. No se necesita cámara profesional.

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Miércoles<br/>18:30hs a 20:00hs<br/>
		 	 </div>
    </div>
  </div>
</div>

<div id="myModalguitarra" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Guitarra</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/guitarra.jpg" alt="img10"/>
        <p>
          <br>
           Para todos aquellos que quieran encontrarse con la música desde sus primeros rasguidos folclóricos. Interpretación de canciones con o sin canto. Acordes y escalas.
          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Jueves<br/>10:00hs a 11:30hs<br/>
		<br>
		Sábados<br/>16:00hs a 17:00hs<br/>17:00hs a 18:00hs<br/>18:00hs a 19:00hs</div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalmaq" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Maquillaje Artistico</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/guitarra.jpg" alt="img10"/>
        <p>
          <br>
           El curso se encuentra dirigido a todas las personas que quieran maximizar su potencial creativo y realizar maquillajes únicos. Es un curso dinámico y entretenido que te brindara acceso a todos los conocimientos necesarios para desenvolverte con instinto creativo, seguridad para diseñar sus propios maquillajes y calidad profesional para poder aplicarlo en medios audiovisuales: teatro, cine, tv, pasarela, moda, entre otros

          <br>
            
        </p>
      </div>
      <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Jueves<br/>10:00hs a 11:30hs<br/>
		<br>
		Sábados<br/>16:00hs a 17:00hs<br/>17:00hs a 18:00hs<br/>18:00hs a 19:00hs</div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalms" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Maquillaje Social</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/makeup.jpg" alt="img10"/>
        <p>
          <br>
            El curso se encuentra dirigido a todas las personas interesadas en desarrollarse en el mundo de la estética. El mismo es para todas aquellas con ganas de aprender las técnicas del maquillaje para plantearlo como hobby o una nueva salida laboral. El curso te ofrece todas las herramientas para que utilices las técnicas básicas en distintas áreas: novias, quinceañeras, pasarela, publicidad, etc. Pudiendo así explotar tu creatividad, ingenio e imaginación, respetando las necesidades y gustos del cliente para el  que trabajes.

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Miércoles<br/>18:00hs a 19:30hs<br/>
	   </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalsalsa" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Salsa</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/salsa.jpg" alt="img10"/>
        <p>
          <br>
           En el taller trabajamos sobre dos bailes sociales latinos principales; Salsa, influencia en sus movimientos por el jazz y el afro. La Bachata, caracterizada por ser sensual, romántica y rítmica.
Trabajamos los pasos básicos que aplicamos tanto a coreografías individuales como a variaciones en pareja.
Ahondamos en el cuerpo buscando generar mayor conciencia y para ello realizamos ejercicios de disociación, técnica y elongación en todas las clases.<br/>
Bailar es expresarse con alegría. ¡Divertite y mejora tu salud!
Curso de Salsa y Ritmos Caribeños.<br/>Veni a participar de un curso donde vas a aprender técnica, estilo, postura, musicalidad sobre todo con mucha diversión y buena energía.

          <br>
           
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Martes<br/>18:00hs a 19:30hs<br/>19:30hs a 21:00hs<br/>
        Miércoles<br/>09:30hs a 11:00hs<br/>
        Viernes<br/>11:00hs a 12:30hs<br/>
        
	   </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalpf" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Porcelana Fría</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/porce.jpg" alt="img10"/>
        <p>
          <br>
           Estas buscando algo artesanal, práctico, fácil y además terapéutico? Clases de modelado en porcelana fría para grandes y adolescentes. Todos los materiales están incluidos, solo trae tus ganas de aprender a descubrir el poder de tus manos.   
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Jueves<br/>17:00hs a 18:30hs<br/>
       </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalpfxp" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Porcelana Fría con experiencia</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/porce.jpg" alt="img10"/>
        <p>
          <br>
           Seguí creando!

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
        Jueves<br/>18:30hs a 20:00hs<br/>
       </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalyoga" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Yoga</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/yoga.jpg" alt="img10"/>
        <p>
          <br>
           Respiración, posturas, relajación, concentración y meditación para ver y sentir la vida de una manera más artística, armónica y bella.
          <br>
           
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Lunes<br/>18:00hs a 19:30hs<br/>
           Jueves<br/>10:00hs a 11:30hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModalzumba" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Zumba</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Es una disciplina fitness que consiste en combinar a través de coreografías entretenidas ejercicios aeróbicos con movimientos de distintos bailes.
La clase se divide en tres partes, entrada en calor, aeróbica y elongación. 
La idea es encontrarnos con nuestro cuerpo luego de un trabajo intenso.
          <br>
          
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Lunes<br/>18:00hs a 19:00hs<br/>19:00hs a 20:00hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>

<div id="myModaltrom" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Trompeta</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/trompeta.jpg" alt="img10"/>
        <p>
          <br>
           Un instrumento de viento que puede formar parte de una banda o simplemente como solista. Otra forma de comenzar a incursionar en la música.

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Martes<br/>17:30hs a 19:00hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltel" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Telas</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tela.jpg" alt="img10"/>
        <p>
          <br>
           Anímate a volar! Veni a vivir la experiencia de soltarte y dejarte caer. Sentite libre en el aire.
Reconocimiento del propio cuerpo, figuras básicas, entrenamiento corporal. 
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Miércoles<br/>19:00hs a 20:30hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltelxp" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Telas con experiencia</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tela.jpg" alt="img10"/>
        <p>
          <br>
           Anímate a volar! Veni a vivir la experiencia de soltarte y dejarte caer. Sentite libre en el aire.
Reconocimiento del propio cuerpo, figuras básicas, entrenamiento corporal. 
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Lunes<br/>19:00hs a 20:30hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltea" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Teatro</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Este seminario propone un entrenamiento que apunta a estimular la creatividad y las posibilidades de expresión a través de un conjunto de técnicas que sirvan para la creación de personajes y escenas cómicas.
La intención en la comedia es sorprender, hacer reír, provocar una respuesta en el público. Quien lo hace, se tiene que divertir, disfrutar de sus actos y estar relajado. Es por esto que este seminario está basado en juegos y ejercicios tomados de distintos métodos de actuación.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Miércoles<br/>19:30hs a 21:00hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltan" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Tango</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tango.jpg" alt="img10"/>
        <p>
          <br>
           Veni a compartir un momento agradable, a conectarte con la música y a disfrutar de un abrazo milonguero, anímate… <br/>
Clases de Tango, técnica corporal, marca, cadencia, tipo de abrazos, perfeccionamiento de técnica, adornos, musicalidad y primeros pasos. ¿Queres saber más? Veni y entérate… 

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Jueves<br/>19:00hs a 20:30hs<br/> 
	       Viernes<br/>15:30hs a 17:00hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltal" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Taller de Escritura Literaria</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tee.jpg" alt="img10"/>
        <p>
          <br>
           
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Viernes<br/>19:00hs a 21:00hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltai" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Tai chi</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/chikung.jpg" alt="img10"/>
        <p>
          <br>
           Arte milenario ideal para trabajar la flexibilización de la columna, mejorar la posición de la espalda, la circulación de la energía y la relajación. Es ideal para el fortalecimiento de los músculos y desbloque de las articulaciones. 
Es una serie de movimientos yin y yang que forman una suerte de danza donde está implicada la respiración budista y la taoísta.
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Miércoles<br/>11:00hs a 12:30hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltmm" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Taller de Música madres e hijos</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Es un espacio donde los niños, niñas y sus papás puedan compartir momentos de Juego y diversión a partir de experiencias musicales pudiendo promoverse en los infantes a partir de las vivencias el goce y el entusiasmo por conocer el mundo musical. Instrumentos, telas, juguetes sonoros, pelotas y muchas pero muchas canciones son la base para estimular los sentidos y el disfrute por la música en los niños. 
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Jueves<br/>17:00hs a 18:30hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltte" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Teatro de textos</h4>
        <small>
        Jóvenes y Adultos</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/teatrotexto.jpg" alt="img10"/>
        <p>
          <br>
           El taller propone desarrollar las posibilidades expresivas, narrativas de propio cuerpo, voz, respiración, imaginación. El trabajo con texto, vestuarios y objetos. Relajación corporal, respiración, voz y entrenamiento actoral. Distintas técnicas teatrales. Autores. La narrativa del cuerpo en el espacio.

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Lunes<br/>19:30hs a 21:00hs<br/> 
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalcan" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Canto</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/canto1.jpg" alt="img10"/>
        <p>
          <br>
           El cuerpo es la caja de resonancia, por donde podemos emitir nuestra voz a través de las cuerdas vocales.
Ahí es donde surge el canto sea individual o colectivo.
El canto es para mí, una forma de expresión artística y también un encuentro con lo primitivo, con lo ancestral, un contacto permanente con la tierra.
Nuestras sensaciones pueden ser expresadas a través de las diferentes canciones que elijamos para interpretar, a través del canto.

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Viernes<br/>17:30hs a 18:30hs<br/>18:30hs a 19:30hs<br/>  
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalcer" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Cerámica</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Un espacio de recreación y aprendizaje al que todo aquel con interés puede acercarse a experimentar las diferentes posibilidades que los materiales cerámicos nos	 brindan.
El objetivo es estimular la creatividad y la expresión personal, conociendo e incorporando las diferentes técnicas de trabajo para la producción cerámica y la realización de piezas escultóricas.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Lunes<br/> 10:00hs a 12:00hs<br/>17:00hs a 18:30hs<br/>  
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalflk" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Floclore</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Este taller hará foco en el aspecto popular de este patrimonio y por ende en su matriz de diversidad cultural en la que confluyen saberes originarios, españoles, afro y criollos. De manera que intentaremos reconstruir nuestra identidad basada en un ‘ser nacional’.
Abordaremos las siguientes danzas: Gato, Gato cuyano, Chacarera, Chacarera Doble, Zapateos básicos, Bailecito Coya, Bailecito Norteño, Escondido, Zamba, entre otras.  
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Jueves<br/> 18:30hs a 20:00hs<br/>
	       Viernes<br/>10:00hs a 11:30hs<br/>  
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalpfv" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Porcelana Fría con experiencia</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/porce.jpg" alt="img10"/>
        <p>
          <br>
           Seguí creando!
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Jueves<br/> 18:30hs a 20:00hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltlv" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Taller de escritura literaria</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tee.jpg" alt="img10"/>
        <p>
          <br>
           
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Viernes<br/> 19:00hs a 21:00hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltav" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Tango</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/tango.jpg" alt="img10"/>
        <p>
          <br>
           Veni a compartir un momento agradable, a conectarte con la música y a disfrutar de un abrazo milonguero, anímate… 
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Jueves <br/>19:00hs a 20:30hs<br/>
	       Viernes<br/>15:30hs a 17:00hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaltev" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Teatro</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/teatrov.jpg" alt="img10"/>
        <p>
          <br>
            Un espacio para crear desde la libertad expresiva. 
Taller de actuación, interpretación y composición de personajes.
No es necesario tener experiencia previa. Dos muestras anuales

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
	       Viernes<br/>17:00hs a 19:00hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalyov" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Yoga</h4>
        <small>
        Vitalicios</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/yoga.jpg" alt="img10"/>
        <p>
          <br>
           Respiración, posturas, relajación, concentración y meditación para ver y sentir la vida de una manera más artística, armónica y bella.

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Jueves<br/>
			10:00hs a 11:30hs<br/>
			Lunes <br/>
			18:00hs a 19:30hs<br/>
        </div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaljun" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Juego, expresión y movimiento</h4>
        <small>
        Niños (3 a 5 años)</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Es un taller destinado a fomentar el desarrollo social y motriz de los niños y niñas, a través de la realización de actividades estético-expresivas, artísticas y lúcidas. 
El taller está orientado a chicos y chicas entre 3 y 6 años.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			17:00hs a 18:30hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalimm" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Iniciación al mundo de la música</h4>
        <small>
        Niños (3 a 5 años)</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           El presente taller invita a niños y niñas a iniciarse en el mundo de la música a partir propuestas lúdicas que habilitan el aprendizaje a través del jugar y divertirse en grupo. Se utilizan instrumentos convencionales y todo tipo de objetos sonoros (resortes, vasos, tapitas, cascabeles) para la exploración y conocimiento de contenidos, se aprenden canciones a partir de la teatralización y la utilización de títeres, telas y cintas y se habilita la apertura hacia diferentes estilos musicales a partir de historias que impulsan el baile y el movimiento libre y pautado. 
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			16:00hs a 17:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalimd" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Iniciación al mundo de la danza </h4>
        <small>
        Niños (3 a 5 años)</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           El curso esta dirigido para nenas que deseen comenzar a bailar. Por medio de juegos aprenden a reconcoer el espacio, distintos tipo de música y a realizar variaciones coreográficas. Tiene 3 grandes beneficio: Correccion de postura, aprendizaje básico de danza para poder luego profundizarlos y salud corporal.  

          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			18:00hs a 19:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalaae" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Acrobacia aérea</h4>
        <small>
        Niños</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
            Anímate a volar! Veni a vivir la experiencia de soltarte y dejarte caer. Sentite libre en el aire.
Reconocimiento del propio cuerpo, figuras básicas, entrenamiento corporal. 
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			14:30hs a 15:45hs<br/>
			15:45hs a 17:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalaaexp" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Acrobacia aérea con experiencia</h4>
        <small>
        Niños</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Ya sentiste lo que es volar! Si queres seguir aprendiendo para sumar experiencia y flexibilidad a tu cuerpo te esperamos.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			17:00hs a 18:30hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalgtr" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Guitarra</h4>
        <small>
        Niños (6 a 12 años)</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/guitarra.jpg" alt="img10"/>
        <p>
          <br>
           Ejercicio de dedos para ambas manos, marcación del pulso con juegos rítmicos, ensamble grupales con rasguidos y arpegios.
          <br>
            
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			14:30hs a 16:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaldyp" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Dibujo y pintura</h4>
        <small>
        Niños </small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Jugando aprendemos nuevas técnicas de pintura, formas de llevar nuestra imaginación más lejos y crear mundos de color.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			15:30hs a 16:45hs<br/>
			16:45hs a 18:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalgyc" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Gym y circo</h4>
        <small>
        Niños </small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           Quienes participen de este taller encontraran un espacio artístico y lúdico donde podrán experimentar y aprender sobre las diversas áreas que componen el circo.
Aprenderemos malabarismo con diversos elementos, realizaremos actividades de introducción a la acrobacia y utilizaremos diversas técnicas estético-expresivas. 
El taller está destinado a chicos y chicas entre 7 y 12 años.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			15:45hs a 17:00hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalime" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Iniciación musical y ensamble</h4>
        <small>
        Niños (6 a 9 años) </small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           El presente taller se propone habilitar la exploración, el registro y el manejo de los diversos parámetros musicales a partir de juegos y experiencias sonoras que estimulan el hacer musical en conjunto. Ritmos, timbres, melodías y el trabajo vocal es investigado a partir de juegos de percusión corporal, la teatralización de personajes que aparecen en las canciones, la manipulación de instrumentos convencionales y objetos sonoros que permiten el intercambio y la producción musical grupal. Se promueve el intercambio de roles (cantante, director, e instrumentistas) así como el ensamble grupal con momentos solistas, ya sea instrumentales o vocales. 
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			14:30hs a 15:45hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModalten" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Teatro</h4>
        <small>
        Niños</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/teatroiniciacioon.jpg" alt="img10"/>
        <p>
          <br>
           Un espacio para acercarnos al teatro a través de juegos, música y lectura.
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			15:00hs a 16:30hs<br/>
		</div>
	 </div>
    </div>
  </div>
</div>
<div id="myModaldaz" class="modal fade eventime_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
        Danzas árabes</h4>
        <small>
        Niños</small>
      </div>
      <div class="modal-body">
        <img src="images/complejo/generico.png" alt="img10"/>
        <p>
          <br>
           La danza oriental (árabe) combina técnica de baile para que los más chicos puedan tener un aprendizaje profesional y actividades recreativas asociadas a la danza para que puedan divertirse aprendiendo. 
          <br>
        </p>
      </div>
       <div class="modal-footer">
	      <a href="https://www.facebook.com/ComplejoCulturalSanidad/" class="contact_icon fa fa-facebook graybtn graytxt"></a>
		  <a href="https://twitter.com/AtsaBsAs"	 	class="contact_icon fa fa-twitter graybtn graytxt"></a>
		  <a href="https://www.instagram.com/AtsaBsAs/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
			Sábados<br/>
			17:30 a 18:30 hs.<br/>
		</div>
	 </div>
    </div>
  </div>
</div>-->