<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/
session_start();
require_once('../functions.php');
if ( isAjax() ) {
	
	//se toman los datos para variables
	$connection          = connectDB();
	$tabla               = 'noticias';
	$user                = $_SESSION['user_id'];
	$postID              = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '';
	$newPost             = isset( $_POST['new_post'] ) ? $_POST['new_post'] : '';
	$postTitulo          = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
	$postCategoria       = isset( $_POST['post_categoria'] ) ? $_POST['post_categoria'] : 'categoria1';
	$postUrl             = isset( $_POST['post_url'] ) ? $_POST['post_url'] : 'none';
	$postStatus          = isset( $_POST['post_status'] ) ? $_POST['post_status'] : 'none';
	$postDate            = isset( $_POST['post_date'] ) ? $_POST['post_date'] : 'none';
	$postResumen         = isset( $_POST['post_resumen'] ) ? $_POST['post_resumen'] : 'none';
	$postResumen2        = isset( $_POST['post_resumen_2'] ) ? $_POST['post_resumen_2'] : 'none';
	$postContenido       = isset( $_POST['post_contenido'] ) ? $_POST['post_contenido'] : 'none';
	$postImagen          = isset( $_POST['post_imagen'] ) ? $_POST['post_imagen'] : 'none';
	$postVideo           = isset( $_POST['post_video'] ) ? $_POST['post_video'] : 'none';
	$postGaleria         = isset( $_POST['post_galeria'] ) ? $_POST['post_galeria'] : '0';//si es true hay que pasarlo a 1 para que se guarde correctamente
	$imgGaleria          = isset( $_POST['imgGaleria'] ) ? $_POST['imgGaleria'] : '';
	$postDestacado       = isset( $_POST['post_destacado'] ) ? $_POST['post_destacado'] : '0';//si es true hay que pasarlo a 1 para que se guarde correctamente


    //saneamiento
	$postResumen         = mysqli_real_escape_string($connection, $postResumen);
	$postResumen2        = mysqli_real_escape_string($connection, $postResumen2);
	$postContenido       = mysqli_real_escape_string($connection, $postContenido);
	$postTitulo          = mysqli_real_escape_string($connection, $postTitulo);
	$postResumen         = filter_var($postResumen,FILTER_SANITIZE_STRING);
	$postResumen2        = filter_var($postResumen2,FILTER_SANITIZE_STRING);
	$postTitulo          = filter_var($postTitulo,FILTER_SANITIZE_STRING);

	//si hay una galería hay que armar un array con las imagenes y luego serializarlas
	if ( $postGaleria == 'true' ) {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postGaleria = '1';
	}	else {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postGaleria = '0';
	}
	if ( $imgGaleria != '' ) {
		$imagenesGaleria = explode(',', $imgGaleria );
		
		for ($i=0; $i < count($imagenesGaleria)-1; $i++) { 
			$imagenesGaleria[$i] = trim($imagenesGaleria[$i]);
		}
		
		$imagenesGaleria = serialize($imagenesGaleria);
	} else {
		$imagenesGaleria = '';
	}
	
	if ( $postDestacado == 'true' ) {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postDestacado = '1';
	}	else {
		//en la base de datos se escribe como 1 y 0 así que traduzco a 1 y 0 para que se guarde correctamente
		$postDestacado = '0';
	}

/*
* GUARDAR POST
*/

	//es nuevo post
	if ($newPost == 'true') {
		//primero hay que ver si el url no está tomado y si está tomado enviar un mensaje
		$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$postUrl."' ";
		$result = mysqli_query($connection, $query);
		if ( $result->num_rows != 0 ) {
			echo 'error-url';
			exit;
		}

		$query = "INSERT INTO $tabla (post_autor,post_fecha,post_titulo,post_url,post_contenido,post_resumen,post_resumen_2,post_imagen,post_video,post_categoria,post_galeria,post_imagenesGal,post_status,post_destacado) VALUES ('$user', '$postDate', '$postTitulo', '$postUrl', '$postContenido', '$postResumen','$postResumen2', '$postImagen', '$postVideo', '$postCategoria', '$postGaleria', '$imagenesGaleria', '$postStatus',$postDestacado)";

		$nuevoPost = mysqli_query($connection, $query); 
		$postID = mysqli_insert_id($connection);

		echo 'saved';

	} //es viejo post
		else {

		$query = "UPDATE ".$tabla." SET post_autor='".$user."',post_fecha='".$postDate."', post_titulo='".$postTitulo."',post_url='".$postUrl."',post_contenido='".$postContenido."',post_resumen='".$postResumen."',post_resumen_2='".$postResumen2."',post_imagen='".$postImagen."',post_video='".$postVideo."',post_categoria='".$postCategoria."',post_galeria='".$postGaleria."',post_imagenesGal='".$imagenesGaleria."',post_status='".$postStatus."',post_destacado='".$postDestacado."' WHERE post_ID='".$postID."' LIMIT 1";

		$updatePost = mysqli_query($connection, $query); 
		
		echo 'updated';
	}

//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}
