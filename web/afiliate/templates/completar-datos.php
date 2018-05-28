<?php
/*
 * Sitio web: ATSA - AFILIATE
 * @LaCueva.tv
 * Since 1.0
*/
//variable que permite continuar completando o no, por defecto no
$completar = false;
//para continuar completando, el registro tiene que ser menor a cinco días atras y el link debe ser el correcto, este se va a chequear con la base de datos
$cuil = isset($_GET['cuil']) ? $_GET['cuil'] : '';
$key  = isset($_GET['key']) ? $_GET['key'] : '';
$afiliado = getDataCuil($cuil);

if ( $afiliado != null ) {

	if ( password_verify($key, $afiliado['member_link']) ) {
		$now = new DateTime("now");
		$afiliacion = date_create($afiliado['member_date_registro']);
		
		$interval = date_diff($afiliacion, $now);
		
		if ( $interval->format('%R%a') < 5 ) {
			
			$completar = true;

		}
	}
}

?>
<div class="section-wrapper">
	<div class="container">
		<?php if ( $completar ) : 

			getTemplate( 'formulario-completar', $afiliado );

			else : ?>

			<div class="header-wrapper">
			<hgroup class="error-icon">
				<h1>
					Tiempo excedido, ya no puede autocompletarse
				</h1>

				<h2>
					Comunicate con nosotros para más información.
				</h2>

				<h3>
					<span class="icon-tel"></span>4959-7100
				</h3>
				<h4>
					Saavedra 166 - C1083ACD - Ciudad Autónoma de Bs As
				</h4>
			</hgroup>
		

			
		</div>

		<footer class="footer-wrapper">
			<div class="container">
				<h4>
					Viví el sindicato más grande de Capital Federal
				</h4>

				<div class="footer-bottom">

					<h5>#vivíSanidad</h5>
					<div class="btn-atsa-wrapper">
						<a href="https://atsa.org.ar" target="_blank" class="btn-contorno">
							atsa.org.ar
						</a>
					</div>

				</div>
			</div>

		</footer>

		<?php endif; ?>
	</div>
</div>
