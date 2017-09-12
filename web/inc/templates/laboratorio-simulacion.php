<article id="laboratorio" class="wrapper-page less-padding">
	<div class="container">
		<div class="title-deco-guion">
		    <h1 class="title-azul text-uppercase font-size-28pt">
		    	Laboratorio de Simulación
		    </h1>
	    </div>
	    <p class="p-text-center weight-medium font-size-14">
	    	La simulación clínica es una herramienta pedagógica que posibilita realizar de manera segura y controlada un entrenamiento en competencias profesionales y resolución de casos. La simulación es un puente entre la experiencia áulica y la experiencia clínica real. Estará abierta no solo a nuestras instituciones educativas, sino también a aquellas Instituciones de Salud que comprendan la importancia de la capacitación de sus trabajadores en la simulación.
	    </p>
	</div>

	<section class="background-gris mini-padding-section">
		<div class="container">
			<div class="title-deco-guion">
			    <h2 class="title-azul text-uppercase font-size-28pt">
					Misión
				</h2>
		    </div>

			<p class="p-text-center weight-medium font-size-14">
				Promover la actualización permanente de los trabajadores de la salud en las diversas situaciones que pueden presentarse en el ámbito laboral, como en la vida diaria, a fin de brindar seguridad al paciente y su familia.
			</p>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="objetivos-laboratorio">
				<h2>Objetivos</h2>
				<ul>
					<li>- Favorecer la adquisición de competencias clínicas y trabajo en equipo en escenarios cuasi reales.</li>
					<li>- Capacitar a los trabajadores y su familia en las técnicas de RCP.</li>
					<li>- Adquirir herramientas que permitan brindar una atención de salud integral, oportuna y de calidad al momento de enfrentar una situación real con un paciente. </li>
				</ul>
			</div>
			<div class="title-deco-guion">
			    <h2 class="title-azul font-size-18">
					Contamos con
				</h2>
		    </div>
			<ul class="laboratorio-lista-items row">

			<?php 
			$connection = connectDB();
			$tabla = 'laboratorio';
			
			//queries según parámetros 
			$query  = "SELECT * FROM " .$tabla. " ORDER by laboratorio_orden";	
			$result = mysqli_query($connection, $query);
			
			if ( $result->num_rows == 0 ) { 
			
				echo 'No hay nada cargado';
			
			} else {
				while ($row = $result->fetch_array()) {
					$laboratorioID = $row['laboratorio_ID'];
					$laboratorioTitulo = $row['laboratorio_titulo'];
					$laboratorioTexto = $row['laboratorio_texto'];
					$laboratorioImagen = $row['laboratorio_imagen'];
			?>

				<li class="col-md-6">
					<article class="laboratorio-item">
						<img src="uploads/images/<?php echo $laboratorioImagen; ?>">
						<h1>
							<?php echo $laboratorioTitulo; ?>
						</h1>
						<p>
							<?php echo $laboratorioTexto; ?>
						</p>
					</article>
				</li>

			<?php }//while 
			}//else
			mysqli_close($connection);
			?>

			</ul>
		</div>
	</section>
	
</article>