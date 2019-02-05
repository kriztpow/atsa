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
 * obtiene lista de zonas
*/
function getZonas($filtro = null) {
    $tabla = 'zonas';

    $zonas = getPostsFromDeportes( $tabla, null, $filtro );
    return $zonas;
}

/*
 * obtiene lista de equipos
*/
function getEquipos($filtro = null) {
    $tabla = 'equipos';

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

/*
 * EDITAR LA LIGA, NORMALMENTE VIENE DEL FORMULARIO DE EDICION
*/
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


/*
 * EDITAR EQUIPO, NORMALMENTE VIENE DEL FORMULARIO DE EDICION
*/
function editarEquipo ($data) {

    //se toman los datos para variables
    $connection   = connectDB();
    $tabla        = 'equipos';
    $postID       = isset( $data['post_ID'] ) ? $data['post_ID'] : 'new';
    $nombre       = isset( $data['post_title'] ) ? $data['post_title'] : '';
    $slug         = isset( $data['post_url'] ) ? $data['post_url'] : '';
	$logo         = isset( $data['logo'] ) ? $data['logo'] : '';
	$jugadoresId  = isset( $data['jugadores_id'] ) ? $data['jugadores_id'] : '';
	$ligaId       = isset( $data['liga_id'] ) ? $data['liga_id'] : '';
	$zonaId       = isset( $data['zona_id'] ) ? $data['zona_id'] : '';
    $deporteId    = isset( $data['post_categoria'] ) ? $data['post_categoria'] : '';
    $esupdate     = true;
    //saneamiento
    $nombre       = mysqli_real_escape_string($connection, $nombre);
    $nombre       = filter_var($nombre,FILTER_SANITIZE_STRING);

    /*
    * GUARDAR POST
    */

    //es nuevo post
    
    if ($postID == 'new') {
        $esupdate       = false;
        //primero hay que ver si el url no está tomado y si está tomado enviar un mensaje
        $query  = "SELECT * FROM " .$tabla. " WHERE slug='".$slug."' ";
        $result = mysqli_query($connection, $query);
        if ( $result->num_rows != 0 ) {
            return 'error-url';
            exit;
        }

        //sino se guarda
        $query = "INSERT INTO $tabla (liga_id,zona_id,deporte_id,nombre,slug,logo,jugadores_id) VALUES ('$ligaId', '$zonaId', '$deporteId','$nombre','$slug','$logo','$jugadoresId')";

        $nuevoPost = mysqli_query($connection, $query); 
        
        if ($nuevoPost) {
            $postID = mysqli_insert_id($connection);
            $respuesta = $postID;

        } else  {
            $respuesta = 'error-equipo';   
        }

    } //es viejo post
        else {

        $query = "UPDATE ".$tabla." SET liga_id='".$ligaId."', zona_id='".$zonaId."', deporte_id='".$deporteId."', nombre='".$nombre."', slug='".$slug."', logo='".$logo."', jugadores_id='".$jugadoresId."' WHERE id='".$postID."' LIMIT 1";

        $updatePost = mysqli_query($connection, $query); 
        if ($updatePost) {
            $respuesta = 'updated';
        } else {
            $respuesta = 'error';
        }	
    }

    //cierre base de datos
    mysqli_close($connection);


    /* 
     * Guardar el equipo en la zona si el equipo tiene definida una zona
     */
    if ( $zonaId != '' ) {
        $zona = getPostsFromDeportesById( $zonaId, 'zonas' );

        //si la zona en cuestion no tiene ningun equipo lo agrega y listo
        if ( $zona['equipos_ids'] == '' ) {
            
            $equiposIds = $postID;

            $connection = connectDB();
		    $query = "UPDATE zonas SET equipos_ids='".$equiposIds."' WHERE id='".$zona['id']."' LIMIT 1";

            $updateZona = mysqli_query($connection, $query); 
            if ($updateZona) {
                $respuesta = 'updated';
            } else {
                $respuesta = 'error';
            }

        } else {
            //si la zona en cuestion tiene equipos convierte a un array y busca si esta, si no esta lo agrega
            $equiposIds = explode(',', $zona['equipos_ids'] );

            if ( ($clave = array_search($postID, $equiposIds)) === false ) {

                array_push($equiposIds, $postID);

                $equiposIds = implode(',', $equiposIds);

                $connection = connectDB();
                $query = "UPDATE zonas SET equipos_ids='".$equiposIds."' WHERE id='".$zona['id']."' LIMIT 1";
                
                $updateZona = mysqli_query($connection, $query); 
                if ($updateZona) {
                    if ($esupdate) {
                        $respuesta = 'updated';
                    } else {
                        $respuesta = $postID;
                    }
                    
                } else {
                    $respuesta = 'error-zona';
                }
            }

        }	

    }

    return $respuesta;
    
}//editarEquipo();


/*
 * crea o actualiza una zona
*/
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

	$slug = myUrlEncode($nombre);

    //el nombre interno siempre se actualiza con el nombre de la liga y el de la zona
    $liga = getPostsFromDeportesById( $ligaId, 'liga' );
    $nombreInterno = $slug . '-' .  myUrlEncode($liga['nombre']); 

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

/*
 * guarda una zona en una liga
*/
function saveZonaOnLiga( $ligaId, $zonaId ) {
    $connection    = connectDB();
	$tabla         = 'liga';

	//recupera datos de liga
	$OlddataLiga = getPostsFromDeportesById( $ligaId, $tabla );

	//recupera zonas id
	$zonas = $OlddataLiga['zonas_id'];

    if ( $zonas == '' ) {
        $zonas = $zonaId;
    } else {
        $zonas .= ',' . $zonaId;
    }
	
	$query = "UPDATE ".$tabla." SET zonas_id='".$zonas."' WHERE id='".$ligaId."' LIMIT 1";

	$updatePost = mysqli_query($connection, $query); 
	if ($updatePost) {
		$respuesta = 'updated';
	} else {
		$respuesta = 'error';
	}

	mysqli_close($connection);
	return $respuesta;
}

/*
 * Borra la liga mediante id, al borrar la liga, tiene que borrar zonas y partidos
*/
function deleteLiga($ligaId){
	$connection = connectDB();
	
	//para borrar la liga hay que borrar todas las zonas y partidos:
	//primero recuperamos los datos de la liga
	$liga = getPostsFromDeportesById( $ligaId, 'liga' );
	
	$zonas = $liga['zonas_id'];
	$zonas = explode(',', $zonas);
 
	$borrarZonas = deleteZona($zonas);
 
	if ($borrarZonas == 'ok') {
	   //finalmente borramos la liga
	   $query      = "DELETE FROM liga WHERE id= '".$ligaId."'";
	   $result     = mysqli_query($connection, $query);
		  
	   if ($result) {
		  $respuesta = 'deleted';
	   } else {
			 $respuesta = 'error-deleted-post';
	   }
	}
 
	//cierre base de datos
	mysqli_close($connection);
 
	return $respuesta;
 }//deleteLiga()
 

 /*
 * Borra la zona que se le pasa
 * de cada zona borra los partidos,  si los hay
*/
 function deleteZona($zonas = array() ) {
	$connection = connectDB();
 
	//para guardar los partidos de cada zona
	$partidos = array();
	$Zonasborradas = 0;

	if ( ! is_array($zonas) ) {
		$zonas = array( $zonas );
	}

	foreach ($zonas as $zona ) {
	   //se recuperan los datos de la zona
	   $dataZona = getPostsFromDeportesById( $zona, 'zonas' );
	   $partidosIds = $dataZona['partidos_ids'];
	   $partidosIds = explode(',', $partidosIds);
 
	   //$partidosBorrados = deletePartidos($partidosIds);
	   for ($i=0; $i < count($partidosIds); $i++) { 
		  if ( ! in_array($partidosIds[$i], $partidos) ) {
			 array_push($partidos, $partidosIds[$i]);
		  }
	   }
	   
	   $query      = "DELETE FROM zonas WHERE id= '".$zona."'";
	   $result     = mysqli_query($connection, $query);
		  
	   if ($result) {
		  $Zonasborradas = $Zonasborradas+1;
	   } 
	   
	}
 
	if ( count($zonas) != $Zonasborradas || $Zonasborradas == 0 ) {
	   
	   $respuesta = 'error-borrado-zonas';
 
	} else {
	   $respuesta = 'ok';
	}
 
	//ahora se borran los partidos
	if (! empty($partidos) ) {
	   $respuesta = deletePartidos($partidos);
	} 
	
	//cierre base de datos
	mysqli_close($connection);
	return $respuesta;
 
 }//deleteZona()
 
 /*
 * Borra los partidos que se le pasan
*/
 function deletePartidos($partidos = array() ) {
	$connection = connectDB();
	$conteo = 0;
 
	foreach ($partidos as $partido ) {
	   
	   $query      = "DELETE FROM partidos WHERE id= '".$partido."'";
	   $result     = mysqli_query($connection, $query);
		  
	   if ($result) {
		  $conteo++;
	   } 
	   
	}
 
	if ( count($partidos) != $conteo) {
	   $respuesta = 'error-borrado-partidos';
	} else {
	   $respuesta = 'ok';
	}
 
	//cierre base de datos
	mysqli_close($connection);
	return $respuesta;
 }

 /*
 * Borra la zona desde las ligas usa deletezona()
 * pero ademas debe eliminar la zona borrada de la liga para que no entre en conflicto
*/

function borrarZonaFromLiga( $zonaId ) {
	$zonas = array($zonaId);
	
	//se toma los datos de la zona antes de borrarla
	$dataZona = getPostsFromDeportesById( $zonaId, 'zonas' );
	
	
	$zonasBorradas = deleteZona($zonaId);
	
	//si la zona fue borrada se elimina de la liga
	if ( $zonasBorradas == 'ok' ) {

		$liga = getPostsFromDeportesById( $dataZona['liga_id'], 'liga' );

		//$nuevaZonasId = str_replace($zonaId.',', '', $liga['zonas_id']);

		$nuevaZonasId = explode(',', $liga['zonas_id']);

		if ( ($clave = array_search($zonaId, $nuevaZonasId)) !== false ) {
			unset($nuevaZonasId[$clave]);
		}

		$nuevaZonasId = implode(',', $nuevaZonasId);
		
		$connection = connectDB();
		$query = "UPDATE liga SET zonas_id='".$nuevaZonasId."' WHERE id='".$dataZona['liga_id']."' LIMIT 1";

		$updatePost = mysqli_query($connection, $query); 
		if (! $updatePost) {
			$respuesta = 'error-update-liga';
		} else {
			$respuesta = 'ok';
		}

		mysqli_close($connection);
	
	} else {

		$respuesta = 'error-borrando-zona';

	}
	
	//cierre base de datos
	
	return $respuesta;
	
}//borrarZonaFromLiga()


/*
 * borra un equipo y sus jugadores
 * ademas borra el equipo de la zona
*/
function deleteEquipo( $equipo_id ) {
    $dataEquipo =  getPostsFromDeportesById( $equipo_id, 'equipos' );

    //borrar el equipo en la zona
    $zona = getPostsFromDeportesById( $dataEquipo['zona_id'], 'zonas' );

    $nuevosEquipos = explode(',', $zona['equipos_ids']);
    
    if ( ($clave = array_search($equipo_id, $nuevosEquipos)) !== false ) {
        unset($nuevosEquipos[$clave]);
    }
    
    $nuevosEquipos = implode(',', $nuevosEquipos);

    $connection = connectDB();
    $query = "UPDATE zonas SET equipos_ids='".$nuevosEquipos."' WHERE id='".$dataEquipo['zona_id']."' LIMIT 1";

    $updateZona = mysqli_query($connection, $query); 
    if (! $updateZona) {
        $respuesta = 'error-update-zona';
    } 
    //borrar jugadores
    $jugadores = explode(',', $dataEquipo['jugadores_id']);
    $respuesta = deleteJugador( $jugadores, false );
    
    //borrar equipo
    $connection    = connectDB();
    $query = "DELETE FROM equipos WHERE id= '".$equipo_id."'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $respuesta = 'ok';
    } else {
        $respuesta = 'error-borrando-equipo';
    }

    mysqli_close($connection);
    return $respuesta;
}//deleteequipo()


