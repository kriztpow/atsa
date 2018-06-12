<?php

$imagen = 'imagen-movil.jpg';
$video = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/rSif-aMqk30?rel=0&amp;controls=0&amp;showinfo=0&amp;" frameborder="0" allow="autoplay; encrypted-media"  allowfullscreen></iframe>';
if ( dispositivo () == 'pc' ) {
	$imagen = 'img-pc.jpg';
	$video = '<iframe width="100%" height="255" src="https://www.youtube.com/embed/rSif-aMqk30?rel=0&amp;controls=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allow="autoplay; encrypted-media"  allowfullscreen></iframe>';
}

?>
<div class="section-wrapper">
	<div class="container">
		<div class="intro-sanidad-wrapper">
			<h2>
				Viví el sindicato más grande de Capital Federal
			</h2>

			<!--<img src="<?php echo MAINSURL . '/assets/images/' . $imagen; ?>" alt="#vivíSanidad">-->

			<?php echo $video; ?>

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
			<div class="btn-atsa-wrapper-intro" style="width: 100%;text-align: center;margin: 50px 0 0;">
						<a href="<?php echo MAINSURL; ?>/afiliados/" target="_blank" class="btn-contorno">Acceso exclusivo para Delegados</a>
					</div>
		</div>
	</div>
</div>
