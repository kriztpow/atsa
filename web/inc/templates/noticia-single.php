<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.8
 * noticias-single (muestra una noticia individual)
*/

global $dataNoticia;
$imgGaleria = $dataNoticia['imgGaleria'];

?>
<li class="loop-noticias-item">
	<article class="noticia-index">
		<header>
			<div class="main-img-news">
				<div class="date-news">
					<p>
						<strong>
							<?php echo $dataNoticia['dia']; ?>
						</strong><br>
						de 
						<?php echo $dataNoticia['mes'] .' '. $dataNoticia['year']; ?>
					</p>
				</div>

				<?php 
				if ( $dataNoticia['imgDestacada'] != '' ) { ?>
					<img src="uploads/images/<?php echo $dataNoticia['imgDestacada']; ?>" alt="<?php echo $dataNoticia['titulo']; ?> | Noticias-ATSA">
				<?php 
				} else {
				?>
					<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
				<?php 
				} ?>
			</div>

			<div class="title-news">
				<h1>
					<?php echo $dataNoticia['titulo']; ?>
				</h1>
			</div>
		</header>
		<section>
			<div class="content-news">
				<?php echo $dataNoticia['contenido'];
			
			
			//si hay video va aca:
				if ( $dataNoticia['video'] != '' ) { 
				//encuentra el código del video de youtube para embeberlo en el iframe

					$codigoVideo = explode('=', $dataNoticia['video']);
					?>
				<div class="wrapper-iframe-video">
					<iframe src="https://www.youtube.com/embed/<?php echo $codigoVideo[1]; ?>" frameborder="0" allowfullscreen></iframe>
				</div>
				<?php
				}
				?>
				<?php 
					//si hay galeria de imagenes va aca:
				if ( $dataNoticia['galeria'] ) { 
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

				            for ($i=0; $i < count($imgGaleria); $i++) { ?>
				            	<!-- slide item -->
				                <li class="slide-item">
				                    <article>
				                        <figure class="slide-background-img">
				                            <img src="uploads/images/<?php echo $imgGaleria[$i]; ?>">
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
		<footer class="noticia-footer">
			<div class="btn-noticia-index">
				<a href="/noticias/" title="Leer noticia">Ver más noticias</a>
			</div>
			<aside class="loop-recientes-footer-single-wrapper">
				<h3>
					Últimas noticias destacadas
				</h3>
				<ul class="loop-recientes-footer-single">
					<?php NoticiasRecientesHTML( '2', 'none', $dataNoticia['url'], true); ?>
				</ul>
			</aside>
		</footer>
	</article>
</li>