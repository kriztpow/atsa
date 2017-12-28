<?php
/*
 * Sitio web: Voces de sanidad
 * @LaCueva.tv
 * Since 1.0
 * SIDEBAR CONTACT AND SUSCRIPTIONS
*/

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
									Contact
								</h1>
							</div>
						</div>
					</div>
				</div>
				<img data-src="images/slider/slide-3-page-intro.jpg" data-retina src="images/blank.png" alt=""/>
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
					<h3 class="mb-5">Pop On By</h3>
					<h6 class="mb-30 weight-light color-grey">Mon-Fri 9:00 am -10:00 pm</h6>
					<p class="mb-0 mb-mobile-50">Just feel like visiting our uber cool offices &amp; have a chat. <a data-content="iframe" data-toolbar="" href="http://maps.google.com?q=40.723301,-74.002988&amp;output=embed&amp;z=18" class="lightbox-link">Find Us On Google</a></p>
				</div>
			</div>
		</div>
		<div class="column width-4">
			<div class="feature-column medium center">
				<span class="feature-icon icon-phone"></span>
				<div class="feature-text">
					<h3 class="mb-5">Give Us A Call</h3>
					<h6 class="mb-30 weight-light color-grey">+1 987 874 32 / Ext. 4</h6>
					<p class="mb-0 mb-mobile-50">Get in touch with us and let's chat about your next project and how to reach its full potential.</p>
				</div>
			</div>
		</div>
		<div class="column width-4">
			<div class="feature-column medium center">
				<span class="feature-icon icon-twitter"></span>
				<div class="feature-text">
					<h3 class="mb-5">Chat With Us</h3>
					<h6 class="mb-30 weight-light color-grey">@thememountainco</h6>
					<p class="mb-0 mb-mobile-50">Just want to have a chant, hit us up on Twitter with any questions or comments.</p>
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
					<p class="lead text-large color-theme mb-50">We'd love to hear about your project and help you achieve its full potential.</p>
					<p>Warhol is focused around 8 unique concepts with 3 variations each. Warhol has got you covered whether you are a startup or established business.</p>
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
			<h3 class="mb-50">Drop us a message...</h3>
			<div class="contact-form-container">
				<form class="contact-form" action="php/send-email.php" method="post" novalidate>
					<div class="row">
						<div class="column width-6">
							<input type="text" name="fname" class="form-fname form-element rounded large" placeholder="First Name*" tabindex="1" required>
						</div>
						<div class="column width-6">
							<input type="text" name="lname" class="form-lname form-element rounded large" placeholder="Last Name" tabindex="2">
						</div>
						<div class="column width-6">
							<input type="email" name="email" class="form-email form-element rounded large" placeholder="Email address*" tabindex="3" required>
						</div>
						<div class="column width-6">
							<input type="text" name="website" class="form-website form-element rounded large" placeholder="Website" tabindex="4">
						</div>
						<div class="column width-6">
							<div class="form-select form-element rounded large">
								<select name="options" class="form-aux" data-label="Options" tabindex="5">
									<option selected="selected" value="">Project Budget</option>
									<option value="">Less than $1000</option>
									<option value="">$1000 - $2000</option>
									<option value="">$2000 - $5000</option>
									<option value="">$5000 - $7000</option>
									<option value="">$10000 &amp; up</option>
								</select>
							</div>
						</div>
						<div class="column width-6">
							<div class="form-select form-element rounded large">
								<select name="options" class="form-aux" data-label="Options" tabindex="5">
									<option selected="selected" value="">How'd You Find Kant</option>
									<option value="">From a friend</option>
									<option value="">Found Kant online</option>
									<option value="">Previous client</option>
									<option value="">Through advertising</option>
								</select>
							</div>
						</div>
						<div class="column width-6">
							<input type="text" name="honeypot" class="form-honeypot form-element large">
						</div>
					</div>
					<div class="row">
						<div class="column width-12">
							<textarea name="message" class="form-message form-element rounded large" placeholder="Message*" tabindex="6" required></textarea>
						</div>
						<div class="column width-12">
							<div class="field-wrapper pt-10 pb-10">
							 	<input id="checkbox-1" class="form-element checkbox rounded" name="checkbox-1" type="checkbox">
								<label for="checkbox-1" class="checkbox-label">Yup, I want to receive the Kant newsletter</label>
							</div>
						</div>
						<div class="column width-12">
							<input type="submit" value="Send Email" class="form-submit button rounded medium bkg-theme bkg-hover-green color-white color-hover-white">
						</div>
					</div>
				</form>
				<div class="form-response"></div>
			</div>
		</div>
	</div>
</section>
<!--Contact Form End -->