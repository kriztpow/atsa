<?php 
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 8.4
 * template de partido (individual)
*/

?>
<article class="contenedor-partido" data-id="<?php echo $data['id']; ?>" <?php echo $data['fecha']; ?>>
    <header class="header-partido">

        <div class="bloque-equipo">
            <img src="<?php if ( $data['equipos'][0]['imagen'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $data['equipos'][0]['imagen']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">

            <div class="data-partido">
                <div class="data">
                    <h2>
                        <?php echo $data['equipos'][0]['name']; ?>
                    </h2>

                    <?php 
                        if ( isset($data['equipos'][0]['goles']) && is_array($data['equipos'][0]['goles']) && ! empty($data['equipos'][0]['goles']) ) : ?>
                        
                        <ul class="lista-detalles gol">
                            <?php foreach ( $data['equipos'][0]['goles'] as $gol ) {
                                echo '<li id-jugador="'.$gol['id'].'">'.$gol['jugador'].'('.$gol['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>
                        
                    <?php 
                        if ( isset($data['equipos'][0]['amarillas']) && is_array($data['equipos'][0]['amarillas']) && ! empty($data['equipos'][0]['amarillas']) ) : ?>
                        
                        <ul class="lista-detalles amarilla">
                            <?php foreach ( $data['equipos'][0]['amarillas'] as $tarjeta ) {
                                echo '<li id-jugador="'.$tarjeta['id'].'">'.$tarjeta['jugador'].'('.$tarjeta['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>

                    <?php 
                        if ( isset($data['equipos'][0]['rojas']) && is_array($data['equipos'][0]['rojas']) && ! empty($data['equipos'][0]['rojas']) ) : ?>
                        
                        <ul class="lista-detalles roja">
                            <?php foreach ( $data['equipos'][0]['rojas'] as $tarjeta ) {
                                echo '<li id-jugador="'.$tarjeta['id'].'">'.$tarjeta['jugador'].'('.$tarjeta['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>

                </div>
                
                <h4 class="goles">
                    <?php 
                    if ( isset($data['equipos'][0]['goles']) && is_array($data['equipos'][0]['goles'])) {
                        echo count($data['equipos'][0]['goles']);
                    } elseif ( isset($data['equipos'][1]['goles']) && $data['equipos'][1]['goles'] === false ) {
                        echo '';
                    } else {
                        echo '0';
                    }
                    ?>
                </h4>
            </div>

        </div>

        <div class="bloque-equipo bloque-inverse">

            <img src="<?php if ( $data['equipos'][1]['imagen'] != '' ) { 
                    echo urlbase() . '/uploads/images/' . $data['equipos'][1]['imagen']; 
                    } else {
                        echo urlbase() . '/assets/images/equipologodefault.png'; 
                    }
                    ?>" class="logo-equipo">

            <div class="data-partido data-partido-inverse">
                <div class="data data-inverse">
                    <h2>
                        <?php echo $data['equipos'][1]['name']; ?>
                    </h2>
                    
                    <?php 
                        if ( isset($data['equipos'][1]['goles']) && is_array($data['equipos'][1]['goles']) && ! empty($data['equipos'][0]['goles']) ) : ?>
                        
                        <ul class="lista-detalles gol">
                            <?php foreach ( $data['equipos'][1]['goles'] as $gol ) {
                                echo '<li id-jugador="'.$gol['id'].'">'.$gol['jugador'].'('.$gol['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>
                        
                    <?php 
                        if ( isset($data['equipos'][1]['amarillas']) && is_array($data['equipos'][1]['amarillas']) && ! empty($data['equipos'][0]['amarillas']) ) : ?>
                        
                        <ul class="lista-detalles amarilla">
                            <?php foreach ( $data['equipos'][1]['amarillas'] as $tarjeta ) {
                                echo '<li id-jugador="'.$tarjeta['id'].'">'.$tarjeta['jugador'].'('.$tarjeta['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>

                    <?php 
                        if ( isset($data['equipos'][1]['rojas']) && is_array($data['equipos'][1]['rojas']) && ! empty($data['equipos'][1]['rojas']) ) : ?>
                        
                        <ul class="lista-detalles roja">
                            <?php foreach ( $data['equipos'][1]['rojas'] as $tarjeta ) {
                                echo '<li id-jugador="'.$tarjeta['id'].'">'.$tarjeta['jugador'].'('.$tarjeta['tiempo'].')</li>';
                            } ?>
                        </ul>
                        
                    <?php endif; ?>

                </div>
                

                <h4 class="goles goles-inverse">
                    <?php 
                    if ( isset($data['equipos'][1]['goles']) && is_array($data['equipos'][1]['goles'])) {
                        echo count($data['equipos'][1]['goles']);
                    } elseif ( isset($data['equipos'][1]['goles']) && $data['equipos'][1]['goles'] === false ) {
                        echo '';
                    } 
                    else {
                        echo '0';
                    }
                    ?>
                </h4>

            </div>

        </div>
        
        <?php if ( isset($data['resumen']) && ! empty($data['resumen'] ) ) : ?>
        
            <button class="button-resumen-partido">
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

        <?php if ( isset($data['resumen']) && ! empty($data['resumen'] ) ) : ?>

        <div class="resumen-partido-interno">
            <?php echo $data['resumen']['texto']; ?>
        </div>

        <?php endif; ?>

        <footer class="footer-partido">
            <button class="collapse-article" data-target=".resumen-partido">
                <span class="tog1"></span>
                <span class="tog2"></span>
            </button>
        </footer>
    </div>

    

</article>