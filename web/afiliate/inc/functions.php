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
 *	guarda nuevo usuario en base de datos
 *
*/
function loadNewUser( $usuario, $dataFormulario ) {
	$connection = connectDB();
	$tabla = 'afiliados';
	$fecha_actual = date("Y-m-d");

	//apellido y nombre lo pasa a minúsculas
	$apellido     = isset($_POST['lastname']) ? strtolower($_POST['lastname']) : '';
	$nombre       = isset($_POST['name']) ? strtolower($_POST['name']) : '';
	$cuit         = isset($_POST['cuit']) ? $_POST['cuit'] : '';
	$cuil         = isset($_POST['cuil']) ? $_POST['cuil'] : '';
	$dni          = isset($_POST['dni']) ? $_POST['dni'] : '';
	$fechaIngreso = isset($_POST['date-start']) ? $_POST['date-start'] : '';

	//SANITIZE:
	$apellido     = filter_var(ucwords($apellido),FILTER_SANITIZE_STRING);
	$apellido     = mysqli_real_escape_string($connection, $apellido);
	$nombre       = filter_var(ucwords($nombre),FILTER_SANITIZE_STRING);
	$nombre       = mysqli_real_escape_string($connection, $nombre);
	$cuit         = filter_var($cuit,FILTER_SANITIZE_NUMBER_INT);
	$cuit         = mysqli_real_escape_string($connection, $cuit);
	$cuil         = filter_var($cuil,FILTER_SANITIZE_NUMBER_INT);
	$cuil         = mysqli_real_escape_string($connection, $cuil);
	$dni          = filter_var($dni,FILTER_SANITIZE_NUMBER_INT);
	$dni          = mysqli_real_escape_string($connection, $dni);
	

	
	$member_email  = isset($_POST['member_email']) ? strtolower($_POST['member_email']) : '';
	$member_tel    = isset($_POST['member_tel']) ? $_POST['member_tel'] : '';
	$member_movil  = isset($_POST['member_cellphone']) ? $_POST['member_cellphone'] : '';
	$job_street    = isset($_POST['job_street']) ? strtolower($_POST['job_street']) : '';
	$job_number    = isset($_POST['job_number']) ? $_POST['job_number'] : '';
	$job_city      = isset($_POST['job_city']) ? strtolower($_POST['job_city']) : '';

	//SANITIZE:
	$member_email  = filter_var($member_email,FILTER_SANITIZE_EMAIL);
	$member_email  = mysqli_real_escape_string($connection, $member_email);
	$member_tel    = filter_var($member_tel,FILTER_SANITIZE_NUMBER_INT);
	$member_tel    = mysqli_real_escape_string($connection, $member_tel);
	$member_movil  = filter_var($member_movil,FILTER_SANITIZE_NUMBER_INT);
	$member_movil  = mysqli_real_escape_string($connection, $member_movil);
	
	$job_street    = filter_var(ucwords($job_street),FILTER_SANITIZE_STRING);
	$job_street    = mysqli_real_escape_string($connection, $job_street);
	$job_number    = filter_var($job_number,FILTER_SANITIZE_NUMBER_INT);
	$job_number    = mysqli_real_escape_string($connection, $job_number);

	//ajusta locacion:
	switch ($job_city) {
		case 'caba':
		$job_city = 'Ciudad de Buenos Aires';
		break;
		case 'buenos-aires':
		$job_city = 'Buenos Aires';
		break;
		case 'catamarca':
		$job_city = 'Catamarca';
		break;
		case 'chaco':
		$job_city = 'Chaco';
		break;
		case 'chubut':
		$job_city = 'Chubut';
		break;
		case 'cordoba':
		$job_city = 'Córdoba';
		break;
		case 'corrientes':
		$job_city = 'Corrientes';
		break;
		case 'entre-rios':
		$job_city = 'Entre Ríos';
		break;
		case 'formosa':
		$job_city = 'Formosa';
		break;
		case 'jujuy':
		$job_city = 'Jujuy';
		break;
		case 'la-pampa':
		$job_city = 'La Pampa';
		break;
		case 'la-rioja':
		$job_city = 'La Rioja';
		break;
		case 'mendoza':
		$job_city = 'Mendoza';
		break;
		case 'misiones':
		$job_city = 'Misiones';
		break;
		case 'neuquen':
		$job_city = 'Neuquén';
		break;
		case 'rio-negro':
		$job_city = 'Río Negro';
		break;
		case 'salta':
		$job_city = 'Salta';
		break;
		case 'san-juan':
		$job_city = 'San Juan';
		break;
		case 'san-luis':
		$job_city = 'San Luis';
		break;
		case 'santa-cruz':
		$job_city = 'Santa Cruz';
		break;
		case 'santa-fe':
		$job_city = 'Santa Fé';
		break;
		case 'santiago-del-estero':
		$job_city = 'Santiago del Estero';
		break;
		case 'tierra-del-fuego':
		$job_city = 'Tierra del Fuego';
		break;
		case 'tucuman':
		$job_city = 'Tucumán';
		break;
	}

	//ahora se arman las variables para cargar la base de datos

	//los datos de la empresa vienen de la otra base de datos externa, solo hay que sumarle el domicilio y serializarlo
	$empresa = array(
		'razon-social'      => $usuario['razonSocial'],
		'cuit-empresa'      => $usuario['cuit'],
    	'sucursal'          => $usuario['sucursal'],
    	'fecha-ingreso'     => $usuario['mesDDJJ']. '/' .$usuario['anioDDJJ'],
    	'id-convenio'       => $usuario['idConvenio'],
    	'id-rama'           => $usuario['idRama'],
    	'nombre-convenio'   => $usuario['nonmbreConvenio'],
    	'empresa_domicilio' => $job_street . ' ' . $job_number . ', ' . $job_city,
	);

	$empresa = serialize($empresa);

	$query = "INSERT INTO $tabla (member_cuil,member_cuit,member_dni, member_apellido, member_nombre, member_fecha_ingreso, member_empresa, member_email, member_telefono, member_movil) VALUES ('$cuil', '$cuit', '$dni', '$apellido', '$nombre', ";//continua el query debajo

	if ( $fechaIngreso > $fecha_actual || $fechaIngreso == '' || $fechaIngreso == '0000-00-00' ) {
		$query .= "NULL ";
	} else {
		$query .= "'".$fechaIngreso."'";
	}

	$query .= ", '$empresa', '$member_email', '$member_tel', '$member_movil') ";
	
	$nuevoMembert = mysqli_query($connection, $query); 
	$memberID = mysqli_insert_id($connection);

	closeDataBase( $connection );

	return $memberID;			
}

