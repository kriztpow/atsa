<?php
/*
 * Editar sección de formacion tecnico profesional:
 * formacion profesional fue separado de cursos desde: 8.4
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
				<h3 class="text-center">Formación Técnico profesional</h3>
				<div>
					<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="formacion-tecnica">Crear nuevo Curso</button>
					<div class="lista-cursos" id="contenedor-formacion-tecnica">
                        
                        <?php $cursos = listCursosAdmin ( 'formacion_tecnica' );
							
								if ( $cursos != null ) :

                                    foreach ( $cursos as $curso ) { ?>
                                        <h3><?php echo $curso['curso_titulo']; ?></h3>
										<div class="curso">
                                            <article class="container-fluid" id="<?php echo $curso['curso_ID'];?>">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Título:<br>
                                                            <input class="cursos_input_titulo" type="text" name="cursos_titulo" value="<?php echo $curso['curso_titulo']; ?>">
                                                        </label>
                                                        <label>Slug:<br>
                                                            <input class="cursos_input_slug" type="text" name="cursos_orden" value="<?php echo $curso['curso_slug']; ?>">
                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-6">
                                                        <label>Resumen:<br>
                                                            <textarea name="cursos_resumen"><?php echo $curso['curso_resumen']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Imagen:<br>
                                                            <img data-href="<?php echo $curso['curso_imagen']; ?>" class="img-responsive imagen-curso" src="/uploads/images/<?php echo $curso['curso_imagen']; ?>">
                                                            <button class="btn btn-xs btn-change-image-curso">Cambiar imagen</button>

                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-6">
                                                        <label>Certificado:<br>
                                                            <input type="text" name="cursos_titulo" value="<?php echo $curso['curso_certificado']; ?>">
                                                        </label>
                                                        <label>Cursada:<br>
                                                            <textarea name="cursos_orden"><?php echo $curso['curso_cursada']; ?></textarea>
                                                        </label>
                                                        <label>Horarios:<br>
                                                            <input type="text" name="cursos_orden" value="<?php echo $curso['curso_orden']; ?>">
                                                        </label>
                                                        <label>Lugar:<br>
                                                            <input type="text" name="cursos_orden" value="<?php echo $curso['curso_lugar']; ?>">
                                                        </label>
                                                    </div><!-- // .col -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label>Metodología:<br>
                                                            <textarea name="curso_metodologia"><?php echo $curso['curso_metodologia']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-6">
                                                        <label>Objetivo General:<br>
                                                            <textarea name="curso_objgeneral"><?php echo $curso['curso_objgeneral']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-6">
                                                        <label>Requisitos:<br>
                                                            <textarea name="curso_requisitos"><?php echo $curso['curso_requisitos']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-6">
                                                        <label>Destinatario:<br>
                                                            <textarea name="curso_destinatario"><?php echo $curso['curso_destinatario']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label>Objetivo Específico:<br>
                                                            <textarea class="tinyeditorcursos" name="curso_objespecifico"><?php echo $curso['curso_objespecifico']; ?></textarea>
                                                        </label>
                                                    </div><!-- // .col -->
                                                    <div class="col-sm-4">
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <label>Destacado:<br>
                                                                <?php if ( $curso['curso_destacado'] == 1 ) { ?>
                                                                    <input type="checkbox" name="cursos_destacado" checked>
                                                                <?php } else { ?>
                                                                    <input type="checkbox" name="cursos_destacado">
                                                                <?php } ?>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label>Orden:<br>
                                                                    <input type="number" name="cursos_orden" value="<?php echo $curso['curso_orden']; ?>">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div><!-- // .col -->
                                                </div>
                                                
                                                <div class="btn-cursos-wrapper">
                                                    <span class="msj-cursos-saved"></span>
                                                    <button class="btn btn-danger btn-curso-save-item" data-tipo="formacion_tecnica" data-id="<?php echo $curso['curso_ID']; ?>">Guardar Cambios</button>
                                                    <button class="btn btn-success btn-curso-del-item" data-tipo="formacion_tecnica" data-id="<?php echo $curso['curso_ID']; ?>">Borrar curso</button>
                                                </div>
                                            </article>
                                        </div>
									<?php }

								endif;
								
							?>

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