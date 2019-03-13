<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * DEPORTES AJAX
 * maneja todo lo vinculado a deportes por ajax, busca info y selecciona los templates
*/
require '../config.php';
require '../functions.php';

$funcionAjax = isset($_POST['funcionAjax']) ? $_POST['funcionAjax'] : null;

//chequea si es peticion de ajax y ejecuta la funcion
if( isAjax() || $funcionAjax != null ) :    

    switch ($funcionAjax) {
        case 'contenido-macro':
            $liga = isset($_POST['liga']) ? $_POST['liga'] : '';
            $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
            
            getContent($contenido, $liga);

        break;

        case 'contenido-zona' :
        
            $liga = isset($_POST['liga']) ? $_POST['liga'] : '';
            $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
            $zona = isset($_POST['variables']) ? $_POST['variables'] : '';
            
            $variables = array('zona'=> $zona);

            getContent($contenido, $liga, $variables);
        break;

        case 'estadisticas-equipo':
            
            $liga = isset($_POST['liga']) ? $_POST['liga'] : '';
            $equipo = isset($_POST['equipo']) ? $_POST['equipo'] : '';
            $zona = isset($_POST['zona']) ? $_POST['zona'] : '';

            $respuesta = getInfoEquipos( $equipo, $zona, $liga );

            echo json_encode( $respuesta );

        break;

        case 'resumen-partido' :
        
            $contenido = isset($_POST['contenido_id']) ? $_POST['contenido_id'] : '';
            $respuesta = array('status'=> 'ok', 'error'=> '');
            if ($contenido != '') {
                $post = getContenidoFromPosts($contenido);

                if ($post != null) {
                    ob_start(); 

                    getTemplate('resumen-partido', $post);

                    $respuesta['html'] = ob_get_contents();
                    ob_end_clean();

                } else {
                    $respuesta['status'] = 'error';
                    $respuesta['error'] = 'No se encontró el contenido';
                }

                echo json_encode( $respuesta );
            }
        break;

        case 'cambiar-fecha':

            $pageActual = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 2;
            $liga = isset($_POST['liga']) ? $_POST['liga'] : '';
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';

            /*if ($pageActual > 0 && $direccion == 'prev') {
                (int)$pageActual--;
            }*/

            $respuesta = array('status'=> 'ok', 'error'=> '', 'page'=> $pageActual);

            $respuesta['html'] = cambiarFecha( $pageActual, $liga, $direccion );

            echo json_encode( $respuesta );
            
        break;
    }
//sino es peticion ajax se cancela
else :
    throw new Exception("Error Processing Request", 1);   
endif;


//busca la info del equipo q se hace clic, tanto los jugadores como las estadisctias del equipo

