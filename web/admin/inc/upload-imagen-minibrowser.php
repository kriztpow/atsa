<?php
/*
 * upload imagen a la carpeta sin base de datos de por medio
 * Since 3.0
*/
require_once("functions.php");

//primero chequea si es una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

$directorio = UPLOADSIMAGES;

$files = $_FILES['file'];
$cantArchivos = count($files['name']);
$cancelNow = false;
$img_subidas = array();

//segundo chequea si hay algun archivo
if ($cantArchivos > 0) {
	//tercero vemos si es el tipo de archivo requerido, si hay alguno que falla, omite todo
	for ($i=0; $i < $cantArchivos; $i++) { 
		if (((strpos($files['type'][$i], "gif") || strpos($files['type'][$i], "jpeg") ||
	 	strpos($files['type'][$i], "jpg")) || strpos($files['type'][$i], "png"))) {
			$cancelNow = false;
	 	} else {
	 		$cancelNow = true;
	 	}

	 	if ($cancelNow) {
	 		echo 'error-type';
	 		exit;
	 	}
	
	}//for


	//si el formato de todos es correcto, entonces los sube a todos
	for ($i=0; $i < $cantArchivos; $i++) {
		$newFile = renombrar_archivo( $files['name'][$i], 'ATSA' );
		if ($newFile && move_uploaded_file($files['tmp_name'][$i], $directorio . '/' . $newFile)) {
		       array_push($img_subidas, $newFile);
		    }
	}//for

	//devuelve el json con las imágenes
	echo json_encode($img_subidas);
}//cantidad de archivos 0

} else{
	//sino es peticion ajax
    throw new Exception("Error Processing Request", 1);   
}