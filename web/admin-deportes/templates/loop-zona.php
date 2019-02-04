<div class="zona">
    <div class="data-zona">
        <input type="hidden" name="liga_id" class="liga_id" value="<?php echo isset($data['liga_id']) ? $data['liga_id'] : '' ?>">
        <input type="hidden" name="zona_id" class="zona_id" value="<?php echo isset($data['id']) ? $data['id'] : '' ?>">
        <input type="hidden" name="nombre_interno" class="nombre_interno" value="<?php echo isset($data['nombre_interno']) ? $data['nombre_interno'] : '' ?>">
        <input type="hidden" name="slug" class="slug" value="<?php echo isset($data['slug']) ? $data['slug'] : '' ?>">
        <input type="hidden" name="partidos_id" class="partidos_id" value="<?php echo isset($data['partidos_ids']) ? $data['partidos_ids'] : '' ?>">
        <input type="hidden" name="equipos_id" class="equipos_id" value="<?php echo isset($data['equipos_id']) ? $data['equipos_id'] : '' ?>">
    </div>
    <div class="row">
        <div class="col-80">
            <h2 class="title-zona">
                <input type="text" name="nombre_zona" class="nombre_zona" value="<?php echo isset($data['nombre']) ? $data['nombre'] : 'Zona A' ?>">
            </h2>
        </div>
        
        <button type="button" title="Borrar Zona" class="borrar-zona-btn" data-id="<?php echo isset($data['id']) ? $data['id'] : '' ?>">
            <img src="assets/images/ios-trash.png">
        </button>
        
    </div>

    <h4 class="title-mini">
        Partidos:
    </h4>
    <table class="lista-partidos">

        <?php
        
            if ( $data['partidos_ids'] != '' ) {
                $partidos = $data['partidos_ids'];
                $partidos = explode(',', $partidos);

                foreach ( $partidos as $partido ) {
                    $dataPartido =  getPostsFromDeportesById( $partido, 'partidos' );
                    getTemplate('loop-partidos', $dataPartido);
                }
            }
        ?>
        
    </table>
</div><!-- // zona -->