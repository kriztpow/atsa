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
		
			<h1>
				<?php echo $dataNoticia['titulo'] ?>
			</h1>
		
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
			<aside class="share-redes-wrapper">
				<ul class="share-redes">
					<li>
						<a  target="_blank" class="twitter-share-button" href="https://twitter.com/intent/tweet?text=<?php echo $dataNoticia['titulo']; ?>&url=<?php echo urlBase() . '/noticias/' .$dataNoticia['url']; ?>&via=AtsaBsAs" >
							Tweet
						</a>
					</li>
					<li>
						<div class="fb-share-button" data-href="<?php echo urlBase() . '/noticias/' .$dataNoticia['url']; ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlBase() . '/noticias/' .$dataNoticia['url']; ?>&amp;src=sdkpreparse">Compartir</a></div>
					</li>
					<li class="email-share-btn">
						<a href="mailto:?subject=<?php echo $dataNoticia['titulo']; ?>&amp;body=<?php echo $dataNoticia['bajada']; ?> | <?php echo urlBase() . '/noticias/' .$dataNoticia['url']; ?>"
   title="Compartir por Email">
						  Email
						</a>
					</li>
					<li class="print-share-btn">
						<a href="#" onclick="window.print();">Imprimir</a>
					</li>
				</ul>
			</aside>
			<!--<div class="title-news">
				<h1>
					<?php //echo $dataNoticia['titulo']; ?>
				</h1>
			</div>-->
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

				<?php 
					
					$recientes = GetNoticiasRecientes( '10', 'none', $dataNoticia['url'], true);

					getTemplate( 'sliders-recientes', $recientes);
				?>
				<!--<ul class="loop-recientes-footer-single">
					<?php //NoticiasRecientesHTML( '2', 'none', $dataNoticia['url'], true); ?>
				</ul>-->
			</aside>
		</footer>
	</article>
</li>
<!--redes sociales -->


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));
</script>