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
            $zona = isset($_POST['zona']) ? $_POST['zona'] : '';
            
            $variables = array('zona'=> $zona);

            getContent($contenido, $liga, $variables);
        break;

        case 'estadisticas-equipo':
            sleep(1);
            $liga = isset($_POST['liga']) ? $_POST['liga'] : '';
            $equipo = isset($_POST['equipo']) ? $_POST['equipo'] : '';
            $zona = isset($_POST['zona']) ? $_POST['zona'] : '';

            $respuesta = getInfoEquipos( $equipo, $zona, $liga );

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
        $html = 'Aca debería cargar la zona';
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

            $dataOld = array(
                //zona 1
                array(
                    'id' => '1',
                    'slug' => 'zona-a',
                    'name' => 'Zona A', 
                    //contenido por zona
                    'content' => array(
                        array(
                            'id' => '1', 
                            'slug' => 'vital', 
                            'name' => 'Vital', 
                            'imagen' => 'defaultequipo.png',
                            'jugadores' => array('1','2','3','4','5'), 
                        ),
                        array(
                            'id' => '2', 
                            'slug' => 'vital', 
                            'name' => 'Vital', 
                            'imagen' => 'defaultequipo.png',
                            'jugadores' => array('1','2','3','4','5'), 
                        ),
                        array(
                            'id' => '3', 
                            'slug' => 'vital', 
                            'name' => 'Vital', 
                            'imagen' => 'defaultequipo.png',
                            'jugadores' => array('1','2','3','4','5'), 
                        ),
                        array(
                            'id' => '4', 
                            'slug' => 'vital', 
                            'name' => 'Vital', 
                            'imagen' => 'defaultequipo.png',
                            'jugadores' => array('1','2','3','4','5'), 
                        ),
                    ),
                ),
            );
        break;

        case 'posiciones':
            $data = array(
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
        break;

        case 'liga':
            $data = array(
                //zona 1
                array(
                    'slug' => 'zona-a',
                    'name' => 'Zona A', 
                    'deporte' => 'futbol-11',
                    //contenido por zona
                    'partidos' => array(
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Droguería Asoproforma',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'Clínica Baxterrica B',
                                    'puntos' => 1,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '10',
                                            'jugador' => 'Julio Francisco',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '95',
                                        ),
                                        array(
                                            'id' => '4',
                                            'jugador' => 'Julio Francisco',
                                            'tiempo' => '115',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),

                        //partido 2
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Clinica Fitz Roy',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'rojas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'I.M.A.C.',
                                    'puntos' => 1,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '10',
                                            'jugador' => 'Julio Francisco',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),

                        //partido 3
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Vital',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'Centro de Diag. ROSSI',
                                    'puntos' => 1,
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '95',
                                        ),
                                        array(
                                            'id' => '4',
                                            'jugador' => 'Julio Francisco',
                                            'tiempo' => '115',
                                        ),
                                    ),
                                    'rojas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Fulano Lopez',
                                            'tiempo' => '95',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),
                    ),//partidos
                    
                ),//zona

                //zona 2
                array(
                    'slug' => 'zona-b',
                    'name' => 'Zona B', 
                    'deporte' => 'futbol-11',
                    //contenido por zona
                    'partidos' => array(
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Droguería Asoproforma',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'Clínica Baxterrica B',
                                    'puntos' => 1,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '10',
                                            'jugador' => 'Julio Francisco',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '95',
                                        ),
                                        array(
                                            'id' => '4',
                                            'jugador' => 'Julio Francisco',
                                            'tiempo' => '115',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),

                        //partido 2
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Clinica Fitz Roy',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'rojas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'I.M.A.C.',
                                    'puntos' => 1,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '10',
                                            'jugador' => 'Julio Francisco',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),

                        //partido 3
                        array(
                            //detalle gral partido
                            'id' => '1',
                            'fecha' => '2018-10-20',
                            'slug' => 'zona-a',
                            'name' => 'Zona A', 
                            'deporte' => 'futbol-11',
                            'resumen' => array(
                                'videos' => array('https://www.youtube.com/watch?v=wYXnPHXW0-E'),
                                'imagenes' => array(),
                                'texto' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                            ),
                            //detalle y resultado equipos
                            'equipos' => array(
                                array(
                                    'id' => 1,
                                    'imagen' => '',
                                    'name' => 'Vital',
                                    'puntos' => 3,
                                    'goles' => array(
                                        //tabla de goles, en el array se guarda solo los ids
                                        array(
                                            'id' => '1',
                                            'tiempo' => '20',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                        array(
                                            'id' => '2',
                                            'tiempo' => '113',
                                            'jugador' => 'Carlos Perez',
                                        ),
                                    ),
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '55',
                                        ),
                                    ),
                                ),
                                array(
                                    'id' => 2,
                                    'imagen' => '',
                                    'name' => 'Centro de Diag. ROSSI',
                                    'puntos' => 1,
                                    'amarillas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Federico Lopez',
                                            'tiempo' => '95',
                                        ),
                                        array(
                                            'id' => '4',
                                            'jugador' => 'Julio Francisco',
                                            'tiempo' => '115',
                                        ),
                                    ),
                                    'rojas' => array(
                                        array(
                                            'id' => '3',
                                            'jugador' => 'Fulano Lopez',
                                            'tiempo' => '95',
                                        ),
                                    ),
                                ),  
                            ), 
                        ),
                    ),//partidos
                    
                ),//zona
                
            );
                
        break;

        case 'proxima-fecha':
        $data = array(
            //zona 1
            array(
                'slug' => 'zona-a',
                'name' => 'Zona A', 
                'deporte' => 'futbol-11',
                //contenido por zona
                'partidos' => array(
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-a',
                        'name' => 'Zona A', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Droguería Asoproforma',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'Clínica Baxterrica B',
                                'goles' => false,
                            ),  
                        ), 
                    ),

                    //partido 2
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-a',
                        'name' => 'Zona A', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Clinica Fitz Roy',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'I.M.A.C.',
                                'goles' => false,
                            ),  
                        ), 
                    ),

                    //partido 3
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-a',
                        'name' => 'Zona A', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Vital',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'Centro de Diag. ROSSI',
                                'goles' => false,
                            ),  
                        ), 
                    ),
                ),//partidos
                
            ),//zona

            array(
                'slug' => 'zona-b',
                'name' => 'Zona B', 
                'deporte' => 'futbol-11',
                //contenido por zona
                'partidos' => array(
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-b',
                        'name' => 'Zona B', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Droguería Asoproforma',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'Clínica Baxterrica B',
                                'goles' => false,
                            ),  
                        ), 
                    ),

                    //partido 2
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-b',
                        'name' => 'Zona B', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Clinica Fitz Roy',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'I.M.A.C.',
                                'goles' => false,
                            ),  
                        ), 
                    ),

                    //partido 3
                    array(
                        //detalle gral partido
                        'id' => '1',
                        'fecha' => '2018-10-20',
                        'slug' => 'zona-b',
                        'name' => 'Zona B', 
                        'deporte' => 'futbol-11',
                        //detalle y resultado equipos
                        'equipos' => array(
                            array(
                                'id' => 1,
                                'imagen' => '',
                                'name' => 'Vital',
                                'goles' => false,
                            ),
                            array(
                                'id' => 2,
                                'imagen' => '',
                                'name' => 'Centro de Diag. ROSSI',
                                'goles' => false,
                            ),  
                        ), 
                    ),
                ),//partidos
            ),
        );
                
        break;
    }


    return $data;
}
