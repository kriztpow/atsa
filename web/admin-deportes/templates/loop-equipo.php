<?php 
$image = URLADMINISTRADOR . '/assets/images/logo.png';

if ( $data['logo'] != '' ) {
    $image = UPLOADSURLIMAGES . '/' . $data['logo'];
}
?>
<li class="loop-noticias-backend-item">
    <article class="row">
        <div class="col-10">
            <img class="logo-equipos" src="<?php echo $image; ?>" alt="logo equipo">
        </div>
        <div class="col-80">
            <h1 class="titulo-noticia-small">
                <?php echo $data['nombre']; ?>
            </h1>
            <p class="links-edicion-noticias">
                
                <a href="index.php?admin=editar-equipo&id=<?php echo $data['id']; ?>" title="Editar" class="btn-edit-news">
                    Editar
                </a>
                | <a href="<?php echo $data['id']; ?>" class="btn-delete-equipo">Borrar</a>
            </p>
            
        </div>
    </article>
</li>