/*
 *	actualiza el usuario en base de datos local de acuerdo a su id
 *
*/
function updateUser( $data ) {
	$connection = connectDB();
	$tabla = 'afiliados';

	if ( !isset($_POST['id-member']) || $_POST['id-member'] == '') {
		return 'error';
	}
	
	$member_id     =  $data; //$_POST['id-member'];
	$member_email  = isset($_POST['member_email']) ? strtolower($_POST['member_email']) : '';
	$member_tel    = isset($_POST['member_tel']) ? $_POST['member_tel'] : '';
	$member_movil  = isset($_POST['member_cellphone']) ? $_POST['member_cellphone'] : '';
	$member_street = isset($_POST['member_street']) ? strtolower($_POST['member_street']) : '';
	$member_number = isset($_POST['member_number']) ? $_POST['member_number'] : '';
	$member_city   = isset($_POST['member_city']) ? strtolower($_POST['member_city']) : '';
	$job_street    = isset($_POST['job_street']) ? strtolower($_POST['job_street']) : '';
	$job_number    = isset($_POST['job_number']) ? $_POST['job_number'] : '';
	$job_city      = isset($_POST['job_city']) ? strtolower($_POST['job_city']) : '';

	//SANITIZE:
	$member_email  = filter_var($member_email,FILTER_SANITIZE_EMAIL);
	$member_email  = mysqli_real_escape_string($connection, $member_email);
	$member_tel    = filter_var($member_tel,FILTER_SANITIZE_NUMBER_INT);
	$member_tel    = mysqli_real_escape_string($connection, $member_tel);
	$member_movil  = filter_var($member_movil,FILTER_SANITIZE_NUMBER_INT);
	$member_movil  = mysqli_real_escape_string($connection, $member_movil);
	$member_street = filter_var(ucwords($member_street),FILTER_SANITIZE_STRING);
	$member_street = mysqli_real_escape_string($connection, $member_street);
	$member_number = filter_var($member_number,FILTER_SANITIZE_NUMBER_INT);
	$member_number = mysqli_real_escape_string($connection, $member_number);
	$member_city   = filter_var(ucwords($member_city),FILTER_SANITIZE_STRING);
	$member_city   = mysqli_real_escape_string($connection, $member_city);
	$job_street    = filter_var(ucwords($job_street),FILTER_SANITIZE_STRING);
	$job_street    = mysqli_real_escape_string($connection, $job_street);
	$job_number    = filter_var($job_number,FILTER_SANITIZE_NUMBER_INT);
	$job_number    = mysqli_real_escape_string($connection, $job_number);
	$job_city      = filter_var(ucwords($job_city),FILTER_SANITIZE_STRING);
	$job_city      = mysqli_real_escape_string($connection, $job_city);

	//ahora se arman las variables para cargar la base de datos
	//1. la dirección del afiliado se serializa
	$member_domicilio = array(
		'calle' => $member_street,
		'altura' => $member_number,
		'piso' => '',
		'departamento' => '',
		'otros' => '',
	);
	$member_domicilio = serialize($member_domicilio);
	
	//2. los datos de la empresa, primero recupera los que ya están para sumarles los nuevos
	$dataAfiliado  = getDataAfiliado($member_id);
	//recuperamos los datos viejos
	$empresa       = unserialize($dataAfiliado['member_empresa']);
	//agregamos los datos nuevos
	$empresa['empresa_domicilio'] = $job_street . ' ' . $job_number;
	$empresa['empresa_localidad'] = $job_city;
	//volvemos a serializar para guardar en bd
	$empresa       = serialize($empresa);

	$query = "UPDATE ".$tabla." SET member_email='".$member_email."',member_telefono='".$member_tel."', member_movil='".$member_movil."', member_domicilio='".$member_domicilio."', member_localidad='".$member_city."', member_empresa='".$empresa."' WHERE member_id='".$member_id."' LIMIT 1";


	$update = mysqli_query($connection, $query); 
	
	closeDataBase( $connection );

	if ($update) {
		return 'ok';
	} else {
		return 'error';
	}
}


