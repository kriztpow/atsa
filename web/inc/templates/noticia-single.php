<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.8
 * noticias-single (muestra una noticia individual)
*/

//recupera el slug
global $noticia;

//como no hay base de datos va a buscar la noticia entre todas las variables y la va a mostrar
global $dataNoticias;

for ($i=0; $i < count($dataNoticias); $i++) { 
	//recoore el array y solo muestra el que coincide con el url
	//(esto es porque todavia no hay base de datos y no podemos buscar el slug en cuestion)
	$urlNoticia       = $dataNoticias[$i]['urlNoticia'];

	//si es de categoria atsa la muestra
	if ( $urlNoticia == $noticia ) {

		$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
		$bajadaNoticia    = $dataNoticias[$i]['bajadaNoticia'];
		$contenidoNoticia = $dataNoticias[$i]['contenidoNoticia'];
		$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
		$videoNoticia     = $dataNoticias[$i]['videoNoticia'];
		$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array
		$codigoVideo;
		$galImages        = isset($dataNoticias[$i]['imgGal'])?$dataNoticias[$i]['imgGal']:false;
		$galImagesContent = isset($dataNoticias[$i]['imgGalCont'])?$dataNoticias[$i]['imgGalCont']:'';
		
		?>
		<li class="loop-noticias-item">
			<article class="noticia-index">
				<header>
					<div class="main-img-news">
						<div class="date-news">
							<p>
								<strong>
									<?php echo $fechaNoticia[0]; ?>
								</strong><br>
								de 
								<?php echo $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
							</p>
						</div>

						<?php 
						if ( $imgDestacada != '' ) { ?>
							<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="Foto-Noticia-ATSA">
						
						<?php 
						
						} else {

						?>
							<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
						<?php 
						} ?>
						
					</div>

					<div class="title-news">
						<h1>
							<?php echo $tituloNoticia; ?>
						</h1>
					</div>
				</header>
				<section>
					<div class="content-news">
						<div class="first-excerpt">
							<?php //echo $bajadaNoticia; ?>
						</div>

						<?php echo $contenidoNoticia; ?>
					
					<?php 
					//si hay video va aca:
						if ( $videoNoticia != '' ) { 
						//encuentra el código del video de youtube para embeberlo en el iframe

							$codigoVideo = explode('=', $videoNoticia);
							?>
						<div class="wrapper-iframe-video">
							<iframe src="https://www.youtube.com/embed/<?php echo $codigoVideo[1]; ?>" frameborder="0" allowfullscreen></iframe>
						</div>
						<?php
						}
						?>

						<?php 
							//si hay galeria de imagenes va aca:
						if ( $galImages ) { 
							?>
						<!-- #slider -->
						<div class="slider-wrapper slider-wrapper-transparent">
						    <div>
						        <div class="slider">
						            <div class="loader-slider">
						                <img src="assets/images/loader.gif">
						            </div>
						            <ul class="slides">
						            <?php 

						            for ($i=0; $i < count($galImagesContent); $i++) { ?>
						            	<!-- slide item -->
						                <li class="slide-item">
						                    <article>
						                        <figure class="slide-background-img">
						                            <img src="uploads/images/<?php echo $galImagesContent[$i]; ?>">
						                        </figure>
						                    </article>
						                </li>
						                <!-- // slide item -->

						            <?php }
						            ?>  
						            </ul>
						            <ul>
						            <li class="slider-control-left">
						                <span class="icon-control-left"></span>
						            </li>
						            <li class="slider-control-right">
						                <span class="icon-control-right"></span>
						            </li>
						        </ul>
						        </div>
						    </div>
						</div>
						
						<?php
						}
						?>
				</section>
				<footer>
					<p>
						<?php echo $fechaNoticia[0] . ' de ' . $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
					</p>
				</footer>
			</article>
		</li>

		<?php
		break;
	}
}
?>