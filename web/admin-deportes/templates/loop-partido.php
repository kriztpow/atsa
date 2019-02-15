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
            <p class="links-edicion-noticias">
                
                <a href="index.php?admin=editar-partido&id=<?php echo $data['id']; ?>" title="Editar" class="btn-edit-news">
                    Editar
                </a>
                | <a href="<?php echo $data['id']; ?>" class="btn-delete-partido">Borrar</a>
            </p>
        </div>
    </article>
</li>