<?php
$grupoFamiliar = null;
$empresa = null;
$domicilio = null;
$contactoOtros = null;
//unserialize empresa
if ( $data['member_empresa'] != null ) {
	$empresa = unserialize($data['member_empresa']);
}
//unserialize grupo familiar
if ( $data['member_grupo_familiar'] != null ) {
	$grupoFamiliar = unserialize($data['member_grupo_familiar']);
}

//unserialize domicilio
if ( $data['member_domicilio'] != null ) {
	$domicilio = unserialize($data['member_domicilio']);
}
//unserialize contacto otros
if ( $data['member_contacto_otros'] != null ) {
	$contactoOtros = unserialize($data['member_contacto_otros']);
}
?>
<div class="wrapper-impresion">
	<div class="loader"></div>
	<form method="POST" name="afiliado_form" id="afiliado_form" class="afiliado_form">

		<input type="hidden" name="member_id" value="<?php echo $data['member_id']; ?>" class="input_member_id">
		<input type="hidden" name="member_registration_id" value="afiliado" class="input_username">

	<!-- DATA PRINCIPAL -->
		<section class="form-section">
			<h2 class="form-subtitle">
				Solicitud de Ingreso
			</h2>
			<div class="rows-print">
				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_cuil">
							CUIL
						</label>
						<input type="number" name="afiliado_cuil" class="input-afiliado-cuil" value="<?php echo $data['member_cuil']; ?>" <?php if ($data['member_cuil'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_dni">
							DNI
						</label>
						<input type="number" name="afiliado_dni" class="input-afiliado-dni" value="<?php echo $data['member_dni']; ?>" <?php if ($data['member_dni'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_fecha_afiliacion">
							F.&nbsp;Afiliación
						</label>
						<input type="date" name="afiliado_fecha_afiliacion" class="input-afiliado-fecha-afiliacion" value="<?php echo $data['member_fecha_afiliacion']; ?>" readonly>
					</div>
					<span class="separator-vertical-right"></span>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_fecha_ingreso_sindicato">
							F.&nbsp;Ingreso Sind.
						</label>
						<input type="date" name="afiliado_fecha_ingreso_sindicato" class="input-afiliado-fecha-ingreso-sindicato" value="<?php echo $data['member_fecha_ingreso_sindicato']; ?>" readonly>
					</div>
				</div>

				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_apellido">
							Apellido/s			
						</label>
						<input type="text" name="afiliado_apellido" class="input-afiliado-apellido" value="<?php echo $data['member_apellido']; ?>" <?php if ($data['member_apellido'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_nombre">
							Nombre/s
						</label>
						<input type="text" name="afiliado_nombre" class="input-afiliado-nombre" value="<?php echo $data['member_nombre']; ?>" <?php if ($data['member_nombre'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>

				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_nacionalidad">
							Nacionalidad
						</label>
						<input type="text" name="afiliado_nacionalidad" class="input-afiliado-nacionalidad" value="<?php echo $data['member_nacionalidad']; ?>" <?php if ($data['member_nacionalidad'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_estado_civil">
							Estado&nbsp;Civil
						</label>
						<input type="text" name="afiliado_estado_civil" class="input-afiliado-estado-civil" value="<?php echo $data['member_estado_civil']; ?>" <?php if ($data['member_estado_civil'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_sexo">
							Sexo
						</label>
						<input type="text" name="afiliado_sexo" class="input-afiliado-sexo" value="<?php echo $data['member_sexo']; ?>" <?php if ($data['member_sexo'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_fecha_nacimiento">
							F.&nbsp;Nacimiento
						</label>
						<input type="date" name="afiliado_fecha_nacimiento" class="input-afiliado-fecha-nacimiento" value="<?php echo $data['member_fecha_nacimiento']; ?>" <?php if ($data['member_fecha_nacimiento'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>

				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_profesion">
							Profesión
						</label>
						<input type="text" name="afiliado_profesion" class="input-afiliado-profesion" value="<?php echo $data['member_profesion']; ?>" <?php if ($data['member_profesion'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_estudios">
							Estudios
						</label>
						<input type="text" name="afiliado_estudios" class="input-afiliado-estudios" value="<?php echo $data['member_estudios']; ?>" <?php if ($data['member_estudios'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_discapacidad">
							Discapacidad
						</label>
						<input type="checkbox" name="afiliado_discapacidad" class="input-afiliado-discapacidad"<?php 
								if( $data['member_discapacidad'] ) {
									echo ' checked';
								}
								?>>
					</div>
				</div>
			</div>
		</section><!-- //DATA PRINCIPAL -->

	<!-- DOMICILIO -->
		<section class="form-section">
			<h2 class="form-subtitle">
				Domicilio
			</h2>
			<div class="rows-print">
				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_calle">
							Calle
						</label>
						<input type="text" name="afiliado_calle" class="input-afiliado-calle" value="<?php if ( $domicilio != null && isset( $domicilio['calle'] ) ) {
							echo $domicilio['calle'];
						} ?>" <?php if ( isset( $domicilio['calle'] ) && $domicilio['calle'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_altura">
							Altura
						</label>
						<input type="text" name="afiliado_altura" class="input-afiliado-altura" value="<?php if ( $domicilio != null && isset( $domicilio['altura'] ) ) {
										echo $domicilio['altura'];
									} ?>" <?php if ( isset( $domicilio['altura'] ) && $domicilio['altura'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_piso">
							Piso
						</label>
						<input type="text" name="afiliado_piso" class="input-afiliado-piso" value="<?php if ( $domicilio != null && isset( $domicilio['piso'] ) ) {
										echo $domicilio['piso'];
									} ?>" <?php if ( isset( $domicilio['piso'] ) && $domicilio['piso'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_departamento">
							Departamento
						</label>
						<input type="text" name="afiliado_departamento" class="input-afiliado-departamento" value="<?php if ( $domicilio != null && isset( $domicilio['departamento'] )) {
										echo $domicilio['departamento'];
									} ?>" <?php if ( isset( $domicilio['departamento'] ) && $domicilio['departamento'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>

				<div class="row-form">
					<div class="input-label-wrapper input-label-wrapper-nogrow" style="width: 30%;">
						<label for="afiliado_localidad">
							Localidad
						</label>
						<input type="text" name="afiliado_localidad" class="input-afiliado-localidad" value="<?php echo $data['member_localidad']; ?>" <?php if ($data['member_localidad'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_codigo_postal">
							CP
						</label>
						<input type="text" name="afiliado_codigo_postal" class="input-afiliado-codigo-postal" value="<?php echo $data['member_codigo_postal']; ?>" <?php if ($data['member_codigo_postal'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_provincia">
							Provincia
						</label>
						<input type="text" name="afiliado_provincia" class="input-afiliado-provincia" value="<?php echo $data['member_provincia']; ?>" <?php if ($data['member_provincia'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper" style="width: 40%">
						<label for="afiliado_otros">
							Otros
						</label>
						<input type="text" name="afiliado_otros" class="input-afiliado-otros" value="">
					</div>
				</div>
			</div>
		</section><!-- //DOMICILIO -->

	<!-- CONTACTO -->
		<section class="form-section">
			<h2 class="form-subtitle">
				Contacto
			</h2>
			<div class="rows-print">
				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_movil">
							Tel. celular
						</label>
						<input type="number" name="afiliado_movil" class="input-afiliado-movil" value="<?php echo $data['member_movil']; ?>" <?php if ($data['member_movil'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_telefono">
							Tel. Fijo
						</label>
						<input type="number" name="afiliado_telefono" class="input-afiliado-telefono" value="<?php echo $data['member_telefono']; ?>" <?php if ($data['member_telefono'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_email">
							E-Mail
						</label>
						<input type="email" name="afiliado_email" class="input-afiliado-email" value="<?php echo $data['member_email']; ?>" <?php if ($data['member_email'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>
				
				<div class="row-form">
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_redes_sociales_facebook">
							Redes Sociales
						</label>
						<span class="sr-only">Facebook</span>
						<span class="icon-redes-l icon-redes-l-facebook"></span>
						<input type="checkbox" name="afiliado_redes_sociales_facebook" class="input-afiliado-redes-sociales-facebook" <?php 
								if( $contactoOtros['facebook'] ) {
									echo ' checked';
								}
								?>>
						<span class="sr-only">Twitter</span>
						<span class="icon-redes-l icon-redes-l-twitter"></span>
						<input type="checkbox" name="afiliado_redes_sociales_twitter" class="input-afiliado-redes-sociales-twitter" <?php 
								if( $contactoOtros['twitter'] ) {
									echo ' checked';
								}
								?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_via_contacto">
							Vía de contacto preferida
						</label>
						<input type="text" name="afiliado_via_contacto" class="input-afiliado-via-contacto" value="<?php echo $contactoOtros['preferida']; ?>" <?php if ($contactoOtros['preferida'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>
			</div>
		</section><!-- //CONTACTO -->

	<!-- EMPRESA -->
		<section class="form-section">
			<h2 class="form-subtitle">
				Empresa
			</h2>
			<div class="rows-print">
				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_cuit">
							Cuit
						</label>
						<input type="number" name="afiliado_cuit" class="input-afiliado-cuit" value="<?php if ( $empresa != null && isset( $empresa['cuit-empresa'] )) {
								echo $empresa['cuit-empresa'];
							} ?>" <?php if ( isset( $empresa['cuit-empresa'] ) && $empresa['cuit-empresa'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_razon_social">
							Razón Social
						</label>
						<input type="text" name="afiliado_razon_social" class="input-afiliado-razon-social" value="<?php if ( $empresa != null && isset( $empresa['razon-social'] )) {
								echo $empresa['razon-social'];
							} ?>" <?php if ( isset( $empresa['razon-social'] ) && $empresa['razon-social'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>

				<div class="row-form">
					<div class="input-label-wrapper">
						<label for="afiliado_establecimiento">
							Establecimiento
						</label>
						<input type="text" name="afiliado_establecimiento" class="input-afiliado-establecimiento" value="<?php if ( $empresa != null && isset( $empresa['empresa-establecimiento'] )) {
								echo $empresa['empresa-establecimiento'];
							} ?>" <?php if ( isset( $empresa['empresa-establecimiento'] ) && $empresa['empresa-establecimiento'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper">
						<label for="afiliado_empresa_direccion">
							Dirección
						</label>
						<input type="text" name="afiliado_empresa_direccion" class="input-afiliado-empresa-direccion" value="<?php if ( $empresa != null && isset( $empresa['empresa_domicilio'] )) {
								echo $empresa['empresa_domicilio'];
							} ?>" <?php if ( isset( $empresa['empresa_domicilio'] ) && $empresa['empresa_domicilio'] != '') {echo 'readonly'; } ?>>
					</div>
					<div class="input-label-wrapper input-label-wrapper-nogrow">
						<label for="afiliado_fecha_ingreso">
							Fecha de Ingreso
						</label>
						<input type="date" name="afiliado_fecha_ingreso" class="input-afiliado-fecha-ingreso" value="<?php echo $data['member_fecha_ingreso']; ?>" <?php if ($data['member_fecha_ingreso'] != '') {echo 'readonly'; } ?>>
					</div>
				</div>
			</div>
		</section><!-- //EMPRESA -->
		
	<!-- GRUPO FAMILIAR -->
		<section class="form-section">
			<h2 class="form-subtitle">
				Grupo familiar
			</h2>
			<div class="btns-wrappers no-print">
				<button class="btn btn-danger btn-xs btn-add-family" type="button">
					Agregar nuevo Familiar
				</button>
			</div>
			<div class="rows-print">
				<table class="table-grupo-familiar">
					<thead>
						<tr>
							<td>
								#
							</td>
							<td>
								Parentesco
							</td>
							<td>
								Nombre y Apellido
							</td>
							<td>
								Nacionalidad
							</td>
							<td>
								Fecha de Nac.
							</td>
							<td>
								DNI
							</td>
							<td>
								Sexo
							</td>
							<td>
								Discap.
							</td>
							<td></td>
						</tr>
					</thead>
					<tbody class="inputs-grupo-familiar">
					<?php

						if ( $grupoFamiliar != null ) {
							getTemplate( 'template-nuevo-familiar', $grupoFamiliar );
						} 
					?>
					</tbody>
				</table>
			</div>
		</section><!-- //GRUPO FAMILIAR -->

		<hr class="no-print">
		<div class="btns-wrappers no-print">
			<span class="msj-error"></span>
			<input class="btn btn-danger" type="submit" value="Enviar">
		</div>
	</form>
</div>