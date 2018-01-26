<?php
/*
 * Sitio web: Voces de sanidad
 * @LaCueva.tv
 * Since 1.0
 * SIDEBAR SUSCRIPTIONS
*/

$expired = false;
$verified = true;
$imageHeaderDefault = MAINSURL . '/images/header-logo2.png';

$suscDni = '';
$suscNombre = '';
$suscApellido = '';
$suscTel = '';

$email = isset( $_GET['email'] ) ? $_GET['email'] : '';

if ( $email != '' ) {
	
	$emailCode = isset( $_GET['ushash'] ) ? $_GET['ushash'] : '';

	//buscar em base de datos si el usuario tiene el mismo codigo ushash
	
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'suscriptores';

	$query  = "SELECT * FROM " .$tabla. " WHERE susc_email = '{$email}' LIMIT 1";

	$result = mysqli_query($connection, $query);

	closeDataBase( $connection );
	
	if ( $result->num_rows == 0 ) {
		/*
		 * no encuentra email, vuelve a ponerlo en vacio
		*/
		$email = '';
		$msj_NoEncontrado = '<div class="form-response" style="position: relative; margin-bottom: 20px;">
				Email no encontrado, puede completar su suscripción aquí
			</div>';		
		
	} else {
		/*
		* se encuentra email, se chequea que el codigo sea el mismo de la bd y que no haya pasado mucho tiempo
		*/
		$data = mysqli_fetch_array($result);
		
		if ( $emailCode != $data['susc_code_registro'] || $emailCode == '' || $data['susc_code_registro'] = ''  ) {
			$verified = false;
		}

		if (  ($fecha_actual - $data['susc_fecha_email']) >= 1 ) {
			$expired = true;
		}

		$suscDni = $data['susc_dni'];
		$suscNombre = $data['susc_nombre'];
		$suscApellido = $data['susc_apellido'];
		$suscTel = $data['susc_telefono'];
		
	}
}//if email
?>

<!-- Full Width Slider Section -->
<section class="section-block featured-media tm-slider-parallax-container">
	<div class="tm-slider-container full-width-slider" data-parallax data-parallax-fade-out data-animation="slide" data-scale-under="1140" data-scale-min-height="300">
		<ul class="tms-slides">
			<li class="tms-slide" data-image data-force-fit data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.3">
				<div class="tms-content">
					<div class="tms-content-inner center">
						<div class="row">
							<div class="column width-12">
								<h1 class="tms-caption title-xlarge color-white mb-10"
									data-animate-in="preset:scaleOut;duration:1000ms;"
									data-no-scale
								>
									Suscribirse
								</h1>
							</div>
						</div>
					</div>
				</div>
				<img data-src="<?php echo $imageHeaderDefault; ?>" data-retina src="<?php echo $imageHeaderDefault; ?>" alt="<?php echo SITETITLE; ?> - Suscribirse">
			</li>
		</ul>
	</div>
</section>
<!-- Full Width Slider Section -->

<!--Contact Form -->
<section class="section-block replicable-content contact-2">

<?php 
/*
 * Si el código es verificado se muestra el formulario
*/
if ( $verified && ! $expired) :
?>

	<div class="row">
		<div class="column width-8 offset-2">
			<h3 class="mb-50">Aquí puedes completar la información...</h3>
			<?php 
			if ( isset($msj_NoEncontrado) ) {
				echo $msj_NoEncontrado;
			}
			?>
			<div class="contact-form-container">
				<form id="formulario-registro" method="post">
					<div class="row">
						<div class="column width-12">
							<input type="email" name="email" class="form-email form-element rounded large" tabindex="1" <?php if ($email != '') { echo 'value="'.$email.'"'; } else { echo 'placeholder="Correo electrónico*" required'; } ?>>
						</div>
					</div>
					<div class="row">
						<div class="column width-6">
							<input type="text" name="fname" class="form-fname form-element rounded large" placeholder="Nombre*" tabindex="2" required value="<?php echo $suscNombre; ?>">
						</div>
						<div class="column width-6">
							<input type="text" name="lname" class="form-lname form-element rounded large" tabindex="3" required <?php if ($suscApellido != '') { echo 'value="'.$suscApellido.'"'; } else { echo 'placeholder="Apellido"'; } ?>>
						</div>
						
						<div class="column width-6">
							<input type="number" name="telephone" class="form-website form-element rounded large" tabindex="4" required <?php if ($suscTel != '') { echo 'value="'.$suscTel.'"'; } else { echo 'placeholder="Teléfono"'; } ?>>
						</div>
						
						<div class="column width-6">
							<input type="text" name="honeypot" class="form-honeypot form-element large">
						</div>

						<div class="column width-6">
							<input type="number" name="dni" class="form-website form-element rounded large" tabindex="5" required <?php if ($suscDni != '') { echo 'value="'.$suscDni.'"'; } else { echo 'placeholder="DNI"'; } ?>>
						</div>
					</div>
					<div class="row">
						<div class="column width-12">
							<textarea name="message" class="form-message form-element rounded large" placeholder="¿Algún mensaje que quiera dejarnos?" tabindex="6" ></textarea>
						</div>
						<div class="column width-12">
							<input type="submit" class="form-submit button rounded medium bkg-theme bkg-hover-green color-white color-hover-white" <?php if ($email != '') { echo 'value="Guardar datos"'; } else {echo 'value="Enviar formulario"';} ?>>
						</div>
					</div>
				</form>
				<div class="form-response form-response-registro"></div>
			</div>
		</div>
	</div>


<?php 
/*
 * Si el código no es verificado o está expirado se muestra el botón para pedir nuevo código
*/
else :
?>

<div class="row">
		<div class="column width-8 offset-2">
			<h3 class="mb-50">Re suscribirse...</h3>
			<div class="contact-form-container">
				<div class="row">
					<p>
						El tiempo de confirmación ha expirado por no haber completado la información. Haciendo clic en el botón puede volver a repetir el proceso.
					</p>

					<a class="resuscribirse-btn button rounded medium bkg-theme bkg-hover-green color-white color-hover-white">
						Volver a procesar
					</a>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>


</section>
<!--Contact Form End -->
