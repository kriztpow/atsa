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
    
    sleep(1);

    switch ($funcionAjax) {
        case 'contenido-macro':
            $deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
            $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
            
            getContent($contenido, $deporte);

        break;

        case 'contenido-zona' :
            $deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
            $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
            $zona = isset($_POST['zona']) ? $_POST['zona'] : '';
            
            $variables = array('zona'=> $zona);

            getContent($contenido, $deporte, $variables);
        break;
    }
//sino es peticion ajax se cancela
else :
    throw new Exception("Error Processing Request", 1);   
endif;



//función basica que busca el contenido
function getContent($contenido, $deporte, $variables = '') {

    $html;
    $error = 0;
    $arraytitulo = array(
        'slug' => $deporte,
        'name' => '',
    );

    //1 buscar contenido en base de datos
    $data = getData($contenido, $deporte, $variables);

    /* 2 armar contenido (html) y quizás titulo
     * a) si es array, entonces tiene variables y opciones, normalmnete mini cargas o semi cargas por ejemplo zona, o equipo
    */
    if ( is_array($variables) && ! empty($variables) ) {
        $html = 'Aca debería cargar la zona';
    } else {
        $html = renderFullContent($data, $contenido);
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
function renderFullContent($ArrayConData = '', $contenido) {

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
function getData($contenido, $deporte, $variables = '') {

    /*
    * 1. tomar la variable $deporte y buscar que zonas hay en ese deporte
    * 2. hacer un foreach por zona y buscar el contenido por zona
    * 3. armar un gran array con las zonas y dentro los datos
    */


    //este switch remplaza por ahora el contenido de la base de datos
    switch ($contenido) {
        case 'equipos':
            $data = array(
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
                //zona 2
                array(
                    'id' => '2',
                    'slug' => 'zona-b',
                    'name' => 'Zona B', 
                    //contenido por zona
                    'content' => array(
                        array(
                            'id' => '1', 
                            'slug' => 'drogueria-asoproforma', 
                            'name' => 'Droguería Asoproforma', 
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