/*
 * crea o actualiza un jugador
*/
function editJugador( $equipoId, $dataJugador ) {
    $connection    = connectDB();
    $tabla         = 'jugadores';
    $id            = isset( $dataJugador['id'] ) ? $dataJugador['id'] : '';
    $nombre        = isset( $dataJugador['nombre'] ) ? $dataJugador['nombre'] : '';
    $imagen        = isset( $dataJugador['imagen'] ) ? $dataJugador['imagen'] : '';
    
    $nombre   = mysqli_real_escape_string($connection, $nombre);
    $nombre   = filter_var($nombre,FILTER_SANITIZE_STRING);

    if ( $nombre == '' ) {
        $nombre = 'Escribir nombre';
    }

    //crea una nueva zona
    if ($id == '' ) {
        
        $query = "INSERT INTO $tabla (nombre,imagen,equipo_id) VALUES ('$nombre', '$imagen','$equipoId')";

        $nueva = mysqli_query($connection, $query); 
        $respuesta = mysqli_insert_id($connection);

    } else {
        //actualiza zona existente
        $query = "UPDATE ".$tabla." SET nombre='".$nombre."',imagen='".$imagen."', equipo_id='".$equipoId."' WHERE id='".$id."' LIMIT 1";

        $update = mysqli_query($connection, $query); 
        if ($update) {
            $respuesta = 'updated';
        } else {
            $respuesta = 'error';
        }
    }
    
    mysqli_close($connection);

    return $respuesta;
}//editJugador()



