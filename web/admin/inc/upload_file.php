<?php
/*
 * upload file
 * Since 2.0
*/
require_once("connect.php");
require_once("../functions.php");

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 
 	//variables principales
	$upload_Dir = UPLOADS;
	$post_type    = $_POST['programas'];//es un array con varios aunque puede ser uno solo
	$cantarchivos = count($post_type);
	$archivo     = $_FILES['archivo'];//archivo solo
	$id           = '';
	$archivosSubidos = array();

	Upload_Files( $archivo['name'], $archivo['type'], $archivo['tmp_name'], 'programas', $upload_Dir );
	
} else{
	//sino es peticion ajax
    throw new Exception("Error Processing Request", 1);   
}

	/*
	funciones a ejecutar
	*/

//funcion subir archivo
function Upload_Files ( $newFile, $fileType, $filetmp, $rename, $directorio ) {
	global $archivosSubidos;
	global $connection;
	global $cantarchivos;
	global $post_type;
	//primero chequea si hay algun archivo
	if ( $newFile != '' ) {
		//segundo vemos si es el tipo de archivo requerido
		if ( strpos($fileType, "pdf") || strpos($fileType, "doc") ||
 	strpos($fileType, "docx") ) {
		    
			//entnces se renombra el archivo
			$newFile = renombrar_archivo( $newFile, $rename );

		    //luego se comprueba si el archivo ha subido
		    if ($newFile && move_uploaded_file($filetmp, $directorio . '/' . $newFile)) {
		       
		       //subo este archivo a la base de datos:
		    	//si esta selecionado un solo post_type
		    	if ( $cantarchivos == 1 ) {
					Upload_Files_BD ($newFile, 'file_uploads', $fileType, $post_type[0]);	
					$id = mysqli_insert_id($connection);	
					array_push($archivosSubidos, $newFile, $id, $post_type[0]);//agrego la imagen al array de imagenes subidas y su id	
					
		    	} else {
		    		for ($i = 0; $i < $cantarchivos; $i++) {
		    			Upload_Files_BD ($newFile, 'file_uploads', $fileType, $post_type[$i]);	
						$id = mysqli_insert_id($connection);	
						array_push($archivosSubidos, $newFile, $id, $post_type[$i]);//agrego la imagen al array de imagenes subidas y su id	
		    		}

		    	} 

		    }

		} //no es un archivo de imagen se cancela y se sigue por otro archivo
	    else {
	    	echo 'no es un archivo de imagen permitido';
	    }

	}// if hay archivo

} //Upload_Images()

//funcion cargar archivo en base de datos
function Upload_Files_BD ($file, $tabla, $fileType, $post_type) {
	global $connection;

	$url = UPLOADSURL . '/' . $file;
	//$tabla = 'img_uploads';
	//$query = "INSERT INTO $tabla (nombre_archivo,tipo_imagen,url,orden,post_type) VALUES ('$file','$fileType','$url',0,'$post_type')";
	$query = "REPLACE INTO ".$tabla." (nombre_archivo,tipo_imagen,url,orden,post_type) VALUES('".$file."','".$fileType."','".$url."',0,'".$post_type."')";  
		       
	//guardar archivo en base de datos
	mysqli_query($connection, $query); 

} //Upload_Images_BD()


//cierre base de datos
mysqli_close($connection);