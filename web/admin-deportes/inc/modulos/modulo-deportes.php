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
        $query  .= " ORDER by ".$orden;
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
 * obtiene lista de partidos
*/
function getPartidos($filtro = null, $orden = null) {
    $tabla = 'partidos';

    $partidos = getPostsFromDeportes( $tabla, null, $filtro, $orden );
    return $partidos;
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


/*
 * borrar partido
*/
function deletePartido( $partidoId ) {
    $respuesta = array( 'status'=> 'error', 'contenido' => '', 'goles' => '', 'amonestaciones' => '', 'zonas' => '' );
    //data del partido
    $dataPartido = getPostsFromDeportesById( $partidoId, 'partidos' );

    //borrar contenido si lo tiene
    if ( $dataPartido['contenido_id'] != '' ) {
        $respuesta['contenido'] = deleteContenido( $dataPartido['contenido_id'] );
    }

    //borrar equipo en goles
    if ( $dataPartido['goles_id1'] != '' || $dataPartido['goles_id2'] != '' ) {
        $goles1 = explode(',', $dataPartido['goles_id1'] );
        $goles2 = explode(',', $dataPartido['goles_id2'] );
        $goles = array_merge ($goles1, $goles2);
        $respuesta['goles'] = deleteGoles($goles);
    }

    //borrar equipo en amonestaciones
    if ( $dataPartido['amonestaciones_id1'] != '' || $dataPartido['amonestaciones_id2'] != '' ) {
        $amonestaciones1 = explode(',', $dataPartido['amonestaciones_id1'] );
        $amonestaciones2 = explode(',', $dataPartido['amonestaciones_id2'] );
        $amonestaciones = array_merge ($amonestaciones1, $amonestaciones2);
        $respuesta['amonestaciones'] = deleteAmonestaciones($amonestaciones);
    }

    //borrar partido en zonas
    if ( $dataPartido['zona_id'] != '' ) {
        $respuesta['zonas'] = deletePartidoEnZona( $partidoId, $dataPartido['zona_id'] );
    }

    //si lo anterior esta bien, entonces borran el partido
    if ( $respuesta['contenido'] != 'error' && $respuesta['goles'] != '0'  && $respuesta['amonestaciones'] != '0' && $respuesta['zonas'] != 'error-update-zona'  ) {

        //borrar partido
        $connection = connectDB();
        $query      = "DELETE FROM partidos WHERE id= '".$partidoId."'";
        $result     = mysqli_query($connection, $query);
            
        if ( $result ) {
            $respuesta['status'] = 'ok';
        }

         //cierre base de datos
	    mysqli_close($connection);
    }
   
    return $respuesta;

}//deletePartido()


/*
 * borrar contenido
 */
function deleteContenido( $contenido_id ) {
    $respuesta = 'error';
    $connection = connectDB();
    //borrar partido
    $query      = "DELETE FROM posts WHERE post_ID= '".$contenido_id."'";
	$result     = mysqli_query($connection, $query);
		  
    if ( $result ) {
        $respuesta = 'ok';
    } 

    //cierre base de datos
	mysqli_close($connection);
    return $respuesta;

}//deleteContenido()

/*
 * borra todos los goles pasadas en un array
*/
function deleteGoles( $goles ) {
    $connection = connectDB();

    if ( ! is_array($goles) ) {
        $goles = array($goles);
    }

    $count = 0;
    foreach ( $goles as $gol ) {
        $query = "DELETE FROM goles WHERE id= '".$gol."'";
        $result = mysqli_query($connection, $query);
        if ( $result ) {
            $count++;
        } 
    }

    //cierre base de datos
	mysqli_close($connection);
    return $count;

}//deleteGoles()

/*
 * borra todas las amonestaciones pasadas en un array
*/
function deleteAmonestaciones( $amonestaciones ) {
    $connection = connectDB();

    if ( ! is_array($amonestaciones) ) {
        $amonestaciones = array($amonestaciones);
    }

    $count = 0;
    foreach ( $amonestaciones as $amonestacion ) {
        $query = "DELETE FROM amonestaciones WHERE id= '".$amonestacion."'";
        $result = mysqli_query($connection, $query);
        if ( $result ) {
            $count++;
        }
    }

    //cierre base de datos
	mysqli_close($connection);
    return $count;

}//deleteAmonestaciones


/*
 * borra los partidos id de una zona
*/
function deletePartidoEnZona( $partidoId, $zona_id ) {

    $zona = getPostsFromDeportesById( $zona_id, 'zonas' );

    $partidos = explode(',', $zona['partidos_ids']);

    if ( ($clave = array_search($partidoId, $partidos)) !== false ) {
        unset($partidos[$clave]);
    }

    $partidos = implode(',', $partidos);
    
    $connection = connectDB();
    $query = "UPDATE zonas SET partidos_ids='".$partidos."' WHERE id='".$zona_id."' LIMIT 1";

    $updatePost = mysqli_query($connection, $query); 
    if (! $updatePost) {
        $respuesta = 'error-update-zona';
    } else {
        $respuesta = 'ok';
    }

    //cierre base de datos
	mysqli_close($connection);
    return $respuesta;

}//deletePartidoEnZona()


/*
* guarda el partido y la zona
*/
function editarPartido ($data) {

    //se toman los datos para variables
    $connection      = connectDB();
    $tabla           = 'partidos';
    $postID          = isset( $data['post_ID'] ) ? $data['post_ID'] : 'new';
    $deporteID       = isset( $data['post_categoria'] ) ? $data['post_categoria'] : '';
    $ligaID          = isset( $data['liga_id'] ) ? $data['liga_id'] : '';
    $zonaId          = isset( $data['zona_id'] ) ? $data['zona_id'] : '';
    $fecha           = isset( $data['fecha'] ) ? $data['fecha'] : '';
    $equipos         = isset( $data['equipos_id'] ) ? $data['equipos_id'] : '';
    $goles1          = isset( $data['goles1'] ) ? $data['goles1'] : '';
    $goles2          = isset( $data['goles2'] ) ? $data['goles2'] : '';
    $sets1           = isset( $data['sets1'] ) ? $data['sets1'] : '';
    $sets2           = isset( $data['sets2'] ) ? $data['sets2'] : '';
    $amonestaciones1 = isset( $data['amonestaciones1'] ) ? $data['amonestaciones1'] : '';
    $amonestaciones2 = isset( $data['amonestaciones2'] ) ? $data['amonestaciones2'] : '';
    $puntuacion      = isset( $data['puntuacion'] ) ? $data['puntuacion'] : '';
    $respuesta       = array();
    /*
    * GUARDAR POST
    */

    //es nuevo post
    
    if ($postID == 'new') {

        //sino se guarda
        $query = "INSERT INTO $tabla (deporte_id,liga_id,zona_id,fecha,equipos_id,goles_id1,goles_id2,sets1,sets2,amonestaciones_id1,amonestaciones_id2,puntuacion) VALUES ('$deporteID', '$ligaID', '$zonaId', '$fecha', '$equipos', '$goles1','$goles2','$sets1','$sets2', '$amonestaciones1','$amonestaciones2', '$puntuacion')";

        $nuevoPost = mysqli_query($connection, $query); 
        
        if ($nuevoPost) {
            $postID = mysqli_insert_id($connection);
            $respuesta['id'] = $postID;
            $respuesta['status'] = 'post-made';

            //actualizar zona
            $respuesta['zona'] = updatePartidoInZona( $postID,$zonaId );

        } else  {
            $respuesta['error'] = 'error-saving-partido'; 
            $respuesta['status'] = 'error';  
        }
        

    } //es viejo post
        else {

        $query = "UPDATE ".$tabla." SET deporte_id='".$deporteID."',liga_id='".$ligaID."',zona_id='".$zonaId."',fecha='".$fecha."',equipos_id='".$equipos."',goles_id1='".$goles1."',goles_id2='".$goles2."',sets1='".$sets1."',sets2='".$sets2."',amonestaciones_id1='".$amonestaciones1."',amonestaciones_id2='".$amonestaciones2."',puntuacion='".$puntuacion."' WHERE id='".$postID."' LIMIT 1";

        $updatePost = mysqli_query($connection, $query); 
        if ($updatePost) {
            $respuesta['id'] = $postID;
            $respuesta['status'] = 'updated';
            //actualizar zona
            $respuesta['zona'] = updatePartidoInZona( $postID,$zonaId );

        } else {

            $respuesta['status'] = 'error';
            $respuesta['error'] = 'error-updated';

        }	
    }

    //cierre base de datos
    mysqli_close($connection);

    return json_encode( $respuesta );

}//editarPartido();


/*
 * actualiza la zona para que el partido quede registrado ahí
*/
function updatePartidoInZona($partidoId, $zonaId) {
    $connection     = connectDB();
    $tabla          = 'zonas';

    $zona = getPostsFromDeportesById( $zonaId, 'zonas');

    if ( $zona['partidos_ids'] == '' ) {
        $query = "UPDATE zonas SET partidos_ids='".$partidoId."' WHERE id='".$zona['id']."' LIMIT 1";
            
            $updateZona = mysqli_query($connection, $query); 
            if ($updateZona) {
                
                $respuesta = 'zona-saved';
                
            } else {
                $respuesta = 'error-zona';
            }

    } else {
        
        $partidos_ids = explode(',', $zona['partidos_ids'] );

        if ( ($clave = array_search($partidoId, $partidos_ids)) === false ) {

            array_push($partidos_ids, $partidoId);

            $partidos_ids = implode(',', $partidos_ids);

            $query = "UPDATE zonas SET partidos_ids='".$partidos_ids."' WHERE id='".$zona['id']."' LIMIT 1";
            
            $updateZona = mysqli_query($connection, $query); 
            if ($updateZona) {
                
                $respuesta = 'zona-updated';
                
            } else {
                $respuesta = 'error-zona';
            }

        } else {
            $respuesta = 'already-in-zona';
        }

    }

    mysqli_close($connection);
    
    return $respuesta;

}//updatePartidoInZona()


/*
* recupera datos extras editando el partido como por ejemplo, jugadores, equipos, etc
*/
function getDataExtraPartido( $tipo, $id ) {
    
    switch ($tipo) {
        case 'equipo':
            $tabla = 'equipos';
        break;

        case 'gol-jugador':
            $tabla = 'jugadores';
        break;

        case 'amonestaciones':
            $tabla = 'jugadores';
        break;
    }

    $respuesta = getPostsFromDeportesById( $id, $tabla );

    return $respuesta;
}//getDataExtraPartido


/*
* ESTA FUNCION CREA UN NUEVO GOL
* con el id del jugador busca todos los datos que necesita:
* equipo, partido, jugador, deporte, liga, zona
* devuelve el id del gol
*/
function newGoal( $jugadorId, $partidoId ) {
    $connection     = connectDB();
    $tabla          = 'goles';

    $jugador = getPostsFromDeportesById( $jugadorId, 'jugadores' );
    $equipo = getPostsFromDeportesById( $jugador['equipo_id'], 'equipos' );
    $deporte = $equipo['deporte_id'];
    $liga = $equipo['liga_id'];
    $zona = $equipo['zona_id'];
    
    $equipoId = $equipo['id'];

    $query = "INSERT INTO $tabla (equipo_id,partido_id,jugador_id,deporte_id,liga_id,zona_id) VALUES ('$equipoId', '$partidoId', '$jugadorId', '$deporte', '$liga', '$zona')";

    $nuevoPost = mysqli_query($connection, $query); 
    
    if ($nuevoPost) {
        $postID = mysqli_insert_id($connection);
        $respuesta = $postID;
    } else {
        $respuesta = 'error';
    }

    mysqli_close($connection);
    return $respuesta;

}//newGoal()

/*
* ESTA FUNCION CREA UNA NUEVA AMONESTACION
* con el id del jugador busca todos los datos que necesita:
* equipo, partido, jugador, deporte, liga, zona
* devuelve el id de la falta
*/
function nuevaAmonestacion( $jugadorId, $tipo, $partidoId ) {
    $connection     = connectDB();
    $tabla          = 'amonestaciones';
    
    $jugador = getPostsFromDeportesById( $jugadorId, 'jugadores' );
    $equipo = getPostsFromDeportesById( $jugador['equipo_id'], 'equipos' );
    $deporte = $equipo['deporte_id'];
    $liga = $equipo['liga_id'];
    $zona = $equipo['zona_id'];
    $tipo = $tipo;
    $equipoId = $equipo['id'];

    $query = "INSERT INTO $tabla (jugador_id,tipo,deporte_id,equipo_id,partido_id,liga_id,zona_id) VALUES ('$jugadorId',  '$tipo', '$deporte', '$equipoId', '$partidoId', '$liga', '$zona')";

    $nuevoPost = mysqli_query($connection, $query); 
    
    if ($nuevoPost) {
        $postID = mysqli_insert_id($connection);
        $respuesta = array('id'=>$postID, 'tipo' => $tipo );
    } else {
        $respuesta = 'error';
    }

    mysqli_close($connection);
    return $respuesta;
}//nuevaAmonestacion()

/*
 * borra los extra de los partidos, por ejemplo, goles, amonestaciones y contenido
*/
function deleteExtraPartido( $tipo, $id, $partido ) {
    $connection     = connectDB();
    $respuesta = '';

    $respuesta = deleteExtraEnPartido( $tipo, $partido, $id );

    if ( $respuesta == 'ok' ) {

        switch ($tipo) {
            case 'gol':
                
            $query = "DELETE FROM goles WHERE id= '".$id."'";
            $result = mysqli_query($connection, $query);

            if ( $result ) {
                $respuesta = 'ok';
            } else {
                $respuesta = 'error';
            }

            break;
            
            case 'amonestacion':

                $query = "DELETE FROM amonestaciones WHERE id= '".$id."'";
                $result = mysqli_query($connection, $query);

                if ( $result ) {
                    $respuesta = 'ok';
                } else {
                    $respuesta = 'error';
                }

            break;

            case 'contenido':
                
                $query = "DELETE FROM posts WHERE post_ID='".$id."'";
                $result = mysqli_query($connection, $query);
                
                if ( $result ) {
                    $respuesta = 'ok';
                    
                } else {
                    $respuesta = 'error';
                }

            break;

        }//switch
    
    } else {
        $respuesta = 'error-extra';
    }

    mysqli_close($connection);
    return $respuesta;
    
}//deleteExtraPartido()

/*
 * actualiza el partido para borrarle goles, amonestaciones y contenido
*/
function deleteExtraEnPartido( $tipo, $partidoId, $itemToDelete ) {
    $connection = connectDB();
    $partido = getPostsFromDeportesById( $partidoId, 'partidos' );

    switch ($tipo) {
        case 'gol':
            $extras1 = explode(',', $partido['goles_id1']);
            $extras2 = explode(',', $partido['goles_id2']);

            if ( ($clave = array_search($itemToDelete, $extras1)) !== false ) {
                unset($extras1[$clave]);
            }
    
            if ( ($clave = array_search($itemToDelete, $extras2)) !== false ) {
                unset($extras2[$clave]);
            }
    
            $extras1 = implode(',', $extras1);
            $extras2 = implode(',', $extras2);

            $query = "UPDATE partidos SET goles_id1='".$extras1."', goles_id2='".$extras2."' WHERE id='".$partidoId."' LIMIT 1";

        break;

        case 'amonestacion':
            $extras1 = explode(',', $partido['amonestaciones_id1']);
            $extras2 = explode(',', $partido['amonestaciones_id2']);

            if ( ($clave = array_search($itemToDelete, $extras1)) !== false ) {
                unset($extras1[$clave]);
            }
    
            if ( ($clave = array_search($itemToDelete, $extras2)) !== false ) {
                unset($extras2[$clave]);
            }
    
            $extras1 = implode(',', $extras1);
            $extras2 = implode(',', $extras2);

            $query = "UPDATE partidos SET amonestaciones_id1='".$extras1."', amonestaciones_id2='".$extras2."' WHERE id='".$partidoId."' LIMIT 1";

        break;

        case 'contenido':

            $query = "UPDATE partidos SET contenido_id='' WHERE id='".$partidoId."' LIMIT 1";

        break;
        
    }

    $updatePost = mysqli_query($connection, $query); 

    if ( ! $updatePost ) {
        $respuesta = 'error';
    } else {
        $respuesta = 'ok';
    }

    //cierre base de datos
	mysqli_close($connection);
    return $respuesta;

}//deletePartidoEnZona()

/*
 * ARMA LA LISTA DE POSICIONES DE ACUERDO A LA LIGA Y ZONA
 * es necesaria la liga, la zona es opcional
*/
function getPosiciones( $liga, $zona=null) {
    $connection = connectDB();
    $fechaHoy = date('Y-m-d');
    $respuesta = array( 'error'=> '', 'status' => 'ok', 'html' => '' );
    $deporte = 0;
    //1. buscar datos de zona y guardar cada zona en un array
    $zonas = array();
    if ( $zona != null ) {
        $zona = getPostsFromDeportesById( $zona, 'zonas' );
        $zonas[] = $zona;
    } else {
        $dataLiga = getPostsFromDeportesById( $liga, 'liga' );
        $zonasIds = explode(',', $dataLiga['zonas_id']);
        foreach ($zonasIds as $zonaId) {
            $zona = getPostsFromDeportesById( $zonaId, 'zonas' );
            if ( $zona != null ) {
                $zonas[] = $zona;
            }
        }
    }
    
    if ( empty($zonas) ) {
        $respuesta['status'] = 'error';
        $respuesta['error'] = 'error: no hay zonas';
        return $respuesta;
    }

    //se hace el bucle por zonas si hay una sola se hace una sola vez
    foreach ( $zonas as $zona ) {
        
        $equipos = array();
        
        //2. Buscar equipos de cada zona y armar un array de equipos
        $equiposIds = explode( ',', $zona['equipos_ids'] );
        foreach ($equiposIds as $id) {
            
            $equipo = getPostsFromDeportesById( $id, 'equipos' );
            if ( $equipo != null ) {
                //le agrego estos datos para sumarlos luego
                $equipo['pj'] = 0;
                $equipo['g'] = 0;
                $equipo['e'] = 0;
                $equipo['p'] = 0;
                $equipo['gf'] = 0;
                $equipo['gc'] = 0;
                $equipo['dg'] = 0;
                $equipo['puntos'] = 0;

                $equipos[] = $equipo;
            }

        }//for each de equipos
        
        if ( empty($equipos) ) {
            $respuesta['status'] = 'error';
            $respuesta['error'] = 'error: no hay equipos';
            return $respuesta;
        }

        //3. Buscar partidos y contrastarlos con equipos para agregarle los datos puntaje
        $partidos = explode( ',', $zona['partidos_ids'] );

        if ( empty($partidos) ) {
            $respuesta['status'] = 'error';
            $respuesta['error'] = 'error: no hay partidos';
            return $respuesta;
        }

        foreach ( $partidos as $partido ) {
            
            //data partido
            $partido = getPostsFromDeportesById( $partido, 'partidos' );
            
            //si la fecha es mayor, entonces toma en cuenta el partido porque ya se ha jugado
        
            if ($fechaHoy > $partido['fecha'] ) {
                
                $deporte = $partido['deporte_id'];
            
                //1. busca los equipos participantes
                $equiposParticipantes = explode(',', $partido['equipos_id']);
                $equipo1['id'] = $equiposParticipantes[0];
                $equipo2['id'] = $equiposParticipantes[1];
                
                //2. en los equipos solo va a buscar los goles y con esto se arma toda la tabla

                //si está la puntuacion se anulan los goles
                if ( $partido['puntuacion'] != '' ) {
                    $puntuacion = explode(',', $partido['puntuacion']);
                    $equipo1['goles'] = (int)$puntuacion[0];
                    $equipo2['goles'] = (int)$puntuacion[1];

                } else {
                    //sino esta la puntuacion se cuentan goles y sets

                    if ( $deporte == '3' ) {
                        //si el deporte es voley entonces se miran los sets
                        $equipo1['sets'] = $partido['sets1'];
                        $equipo2['sets'] = $partido['sets2'];
                    
                    } else {
                        //si deporte no es voley entonces se computa como futbol
                        //equipo1
                        if ( $partido['goles_id1'] == '' ) {
                            $equipo1['goles'] = 0;
                        } else {
                            //cuenta los goles
                            $equipo1['goles'] = count( explode(',', $partido['goles_id1'] ) );
                        }
                        //equipo2
                        if ( $partido['goles_id2'] == '' ) {
                            $equipo2['goles'] = 0;
                        } else {
                            //cuenta los goles
                            $equipo2['goles'] = count( explode(',', $partido['goles_id2'] ) );
                        }

                    } 
                    
                }
                
                //3. ahora que estan los datos tomados del partido se procesa la informacion y se lo carga al array de los $equipos
                if ( $deporte == '3' ) {
                    $equipos = asignarpuntosaequipos( $equipos,  $equipo1, $equipo2, 'voley' );
                } else {
                    $equipos = asignarpuntosaequipos( $equipos,  $equipo1, $equipo2 );
                }

            }//if fecha
        }//foreach partidos
        
        $equiposOrdenados = ordenarEquipos($equipos);

        //4. arma el html de la zona y lo guarda en la respuesta pasa el array con los equipos ya ordenados por puntos
        $dataHtml = array( 'equipos' => $equiposOrdenados, 'zona'=> $zona, 'deporte'=> $deporte );

        ob_start();
        getTemplate('tabla-posiciones-zona', $dataHtml);
        $respuesta['html'] .= ob_get_contents();
        ob_end_clean();

    }//foreach de zonas
    
    
    mysqli_close($connection);
    return $respuesta;
}

/*
 * con los goles de cada equipo procesa la data de la tabla
 * esta funcion es para el futbol
*/
function getPuntosTablaData( $equipo1, $equipo2, $deporte=null ) {
    //arma la variable a devolver

    $puntos = array( array('pj'=> 1), array('pj'=> 1));
    
    //se define quien gano y los puntos
    if ( (int)$equipo1['goles'] > (int)$equipo2['goles'] ) {
        //si gano equipo1: (los goles o los sets son iguales en todos los deportes)
        $puntos[0]['g'] = 1;
        $puntos[1]['g'] = 0;
        $puntos[0]['p'] = 0;
        $puntos[1]['p'] = 1;
        $puntos[0]['e'] = 0;
        $puntos[1]['e'] = 0;
        
        //se definen los goles
        $puntos[0]['gf'] = $equipo1['goles'];
        $puntos[0]['gc'] = $equipo2['goles'];
        $puntos[0]['dg'] = $equipo1['goles'] - $equipo2['goles'];

        $puntos[1]['gf'] = $equipo2['goles'];
        $puntos[1]['gc'] = $equipo1['goles'];
        $puntos[1]['dg'] = $equipo1['goles'] - $equipo2['goles'];

        //deporte futbol puntos
        $puntos[0]['puntos'] = 3;
        $puntos[1]['puntos'] = 0;

    } elseif ( (int)$equipo1['goles'] < (int)$equipo2['goles'] ) {
        //si gano equipo2 (los goles o los sets son iguales en todos los deportes)
        $puntos[0]['g'] = 0;
        $puntos[1]['g'] = 1;
        $puntos[0]['p'] = 1;
        $puntos[1]['p'] = 0;
        $puntos[0]['e'] = 0;
        $puntos[1]['e'] = 0;

        //se definen los goles
        $puntos[0]['gf'] = $equipo1['goles'];
        $puntos[0]['gc'] = $equipo2['goles'];
        $puntos[0]['dg'] = $equipo2['goles'] - $equipo1['goles'];

        $puntos[1]['gf'] = $equipo2['goles'];
        $puntos[1]['gc'] = $equipo1['goles'];
        $puntos[1]['dg'] = $equipo2['goles'] - $equipo1['goles'];

        $puntos[0]['puntos'] = 0;
        $puntos[1]['puntos'] = 3;

    } else {
        //si empataron
        $puntos[0]['g'] = 0;
        $puntos[1]['g'] = 0;
        $puntos[0]['p'] = 0;
        $puntos[1]['p'] = 0;
        $puntos[0]['e'] = 1;
        $puntos[1]['e'] = 1;
        //ademas define los puntos
        $puntos[0]['puntos'] = 1;
        $puntos[1]['puntos'] = 1;

        //y los goles
        $puntos[0]['gf'] = $equipo1['goles'];
        $puntos[0]['gc'] = $equipo2['goles'];
        $puntos[0]['dg'] = $equipo1['goles'] - $equipo2['goles'];

        $puntos[1]['gf'] = $equipo2['goles'];
        $puntos[1]['gc'] = $equipo1['goles'];
        $puntos[1]['dg'] = $equipo2['goles'] - $equipo1['goles'];
    }

    return $puntos;
}


/*
 * con los goles de cada equipo procesa la data de la tabla
 * esta funcion es la misma de arriba pero esta es para el voley que es distinto
*/
function getPuntosTablaDataVoley( $equipo1, $equipo2, $deporte=null ) {
    //arma la variable a devolver
    $puntos = array( array('pj'=> 1), array('pj'=> 1));
    $cantidadsets = 3;

    if ( $equipo1['sets'] == '' ) {
        $sets1 = array(0,0,0);
    } else {
        $sets1 = explode(',', $equipo1['sets'] );
    }
    if ( $equipo2['sets'] == '' ) {
        $sets2 = array(0,0,0);
    } else {
        $sets2 = explode(',', $equipo2['sets'] );
    }

    $score1 = 0;
    $score2 = 0;
    $suma1 = 0;
    $suma2 = 0;

    for ($i=0; $i < $cantidadsets; $i++) {

        if ( (int)$sets1[$i] > (int)$sets2[$i] ) {
            $score1 = $score1 + 1;
        } elseif ( (int)$sets1[$i] < (int)$sets2[$i] ) {
            $score2 = $score2 + 1;
        }

        $suma1 = $suma1 + $sets1[$i];
        $suma2 = $suma2 + $sets2[$i];
    }

    //las variables internas son las mismas que en futbol, solo cambia la nomenclatura que se ve
    if ( $score1 > $score2 ) {
        $puntos[0]['g'] = 1;
        $puntos[0]['p'] = 0;
        $puntos[1]['g'] = 0;
        $puntos[1]['p'] = 1;
    } else {
        $puntos[1]['g'] = 1;
        $puntos[1]['p'] = 0;
        $puntos[0]['g'] = 0;
        $puntos[0]['p'] = 1;
    }
    //no se puede empatar en voley así que siempre es igual
    $puntos[0]['e'] = 0;
    $puntos[1]['e'] = 0;
    //se definen los goles
    $puntos[0]['gf'] = $suma1;
    $puntos[0]['gc'] = $suma2;
    $puntos[0]['dg'] = $suma1 - $suma2;

    $puntos[1]['gf'] = $suma2;
    $puntos[1]['gc'] = $suma1;
    $puntos[1]['dg'] = $suma2 - $suma1;

    //los puntos se toman como ganados 3, perdidos: si ganaron un set 1, si perdieron todos 0
    if ( $score1 > $score2 ) {
        $puntos[0]['puntos'] = 3;
    } else {
        if ($score1 > 0 ) {
            $puntos[0]['puntos'] = 1;
        } else {
            $puntos[0]['puntos'] = 0;
        }
    }

    if ( $score2 > $score1 ) {
        $puntos[1]['puntos'] = 3;
    } else {
        if ($score2 > 0 ) {
            $puntos[1]['puntos'] = 1;
        } else {
            $puntos[1]['puntos'] = 0;
        }
    }
    
    return $puntos;
}


/*
 *  Esta funcion ordena los equipos
 * recibe un array de equipos ya con los puntos, goles y estadísticas
 * * los datos del voley se toman distintos pero todos los de futbol funciona igual
*/
function ordenarEquipos( $equipos, $deporte=null ) {

    //1.ordena por puntos
    $puntos = array();
    foreach ($equipos as $key => $row)
    {
        $puntos[$key] = $row['puntos'];
        
    }

    array_multisort($puntos, SORT_DESC, $equipos);

    return $equipos;
}

/*
* esta funcion asigna a una array de equipo nuevos datos que serían los puntos
* internamente procesa los datos de equipo1 y equipo2 con una funcion para adquirir los puntos que asignarles a los equipos
*/
function asignarpuntosaequipos( $equipos, $equipo1, $equipo2, $deporte=null ){
    $equiposConPuntos = array();

    //procesamos la info
    if ( $deporte == 'voley' ) {
        //si es voley
        $puntos = getPuntosTablaDataVoley( $equipo1, $equipo2, $deporte);
    } else {
        $puntos = getPuntosTablaData( $equipo1, $equipo2, $deporte);
    }
    
    foreach ($equipos as $equipo) {
        //si el id de un equipo coincide con el dewl partido le agrega los datos
        
        if ( $equipo['id'] == $equipo1['id'] ) {
                
            $equipo['pj'] += $puntos[0]['pj'];
            $equipo['g'] += $puntos[0]['g'];
            $equipo['e'] +=  $puntos[0]['e'];
            $equipo['p'] +=  $puntos[0]['p'];
            $equipo['gf'] +=  $puntos[0]['gf'];
            $equipo['gc'] +=  $puntos[0]['gc'];
            $equipo['dg'] += $puntos[0]['dg'];
            $equipo['puntos'] +=  $puntos[0]['puntos'];

        }

        if ( $equipo['id'] == $equipo2['id'] ) {
            
            $equipo['pj'] += $puntos[1]['pj'];
            $equipo['g'] += $puntos[1]['g'];
            $equipo['e'] +=  $puntos[1]['e'];
            $equipo['p'] +=  $puntos[1]['p'];
            $equipo['gf'] +=  $puntos[1]['gf'];
            $equipo['gc'] +=  $puntos[1]['gc'];
            $equipo['dg'] += $puntos[1]['dg'];
            $equipo['puntos'] +=  $puntos[1]['puntos'];
        }

        array_push($equiposConPuntos, $equipo);

    }//foreach equipos para asignarles data

    return $equiposConPuntos;
}

/*
 esta funcion muestra los puntos del voley en el loop de equipos cuando se ven los partidos
*/
function getScoreVoley($data1, $data2) {
    $puntos = array(0,0);

    if ( $data1 == '' ) {
        $puntos[0] = 0;    
    }

    if ( $data2 == '' ) {
        $puntos[1] = 0;    
    } 
    
    if ( $data1 != '' && $data2 != '' ) {
        $data1 = explode(',', $data1);
        $data2 = explode(',', $data2);

        $recorrido = count($data1);
        if (count($data1) < count($data2)) {
            $recorrido = count($data2);
        }
            
        for ($i = 0; $i < $recorrido; $i++) {
            
            if ( ! isset($data1[$i]) ){
                $data1[$i] = 0;
            }
            if ( ! isset($data2[$i]) ){
                $data2[$i] = 0;
            }

            if ( (int)$data1[$i] < (int)$data2[$i] ) {
                $puntos[1]++;
            }
            if ( (int)$data1[$i] > (int)$data2[$i] ) {
                $puntos[0]++;
            }
            
        }
    }

    return $puntos;
}

function getScoreFutbol ($goles1, $goles2) {
    $goles = array();

    if ( $goles1 == '' ) {
        $goles[0] = '0';    
    } else {
        $goles1 = explode(',', $goles1);
        $goles[0] = count($goles1);
    }
    
    if ( $goles2 == '' ) {
        $goles[1] = '0';    
    } else {
        $goles2 = explode(',', $goles2);
        $goles[1] = count($goles2);
    }

    return $goles;
}