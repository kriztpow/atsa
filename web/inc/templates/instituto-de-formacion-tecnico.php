<article id="formacion-tecnico-profesional" class="wrapper-page less-padding">
	<div class="container">
		<div class="title-deco-guion">
		    <h1 class="title-azul">
		    	Instituto de Formación Técnico Profesional
		    </h1>
	    </div>
	    <p class="weight-medium p-text-center">
	    	Desde ATSA Bs As apostamos constantemente a la formación y actualización de nuestros compañeros con el fin de mejorar la calidad de nuestra actividad así como la seguridad de nuestros pacientes. En tal sentido, construimos el Instituto de Formación Técnico Profesional, un edificio exclusivo para la capacitación y perfeccionamiento de los trabajadores.El Instituto cuenta con un Laboratorio de Simulación con herramientas de última tecnología, el cual ofrece múltiples maneras de representar y analizar el entorno de trabajo. Esta reproducción del entorno real permite facilitar la toma de decisiones, haciendo hincapié en determinados aspectos y evitando la incertidumbre. Creemos que los avances científicos-tecnológicos nos desafían constantemente y por eso acompañamos a nuestros compañeros aportando las herramientas y espacios necesarios para que sigan creciendo. 
	    </p>
	</div>

	<section class="background-gris mini-padding-section">
		<div class="container">
			<div class="title-sin-guion">
			    <h2 class="title-azul">
					¿Dónde se encuentra el instituto de Formación Técnico Profesional
				</h2>
		    </div>

			<p class="weight-medium p-text-center">
				El edificio se encuentra en la calle Alsina, a la vuelta del Sindicato. Cuenta con 5 pisos con aulas, laboratorio de simulación y todo lo necesario para que los trabajadores de Sanidad estén al día con su profesión. La Inauguración se realizará en el mes de Julio.
			</p>
		</div>
	</section>

	<section class="mini-padding-section">
		<div class="container">
			<div class="title-deco-guion">
			    <h2 class="title-azul">
					¿Qué cursos se brindan?
				</h2>
		    </div>

			<ul class="row loop-cursos-formacion-tecnica">
				
			<?php 
				$connection = connectDB();
				$tabla = 'cursos';
				$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='formacion_tecnica' ORDER by curso_orden ";
					
				$result = mysqli_query($connection, $query);
				
				if ( $result->num_rows == 0 ) {
					echo '<div>No hay ningún curso cargado</div>';
				} else {
					while ($row = $result->fetch_array()) {
						
			?>
				<li class="col-lg-3 col-md-4 col-sm-6">
					<article class="curso-formacion-tecnica">
						<img src="uploads/images/<?php echo $row['curso_imagen']; ?>" alt="Cursos ATSA">
						<?php if ( $row['curso_destacado'] != '0' ) {
							echo '<span class="nuevo-curso"></span>';
						} ?>
						<h1><?php echo $row['curso_titulo']; ?></h1>
						<p>
							<?php echo $row['curso_resumen']; ?>
						</p>
						<a href="/curso/<?php echo $row['curso_slug'] ?>">Más información</a>
					</article><!-- //curso -->
				</li><!-- //.col-md-3 .col-sm-6 -->
			<?php }//while
				}//else
				mysqli_close($connection);
			?>
			</ul><!-- //.row -->

		</div><!-- //.container -->
	</section>
</article>