<li class="loop-noticias-backend-item">
    <article class="row">
        <div class="col-30">
            <h2>
                <?php echo getDataDeporte($data['deporte_id'])['nombre']; ?> 
            </h2>
        </div>
        <div class="col-70">
            <h1 class="titulo-noticia-small">
                Liga: <?php echo $data['nombre']; ?>
            </h1>
            <p class="links-edicion-noticias">
                
                <a href="index.php?admin=editar-liga&id=<?php echo $data['id']; ?>" title="Editar" class="btn-edit-news">
                    Editar
                </a>
                | <a href="<?php echo $data['id']; ?>" class="btn-delete-post">Borrar</a>
            </p>
            
        </div>
    </article>
</li>