<?php
/*
 * borra curso seleccionado
 * Since 4.0
 * borra el curso seleccionado
*/
require_once("functions.php");
if ( isAjax() ) {
	print_r($_POST);
	$connection = connectDB();
	$tabla      = 'cursos';
	$itemID   = isset( $_POST['idItem'] ) ? $_POST['idItem'] : 'none';
	//borramos el post
	$query      = "DELETE FROM ".$tabla." WHERE curso_ID= '".$itemID."' ";
	$result     = mysqli_query($connection, $query);
	
   if ($result) {
		echo 'deleted';
   } else {
   		echo 'error';
   }
	//cierre base de datos
	mysqli_close($connection);


} //if not ajax
else {
	exit;
}