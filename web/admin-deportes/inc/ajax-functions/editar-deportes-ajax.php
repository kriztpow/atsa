<?php
/*
 * editor
 * Since 3.0
 * Maneja el backend del editor de noticias, ya sea para una nueva noticia o editar alguna
*/

require_once('../functions.php');
load_module('deportes');
if ( isAjax() ) {
    
    $action = isset( $_POST['action'] ) ? $_POST['action'] : false;
    
    //var_dump($_POST);

    switch ($action) {
        /*
         * Guarda el formulario de editar liga con todos los cambios
        */
        case 'editar-liga':
        
            echo editarLiga($_POST);

        break;

        /*
         * guarda la zona
        */
        case 'escribir-zona':
        
            $ligaId = isset($_POST['liga_id']) ? $_POST['liga_id'] : '';
            echo editZona( $ligaId, $_POST );

        break;

        /*
         * Agrega una zona a la liga
        */
        case 'nueva-zona':
        
            $ligaId = isset( $_POST['ligaId'] ) ? $_POST['ligaId'] : null;
            if ( $ligaId !=  null ) {
                $dataZona = null;
                $zonaId = editZona( $ligaId, $dataZona);
                $respuesta = array(
                    'msj' => '',
                    'error' => '',
                    'html' => '',
                );

                //una vez creada la zona, hay que editar la liga para que se guarde la zona
                if ( $zonaId > 0 ) {
                    $zonaGuardada = saveZonaOnLiga( $ligaId, $zonaId );

                    //si se guardó, se muestra el template
                    if ($zonaGuardada == 'updated') {

                        //agrega la zona al template
                        $dataZona =  getPostsFromDeportesById( $zonaId, 'zonas' );
                        ob_start();
                        getTemplate('loop-zona', $dataZona);
                        $respuesta['html'] = ob_get_contents();
                        ob_end_clean();
                        $respuesta['msj'] = $zonaId;
                    } else {
                        //como la zona no se pudo grabar en la liga, entonces se borra la zona para no provocar errores
                        $zonas = array( $zonaId );
                        deleteZona( $zonas );
                    }
                    

                } else {
                    $respuesta['error'] = 'hubo un error, no se pudo crear la zona';
                }
            } else {
                $respuesta['error'] = 'hubo un error, falta liga id';
            }

            echo json_encode($respuesta);
            
        break;
        
        /*
         * nuevo jugador
        */
        case 'nuevo-jugador':
            
            $equipo_id = isset( $_POST['equipo_id'] ) ? $_POST['equipo_id'] : null;
            
            if ( $equipo_id !=  null ) {
                $dataJugador = null;
                $jugadorId = editJugador( $equipo_id, $dataJugador);
                $respuesta = array(
                    'msj' => '',
                    'error' => '',
                    'html' => '',
                );

                //una vez cread el jugador, hay que editar el equipo para que se guarde el jugador en ese equipo
                if ( $jugadorId > 0 ) {
                    //$zonaGuardada = saveZonaOnLiga( $equipo_id, $jugadorId );
                    $equipoGuardado = saveJugadorOnEquipo( $equipo_id, $jugadorId );

                    //si se guardó, se muestra el template
                    if ( $equipoGuardado == 'updated' ) {

                        //agrega el jugador al template
                        $dataJugador =  getPostsFromDeportesById( $jugadorId, 'jugadores' );
                        ob_start();
                        getTemplate('loop-jugadores', $dataJugador);
                        $respuesta['html'] = ob_get_contents();
                        ob_end_clean();
                        $respuesta['msj'] = $jugadorId;

                    } else {

                        //como la zona no se pudo grabar en la liga, entonces se borra el jugador para no provocar errores
                        
                        deleteJugador( $jugadorId );

                        $respuesta['error'] = 'hubo un error, no se pudo crear el jugador';
                    }
                    

                } else {
                    $respuesta['error'] = 'hubo un error, no se pudo crear el jugador';
                }
            } else {
                $respuesta['error'] = 'hubo un error, falta equipo id';
            }

            echo json_encode($respuesta);
        break;

        /*
         * edita jugador
        */
        case 'escribir-jugador':
            $equipo_id = isset( $_POST['equipo'] ) ? $_POST['equipo'] : null;
            
            echo editJugador( $equipo_id, $_POST);
            
        break;

        /*
         * guardar equipo
        */
        case 'editar-equipo':
        
            echo editarEquipo($_POST);

        break;

        /*
         * elimina el equipo de una zona
        */
        case 'borrar-zona-de-equipo':
            
            $equipo = isset( $_POST['equipo'] ) ? $_POST['equipo'] : null;
            $zona = isset( $_POST['zona'] ) ? $_POST['zona'] : null;

            echo eliminarEquipoFromZona($equipo, $zona);

        break;

        /*
         * crea o actualiza un partido
        */
        case 'editar-partido':

            echo editarPartido( $_POST );

        break;

        case 'load-data-partido':

            $tipo = isset( $_POST['tipo'] ) ? $_POST['tipo'] : null;
            $id = isset( $_POST['id'] ) ? $_POST['id'] : null;

            if ( $tipo != null && $id != null ) {

                $respuesta['error'] = 'ok';

                //si el tipo es de gol jugador, hay que crear un nuevo gol con ese jugador
                if ($tipo == 'gol-jugador') {
                    $partidoId = isset( $_POST['partidoId'] ) ? $_POST['partidoId'] : null;
                    
                    $respuesta['gol'] = newGoal( $id, $partidoId );

                    if ($respuesta['gol'] == 'error') {
                        $respuesta['error'] = 'No se pudo crear el gol';        

                        echo json_encode($respuesta);

                        return;
                    }

                }

                //si el tipo es de amonestaciones hay que crear la nueva amonestaciones con ese jugador
                if ( $tipo == 'amonestaciones' ) {
                    $partidoId = isset( $_POST['partidoId'] ) ? $_POST['partidoId'] : null;
                    
                    //en el $id viene el id_tipodefalta
                    $dataFalta = explode('_', $id);
                    $respuesta['falta'] = nuevaAmonestacion( $dataFalta[0], $dataFalta[1], $partidoId );

                    if ($respuesta['falta'] == 'error') {
                        $respuesta['error'] = 'No se pudo crear la amonestación';        

                        echo json_encode($respuesta);

                        return;
                    }
                }

                //siempre se busca la data extra para devolver
                $respuesta['data'] = getDataExtraPartido( $tipo, $id );

            } else {
                $respuesta['error'] = 'Faltan datos para realizar request';
            }

            echo json_encode($respuesta);

        break;
        
        
    }//switch ajax
    
} //if not ajax
else {
	exit;
}