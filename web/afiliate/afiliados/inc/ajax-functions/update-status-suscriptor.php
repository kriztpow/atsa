<?php
/*
 * delete post
 * Since 3.0
 * borra el post seleccionado de acuerdo a su url
*/
require_once('../functions.php');
if ( isAjax() ) {

$connection = connectDB();
$tabla      = 'afiliados';
$id         = isset( $_POST['id'] ) ? $_POST['id'] : '';
$status     = isset( $_POST['status'] ) ? $_POST['status'] : '0';

$query      = "UPDATE ".$tabla." SET member_status = '".$status."' WHERE member_id='".$id."'";

$result     = mysqli_query($connection, $query);
   
   if ($result) {
		echo 'ok';
   } else {
   		echo 'error';
   }


//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}