<?php
/*
 * Editar sección viajes
 * subir nuevos imagenes y retocar textos
 * Since 8.4
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
        <div class="container page-admin-wrapper">

            <?php showPageAdmin ( 5, true ); ?>

        </div><!-- // container -->
		<div class="container">
			<div class="btn-main-wapper">
				<button class="btn btn-warning btn-sm new-viajes-btn">Cargar nueva</button>
			</div>
			<div id="viajesAdmin">

                <?php $viajes = showViajesCargados();

                if ( $viajes  != null ) :
                    foreach ( $viajes as $viaje ) { ?>
                        <h3 class="viajes-item-titulo"><?php echo $viaje['titulo']; ?></h3>
                        <div class="viajes-item" id="<?php echo $viaje['id']; ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="/uploads/images/<?php echo $viaje['imagen']; ?>" data-href="<?php echo $viaje['imagen']; ?>" class="img-responsive">
                                    <button class="btn btn-xs btn-primary btn-change-image-viajes">Cambiar imagen</button>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label>Título:<br>
                                                <input type="text" name="viajes_titulo" value="<?php echo $viaje['titulo']; ?>">	
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Orden:<br>
                                                <input type="text" name="viajes_orden" value="<?php echo $viaje['orden']; ?>">
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>Texto:<br>
                                                <textarea class="tinymce-viajes" name="viajes_texto"><?php echo $viaje['texto']; ?></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="btns-item-footer">
                                        <span class="msj-viajes-saved"></span>
                                        <button class="btn btn-sm btn-success btn-save-viajes-item" data-id="<?php echo $viaje['id']; ?>">Guardar cambios</button>
                                        <button class="btn btn-sm btn-danger btn-del-viajes-item" data-id="<?php echo $viaje['id']; ?>">Borrar elemento</button>
                                    </p>
                                </div>
                            </div>

                        </div>
                    <?php }
                endif; ?>

			</div><!-- // accordion -->
		</div><!-- // container -->
		
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->