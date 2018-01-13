<?php
/*
 * delete slider
 * Since 3.0
 * borra el slider seleccionado
*/
require_once('../functions.php');
if ( isAjax() ) {

	$connection = connectDB();
	$tabla      = 'cursos';
	$curso   = isset( $_POST['curso'] ) ? $_POST['curso'] : 'none';
	//borramos el post
	$query      = "DELETE FROM ".$tabla." WHERE curso_id= '".$curso."' ";
	$result     = mysqli_query($connection, $query);
	
   if ($result) {
		echo 'deleted';
   } else {
   		echo 'error-deleted-slider';
   }
	//cierre base de datos
	mysqli_close($connection);


} //if not ajax
else {
	exit;
}