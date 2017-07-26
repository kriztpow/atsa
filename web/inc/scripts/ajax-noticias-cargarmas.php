<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.2
 * INDEX
 * carga mas noticias
*/
require '../functions.php';
sleep(1);
$noticiasPorPagina = 5;
$connection = connectDB();
$tabla = 'noticias';
$pageActual = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 2;
$categoria = isset( $_POST['categoria'] ) ? $_POST['categoria'] : 'none';

if ( $categoria != 'none' ) {
		$query  = "SELECT *  FROM " .$tabla. " WHERE post_status='publicado' AND post_categoria= '".$categoria."' ORDER by post_fecha desc LIMIT ".( ($pageActual-1 )*$noticiasPorPagina).", ".$noticiasPorPagina." ";
	}

$query  = "SELECT *  FROM " .$tabla. " WHERE post_status='publicado' ORDER by post_fecha desc LIMIT ".( ($pageActual-1 )*$noticiasPorPagina).", ".$noticiasPorPagina." ";

$result = mysqli_query($connection, $query);

if ( $result->num_rows == 0 ) {
	echo 'No hay más noticias para cargar';
} else {

	while ( $row = $result->fetch_array() ) {
		$rows[] = $row;
	}

	foreach ($rows as $row ) { 
		$titulo       = $row['post_titulo'];
		$url          = $row['post_url'];
		$imgDestacada = $row['post_imagen'];
		$resumen      = $row['post_resumen'];
		$bajada       = $row['post_bajada'];
		$contenido    = $row['post_contenido'];
		$video        = $row['post_video'];
		$categoria    = $row['post_categoria'];
		$etiquetas    = $row['post_etiquetas'];
		$galeria      = $row['post_galeria'];
		$imgGaleria   = $row['post_imagenesGal'];
		$date         = $row['post_fecha'];

		$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$dia          = date("d", strtotime($date));
		$mes          = $meses[date("n", strtotime($date))-1];
		$year         = date("Y", strtotime($date));
	
		if ( $resumen == '' ) {
			$resumen = $bajada;
		}
		?>
		<li class="loop-noticias-item">
			<article class="noticia-index">
				<header>
					<h1>
						<?php echo $titulo; ?>
					</h1>
				</header>
				<section>
					<div class="meta-data-news">
						<div class="date-news">
							<p>
								<strong>
								<?php echo $dia; ?>
								</strong><br>
								de <?php echo $mes .' '. $year; ?>
							</p>
						</div>

						<?php 
						if ( $imgDestacada != '' ) { ?>
							<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">
								<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="<?php echo $titulo; ?> | Noticias-ATSA">
							</a>
						<?php 
						
						} else {

						?>
							<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
						<?php 
						} ?>
					</div>
					<p class="excerpt-news">
						<?php echo $resumen; ?>
					</p>
				</section>
				<footer>
					<div class="btn-noticia-index">
						<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">Leer más</a>
					</div>
				</footer>
			</article>
		</li>
	<?php

	}//FOREACH
}//ELSE

closeDataBase( $connection );