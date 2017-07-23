<?php
//por ahora busca los datos en la variable
	global $dataNoticias;
	global $categoria;
	$noticiasPorPagina = 5;


	//si hay menos de cinco noticias se toma solo el número de noticias que haya para mostrarlas
	if ( count($dataNoticias) < $noticiasPorPagina) {
		$noticiasPorPagina = count($dataNoticias);
	}

	for ($i = 0; $i < $noticiasPorPagina; $i++) { 

		$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
		$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
		$urlNoticia       = $dataNoticias[$i]['urlNoticia'];
		$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array	
	?>
		<li class="loop-noticias-item">
			<a href="/noticias/<?php echo $urlNoticia; ?>" title="Leer noticia">
				<article class="noticia-recientes-item">
					
					<div class="recientes-img-loop">
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
					<div class="recientes-text-loop">
						<h1>
							<?php echo $tituloNoticia; ?>
						</h1>
						
						<p>
							<?php echo $fechaNoticia[0] .' de '. $fechaNoticia[1] .' de '. $fechaNoticia[2]; ?>
						</p>
					</div>
				</article>
			</a>
		</li>

	<?php
	}//bucle for
?>