function getInfoEquipos( $equipo, $zona, $liga ) {
    $respuesta = array(
        'error' => 0,
        'status' => 'ok',
        'html_jugadores' => '',
        'html_estadisticas' => '',
    );
    
    //primero se buscan los datos del equipo
    $dataEquipo = getPostsFromDeportesById( $equipo, 'equipos' );

    //busca los jugadores, los goles, tarjetas rojas y amarillas
    if ( $dataEquipo['jugadores_id'] == '' ) {

        $respuesta['html_jugadores'] = '<p>No hay jugadores cargados</p>';

    } else {

        $jugadores = explode(',', $dataEquipo['jugadores_id']);
        
        foreach ($jugadores as $jugador) {
            
            $datajugador = getPostsFromDeportesById( $jugador, 'jugadores' );
            if ( $dataEquipo['deporte_id'] != '3' ) {
                $rojas = rojasPorJugador($jugador);
                $amarillas = amarillasPorJugador($jugador);
                $goles = golesPorJugador($jugador);

                //arma el html
                $respuesta['html_jugadores'] .= '<tr><td class="head-td">';
                $respuesta['html_jugadores'] .= $datajugador['nombre'];
                $respuesta['html_jugadores'] .= '</td><td class="td-center head-td">';
                $respuesta['html_jugadores'] .= $goles;
                $respuesta['html_jugadores'] .= '</td><td class="td-center head-td">';
                $respuesta['html_jugadores'] .= $amarillas;
                $respuesta['html_jugadores'] .= '</td><td class="td-center head-td">';
                $respuesta['html_jugadores'] .= $rojas;
                $respuesta['html_jugadores'] .= '</td></tr>';
            } else {
                //arma el html
                $respuesta['html_jugadores'] .= '<tr><td class="head-td">';
                $respuesta['html_jugadores'] .= $datajugador['nombre'];
                $respuesta['html_jugadores'] .= '</td><td class="td-center head-td"></td><td class="td-center head-td"></td><td class="td-center head-td"></td></tr>';
            }
            
        }
    }

    //se arma la estadística del equipo
    $fechaHoy = date('Y-m-d');
    $condition = 'equipos_id LIKE "%'.$equipo.'%"';
    $partidos = getPostsFromDeportes( 'partidos', null, $condition );

    if ( $dataEquipo['deporte_id'] != '3' ) {

        $partidosJugados = 0;
        $partidosGanados = 0;
        $partidosEmpatados = 0;
        $partidosPerdidos = 0;
        $golesFavor = 0;
        $golesenContra = 0;
        $puntos = 0;
        
        foreach ( $partidos as $partido ) {
            
            //si la fecha es posterior todavía no se ha jugado y se omite
            if ( $fechaHoy > $partido['fecha'] ) {
                $equiposId = explode(',', $partido['equipos_id']);
                
                if ( $partido['goles_id1'] == '' ) {
                    $goles1 = 0;
                } else {
                    $goles1 = explode(',', $partido['goles_id1']);
                    $goles1 = count($goles1);
                }
                if ( $partido['goles_id2'] == '' ) {
                    $goles2 = 0;
                } else {
                    $goles2 = explode(',', $partido['goles_id2']);
                    $goles2 = count($goles2);
                }
                
                if ( $partido['puntuacion'] != '' ) {
                    $puntuacion = explode(',', $partido['puntuacion']);
                    $goles1 = (int)$puntuacion[0];
                    $goles2 = (int)$puntuacion[1];
                }
                

                //si el equipo esta en la posicion numero 1 compara de una manera
                if ( $equipo == $equiposId[0] ) {
                    $partidosJugados++;
                    //si esta la puntuacion se anula la estadística
                    
                    if ( $goles1 > $goles2 ) {
                        $partidosGanados++;
                        $puntos += 3;
                    } elseif ( $goles1 < $goles2 ) {
                        $partidosPerdidos++;
                    } else {
                        $partidosEmpatados++;
                        $puntos += 1;
                    }
                    $golesFavor += $goles1;
                    $golesenContra += $goles2;
                    
                }

                //si el equipo esta en la posicion numero 2 compara de otra manera
                if ( $equipo == $equiposId[1] ) {
                    $partidosJugados++;
                    
                    if ( $goles2 > $goles1 ) {
                        $partidosGanados++;
                        $puntos += 3;
                    } elseif ( $goles2 < $goles1 ) {
                        $partidosPerdidos++;
                    } else {
                        $partidosEmpatados++;
                        $puntos += 1;
                    }

                    $golesFavor += $goles2;
                    $golesenContra += $goles1;
                    
                }

            }//if fecha

        }//foreach partidos
        
        $respuesta['html_estadisticas'] .= '<tr><td class="head-td">Partidos Jugados:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosJugados;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">G:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosGanados;;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">E:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosEmpatados;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">P:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosPerdidos;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">GF:</td><td>';
        $respuesta['html_estadisticas'] .= $golesFavor;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">GC:</td><td>';
        $respuesta['html_estadisticas'] .= $golesenContra;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">DG:</td><td>';
        $respuesta['html_estadisticas'] .= $golesFavor - $golesenContra;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">Puntos:</td><td>';
        $respuesta['html_estadisticas'] .= $puntos;
        $respuesta['html_estadisticas'] .= '</td></tr>';
    
    } else {
        //partidos de voley
        $partidosJugados = 0;
        $partidosGanados = 0;
        $partidosEmpatados = 0;
        $partidosPerdidos = 0;
        $golesFavor = 0;
        $golesenContra = 0;
        $puntos = 0;
        
        foreach ( $partidos as $partido ) {
            
            //si la fecha es posterior todavía no se ha jugado y se omite
            if ( $fechaHoy > $partido['fecha'] ) {
                $equiposId = explode(',', $partido['equipos_id']);
                
                if ( $partido['sets1'] == '' ) {
                    $sets1 = array(0,0,0);
                } else {
                    $sets1 = explode(',', $partido['sets1']);
                }
                if ( $partido['sets2'] == '' ) {
                    $sets2 = array(0,0,0);
                } else {
                    $sets2 = explode(',', $partido['sets2']);
                }
                
                //este for se hace para desglosar quien gano cada set y cuanto tantos se suman
                $score1 = 0;
                $score2 = 0;
                $suma1 = 0;
                $suma2 = 0;
                $cantidadsets = 3;
                
                for ($i=0; $i < $cantidadsets; $i++) {
                    
                    if ( (int)$sets1[$i] > (int)$sets2[$i] ) {
                        $score1++;
                    } else {
                        $score2++;
                    }

                    $suma1 = $suma1 + $sets1[$i];
                    $suma2 = $suma2 + $sets2[$i];
                }
                

                //si el equipo esta en la posicion numero 1 compara de una manera
                if ( $equipo == $equiposId[0] ) {
                    $partidosJugados++;
                    //si esta la puntuacion se anula la estadística
                    
                    if ( $score1 > $score2 ) {
                        $partidosGanados++;
                        $puntos += 3;
                    } else {
                        $partidosPerdidos++;
                        if ( $score1 > 0 ) {
                            $puntos += 1;
                        } 
                    }
                    $golesFavor += $suma1;
                    $golesenContra += $suma2;
                    
                }
                
                //si el equipo esta en la posicion numero 2 compara de otra manera
                if ( $equipo == $equiposId[1] ) {
                    $partidosJugados++;
                    
                    if ( $score2 > $score1 ) {
                        $partidosGanados++;
                        $puntos += 3;
                    } else {
                        $partidosPerdidos++;
                        if ( $score2 > 0 ) {
                            $puntos += 1;
                        } 
                    }
                    $golesFavor += $suma2;
                    $golesenContra += $suma1;
                    
                }

            }//if fecha

        }//foreach partidos
        
        $respuesta['html_estadisticas'] .= '<tr><td class="head-td">Partidos Jugados:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosJugados;
        
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">G:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosGanados;;
        $respuesta['html_estadisticas'] .= '</td></tr>';
        /*$respuesta['html_estadisticas'] .= '<tr><td class="head-td">E:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosEmpatados;
        $respuesta['html_estadisticas'] .= '</td></tr>';*/
        $respuesta['html_estadisticas'] .= '<tr><td class="head-td">P:</td><td>';
        $respuesta['html_estadisticas'] .= $partidosPerdidos;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">GF:</td><td>';
        $respuesta['html_estadisticas'] .= $golesFavor;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">GC:</td><td>';
        $respuesta['html_estadisticas'] .= $golesenContra;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">DG:</td><td>';
        $respuesta['html_estadisticas'] .= $golesFavor - $golesenContra;
        $respuesta['html_estadisticas'] .= '</td></tr><tr><td class="head-td">Puntos:</td><td>';
        $respuesta['html_estadisticas'] .= $puntos;
        $respuesta['html_estadisticas'] .= '</td></tr>';
    }

    return $respuesta;
}


