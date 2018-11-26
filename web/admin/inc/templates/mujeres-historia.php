<?php
/*
 * Editar sección mujeres
 * subir nuevos imagenes y retocar textos
 * Since 8.4
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="btn-main-wapper">
				<button class="btn btn-warning btn-sm new-mujeres-btn">Cargar nueva</button>
			</div>
			<div id="mujeresAdmin">

                <?php $mujeres = showMujeresHistoriaAdmin();

                if ( $mujeres  != null ) :
                    foreach ( $mujeres as $mujer ) { ?>
                        <h3 class="mujeres-item-titulo"><?php echo $mujer['titulo']; ?></h3>
                        <div class="mujeres-item" id="<?php echo $mujer['id']; ?>">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="/uploads/images/<?php echo $mujer['imagen']; ?>" data-href="<?php echo $mujer['imagen']; ?>" class="img-responsive">
                                    <button class="btn btn-xs btn-primary btn-change-image-mujeres">Cambiar imagen</button>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <label>Título:<br>
                                                <input type="text" name="mujeres_titulo" value="<?php echo $mujer['titulo']; ?>">	
                                            </label>
                                            <label>Fecha:<br>
                                                <input type="text" name="mujeres_fecha" value="<?php echo $mujer['fecha']; ?>">	
                                            </label>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Orden:<br>
                                                <input type="text" name="mujeres_orden" value="<?php echo $mujer['orden']; ?>">
                                            </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <label>Texto:<br>
                                                <textarea class="tinymce-mujeres" name="mujeres_texto"><?php echo $mujer['texto']; ?></textarea>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="btns-item-footer">
                                        <span class="msj-mujeres-saved"></span>
                                        <button class="btn btn-sm btn-success btn-save-mujeres-item" data-id="<?php echo $mujer['id']; ?>">Guardar cambios</button>
                                        <button class="btn btn-sm btn-danger btn-del-mujeres-item" data-id="<?php echo $mujer['id']; ?>">Borrar elemento</button>
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