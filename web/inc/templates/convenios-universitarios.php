<article id="convenios-universitarios" class="wrapper-page less-padding">

    <div class="container">
		<div class="title-deco-guion">
		    <h1 class="title-azul">
		    	Convenios y Alianzas Universitarias
		    </h1>
	    </div>
	    <p class="convenios-info">
	    	Contamos con alianzas exclusivas con dos Universidades y una Fundación, a través de las cuales se brindan Licenciaturas, Cursos y Tecnicaturas.
	    </p>

		<div class="wrapper-cursos-no-formales">
			
			<div class="loop-cursos-formacion-tecnica">
			<?php
				$connection = connectDB();
				$tabla = 'cursos';
				$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='universitarios' AND curso_dataextra1='1' ORDER by curso_orden";
					
				$result = mysqli_query($connection, $query);
				
				if ( $result->num_rows == 0 ) {
					echo 'No hay ningún convenio cargado';
				} else {
					while ($row = $result->fetch_array()) {
					$categoria = $row['curso_ID'];
					
					?>
					
					<div class="universidad row">
						
						<figure class="col-sm-3">
						<?php if ($row['curso_imagen'] != '') : ?>
							
							<img class="img-responsive" src="uploads/images/<?php echo $row['curso_imagen']; ?>" alt="<?php echo $row['curso_titulo']; ?> - logo">

						<?php endif; ?>

						</figure>

						<div class="col-sm-9">
							<?php echo $row['curso_objespecifico']; ?>
						</div>

					</div><!-- //curso -->

					<!--loop de cursos por universidad -->

					<ul class="row loop-cursos-formacion-tecnica">
						<?php
							/*$connection = connectDB();
							$tabla = 'cursos';*/
							$query2  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='universitarios' AND curso_categoria='".$categoria."' ORDER by curso_orden";
								
							$result2 = mysqli_query($connection, $query2);
							
							if ( $result2->num_rows != 0 ) {
							
								while ($row2 = $result2->fetch_array()) { ?>
								
								<li class="col-lg-3 col-md-4 col-sm-6">
									<a href="/convenio/<?php echo $row2['curso_slug'] ?>">
									<article class="curso-formacion-tecnica convenio-universitario">
										<figure>
										<?php if ($row2['curso_imagen'] != '') : ?>
											
											<img src="uploads/images/<?php echo $row2['curso_imagen']; ?>" alt="Cursos ATSA">

										<?php endif; ?>

											<div class="shutter">
												<img src="<?php echo urlBase(); ?>/assets/images/open-icon.png">
											</div>

										</figure>

										<h1 class="titulo-curso">
											<?php echo $row2['curso_titulo']; ?>
										</h1>

										<div class="contenido-curso" style="display:none;">
											<?php echo $row2['curso_objespecifico']; ?>
										</div>

									</article><!-- //curso -->
									</a>
								</li><!-- //.col-md-3 .col-sm-6 -->

							<?php }//while 
							}//if
						?>
						</ul>

						<span class="separador-universidad"></span>

				<?php }//while 
				}//else
				mysqli_close($connection);
			?>
			</div>
		</div>

	    <h5 class="convenios-alert">
	    	<strong>Mas información</strong><br>
	    	Secretaría de Cultura al 4959-7100 (int 7117/55).
	    </h5>
	    
	</div>
</article>

<article id="modal-curso">
	<div class="wrapper-modal">
		<div class="contenedor-modal">
			<button class="close-button"></button>
				<div class="contenedor-interno">

					contenido dinámico
			</div>
		</div>
	</div>
</article>