//cuenta la cantidad de rojas encontradas por este jugador
function rojasPorJugador($jugador) {
    $condition = 'jugador_id="'.$jugador.'" AND tipo="roja"';
    $data = getPostsFromDeportes( 'amonestaciones', null, $condition );
    return count($data);
}

//cuenta la cantidad de amarillas encontradas por este jugador
function amarillasPorJugador($jugador) {
    $condition = 'jugador_id="'.$jugador.'" AND tipo="amarilla"';
    $data = getPostsFromDeportes( 'amonestaciones', null, $condition );
    return count($data);
}

//cuenta la cantidad de goles encontradas por este jugador
function golesPorJugador($jugador) {
    $condition = 'jugador_id="'.$jugador.'"';
    $data = getPostsFromDeportes( 'goles', null, $condition );
    return count($data);
}


//función basica que busca el contenido
function getContent($contenido, $liga, $variables = '') {
    
    $html;
    $error = 0;
    $arraytitulo = array(
        'slug' => $liga,
        'name' => '',
    );

    //1 buscar contenido en base de datos
    $data = getData($contenido, $liga, $variables);

    /* 2 armar contenido (html) y quizás titulo
     * a) si es array, entonces tiene variables y opciones, normalmnete mini cargas o semi cargas por ejemplo zona, o equipo
    */
    if ( is_array($variables) && ! empty($variables) ) {
        
        $html = renderMiniContent($data[0], $contenido );
        
    } else {
        $html = renderFullContent($data, $contenido );
    }

    //3respuesta
    //se crea la variable  de respuesta
    $respuesta = array(
        'error' => $error,
        'titulo' => $arraytitulo,
        'html' => $html,
    );
    //finalmente se entrega como json:
    echo json_encode($respuesta);
}

