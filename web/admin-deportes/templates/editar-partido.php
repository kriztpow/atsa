<?php
/*
 * Editar posts / Nueva posts
 * Since 3.0
 * 
*/
require_once("inc/functions.php");
load_module( 'deportes' );

//recupera id a buscar
$postId = isset($_GET['id']) ? $_GET['id'] : null;
$post = null;
$nuevo = true;


if ( $postId != null ) {
	$post = getPostsFromDeportesById( $postId, 'partidos' );
	$nuevo = false;
}

$equipoBase = array(
    'id' => '',
    'nombre' => 'Titulo Equipo',
    'logo' => 'logo-equipo-default.png',
);

//puntuacion y score
//la puntuación es para el voley u otros deportes
$puntuacion = explode(',', $post['puntuacion'] );
//el score se realiza buscando los id de los goles en el partido
$score = array('0','0');

//si hay equipos hay que buscarla data de cada uno
if ( $post['equipos_id'] != '' ) {
    $equipos = explode(',', $post['equipos_id']);
    
    //cargamos la variables del equipo con
    if ( isset($equipos[0]) && $equipos[0] != '' ) {
        $equipoData1 = getPostsFromDeportesById( $equipos[0], 'equipos' );
    } else {
        $equipoData1 = $equipoBase;
    }
    
    if ( isset($equipos[1]) && $equipos[1] != '' ) {
        $equipoData2 = getPostsFromDeportesById( $equipos[1], 'equipos' );

    } else {
        $equipoData2 = $equipoBase;
    }

    $equipos = array( $equipoData1, $equipoData2);

} else {
    //si no hay equipos, muestramos una base para editarlos
    $equipos = array( $equipoBase, $equipoBase);
}                

