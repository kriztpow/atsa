<?php
/*
 * Noticias recientes
 * Lista las noticias publicadas y con links para verlas, editarlas o publicarlas
 * Since 3.0
 * 
*/
require_once("inc/functions.php");

?>
<!---------- noticias ---------------->
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="nav-noticias-interno">
						<select name="post_categoria" id="post_categoria">
							<option value="todas">Todas</option>
							<option value="ATSA">ATSA</option>
							<option value="nacionales">Nacionales</option>
							<option value="internacionales">Internacionales</option>
						</select>
					</div>
				</div>
			</div><!-- // row -->
			<div class="row">
				<div class="col-sm-12">
				<ul class="loop-noticias-backend">
            		<?php listaNoticias(10, 'all', true, 'none', true); ?>
            		
            	</ul>
            	</div><!-- // col -->
            </div><!-- // row -->
        	<div class="row">
        		<div class="col-sm-12 ver-mas-noticias">
            		<button id="load-more" class="btn btn-success">Ver más</button>
            		<p class="loading-news-ajax"></p>
            	</div>
        	</div>
			
		</div><!-- // container gral modulo -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
            <a type="button" href="index.php?admin=editar-noticias" class="btn btn-warning">Agregar nueva</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div>
<!---------- fin noticias ---------------->