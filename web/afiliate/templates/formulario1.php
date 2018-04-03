<?php
/*
 * Sitio web: ATSA - FORMULARIO 1- CUIL
 * @LaCueva.tv
 * Since 1.0
*/

global $pageActual;
?>

<h1>
	Hacé tu pre-afiliación on line
</h1>

<p>
	Los datos que te pedimos a continuación podés encontrarlos en tu recibo de sueldo. Completá el formulario y te llamamos para contarte cómo sumarte.
</p>

<form method="POST" name="first-form" id="first-form">

	<div class="inner-wrapper-form">

		<div class="form-group">
			<input type="text" name="lastname" required class="text-uppercase">
			<label for="lastname" class="text-uppercase">Apellidos*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido
			</span>
		</div>

		<div class="form-group">
			<input type="text" name="name" required>
			<label for="name" class="">Nombres*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido
			</span>
		</div>

		<div class="form-group">
			<input type="number" name="dni" required>
			<label for="dni" class="">DNI*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido (xxxxxxxxxxx)
			</span>
		</div>

		<div class="form-group">
			<input type="number" name="cuil" required>
			<label for="cuil" class="">CUIL*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido (xxxxxxxxxxx)
			</span>
		</div>

		<div class="form-group">
			
			<input type="number" name="cuit" required>
			<label for="cuit" class="">CUIT*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido (xxxxxxxxxxx)
			</span>
		</div>

		<div class="form-group">
			<input type="date" name="date-start" required>
			<label for="date-start" class="long-label">Fecha de Ingreso a la empresa*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input msj-error-input-background">
				Formato inválido (dd/mm/aaaa)
			</span>
		</div>

	</div>
	<div class="btn-submit-wrapper">
		<input type="submit" value="Enviar" class="btn-submit">
	</div>

</form>