//esta funcion muestra el contenido con la ayuda de los templates
function renderFullContent($ArrayConData = '', $contenido ) {

    switch ($contenido) {
        case 'liga':
            
            ob_start(); 

            getTemplate( 'liga', $ArrayConData );

            $html = ob_get_contents();
            ob_end_clean();

        break;

        case 'proxima-fecha':
           
            ob_start();

            getTemplate( 'proxima-fecha', $ArrayConData );

            $html = ob_get_contents();
            ob_end_clean(); 

        break;

        case 'posiciones':
            
            ob_start(); 
            
            getTemplate( 'posiciones', $ArrayConData );

            $html = ob_get_contents();

            ob_end_clean();

        break;

        case 'equipos':
            
            ob_start(); 

            getTemplate( 'equipos', $ArrayConData );

            $html = ob_get_contents();
            ob_end_clean();

        break;
        
    }//switch

    return $html;
}

function renderMiniContent($ArrayConData = '', $contenido ) {

    switch ($contenido) {
        case 'liga':
            
            ob_start(); 

            getTemplate( 'loop-zona-en-liga', $ArrayConData );

            $html = ob_get_contents();
            ob_end_clean();

        break;

        case 'proxima-fecha':
           
        
            if ($ArrayConData == null) : 
                $html = '<p>No hay próxima fecha</p>';
            else :

                ob_start();
                foreach ($ArrayConData as $zona ) {
                    
                    getTemplate( 'loop-zona-en-proxima-fecha', $zona );

                }//foreach zonas

                $html = ob_get_contents();
                ob_end_clean(); 

            endif;
            
            

        break;
        
    }//switch

    return $html;
}


