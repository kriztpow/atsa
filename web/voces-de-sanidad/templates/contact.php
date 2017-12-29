<?php
/*
 * Sitio web: Voces de sanidad
 * @LaCueva.tv
 * Since 1.0
 * SIDEBAR CONTACT AND SUSCRIPTIONS
*/

$imageHeaderDefault = MAINSURL . '/images/header-logo2.png';
?>

<!-- Full Width Slider Section -->
<section class="section-block featured-media tm-slider-parallax-container">
	<div class="tm-slider-container full-width-slider" data-parallax data-parallax-fade-out data-animation="slide" data-scale-under="1140" data-scale-min-height="300">
		<ul class="tms-slides">
			<li class="tms-slide" data-image data-force-fit data-overlay-bkg-color="#000000" data-overlay-bkg-opacity="0.3">
				<div class="tms-content">
					<div class="tms-content-inner center">
						<div class="row">
							<div class="column width-12">
								<h1 class="tms-caption title-xlarge color-white mb-10"
									data-animate-in="preset:scaleOut;duration:1000ms;"
									data-no-scale
								>
									Contacto
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

<!-- Feature Column Section -->
<div class="section-block replicable-content">
	<div class="row flex">
		<div class="column width-4">
			<div class="feature-column medium center">
				<span class="feature-icon icon-location"></span>
				<div class="feature-text">
					<h3 class="mb-5">Visitanos</h3>
					<h6 class="mb-30 weight-light color-grey">Lun-Vie 9:00 am - 6:00 pm</h6>
					<p class="mb-0 mb-mobile-50">Pasa a visitarnos por nuestra sede central <strong>Saavedra 166</strong>. <a data-content="iframe" data-toolbar="" href="http://maps.google.com?q=-34.6118214,-58.4047565&amp;output=embed&amp;z=18" class="lightbox-link">Abrir mapa</a></p>
				</div>
			</div>
		</div>
		<div class="column width-4">
			<div class="feature-column medium center">
				<span class="feature-icon icon-phone"></span>
				<div class="feature-text">
					<h3 class="mb-5">Hablá con nosotros</h3>
					<h6 class="mb-30 weight-light color-grey">4959-7100  / Int. 38/39</h6>
					<p class="mb-0 mb-mobile-50">Podés hablar por teléfono para informarte de todos los beneficios de nuestros afiliados.</p>
				</div>
			</div>
		</div>
		<div class="column width-4">
			<div class="feature-column medium center">
				<a href="<?php echo LINK_TWITTER; ?>" target="_blank">
					<span class="feature-icon icon-twitter"></span>
				</a>
				<a href="<?php echo LINK_FACEBOOK; ?>" target="_blank">
					<span class="feature-icon icon-facebook"></span>
				</a>
				<div class="feature-text">
					<h3 class="mb-5">Seguinos</h3>
					<h6 class="mb-30 weight-light color-grey">@AtsaBsAs</h6>
					<p class="mb-0 mb-mobile-50">O visitá nuestras redes sociales para seguir en contacto.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Feature Column Section End -->

<!-- Hero 5 Section -->
<div class="section-block hero-5 hero-5-contact-1 clear-height bkg-grey-ultralight show-media-column-on-mobile">
	<div class="media-column width-6 center horizon" data-animate-in="preset:slideInUpShort;duration:1000ms;" data-threshold="0.3"></div>
	<div class="row">
		<div class="column width-5 offset-7">
			<div class="hero-content split-hero-content">
				<div class="hero-content-inner left">
					<h2 class="lead text-large color-theme mb-50">
						<a href="<?php echo MAINSURL . '/suscribirse'; ?>">
						Suscribite</a>
					</h2>
					<p>
						Para suscribirte y recibir nuestras publicaciones como otras informaciones, hace click <a href="<?php echo MAINSURL . '/suscribirse'; ?>">aquí</a>.
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Hero 5 Section End -->

<!--Contact Form -->
<section class="section-block replicable-content contact-2">
	<div class="row">
		<div class="column width-8 offset-2">
			<h3 class="mb-50">Dejanos un mensaje...</h3>
			<div class="contact-form-container">
				<form class="contact-form" action="php/send-email.php" method="post" novalidate>
					<div class="row">
						<div class="column width-6">
							<input type="text" name="fname" class="form-fname form-element rounded large" placeholder="Nombre*" tabindex="1" required>
						</div>
						<div class="column width-6">
							<input type="text" name="lname" class="form-lname form-element rounded large" placeholder="Apellido" tabindex="2">
						</div>
						<div class="column width-6">
							<input type="email" name="email" class="form-email form-element rounded large" placeholder="Correo electrónico*" tabindex="3" required>
						</div>
						<div class="column width-6">
							<input type="text" name="telephone" class="form-website form-element rounded large" placeholder="Teléfono" tabindex="4">
						</div>
						
						<div class="column width-6">
							<input type="text" name="honeypot" class="form-honeypot form-element large">
						</div>
					</div>
					<div class="row">
						<div class="column width-12">
							<textarea name="message" class="form-message form-element rounded large" placeholder="Mensaje*" tabindex="6" required></textarea>
						</div>
						<div class="column width-12">
							<div class="field-wrapper pt-10 pb-10">
							 	<input id="checkbox-1" class="form-element checkbox rounded" name="checkbox-1" type="checkbox">
								<label for="checkbox-1" class="checkbox-label">Quiero suscribirme a Voces de Sanidad</label>
							</div>
						</div>
						<div class="column width-12">
							<input type="submit" value="Enviar email" class="form-submit button rounded medium bkg-theme bkg-hover-green color-white color-hover-white">
						</div>
					</div>
				</form>
				<div class="form-response"></div>
			</div>
		</div>
	</div>
</section>
<!--Contact Form End -->