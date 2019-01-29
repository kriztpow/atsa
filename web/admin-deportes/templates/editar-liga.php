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

					<button class="btn btn-primary agregar-equipo-btn">Agregar zona</button>

					<div class="wrapper-zonas">
						<div class="zonas">
							<div class="zona">
								<div class="data-zona">
									<input type="hidden" class="zona-id" value="new">
									<input type="hidden" class="nombre" value="">
									<input type="hidden" class="nombre_interno" value="">
									<input type="hidden" class="slug" value="">
									<input type="hidden" class="liga_id" value="new">
									<input type="hidden" class="partidos_id" value="">
									<input type="hidden" class="equipos_id" value="">
								</div>
								<h2 class="title-zona">
									Zona A
								</h2>

								<h4 class="title-mini">
									Partidos:
								</h4>
								<ul class="lista-partidos">
									<li data_id="id">
										<a data_id="id" href="index.php?admin=editar-partido&id=" target="_blank">
											<span class="equipo1" data-id="id">Equipo 1</span>
											vs 
											<span class="equipo2" data-id="id">Equipo 2</span>
										</a>
									</li>
									<li data_id="id">
										<a data_id="id" href="index.php?admin=editar-partido&id=" target="_blank">
											<span class="equipo1" data-id="id">Equipo 1</span>
											vs 
											<span class="equipo2" data-id="id">Equipo 2</span>
										</a>
									</li>
									<li data_id="id">
										<a data_id="id" href="index.php?admin=editar-partido&id=" target="_blank">
											<span class="equipo1" data-id="id">Equipo 1</span>
											vs 
											<span class="equipo2" data-id="id">Equipo 2</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div><!-- // wrapper-zonas -->
                </div><!-- // col -->
			</div><!-- // row -->
			
			<div class="row">
                <div class="col">
					<h2>Equipos</h2>
					<button class="btn btn-danger agregar-equipo-btn">Agregar equipo</button>
					<div class="wrapper-equipos">
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