//esta función busca los datos en la base de datos de acuerdo a las variables
function getData($contenido, $liga, $variables = '') {

    /*
    * 1. tomar la variable $liga y buscar que zonas hay en esa liga
    * 2. hacer un foreach por zona y buscar el contenido por zona
    * 3. armar un gran array con las zonas y dentro los datos
    */

    $dataLiga = getPostsFromDeportesBySlug( $liga, 'liga' );

    //este switch remplaza por ahora el contenido de la base de datos
    switch ($contenido) {
        case 'equipos':
            
            $zonas = getPostsFromDeportes( 'zonas', null, 'liga_id="'.$dataLiga['id'].'"' );
            $data = array();

            foreach ( $zonas as $zona ) {
                $arrayZona = array(
                    'id' => $zona['id'],
                    'slug' => $zona['slug'],
                    'name' => $zona['nombre'],
                    'inname' => $zona['nombre_interno'],
                    'liga' => $liga,
                );

                $equipos = getPostsFromDeportes( 'equipos', null, 'zona_id="'.$zona['id'].'"');
                if ( $equipos == null ) {
                    $arrayZona = null;
                    continue;
                }
                $arrayZona['content'] = $equipos;
                array_push( $data, $arrayZona );
            }//for each zonas
            
        break;

        case 'posiciones':
        
            $zonas = getPostsFromDeportes( 'zonas', null, 'liga_id="'.$dataLiga['id'].'"' );

            $data = getTablaPosiciones( $zonas, $dataLiga );
            
        break;

        case 'liga':

            if ( is_array($variables) && ! empty($variables) ) {
                //si tiene variables busca si hay una zona a buscar
                if ( $variables['zona'] == '' ) {
                    $zonas = null;
                } else {
                    //busca la zona específica por el nombre interno
                    $zona = getZonabyNameInter($variables['zona'], 'zonas');
                    
                    if ($zona != null ) {
                        //si la puede recuperar la agrega a un array de zonas para que pueda continuar la funcion sin problemas
                        $zonas = array($zona);
                    } else {
                        $zonas = null;
                    }
                }
                
            } else {
                //si no hay variable zonas busca todas las zonas de la liga y hace lo mismo con todas las zonas
                $zonas = getPostsFromDeportes( 'zonas', null, 'liga_id="'.$dataLiga['id'].'"' );
            }

            if ($zonas == null ) {

                $data = null;
                return;

            } else {

                $data = array();

                foreach ( $zonas as $zona ) {
                    
                    $arrayZona = array(
                        'id' => $zona['id'],
                        'slug' => $zona['slug'],
                        'name' => $zona['nombre'],
                        'inname' => $zona['nombre_interno'],
                        'deporte' => $dataLiga['deporte_id'],
                        'liga' => $zona['liga_id'],
                    );

                    $partidos = $zona['partidos_ids'];

                    if ( $partidos == '' ) {
                        
                        $data=null;
                        return;

                    } else {

                        $dataPartidos = array();
                        $partidos = explode(',', $partidos);

                        foreach ( $partidos as $partido ) {
                            
                            $dataPartidos[] = getPostsFromDeportesById( $partido, 'partidos');

                        }//foreachpartidos

                        //ordeno los partidos antes de sumarlos
                        $arrayZona['partidos'] = ordenarPartidosPorFecha($dataPartidos);

                    }

                    array_push( $data, $arrayZona );

                }//foreach zonas
                
            }//if zona = null

        break;

        case 'proxima-fecha':
        $data = array();
        
        if ( is_array($variables) && ! empty($variables) ) {
            //si tiene variables busca si hay una zona a buscar
            if ( $variables['zona'] == '' ) {
                $zonas = null;
            } else {
                //busca la zona específica por el nombre interno
                $zona = getZonabyNameInter($variables['zona'], 'zonas');
                
                if ($zona != null ) {
                    //si la puede recuperar la agrega a un array de zonas para que pueda continuar la funcion sin problemas
                    $zonas = array($zona);
                } else {
                    $zonas = null;
                }
            }
            
        } else {
            //si no hay variable zonas busca todas las zonas de la liga y hace lo mismo con todas las zonas
            $zonas = getPostsFromDeportes( 'zonas', null, 'liga_id="'.$dataLiga['id'].'"' );
        }

        if ( $zonas == null ) {
            $data = null;
            return;
        }
        
        foreach ( $zonas as $zona ) {
            $arrayZona = array(
                'id' => $zona['id'],
                'slug' => $zona['slug'],
                'name' => $zona['nombre'],
                'inname' => $zona['nombre_interno'],
                'deporte' => $dataLiga['deporte_id'],
                'liga' => $zona['liga_id'],
            );

            //busca los partidos de la zona que este entre las fechas seleccionadas
            $fechahoy = date('Y-m-d');
            $filtro = 'zona_id="'.$zona['id'].'" AND fecha > "'.$fechahoy.'"';
            $partidos = getPostsFromDeportes( 'partidos', CANTPARTIDOS_FECHA, $filtro );
            
            if ( $partidos == null ) {
                $arrayZona = null;
                continue;
            } else {
        
                //ordeno los partidos antes de sumarlos
                $arrayZona['partidos'] = ordenarPartidosPorFecha($partidos);
            }
            $arrayZona['fecha'] = $partidos[0]['fecha'];
            $data[] = $arrayZona;
        }//foreach zonas

        break;
    }

    return $data;
}

