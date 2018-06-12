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

<p class="msj-inicio">
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

		<div class="form-group">
			<input type="number" name="member_tel">
			<label for="member_tel">Teléfono Particular*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido (Escriba sin guiones)
			</span>
		</div>

		<div class="form-group">
			<input type="number" name="member_cellphone">
			<label for="member_cellphone" class="label-col-right">Celular*</label>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Formato inválido (011 15, Escriba sin guiones)
			</span>
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
		<!--<input type="text" name="job_city" required>
			<label for="job_city">Localidad*</label>-->
			
			<select name="job_city">
				<option value="" disabled selected hidden>Elegir una...</option>
				<option value="caba">Ciudad de Buenos Aires</option>
				<option value="buenos-aires">Buenos Aires</option>
				<option value="catamarca">Catamarca</option>
				<option value="chaco">Chaco</option>
				<option value="chubut">Chubut</option>
				<option value="cordoba">Córdoba</option>
				<option value="corrientes">Corrientes</option>
				<option value="entre-rios">Entre Ríos</option>
				<option value="formosa">Formosa</option>
				<option value="jujuy">Jujuy</option>
				<option value="la-pampa">La Pampa</option>
				<option value="la-rioja">La Rioja</option>
				<option value="mendoza">Mendoza</option>
				<option value="misiones">Misiones</option>
				<option value="neuquen">Neuquén</option>
				<option value="rio-negro">Río Negro</option>
				<option value="salta">Salta</option>
				<option value="san-juan">San Juan</option>
				<option value="san-luis">San Luis</option>
				<option value="santa-cruz">Santa Cruz</option>
				<option value="santa-fe">Santa Fé</option>
				<option value="santiago-del-estero">Santiago del Estero</option>
				<option value="tierra-del-fuego">Tierra del Fuego</option>
				<option value="tucuman">Tucumán</option>
			</select>
			<span class="icon-input"></span>
			<span class="msj-error-input">
				Debe seleccionar uno
			</span>
		</div>
	</div>
	<div class="btn-submit-wrapper">
		<input type="submit" value="Enviar" class="btn-submit">
	</div>

</form>
