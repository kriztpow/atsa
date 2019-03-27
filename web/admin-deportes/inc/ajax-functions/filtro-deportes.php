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
            $HTMLzonas = '<option value="">Seleccionar Una</option>';
            
            if ( $zonas != null ) {
                for ($i=0; $i < count($zonas); $i++) { 
                    $HTMLzonas .= '<option value="' . $zonas[$i]['id'] . '">' . $zonas[$i]['nombre_interno'] . '</option>';
                }
            }

            //cierre base de datos
            mysqli_close($connection);

            echo $HTMLzonas;

        break;

        case 'ligas-by-deportes':

            if ($categoria != '') {
                $filtro = 'deporte_id="'.$categoria.'"';
            }
            
            $ligas = getLigas($filtro);
            $HTMLdeportes = '<option value="">Seleccionar Una</option>';
            
            if ( $ligas != null ) {
                for ($i=0; $i < count($ligas); $i++) { 
                    $HTMLdeportes .= '<option value="' . $ligas[$i]['id'] . '">' . $ligas[$i]['nombre'] . '</option>';
                }
            }

            //cierre base de datos
            mysqli_close($connection);

            echo $HTMLdeportes;

        break;

        case 'filtro-partidos':
            $deporte = isset( $_POST['deporte'] ) ? $_POST['deporte'] : '';
            $liga = isset( $_POST['liga'] ) ? $_POST['liga'] : '';
            $zona = isset( $_POST['zona'] ) ? $_POST['zona'] : '';
            $filtro = '';
            
            if ( $deporte != '' ) {
                $filtro .= 'deporte_id="'.$deporte.'"';
            }

            if ( $liga != '' ) {
                if ( $deporte != '' ) {
                    $filtro .= ' AND ';
                }
                $filtro .= 'liga_id="'.$liga.'"';
            }

            if ( $zona != '' ) {
                if ( $liga != '' || $deporte != '') {
                    $filtro .= ' AND ';
                }
                $filtro .= 'zona_id="'.$zona.'"';
            }

            if ( $filtro == '' ) {
                $filtro = null;
            }
            
            $orden = 'fecha desc';
            $partidos = getPartidos($filtro, $orden);

            if( $partidos == null ) : ?>

					<li style="padding: 5rem 0">
						<p>Todavía no hay ningun partido cargado, <a type="button" href="index.php?admin=editar-partido">¿Empezamos?</a></p>
					</li>
		
            <?php else : 

            foreach ($partidos as $partido ) {
                getTemplate( 'loop-partido', $partido );
            }

            endif;

        break;

        case 'posiciones':

            $liga = isset( $_POST['liga'] ) ? $_POST['liga'] : '';
            $zona = isset( $_POST['zona'] ) ? $_POST['zona'] : '';
            
            $respuesta = getPosiciones($liga, $zona);

            echo json_encode( $respuesta );

        break;

    }//switch




} //if not ajax
else {
	exit;
}