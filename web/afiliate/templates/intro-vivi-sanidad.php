<?php

$imagen = 'imagen-movil.jpg';
if ( dispositivo () == 'pc' ) {
	$imagen = 'img-pc.jpg';
}

?>
<div class="section-wrapper">
	<div>
		<h2>
			Viví el sindicato más grande de Capital Federal
		</h2>

		<img src="<?php echo MAINSURL . '/assets/images/' . $imagen; ?>" alt="#vivíSanidad" class="image-responsive">

	</div>

	<div>

		#vivíSanidad

		Conocé todo lo que tenemos para vos acá
		<a href="https://atsa.org.ar">atsa.org.ar</a>		
	</div>
</div>