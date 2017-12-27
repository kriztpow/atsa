<?php 
global $pageActual;

if ( $pageActual != 'inicio' ) : ?>

<article class="widget animation-element fade-in-scroll">
	<a href="<?php echo MAINSURL; ?>/institucional">			
		<h1>Bienvenidos</h1>
		
		<p>
			La Patria había cumplido un siglo, eran épocas duras. Julio Faggioni inaugura el 9 de enero de 1911 el <strong>Colegio Buenos Aires</strong>. 
		</p>
		
		<div class="wrapper-galeria-images">
		
			<?php

			global $galeriaBienvenidos;

		for ($i=0; $i < count($galeriaBienvenidos); $i++) { ?>
			
			<figure>
				<img src="<?php echo UPLOADSURL . '/' . $galeriaBienvenidos[$i]['url']; ?>" alt="<?php echo $galeriaBienvenidos[$i]['alt']; ?>">
				<div class="caption-wrapper">
					<figcaption>
						<?php echo $galeriaBienvenidos[$i]['caption']; ?>
					</figcaption>
				</div>
			</figure>
			
		<?php }	?>
		
		</div>
	</a>
</article>

<?php else : 
//el template de la pagina de incio
?>
<article id="galeria-inicio" class="animation-element fade-in-scroll">
	<div class="galeria-inicio-wrapper">
	
	<?php
	global $galeriaBienvenidos;

	for ($i=0; $i < count($galeriaBienvenidos); $i++) { ?>
		
		<figure>
			<img src="<?php echo UPLOADSURL . '/' . $galeriaBienvenidos[$i]['url']; ?>" alt="<?php echo $galeriaBienvenidos[$i]['alt']; ?>">

			<figcaption>
					<?php echo $galeriaBienvenidos[$i]['caption']; ?>
				</figcaption>
			<div class="caption-wrapper">
				
			</div>
		</figure>
		
	<?php }	?>
	
	</div>	
</article>
<?php endif; ?>