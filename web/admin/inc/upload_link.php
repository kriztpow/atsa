<?php
/*
 * upload file
 * Since 2.0
*/
require_once("connect.php");
require_once("../functions.php");

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
 
 	//variables principales
	$post_type = $_POST['post_type'];
	$link      = $_POST['url'];

	Upload_Files_BD($link, 'file_uploads', 'link', $post_type);
	
} else{
	//sino es peticion ajax
    throw new Exception("Error Processing Request", 1);   
}

	/*
	funciones a ejecutar
	*/

//funcion subir archivo

//funcion cargar archivo en base de datos
function Upload_Files_BD ($url, $tabla, $fileType, $post_type) {
	global $connection;

	//$query = "INSERT INTO $tabla (nombre_archivo,tipo_imagen,url,orden,post_type) VALUES (NULL,'$fileType','$url',0,'$post_type')";
	$query = "REPLACE INTO ".$tabla." (nombre_archivo,tipo_imagen,url,orden,post_type) VALUES(NULL,'".$fileType."','".$url."',0,'".$post_type."')";       
	//guardar archivo en base de datos
	mysqli_query($connection, $query); 

} //Upload_Images_BD()


//cierre base de datos
mysqli_close($connection);