<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de partido (individual)
*/

//var_dump($data);
$idsequipos = explode(',',$data['equipos_id']);
$equipo1 = getPostsFromDeportesById($idsequipos[0], 'equipos');
$equipo2 = getPostsFromDeportesById($idsequipos[1], 'equipos');

?>
<article class="contenedor-partido" data-id="<?php echo $data['id']; ?>" data-fecha="<?php echo $data['fecha']; ?>">
    <header class="header-partido">

        <div class="bloque-equipo">
            <img src="<?php if ( $equipo1['logo'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $equipo1['logo']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">

            <div class="data-partido">
                <div class="data">
                    <h2>
                        <?php echo $equipo1['nombre']; ?>
                    </h2>

                    <?php 
                        if ( $data['goles_id1'] != '' ) :
                            $goles1 = explode(',', $data['goles_id1'] );
                        ?>
                        
                        <ul class="lista-detalles gol">
                            <?php foreach ( $goles1 as $gol ) {

                                $gol = getPostsFromDeportesById($gol, 'goles');
                                $jugador = getPostsFromDeportesById($gol['jugador_id'], 'jugadores');

                                echo '<li id-jugador="'.$gol['id'].'">'.$jugador['nombre'].'</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>
                        
                    <?php 
                    if ( $data['amonestaciones_id1'] != '' ) :
                        $amonestaciones = explode(',', $data['amonestaciones_id1']);

                        foreach ($amonestaciones as $amonestacion) {

                            $amonestacion = getPostsFromDeportesById($amonestacion, 'amonestaciones');
                            $jugador = getPostsFromDeportesById($amonestacion['jugador_id'], 'jugadores');
                            $amarillas = '';
                            $rojas = '';

                            if ($amonestacion['tipo'] == 'amarilla') {
                                $amarillas .= '<li id-jugador="'.$jugador['id'].'">'.$jugador['nombre'].'</li>';
                            }

                            if ($amonestacion['tipo'] == 'roja') {
                                $rojas .= '<li id-jugador="'.$jugador['id'].'">'.$jugador['nombre'].'</li>';
                            }
                        
                        }//foreach amonestaciones

                        if ( $amarillas != '' ) { ?>
                            <ul class="lista-detalles amarilla">
                                <?php echo $amarillas; ?>
                            </ul>
                        <?php } ?>
                        
                        <?php if ( $rojas != '' ) { ?>
                            <ul class="lista-detalles roja">
                                <?php echo $rojas; ?>
                            </ul>
                        <?php } ?>

                    <?php endif; ?>

                </div>
                
                <h4 class="goles">
                <?php 
                    if ($data['puntuacion'] != '') {
                        //si tiene la puntuacion se anulan goles y sets
                        $puntuacion = explode(',', $data['puntuacion']);
                        echo $puntuacion[0];

                    } else {
                        //ino tiene la puntuacion depende, si es voley:
                        if ( $data['deporte_id'] == '3') {

                            $puntos = getScoreVoley($data['sets1'], $data['sets2']);
                            echo $puntos[0];
                            
                        } else {
                            //si es futbol
                            if ( $data['goles_id1'] == '' ) {
                                echo '0';
                            } else {
                                $goles = explode(',', $data['goles_id1']);
                            echo count( $goles );
                            }
                        }
                    }
                    ?>
                </h4>
            </div>

        </div>

        <div class="bloque-equipo bloque-inverse">

            <img src="<?php if ( $equipo2['logo'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $equipo2['logo']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">

            <div class="data-partido data-partido-inverse">
                <div class="data data-inverse">
                    <h2>
                        <?php echo $equipo2['nombre']; ?>
                    </h2>
                    
                    <?php 
                        if ( $data['goles_id2'] != '' ) :
                            $goles1 = explode(',', $data['goles_id2'] );
                        ?>
                        
                        <ul class="lista-detalles gol">
                            <?php foreach ( $goles1 as $gol ) {

                                $gol = getPostsFromDeportesById($gol, 'goles');
                                $jugador = getPostsFromDeportesById($gol['jugador_id'], 'jugadores');

                                echo '<li id-jugador="'.$gol['id'].'">'.$jugador['nombre'].'</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>
                        
                    <?php 
                    if ( $data['amonestaciones_id2'] != '' ) :
                        $amonestaciones = explode(',', $data['amonestaciones_id2']);

                        foreach ($amonestaciones as $amonestacion) {

                            $amonestacion = getPostsFromDeportesById($amonestacion, 'amonestaciones');
                            $jugador = getPostsFromDeportesById($amonestacion['jugador_id'], 'jugadores');
                            $amarillas = '';
                            $rojas = '';

                            if ($amonestacion['tipo'] == 'amarilla') {
                                $amarillas .= '<li id-jugador="'.$jugador['id'].'">'.$jugador['nombre'].'</li>';
                            }

                            if ($amonestacion['tipo'] == 'roja') {
                                $rojas .= '<li id-jugador="'.$jugador['id'].'">'.$jugador['nombre'].'</li>';
                            }
                        
                        }//foreach amonestaciones

                        if ( $amarillas != '' ) { ?>
                            <ul class="lista-detalles amarilla">
                                <?php echo $amarillas; ?>
                            </ul>
                        <?php } ?>
                        
                        <?php if ( $rojas != '' ) { ?>
                            <ul class="lista-detalles roja">
                                <?php echo $rojas; ?>
                            </ul>
                        <?php } ?>

                    <?php endif; ?>

                </div>
                
                <h4 class="goles goles-inverse">
                    <?php 
                    if ($data['puntuacion'] != '') {
                        //si tiene la puntuacion se anulan goles y sets
                        $puntuacion = explode(',', $data['puntuacion']);
                        echo $puntuacion[1];

                    } else {
                        //ino tiene la puntuacion depende, si es voley:
                        if ( $data['deporte_id'] == '3') {

                            $puntos = getScoreVoley($data['sets1'], $data['sets2']);
                            echo $puntos[1];
                            
                        } else {
                            //si es futbol
                            if ( $data['goles_id2'] == '' ) {
                                echo '0';
                            } else {
                                $goles = explode(',', $data['goles_id2']);
                            echo count( $goles );
                            }
                        }
                    }
                    ?>
                </h4>

            </div>

        </div>
        
        <?php if ( $data['contenido_id'] != '' ) : ?>
        
            <button data-contenido="<?php echo $data['contenido_id']; ?>" class="button-resumen-partido">
                <span class="inner-button">
                    Resumen
                </span>
                <span class="inner-button">
                    Fotos/videos
                </span>
            </button>

        <?php endif; ?>
    </header>

    <div class="resumen-partido">

        <div class="resumen-partido-interno">
            
        </div>

        <footer class="footer-partido">
            <button class="collapse-article" data-target=".resumen-partido">
                <span class="tog1"></span>
                <span class="tog2"></span>
            </button>
        </footer>
    </div>
</article>