/*
 * guarda un equipo en una liga
*/
function saveJugadorOnEquipo( $equipo_id, $jugadorId ) {
    $connection    = connectDB();
	$tabla         = 'equipos';

	//recupera datos de liga
	$OlddataEquipos = getPostsFromDeportesById( $equipo_id, $tabla );

	//recupera zonas id
	$jugadores = $OlddataEquipos['jugadores_id'];
    if ( $jugadores == '' ) {
        $jugadores = $jugadorId;
    } else {
        $jugadores .= ',' . $jugadorId;
    }

	
	$query = "UPDATE ".$tabla." SET jugadores_id='".$jugadores."' WHERE id='".$equipo_id."' LIMIT 1";

	$updatePost = mysqli_query($connection, $query); 
	if ($updatePost) {
		$respuesta = 'updated';
	} else {
		$respuesta = 'error';
	}

	mysqli_close($connection);
	return $respuesta;
}//saveJugadorOnEquipo()


/*
 * ESTA FUNCION BORRA LOS JUGADORES Y ADEMAS LOS BORRA DEL EQUIPO
 * A NO SER QUE SE ESPECIFIQUE LA SEGUNDA VARIABLE COMO FALSE, EN ESE CASO LO DEJA EN EL EQUIPO, ESTO FUNCIONA SI SE BORRA DIRECTAMENTE EL EQUIPO, PARA NO HACER PASOS DE MAS
*/
function deleteJugador( $jugadores, $borrarenequipo = true ) {
	$connection = connectDB();
 
	if ( ! is_array($jugadores) ) {
		$jugadores = array( $jugadores );
	}

	foreach ($jugadores as $jugador ) {
	   //se recuperan los datos de la zona
	   $dataJugador = getPostsFromDeportesById( $jugador, 'jugadores' );
	   $equipo = $dataJugador['equipo_id'];
	   
	   $query      = "DELETE FROM jugadores WHERE id= '".$jugador."'";
	   $result     = mysqli_query($connection, $query);
		  
	   if ( $result ) {
            if ( $borrarenequipo ) {
                //si tuvo resultado, ahora se borra del equipo
                $respuesta = deleteJugadorFromEquipo($equipo, $jugador);
            } else {
                $respuesta = 'ok';
            }
            

	   } else {
            $respuesta = 'error-borrando-jugador';
       }
	   
	}
	
	//cierre base de datos
	mysqli_close($connection);
	return $respuesta;
 
 }//deleteJugador()