?>
<!---------- editar  ---------------->
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		<?php if ( $postId == null ) {
		echo 'Agregar nuevo';
	} else {
		echo 'Editar';
	} ?>
	</h1>
	<div class="container">
		<form method="POST" id="editar-partido-form" name="editar-partido-form">
		<input type="hidden" name="post_ID" value="<?php echo ($post) ? $post['id'] : 'new'; ?>">
        <input type="hidden" name="equipos_id" value="<?php echo ($post) ? $post['equipos_id'] : ''; ?>">
        <input type="hidden" name="puntuacion" value="<?php echo ($post) ? $post['puntuacion'] : ''; ?>">
        <input type="hidden" name="goles" value="<?php echo ($post) ? $post['goles_id'] : ''; ?>">
        <input type="hidden" name="amonestaciones" value="<?php echo ($post) ? $post['amonestaciones_id'] : ''; ?>">
		<input type="hidden" name="action" value="editar-partido">
			<div class="error-msj-wrapper">
				<ul class="error-msj-list">
					
				</ul>
            </div>
            
            <div class="row">
                <div class="col-30">
                    <div class="form-group">
                        <label for="post_categoria">Deporte </label>
                        <select name="post_categoria" id="post_categoria">
                            <option value="">Seleccionar...</option>
                            <?php 
                                $deportes = getDeportesList();
                                if ( $deportes!=null ) :

                                    for ($i=0; $i < count($deportes); $i++) { ?>
                                        <option value="<?php echo $deportes[$i]['id']; ?>"<?php if ( $post && $post['deporte_id'] == $deportes[$i]['id'] ) { echo ' selected'; } ?>><?php echo $deportes[$i]['nombre']; ?></option>
                                    <?php }

                                endif;
                            ?>	
                        </select>
                    </div>
                </div><!-- // col -->

                <div class="col-30">
                    <div class="form-group">
                        <label for="liga_id">Liga </label>
                        <select name="liga_id" id="liga_id">
                            <option value="">Seleccionar...</option>
                            <?php 
                                $ligas = getLigas();
                                if ( $ligas!=null ) :

                                    for ($i=0; $i < count($ligas); $i++) { ?>
                                        <option value="<?php echo $ligas[$i]['id']; ?>"<?php if ( $post && $post['liga_id'] == $ligas[$i]['id'] ) { echo ' selected'; } ?>><?php echo $ligas[$i]['nombre']; ?></option>
                                    <?php }

                                endif;
                            ?>	
                        </select>
                    </div>
                </div><!-- // col -->
                <div class="col-30">
                    <div class="form-group">
                        <label for="zona_id">Zona </label>
                        <select name="zona_id" id="zona_id">
                            <option value="">Seleccionar...</option>
                            <?php 
                                $zonas = getZonas('liga_id="'.$post['liga_id'].'"');
                                if ( $zonas!=null ) :

                                    for ($i=0; $i < count($zonas); $i++) { ?>
                                        <option value="<?php echo $zonas[$i]['id']; ?>"<?php if ( $post && $post['zona_id'] == $zonas[$i]['id'] ) { echo ' selected'; } ?>><?php echo $zonas[$i]['nombre_interno']; ?></option>
                                    <?php }

                                endif;
                            ?>	
                        </select>
                    </div>
                </div><!-- // col -->
            </div><!-- // row -->
            
            <div class="row">
                <div class="col-50">
                    <div class="form-group">
                        <label for="nombre_equipo" class="larger-label">Fecha </label>
                        <input id="fecha" name="fecha" type="date" class="larger-input date-partido-input" value="<?php echo ($post) ? $post['fecha'] : ''; ?>">
                    </div>
                </div>
            </div><!-- //row -->

			<div class="row">

            <?php 
            $counter = 0;
            foreach ($equipos as $equipo ) {
                if ( $equipo['logo'] == '') {
                    $imagen = 'logo-equipo-default.png';
                } else {
                    $imagen = $equipo['logo'];
                }
                ?>
                    
                <div class="col-50">
                    <article class="equipo-wrapper" data-id="<?php echo $equipo['id']; ?>">
                        
                        <div class="row <?php if ($counter != 0 ) { echo ' equipo-der'; } ?>">
                            <div class="col-20">
                                <div id="imagen_destacada_wrapper" class="form-group"> 
                                    <img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen; ?>" class="logo-equipos">
                                </div>
                            </div><!-- // col -->

                            <div class="col-60">

                                <h1 class="nombre_equipo">
                                    <?php echo $equipo['nombre']; ?>
                                </h1>
                                
                                <button type="button" class="btn btn-danger btn-edit-equipo">
                                    Cambiar
                                </button>

                            </div><!-- // col -->

                            <div class="col-20">
                                <div class="wrapper-puntuacion">
                                    <h3 class="score"><?php echo $score[$counter]; ?></h3>
                                </div>
                            </div><!-- // col -->

                            <div class="col">
                                <div class="wrapper-goles">
                                    <h2>
                                        Goles
                                    </h2>
                                    <ul class="goles <?php if ($counter != 0 ) { echo ' equipo-data-der'; } ?>">
                                        <li data-id-gol data-id-jugador>
                                            Juan Carlos Mesa
                                            <button class="btn del-gol" type="button">
                                                <img class="img-responsive" src="<?php echo URLADMINISTRADOR . '/assets/images/ios-trash.png'?>" alt="del-icon">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="wrapper-amonestaciones">
                                    <h2>
                                        Amonestaciones
                                    </h2>
                                    <ul class="amonestaciones <?php if ($counter != 0 ) { echo ' equipo-data-der'; } ?>">
                                        <li data-id-amonestacion data-id-jugador>
                                            <span class="jugador">Juan Carlos Mesa</span> <span class="tipo-amonestacion">Amarilla</span>
                                            <button class="btn del-amonestacion" type="button">
                                                <img class="img-responsive" src="<?php echo URLADMINISTRADOR . '/assets/images/ios-trash.png'?>" alt="del-icon">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>

                        </div><!-- // row -->
                    
                    </article>
                </div><!-- // col -->

            <?php
            $counter++;
            }//foreach ?>

            </div><!-- // row -->
            
            
            <div class="row wrapper-buttons">
                <div class="col">
                    <button type="button" class="btn btn-danger btn-add-gol">
                        Agregar gol
                    </button>
                    <button type="button" class="btn btn-danger btn-add-amonestacion">
                        Agregar amonestación
                    </button>
                    
                    <?php if ( $post['contenido_id'] == '' ) : ?>

                    <a href="index.php?admin=editar-post&partido=<?php echo $postId; ?>" target="_blank" class="btn btn-primary add-contenido">
                        Agregar contenido
                    </a>

                    <?php else : ?>
                        <a href="index.php?admin=editar-post&partido=<?php echo $postId; ?>" target="_blank" class="btn btn-primary add-contenido">
                            Editar contenido
                        </a>
                        <button type="button" data-contenido="<?php echo $post['contenido_id']; ?>" class="btn btn-primary btn-del-contenido">
                            Eliminar contenido
                        </button>
                    <?php endif; ?>
                    
                </div><!-- // col -->
            </div><!-- // row -->

			<hr>
		   	<div class="row">	
				<div class="col">
				   	<div class="form-group save-button-right">
				   		<button type="submit" name="submit_save" class="btn btn-primary btn-submit">Guardar Cambios</button>
				   	</div>
				</div><!-- // col -->
			</div><!-- // row -->  
		</form>	
	</div><!-- // container gral modulo -->
</div>
<div id="dialog">
	
</div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
    <a type="button" href="index.php?admin=partidos" class="btn">Volver a lista</a>
	<a type="button" href="index.php?admin=editar-partido" class="btn">Agregar nuevo</a>
</footer>