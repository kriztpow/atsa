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
            $deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
            $contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';
            
            getContent($contenido, $deporte);

        break;
    }
//sino es peticion ajax se cancela
else :
    throw new Exception("Error Processing Request", 1);   
endif;



//función basica que busca el contenido
function getContent($contenido, $deporte, $variable = '') {
    sleep(1);
    $html;
    $error = 0;
    $arraytitulo = array(
        'slug' => $deporte,
        'name' => '',
    );


    //1 buscar contenido en base de datos
    $data = getData($contenido, $deporte);


    //2 armar contenido (html) y quizás titulo
    $html = renderContent($data, $contenido);

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
function renderContent($ArrayConData = '', $contenido) {

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
                    'id' => '1',
                    'slug' => 'zona-a',
                    'name' => 'Zona A', 
                    //contenido por zona
                    'content' => array(
                    ),
                ),
                //zona 2
                array(
                    'id' => '2',
                    'slug' => 'zona-b',
                    'name' => 'Zona B', 
                    //contenido por zona
                    'content' => array(
                    ),
                ),
            );
                
        break;

        case 'proxima-fecha':
            $data = array(
                //zona 1
                array(
                    'id' => '1',
                    'slug' => 'zona-a',
                    'name' => 'Zona A', 
                    //contenido por zona
                    'content' => array(
                    ),
                ),
                //zona 2
                array(
                    'id' => '2',
                    'slug' => 'zona-b',
                    'name' => 'Zona B', 
                    //contenido por zona
                    'content' => array(
                    ),
                ),
            );
                
        break;
    }


    return $data;
}
