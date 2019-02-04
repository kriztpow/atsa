<?php
/*
 * Lista la liga, al abrir cada una se puede editar
 * Since 3.0
 * 
*/
load_module( 'deportes' );
$ligas = getLigas();
?>
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Liga
	</h1>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="nav-noticias-interno">
					<label>Filtrar por deporte</label>
					<select name="post_categoria" id="post_categoria" data-filtro="liga">
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
		</div><!-- // row -->
		
		<div class="row">
			<div class="col">
				<ul class="loop-noticias-backend">
				
				<?php if( $ligas == null ) : ?>

					<li style="padding: 5rem 0">
						<p>Todavía no hay ninguna liga cargada, <a type="button" href="index.php?admin=editar-liga">¿Empezamos?</a></p>
					</li>
		
				<?php else : 

					foreach ( $ligas as $liga ) {
						getTemplate( 'loop-liga', $liga );
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
	<a type="button" href="index.php?admin=editar-liga" class="btn">Agregar nueva</a>
</footer>