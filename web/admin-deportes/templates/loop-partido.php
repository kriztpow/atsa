<?php 
    $equipos = explode(',', $data['equipos_id']);
    $equipo1 = getPostsFromDeportesById( $equipos[0], 'equipos' );
    $equipo2 = getPostsFromDeportesById( $equipos[1], 'equipos' );
?>
<li class="loop-noticias-backend-item">
    <article class="row">
        <div class="col-30">
            <h2>
                <?php echo getDataDeporte($data['deporte_id'])['nombre']; ?> 
            </h2>
        </div>
        <div class="col-70">
            <h1 class="titulo-noticia-small">
                <strong>Equipos:</strong>
                <?php echo $equipo1['nombre']; ?>
                vs
                <?php echo $equipo2['nombre']; ?>
            </h1>
            <div class="row">
                <p class="col-20 fecha-loop-partidos">
                    <?php echo $data['fecha']; ?>
                </p>
                <p class="col-20 score-loop-partidos">
                    
                    <?php
                    $fechaHoy = Date("Y-m-d");
                    if ( $fechaHoy > $data['fecha'] != '' ) {
                        if ( $data['puntuacion'] != '' ) {
                            $puntos = explode( ',', $data['puntuacion'] );
                            echo $puntos[0] . ' a ' . $puntos[1];
                        } else {
                            if ( $data['deporte_id'] == 3 ) {
                                //voley
                                $puntos = getScoreVoley($data['sets1'], $data['sets2']);
    
                                echo $puntos[0] . ' a ' . $puntos[1];

                            } else {
                                //futbol
                                $goles = getScoreFutbol ($data['goles_id1'], $data['goles_id2']);
    
                                echo $goles[0] . ' a ' . $goles[1];
                            }
                              
                        }

                    } else {
                        echo '<em>Sin resultados</em>';
                    }
                    ?>

                </p>
                <p class="col-60"></p>
            </div>
            <p class="links-edicion-noticias">
                
                <a href="index.php?admin=editar-partido&id=<?php echo $data['id']; ?>" title="Editar" class="btn-edit-news">
                    Editar
                </a>
                <?php if ( $data['contenido_id'] != '' )  { ?>
                    | <a href="index.php?admin=editar-post&id=<?php echo $data['contenido_id']; ?>">contenido</a>
                <?php } ?>
                | <a href="<?php echo $data['id']; ?>" class="btn-delete-partido">Borrar</a>
            </p>
        </div>
    </article>
</li>