<?php
$connection = connectDB();
	$tabla = 'cursos';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='instituto' ";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { 
	
		echo 'No hay nada cargado';
	
	} else { 
		$row = $result->fetch_array();

?>
<article id="instituto-amadeo-olmos" class="wrapper-page less-padding">
	<div class="container">
	    <h1>
	    	<?php echo $row['curso_titulo']; ?>
	    </h1>
	    <div class="row">
	    	<div class="col-md-8">
	    		<div id="accordion-enfermeria">

			   	<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Historia
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<?php echo $row['curso_metodologia']; ?>
				  	</div>
			   	<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Misión
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<?php echo $row['curso_objgeneral']; ?>
				  	</div>
			   	
				<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Prácticas profesionales
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<?php echo $row['curso_requisitos']; ?>
				  	</div>

				<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Autoridades
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
					  	<?php echo $row['curso_certificado']; ?>
				  	</div>

				<!-- item tab -->
			   		<h3>
				  		<span class="text-title-accordion">
					  		Cuerpo docente
					  	</span>
					  <span class="icon-suma"></span>
					</h3>
				  	<div class="contenido-accordion-cursos">
				  		<?php echo $row['curso_objespecifico']; ?>
				  	</div>

			   	</div><!-- //#accordion -->
			   	<a href="uploads/pdfs/<?php echo $row['curso_archivo']; ?>" target="_blank" class="download-estudios">
			  		<span class="text-title-accordion">
				  		Plan de estudios
				  	</span>
				  <span class="icon-pdf"></span>
				</a>
	    	</div><!-- //.col-md-6 -->
	    	
	    	<div class="col-md-4">
	    		<img class="img-responsive" src="uploads/images/<?php echo $row['curso_imagen']; ?>">
	    		<div>
	    			<h2 class="info-enfermeria"><span class="icon-info icon-info-1"></span>
	    				Información General
	    			</h2>

	    			<ul>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-2"></span>
	    					Titulación: <?php echo $row['curso_titulo']; ?><br>
	    					Rama del Conocimiento: <?php echo $row['curso_slug']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-3"></span>
	    					Duración de la carrera: <?php echo $row['curso_dataextra1']; ?><br>
	    					Tipo de enseñanza: <?php echo $row['curso_dataextra2']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-4"></span>
	    					Dependencia: <?php echo $row['curso_dataextra3']; ?><br>
	    					Plan de Titulación: <?php echo $row['curso_resumen']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-5"></span>
	    					Centro y Lugar donde se cursa<br>
	    					<?php echo $row['curso_lugar']; ?>
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>
	    					Horarios de cursada<br>
	    					<?php echo $row['curso_horarios']; ?>
	    				</li>
	    			</ul>
	    		</div>

	    		<div class="info-inscripciones">
	    			<h2>
	    				Inscripciones
	    			</h2>

	    			<?php echo $row['curso_destinatario']; ?>
	    		</div>

	    	</div><!-- //.col-md-6 -->
	    </div><!-- //.row -->

	    <blockquote class="cuote-enfermeria">
	    	<?php echo $row['curso_cursada']; ?>
	    </blockquote>
	</div><!-- //.container -->

	<?php }//else ?>

</article>
<aside>
	<?php
        getSliders( 'enfermeria' );
    ?>
</aside>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-enfermeria" ).accordion({
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