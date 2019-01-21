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
                <p style="font-size: 80%;margin:0 2rem 2rem;">
                    Los que se marcan con azul, son los índices (universidades) de todos los convenios. Para indicar un nuevo índice, hay que hacer clic en el checkbox debajo de órden. Sino es un índice, se debe introducir la categoría del convenio, para que se muestre en la página debajo de la universidad correspondiente. <strong>Para agregar la categoría, una vez cargado el convenio, se debe actualizar la página y luego se mostrarán las categorías a elegir.</strong>
                </p>
				<div>
					<div class="container-fluid">
						<button class="btn btn-warning btn-sm btn-new-curso" data-tipo="universitarios">Crear nuevo Convenio</button>
						<div class="lista-cursos" id="contenedor-universitarios">
                            <?php $cursos = listCursosAdmin ( 'universitarios' );
							
                            if ( $cursos != null ) :

                                foreach ( $cursos as $curso ) { ?>
                                    <h3 <?php if ( $curso['curso_dataextra1'] == 1 ) {echo 'style="background-color:#337ab7;color:#fff;"'; } ?>>
                                        <?php echo $curso['curso_titulo']; ?>
                                    </h3>
                                    <div class="curso">
                                        <article class="container-fluid" id="<?php echo $curso['curso_ID'];?>">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <label>Título:<br>
                                                        <input type="text" name="cursos_titulo" value="<?php echo $curso['curso_titulo']; ?>">
                                                    </label>
                                                    <label>Slug: (url)<br>
                                                        <input class="cursos_input_slug" type="text" name="cursos_slug" value="<?php echo $curso['curso_slug']; ?>">
                                                    </label>
                                                </div><!-- // .col -->
                                                <div class="col-sm-2">
                                                    <label>Orden:<br>
                                                        <input type="number" name="cursos_orden" value="<?php echo $curso['curso_orden']; ?>">
                                                    </label>
                                                    <label>Universidad (indice):<br>
                                                        <?php if ( $curso['curso_dataextra1'] == 1 ) { ?>
                                                            <input class="input_indice" type="checkbox" name="dataextra1" checked>
                                                        <?php } else { ?>
                                                            <input class="input_indice" type="checkbox" name="dataextra1">
                                                        <?php } ?>
                                                    </label>
                                                </div><!-- // .col -->
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                <label>Imagen:<br>
                                                            <img data-href="<?php echo $curso['curso_imagen']; ?>" class="img-responsive imagen-curso" src="/uploads/images/<?php echo $curso['curso_imagen']; ?>">
                                                            <button class="btn btn-xs btn-change-image-curso">Cambiar imagen</button>
                                                        </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label>Contenido:<br>
                                                        <textarea class="tinyeditorcursos" name="cursos_contenido"> <?php echo $curso['curso_objespecifico']; ?></textarea>
                                                    </label>
                                                </div><!-- // .col -->
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
													<h4>Plan De estudios (opcional)</h4>
                                                    <a href="/uploads/pdfs/<?php echo $curso['curso_archivo']; ?>" target="_blank" data-href="<?php echo $curso['curso_archivo']; ?>" class="archivo-curso"><?php echo $curso['curso_archivo']; ?></a>
                                                        <button class="btn btn-xs btn-change-archivo-curso">Cambiar/cargar archivo</button>

                                                        <?php if ( $curso['curso_archivo'] != '') : ?>
                                                            <button class="btn btn-xs btn-clear-archivo-curso">borrar archivo</button>
                                                        <?php endif; ?>
                                                </div><!-- // .col -->
                                                <div class="col-sm-6 text-right">
                                                    <div class="form-group">
                                                        <label for="cursos_categoria">
                                                            Categoria (universidad)
                                                        </label>
                                                        <select name="cursos_categoria">
                                                            <option>Seleccionar categoría</option>
                                                            <?php
                                                                $categorias = listCursosIndiceAdmin('universitarios');

                                                                if ( $categorias != 'null' ) {
                                                                    foreach ($categorias as $categoria) {

                                                                        $option = '<option value="'.$categoria["curso_ID"].'"';
                                                                        
                                                                        if ( $curso['curso_categoria'] ==  $categoria["curso_ID"] ) {
                                                                            $option.= ' selected';
                                                                        }
                                                                        
                                                                        $option.= '>'.$categoria["curso_titulo"].'</option>';

                                                                        echo $option;
                                                                    }
                                                                    
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="cursos_categoria">
                                                            Sub Categoria (opcional)
                                                        </label>
                                                        <select name="cursos_categoria">
                                                            <option>Seleccionar subcategoría</option>
                                                            <option value="certificado">Cursos con certificado Oficial</option>
                                                            <option value="no-formales">Cursos No Formales</option>
                                                        </select>
                                                    </div>

                                                </div>
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