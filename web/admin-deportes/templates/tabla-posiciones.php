<?php
/*
 * Lista los post
 * Since 3.0
 * 
*/
load_module( 'deportes' );
//$posts = getPosts( 'post', POSTPERPAG, '', 'fecha', 'all' );
?>
<!---------- noticias ---------------->
<div class="contenido-modulo">
	<h1 class="titulo-modulo">
		Tabla de posiciones
	</h1>
	<div class="container">
        
		<div class="row">
			<div class="col">
				<div style="margin-bottom: .5rem;" class="nav-noticias-interno">
					<label>Seleccionar liga</label>
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
					<label>Seleccionar Zona <small>(opcional)</small></label>
					<select name="post_zona" id="post_zona" data-filtro="equipos-zonas">
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

                <div class="nav-noticias-interno">
                    <button id="btn-posiciones" class="btn btn-danger">Ver posiciones</button>
                </div>
                
			</div>
		</div><!-- // row -->

		<div class="row">
			<div class="col">
                <div class="wrapper-tabla-posiciones">
                    
                </div>
        	</div><!-- // col -->
        </div><!-- // row -->
    	
	</div><!-- // container gral modulo -->
</div><!-- // container -->
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>

<!---------- fin noticias ---------------->