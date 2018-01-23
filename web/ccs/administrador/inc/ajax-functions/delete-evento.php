<?php
/*
 * delete slider
 * Since 3.0
 * borra el slider seleccionado
*/
require_once('../functions.php');
if ( isAjax() ) {

	$connection = connectDB();
	$tabla      = 'agenda';
	$evento   = isset( $_POST['evento'] ) ? $_POST['evento'] : '';
	//borramos el post
	$query      = "DELETE FROM ".$tabla." WHERE agenda_id= '".$evento."' ";
	$result     = mysqli_query($connection, $query);
	
   if ($result) {
		echo 'deleted';
   } else {
   		echo 'error-deleted';
   }
	//cierre base de datos
	mysqli_close($connection);


} //if not ajax
else {
	exit;
}