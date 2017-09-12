<article id="beneficios" class="wrapper-page less-padding">

	<h1 class="main-title-beneficios">Beneficios para el afiliado</h1>

	<ul class="lista-beneficios container-fluid">
		<!-- .beneficio -->

	<?php 
		$connection = connectDB();
		$tabla = 'beneficios';
		
		//queries según parámetros 
		$query  = "SELECT * FROM " .$tabla. " ORDER by beneficio_orden";	
		$result = mysqli_query($connection, $query);
		
		if ( $result->num_rows == 0 ) { 
		
			echo 'No hay nada cargado';
		
		} else {
			while ($row = $result->fetch_array()) {
				$beneficioID = $row['beneficio_ID'];
				$beneficioTitulo = $row['beneficio_titulo'];
				$beneficioIncluye = $row['beneficio_incluye'];
				$beneficioTexto = $row['beneficio_texto'];
				$beneficioImagen = $row['beneficio_imagen'];
				$beneficioOrden = $row['beneficio_orden'];
				
				
	?>
		<li>
			<article class="beneficio-item">
				<div class="row">
					<div class="col-sm-2 beneficio-imagen hidden-xs">
						<img src="uploads/images/<?php echo $beneficioImagen; ?>" class="img-responsive">
					</div>
					<div class="data-beneficio col-sm-10">
						<h1><?php echo $beneficioTitulo; ?></h1>
						<?php if ( $beneficioIncluye != '' ) { ?>
							<h3><strong>Incluye</strong>: <?php echo $beneficioIncluye; ?></h3>
						<?php } ?>
						<h2>Requisitos para acceder al beneficio</h2>
						<div class="requisitos-beneficios-lista">
							<?php echo $beneficioTexto; ?>
						</div>
					</div><!-- //.col .data-beneficio -->
				</div><!-- //.row -->
			</article>
		</li><!-- //.beneficio -->

	<?php }//while 
	}//else
	mysqli_close($connection);
	?>
	</ul>
</article>