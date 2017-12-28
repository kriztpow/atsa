<!-- Hero Slider -->
<div class="section-block pt-0 pb-0">
	<div class="hero-slider tm-slider-container window-height" data-width="2500" data-height="1600" data-scale-min-height="700" data-auto-advance data-nav-arrows data-nav-show-on-hover>
		<ul class="tms-slides">

	<?php 

	$posts = getPostsSlider();
	
	if ( $posts != 'none' ) : 
		for ($i=0; $i < count($posts); $i++) { ?>

			<li class="tms-slide right" data-image data-as-bkg-image data-image-wrapper="media-column" data-nav-dark>
				<div class="media-column width-6"></div>
				<div class="row">
					<div class="tms-caption hero-content split-hero-content column width-5 no-transition" data-no-scale>
						<div class="hero-content-inner left">
							<div class="tms-content-scalable">
								<h1 class="mb-40">
									<?php echo $posts[$i]['post_titulo']; ?>
								</h1>
								<p class="lead">
									<?php echo $posts[$i]['post_resumen']; ?>
								</p>
								<p class="mb-40">
									<?php echo $posts[$i]['post_resumen_2']; ?>
								</p>
                                <a data-aux-classes="tml-newsletter-modal rounded" data-toolbar="" data-lightbox-animation="fadeIn" href="<?php echo MAINSURL . '/publicaciones/' . $posts[$i]['post_categoria'] . '/' .  $posts[$i]['post_url']; ?>" class="button rounded bkg-theme bkg-hover-green color-white color-hover-white fade-location">
                                	Leer más
                                </a>
							</div>
						</div>
					</div>
				</div>
			<?php if ( $posts[$i]['post_imagen'] != '' ) : ?>
				<img data-src="<?php echo UPLOADSURL . '/' . $posts[$i]['post_imagen']; ?>" data-retina src="<?php echo MAINSURL; ?>/images/default-post-slider.jpg" alt="<?php echo $posts[$i]['post_titulo']; ?>">
			<?php else : ?>
				<img data-src="<?php echo MAINSURL; ?>/images/default-post-slider.jpg" data-retina src="<?php echo MAINSURL; ?>/images/default-post-slider.jpg" alt="<?php echo SITETITLE; ?>">
			<?php endif; ?>
			</li>
							
	<?php }

	endif;
	
	?>

		</ul>
	</div>
</div>
<!-- Hero Slider End -->