<?php 
/*
 * ESTE TEMPLATE MANEJA EL ACCESO DIRECTO PARA EL USUARIO, QUE AL SER ASIGNADO MUESTRA LO QUE A ÉSTE LE CORRESPONDE
 * a = status usuario por default, por defecto maneja las noticias
 */

load_module( 'noticias' );

if ( $data == 'd' ) : ?>

  <!---------- ACCESOS DIRECTOS A LOS MODULOS ---------------->
<div class="container wrapper-modulos">
  <div class="row">
    <div class="col-30">
      <!-- modulo -->
      <section>
        <div class="modulo-wrapper">
          <h2>Nuevos afiliados</h2>
          <p>Agrega usuario nuevo.</p>
          <p><a class="btn btn-primary" href="index.php?admin=edit-contacts" role="button">Agregar nuevo</a></p>
        </div>
      </section><!-- //modulo -->
    </div><!-- //columna -->
  </div><!-- //row -->
</div><!-- //containre -->

<?php endif;