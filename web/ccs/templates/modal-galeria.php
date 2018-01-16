<!-- Modal Images -->
<?php

for ($i=0; $i < count($data); $i++) { ?>
  
  <div id="imgmodal_<?php echo $i+1?>" class="modal fade eventime_modal">
  <div class="modal-dialog img-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times; </button>
        <h4 class="modal-title">
          <?php echo $data[$i]['slider_texto']; ?>
        </h4>
      </div>
      <div class="modal-body">
        <img src="<?php echo UPLOADCONTENT . '/'. $data[$i]['slider_imagen']; ?>" alt="Complejo Cultural Sanidad"/>
      </div>
    </div>
  </div>
</div>

<?php } ?>