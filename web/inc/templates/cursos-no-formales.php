<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 2.0
 * CURSOS-FORMALES-NO-FORMALES.PHP
 * Pagina que muestra los cursos no formales
 * re diseño v 8.4, incluye contenido dinamico de pagina y otro estilo para mostrar los cursos
*/
$pagina = getPageData(6);
?>
<article id="cursos-no-formales" class="wrapper-page less-padding">
	<div class="container">
		<?php if ($pagina['page_titulo'] != '') : ?>
			<h1 class="titulo-pagina">
				<?php echo $pagina['page_titulo']; ?>
			</h1>
		<?php endif; ?>

		<div class="contenido-pagina">
			<?php echo $pagina['page_text']; ?>
		</div>
	</div><!-- //.container -->

	<div class="wrapper-cursos-no-formales">
		<div class="container">
			<ul class="row loop-cursos-formacion-tecnica">
			
			<?php
				$connection = connectDB();
				$tabla = 'cursos';
				$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='no_formal' ORDER by curso_orden ";
					
				$result = mysqli_query($connection, $query);
				
				if ( $result->num_rows == 0 ) {
					echo 'No hay ningún curso cargado';
				} else {
					while ($row = $result->fetch_array()) { ?>
					
					<li class="col-lg-3 col-md-4 col-sm-6">
						<article class="curso-formacion-tecnica">
						
							<?php if ($row['curso_imagen'] != '') : ?>
								
								<img src="uploads/images/<?php echo $row['curso_imagen']; ?>" alt="Cursos ATSA">

							<?php endif; ?>
							
							<h1>
								<?php echo $row['curso_titulo']; ?>
							</h1>
							<p>
								<?php echo $row['curso_objespecifico']; ?>
							</p>

							<?php if ($row['curso_archivo'] != '') : ?>
								
								<a href="<?php echo urlbase() . '/uploads/pdfs/' . $row['curso_archivo'] ?>" target="_blank">Conoce el Programa Aquí</a>

							<?php endif; ?>
							
						</article><!-- //curso -->
					</li><!-- //.col-md-3 .col-sm-6 -->

				<?php }//while 
				}//else
				mysqli_close($connection);
			?>
			</ul>
		</div><!-- //.container -->
	</div>

		
	<div class="wrapper-footer-cursos">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
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
				<div class="col-sm-6">
					<div class="info-inscripciones">
						<h2>
							Inscripciones
						</h2>

						<p>
							Saavedra 166. ATSA,<br> Secretaría de Cultura, PB
						</p>
					</div>

				</div><!-- //.col-md-6 -->
		
			</div><!-- //.row -->
		</div><!-- //.container -->
	</div>
</article>
