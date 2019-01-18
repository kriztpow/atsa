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
          <a href="https://www.instagram.com/complejo.cultural/" class="contact_icon fa fa-instagram graybtn graytxt"></a>
          <div class="cursos-horarios">
            <?php echo $data[$i]['curso_horarios']; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php }