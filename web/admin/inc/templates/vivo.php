<?php
/*
 * Slider
 * Lista los sliders hechos
 * Since 3.0
 * 
*/

require_once("inc/functions.php");
$video = getVideoVivo();
$texto = getTextVivo();

if ($video == null ) {
	$video = '';
}

if ($texto == null ) {
	$texto = '';
}
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="row">
				<!-- col -->
				<div class="col-md-12 col-sm-12">
					<form method="POST" id="video_vivo_formulario">
						<p>
							Copiar el link de youtube aquí y guardar los cambios. 
						</p>

						<div class="form-group">
							<label for="video_link" style="display: block;">Link del video</label>
							<input style="max-width: 550px;width: 100%;" name="video_link" type="text" value="<?php echo $video; ?>">
						</div>

						<div class="form-group">
							<label for="video_link" style="display: block;">Texto del video</label>
							<textarea style="max-width: 550px;width: 100%; height: 100px;" name="video_text"><?php echo $texto; ?></textarea>
						</div>
						<div class="form-group">
							<input type="submit" value="Guardar" class="btn btn-danger">
						</div>
						<div class="form-group">
							<span class="mensaje-guardado"></span>
						</div>
					</form>
				</div><!-- //col -->
			</div><!-- //row -->
		</div><!-- // container -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->