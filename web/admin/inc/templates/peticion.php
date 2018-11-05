<?php
/*
 * Editar peticion page
 * editar pagina
 * Since 8.2
 * 
*/
require_once("inc/functions.php");

$contenido = showpeticionAdmin();

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container page-admin-wrapper">

			<form name="peticion_form" id="peticion_form">
			
				<div class="row">
					<div class="col-md-12">
						<h2>Página petición</h2>
					</div>
                    <input type="hidden" name="id" value="<?php echo isset($contenido['id']) ? $contenido['id'] : ''; ?>">
					<div class="col-md-4">
						<div class="form-group">
							<input name="header_imagen" type="hidden" value="<?php echo isset($contenido['header_imagen']) ? $contenido['header_imagen'] : ''; ?>">
							<img src="/uploads/images/<?php echo isset($contenido['header_imagen']) ? $contenido['header_imagen'] : ''; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							<label for="titulo_general">Título General</label>
							<input name="titulo_general" class="larger-input" value="<?php echo isset($contenido['titulo_general']) ? $contenido['titulo_general'] : ''; ?>">
						</div>

                        <div class="form-group">
							<label for="resumen">Resumen</label>
							<textarea name="resumen" class="texto-medium"><?php echo isset($contenido['resumen']) ? $contenido['resumen'] : ''; ?></textarea>
						</div>

                        <div class="form-group">
							<label for="video">Link Video</label>
							<input name="video" class="larger-input" value="<?php echo isset($contenido['video']) ? $contenido['video'] : ''; ?>">
						</div>

					</div>

				</div>

                <div class="row">
					
					<div class="col-md-4">
						<div class="form-group">
							<input name="compartir_imagen" type="hidden" value="<?php echo isset($contenido['header_imagen']) ? $contenido['compartir_imagen'] : ''; ?>">
							<img src="/uploads/images/<?php echo isset($contenido['compartir_imagen']) ? $contenido['compartir_imagen'] : ''; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							<label for="titulo_formulario">Título formulario</label>
							<input name="titulo_formulario" class="larger-input" value="<?php echo isset($contenido['titulo_formulario']) ? $contenido['titulo_formulario'] : ''; ?>">
						</div>

                        <div class="form-group">
							<label for="titulo_inferior">Título inferior</label>
							<input name="titulo_inferior" class="larger-input" value="<?php echo isset($contenido['titulo_inferior']) ? $contenido['titulo_inferior'] : ''; ?>">
						</div>
						<div class="form-group">
							<label for="texto">Texto</label>
							<textarea name="texto" class="texto-medium" id="texto"><?php echo isset($contenido['texto']) ? $contenido['texto'] : ''; ?></textarea>
						</div>

						<div class="form-group">
							<label for="url_privacidad">Link Privacidad:</label>
							<input name="url_privacidad" class="larger-input" value="<?php echo isset($contenido['url_privacidad']) ? $contenido['url_privacidad'] : ''; ?>">
						</div>

					</div>

				</div>

                <div class="row">
					
					<div class="col-md-4">
						<div class="form-group">
							<input name="gracias_imagen" type="hidden" value="<?php echo isset($contenido['gracias_imagen']) ? $contenido['gracias_imagen'] : ''; ?>">
							<img src="/uploads/images/<?php echo isset($contenido['gracias_imagen']) ? $contenido['gracias_imagen'] : ''; ?>" class="img-responsive">
							<button type="button" class="btn btn-danger change-image">Cambiar imagen</button>
						</div>
					</div>

					<div class="col-md-8">
                        <div class="form-group">
							<label for="hashtag">Hashtag:</label>
							<input name="hashtag" class="larger-input" value="<?php echo isset($contenido['hashtag']) ? $contenido['hashtag'] : ''; ?>">
						</div>

						<div class="form-group">
							<label for="texto_gracias">Texto gracias</label>
							<textarea name="texto_gracias" class="texto-medium" id="texto_gracias"><?php echo isset($contenido['texto_gracias']) ? $contenido['texto_gracias'] : ''; ?></textarea>
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