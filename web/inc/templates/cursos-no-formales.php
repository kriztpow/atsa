<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS-FORMALES-NO-FORMALES.PHP
 * Pagina que muestra los cursos no formales
*/


?>
<article id="formales-no-formales" class="wrapper-page less-padding">
	<div class="container">
	    <h1>Cursos no formales</h1>
	    <div class="row">
	    	<div class="col-md-8">
	    		<p>
	    			En nuestra Sede Central brindamos Cursos no Formales, los cuales incluyen material.
	    		</p>
	    		
	    		
	    <!----------lista de cursos -------->
	    		<div id="accordion-cursos-no-formales">

	    		<?php
	    		$connection = connectDB();
				$tabla = 'cursos';
				$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='no_formal' ORDER by curso_orden ";
					
				$result = mysqli_query($connection, $query);
				
				if ( $result->num_rows == 0 ) {
					echo 'No hay ningún curso cargado';
				} else {
					while ($row = $result->fetch_array()) {
	    		?>
			   		<h3>
			   			<span class="text-title-accordion">
			   			<?php echo $row['curso_titulo']; ?>
			   			<span class="icon-suma"></span>
			   			</span>
			   		</h3>
			   		<div class="contenido-accordion-cursos-no-formales">
			   			<ul>
							<li class="info-enfermeria">
								<span class="icon-info icon-info-3"></span>
								<?php echo $row['curso_lugar']; ?>
							</li>
							<li class="info-enfermeria">
								<span class="icon-info icon-info-6"></span>
								<?php echo $row['curso_horarios']; ?>
							</li>
							<?php if ( $row['curso_archivo'] != '' ) { ?>
							<li class="info-enfermeria">
							<p>Conocé el programa completo haciendo clic&nbsp;<a href="../uploads/pdfs/<?php echo $row['curso_archivo']; ?>" target="_blank" rel="noopener">aquí</a>.&nbsp;</p>								
							</li>
							<?php } ?>
						</ul>
					</div>
				<?php }//while 
				}//else
				mysqli_close($connection);
				?>
			   	</div><!-- //#accordion -->
	    	</div><!-- //.col-md-6 -->
	    	
	    	<div class="col-md-4">
	    		<img class="img-responsive" src="uploads/images/enfermeria.jpg">
	    		<div>
	    			<h2 class="info-enfermeria"><span class="icon-info icon-info-1"></span>
	    				Información General
	    			</h2>

	    			<ul>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-2"></span>
	    					<strong>Requisitos de inscripción:</strong><br>
	    					DNI Original y copia<br>
	    					Recibo de sueldo<br>
	    					Carnet sindical
	    				</li>
	    				<li class="info-enfermeria"><span class="icon-info icon-info-6"></span>
	    					Horarios de Atencion:<br>
	    					10 a 18hs.
	    				</li>
	    			</ul>
	    		</div>
				<div class="info-inscripciones">
	    			<h2>
	    				Inscripciones
	    			</h2>

	    			<p>
	    				Saavedra 166. ATSA,<br> Secretaría de Cultura, PB.<br>
	    				Horario de Atención: 10 a 18 horas
	    			</p>
	    		</div>
	    	</div><!-- //.col-md-6 -->
	    </div><!-- //.row -->
	</div><!-- //.container -->
</article>
<script src="js/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
    	$( "#accordion-cursos-no-formales" ).accordion();
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