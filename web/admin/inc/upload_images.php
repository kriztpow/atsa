<?php
/*
 * Subir varias imagenes o una sola
 * Since 2.0
*/
require_once("connect.php");
require_once("../functions.php");

/*
	funcion principal, si es ajax se ejecuta sino se cancela
*/

//chequea si es peticion de ajax y ejecuta la funcion
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

 	
	//variables principales
	$upload_Dir = UPLOADS;
	$post_type    = $_POST['post_type'];
	$archivos     = $_FILES['archivo'];
	$CantArchivos = count( $archivos['name'] );
	$img_subidas  = array();
	$id           = '';

	for ( $i = 0; $i < $CantArchivos; $i++ ) {
		//subir archivo si existe
		Upload_Files( $archivos['name'][$i], $archivos['type'][$i], $archivos['tmp_name'][$i], $post_type, $upload_Dir );

	}//cierra for

	//devuelvo un json con todas las imágenes subidas
	echo json_encode($img_subidas);


//sino es peticion ajax se cancela
} else{
    throw new Exception("Error Processing Request", 1);   
}

/*
	funciones a ejecutar
*/

//funcion subir archivo
function Upload_Files ( $newFile, $fileType, $filetmp, $post_type, $directorio ) {
	global $img_subidas;
	global $connection;
	//primero chequea si hay algun archivo
	if ( $newFile != '' ) {
		//segundo vemos si es el tipo de archivo requerido
		if (((strpos($fileType, "gif") || strpos($fileType, "jpeg") ||
	 	strpos($fileType, "jpg")) || strpos($fileType, "png"))) {
		    
			//entnces se renombra el archivo
			$newFile = renombrar_archivo( $newFile, $post_type );

		    //luego se comprueba si el archivo ha subido
		    if ($newFile && move_uploaded_file($filetmp, $directorio . '/' . $newFile)) {

		       //subo este archivo a la base de datos:
		    	Upload_Images_BD ($newFile, 'img_uploads', $fileType, $post_type);
		    	$id = mysqli_insert_id($connection);
		    	array_push($img_subidas, $newFile, $id);//agrego la imagen al array de imagenes subidas y su id
		    }

		} //no es un archivo de imagen se cancela y se sigue por otro archivo
	    else {
	    	echo 'no es un archivo de imagen permitido';
	    }

	}// if hay archivo

} //Upload_Images()

//funcion cargar archivo en base de datos
function Upload_Images_BD ($file, $tabla, $tipo_imagen, $post_type, $orden = 0 ) {
	global $connection;

	$url = UPLOADSURL . '/' . $file;
	//$tabla = 'img_uploads';
	$query = "INSERT INTO $tabla (nombre_archivo,tipo_imagen,url,orden,post_type) VALUES ('$file','$tipo_imagen','$url','$orden','$post_type')";
		       
	//guardar archivo en base de datos
	mysqli_query($connection, $query); 

} //Upload_Images_BD()


//cierre base de datos
mysqli_close($connection);