<?php
/*
 * Lista los afiliados
 * Since 4.0
 * 
*/
load_module( 'contactos' );
$cuil = $_GET['slug'];
$afiliado = getDataAfiliadoAdmin($cuil);
$grupoFamiliar = null;
$empresa = null;
//unserialize
if ( $afiliado['member_empresa'] != null ) {
	$empresa = unserialize($afiliado['member_empresa']);
}
if ( $afiliado['member_grupo_familiar'] != null ) {
	$grupoFamiliar = unserialize($afiliado['member_grupo_familiar']);
}

?>

<!---------- afiliado ---------------->

<div class="contenido-modulo">
	<div class="container">
		<div class="wrapper-impresion">
			<header class="header-imprimir no-screen">
				
					<h2 class="brand-name">
	                    <img src="<?php echo URLADMINISTRADOR; ?>/assets/images/logo-print.png" alt="logo ATSA">
	                </h2>

	                <div class="titulo">
	                	<h1>
	                		Formulario de Pre - Afiliación
	                	</h1>
	                	<h3>
	                		Personería Gremial Nº 274 Adherida a F.A.T.S.A. - CGT
	                	</h3>
	                </div>
	            
			</header>

			<form method="POST" name="afiliado_form" id="afiliado_form" class="afiliado_form">

				<input type="hidden" name="member_id" value="new">
				<div class="wrapper-notes-status no-print">
					
					<div class="select-wrapper">
						<h3>Estado Afiliado:</h3>
						<select name="afiliado_status">
							<?php 
							global $afiliadoStatus;
							//$status = $data['member_status'];
							for ($i=0; $i < count($afiliadoStatus); $i++) { 
								$option  = '<option value="';
								$option .= $afiliadoStatus[$i]['status'];
								$option .= '"';
								/*if ( $afiliadoStatus[$i]['status'] == $data['member_status'] ) {
									$option .= ' selected';	
								}*/
								$option .= '>';
								$option .= $afiliadoStatus[$i]['definicion'];
								$option .= '</option>';
								
								echo $option;
							}
							?>
						</select>
					</div>

					<div class="note-wrapper">
						<h3>Notas:</h3>
						<textarea></textarea>
					</div>

				</div>
				

			<!-- DATA PRINCIPAL -->
				<section class="form-section">
					<h2 class="form-subtitle">
						Solicitud de Ingreso
					</h2>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_cuil">
								CUIL
							</label>
							<input type="number" name="afiliado_cuil" class="input-afiliado-cuil" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_dni">
								DNI
							</label>
							<input type="number" name="afiliado_dni" class="input-afiliado-dni" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_fecha_afiliacion">
								F. Afiliación
							</label>
							<input type="date" name="afiliado_fecha_afiliacion" class="input-afiliado-fecha-afiliacion" value="">
						</div>
						<span class="separator-vertical-right"></span>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_fecha_ingreso_sindicato">
								F. Ingreso Sind.
							</label>
							<input type="date" name="afiliado_fecha_ingreso_sindicato" class="input-afiliado-fecha-ingreso-sindicato" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_apellido">
								Apellido/s			
							</label>
							<input type="text" name="afiliado_apellido" class="input-afiliado-apellido" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_nombre">
								Nombre/s
							</label>
							<input type="text" name="afiliado_nombre" class="input-afiliado-nombre" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_nacionalidad">
								Nacionalidad
							</label>
							<input type="text" name="afiliado_nacionalidad" class="input-afiliado-nacionalidad" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_estado_civil">
								Estado&nbsp;Civil
							</label>
							<input type="text" name="afiliado_estado_civil" class="input-afiliado-estado-civil" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_sexo">
								Sexo
							</label>
							<input type="text" name="afiliado_sexo" class="input-afiliado-sexo" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_fecha_nacimiento">
								F.&nbsp;Nacimiento
							</label>
							<input type="date" name="afiliado_fecha_nacimiento" class="input-afiliado-fecha-nacimiento" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_profesion">
								Profesión
							</label>
							<input type="text" name="afiliado_profesion" class="input-afiliado-profesion" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_estudios">
								Estudios
							</label>
							<input type="text" name="afiliado_estudios" class="input-afiliado-estudios" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_discapacidad">
								Discapacidad
							</label>
							<input type="checkbox" name="afiliado_discapacidad" class="input-afiliado-discapacidad" value="">
						</div>
					</div>
				</section><!-- //DATA PRINCIPAL -->

			<!-- DOMICILIO -->
				<section class="form-section">
					<h2 class="form-subtitle">
						Domicilio
					</h2>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_calle">
								Calle
							</label>
							<input type="text" name="afiliado_calle" class="input-afiliado-calle" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_altura">
								Altura
							</label>
							<input type="text" name="afiliado_altura" class="input-afiliado-altura" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_piso">
								Piso
							</label>
							<input type="text" name="afiliado_piso" class="input-afiliado-piso" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_departamento">
								Departamento
							</label>
							<input type="text" name="afiliado_departamento" class="input-afiliado-departamento" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_localidad">
								Localidad
							</label>
							<input type="text" name="afiliado_localidad" class="input-afiliado-localidad" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_codigo_postal">
								CP
							</label>
							<input type="text" name="afiliado_codigo_postal" class="input-afiliado-codigo-postal" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_provincia">
								Provincia
							</label>
							<input type="text" name="afiliado_provincia" class="input-afiliado-provincia" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_otros">
								Otros
							</label>
							<input type="text" name="afiliado_otros" class="input-afiliado-otros" value="">
						</div>
					</div>
				</section><!-- //DOMICILIO -->

			<!-- CONTACTO -->
				<section class="form-section">
					<h2 class="form-subtitle">
						Contacto
					</h2>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_movil">
								Tel. celular
							</label>
							<input type="number" name="afiliado_movil" class="input-afiliado-movil" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_telefono">
								Tel. Fijo
							</label>
							<input type="number" name="afiliado_telefono" class="input-afiliado-telefono" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_email">
								E-Mail
							</label>
							<input type="email" name="afiliado_email" class="input-afiliado-email" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_redes_sociales_facebook">
								Redes Sociales
							</label>
							<span class="sr-only">Facebook</span>
							<span class="icon-redes-l icon-redes-l-facebook"></span>
							<input type="checkbox" name="afiliado_redes_sociales_facebook" class="input-afiliado-redes-sociales-facebook">
							<span class="sr-only">Twitter</span>
							<span class="icon-redes-l icon-redes-l-twitter"></span>
							<input type="checkbox" name="afiliado_redes_sociales_twitter" class="input-afiliado-redes-sociales-twitter">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_via_contacto">
								Vía de contacto preferida
							</label>
							<input type="text" name="afiliado_via_contacto" class="input-afiliado-via-contacto" value="">
						</div>
					</div>
				</section><!-- //CONTACTO -->

			<!-- EMPRESA -->
				<section class="form-section">
					<h2 class="form-subtitle">
						Empresa
					</h2>
					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_cuit">
								Cuit
							</label>
							<input type="number" name="afiliado_cuit" class="input-afiliado-cuit" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_razon_social">
								Razón Social
							</label>
							<input type="text" name="afiliado_razon_social" class="input-afiliado-razon-social" value="">
						</div>
					</div>

					<div class="row-form">
						<div class="input-label-wrapper">
							<label for="afiliado_establecimiento">
								Establecimiento
							</label>
							<input type="text" name="afiliado_establecimiento" class="input-afiliado-establecimiento" value="">
						</div>
						<div class="input-label-wrapper">
							<label for="afiliado_empresa_direccion">
								Dirección
							</label>
							<input type="text" name="afiliado_empresa_direccion" class="input-afiliado-empresa-direccion" value="">
						</div>
						<div class="input-label-wrapper input-label-wrapper-nogrow">
							<label for="afiliado_fecha_ingreso">
								Fecha de Ingreso
							</label>
							<input type="date" name="afiliado_fecha_ingreso" class="input-afiliado-fecha-ingreso" value="">
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
							</tr>
						</thead>
						<tbody class="inputs-grupo-familiar">
						<?php 
						$number = 0;
						for ($i=0; $i < 7; $i++) {
						$number++
						?>

							<tr>
								<td>
									<?php echo $number; ?>
								</td>
								<td>
									<input type="text" name="afiliado_pariente_parentesco" class="input-afiliado-pariente-parentesco" value="">
								</td>
								<td>
									<input type="text" name="afiliado_pariente_nombre" class="input-afiliado-pariente-nombre" value="">
								</td>
								<td>
									<input type="text" name="afiliado_pariente_nacionalidad" class="input-afiliado-pariente-nacionalidad" value="">
								</td>
								<td>
									<input type="text" name="afiliado_pariente_nacimiento" class="input-afiliado-pariente-nacimiento" value="">
								</td>
								<td>
									<input type="text" name="afiliado_pariente_dni" class="input-afiliado-pariente-dni" value="">
								</td>
								<td>
									<input type="text" name="afiliado_pariente_sexo" class="input-afiliado-pariente-sexo" value="">
								</td>
								<td>
									<input type="checkbox" name="afiliado_pariente_discapacidad" class="input-afiliado-pariente-discapacidad">
								</td>
							</tr>
									
						<?php }//for
							?>
						</tbody>
					</table>
					
				</section><!-- //GRUPO FAMILIAR -->
			

				<hr class="no-print">
				<div class="btns-wrappers no-print">
					<input class="btn btn-primary btn-print print_page" type="button" value="Imprimir">
					<input class="btn btn-danger" type="submit" value="Guardar">
				</div>
			</form>


			<footer class="footer-imprimir no-screen">
				<p>
					Por la presente ratifico mi expresa voluntad de afiliarme a la ASOCIACIÓN DE TRABAJADORES DE LA SANIDAD ARGENTINA (A.T.S.A Buenos Aires) y que arbitre los medios necesarios para que mi empleador retengo un 2% sobre mis haberes en concepto de cuota sindical.
				</p>

				<ul class="firmas">
					<li>
						Firma del solicitante
					</li>
					<li>
						Aclaración
					</li>
				</ul>

				<div class="legales-footer-imprimir">
					A.T.S.A Bs. As. Saavedra 166 C.A.B.A. Tel: 4959-7100 (líneas rotativas) www.atsa.org.ar - sindicato@atsa.org.ar
					<span class="icon-twitter-footer"></span>@atsabsas <span class="icon-facebook-footer"></span>ATSABSAS
				</div>
			</footer>
		</div><!-- // wrapper-impresion -->
		
	</div><!-- // container -->
</div><!-- // contenido-modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
    <a type="button" href="index.php?admin=edit-contacts" class="btn btn-danger">agregar uno nuevo</a>
    <a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
</footer>

<!---------- fin afiliado ---------------->