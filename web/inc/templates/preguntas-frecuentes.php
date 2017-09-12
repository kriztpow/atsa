<article id="preguntas" class="wrapper-page less-padding">
	<h1 class="sr-only">Preguntas Frecuentes</h1>

	<?php 
		$connection = connectDB();
		$tabla = 'preguntas';
		
		//queries según parámetros 
		$query  = "SELECT * FROM " .$tabla. " ORDER by pregunta_orden";	
		$result = mysqli_query($connection, $query);
		
		if ( $result->num_rows == 0 ) { 
		
			echo 'No hay nada cargado';
		
		} else {
			while ($row = $result->fetch_array()) {
				$preguntaID = $row['pregunta_ID'];
				$preguntaTitulo = $row['pregunta_titulo'];
				$preguntaTexto = $row['pregunta_texto'];
				$preguntaImagen = $row['pregunta_imagen'];
				$preguntaOrden = $row['pregunta_orden'];
	?>

	<div class="title-preguntas-frecuentes">
		<span class="icon-preguntas-frecuentes" style="background-image: url(/uploads/images/<?php echo $preguntaImagen; ?>)"></span>
		<h2>
			<?php echo $preguntaTitulo; ?>
		</h2>
	</div>

	<div class="container-fluid parrafo-preguntas-frecuentes">
		<?php echo $preguntaTexto; ?>
	</div>

	<?php }//while 
	}//else
	mysqli_close($connection);
	?>

</article>