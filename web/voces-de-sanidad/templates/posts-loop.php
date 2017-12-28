<?php
$imageLoopDefault = MAINSURL . '/images/default-post.jpg';

for ($i=0; $i < count($data); $i++) { 
	$date = $data[$i]['post_fecha'];
	$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
	$dia = date("j", strtotime($date));
	$mes = substr( $meses[date("n", strtotime($date))-1], 0, 3 );
	$PostUrl = MAINSURL . '/publicaciones/' . $data[$i]['post_categoria'] . '/'. $data[$i]['post_url'];
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
						
						<?php if ( $data[$i]['post_imagen'] != '' ) : ?>

							<img src="<?php echo UPLOADSURL . '/' . $data[$i]['post_imagen']; ?>" alt="<?php echo $data[$i]['post_titulo']; ?>">

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
						<span class="post-category"><?php echo $data[$i]['post_categoria']; ?></span>
					</div>
					<h2 class="post-title">
						<a href="<?php echo $PostUrl; ?>">
							<?php echo $data[$i]['post_titulo']; ?>
						</a>
					</h2>
					<p>
						<?php echo $data[$i]['post_resumen']; ?>
					</p>
					<a href="<?php echo $PostUrl; ?>" class="read-more">
						Leer más
					</a>
				</div>
			</div>
		</article>
	</div>

<?php } ?> 