//arma la tabla de posiciones
function getTablaPosiciones( $zonas, $dataliga ) {
    $fechaHoy = date('Y-m-d');
    
    $data = array();
    if ( $zonas == null ) {
        
        $data = null;

    } else {

        foreach ($zonas as $zona) {

            $dataZona = array(
                'liga' => $dataliga['slug'],
                'id' => $zona['id'],
                'slug' => $zona['slug'],
                'name' => $zona['nombre'],
                'nombre_interno' => $zona['nombre_interno'],
                'deporte' => $dataliga['deporte_id'],
            );
            $equipos = array();
        
            //2. Buscar equipos de cada zona y armar un array de equipos
            if ( $zona['equipos_ids'] == '' ) {
                $data = null;
                return $data;
            }

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
            

            //3. Buscar partidos y contrastarlos con equipos para agregarle los datos puntaje
            if ( $zona['partidos_ids'] == '' ) {
                $data = null;
                return $data;
            }

            $partidos = explode( ',', $zona['partidos_ids'] );

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
            $dataZona['content'] = $equiposOrdenados;

            array_push($data, $dataZona);

        }//foreach $zonas

    }//if zona not null

    $Olddata = array(
        //zona 1
        array(
            'id' => '1',
            'slug' => 'zona-a',
            'name' => 'Zona A', 
            //contenido por zona
            'content' => array(
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '29', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '23', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '15', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '12', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '10', 
                ),
            ),
        ),
        //zona 2
        array(
            'id' => '2',
            'slug' => 'zona-b',
            'name' => 'Zona B', 
            //contenido por zona
            'content' => array(
                array(
                    'equipo' => 'Droguería Asoproforma', 
                    'puntos' => '29', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '10', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '15', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '3', 
                ),
                array(
                    'equipo' => 'Vital', 
                    'puntos' => '0', 
                ),
            ),
        ),
    );

    return $data;
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

/*ordena los partidos por la variable indicada*/
function ordenarPartidosPorFecha($partidos, $tipo='asc') {
    //1.ordena por puntos
    $partidosNuevos = array();
    foreach ($partidos as $key => $row)
    {
        $partidosNuevos[$key] = $row['fecha'];
        
    }
    if ($tipo == 'desc' ) {
        array_multisort($partidosNuevos, SORT_DESC, $partidos);
    }
    
    if ($tipo == 'asc' ) {
        array_multisort($partidosNuevos, SORT_ASC, $partidos);
    }

    return $partidos;
}

//busca las distintas paginas en proxima fecha o anterior fecha
function cambiarFecha( $pageActual, $liga, $direccion ) {
    $fechahoy = date('Y-m-d');
    $dataLiga = getPostsFromDeportesBySlug( $liga, 'liga' );

    $data = array();

    //si no hay variable zonas busca todas las zonas de la liga y hace lo mismo con todas las zonas
    $zonas = getPostsFromDeportes( 'zonas', null, 'liga_id="'.$dataLiga['id'].'"' );

    if ( $zonas == null ) {
        $data = null;
        return;
    }

    foreach ( $zonas as $zona ) {

        $arrayZona = array(
            'id' => $zona['id'],
            'slug' => $zona['slug'],
            'name' => $zona['nombre'],
            'inname' => $zona['nombre_interno'],
            'deporte' => $dataLiga['deporte_id'],
            'liga' => $zona['liga_id'],
        );

        //si la pagina es negativo el filtro de las fechas es menor
        if ($pageActual < 0) {
            
            $filtro = 'zona_id="'.$zona['id'].'" AND fecha < "'.$fechahoy.'"';
            $orden = 'fecha desc';

            $limit = ( (abs($pageActual) )*CANTPARTIDOS_FECHA).", ".CANTPARTIDOS_FECHA;

        } else {
            //si la pagina es positiva o 0 el filtro de las fechas es mayor
            $filtro = 'zona_id="'.$zona['id'].'" AND fecha > "'.$fechahoy.'"';
            $orden = 'fecha asc';

            $limit = ( ($pageActual )*CANTPARTIDOS_FECHA).", ".CANTPARTIDOS_FECHA;
        }

        /*if ( $direccion == 'next' ) {
            //si es siguiente
            $limit = ( ($pageActual )*CANTPARTIDOS_FECHA).", ".CANTPARTIDOS_FECHA;
        } else {
            $limit = ( (abs($pageActual) )*CANTPARTIDOS_FECHA).", ".CANTPARTIDOS_FECHA;
        }*/

        //busca los partidos de la zona que este entre las fechas seleccionadas y con las instrucciones de arriba
        $partidos = getPostsFromDeportes( 'partidos', $limit, $filtro, $orden );
        
        if ( $partidos == null ) {
            
            $arrayZona = null;
            
            continue;
        } else {

            $arrayZona['partidos'] = $partidos;
        }

        $arrayZona['fecha'] = $partidos[0]['fecha'];
        $data[] = $arrayZona;
    }//foreach zonas
    
    $respuesta = renderMiniContent($data, 'proxima-fecha');
    
    return $respuesta;
}