function deleteJugadorFromEquipo($equipo, $jugador) {
    $connection = connectDB();
    
    $dataEquipo = getPostsFromDeportesById( $equipo, 'equipos' );

    $nuevosJugadoresId = explode(',', $dataEquipo['jugadores_id']);
    
    if ( ($clave = array_search($jugador, $nuevosJugadoresId)) !== false ) {
        unset($nuevosJugadoresId[$clave]);
    }
    
    $nuevosJugadoresId = implode(',', $nuevosJugadoresId);

    $connection = connectDB();
    $query = "UPDATE equipos SET jugadores_id='".$nuevosJugadoresId."' WHERE id='".$equipo."' LIMIT 1";

    $updatePost = mysqli_query($connection, $query); 
    if (! $updatePost) {
        $respuesta = 'error-update-liga';
    } else {
        $respuesta = 'ok';
    }

    //cierre base de datos
	mysqli_close($connection);
    return $respuesta;
    
}//deleteJugadorFromEquipo()

/*
* elimina un equipo de una zona
*/
function eliminarEquipoFromZona($equipo, $zona) {
    $connection = connectDB();
    
    $dataZona = getPostsFromDeportesById( $zona, 'zonas' );

    $equipos = explode(',', $dataZona['equipos_ids']);
    
    if ( ($clave = array_search($equipo, $equipos)) !== false ) {
        unset($equipos[$clave]);
    }
    
    $equipos = implode(',', $equipos);

    $connection = connectDB();
    $query = "UPDATE zonas SET equipos_ids='".$equipos."' WHERE id='".$zona."' LIMIT 1";

    $updatePost = mysqli_query($connection, $query); 
    if (! $updatePost) {
        $respuesta = 'error-update-zona';
    } else {
        $respuesta = 'updated-zona';
    }

    //cierre base de datos
	mysqli_close($connection);
    return $respuesta;

}//eliminarEquipoFromZona()