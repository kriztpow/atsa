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
	$post = getPostsFromDeportesById( $postId, 'liga' );
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
		<form method="POST" id="editar-liga-form" name="editar-liga-form">		
		<input type="hidden" name="post_ID" value="<?php echo ($post) ? $post['id'] : 'new'; ?>">
		<input type="hidden" name="zonas_id" value="<?php echo ($post) ? $post['zonas_id'] : ''; ?>">
		<input type="hidden" name="action" value="editar-liga">
			<div class="error-msj-wrapper">
				<ul class="error-msj-list">
					
				</ul>
			</div>
			
			<div class="row">
				<div class="col-40">

					<div class="form-group">
						<label for="post_title" class="larger-label">Nombre </label>
						<input id="post_title" name="post_title" class="larger-input" value="<?php echo ($post) ? $post['nombre'] : ''; ?>">
                    </div>	
                    
                </div><!-- // col -->
                
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
						<label for="post_url">Personalizar Url </label>
						<input id="post_url" name="post_url" value="<?php echo ($post) ? $post['slug'] : ''; ?>">
					</div>
                </div><!-- // col -->
			</div><!-- // row -->
            
            <div class="row">
                <div class="col">
					<h2>Zonas</h2>

					<button type="button" class="btn btn-primary" id="agregar-zona-btn">Agregar zona</button>

					<div class="wrapper-zonas">
						<div class="zonas">

							<?php if ( $post['zonas_id'] == '' ) :
							//no hay zona cargada, tiene que generar una por defecto
							$zona = null;
							getTemplate('loop-zona', $zona);
							
							else :

								$zonas = $post['zonas_id'];
								$zonas = explode(',', $zonas);
								
								foreach ( $zonas as $zona ) {
									$dataZona =  getPostsFromDeportesById( $zona, 'zonas' );
									getTemplate('loop-zona', $dataZona);
								}
								
							endif; ?>

						</div><!-- // zonas -->
						<p>Los partidos se listan aquí una vez que fueron creados desde el <a href="index.php?admin=partidos">administrador de partidos</a>.</p>
					</div><!-- // wrapper-zonas -->
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
    <a type="button" href="index.php?admin=liga" class="btn">Volver a lista</a>
	<a type="button" href="index.php?admin=editar-liga" class="btn">Agregar nueva</a>
</footer>