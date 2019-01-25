<li class="loop-noticias-backend-item">
    <article class="row">
        <div class="col-30">
            <?php 
            if ( $data['post_imagen'] != '' ) { ?>
            <img src="<?php echo UPLOADSURLIMAGES.'/'.$data['post_imagen']; ?>" alt="Imagen Destacada de la noticia" class="img-responsive">
            <?php }
            else { ?>
            <img src="assets/images/noticia-img-default.png" alt="Noticias" class="img-responsive">
            <?php } ?>
        </div>
        <div class="col-70">
            
            <h1 class="titulo-noticia-small">
                <?php echo $data['post_titulo']; ?><?php if ($data['post_status'] != 'publicado') {echo ' | ' . $data['post_status'];} ?> | <small><?php echo date('d.m.y' ,strtotime($data['post_timestamp']) ); ?></small>
            </h1>
            <p>
                <?php if ( $data['post_resumen'] != '' ) {
                    echo $data['post_resumen'];
                } ?>
            </p>
            <p class="links-edicion-noticias">
                <?php 
                if ( $data['post_type'] == 'galerias' ) {
                    $url = 'index.php?admin=editar-galerias&id=' . $data['post_ID'];
                }
                else if ( $data['post_type'] == 'celebrities' ) {
                    $url = 'index.php?admin=editar-celebrities&id=' . $data['post_ID'];
                } else {
                    $url = 'index.php?admin=editar-posts&id=' . $data['post_ID'];
                }
                ?>
                <a href="<?php echo $url; ?>" title="Editar" class="btn-edit-news">
                    Editar
                </a>
                <!--|DEBERIA CAMBIAR EL URL CUANDO ESTE LISTO <a href="<?php echo MAINURL .'/noticias/'. $data['post_url']; ?>" target="_blank" title="Ver">Ver</a>-->
                | <a href="<?php echo $data['post_ID']; ?>" class="btn-delete-post">Borrar</a>
            </p>
            
            
        </div>
    </article>
</li>