<?php
/*
 * delete post
 * Since 3.0
 * borra el post seleccionado de acuerdo a su url
*/
require_once("functions.php");
if ( isAjax() ) {

$connection     = connectDB();
$tablaNoticias  = 'noticias';
$tablaEtiquetas = 'etiquetas';
$postUrl        = isset( $_POST['post_url'] ) ? $_POST['post_url'] : 'none';

//buscamos id y etiquetas antes de borrar:
$query          = "SELECT * FROM ".$tablaNoticias." WHERE post_url= '".$postUrl."'";
$result         = mysqli_query($connection, $query);

$row            = $result->fetch_array(MYSQLI_ASSOC);
$postID         = $row['post_ID'];
$etiquetas      = $row['post_etiquetas'];


//borramos el post
$query      = "DELETE FROM ".$tablaNoticias." WHERE post_url= '".$postUrl."'";
$result     = mysqli_query($connection, $query);
   
   if ($result) {
		echo 'deleted';
   } else {
   		echo 'error-deleted-post';
   }


//si hay etiquetas borramos el post de esa etiqueta en particular
if ( $etiquetas != '' ) {
	//convertimos etiquetas a array
	$etiquetas = unserialize($etiquetas);
	
	//recorremos todas las etiquetas que tenía el post
	for ($i=0; $i < count($etiquetas); $i++) { 
		$etiqueta = $etiquetas[$i];
		
		//se toma de cada etiqueta los posts que hay dentro
		$query = "SELECT * FROM ".$tablaEtiquetas." WHERE tag_id= '".$etiqueta."'";
		$result = mysqli_query($connection, $query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$Posts = $row['tag_posts'];
		$Posts = unserialize($Posts);
		
		//se busca entre todos los posts de la etiqueta, este que fue borrado
		$claveToDel = array_search($postID, $Posts);
		
		//se borra este post solamente
		array_splice($Posts, $claveToDel, 1);
		
		//si la etiqueta se quedó vacía (sin ningun post), entonces se borra
		if ( count($Posts) == 0 ) {
		$query  = "DELETE FROM ".$tablaEtiquetas." WHERE tag_id= '".$etiqueta."'";
		$result = mysqli_query($connection, $query);
		
		} else {
		//si la etiqueta todavía tiene posts se actualiza el contenido de cada etiqueta sin este post que se acaba de borrar
		$Posts = serialize($Posts);

		$query = "UPDATE ".$tablaEtiquetas." SET tag_posts='".$Posts."' WHERE tag_id='".$etiqueta."' LIMIT 1";
		$result = mysqli_query($connection, $query);
		
		}//else
	}//for
}


//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}