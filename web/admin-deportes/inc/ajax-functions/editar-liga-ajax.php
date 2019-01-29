<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/

require_once('../functions.php');
load_module('deportes');
if ( isAjax() ) {
    
    //se toman los datos para variables
	$connection   = connectDB();
	$tabla        = 'liga';
	$postID       = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : 'new';
    $nombreLiga   = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
	$deporteID    = isset( $_POST['post_categoria'] ) ? $_POST['post_categoria'] : '';
	$slugLiga     = isset( $_POST['post_url'] ) ? $_POST['post_url'] : '';
	$zonasId      = isset( $_POST['zonas_id'] ) ? $_POST['zonas_id'] : '';

    //saneamiento
    $nombreLiga   = mysqli_real_escape_string($connection, $nombreLiga);
    $nombreLiga   = filter_var($nombreLiga,FILTER_SANITIZE_STRING);

    /*
    * GUARDAR POST
    */

    //es nuevo post
    
	if ($postID == 'new') {

		//primero hay que ver si el url no está tomado y si está tomado enviar un mensaje
		$query  = "SELECT * FROM " .$tabla. " WHERE slug='".$slugLiga."' ";
		$result = mysqli_query($connection, $query);
		if ( $result->num_rows != 0 ) {
			echo 'error-url';
			exit;
		}

        //sino se guarda
        $query = "INSERT INTO $tabla (deporte_id,nombre,slug,zonas_id) VALUES ('$deporteID', '$nombreLiga', '$slugLiga', '$zonasId')";

        $nuevoPost = mysqli_query($connection, $query); 
        
        if ($nuevoPost) {
            $postID = mysqli_insert_id($connection);
            echo $postID;
        } else  {
            echo 'error';
            
        }

	} //es viejo post
		else {

        $query = "UPDATE ".$tabla." SET deporte_id='".$deporteID."',nombre='".$nombreLiga."',slug='".$slugLiga."',zonas_id='".$zonasId."' WHERE id='".$postID."' LIMIT 1";

		$updatePost = mysqli_query($connection, $query); 
		if ($updatePost) {
            echo 'updated';
        } else {
            echo 'error';
        }	
	}

    //cierre base de datos
    mysqli_close($connection);

} //if not ajax
else {
	exit;
}