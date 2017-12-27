<?php
load_module( 'promociones' );
?>

<div class="contenido-modulo">
	<div class="container">
		<div class="row">
			<div class="col-30">
				<h2>Activar o desactivar</h2>				
				<p>Se muestra la imagen cargada actualmente.</p>
				<p><strong>Marcar el cuadro para activar la promoción y que aparezca en la página.</strong></p>
				<div class="form-group">
					<label for="popUpActive"><h3>Activar promoción:</h3></label>
					<input type="checkbox" id="popUpActive" name="popUpActive" <?php ispopupActive(); ?>>
				</div>
				<div>
					<button class="btn btn-primary up-new-promo">Cambiar Imagen</button>
				</div>
				<div class="error-tag"></div>
			</div><!-- // col -->

			<div class="col-70">
				<?php showPopupImg (); ?>
			</div><!-- // col -->
			
			
		</div><!-- // row gral modulo -->
	</div><!-- // container gral modulo -->
</div><!-- // wrapper interno modulo -->
<div id="dialog"></div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>