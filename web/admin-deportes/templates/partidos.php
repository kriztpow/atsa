<?php
/*
 * Lista la liga, al abrir cada una se puede editar
 * Since 3.0
 * 
*/
load_module( 'deportes' );
$liga = isset($_GET['liga']) ? $_GET['liga'] : '';
$zona = isset($_GET['zona']) ? $_GET['zona'] : '';
if ( $liga != '') {
	$filtro ='liga_id="'.$liga.'"';
}

$partidos = getPartidos();
?>
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Partidos
	</h1>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="nav-noticias-interno">
					<label>Filtrar por deporte</label>
					<select name="post_deportes" id="post_deportes" data-filtro="partidos">
						<option value="todas">Todas</option>
						<?php 
							$deportes = getDeportesList( );
							if ( $deportes!=null ) :

								for ($i=0; $i < count($deportes); $i++) { 
									echo '<option value="'.$deportes[$i]['id'].'">'.$deportes[$i]['nombre'].'</option>';
								}

							endif;
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div style="margin-bottom: .5rem;" class="nav-noticias-interno">
					<label>Filtrar por liga</label>
					<select name="post_liga" id="post_liga" data-filtro="zonas-by-liga">
						<?php 
							echo '<option value="todas">Todas</option>';

							
							$filtro = 'liga_id="'.$liga.'"';
							$ligas = getLigas();	

							if ( $ligas!=null ) {

								for ($i=0; $i < count($ligas); $i++) { 
									echo '<option value="'.$ligas[$i]['id'].'">'.$ligas[$i]['nombre'].'</option>';
								}

							}
							 
						?>
					</select>
				</div>

				<div class="nav-noticias-interno">
					<label>Filtrar por Zona</label>
					<select name="post_zona" id="post_zona" data-filtro="partidos-zonas">
						<?php 
							if ($liga != '') {
								$filtro = 'liga_id="'.$liga.'"';
								$zonas = getZonas($filtro);
								
								echo '<option value="todas">Todas</option>';

								if ( $zonas!=null ) {

									for ($i=0; $i < count($zonas); $i++) { 
										echo '<option value="'.$zonas[$i]['id'].'">'.$zonas[$i]['nombre_interno'].'</option>';
									}

								}
							} else {
								echo '<option value="">Seleccionar Liga</option>';
							}
						?>
					</select>
				</div>
			</div>
		</div><!-- // row -->
		
		<div class="row">
			<div class="col">
				<ul class="loop-noticias-backend">
				
				<?php if( $partidos == null ) : ?>

					<li style="padding: 5rem 0">
						<p>Todavía no hay ningun partido cargado, <a type="button" href="index.php?admin=editar-partido">¿Empezamos?</a></p>
					</li>
		
				<?php else : 

					foreach ( $partidos as $partido ) {
						getTemplate( 'loop-partido', $partido );
					} 
					
				endif; ?>

				</ul>
			</div>

		</div><!-- // row gral modulo -->

	</div><!-- // container gral modulo -->
</div><!-- // wrapper interno modulo -->

<div id="dialog"></div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
	<a type="button" href="index.php?admin=editar-partido" class="btn">Agregar nuevo</a>
</footer>