<?php
/*
 * delete liga
 * borra el post seleccionado de acuerdo a su id
*/
require_once('../functions.php');
if ( isAjax() ) {

$connection     = connectDB();
$tabla  = 'liga';
$id        = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';

//borramos el post
$query      = "DELETE FROM ".$tabla." WHERE id= '".$id."'";
$result     = mysqli_query($connection, $query);
   
   if ($result) {
		echo 'deleted';
   } else {
   		echo 'error-deleted-post';
   }


//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}