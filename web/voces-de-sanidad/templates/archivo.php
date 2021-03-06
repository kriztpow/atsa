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
$slug = getSlug( cleanUri() );

//si slug está vacío entonces es loop de categorias
if ( $slug == '' ) : 
	/*
	 * LOOP CATEGORIAS
	 * Puede ser general o por categorias
	*/
	$categoria = getPageVar( cleanUri() );
	
	if ( $categoria == '' ) {
		$categoria = 'none';
	}

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
					<div id="contenedor-noticias" class="row grid content-grid-3 clearfix">		

					<?php 
					
					$postsLoop = getPosts( $categoria, CANTPOST );
					
					getTemplate( 'posts-loop', $postsLoop );

					?>

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Content Inner End -->

	<!-- Pagination Section 3 -->

	<?php getPagination( $categoria, CANTPOST ); ?>
	
	<!-- Pagination Section 3 End -->


<?php else :
	/*
	 * TEMPLATE SINGLE
	 * Con sidebar
	*/

	$post = getSinglePost ( $slug );
	$categoria = getPageVar( cleanUri() );
	$video = false;
	$galeria = false;

	//template video
	if ( $post['post_video'] != '' ) {
		$video = true;
		$videoUrl = explode('=', $post['post_video'])[1];
	}
	//template galeria de fotos
	if ( $post['post_galeria'] == '1' ) {
		$galeria = true;

	}
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

				<?php if ( $video ) : ?>
					<iframe src="https://www.youtube.com/embed/<?php echo $videoUrl; ?>" frameborder="0" allowfullscreen width="100%" height="450px"></iframe>
				<?php endif; ?>

				<?php if ( $galeria ) : ?>
					<!-- Content Slider -->
					<div id="content-slider" class="section-block" style="padding-top: 0;">
						<div class="row">
							<div class="column width-10 offset-1 center">
								
								<div class="tm-slider-container content-slider" data-animation="slide" data-scale-min-height="100" data-scale-under="960" data-width="1250" data-height="800">
									<ul class="tms-slides">

									<?php 
									$imgGaleria = unserialize( $post['post_imagenesGal'] );
									
									for ($i=0; $i < count($imgGaleria); $i++) { ?>
										<li class="tms-slide" data-image data-force-fit data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.1">
											<div class="tms-content">
												<div class="tms-content-inner center">
													<div class="row">
														<div class="column width-10 offset-1">
															<h3 class="tms-caption title-medium color-white lspacing-medium mb-5 mb-mobile-30"
																data-animate-in="preset:slideInLeftShort;duration:1000ms;"
																data-no-scale
															>
																<?php echo $post['post_titulo']; ?>
															</h3>
														</div>
													</div>
												</div>
											</div>
											<img data-src="<?php echo UPLOADSURL . '/' . $imgGaleria[$i]; ?>" data-retina src="<?php echo UPLOADSURL . '/' . $imgGaleria[$i]; ?>" alt="<?php echo $post['post_titulo']; ?>"/>
										</li>
									<?php }
									?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- Content Slider End -->
				<?php endif; ?>
				
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

