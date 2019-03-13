<div class="wrapper-zona">
    <h3 class="titulo-zona">
        <?php echo $data['name']; ?>
    </h3>
    <div class="wrapper-externo-partido">
        <ul class="lista-partidos">
            <?php 
            $fecha = '';
            foreach ($data['partidos'] as $partido) {
                if ( $partido['fecha'] != $fecha ) {
                    echo '<span class="fecha-partido-liga">'.$partido['fecha'] .'</span>';
                    $fecha = $partido['fecha'];
                }
                echo '<li>';
                getTemplate('partido', $partido );
                echo '</li>';
            }
            ?>
        </ul>
    </div>
</div>