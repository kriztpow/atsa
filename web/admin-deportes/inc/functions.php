<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de funciones
*/

require_once('config-admin.php');

/*
 * Funciones sin base de datos
*/

//busca el template $name = nombre del archivo sin extensión
function getTemplate ($name, $data = array() ) {

	$namePage = TEMPLATEDIR . '/'. $name. '.php';
	if (is_file($namePage)) {
		include $namePage;
	}
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
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/lib/tinymce/tinymce.min.js"></script>
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-medios.js"></script>
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-old-deportes.js"></script>
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-deportes.js"></script>
	<script src="<?php echo URLADMINISTRADOR; ?>/assets/js/modulo-posts.js"></script>
	
	<?php
}

function myUrlEncode($string) {
	
	$string = strtolower($string);
	$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
	$string = str_replace($replacements, '', $string);
	$string = str_replace(' ', '-', $string);

	$string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $string
    );

	return $string;
}


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

function connectDBUSERS () {
	global $connection;
	$server = 'localhost';
	$user = 'dbuser';
	$pass = '123';
	$name = 'atsa';
	$connection = mysqli_connect($server, $user, $pass, $name);
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

/*
 * TRAE LA LISTA DE USUARIOS
 * DEVUELVE ARRAY CON USUARIOS
*/
function getUsers() {
	$connection = connectDB();
	$tabla = 'usuarios';
	$query  = "SELECT * FROM " .$tabla;

	$result = mysqli_query($connection, $query);

	while ( $user = $result->fetch_array() ) {
			$users[] = $user;
		}

	return $users;
}

/*
 * TRAE LA LISTA DE CATEGORIAS
*/
function getDeportesList() {
	$connection = connectDB();
	$tabla = 'deportes';
	$query  = "SELECT * FROM " . $tabla;

	$result = mysqli_query($connection, $query);
	if ( $result->num_rows == 0 ) {
		$deportes = null;

	} else {
	while ( $deporte = $result->fetch_array() ) {
			$deportes[] = $deporte;
		}

	}

	closeDataBase($connection);

	return $deportes;
}

//esta funcion viene del anterior deportes del admin superior
function showLinksDeportesAdmin () {
	$connection = connectDB();
	$tabla = 'archivos';
	$secciones = array();
	$textoSecciones = array();
	$ordenSecciones = array();
	//queries según parámetros
	$query  = "SELECT deportes_seccion,deportes_texto,deportes_orden FROM " .$tabla. " WHERE deportes_post_type='section' ORDER by deportes_orden";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay ninguna cargada';
	} else { 

	while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}
		//recorremos cada uno de los item de la seccion
		foreach ($rows as $row ) { 
			$seccion = $row['deportes_seccion'];
			$textoSeccion = $row['deportes_texto'];
			$ordenSeccion = $row['deportes_orden'];
			array_push($secciones, $seccion);
			array_push($textoSecciones, $textoSeccion);
			array_push($ordenSecciones, $ordenSeccion);
		}//for each de cada seccion

		
		//ahora q ya están los nombres de las secciones, recorremos cada una

		for ($i=0; $i < count($secciones); $i++) { 
			
			$query  = "SELECT * FROM " .$tabla. " WHERE deportes_seccion='".$secciones[$i]."' and deportes_post_type='link' ORDER by deportes_orden";	
			$result2 = mysqli_query($connection, $query);
			
			if ( $result2->num_rows == 0 ) { ?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="deportes-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-deportes-btn">Cambiar nombre u orden</small>
					</h4>
					<p><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-deportes" id="<?php echo $secciones[$i]; ?>">
						<li>
		      				<button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>

			 <?php } else { 
				//se arma el html. Primero va el titulo de la sección
				?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="deportes-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-deportes-btn">Cambiar nombre u orden</small>
					</h4>
					<p class="orden-secciones-deportes"><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-deportes" id="<?php echo $secciones[$i]; ?>">
			
				<?php
				while ($rowitem = $result2->fetch_array()) {					

					$orden = $rowitem['deportes_orden'];
					$IDItem = $rowitem['deportes_id'];
					$textoItem = $rowitem['deportes_texto'];
					$urlItem = $rowitem['deportes_url'];
					
					?>
						<li>
			  				<article id="<?php echo $IDItem; ?>" class="link-deportes-wrapper">
					        	<div class="row">
					        		<div class="col-sm-2">
					        			<h4><small>Orden:</small></h4>
					        			<input type="text" class="link-deportes-orden" value="<?php echo $orden; ?>">	
					        		</div><!-- //col -->
					        		<div class="col-sm-3">
					        			<input type="text" class="link-deportes-texto" value="<?php echo $textoItem; ?>">		
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="link-deportes-file">
							        		<a href="<?php echo UPLOADSURL . '/pdfs/' . $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>">
							        			<?php echo $urlItem; ?></a><br>
							        		<small><span class="btn-load-file-deportes">Cambiar</span> o <span class="btn-del-file-deportes">Borrar</span> archivo</small>
							        	</div>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<button class="btn btn-sm btn-info btn-save-file-deportes">Guardar cambios</button>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<span class="error-msj-deportes"></span>
					        		</div><!-- //col -->
					        	</div><!-- //row -->
					        </article><!-- //link-deportes-wrapper -->	
			  			</li>

				<?php }//while
				
				//cierre de la seccion
				?>
						<li>
		      				<button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>
			<?php }//else

		}//for de secciones

	}//else
	mysqli_close($connection);
}//showLinksDeportesAdmin()
