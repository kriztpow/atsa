<?php
/*
 * Editar sección delegados
 * Since 8.3
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="btn-main-wapper">
				<button data-type="menu" class="btn btn-warning btn-sm new-item-btn">Crear nueva item</button>
			</div>

			<div id="laboratorioDelegados">

                <?php $items = showItemsDelegados('menu');
                    if ($items != null) : 

                        foreach ($items as $item) { ?>
                            <h3 class="delegados-item-titulo"><?php echo $item['titulo']; ?></h3>
                            <div class="delegados-item" data-type="menu" id="<?php echo $item['id']; ?>">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php 
                                            if ( $item['imagen'] == '' ) {
                                                $imagen = '';
                                            } else {
                                                $imagen = '/uploads/images/' . $item['imagen'];
                                            }
                                        ?>
                                        <img src="<?php echo $imagen; ?>" data-href="<?php echo $item['imagen']; ?>" class="img-responsive">
                                        <button class="btn btn-xs btn-primary btn-change-image-delegado">Cambiar imagen</button>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <label>Título:<br>
                                                    <input type="text" name="titulo" value="<?php echo $item['titulo']; ?>">	
                                                </label>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Orden:<br>
                                                    <input type="text" name="orden" value="<?php echo $item['orden']; ?>">
                                                </label>
                                            </div>
                                            <div class="col-sm-12">
                                                <label>url:<br>
                                                    <input type="text" name="url" value="<?php echo $item['url']; ?>">
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="btns-item-footer">
                                            <span class="msj-delegados-saved"></span>
                                            <button class="btn btn-sm btn-success btn-save-delegado-item" data-id="<?php echo $item['id']; ?>">Guardar cambios</button>
                                            <button class="btn btn-sm btn-danger btn-del-delegado-item" data-id="<?php echo $item['id']; ?>">Borrar elemento</button>
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
            <a type="button" href="index.php?admin=delegados-videos" class="btn btn-default">Agregar videos</a>
            
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->