function createUserLink( $id, $key ) {
	$connection = connectDB();
	$tabla = 'afiliados';

	$query = "UPDATE ".$tabla." SET member_link='".$key."' WHERE member_id='".$id."' LIMIT 1" ;

	$update = mysqli_query($connection, $query); 
	
	closeDataBase( $connection );

	if ($update) {
		return 'ok';
	} else {
		return 'error';
	}
}



/*
 *	recupera datos del afiliado de acuerdo a su id
 *
*/
function getDataAfiliado( $id ) {
	$connection = connectDB();
	$tabla = 'afiliados';
	
	$query  = "SELECT * FROM " .$tabla. " WHERE member_id='".$id."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		return null;
	} else {
		$afiliado = mysqli_fetch_array($result);
	}
	return $afiliado;
}
function getDataCuil( $cuil ) {
	$connection = connectDB();
	$tabla = 'afiliados';
	
	$query  = "SELECT * FROM " .$tabla. " WHERE member_cuil='".$cuil."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		return null;
	} else {
		$afiliado = mysqli_fetch_array($result);
	}
	return $afiliado;
}

//mira a ver si el cuil está en la base de datos local y devuelve true si está false sino.
function checkCuilHere($cuil) {
	if ( $cuil == '' ) {
		return 'error-2';//falta ingresar cuil
	}

	$connection = connectDB();
	$tabla = 'afiliados';

	$query  = "SELECT * FROM " .$tabla. " WHERE member_cuil='".$cuil."'";

	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );
	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		return true;
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
		return 'error-2';//falta ingresar cuil
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
		return $usuario;
	}
	
	else {
		return 'error-1'; //no existe cuil
	}

}

