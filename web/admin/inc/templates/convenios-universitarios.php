<?php
/*
 * Editar sección convenios:
 * convenios universitarios fue separado de cursos desde: 8.4
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			
			<div id="cursosacordion">
                <h3 class="text-center">Convenios Universitarios</h3>
				<div>
					<div class="container-fluid">
						<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="universitarios">Crear nuevo Convenio</button>
						<div class="lista-cursos" id="contenedor-universitarios">
                            <?php $cursos = listCursosAdmin ( 'universitarios' );
							
                            if ( $cursos != null ) :

                                foreach ( $cursos as $curso ) { ?>
                                    <h3>
                                        <?php echo $curso['curso_titulo']; ?>
                                    </h3>
                                    <div class="curso">
                                        <article class="container-fluid" id="<?php echo $curso['curso_ID'];?>">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <label>Título:<br>
                                                        <input type="text" name="cursos_titulo" value="<?php echo $curso['curso_titulo']; ?>">
                                                    </label>
                                                </div><!-- // .col -->
                                                <div class="col-sm-2">
                                                    <label>Orden:<br>
                                                        <input type="number" name="cursos_orden" value="<?php echo $curso['curso_orden']; ?>">
                                                    </label>
                                                </div><!-- // .col -->
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Contenido:<br>
                                                        <textarea class="tinyeditorcursos" name="cursos_contenido"> <?php echo $curso['curso_objespecifico']; ?></textarea>
                                                    </label>
                                                </div><!-- // .col -->
                                            </div>
                                            <div class="btn-cursos-wrapper">
                                                <span class="msj-cursos-saved"></span>
                                                <button class="btn btn-danger btn-curso-save-item" data-tipo="universitarios" data-id="<?php echo $curso['curso_ID']; ?>">Guardar Cambios</button>
                                                <button class="btn btn-success btn-curso-del-item" data-tipo="universitarios" data-id="<?php echo $curso['curso_ID']; ?>">Borrar Convenio</button>
                                            </div>
                                        </article>
                                    </div>
                                <?php }

                            endif;
                            
                            ?>
						</div>
					</div>
				</div><!-- // accordion item -->

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