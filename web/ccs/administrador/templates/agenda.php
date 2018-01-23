<?php 
global $userStatus;
if ($userStatus != '0' && $userStatus != '1' ) {
	echo 'No tiene permisos para ver esta sección';
  	
  	exit;
}
load_module( 'agenda' );
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<h1 class="titulo-modulo">
			Agenda, Complejo Cultural
		</h1>
		<div class="container">
			<div id="imagen_destacada_wrapper">
				<button id="new-evento" class="btn btn-primary">Agregar nuevo evento</button>
			</div>
			<ul class="lista-eventos">
				
			<?php 

			$eventos = listaEventos();

			for ($i=0; $i < count($eventos); $i++) {

				$fechaIn = $eventos[$i]['agenda_fecha_in'];
				$fechaOut = $eventos[$i]['agenda_fecha_out'];
				
				$fechaIn = explode(' ', $fechaIn);
				$fechaOut = explode(' ', $fechaOut);
				
				?>

				<li class="evento">
					<input type="hidden" name="agenda_id" value="<?php echo $eventos[$i]['agenda_id']; ?>" class="agenda_id">

					<div class="row">
						<div class="col-40">
							<div class="form-group">
								<label for="agenda_titulo">Título evento:</label>
								<input type="text" name="agenda_titulo" value="<?php echo $eventos[$i]['agenda_titulo']; ?>" class="agenda_titulo">
							</div>
						
							<div class="form-group">
								<label for="agenda_descripcion">Descripción evento:</label>
								<textarea name="agenda_descripcion" class="agenda_descripcion"><?php echo $eventos[$i]['agenda_descripcion']; ?></textarea>
							</div>

						</div>

						<div class="col-60">
							<div class="row">
								<div class="col-30">

									<div class="form-group">
										<label for="agenda_fecha_in">Fecha In:</label>
										<input type="date" name="agenda_fecha_in" value="<?php echo $fechaIn[0]; ?>" class="agenda_fecha_in">
									</div>

									<div class="form-group">
										<label for="hora_inicio">Hora inicio:</label>
										<input type="time" name="hora_inicio" value="<?php echo $fechaIn[1]; ?>" class="agenda_hora_in">
									</div>

								</div>
								<div class="col-30">

									<div class="form-group">
										<label for="agenda_fecha_out">Fecha Out:</label>
										<input type="date" name="agenda_fecha_out" value="<?php echo $fechaOut[0]; ?>" class="agenda_fecha_out">
									</div>

									<div class="form-group">
										<label for="hora_inicio">Hora final:</label>
										<input type="time" name="hora_final" value="<?php echo $fechaOut[1]; ?>" class="agenda_hora_out">
									</div>

								</div>

								<div class="col-40">
									<div class="form-group">
										<label for="agenda_categoria">Categoría </label>
											<select name="agenda_categoria" class="agenda_categoria">
												<?php 
													global $categoriasAgenda;
													$categoriaEvento = $eventos[$i]['agenda_categoria'];

													for ($a=0; $a < count($categoriasAgenda); $a++) {
														echo '<option value="'.$categoriasAgenda[$a]['slug'].'"';
														if ( $categoriasAgenda[$a]['slug'] == $categoriaEvento ) {
															echo ' selected="selected"';
														}
														echo '>'.$categoriasAgenda[$a]['nombre'].'</option>';
													}
												?>
											</select>
									</div>
									<div class="form-group">
										<label for="agenda_url">Slug:</label>
										<input type="text" name="agenda_url" value="<?php echo $eventos[$i]['agenda_url']; ?>" class="agenda_url">
									</div>
									<div class="form-group">
										<button class="btn btn-primary btn-save-evento">Guardar</button>
										<button class="btn btn-danger btn-delete-evento">Borrar</button>
									</div>

									<div class="error-msj-list"></div>

								</div>
							</div>

						</div>	

					</div>
				</li>

			<?php }//for

			?>


				

			</ul>
			
		</div>
	</div>
	<hr>
	<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
</div>