//envia un email al administrador y al usuario registrado
function sendEmail( $cuil, $emailAfiliado, $nombreAfiliado, $telefonoAfiliado, $emailAdministrador =  EMAILAFILIADOS ) {
	require_once("class.phpmailer.php");
	require_once("class.smtp.php");

	$emailTo = $emailAfiliado;
	$nombre = $nombreAfiliado;
	$contacto = $telefonoAfiliado;
	$asuntoAfiliado = 'Bienvenido a ATSA Buenos Aires';
	$asuntoAdministrador = 'Nuevo afiliado registrado';
	$link = MAINSURL . '/afiliados/index.php?admin=edit-contacts&slug='.$cuil;

	$afiliadoContenidoEmail  = '<a href="https://atsa.org.ar"> <img src="https://atsa.org.ar/afiliate/mailConfirmacionAfiliate.png"  /></a>';
	$afiliadoContenidoAlt  = 'Bienvenido a ATSA Buenos Aires. Un asesor se comunicará con usted para terminar el trámite de afiliación. Muchas gracias.';
	
	$adminContenidoEmail  = '<div>Un nuevo afiliado ha sido registrado:<br>';
	$adminContenidoEmail .= 'Nombre: '.$nombre.' <br>';
	$adminContenidoEmail .= 'Email: '.$emailAfiliado.' <br>';
	$adminContenidoEmail .= 'Contacto: '.$contacto.' <br>';
	$adminContenidoEmail .= 'Para verlo online, haga click <a href="'.$link.'" target="_blank">aquí</a>, o copie y pegue el link debajo:<br></div>';
	$adminContenidoEmail .= '<div>'.$link.'</div>';
	
	//va primero el email al afiliado

	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	//$mail->isSMTP();
	//$mail->Host = 'localhost';
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	$mail->CharSet = 'UTF-8';
	//Set who the message is to be sent from
	$mail->setFrom(EMAILSISTEMA, 'ATSA');
	//Set an alternative reply-to address
	//$mail->addReplyTo($email, $nombre);
	//Set who the message is to be sent to
	$mail->addAddress($emailTo, $nombre);
	//Set the subject line
	$mail->Subject = $asuntoAfiliado;
	$mail->IsHTML(true);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	$mail->MsgHTML($afiliadoContenidoEmail);
	$mail->AltBody = $afiliadoContenidoAlt;
	//send the message, check for errors
	
	if (!$mail->send()) { //TODO: coco si aca dejaba el echo por exito, entra en conflicto con el valor de devolucion de ajax y el script da error
	     	}  

	//envio a administrador
	$mailAdmin = new PHPMailer;
	//Tell PHPMailer to use SMTP
	//$mail->isSMTP();
	//$mail->Host = 'localhost';
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mailAdmin->SMTPDebug = 0;
	$mailAdmin->CharSet = 'UTF-8';
	//Set who the message is to be sent from
	$mailAdmin->setFrom(EMAILSISTEMA, 'ATSA');
	//Set an alternative reply-to address
	$mailAdmin->addReplyTo($emailAfiliado, $nombre);
	//Set who the message is to be sent to
	$mailAdmin->addAddress($emailAdministrador, 'ATSA');
	//Set the subject line
	$mailAdmin->Subject = $asuntoAdministrador;
	$mailAdmin->IsHTML(true);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	$mailAdmin->MsgHTML($adminContenidoEmail);
	$mailAdmin->AltBody = $adminContenidoEmail;
	//send the message, check for errors
	if (!$mailAdmin->send()) {
		//TODO: coco si aca dejaba el echo por exito, entra en conflicto con el valor de devolucion de ajax y el script da error
	     
	} 
}

