<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de funciones
*/

require_once('config.php');

/*
 * Funciones sin base de datos
*/

//busca el template $name = nombre del archivo sin extensión
function getTemplate ($name ) {

	include TEMPLATEDIR . '/'. $name. '.php';
}


//carga las funciones del modulo
function load_module( $nombre ) {
	include MODULOSDIR . '/modulo-'. $nombre. '.php';
}

//funcion renombrar archivo para que no se sobreescriba
function renombrar_archivo( $file, $slug ) {
	
	$extension = explode(".", $file );
	$no_aleatorio = rand(100, 999);
	$file = date('Y-m-d') . '-' .$no_aleatorio . '-' . $slug . '.' . end($extension);
	return $file;
}

/**
 * Checks if a request is a AJAX request
 * @return bool
 */
function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest');
}

/*
busca los scripts necesarios y los inserta a continuación
*/
function get_footer_scripts ($modulo) { ?>

	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/jquery-ui.min.js"></script>
	<!------- admin scripts ------>
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/admin-script.js"></script>
	<!------- scripts modulos ------>
	<?php 
	switch ( $modulo ) {
		case 'noticias':
		case 'editar-noticias': ?>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/lib/tinymce/tinymce.min.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-noticias.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-medios.js"></script>
			
			<?php break;
		
		case 'biblioteca-medios': ?>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-medios.js"></script>
			<?php break;

		case 'contacts': ?>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-contacts.js"></script>
			<?php break;

		case 'promociones' : ?>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-medios.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-promociones.js"></script>
			<?php break;
		
		default: ?>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/lib/tinymce/tinymce.min.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-noticias.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-medios.js"></script>
			<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-contacts.js"></script>
			<?php break;
	}
	?>
<?php }

/*
 * Funciones con base de datos
*/

//conección a base de datos y db específica
function connectDB () {
	global $connection;
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if( mysqli_connect_errno() ) {
    die("Database connection failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
  if (!mysqli_set_charset($connection, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connection));
    exit();
	} else {
		mysqli_character_set_name($connection);
	}
  return $connection;
}

//cierre base de datos
function closeDataBase($connection){
	if ( isset($connection) ) {
    	mysqli_close($connection);
    }
}

//acceso directo en el index que se conecta a algún modulo
function mainshorcutIndex() {

//function listaNoticias( $limit = 20, $status = 'all', $extended = false, $categoria = 'none', $resumenQuery = false ) {
	$connection = connectDB();
	$tabla = 'noticias';
	$destacado = '1';
	$status = 'publicado';
	
	$query  = "SELECT * FROM " .$tabla. " WHERE post_destacado='".$destacado."' AND post_status='".$status."' ORDER by post_fecha desc ";

	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div class="error-tag">Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ( $row = $result->fetch_array() ) {
			$rows[] = $row;
		}

		foreach ($rows as $row ) {
		 	$postID       = $row['post_ID'];
			$titulo       = $row['post_titulo'];
			$url          = $row['post_url'];
			$imgDestacada = $row['post_imagen'];
			$resumen      = $row['post_resumen'];
			$contenido    = $row['post_contenido'];
			$video        = $row['post_video'];
			$categoria    = $row['post_categoria'];
			$galeria      = $row['post_galeria'];
			$imgGaleria   = $row['post_imagenesGal'];
			$status       = $row['post_status'];
			$date         = $row['post_fecha'];

			$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$dia          = date("d", strtotime($date));
			$mes          = $meses[date("n", strtotime($date))-1];
			$year         = date("Y", strtotime($date));
		
			?>
			<li class="loop-noticias-backend-item">
				<article class="row">
				    <div class="col-30">
				    	<?php 
				    	if ( $imgDestacada != '' ) { ?>
				    	<img src="<?php echo UPLOADSURLIMAGES.'/'.$imgDestacada; ?>" alt="Imagen Destacada de la noticia" class="img-responsive">
				    	<?php }
				    	else { ?>
				    	<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA" class="img-responsive">
				    	<?php } ?>
				    </div>
				    <div class="col-70">
				    	<a href="index.php?admin=editar-noticias&slug=<?php echo $url; ?>" title="Editar" class="titulo-noticia-small-link">
					    	<h1 class="titulo-noticia-small">
					    		<?php echo $titulo; ?> 
					    		| 
					    		<span><?php echo $status; ?></span>
					    		- 
					    		<small><?php echo $date; ?></small>
					    	</h1>
				    	</a>
				    	
				    </div>
				</article>
			</li>
		<?php

		}//FOREACH
		
	}//ELSE

	closeDataBase($connection);
}