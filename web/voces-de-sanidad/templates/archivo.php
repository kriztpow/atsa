<?php
/*
 * Sitio web: Voces de sanidad
 * @LaCueva.tv
 * Since 1.0
 * TEMPLATE NOTICIAS: ARCHIVO O SINGLE
*/
global $dispositivo;
global $pageActual;

//imagenheader default:
$imageHeaderDefault = MAINSURL . '/images/header-logo2.png';
$imageLoopDefault = MAINSURL . '/images/default-post.jpg';
$slug = getSlug( cleanUri() );

//si slug está vacío entonces es loop de categorias
if ( $slug == '' ) : 
	/*
	 * LOOP CATEGORIAS
	 * Puede ser general o por categorias
	*/
	$categoria = getPageVar( cleanUri() );
	
	?>

	<!-- Full Width Slider Section -->
	<section class="section-block featured-media page-intro tm-slider-parallax-container">
		<div class="tm-slider-container full-width-slider" data-parallax data-parallax-fade-out data-animation="slide" data-scale-under="1140">
			<ul class="tms-slides">
				<li class="tms-slide" data-image data-force-fit data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.35">
					<div class="tms-content">
						<div class="tms-content-inner center">
							<div class="row">
								<div class="column width-12">
									<h1 class="tms-caption title-xlarge color-white mb-10"
										data-animate-in="preset:scaleOut;duration:1000ms;"
										data-no-scale
									>
										Publicaciones
									</h1>
								</div>
							</div>
						</div>
					</div>
					<img data-src="<?php echo $imageHeaderDefault; ?>" data-retina src="<?php echo $imageHeaderDefault; ?>" alt="<?php echo SITETITLE; ?>"/>
				</li>
			</ul>
		</div>
	</section>
	<!-- Full Width Slider Section -->

	<?php 
	//SUBMENU DEBAJO DEL HEADER:
	getTemplate( 'breadcrum', $categoria );
	?>

	<!-- Content Inner -->
	<div class="section-block content-inner pt-0">
		<div class="blog-masonry grid-container fade-in-progressively full-width" data-layout-mode="masonry" data-grid-ratio="1.5" data-animate-resize data-animate-resize-duration="700">
			<div class="row">
				<div class="column width-12">
					<div class="row grid content-grid-3 clearfix">		

					<?php 
					if ( $categoria == '' ) {
						$postsLoop = getPosts( 'none', CANTPOST );
					} else {
						$postsLoop = getPosts( $categoria, CANTPOST );
					}
					
					for ($i=0; $i < count($postsLoop); $i++) { 
						$date = $postsLoop[$i]['post_fecha'];
						$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
						$dia = date("j", strtotime($date));
						$mes = substr( $meses[date("n", strtotime($date))-1], 0, 3 );
						$PostUrl = MAINSURL . '/publicaciones/' . $postsLoop[$i]['post_categoria'] . '/'. $postsLoop[$i]['post_url'];
						?>
						
						<div class="grid-item grid-sizer">
							<article class="post">
								<div class="post-info-aside">
									<span class="post-date">
										<span class="day"><?php echo $dia; ?></span>
										<span class="month"><?php echo $mes; ?></span>
									</span>
								</div>
								<div class="post-content">
									<div class="post-media">
										<div class="thumbnail img-scale-in" data-hover-easing="easeInOut" data-hover-speed="700" data-hover-bkg-color="#000000" data-hover-bkg-opacity="0.5">
											<a class="overlay-link" href="<?php echo $PostUrl; ?>">
											
											<?php if ( $postsLoop[$i]['post_imagen'] != '' ) : ?>

												<img src="<?php echo UPLOADSURL . '/' . $postsLoop[$i]['post_imagen']; ?>" alt="<?php echo $postsLoop[$i]['post_titulo']; ?>">

											<?php else : ?>

												<img src="<?php echo $imageLoopDefault; ?>" alt="Voces de Sanidad">

											<?php endif; ?>

												<span class="overlay-info">
													<span>
														<span>
															<span>Más</span>
														</span>
													</span>
												</span>
											</a>
										</div>
									</div>
									<div class="with-background">
										<div class="post-info">
											<span class="post-date hide show-on-mobile"><?php echo tuneandoFecha( $date ); ?>,</span>
											<span class="post-category"><?php echo $postsLoop[$i]['post_categoria']; ?></span>
										</div>
										<h2 class="post-title">
											<a href="<?php echo $PostUrl; ?>">
												<?php echo $postsLoop[$i]['post_titulo']; ?>
											</a>
										</h2>
										<p>
											<?php echo $postsLoop[$i]['post_resumen']; ?>
										</p>
										<a href="<?php echo $PostUrl; ?>" class="read-more">
											Leer más
										</a>
									</div>
								</div>
							</article>
						</div>
					
					<?php } ?> 

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Content Inner End -->

	<!-- Pagination Section 3 -->

	<?php getTemplate( 'pagination' ); ?>
	
	<!-- Pagination Section 3 End -->


