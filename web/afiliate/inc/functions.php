<?php 
/*
 * Sitio web: atsa - afiliate
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 *
 * CONTENIDO 
 * 1. funciones básicas
 * 2. funciones con base de datos
 * 3. funciones con web service 
*/

require_once 'config.php';
require_once 'lib/mobile-detect/Mobile_Detect.php';

//busca el template $name = nombre del archivo sin extensión
function getTemplate ( $name, $data = array() ) {
	$namePage = TEMPLATEDIR . '/'. $name. '.php';

	if (is_file($namePage)) {
		include $namePage;
	}
}


//detecta el dispositivo
function dispositivo () {
	$dispositivo = 'pc';
	$detect = new Mobile_Detect;

	if ( $detect->isMobile() ) {
		$dispositivo = 'movil';
	}
		
	// Any tablet device.
	if( $detect->isTablet() ){
		$dispositivo = 'tablet';
	}

	return $dispositivo;

}

//esta función limpia el url si el sitio no está instalado en la rais del servidor para que funcionen los permalinks sin problemas
function cleanUri() {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = str_replace(CARPETASERVIDOR, '', $uri);
	return $uri;	
}

/*
* FUNCIÓN DE PERMALINKS
 * Define la page actual y redirecciona segun url, devuelve el slug o template part.
 * a) En el caso de que sean paginas, busca el template en la carpeta templates y listo.
 * b) En el caso de que sea noticia, categoria o curso, busca el template adecuado (cursos = curso.php / o en en el archivo index elige la primera opcion (la segunda es de paginas).
 * Pero ademas, e importante, busca en la base de datos mediante el slug. Si es noticia hace un loop de la categoria elegida o de todas las noticias y si es noticia single busca la noticia específica.
 *
*/
function pageActual ( $uri ) {
	$slug = 'inicio'; //slug por defecto
	
	$url = $uri;
	$parseUrl = explode('/', $url);
	$RequestURI = $parseUrl[1];
	
	//busca el simbolo ? en la url
	$permalink = strpos($RequestURI, '?');
	$permalink2 = strpos($RequestURI, '&');
	
	//si en el url no aparece ni ? ni & es porque es un link bonito
	if ( $permalink === false && $permalink2 === false ) {
		
		//si no está vacío, hay que procesar cual es
		if ( $url != '/' ) {

			$slug = $RequestURI;		
			
		}

	} 

	return $slug;

}//pageActual()


/**
 * Checks if a request is a AJAX request
 * @return bool
 */
function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest');
}






/*
 *
 * FUNCIONES CON BASE DE DATOS
 *
*/

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
function closeDataBase( $connection ){
	if ( isset($connection) ) {
    	mysqli_close( $connection );
    }
}




/*
 *
 *	FUNCIONES WEB SERVICE
 *
*/

/*
 * CHEC CUIL, 
 * REQUIRED, CUIL
 * Chequea si el cuil existe
 * REF:
 * Error 1: no existe el cuil
 * Error 2: Falta ingresar cuil
*/
function checkCuil ( $cuil ) {

	if ( $cuil == '' ) {
		echo 'error-2';//falta ingresar cuil
		return;
	} 

	$client = new SoapClient('http://www.sanidadsistemas.com.ar/sanidadws2/ws.asmx?wsdl',
		array(
			'trace'=>true,
			'exceptions'=>false
		) 
	);
	
	$result = $client->SolidaridadQuery(array('cuil'=>$cuil));
	
	$result = json_decode($result->SolidaridadQueryResult);

	if ( ! empty($result) ) {

		$usuario  = array(
			'cuit' => $result[0]->cuit,
			'sucursal' => $result[0]->sucursal,
			'razonSocial' => $result[0]->razonSocial,
			'cuil' => $result[0]->cuil,
			'nombreApellido' => $result[0]->nomreApellido,
			'ff' => $result[0]->ff,
			'mesDDJJ' => $result[0]->mesDDJJ,
			'anioDDJJ' => $result[0]->anioDDJJ,
			'idConvenio' => $result[0]->idConvenio,
			'idRama' => $result[0]->idRama,
			'nonmbreConvenio' => $result[0]->nombreConvenio,
		);
		print_r($usuario);
	}
	
	else {
		echo 'error-1'; //no existe cuil
	}

}