//envia un email al administrador para avisar q alguien intentó registrarse
function sendEmailToAdmin( $datos = array(), $emailAdministrador =  EMAILAFILIADOS ) {
	require_once("class.phpmailer.php");
	require_once("class.smtp.php");

	$emailTo = $emailAfiliado;
	$asuntoAdministrador = 'SOLICITUD RECHAZADA';
	//$link = MAINSURL . '/afiliados/index.php?admin=edit-contacts&slug='.$cuil;
	
	$apellido = isset( $_POST['lastname'] ) ? $_POST['lastname'] : '';
	$nombre = isset( $_POST['name'] ) ? $_POST['name'] : '';
	$dni  = isset( $_POST['dni'] ) ? $_POST['dni'] : '';
	$cuil  = isset( $_POST['cuil'] ) ? $_POST['cuil'] : '';
	$cuit  = isset( $_POST['cuit'] ) ? $_POST['cuit'] : '';
	$fechaIngresoEmpresa = isset( $_POST['date-start'] ) ? $_POST['date-start'] : '';
	$tel   = isset( $_POST['member_tel'] ) ? $_POST['member_tel'] : '';
	$movil = isset( $_POST['member_cellphone'] ) ? $_POST['member_cellphone'] : '';
	$email = isset( $_POST['member_email'] ) ? $_POST['member_email'] : '';
	$calle = isset( $_POST['job_street'] ) ? $_POST['job_street'] : '';
	$altura = isset( $_POST['job_number'] ) ? $_POST['job_number'] : '';
	$localidad = isset( $_POST['job_city'] ) ? $_POST['job_city'] : '';
	
	
	
	$nombreAfiliado = $nombre . ' ' . $apellido;
	$direccion = $calle . ' ' . $altura . ', Localidad:' . $localidad;

	$adminContenidoEmail  = '<div>Un nuevo afiliado ha intentado registrarse sin éxito:<br>';
	$adminContenidoEmail .= 'Nombre: '.$nombreAfiliado.' <br>';
	$adminContenidoEmail .= 'Cuil: '.$cuil.' <br>';
	$adminContenidoEmail .= 'DNI: '.$dni.' <br>';
	$adminContenidoEmail .= 'Email: '.$email.' <br>';
	$adminContenidoEmail .= 'Tel: '.$tel.' <br>';
	$adminContenidoEmail .= 'Cel: '.$movil.' <br>';
	$adminContenidoEmail .= 'Fecha de Ingreso Empresa: '.$fechaIngresoEmpresa.' <br>';
	$adminContenidoEmail .= 'CUIT: '.$cuit.' <br>';
	$adminContenidoEmail .= 'Dirección: '.$direccion.' <br>';
	$adminContenidoEmail .= '</div>';

	//envio a administrador
	$mailAdmin = new PHPMailer;
	//Tell PHPMailer to use SMTP
	//$mail->isSMTP();
	//$mail->Host = 'localhost';
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mailAdmin->SMTPDebug = 0;
	$mailAdmin->CharSet = 'UTF-8';
	//Set who the message is to be sent from
	$mailAdmin->setFrom(EMAILSISTEMA, 'ATSA');
	//Set an alternative reply-to address
	$mailAdmin->addReplyTo($emailAfiliado, $nombre);
	//Set who the message is to be sent to
	$mailAdmin->addAddress($emailAdministrador, 'ATSA');
	//Set the subject line
	$mailAdmin->Subject = $asuntoAdministrador;
	$mailAdmin->IsHTML(true);
	//Read an HTML message body from an external file, convert referenced images to embedded,
	$mailAdmin->MsgHTML($adminContenidoEmail);
	$mailAdmin->AltBody = $adminContenidoEmail;
	//send the message, check for errors
	if (!$mailAdmin->send()) {
		//TODO: coco si aca dejaba el echo por exito, entra en conflicto con el valor de devolucion de ajax y el script da error
		
	     
	} 
}