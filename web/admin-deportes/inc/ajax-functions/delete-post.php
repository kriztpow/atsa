<?php
/*
 * delete post
 * Since 3.0
 * borra el post seleccionado de acuerdo a su url
*/
require_once('../functions.php');
if ( isAjax() ) {

$connection     = connectDB();
$tabla          = 'posts';
$postID         = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 'none';

//buscamos id y etiquetas antes de borrar:
$query          = "SELECT * FROM ".$tabla." WHERE post_ID= '".$postID."'";
$result         = mysqli_query($connection, $query);

$row            = $result->fetch_array(MYSQLI_ASSOC);
$partido         = $row['partido_id'];

//actualizamos el partido
$update = "UPDATE partidos SET contenido_id='' WHERE id='".$partido."' LIMIT 1";
$updated     = mysqli_query($connection, $update);

//borramos el post
$query      = "DELETE FROM ".$tabla." WHERE post_ID= '".$postID."'";
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