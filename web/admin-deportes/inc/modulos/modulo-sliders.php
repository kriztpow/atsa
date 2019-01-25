<?php 
/*
MUESTRA LA LISTA DE SLIDERS CREADOS
*/

function listaSliders () {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by slider_ubicacion desc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div class="error-tag">Todavía no hay ninguno cargado</div>';
	} else {

		while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}//while

		$ubicaciones = array();

		foreach ($rows as $row ) {
			 array_push($ubicaciones, $row['slider_ubicacion']);
		}//foreach

		$ubicaciones = array_unique($ubicaciones);
		sort($ubicaciones);
		
		for ($i=0; $i < count($ubicaciones); $i++) { 
			if ( $ubicaciones[$i] != '' ) {	?>
			<li class="list-sliders-slider">
				<a class="btn-edit-slider btn btn-lg btn-default" href="index.php?admin=editar-slider&slug=<?php echo $ubicaciones[$i]; ?>">
					<?php echo $ubicaciones[$i]; ?>
				</a>
			</li>
			<?php }
		}
		
	}//else 
	
	closeDataBase($connection);

} //listaSliders()

/*
ABRE EL EDITOR DE SLIDERS PARA MODIFICARLOS
*/

function getSliderAdmin ( $slug ) {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_ubicacion='".$slug."' ORDER by slider_orden asc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		$rows = null;
	} else {
		
		while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}//while
		
	}//else 

	closeDataBase($connection);

	return $rows;

} //showSliderToEdit()

//recupera un item por el id
function getSliderId ($id) {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_id='".$id."'";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		$row = null;
	} else {
		
		$row = $result->fetch_array();
				
		
	}//else 

	closeDataBase($connection);

	return $row;
}