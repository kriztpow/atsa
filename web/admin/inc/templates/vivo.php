<?php
/*
 * Slider
 * Lista los sliders hechos
 * Since 3.0
 * 
*/

require_once("inc/functions.php");
$video = '';
//$video = getLinkVideoVivo();

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="row">
				<!-- col -->
				<div class="col-md-12 col-sm-12">
					<form method="POST">
						<p>
							Copiar el link de youtube aquí y guardar los cambios.
						</p>

						<div class="form-group">
							<label for="video_link">Link del video</label>
							<input name="video_link" type="text" value="<?php echo $video; ?>">
						</div>
						<div class="form-group">
							<input type="submit" value="Guardar" class="btn btn-danger">
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