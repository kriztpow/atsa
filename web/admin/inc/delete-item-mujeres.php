<?php
/*
 * borra beneficio seleccionado
 * Since 4.0
 * borra el beneficio seleccionado
*/
require_once("functions.php");
if ( isAjax() ) {
	print_r($_POST);
	$connection = connectDB();
	$tabla      = 'mujeres';
	$itemID   = isset( $_POST['idItem'] ) ? $_POST['idItem'] : 'none';
	//borramos el post
	$query      = "DELETE FROM ".$tabla." WHERE id= '".$itemID."' ";
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