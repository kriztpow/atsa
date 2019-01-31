<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/

require_once('../functions.php');
load_module('deportes');
if ( isAjax() ) {
    
    $action       = isset( $_POST['action'] ) ? $_POST['action'] : false;
    
    //var_dump($_POST);

    switch ($action) {
        case 'editar-liga':
        
            echo editarLiga($_POST);

        break;
        
        
    }//switch ajax
    
} //if not ajax
else {
	exit;
}


//funciones ajax
function editarLiga ($data) {

    //se toman los datos para variables
    $connection   = connectDB();
    $tabla        = 'liga';
    $postID       = isset( $data['post_ID'] ) ? $data['post_ID'] : 'new';
    $nombreLiga   = isset( $data['post_title'] ) ? $data['post_title'] : '';
    $deporteID    = isset( $data['post_categoria'] ) ? $data['post_categoria'] : '';
    $slugLiga     = isset( $data['post_url'] ) ? $data['post_url'] : '';
    $zonasId      = isset( $data['zonas_id'] ) ? $data['zonas_id'] : '';

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
            return 'error-url';
            exit;
        }

        //sino se guarda
        $query = "INSERT INTO $tabla (deporte_id,nombre,slug,zonas_id) VALUES ('$deporteID', '$nombreLiga', '$slugLiga', '$zonasId')";

        $nuevoPost = mysqli_query($connection, $query); 
        
        if ($nuevoPost) {
            $postID = mysqli_insert_id($connection);
            $respuesta = $postID;

            //si es nuevo hay que crear una zona por defecto
            $zona = editZona($postID, $data);

            if ( $zona > 0 ) {
                //al tener una zona, se actualiza la liga para agregar la zona
                $query = "UPDATE liga SET zonas_id='".$zona."' WHERE id='".$postID."' LIMIT 1";

                $updatePost = mysqli_query($connection, $query); 
                if (! $updatePost) {
                    $respuesta = 'error-zona';
                }	
            }

        } else  {
            $respuesta = 'error-liga';   
        }
        

    } //es viejo post
        else {

        $query = "UPDATE ".$tabla." SET deporte_id='".$deporteID."',nombre='".$nombreLiga."',slug='".$slugLiga."',zonas_id='".$zonasId."' WHERE id='".$postID."' LIMIT 1";

        $updatePost = mysqli_query($connection, $query); 
        if ($updatePost) {
            $respuesta = 'updated';
        } else {
            $respuesta = 'error';
        }	
    }

    //cierre base de datos
    mysqli_close($connection);

    return $respuesta;
    
}//editarLiga();

//crea o actualiza una zona
function editZona( $ligaId, $dataZona ) {
    $connection    = connectDB();
    $tabla         = 'zonas';
    $zonaId        = isset( $dataZona['zona_id'] ) ? $dataZona['zona_id'] : '';
    $nombre        = isset( $dataZona['nombre_zona'] ) ? $dataZona['nombre_zona'] : '';
    $slug          = isset( $dataZona['slug'] ) ? $dataZona['slug'] : '';
    $partidos      = isset( $dataZona['partidos_id'] ) ? $dataZona['partidos_id'] : '';
    $equipos       = isset( $dataZona['equipos_id'] ) ? $dataZona['equipos_id'] : '';

    $nombre   = mysqli_real_escape_string($connection, $nombre);
    $nombre   = filter_var($nombre,FILTER_SANITIZE_STRING);

    if ( $nombre == '' ) {
        $nombre = 'Zona A';
    }

    //el nombre interno siempre se actualiza con el nombre de la liga y el de la zona
    $liga = getPostsFromDeportesById( $ligaId, 'liga' );
    $nombreInterno = $nombre . '-' . $liga['nombre'];
    

    if ( $slug == '' ) {
        $slug = myUrlEncode($nombre);
    }

    //crea una nueva zona
    if ($zonaId == '' ) {
        
        $query = "INSERT INTO $tabla (nombre,nombre_interno,slug,liga_id,partidos_ids,equipos_ids) VALUES ('$nombre', '$nombreInterno', '$slug', '$ligaId','$partidos','$equipos')";

        $nuevaZona = mysqli_query($connection, $query); 
        $respuesta = mysqli_insert_id($connection);

    } else {
        //actualiza zona existente
        $query = "UPDATE ".$tabla." SET nombre='".$nombre."',nombre_interno='".$nombreInterno."',slug='".$slug."',liga_id='".$ligaId."', partidos_ids='".$partidos."', equipos_ids='".$equipos."' WHERE id='".$zonaId."' LIMIT 1";

        $updateZona = mysqli_query($connection, $query); 
        if ($updateZona) {
            $respuesta = 'updated';
        } else {
            $respuesta = 'error';
        }
    }
    
    mysqli_close($connection);

    return $respuesta;
}