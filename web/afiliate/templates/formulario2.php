<?php
/*
 * Sitio web: ATSA - FORMULARIO 2 - CUIL
 * @LaCueva.tv
 * Since 1.0
*/
global $pageActual;

if ( $data == null || $data == '' ) :
	
	echo '<script>window.location.href = "' .MAINSURL. '/error"</script>';

else : ?>

	<form method="POST" name="second-form" id="second-form">

		<input type="hidden" name="id-member" value="<?php echo $data; ?>">

		<div class="inner-wrapper-form-no-padding">

			<h3 class="no-margin-top">
				Continúa completando tus datos
			</h3>
			<div class="form-group-wrapper-cols">
				<div class="form-group form-col-50">
					<input type="number" name="member_tel" required>
					<label for="member_tel">Teléfono*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input">
						Formato inválido
					</span>
				</div>

				<div class="form-group form-col-50">
					<input type="number" name="member_cellphone" required>
					<label for="member_cellphone" class="label-col-right">Celular*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input">
						Formato inválido
					</span>
				</div>
			</div>

			<div class="form-group">
				<input type="email" name="member_email" required>
				<label for="member_email">Email*</label>
				<span class="icon-input"></span>
				<span class="msj-error-input">
					Formato inválido
				</span>
			</div>

			<h3>
				Domicilio Laboral		
			</h3>

			<div class="form-group-wrapper-cols">
				<div class="form-group form-col-60">
					<input type="text" name="job_street" required>
					<label for="job_street">Calle*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input">
						Formato inválido
					</span>
				</div>

				<div class="form-group form-col-40">
					<input type="number" name="job_number" required>
					<label for="job_number" class="label-col-right">Altura*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input msj-error-input-col">
						Formato inválido
					</span>
				</div>
			</div>

			<div class="form-group">
				<input type="text" name="job_city" required>
				<label for="job_city">Localidad*</label>
				<span class="icon-input"></span>
				<span class="msj-error-input">
					Formato inválido
				</span>
			</div>

			<h3>
				Domicilio Personal
			</h3>

			<div class="form-group-wrapper-cols">
				<div class="form-group form-col-60">
					<input type="text" name="member_street" required>
					<label for="member_street">Calle*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input">
						Formato inválido
					</span>
				</div>

				<div class="form-group form-col-40">
					<input type="number" name="member_number" required>
					<label for="member_number" class="label-col-right">Altura*</label>
					<span class="icon-input"></span>
					<span class="msj-error-input msj-error-input-col">
						Formato inválido
					</span>
				</div>
			</div>

			<div class="form-group">
				<input type="text" name="member_city" required>
				<label for="member_city">Localidad*</label>
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

<?php endif;