<?php else :
	/*
	 * TEMPLATE SINGLE
	 * Con sidebar
	*/

	$post = getSinglePost ( $slug );
	$categoria = getPageVar( cleanUri() );
	
	?>

	<!-- Full Width Slider Section -->
	<section class="section-block featured-media tm-slider-parallax-container">
		<div class="tm-slider-container full-width-slider" data-parallax data-parallax-fade-out data-animation="slide" data-scale-under="1140">
			<ul class="tms-slides">
				<li class="tms-slide" data-image data-force-fit data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.35">
					<div class="tms-content">
						<div class="tms-content-inner center">
							<div class="row">
								<div class="column width-12">
									<h1 class="tms-caption title-xlarge color-white mb-10"
										data-animate-in="preset:scaleOut;duration:1000ms;"
										data-no-scale
									>
										<?php echo $post['post_titulo']; ?>
									</h1>
									<div class="clear"></div>
									<p class="tms-caption post-info text-medium no-margins"
										data-animate-in="preset:slideInUpShort;duration:1000ms;delay:400ms;"
										data-no-scale
									>
										<span class="post-date"><?php echo tuneandoFecha( $post['post_fecha'] ); ?></span>, <span class="category"><?php echo $post['post_categoria']; ?></span>
									</p>
								</div>
							</div>
						</div>
					</div>

				<?php if ( $post['post_imagen'] != '' ) : ?>
					<img data-src="<?php echo UPLOADSURL . '/' . $post['post_imagen']; ?>" data-retina src="<?php echo UPLOADSURL . '/' . $post['post_imagen']; ?>" alt="<?php echo $post['post_titulo']; ?>"/>
				<?php else : ?>

					<img data-src="<?php echo $imageHeaderDefault; ?>" data-retina src="<?php echo $imageHeaderDefault; ?>" alt="<?php echo SITETITLE; ?>"/>

				<?php endif; ?>

				</li>
			</ul>
		</div>
	</section>
	<!-- Full Width Slider Section -->

	<?php 

	getTemplate( 'breadcrum', $categoria );
	
	?>

	<div class="section-block clearfix pt-0">
		<div class="row">

			<!-- Content Inner -->
			<div class="column width-9 push-3 content-inner blog-single-post">
				<div class="post">
					<div class="post-content">
						
						<?php echo $post['post_contenido']; ?>
						
					</div>
				</div>

				<!-- Post Share -->

				<?php getTemplate( 'post-share' ); ?>
				
				<!-- Post Share -->
				
			</div>	
			<!-- Content Inner End -->

			<!-- Sidebar -->

			<?php 
			if ( $dispositivo == 'pc' ) {
				getTemplate( 'sidebar', $slug ); 
			}
			?>

			<!-- Sidebar End -->

		
		</div><!--//row-->

		<!-- Pagination Section 3 -->

		<?php getTemplate( 'next-previous', $post['post_ID'] ); ?>
		
		<!-- Pagination Section 3 End -->
		
	</div>
<?php endif;

