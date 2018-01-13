<?php
/*
 * MODULO CURSOS
*/


/*
MUESTRA LA LISTA DE CURSOS CREADOS
*/

function listaCurso () {
	$connection = connectDB();
	$tabla = 'cursos';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by curso_orden";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return false;
	} else {

		while ($row = $result->fetch_array()) {
				$cursos[] = $row;
		}//while

		return $cursos;
		
	}//else 
	
	closeDataBase($connection);

} //listaSliders()

function templateCursoAdmin( $curso ) { ?>
	<li>
		<article>
			<form method="POST" name="editar-curso-formulario" class="editar-curso-formulario">		
				<input type="hidden" name="curso_id" value="<?php echo $curso['curso_id']; ?>">
				<div class="error-msj-wrapper">
					<ul class="error-msj-list">
						
					</ul>
				</div>
				<div class="row">

					<div class="col-30">
						<input type="hidden" name="curso_imagen" value="<?php echo $curso['curso_imagen']; ?>" class="change-image-input">
					<?php if ( $curso['curso_imagen'] != '' ) : ?>
						<img src="<?php echo UPLOADSURLIMAGES . '/' . $curso['curso_imagen']; ?>" alt="Imagen Curso" class="image-responsive">
					<?php else : ?>
						<img src="<?php echo URLADMINISTRADOR . '/assets/images/generico.png'; ?>" alt="Imagen Curso" class="image-responsive">
					<?php endif; ?>
						<button type="button" class="btn btn-xs btn-danger btn-change-image">
							Cambiar imagen
						</button>
					</div>

					<div class="col-70">
						<div class="row">
							<div class="col-80">
								<div class="form-group">
									<label for="curso_titulo">
										Titulo Curso:
									</label>
									<input type="text" name="curso_titulo" value="<?php echo $curso['curso_titulo']; ?>">
								</div>
							</div>
							<div class="col-20">
								<div class="form-group">
									<label for="curso_orden">
										Orden:
									</label>
									<input type="text" name="curso_orden" value="<?php echo $curso['curso_orden']; ?>">
								</div>
							</div>
						
							<div class="col">
								<div class="form-group">
									<label for="curso_subtitulo">
										Subtitulo:
									</label>
									<input type="text" name="curso_subtitulo" value="<?php echo $curso['curso_subtitulo']; ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-50">
						<div class="form-group">
							<label for="curso_texto">
								Curso Texto:
							</label>
							<textarea class="editor-enriquecido" name="curso_texto">
								<?php echo $curso['curso_texto']; ?>
							</textarea>
						</div>
					</div>
					<div class="col-50">
						<div class="form-group">
							<label for="curso_horarios">
								Curso horarios:
							</label>
							<textarea class="editor-enriquecido" name="curso_horarios">
								<?php echo $curso['curso_horarios']; ?>
							</textarea>
						</div>
					</div>
				</div>
				

			   	<div class="row">	
					<div class="col">
					   	<div class="form-group save-button-right">
					   		<button type="submit" name="submit_save" class="btn btn-primary">Guardar Cambios</button>
					   		<button type="button" name="delete-curso" class="btn btn-danger btn-xs btn-delete-curso" data-cursoid="<?php echo $curso['curso_id']; ?>">Borrar</button>
					   	</div>
					</div><!-- // col -->
				</div><!-- // row -->  

			</form>		
		</article>
	</li>
<?php }