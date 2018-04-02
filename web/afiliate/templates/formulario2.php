<?php
/*
 * Sitio web: ATSA - FORMULARIO 2 - CUIL
 * @LaCueva.tv
 * Since 1.0
*/

global $pageActual;

?>

<form method="POST" name="first-form" id="first-form">

	<input type="hidden" name="id-member" value="">

	<div class="inner-wrapper-form">

		<div class="form-group">
			<input type="text" name="lastname" required class="text-uppercase">
			<label for="lastname" class="text-uppercase">Apellidos*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido
			</span>
		</div>

		

	</div>
	<div class="btn-submit-wrapper">
		<input type="submit" value="Enviar" class="btn-submit">
	</div>

</form>