<?php
/*
 * modulo deportes, funciones de todo lo que sea deportes
*/

function getPostsFromDeportes( $tabla, $limit = null, $condition = null, $orden = null ) {
	$connection = connectDB();

	//queries según parámetros
    $query = "SELECT * FROM " .$tabla;
    
	//condicion
	if ( $condition != null ) {
		$query  .= " WHERE " . $condition;
	}
    
    //order
    if ( $orden != null ) {
        $query  .= " ORDER by ";
    }

    //limite
    if ($limit != null ) {
        $query  .= " LIMIT ".$limit;
    }
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return null;
	} else {

		while ( $row = $result->fetch_array() ) {
			$posts[] = $row;
        }

        return $posts;
    }
}

//recupera post, por el slug
function getPostsFromDeportesBySlug( $slug, $tabla ) {
	$connection = connectDB();

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE slug='".$slug."'";
	
	$result = mysqli_query($connection, $query);
	$post = $result->fetch_array();
	
	return $post;
}

//recupera post, por el id
function getPostsFromDeportesById( $id, $tabla ) {
	$connection = connectDB();

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE id='".$id."'";
	
	$result = mysqli_query($connection, $query);
	$post = $result->fetch_array();
	
	return $post;
}

////
/*
 * obtiene lista de ligas
*/
function getLigas($filtro = null) {
    $tabla = 'liga';

    $ligas = getPostsFromDeportes( $tabla, null, $filtro );
    return $ligas;
}

/*
 * Obtiene data del deporte mediante id
*/
function getDataDeporte($id) {

    $deporte = getPostsFromDeportesById( $id, 'deportes' );

    return $deporte;
}