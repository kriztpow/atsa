<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/
session_start();
require_once("functions.php");
if ( isAjax() ) {

	//se toman los datos para variables
	$connection          = connectDB();
	$tabla               = 'noticias';
	$tablaEtiquetas      = 'etiquetas';
	$user                = $_SESSION['user_id'];
	$postID              = isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : '';
	$newPost             = isset( $_POST['new_post'] ) ? $_POST['new_post'] : '';
	$postTitulo          = isset( $_POST['post_title'] ) ? $_POST['post_title'] : '';
	$postCategoria       = isset( $_POST['post_categoria'] ) ? $_POST['post_categoria'] : 'ATSA';
	$postUrl             = isset( $_POST['post_url'] ) ? $_POST['post_url'] : 'none';
	$postStatus          = isset( $_POST['post_status'] ) ? $_POST['post_status'] : 'none';
	$postDate            = isset( $_POST['post_date'] ) ? $_POST['post_date'] : 'none';
	$postBajada          = isset( $_POST['post_bajada'] ) ? $_POST['post_bajada'] : 'none';
	$postResumen         = isset( $_POST['post_resumen'] ) ? $_POST['post_resumen'] : 'none';
	$postContenido       = isset( $_POST['post_contenido'] ) ? $_POST['post_contenido'] : 'none';
	$postTags            = isset( $_POST['post_tags'] ) ? $_POST['post_tags'] : '';
	$postImagen          = isset( $_POST['post_imagen'] ) ? $_POST['post_imagen'] : 'none';
	$postVideo           = isset( $_POST['post_video'] ) ? $_POST['post_video'] : 'none';
	$postGaleria         = isset( $_POST['post_galeria'] ) ? $_POST['post_galeria'] : '0';//si es true hay que pasarlo a 1 para que se guarde correctamente
	$imgGaleria          = isset( $_POST['imgGaleria'] ) ? $_POST['imgGaleria'] : '';
	//creo variable para guardar etiquetas
    $etiquetasRelaciones = array();
    //saneamiento
	$postBajada          = mysqli_real_escape_string($connection, $postBajada);
	$postResumen         = mysqli_real_escape_string($connection, $postResumen);
	$postContenido       = mysqli_real_escape_string($connection, $postContenido);
	$postTitulo          = mysqli_real_escape_string($connection, $postTitulo);
	$postBajada          = filter_var($postBajada,FILTER_SANITIZE_STRING);
	$postResumen         = filter_var($postResumen,FILTER_SANITIZE_STRING);
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


	/*
	 procesar etiquetas EN EL POST si hay, si no hay ninguna se crea la variable vacia
	*/

	if ( $postTags != '' ) {
		$etiquetas = explode(',', $postTags );
		for ($i=0; $i < count($etiquetas); $i++) { 
			$etiquetas[$i] = rtrim($etiquetas[$i]);
			$etiquetas[$i] = ltrim($etiquetas[$i]);
		}
		
	} else {
		//variable vacía para guardar en el post
		$etiquetas = '';
	}
	//buscar las id de las etiquetas para guardarlo con el post
	if ($etiquetas != '') {
		//CADA UNA:
		for ($i=0; $i < count($etiquetas); $i++) { 
			$etiqueta = $etiquetas[$i];
			//1 busco si la etiqueta existe
			$querySearchTag  = "SELECT * FROM " .$tablaEtiquetas. " WHERE tag_name='".$etiqueta."' ";
			$result = mysqli_query($connection, $querySearchTag);
			
			//si la etiqueta no existe hay que crear una nueva
			if ( $result->num_rows == 0 ) {
				$queryCreateTag  = "INSERT INTO " .$tablaEtiquetas. " (tag_name) VALUES ('$etiqueta')";
				$result = mysqli_query($connection, $queryCreateTag);
				
				array_push($etiquetasRelaciones, mysqli_insert_id($connection));
				
			} else {
				// y si la etiqueta existe pido ID para guardar en el post y luego actualizar las relaciones
				$row = $result->fetch_array(MYSQLI_ASSOC);

				array_push($etiquetasRelaciones, $row['tag_id']);
			}

		}//for iteración etiquetas
		//finalmense serializo el array para guardar en base de datos
		
		$etiquetas = serialize($etiquetasRelaciones);

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

		$query = "INSERT INTO $tabla (post_autor,post_fecha,post_titulo,post_url,post_contenido,post_resumen,post_bajada,post_imagen,post_video,post_categoria,post_etiquetas,post_galeria,post_imagenesGal,post_status) VALUES ('$user', '$postDate', '$postTitulo', '$postUrl', '$postContenido', '$postResumen', '$postBajada', '$postImagen', '$postVideo', '$postCategoria', '$etiquetas', '$postGaleria', '$imagenesGaleria', '$postStatus')";

		$nuevoPost = mysqli_query($connection, $query); 
		$postID = mysqli_insert_id($connection);

		echo 'saved';
	} //es viejo post
		else {
			//antes de actualizar voy a pedir el dato de las etiquetas que tiene
			$queryPreview  = "SELECT * FROM " .$tabla. " WHERE post_ID='".$postID."' ";
			$resultPreview = mysqli_query($connection, $queryPreview);
			$row = $resultPreview->fetch_array(MYSQLI_ASSOC);
			$etiquetasViejas = $row['post_etiquetas'];

		$query = "UPDATE ".$tabla." SET post_autor='".$user."',post_fecha='".$postDate."', post_titulo='".$postTitulo."',post_url='".$postUrl."',post_contenido='".$postContenido."',post_resumen='".$postResumen."',post_bajada='".$postBajada."',post_imagen='".$postImagen."',post_video='".$postVideo."',post_categoria='".$postCategoria."',post_etiquetas='".$etiquetas."',post_galeria='".$postGaleria."',post_imagenesGal='".$imagenesGaleria."',post_status='".$postStatus."' WHERE post_ID='".$postID."' LIMIT 1";

		$updatePost = mysqli_query($connection, $query); 
		
		echo 'updated';
	}

/*
RELACIONES CON LAS ETIQUETAS
*/
	//si es NUEVO POST es fácil hay que crear las relaciones desde cero. 
	//NOTA: la etiqueta siempre existe porque Si era nueva ya se creo antes más arriba...
	if ($newPost == 'true' ) {
		for ($i=0; $i < count($etiquetasRelaciones); $i++) { 
		$tagID = $etiquetasRelaciones[$i];
			//primero hay que recuperar los datos de ese campo porque quizás la etiqueta ya tenga relaciones y no se quiere perderlas
			$querySearchTag  = "SELECT * FROM " .$tablaEtiquetas. " WHERE tag_id='".$tagID."' ";
			$result = mysqli_query($connection, $querySearchTag);
			$row = $result->fetch_array(MYSQLI_ASSOC);

			//chequeamos que tenga datos y serializamos, y si está vacía creamos una nueva variable
			if ( $row['tag_posts'] != '') {
				$relaciones = unserialize($row['tag_posts']);
			} else {
				$relaciones = array();
			}
			//a lo que ya existe, se le agrega el id del nuevo post
			array_push($relaciones, $postID);
			//se vuelve a pasar a string para guardar en BD
			$relaciones = serialize($relaciones);	
			//se guarda los nuevos datos en la base de datos
			$query = "UPDATE ".$tablaEtiquetas." SET tag_posts='".$relaciones."' WHERE tag_id='".$tagID."' LIMIT 1";
			$updateTags = mysqli_query($connection, $query); 

		}//for

	} else {
		//si el post no es nuevo y hay que actualizarlo primero vemos si hay un cambio en las etiquetas
		if ( $etiquetasViejas != $etiquetas ) {
			//al haber un cambio se viene el trabajo:
			//1. recuperamos todas las etiquetas de la base de datos
			$query = "SELECT * FROM ".$tablaEtiquetas." ";
			$result = mysqli_query($connection, $query);
			while ($row = $result->fetch_array()) {
					$rows[] = $row;
			}//while
			//2. recorremos cada una de ellas buscando el id del post
			foreach ($rows as $row ) {
				$tag = $row['tag_id'];
				$Posts = $row['tag_posts'];
				//sino tiene nada continuamos con la próxima
				if ($Posts == ''){
					continue;
				}
				$Posts = unserialize($Posts);
				$claveToDel = array_search($postID, $Posts);
				//3. si encontramos el post lo borramos
				if ($claveToDel === false) {
					continue;
				} else {
				//se borra este post solamente
				array_splice($Posts, $claveToDel, 1);
				}
				//se actualiza el contenido de cada etiqueta sin este post que se acaba de borrar
				$Posts = serialize($Posts);

				$query = "UPDATE ".$tablaEtiquetas." SET tag_posts='".$Posts."' WHERE tag_id='".$tag."' LIMIT 1";
				$result = mysqli_query($connection, $query);

			}//foreach
			//4. ahora buscamos las id de las etiquetas que el post requiere
			for ($i=0; $i < count($etiquetasRelaciones); $i++) { 
				$tagID = $etiquetasRelaciones[$i];
					//5. recuperamos el contenido de cada una para salvar lo que ya tiene
					$querySearchTag  = "SELECT * FROM " .$tablaEtiquetas. " WHERE tag_id='".$tagID."' ";
					$result = mysqli_query($connection, $querySearchTag);
					$row = $result->fetch_array(MYSQLI_ASSOC);

					//sino tiene nada se crea 
					if ( $row['tag_posts'] != '') {
						$relaciones = unserialize($row['tag_posts']);
					} else {
						$relaciones = array();
					}
					//buscamos si existe el id del post en la array de relaciones
					if ( !in_array($postID, $relaciones) ) {
						//6. le agregamos nuestro contenido
						array_push($relaciones, $postID);
						//se vuelve a pasar a string para guardar en BD
						$relaciones = serialize($relaciones);	
						//7. actualizamos la etiqueta ;)
						$query = "UPDATE ".$tablaEtiquetas." SET tag_posts='".$relaciones."' WHERE tag_id='".$tagID."' LIMIT 1";
						$updateTags = mysqli_query($connection, $query);
					}
				}//for
			
			//8. y ahora con todo actualizado, volvemos a recuperar las etiquetas para ver como quedó todo
			$query = "SELECT * FROM ".$tablaEtiquetas." ";
			$result = mysqli_query($connection, $query);
			while ($row = $result->fetch_array()) {
					$rows[] = $row;
			}//while
			//2. recorremos cada una de ellas si alguna quedo vacía, en ese caso hay que borrarla
			foreach ($rows as $row ) {
				$tag = $row['tag_id'];
				$Posts = $row['tag_posts'];
				$PostsArray = unserialize($Posts);
				//sino tiene nada continuamos con la próxima
				if (count($PostsArray) == 0){
					$query  = "DELETE FROM ".$tablaEtiquetas." WHERE tag_id= '".$tag."'";
					$result = mysqli_query($connection, $query);
				}
			}//foreach


		}//cambio en las etiquetas
		
	}//else (si el post es updated)


//cierre base de datos
mysqli_close($connection);


} //if not ajax
else {
	exit;
}