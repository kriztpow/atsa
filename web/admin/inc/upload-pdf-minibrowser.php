<?php
/*
 * upload pdf a la carpeta sin base de datos de por medio
 * Since 3.0
*/
require_once("functions.php");

//primero chequea si es una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//print_r($_FILES);

$directorio = UPLOADS . '/pdfs';
$newFile    = $_FILES['file']['name'];
$tmpName    = $_FILES['file']['tmp_name'];
$fileType   = $_FILES['file']['type'];

	//segundo chequea si hay algun archivo
	if ( $newFile != '' ) {
		//tercero vemos si es el tipo de archivo requerido
		if ( strpos($fileType[0], "pdf") || strpos($fileType[0], "doc") ||
 	strpos($fileType[0], "docx") ) {

			//entonces se renombra el archivo
			$newFile = renombrar_archivo( $newFile[0], 'ATSA' );

		    //luego se comprueba si el archivo ha subido
		    if ($newFile && move_uploaded_file($tmpName[0], $directorio . '/' . $newFile)) {
		       
		       echo json_encode($newFile);

		    }

		}//no es un archivo de pdf se cancela y se sigue por otro archivo
	    else {
	    	echo 'error-type';
	    }


	}

} else{
	//sino es peticion ajax
    throw new Exception("Error Processing Request", 1);   
}