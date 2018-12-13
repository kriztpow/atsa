<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * INDEX
 * maneja todo lo vinculado a deportes
*/
require '../functions.php';

//chequea seguridad y va a buscar contenido

$deporte = isset($_POST['deporte']) ? $_POST['deporte'] : '';
$contenido = isset($_POST['contenido']) ? $_POST['contenido'] : '';

getContent($contenido, $deporte);



//función basica que busca el contenido
function getContent($contenido, $deporte, $variable = '') {
    sleep(1);

    //variable standar de respuesta
    $respuesta = array(
        'error' => '0',
        'titulo' => array(
            'slug' => $_POST['deporte'],
            'name' => '',
        ),
        'html' => '<p>Un párrafo simple</p>',
    );
    
    echo json_encode($respuesta);
}


//var_dump($_POST);




