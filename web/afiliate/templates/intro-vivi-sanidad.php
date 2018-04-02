<?php

$imagen = 'imagen-movil.jpg';
if ( dispositivo () == 'pc' ) {
	$imagen = 'img-pc.jpg';
}

?>
<div class="section-wrapper">
	<div class="container">
		<div class="intro-sanidad-wrapper">
			<h2>
				Viví el sindicato más grande de Capital Federal
			</h2>

			<img src="<?php echo MAINSURL . '/assets/images/' . $imagen; ?>" alt="#vivíSanidad">


			<h5>#vivíSanidad</h5>
		</div>


		<div class="footer-bottom">

			<h4>
				Conocé todo lo que tenemos para vos acá
			</h4>
			<div class="btn-atsa-wrapper-intro">
				<a href="https://atsa.org.ar" target="_blank" class="btn-contorno">
					atsa.org.ar
				</a>
			</div>

		</div>
	</div>
</div>