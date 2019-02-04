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
	$post = getPostsFromDeportesById( $postId, 'equipos' );
	$nuevo = false;
}

?>
<!---------- editar  ---------------->
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		<?php if ( $postId == null ) {
		echo 'Agregar nueva';
	} else {
		echo 'Editar';
	} ?>
	</h1>
	<div class="container">
		<form method="POST" id="editar-equipo-form" name="editar-equipo-form">		
		<input type="hidden" name="post_ID" value="<?php echo ($post) ? $post['id'] : 'new'; ?>">
        <input type="hidden" name="jugadores_id" value="<?php echo ($post) ? $post['jugadores_id'] : ''; ?>">
		<input type="hidden" name="action" value="editar-equipo">
			<div class="error-msj-wrapper">
				<ul class="error-msj-list">
					
				</ul>
			</div>
			
			<div class="row">
                <div class="col-20">
                    <div id="imagen_destacada_wrapper" class="form-group">
						<input type="hidden" id="logo" name="logo" value="<?php echo ($post) ? $post['logo'] : ''; ?>">
						<?php 
							if ( $post['logo'] == '' ) { 
                                $imagen = URLADMINISTRADOR . '/assets/images/logo.png';
						} else {
                            $imagen = UPLOADSURLIMAGES .'/'. $post['logo'];
                         } ?>
                        
                        <img src="<?php echo $imagen; ?>" class="logo-equipos">
                        <button type="button" class="btn btn-danger btn-change-logo-equipos">cambiar imagen</button>
					</div>
                </div><!-- // col -->
                
                <div class="col-80">
                    <div class="row">
                        <div class="col-70">

                            <div class="form-group">
                                <label for="post_title" class="larger-label">Nombre </label>
                                <input id="post_title" name="post_title" class="larger-input" value="<?php echo ($post) ? $post['nombre'] : ''; ?>">
                            </div>

                            </div><!-- // col -->

                            <div class="col-30">
                            <div class="form-group">
                                <label for="post_url">Personalizar Url </label>
                                <input id="post_url" name="post_url" value="<?php echo ($post) ? $post['slug'] : ''; ?>">
                            </div>
                            </div><!-- // col -->
                    </div><!-- // row -->

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
                </div><!-- // col -->

            </div><!-- // row -->
        
            
            <div class="row">
                <div class="col">
					<h2>Jugadores</h2>

					<button type="button" class="btn btn-primary" id="agregar-jugador-btn">Agregar jugador</button>
                    <table class="tabla-jugadores">
                        
                        <?php if ( $post['jugadores_id'] == '' ) :
                        //no hay jugadores,
                        $jugadores = null;
                        
                        else :

                            $jugadores = $post['jugadores_id'];
                            $jugadores = explode(',', $jugadores);
                            
                            foreach ( $jugadores as $jugador ) {
                                $dataJugador =  getPostsFromDeportesById( $jugador, 'jugadores' );
                                getTemplate('loop-jugadores', $dataJugador);
                                
                            }
                            
                        endif; ?>

                    </table>
					
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
    <a type="button" href="index.php?admin=equipos" class="btn">Volver a lista</a>
	<a type="button" href="index.php?admin=editar-equipo" class="btn">Agregar nueva</a>
</footer>