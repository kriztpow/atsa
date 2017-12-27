<?php
/*
 * Sitio web: Colegio Buenos Aires
 * @LaCueva.tv
 * Since 1.0
 * PAGE TEMPLATE: PAGINA INICIO
*/
include 'header.php';
?>
<!--- .inner-wrapper: contenido principal y específico del template -->
<div class="inner-wrapper" >
	<header class="header-inicio">

		<div class="container">

			<h1 id="main-title-inicio" class="subtitulo_clasico text-center animation-element fade-in-scroll in-view"">
				Colegio Buenos Aires
			</h1>

			<div class="grid-inicio-wrapper">
				
				<ul class="grid-inicio">
					<li>
						<?php
						global $dispositivo;
						if ( $dispositivo  != 'movil' ) {
							getTemplate( 'widget-bienvenidos', 'inicio' ); 
						}
						?>
					</li>
					<li>
						<?php getTemplate( 'widget-niveles', 'inicio' ); ?>
					</li>
					<li>
						<?php getTemplate( 'widget-campus', 'inicio1' ); ?>
					</li>
					<li>
						<?php getTemplate( 'widget-campo-deportes', 'inicio' ); ?>
					</li>
					<li>
						<?php getTemplate( 'widget-certificaciones', 'utn' ); ?>
					</li>
					<li>
						<?php getTemplate( 'widget-certificaciones', 'idioma' ); ?>
					</li>
				</ul>

			</div>
		</div>

	</header>
	<!-- main-content -->
	<div class="inicio">
		<div class="container">

			<div class="row">
				<div class="col-50">
	<!--- INSTITUCIONAL -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Institucional
						</h2>
						
						<div id="institucional-acordion" class="animation-element fade-in-scroll">
							<h3 class="institucional-titulo acordion-color-verde2">
								<span class="icon-institucional">+</span>
								Historia
							</h3>
							<div class="institucional-contenido">
								<div class="acordion-container">
									<p class="text-justify">
										La Patria había cumplido un siglo y eran épocas muy duras y llenas de privaciones. Un joven maestro y profesor de Ciencias, proveniente de Rosario, provincia de Santa Fe, soñaba con fundar un instituto educativo. Desde temprana edad el joven Julio Faggioni había sentido el llamado de su vocación docente. 
									</p>
									<a href="<?php echo MAINSURL; ?>/institucional" class="btn btn-border-verde btn-sm">
										Leer más
									</a>
								</div>
							</div>
							<h3 class="institucional-titulo acordion-color-naranja">
								<span class="icon-institucional">+</span>
								Equipo directivo
							</h3>
							<div class="institucional-contenido">
								<div class="acordion-container">
									
									<?php getTemplate('autoridades'); ?>
									
								</div>
							</div>
						</div>

					</section>
				</div>

				<div class="col-50">
	<!--- NOTICIAS -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Noticias
						</h2>
						<ul class="last-news-list">

						<?php 
						$noticias = getPosts( 'noticias', 2 ); 	
						for ($i=0; $i < count($noticias); $i++) { ?>
							<li>
								<article class="wrapper-news animation-element fade-in-scroll">
									
									<a href="<?php echo MAINSURL . '/noticias/' . $noticias[$i]['post_url']; ?>" title="Leer más">
											<figure>
												<img src="<?php echo UPLOADSURL . '/' . $noticias[$i]['post_imagen']; ?>" alt="<?php echo $noticias[$i]['post_titulo']; ?>" class="image-responsive">
											</figure>		
										</a>
									
									<div class="wrapper-news-data">
										

										<a href="<?php echo MAINSURL . '/noticias/' . $noticias[$i]['post_url']; ?>" title="Leer más">
											<h1>
												<?php echo $noticias[$i]['post_titulo']; ?>
											</h1>
										</a>
										
										<p class="text-justify">
											<?php echo acortaTexto( $noticias[$i]['post_resumen'], 10 ); ?>
										</p>
										<p>
											<a class="btn btn-sm btn-primary" href="<?php echo MAINSURL . '/noticias/' . $noticias[$i]['post_url']; ?>">Leer más</a>
										</p>

									</div>
									
								</article>
							</li>		 	
						<?php } ?>
							
						</ul>
					</section>
				</div>
			</div>

		</div><!--- //.container -->


	<!--- INSCRIBITE -->
	    <aside class="separador-inscribite animation-element slide-up in-view">
	    	<?php getTemplate( 'separador-inscribite' ); ?>
	    </aside>
	
		<div class="container">
			<div class="row">
				<div class="col-50">
	<!--- CAMPUS -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Campus Virtual
						</h2>

						<?php getTemplate( 'widget-campus', 'inicio2' ); ?>

					</section>
				</div>

				<div class="col-50">
	<!--- NIVELES -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Niveles
						</h2>
						
						<?php getTemplate( 'widget-niveles' ); ?>

					</section>
				</div>
			</div>
		
			
			<div class="row">
				<div class="col-50">
	<!--- CONTACTO -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Contacto
						</h2>
						<p class="text-justify animation-element fade-in-scroll">
							Puede completar el formulario para solicitar información o hacer consultas sobre nuestras propuestas educativas. ¡Le responderemos a la brevedad!
						</p>
						<div class="contact-form-wrapper animation-element fade-in-scroll">
							<?php getTemplate( 'formulario-contacto' ); ?>
						</div>
					</section>
				</div>

				<div class="col-50">
	<!--- MAPA -->
					<section>
						<h2 class="subtitulo_clasico text-center animation-element fade-in-scroll">
							Mapa
						</h2>
						<p class="animation-element fade-in-scroll">
							Colegio Buenos Aires se encuentra en <?php echo COLEGIODIRECCION; ?>
						</p>

						<iframe src="<?php echo MAPAGOOGLE; ?>" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen class="animation-element fade-in"></iframe>
					</section>
				</div>
			</div>
		</div><!--- //.container -->
		
	</div><!--- //.content-niveles (main content) -->

	<aside class="frases-inicio animation-element fade-in-scroll">
		<?php getTemplate( 'widget-frases' ); ?>
	</aside>

</div><!--- //.inner-wrapper -->

<?php include 'footer.php'; ?>