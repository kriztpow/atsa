<?php 
/*
 * FILTRAR POR DEPORTE AJAX
 * @LaCueva.tv
 * Since 1.1
 * Carga más post
*/
require_once('../functions.php');
load_module( 'deportes' );
if ( isAjax() ) {

    $categoria = isset( $_POST['categoria'] ) ? $_POST['categoria'] : '';
    $buscar = isset( $_POST['buscar'] ) ? $_POST['buscar'] : '';
    $flitro = null;


    switch ($buscar) {
        case 'liga':
            
            $tabla = 'liga';

            if ($categoria != '') {
                $flitro = 'deporte_id="'.$categoria.'"';
            }
            
            $ligas = getLigas($flitro);
                
            if ( $ligas != null ) {
                for ($i=0; $i < count($ligas); $i++) { 
                    getTemplate( 'loop-liga', $ligas[$i] );     
                }
            } 
        
            //cierre base de datos
            mysqli_close($connection);

        break;

        case 'equipos':
            
            $tabla = 'equipos';

            if ($categoria != '') {
                $flitro = 'deporte_id="'.$categoria.'"';
            }
            
            $equipos = getEquipos($flitro);
                
            if ( $equipos != null ) {
                for ($i=0; $i < count($equipos); $i++) { 
                    getTemplate( 'loop-equipo', $equipos[$i] );     
                }
            } 
        
            //cierre base de datos
            mysqli_close($connection);

        break;

    }//switch




} //if not ajax
else {
	exit;
}