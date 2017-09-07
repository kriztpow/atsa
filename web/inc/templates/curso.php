<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS.PHP
 * Pagina que muestra los cursos
*/

//recupera la info del curso, la función que crea esa global se ejecuta en el index.php
global $dataCurso;

?>

<article id="cursos" class="wrapper-page less-padding">
    <div class="container">
    	<div class="title-deco-guion">
		    <h2 class="title-cursos">
		    	Instituto de Formación Técnico Profesional
		    </h2>
	    </div>

    	<div class="row">
	    	<div class="col-md-8">
		    	<h1 class="download-estudios">
		    		<?php echo $dataCurso['titulo']; ?>
		    	</h1>
		    	<div class="contenido-accordion-cursos">
		    		<strong>Metodología:</strong>
		    		<?php echo $dataCurso['metodologia']; ?>
		    	</div>

	    		<div id="accordion-cursos">
	    		<?php
	    			if ( $dataCurso['destinatarios'] != '' ) {
	    				?>
	    				<!-- item tab -->
					   		<!-- item tab -->
				   		<h3>
					  		<span class="text-title-accordion background-color">
						  		Destinatarios
						  	</span>
						  <span class="icon-suma"></span>
						</h3>
					  	<div class="contenido-accordion-cursos">
					  		<?php echo $dataCurso['destinatarios']; ?>
					  	</div><!-- //item tab -->
	    				<?php
	    			}
	    		?>
				   	<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion background-color">
					  		Objetivos Generales
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<p><?php echo $dataCurso['general']; ?></p>
				  	</div><!-- //item tab -->
				  	<?php 
				  	if ( $dataCurso['especifico'] != '' ) { ?>
				  	<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Objetivos Específicos
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<?php echo $dataCurso['especifico']; ?>
				  	</div><!-- //item tab -->
				  	<?php }//if ?>
				  	<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Requisitos
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<p><?php echo $dataCurso['requisitos']; ?></p>
				  	</div><!-- //item tab -->
			  	</div><!-- //#accordion-cursos -->
			</div><!-- //.col-md-8 -->


			<div class="col-md-4">
	    		<img class="img-responsive" src="uploads/images/<?php echo $dataCurso['imagen']; ?>">
	    		<div>
	    			<h2 class="info-enfermeria"><span class="icon-info icon-info-1"></span>
	    				<?php echo $dataCurso['certificado']; ?>
	    			</h2>

	    			<ul>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-3"></span>
	    					Cursada:<br>
	    					<?php echo $dataCurso['cursada']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-5"></span>
	    					Centro y Lugar donde se cursa<br>
	    					<?php echo $dataCurso['lugar']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>
	    					Horarios de cursada<br>
	    					<?php echo $dataCurso['horarios']; ?>
	    				</li>
	    			</ul>
	    		</div>
	    	</div><!-- //.col-md-4 -->

		</div><!-- //.row -->
		<div class="btn-mas-cursos-wrapper">
			<a href="/instituto-de-formacion-tecnico" class="btn-mas-cursos">ver más cursos</a>
		</div>
    </div><!-- //.container -->
</article>

<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-cursos" ).accordion({
    		heightStyle: "content"
    	});
		iconSumaOpener();
		
    	$('.ui-accordion-header').click(iconSumaOpener);//click
    	
    });//ready

function iconSumaOpener () {
	$('.ui-accordion-header').each(function(){
    		
		if ($(this).hasClass('ui-accordion-header-active')) {
			$('.icon-suma', this).addClass('icon-suma-open');
		} else {
			$('.icon-suma', this).removeClass('icon-suma-open');
		}
	});
}
	
</script>