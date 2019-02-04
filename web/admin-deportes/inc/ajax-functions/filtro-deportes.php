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
    $filtro = null;


    switch ($buscar) {
        case 'liga':
            
            $tabla = 'liga';

            if ($categoria != '') {
                $filtro = 'deporte_id="'.$categoria.'"';
            }
            
            $ligas = getLigas($filtro);
                
            if ( $ligas != null ) {
                for ($i=0; $i < count($ligas); $i++) { 
                    getTemplate( 'loop-liga', $ligas[$i] );     
                }
            } 
        
            //cierre base de datos
            mysqli_close($connection);

        break;

        case 'equipos':

            if ($categoria != '') {
                $filtro = 'deporte_id="'.$categoria.'"';
            }
            
            $equipos = getEquipos($filtro);
                
            if ( $equipos != null ) {
                for ($i=0; $i < count($equipos); $i++) { 
                    getTemplate( 'loop-equipo', $equipos[$i] );     
                }
            } 
        
            //cierre base de datos
            mysqli_close($connection);

        break;

        case 'zonas-by-liga':

            if ($categoria != '') {
                $filtro = 'liga_id="'.$categoria.'"';
            }
            
            $zonas = getZonas($filtro);
            $HTMLzonas = '<option>Seleccionar Una</option>';
            
            if ( $zonas != null ) {
                for ($i=0; $i < count($zonas); $i++) { 
                    $HTMLzonas .= '<option value"' . $zonas[$i]['id'] . '">' . $zonas[$i]['nombre_interno'] . '</option>';
                }
            }

            //cierre base de datos
            mysqli_close($connection);

            echo $HTMLzonas;

        break;

    }//switch




} //if not ajax
else {
	exit;
}