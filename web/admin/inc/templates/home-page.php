<?php
/*
 * Editar home page
 * editar pagina
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

$homeContent = showhomeAdmin();

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container page-admin-wrapper">

			<form name="homepage_form" id="homepage_form">
			
				<div class="row">
					<div class="col-md-12">
						<h2>Voces de Sanidad</h2>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<input name="voces_imagen" type="hidden" value="<?php echo $homeContent['voces']['imagen']; ?>">
							<img src="/uploads/images/<?php echo $homeContent['voces']['imagen']; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							<label for="voces_titulo">Título</label>
							<input name="voces_titulo" class="larger-input" value="<?php echo $homeContent['voces']['titulo']; ?>">
						</div>

						<div class="form-group">
							<label for="voces_parrafo">Párrafo</label>
							<textarea name="voces_parrafo" class="textarea-medium">
								<?php echo $homeContent['voces']['parrafo']; ?>
							</textarea>
						</div>

						<div class="form-group">
							<label for="voces_url">URL:</label>
							<input name="voces_url" class="larger-input" value="<?php echo $homeContent['voces']['url']; ?>">
						</div>

					</div>

				</div>

				<hr>

				<div class="row">

					<div class="col-md-12">
						<h2>Afiliate</h2>
					</div>
					
					<div class="col-md-4">
						<div class="form-group">
							<input name="afiliate_imagen" type="hidden" value="<?php echo $homeContent['afiliate']['imagen']; ?>">
							<img src="/uploads/images/<?php echo $homeContent['afiliate']['imagen']; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label for="afiliate_titulo">Título</label>
							<input name="afiliate_titulo" class="larger-input" value="<?php echo $homeContent['afiliate']['titulo']; ?>">
						</div>

						<div class="form-group">
							<label for="afiliate_parrafo">Párrafo</label>
							<textarea class="textarea-medium" name="afiliate_parrafo">
								<?php echo $homeContent['afiliate']['parrafo']; ?>
							</textarea>
						</div>

						<div class="form-group">
							<label for="afiliate_url">URL:</label>
							<input name="afiliate_url" class="larger-input" value="<?php echo $homeContent['afiliate']['url']; ?>">
						</div>

					</div>

				</div>

				<hr>

				<div class="row">

					<div class="col-md-12">
							<h2>Espacio Audiovisual</h2>
						</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label for="audiovisual_titulo">Título</label>
							<input name="audiovisual_titulo" class="larger-input" value="<?php echo $homeContent['audiovisual']['titulo']; ?>">
						</div>
						
						<div class="form-group">
							<label for="audiovisual_video">Link Video</label>
							<input name="audiovisual_video" class="larger-input" value="<?php echo $homeContent['audiovisual']['video']; ?>">
						</div>

					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="audiovisual_parrafo">Párrafo</label>
							<textarea name="audiovisual_parrafo" class="textarea-medium">
								<?php echo $homeContent['audiovisual']['parrafo']; ?>
							</textarea>
						</div>
					</div>

				</div>
				
				<hr>

				<div class="row">
					<div class="col-md-12">
						<h2>Frase</h2>
					

						<div class="form-group">
							<textarea name="frase" class="textarea-medium"><?php echo $homeContent['frase']; ?></textarea>
						</div>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-md-12">
						<h2>Conectados</h2>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							<label for="conectados_texto">Texto</label>
							
							<textarea id="conectados_texto" name="conectados_texto">
								<?php echo $homeContent['conectados']['texto']; ?>
							</textarea>
						</div>
					</div>

					<div class="col-md-4">
							
						<div class="form-group">
							<label for="conectados_video">Link Video</label>
							<input name="conectados_video" class="larger-input" value="<?php echo $homeContent['conectados']['video']; ?>">
						</div>

						<div class="form-group">
							<label for="conectados_url">Url</label>
							<input name="conectados_url" class="larger-input" value="<?php echo $homeContent['conectados']['url']; ?>">
						</div>

					</div>

				</div>

				<hr>

				<div class="row">
					<div class="col-md-12">
						<h2>Banners</h2>
					</div>
					
					<div class="col-md-3">
						<div class="form-group">
							<input name="banner_imagen1" type="hidden" value="<?php echo $homeContent['banners'][0]; ?>">
							<img src="/uploads/images/<?php echo $homeContent['banners'][0]; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<input name="banner_imagen2" type="hidden" value="<?php echo $homeContent['banners'][1]; ?>">
							<img src="/uploads/images/<?php echo $homeContent['banners'][1]; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<input name="banner_imagen3" type="hidden" value="<?php echo $homeContent['banners'][2]; ?>">
							<img src="/uploads/images/<?php echo $homeContent['banners'][2]; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<input name="banner_imagen4" type="hidden" value="<?php echo $homeContent['banners'][3]; ?>">
							<img src="/uploads/images/<?php echo $homeContent['banners'][3]; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

				</div>

				<hr>

				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-warning">Guardar Cambios</button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<span class="mensaje-guardado"></span>
						</div>
					</div>
				</div>
			</form>

		</div><!-- // container -->
		
		<div id="dialog">
			
		</div>
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->