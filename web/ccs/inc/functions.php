<?php 

// BASE DE DATOS
define('DB_SERVER', 'localhost');
define('DB_USER', 'derechoc_coco');
define('DB_PASS', 'd6m=fD1=ZqKt');
define('DB_NAME', 'derechoc_complejo');
define('URLBASE', 'https://'.$_SERVER['HTTP_HOST'] . '/ccs' );
define('UPLOADCONTENT', URLBASE . '/contenido' );
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/../templates');

$categoriasAgenda = array(
	array(
		'slug' => 'muestras',
		'nombre' => 'Cursos, muestras y Talleres',
	),
	array(
		'slug' => 'musica',
		'nombre' => 'Peñas',
	),
	array(
		'slug' => 'espectaculos',
		'nombre' => 'Espectáculos',
	),
);

//busca el template $name = nombre del archivo sin extensión
function getTemplate ($name, $data = array() ) {

	$namePage = TEMPLATEDIR . '/'. $name. '.php';
	if (is_file($namePage)) {
		include $namePage;
	}
}



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


//trae el contenido de textos de la página de inicio
function getHomeContent( $page ) {
	$connection = connectDB();
	$tabla = 'pages';

	$query  = "SELECT * FROM " .$tabla. " WHERE page_name='".$page."' LIMIT 1";
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		$page = $result->fetch_array();

		return $page;
	}
}

//recupera los sliders
function getSliders ($slug) {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_ubicacion='".$slug."' ORDER by slider_orden asc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div class="container error-tag">Todavía no hay ninguno cargado</div>';
	} else {
		
		while ($row = $result->fetch_array()) {
				$sliders[] = $row;
		}//while

		closeDataBase($connection);
		return $sliders;
	}//else 
}

function getCursos () {
	$connection = connectDB();
	$tabla = 'cursos';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by curso_orden asc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div class="container error-tag">Todavía no hay ninguno cargado</div>';
	} else {
		
		while ($row = $result->fetch_array()) {
				$cursos[] = $row;
		}//while

		closeDataBase($connection);
		return $cursos;
	}//else 
}


//recupera los eventos
function getAgenda ( $number = -1, $all = false, $categoria = 'none' ) {
	$connection = connectDB();
	$tabla = 'agenda';
	$fechaActual = date('Y-m-d');
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. "";
	if ( $all == false ) {
		$query .= " WHERE agenda_fecha_in >= '".$fechaActual."'";
	}
	if ( $categoria != 'none' ) {
		$query .= " WHERE agenda_categoria = '".$categoria."'";	
	}

	$query .= " ORDER by agenda_fecha_in asc";	
	
	//query ordinaria
	//$query  = "SELECT * FROM " .$tabla. " ORDER by agenda_fecha_in asc";

	if ( $number != -1 ) {
		$query .=  " LIMIT ".$number." ";
	}

	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		
		while ($row = $result->fetch_array()) {
				$agenda[] = $row;
		}//while

		closeDataBase($connection);
		return $agenda;
	}//else 
}


//recupera los eventos por fecha
function getEvensByTheDate ($date) {
	$connection = connectDB();
	$tabla = 'agenda';

	$date2 = strtotime ( '+1 day' , strtotime ( $date ) ) ;
	$date2 = date ( 'Y-m-j' , $date2 );

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE agenda_fecha_in >= '".$date."' AND agenda_fecha_in < '".$date2."'  ORDER by agenda_fecha_in asc";	


	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div class="container error-tag">No hay ningún evento este día</div>';
	} else {
		
		while ($row = $result->fetch_array()) {
				$agenda[] = $row;
		}//while

		closeDataBase($connection);
		return $agenda;
	}//else 
}