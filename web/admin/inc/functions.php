<?php
/*
 * Modulo auto administrable
 * Since 2.0
 * Pagina de funciones
*/

//DEFINICIONES HEAD Y SCRIPTS
define ( 'SITENAME', 'ATSA' );
define ( 'DATEPUBLISHED', '2017');
define ('LOGOSITE' , 'assets/images/logo.png');
define ( 'SITETITLE', 'ATSA - Panel de control' );
define ( 'FAVICONICO', '../favicon.ico' );
// BASE DE DATOS
/*define("DB_SERVER", "localhost");
define("DB_USER", "dbuser");
define("DB_PASS", "123");
define("DB_NAME", "atsa");*/
//BASE DE DATOS ONLINE
define("DB_SERVER", "localhost");
define("DB_USER", "derechoc_coco");
define("DB_PASS", "d6m=fD1=ZqKt");
define("DB_NAME", "derechoc_lala");
//CARPETAS
define ( 'TEMPLATEDIR', dirname( __FILE__ ) . '/templates' );
define ( 'UPLOADS', dirname( __FILE__ ) . '/../../uploads' );
define ( 'UPLOADSIMAGES', dirname( __FILE__ ) . '/../../uploads/images' );
define ('UPLOADSURL', 'https://' . $_SERVER['HTTP_HOST'] . '/uploads');
define ('UPLOADSURLIMAGES', 'https://' . $_SERVER['HTTP_HOST'] . '/uploads/images');

/*
 * Funciones sin base de datos
*/

//busca el template $name = nombre del archivo sin extensión
function getTemplate ($name ) {

	include TEMPLATEDIR . '/'. $name. '.php';
}

//funcion renombrar archivo para que no se sobreescriba
function renombrar_archivo( $file, $slug ) {
	
	$extension = explode(".", $file );
	$no_aleatorio = rand(100, 999);
	$file = date('Y-m-d') . '-' .$no_aleatorio . '-' . $slug . '.' . end($extension);
	return $file;
}

/**
 * Checks if a request is a AJAX request
 * @return bool
 */
function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest');
}

/*
 * Funciones con base de datos
*/

//conección a base de datos y db específica
function connectDB () {
	global $connection;
	$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if( mysqli_connect_errno() ) {
    die("Database connection failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
  if (!mysqli_set_charset($connection, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($connection));
    exit();
	} else {
		mysqli_character_set_name($connection);
	}
  return $connection;
}

//cierre base de datos
function closeDataBase($connection){
    mysqli_close($connection);
}

/*
 * function mostrar contactos
*/
function printContactos ( $post_type ) {
	$connection = connectDB();
	$tabla = 'contacto';

	$query  = "SELECT * FROM " .$tabla. " WHERE form_type='".$post_type."' ORDER by fecha_de_envio desc";

	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo '<div class="alert alert-success" role="alert">Ningún email recibido</div>';
	} else {
		//arma lista de contactos

		//definir que formulario es
		if ( $post_type == 'reunion' ) {
			//pedido de reunion
			$htmltoPrint = '';
			?>
			<table class="table table-striped table-hover">
				<tr>
					<th>ID</th>
					<th><strong>Enviado</strong></th>
					<th><strong>Colegio</strong></th>
					<th><strong>Nombre</strong></th>
					<th><strong>Cargo</strong></th>
					<th><strong>Email</strong></th>
					<th><strong>Teléfono movil</strong></th>
					<th><strong>Cant Alumnos</strong></th>
					<th><strong>Año de viaje</strong></th>
					<th><strong>Contestado</strong></th>
					<th><strong>Notas</strong></th>
				</tr>
			<?php
		
			while ($row = $result->fetch_array()) {
				$rows[] = $row;
			}

			foreach ($rows as $row ) { ?>
				<tr>
					<td># <?php echo $row['id']; ?></td>
					<td><?php echo $row['fecha_de_envio']; ?></td>
					<td><?php echo $row['escuela']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['cargo']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['telefono']; ?></td>
					<td><?php echo $row['cant_alumnos']; ?> alumnos</td>
					<td><?php echo $row['fecha_viaje']; ?></td>

					<?php 
						if ( $row['contestado'] == 1 ) { ?>
							<td><input data-id="<?php echo $row['id']; ?>" class="answered_email" type="checkbox" checked></td>
						<?php 
						}
						else { ?>
							<td><input data-id="<?php echo $row['id']; ?>" class="answered_email" type="checkbox"></td>
						<?php		
						}
					?>
					<td>
						<textarea class="notas_email"><?php echo $row['notas']; ?></textarea>
						<p><button data-id="<?php echo $row['id']; ?>" class="btn btn-xs save_notes_email" title="Guardar notas"><span class="glyphicon glyphicon-floppy-disk"></span></button></p>
					</td>
				</tr>
				<?php
			
			}//cierra for each
			?>
			</table>
			<?php
		} else {
			//formulario de contacto		
			?>
			
			<table class="table table-striped table-hover">
				<tr>
					<th>id</th>
					<th><strong>Enviado</strong></th>
					<th><strong>Nombre</strong></th>
					<th><strong>Email</strong></th>
					<th><strong>Teléfono</strong></th>
					<th><strong>Mensaje</strong></th>
					<th><strong>Contestado</strong></th>
					<th><strong>Notas</strong></th>
				</tr>
			
			<?php
			while ($row = $result->fetch_array()) {
				$rows[] = $row;
			}

			foreach ($rows as $row ) {
			?>
				<tr>
					<td># <?php echo $row['id']; ?></td>
					<td><?php echo $row['fecha_de_envio']; ?></td>
					<td><?php echo $row['nombre']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['telefono']; ?></td>
					<td><?php echo $row['mensaje']; ?></td>
					<?php 
						if ( $row['contestado'] == 1 ) { ?>
							<td><input data-id="<?php echo $row['id']; ?>" class="answered_email" type="checkbox" checked></td>
						<?php 
						}
						else { ?>
							<td><input data-id="<?php echo $row['id']; ?>" class="answered_email" type="checkbox"></td>
						<?php		
						}
					?>
					<td>
						<textarea class="notas_email"><?php echo $row['notas']; ?></textarea>
						<p><button data-id="<?php echo $row['id']; ?>" class="btn btn-xs save_notes_email" title="Guardar notas"><span class="glyphicon glyphicon-floppy-disk"></span></button></p>
					</td>
				</tr>
				
			<?php
			}//cierra for each
			?>
			
			</table>

			<?php
			mysqli_close($connection);

		}//fin formulario de contactos
		
	}//fin html a imprimir

}//cierre printContactos()

/*
 * funcion mostrar galería de imágenes
*/
function printImagesGalery() {
	global $connection;
	
	$tabla      = 'img_uploads';
	$post_type  = 'galeria_imgs';
	$query      = "SELECT * FROM " .$tabla. " WHERE post_type = '{$post_type}' ORDER by orden asc ";

	$result =  mysqli_query($connection, $query);
	while ($row = $result->fetch_array()) {
		$rows[] = $row;
	}
	//calcula cuantas imagenes hay en total para mostrar
	$CantTotal = count($rows);

	
	if ($CantTotal == 0 ) {
	  
	  echo 'no hay imagenes cargadas';

	} else {
	  //se ejecuta el bloque normal
		//html de galería a imprimir contenedores
		?>
		  	<div class="galeria-imagenes">
				<ul class="lista-imagenes connectedSortable">
		<?php 
	  	for ($i = 0; $i < $CantTotal; $i++ ) {
	  		//lista html de galería a imprimir
		  	?>
				<li class="imagen">
					<article class="thumbnail">
						<div class="data-imagen">
							<div>
								<h1>Nombre Imagen: <small>
									<input type="text" value="<?php echo $rows[$i]['nombre_archivo']; ?>">
								</small></h1>
								<p>Orden:<br><?php echo $rows[$i]['orden']; ?> </p>
							</div>
						</div>
						<input type="hidden" name="image_id" value="<?php echo $rows[$i]['image_id']; ?>">
						<input type="hidden" name="orden" value="<?php echo $rows[$i]['orden']; ?>">
						
						<figure>
							<img src="../<?php echo $rows[$i]['url']; ?>" alt="imagen-galeria" class="img-responsive">
						</figure>
					</article>
				</li>
			<?php
	  	}
	  	//html a imprimir, fin contenedores
		?>
		  	</ul>
		</div>
		<?php
	}
	

	/* liberar la serie de resultados */
	mysqli_free_result($result);
	mysqli_close($connection);
}//printImagesGalery()

/*
 * funcion mostrar programas cargados y a cargar + links o redes
*/
function printFileLoaded($tabla, $post_type) {
		global $connection;
	
		$query  = "SELECT * FROM " .$tabla. " WHERE post_type = '" .$post_type. "' ORDER by file_uploads_id desc LIMIT 1 ";

		$result =  mysqli_query($connection, $query);
	
		if ($result->num_rows == 0) {
			echo '<div class="outer-wrapper-btn-'.$post_type.'"><div class="col-sm-7"><small><em>No hay archivo cargado</em></small></div><div class="col-sm-5 text-right"><button class="btn btn-xs btn-info link-btn" data-btn="'.$post_type.'">Cargar link</div></div><div class="inner-input-link-wrapper wrapper-to-upload-'.$post_type.'"><div class="col-sm-7"><input data-btn="'.$post_type.'" class="inner-input-link" type="text" placeholder="Pegar link aquí" style="width:100%;"></div><div class="col-sm-5 text-right"><button class="btn btn-xs btn-danger link-btn-cancel" data-btn="'.$post_type.'">Cancelar</button></div></div></button>';
			return;
		}

		$data = mysqli_fetch_array($result);

		if ( $data['tipo_imagen'] == 'link' ) {
			echo '<div class="col-sm-8"><a href="' .$data['url']. '" target="_blank">Ir a link cargado</a></div><div class="col-sm-4 text-right"><button id="' .$data['file_uploads_id']. '" class="btn btn-xs btn-danger del-btn-file">Borrarlo</button></div>';
		} else {
			echo '<div class="col-sm-8"><a href="../' .$data['url']. '" target="_blank">Ver archivo cargado</a></div><div class="col-sm-4 text-right"><button id="' .$data['file_uploads_id']. '" class="btn btn-xs btn-danger del-btn-file">Borrarlo</button></div>';	
		}

		mysqli_close($connection);
}//mostrar programas cargados y a cargar + links o redes


/*
 * mostrar links en otras opciones
*/
function printOtherOptions($tabla, $post_type) {
	global $connection;
	
		$query  = "SELECT * FROM " .$tabla. " WHERE post_type = '" .$post_type. "' ORDER by file_uploads_id desc LIMIT 1 ";

		$result =  mysqli_query($connection, $query);
	
		if ($result->num_rows == 0) {
			echo '';
		} else {
			$data = mysqli_fetch_array($result);
			echo $data['url'];
		}
	mysqli_close($connection);
}//mostrar links en otras opciones


/*
 * funcion mostrar promociones
*/
function showPopupImg () {
	
	$connection = connectDB();
	$tabla = 'img_uploads';
	$post_type = 'popup';

	$query  = 'SELECT * FROM ' .$tabla. ' WHERE post_type = "'.$post_type.'" LIMIT 1';
	$result =  mysqli_query($connection, $query);
	$data = mysqli_fetch_array($result);
	$urlPoup =  $data[3];
	$idImagen = $data[0];
	
	mysqli_close($connection);
	if ( $urlPoup == NULL ) {
		echo '<img id="popupImg" class="img-responsive" src="assets/images/popupdefault.png">';
	} else {
		echo '<img id="popupImg" class="img-responsive" src="../'.$urlPoup.'"><br>';
		echo '<p><button id="'.$idImagen.'" class="btn btn-xs btn-danger del-btn-file">Borrar imagen</button></p>';
	}

}

/*
 * ver si la promo está activa, si el popup está activo o no
*/
function ispopupActive () {
	
	$connection = connectDB();
	$tabla = 'options';
	$option_name = 'popupValue';
	$active = '';

	$query  = "SELECT * FROM " .$tabla. " WHERE options_name = '{$option_name}' LIMIT 1";
	$result =  mysqli_query($connection, $query);
	
	
	if ($result->num_rows == 0) {
		mysqli_close($connection);
		return;
	}
	
	$data = mysqli_fetch_array($result);
	
	if ($data[2] == 'true') {
		$active = 'checked';
	}

	mysqli_close($connection);
	echo $active;
	
}

/*
 * ver lista de noticias
 * parametros: limite a mostrar, estado (publicado, borrador, todos), estilo (el extendido mustra botones para editar la noticia, verla o publicarla), la categoria a mostrar y si muestra al final un pequeño resumen de lo que queda
*/
function listaNoticias( $limit = 20, $status = 'all', $extended = false, $categoria = 'none', $resumenQuery = false ) {
	$connection = connectDB();
	$tabla = 'noticias';

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by post_fecha desc LIMIT ".$limit." ";
	//si tiene categoria:
	if ( $categoria != 'none' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_categoria='".$categoria."' ORDER by post_fecha desc LIMIT ".$limit." ";
	}
	//si tiene definido status (publicado, borrador) y categoria
	if ( $status != 'all' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_status='".$status."' ORDER by post_fecha desc LIMIT ".$limit." ";
	}
	//si tiene definido status y categoria
	if ( $status != 'all' && $categoria != 'none' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_status='".$status."' AND post_categoria='".$categoria."' ORDER by post_fecha desc LIMIT ".$limit." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ( $row = $result->fetch_array() ) {
			$rows[] = $row;
		}

		foreach ($rows as $row ) {
		 	$postID       = $row['post_ID'];
			$titulo       = $row['post_titulo'];
			$url          = $row['post_url'];
			$imgDestacada = $row['post_imagen'];
			$resumen      = $row['post_resumen'];
			$bajada       = $row['post_bajada'];
			$contenido    = $row['post_contenido'];
			$video        = $row['post_video'];
			$categoria    = $row['post_categoria'];
			$etiquetas    = $row['post_etiquetas'];
			$galeria      = $row['post_galeria'];
			$imgGaleria   = $row['post_imagenesGal'];
			$status       = $row['post_status'];
			$date         = $row['post_fecha'];

			$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$dia          = date("d", strtotime($date));
			$mes          = $meses[date("n", strtotime($date))-1];
			$year         = date("Y", strtotime($date));
		
			?>
			<li class="loop-noticias-backend-item">
				<article class="row">
				    <div class="col-sm-3">
				    	<?php 
				    	if ( $imgDestacada != '' ) { ?>
				    	<img src="<?php echo UPLOADSURLIMAGES.'/'.$imgDestacada; ?>" alt="Imagen Destacada de la noticia" class="img-responsive">
				    	<?php }
				    	else { ?>
				    	<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA" class="img-responsive">
				    	<?php } ?>
				    </div>
				    <div class="col-sm-9">
				    	<?php 
				    	if ( $extended ) {
				    		?>
	
				    	<h1 class="titulo-noticia-small">
				    		<?php echo $titulo; ?> 
				    		| 
				    		<span><?php echo $status; ?></span>
				    		- 
				    		<small><?php echo $date; ?></small>
				    	</h1>
				    	<p class="links-edicion-noticias">
				    		<a href="index.php?admin=editar-noticias&slug=<?php echo $url; ?>" title="Editar" class="btn-edit-news">
					    		Editar Noticia
					    	</a>
					    	<?php 
				    			if ( $status != 'publicado' ) {
				    		?>
				    		 | <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] .'/noticias/'. $url ?>" target="_blank" title="Ver">Vista Previa</a>
				    		 | <a href="<?php echo $url; ?>" class="btn-publish-post" title="Publicar">Publicar</a> 
				    		 | <a href="<?php echo $url; ?>" class="btn-delete-post">Borrar</a>
				    		<?php } else { ?>
				    		 | <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] .'/noticias/'. $url ?>" target="_blank" title="Ver">Ver noticia</a>
				    		 | <a href="<?php echo $url; ?>" class="btn-delete-post">Borrar</a>
				    		 <?php } ?>
				    	</p>
						<?php	    	
				    	} 
				    	//si es estilo clasico:
				    		else { ?>
				    	<a href="index.php?admin=editar-noticias&slug=<?php echo $url; ?>" title="Editar" class="titulo-noticia-small-link">
					    	<h1 class="titulo-noticia-small">
					    		<?php echo $titulo; ?> 
					    		| 
					    		<span><?php echo $status; ?></span>
					    		- 
					    		<small><?php echo $date; ?></small>
					    	</h1>
				    	</a>
				    	<?php } ?>
				    </div>
				</article>
			</li>
		<?php

		}//FOREACH
		//muestra el resumen de la búsqueda y lo imprime al final
		if ( $resumenQuery ) {
			$totales = mysqli_query($connection, "SELECT *  FROM " .$tabla. " ");
			$cantTotal = $totales->num_rows;
			$cargadasenQuery = count($rows);
			//echo $cargadasenQuery . ' noticias cargadas. '.$cantTotal.' noticias en total' ;
			$restantes = $cantTotal-$cargadasenQuery;
			$texto1 = $cantTotal.' noticias en total. '.$cargadasenQuery. ' cargadas ahora. '.$restantes.' restantes.';
			$texto2 = $cantTotal.' noticias en total. '.$cargadasenQuery. ' cargadas ahora. 0 restantes.';
			//2 opciones: si queda más muestra cuantas quedan sino indica que no hay más
			if ( intval($restantes) > 0 ) {
				echo '<p class="info-resumen">'.$texto1.'</p>';
			} else {
				echo '<p class="info-resumen">'.$texto2.'</p>';
			}
		}
	}//ELSE

	mysqli_close($connection);
}

function searchPost ( $slug ) {
	$connection = connectDB();
	$tabla = 'noticias';
	$tablaEtiquetas = 'etiquetas';
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$slug."' LIMIT 1";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo 0;
	} else {
		$data = mysqli_fetch_array($result);

		$postID       = $data['post_ID'];
		$date         = $data['post_fecha'];
		$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$dia          = date("d", strtotime($date));
		$mes          = $meses[date("n", strtotime($date))-1];
		$year         = date("Y", strtotime($date));
		$resumen      = $data['post_resumen'];
		$bajada       = $data['post_bajada'];
		$galeria      = $data['post_galeria'];
 		$imgGaleria   = array();

		if ( $data['post_imagenesGal'] != '' ) {
			$imgGaleria = unserialize( $data['post_imagenesGal'] );
		}
		
		
		
		$etiquetas = unserialize( $data['post_etiquetas'] );
		//si hay etiquetas hay que buscar sus nombres
		$etiquetasNombres = '';

		if ($etiquetas != '') {
			for ($i=0; $i < count($etiquetas); $i++) { 
				$etiqueta = $etiquetas[$i];

				$query  = "SELECT * FROM " .$tablaEtiquetas. " WHERE tag_id='".$etiqueta."' LIMIT 1";	
				$result = mysqli_query($connection, $query);
				$row = $result->fetch_array(MYSQLI_ASSOC);
				
				$etiquetasNombres .= $row['tag_name'];
				$etiquetasNombres .= ',';
			}//for etiquetas
		
		}

		global $dataPost;
		$dataPost = array(
				'post_id'      => $data['post_ID'],
				'titulo'       => $data['post_titulo'],
				'url'          => $data['post_url'],
				'imgDestacada' => $data['post_imagen'],
				'resumen'      => $resumen,
				'bajada'       => $bajada,
				'contenido'    => $data['post_contenido'],
				'video'        => $data['post_video'],
				'categoria'    => $data['post_categoria'],
				'etiquetas'    => $etiquetasNombres,//guardar sus nombres
				'galeria'      => $data['post_galeria'],
				'imgGaleria'   => $imgGaleria,
				'fecha'        => $date,
				'dia'          => $dia,
				'mes'          => $mes,
				'year'         => $year,	
				'status'       => $data['post_status'],
			);

		mysqli_close($connection);

		return $dataPost;
	}
		
}//searchPost()


function listaSliders () {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ORDER by slider_ubicacion desc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Todavía no hay ninguno cargado</div>';
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
	mysqli_close($connection);
} //listaSliders()

function showSliderToEdit ( $slug ) {
	$connection = connectDB();
	$tabla = 'sliders';
	
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_ubicacion='".$slug."' ORDER by slider_orden asc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Todavía no hay ninguno cargado</div>';
	} else {
		
		while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}//while

		global $dataSlider;
		$dataSlider = array();
			foreach ($rows as $row ) {
				$a = array(
					'slider_id' => $row['slider_id'],
					'slider_imagen' => $row['slider_imagen'],
					'slider_titulo' => $row['slider_titulo'],
					'slider_link' => $row['slider_link'],
					'slider_textoLink' => $row['slider_textoLink'],
					'slider_texto' => $row['slider_texto'],
					'slider_ubicacion' => $row['slider_ubicacion'],
					'slider_orden' => $row['slider_orden'],
				);
				array_push($dataSlider, $a);
			}//foreach
			
		
	
	}//else 

	mysqli_close($connection);
	return $dataSlider;
} //showSliderToEdit()


function showLinksDeportesAdmin () {
	$connection = connectDB();
	$tabla = 'deportes';
	$secciones = array();
	$textoSecciones = array();
	$ordenSecciones = array();
	//queries según parámetros
	$query  = "SELECT deportes_seccion,deportes_texto,deportes_orden FROM " .$tabla. " WHERE deportes_post_type='section' ORDER by deportes_orden";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay ninguna cargada';
	} else { 

	while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}
		//recorremos cada uno de los item de la seccion
		foreach ($rows as $row ) { 
			$seccion = $row['deportes_seccion'];
			$textoSeccion = $row['deportes_texto'];
			$ordenSeccion = $row['deportes_orden'];
			array_push($secciones, $seccion);
			array_push($textoSecciones, $textoSeccion);
			array_push($ordenSecciones, $ordenSeccion);
		}//for each de cada seccion

		
		//ahora q ya están los nombres de las secciones, recorremos cada una

		for ($i=0; $i < count($secciones); $i++) { 
			
			$query  = "SELECT * FROM " .$tabla. " WHERE deportes_seccion='".$secciones[$i]."' and deportes_post_type='link' ORDER by deportes_orden";	
			$result2 = mysqli_query($connection, $query);
			
			if ( $result2->num_rows == 0 ) { ?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="deportes-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-deportes-btn">Cambiar nombre u orden</small>
					</h4>
					<p><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-deportes" id="<?php echo $secciones[$i]; ?>">
						<li>
		      				<button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>

			 <?php } else { 
				//se arma el html. Primero va el titulo de la sección
				?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="deportes-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-deportes-btn">Cambiar nombre u orden</small>
					</h4>
					<p class="orden-secciones-deportes"><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-deportes" id="<?php echo $secciones[$i]; ?>">
			
				<?php
				while ($rowitem = $result2->fetch_array()) {					

					$orden = $rowitem['deportes_orden'];
					$IDItem = $rowitem['deportes_id'];
					$textoItem = $rowitem['deportes_texto'];
					$urlItem = $rowitem['deportes_url'];
					
					?>
						<li>
			  				<article id="<?php echo $IDItem; ?>" class="link-deportes-wrapper">
					        	<div class="row">
					        		<div class="col-sm-2">
					        			<h4><small>Orden:</small></h4>
					        			<input type="text" class="link-deportes-orden" value="<?php echo $orden; ?>">	
					        		</div><!-- //col -->
					        		<div class="col-sm-3">
					        			<input type="text" class="link-deportes-texto" value="<?php echo $textoItem; ?>">		
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="link-deportes-file">
							        		<a href="<?php echo UPLOADSURL . '/pdfs/' . $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>">
							        			<?php echo $urlItem; ?></a><br>
							        		<small><span class="btn-load-file-deportes">Cambiar</span> o <span class="btn-del-file-deportes">Borrar</span> archivo</small>
							        	</div>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<button class="btn btn-sm btn-info btn-save-file-deportes">Guardar cambios</button>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<span class="error-msj-deportes"></span>
					        		</div><!-- //col -->
					        	</div><!-- //row -->
					        </article><!-- //link-deportes-wrapper -->	
			  			</li>

				<?php }//while
				
				//cierre de la seccion
				?>
						<li>
		      				<button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>
			<?php }//else

		}//for de secciones

	}//else
	mysqli_close($connection);
}//showLinksDeportesAdmin()


function showLinksConveniosAdmin() {
	$connection = connectDB();
	$tabla = 'convenios';
	$secciones = array();
	$textoSecciones = array();
	$ordenSecciones = array();
	//queries según parámetros 
	$query  = "SELECT convenios_seccion,convenios_texto,convenios_orden FROM " .$tabla. " WHERE convenios_post_type='section' ORDER by convenios_orden";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay ninguna cargada';
	} else { 

	while ($row = $result->fetch_array()) {
				$rows[] = $row;
		}
		//recorremos cada uno de los item de la seccion
		foreach ($rows as $row ) { 
			$seccion = $row['convenios_seccion'];
			$textoSeccion = $row['convenios_texto'];
			$ordenSeccion = $row['convenios_orden'];
			array_push($secciones, $seccion);
			array_push($textoSecciones, $textoSeccion);
			array_push($ordenSecciones, $ordenSeccion);
		}//for each de cada seccion

		
		//ahora q ya están los nombres de las secciones, recorremos cada una

		for ($i=0; $i < count($secciones); $i++) { 
			
			$query  = "SELECT * FROM " .$tabla. " WHERE convenios_seccion='".$secciones[$i]."' and convenios_post_type='link' ORDER by convenios_orden";	
			$result2 = mysqli_query($connection, $query);
			
			if ( $result2->num_rows == 0 ) { ?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="convenios-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-convenios-btn">Cambiar nombre u orden</small>
					</h4>
					<p><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-convenios" id="<?php echo $secciones[$i]; ?>">
						<li>
		      				<button class="btn btn-warning btn-sm new-link-convenios-btn">Crear nuevo link</button>
		      				<button class="btn btn-success btn-sm new-link-convenios-btn-url">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>

			 <?php } else { 
				//se arma el html. Primero va el titulo de la sección
				?>
				<h3><?php echo $secciones[$i]; ?></h3>
				<div>
					<h4 class="convenios-section-title" data-nombre="<?php echo $secciones[$i]; ?>">
						<?php echo $textoSecciones[$i]; ?> | 
						<small class="change-section-name-convenios-btn">Cambiar nombre u orden</small>
					</h4>
					<p class="orden-secciones-convenios"><strong>Orden:</strong> <span><?php echo $ordenSecciones[$i]; ?></span></p>
					<ul class="links-convenios" id="<?php echo $secciones[$i]; ?>">
			
				<?php
				while ($rowitem = $result2->fetch_array()) {					

					$orden = $rowitem['convenios_orden'];
					$IDItem = $rowitem['convenios_id'];
					$textoItem = $rowitem['convenios_texto'];
					$urlItem = $rowitem['convenios_url'];
					$linkItem = $rowitem['convenios_link'];
					
					?>
						<li>
			  				<article id="<?php echo $IDItem; ?>" class="link-convenios-wrapper">
					        	<div class="row">
					        		<div class="col-sm-2">
					        			<h4><small>Orden:</small></h4>
					        			<input type="text" class="link-convenios-orden" value="<?php echo $orden; ?>">	
					        		</div><!-- //col -->
					        		<div class="col-sm-3">
					        			<input type="text" class="link-convenios-texto" value="<?php echo $textoItem; ?>">		
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="link-convenios-file">
					        			<?php if ( $linkItem == '1' ) { ?>
					        				<a href="<?php echo $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>" data-url="1"><?php echo $urlItem; ?></a><br>
					        				<small><span class="btn-del-file-convenios">Borrar</span> archivo</small>
					        				<?php } else { ?>
					        					<a href="<?php echo UPLOADSURL . '/pdfs/' . $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>" data-url="0"><?php echo $urlItem; ?>
					        					</a><br>
							        		<small><span class="btn-load-file-convenios">Cambiar</span> o <span class="btn-del-file-convenios">Borrar</span> archivo</small>
					        				<?php } ?>
							        	</div>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<button class="btn btn-sm btn-info btn-save-file-convenios">Guardar cambios</button>
					        		</div><!-- //col -->
					        		<div class="col-sm-2">
					        			<span class="error-msj-convenios"></span>
					        		</div><!-- //col -->
					        	</div><!-- //row -->
					        </article><!-- //link-convenios-wrapper -->	
			  			</li>

				<?php }//while
				
				//cierre de la seccion
				?>
						<li>
		      				<button class="btn btn-warning btn-sm new-link-convenios-btn">Crear nuevo archivo</button>
		      				<button class="btn btn-success btn-sm new-link-convenios-btn-url">Crear nuevo link</button>
		      			</li>
			  		</ul>
				</div>
			<?php }//else

		}//for de secciones

	}//else
	mysqli_close($connection);
}//showLinksConveniosAdmin()


function showLinksLeyesAdmin() {
	$connection = connectDB();
	$tabla = 'convenios';
	$secciones = array();
	$textoSecciones = array();
	$ordenSecciones = array();
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE convenios_seccion='leyes' ORDER by convenios_orden";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay ninguna cargada';
		?>
		<h4 class="convenios-section-title">
			Leyes Laborales				
		</h4>
		<ul class="links-leyes" id="leyes">
		<li>
  				<button class="btn btn-warning btn-sm new-link-leyes-btn">Crear nuevo archivo</button>
  				<button class="btn btn-success btn-sm new-link-leyes-btn-url">Crear nuevo link</button>
  			</li>
  		</ul>
	<?php } else { 

		while ($row = $result->fetch_array()) {
				$rows[] = $row;
		} ?>
		<h4 class="convenios-section-title">
			Leyes Laborales				
		</h4>
		<ul class="links-leyes" id="leyes">
		<?php 
		foreach ($rows as $row ) { 
			$orden = $row['convenios_orden'];
			$IDItem = $row['convenios_id'];
			$textoItem = $row['convenios_texto'];
			$urlItem = $row['convenios_url'];
			$linkItem = $row['convenios_link'];
			?>
			<li>
  				<article id="<?php echo $IDItem; ?>" class="link-leyes-wrapper">
		        	<div class="row">
		        		<div class="col-sm-2">
		        			<h4><small>Orden:</small></h4>
		        			<input type="text" class="link-leyes-orden" value="<?php echo $orden; ?>">	
		        		</div><!-- //col -->
		        		<div class="col-sm-3">
		        			<input type="text" class="link-leyes-texto" value="<?php echo $textoItem; ?>">		
		        		</div>
		        		<div class="col-sm-3">
		        			<div class="link-leyes-file">
		        			<?php if ( $linkItem == '1' ) { ?>
		        				<a href="<?php echo $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>" data-url="1"><?php echo $urlItem; ?></a><br>
		        				<small><span class="btn-del-file-leyes">Borrar</span> archivo</small>
		        				<?php } else { ?>
		        					<a href="<?php echo UPLOADSURL . '/pdfs/' . $urlItem; ?>" target="_blank" data-href="<?php echo $urlItem; ?>" data-url="0"><?php echo $urlItem; ?>
		        					</a><br>
				        		<small><span class="btn-load-file-leyes">Cambiar</span> o <span class="btn-del-file-leyes">Borrar</span> archivo</small>
		        				<?php } ?>
				        	</div>
		        		</div><!-- //col -->
		        		<div class="col-sm-2">
		        			<button class="btn btn-sm btn-info btn-save-file-leyes">Guardar cambios</button>
		        		</div><!-- //col -->
		        		<div class="col-sm-2">
		        			<span class="error-msj-leyes"></span>
		        		</div><!-- //col -->
		        	</div><!-- //row -->
		        </article><!-- //link-leyes-wrapper -->	
  			</li>
		<?php }//foreach ?>
			<li>
  				<button class="btn btn-warning btn-sm new-link-leyes-btn">Crear nuevo archivo</button>
  				<button class="btn btn-success btn-sm new-link-leyes-btn-url">Crear nuevo link</button>
  			</li>
  		</ul>
	<?php }//else
	mysqli_close($connection);
}//showLinksLeyesAdmin()

function showDelegadosAdmin( $delegados ) {
	$connection = connectDB();
	$tabla = 'staff';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE staff_post_type='".$delegados."' ORDER by staff_orden";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { ?>
	<div class="btn-controls btn-add-staff" data-postType="<?php echo $delegados; ?>">
				<button class="btn btn-primary">Agregar Item</button>
			</div>
	<ul class="lista-staff" data-postType="<?php echo $delegados; ?>">
		<li data-loaded='false' style="margin:20px;">No hay nada cargado</li>
	</ul>
	<?php } else { ?>

			<div class="btn-controls btn-add-staff" data-postType="<?php echo $delegados; ?>">
				<button class="btn btn-primary">Agregar Item</button>
			</div>
			<ul class="lista-staff" data-postType="<?php echo $delegados; ?>">
			<?php
		while ($row = $result->fetch_array()) {

			$orden = $row['staff_orden'];
			$IDItem = $row['staff_id'];
			$nombre = $row['staff_nombre'];
			$cargo = $row['staff_cargo'];
			$trabajo = $row['staff_trabajo'];
			$imagen = $row['staff_image'];
			$redSocial = $row['staff_redsocial'];

			?>
			
			
				<li class="lista-staff-item">
					<article>
						<div class="row">
							<div class="col-sm-3">
								<?php 
								if ( $imagen == '' ) { ?>
									<img src="assets/images/default-staff-image.png" alt="Autoridad-ATSA" class="img-responsive" data-href="">	
								<?php } else { ?>
								<img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen; ?>" alt="Autoridad-ATSA" class="img-responsive" data-href="<?php echo $imagen; ?>">
								<?php } ?>
							</div>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-6">
										<p>
											<label>Nombre: <input type="text" name="nombre" value="<?php echo $nombre; ?>"></label>
										</p>
										<p>
											<label>Cargo: <input type="text" name="cargo" value="<?php echo $cargo; ?>"></label>
										</p>
										<p>
											<label>Trabajo: <input type="text" name="trabajo" value="<?php echo $trabajo; ?>"></label>
										</p>
									</div>
									<div class="col-sm-6">
										<p>
											<label>RedSocial: <input type="text" name="redSocial" value="<?php echo $redSocial; ?>"></label>
										</p>
										<p>
											<label>Orden: <input type="number" name="orden" value="<?php echo $orden; ?>"></label>
										</p>
										<p class="error-msj-staff-item"></p>
									</div>
								</div>
								<p>
									<button class="btn btn-xs btn-info btn-change-staff-item-img" data-id="<?php echo $IDItem; ?>">Cambiar imagen</button>
								</p>
								<p class="btns-item-footer">
									<button class="btn btn-sm btn-success btn-save-staff-item" data-id="<?php echo $IDItem; ?>">Guardar cambios</button>
									<button class="btn btn-sm btn-danger btn-del-staff-item" data-id="<?php echo $IDItem; ?>">Borrar elemento</button>
								</p>
							</div>
						</div>						
					</article>
				</li>
			

		<?php }//while ?>
		</ul>
	<?php }//else
	mysqli_close($connection);
}//showDelegadosAdmin()

//recupera los datos de viajes
function searchViajesData () {
	$connection = connectDB();
	global $dataViajes;
	$dataViajes = array();

	//queries según parámetros
	$query  = "SELECT * FROM hoteles WHERE hotel_dataextra='viajes' LIMIT 1 ";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return $dataViajes;
	} else {
		$row = $result->fetch_array();
		
			$dataViajes = array(
				'hotel_id' => $row['hotel_ID'],
				'texto_superior' => $row['hotel_contingente'],
				'texto_contacto' => $row['hotel_servicios'],
				'titulo_promocion' => $row['hotel_titulo'],
				'texto_principal' => $row['hotel_descripcion'],
			);
			
	}//else 

	mysqli_close($connection);
	return $dataViajes;
} //searchViajesData()


function searchHotelesAdmin() {
	$connection = connectDB();
	$tabla = 'hoteles';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE hotel_dataextra='hotel'";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { ?>
	
		<li data-loaded='false' style="margin:20px;">No hay nada cargado</li>
	
<?php } else {
			while ($row = $result->fetch_array()) {
				$id_hotel = $row['hotel_ID']; 
				$imagen = $row['hotel_thumnail'];
				$caption = $row['hotel_location'];
				$tituloHotel = $row['hotel_titulo'];
				$textHotel = $row['hotel_descripcion'];
				$servHotel = $row['hotel_servicios'];
				$continHotel = $row['hotel_contingente'];
				$iconTipo = $row['hotel_icontipo'];
				$iconServ = $row['hotel_iconservicios'];
			?> 

			<li class="lista-hoteles-admin-item">
				<article id="<?php $id_hotel; ?>">
					<div class="row">
						<div class="col-sm-4">
							<label>Titulo: <br>
								<input name="titulo-hotel" type="text" value="<?php echo $tituloHotel; ?>">
							</label>
							<label>Leyenda Imagen: <br>
								<input name="leyenda-imagen-hotel" type="text" value="<?php echo $caption; ?>">
							</label>
							<ul class="hoteles-imagenes">
								<li>
									<?php if ( $imagen == '' ) { ?>
									<img class="img-responsive img-hotel-imagen">
									<button class="btn btn-xs btn-warning btn-change-image-hotel">Agregar imagen</button>
									<?php } else { ?>
									<img src="/uploads/images/<?php echo $imagen; ?>" data-href="<?php echo $imagen; ?>" class="img-responsive img-hotel-imagen">
									<button class="btn btn-xs btn-warning btn-change-image-hotel">Cambiar imagen</button>
									<?php } ?>
								</li>
								<li>
									<?php if ( $iconTipo == '' ) { ?>
									<img class="img-responsive img-hotel-icontipo">
									<button class="btn btn-xs btn-success btn-change-image-hotel">Agregar icono hotel</button>
									<?php } else { ?>
									<img src="/uploads/images/<?php echo $iconTipo; ?>" data-href="<?php echo $iconTipo; ?>" class="img-responsive img-hotel-icontipo">
									<button class="btn btn-xs btn-success btn-change-image-hotel">Cambiar imagen</button>
									<?php } ?>
								</li>
								<li>
									<?php if ( $iconServ == '' ) { ?>
									<img class="img-responsive img-hotel-iconserv">
									<button class="btn btn-xs btn-info btn-change-image-hotel">Agreagar icono de servicios</button>
									<?php } else { ?>
									<img src="/uploads/images/<?php echo $iconServ; ?>" data-href="<?php echo $iconServ; ?>" class="img-responsive img-hotel-iconserv">
									<button class="btn btn-xs btn-info btn-change-image-hotel">Cambiar imagen</button>
									<?php } ?>
								</li>
							</ul>
						</div>
						<div class="col-sm-8">
							
							<label>Descripción Hotel: <br>
								<textarea class="hotel-text-tiny" name="descripcion-hotel"><?php echo $textHotel; ?></textarea>
							</label>
							<label>Servicios Hotel: <br>
								<textarea class="hotel-text-tiny" name="servicios-hotel"><?php echo $servHotel; ?></textarea>
							</label>
							<label>Contingente Hotel: <br>
								<textarea class="hotel-text-tiny" name="contingente-hotel"><?php echo $continHotel; ?></textarea>
							</label>
						</div>
					</div>
					<div class="btn-viajes-wrapper">
						<span class="msj-viajes-saved"></span>
						<button class="btn btn-danger btn-hotel-save-item" data-id="<?php echo $id_hotel; ?>">Guardar Cambios</button>
						<button class="btn btn-success btn-hotel-del-item" data-id="<?php echo $id_hotel; ?>">Borrar hotel</button>
					</div>
				</article>
			</li>
	<?php }//while
 }//else
	mysqli_close($connection);
}//searchHotelesAdmin()

//buscar cursos en admin de acuerdo a post_type: no_formal o formacion_tecnica
function listCursosAdmin ( $post_type ) {
	$connection = connectDB();
	$tabla = 'cursos';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='".$post_type."' ORDER by curso_orden asc";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { 
	
		echo 'No hay nada cargado';
	
	} else {

		//html cursos formación técnica
		if ( $post_type == 'formacion_tecnica' ) {
			while ($row = $result->fetch_array()) {
				$cursoID = $row['curso_ID'];
				$cursoSlug = $row['curso_slug'];
				$cursoTitulo = $row['curso_titulo'];
				$cursoResumen = $row['curso_resumen'];
				$cursoMetodologia = $row['curso_metodologia'];
				$cursoObjGeneral = $row['curso_objgeneral'];
				$cursoObjEspecifico = $row['curso_objespecifico'];
				$cursoRequisitos = $row['curso_requisitos'];
				$cursoImagen = $row['curso_imagen'];
				$cursoCertificado = $row['curso_certificado'];
				$cursoCursada = $row['curso_cursada'];
				$cursoLugar = $row['curso_lugar'];
				$cursoHorarios = $row['curso_horarios'];
				$cursoDestinatarios = $row['curso_destinatario'];
				$cursoDestacado = $row['curso_destacado'];
				$cursoOrden = $row['curso_orden'];
				?>
				<li>
					<article id="<?php echo $cursoID;?>">
						<div class="row">
							<div class="col-sm-6">
								<label>Título:<br>
									<input class="cursos_input_titulo" type="text" name="cursos_titulo" value="<?php echo $cursoTitulo; ?>">
								</label>
								<label>Slug:<br>
									<input class="cursos_input_slug" type="text" name="cursos_orden" value="<?php echo $cursoSlug; ?>">
								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Resumen:<br>
									<textarea name="cursos_resumen"><?php echo $cursoResumen; ?></textarea>
								</label>
							</div><!-- // .col -->
						</div>

						<div class="row">
							<div class="col-sm-6">
								<label>Imagen:<br>
									<img data-href="<?php echo $cursoImagen; ?>" class="img-responsive imagen-curso" src="/uploads/images/<?php echo $cursoImagen; ?>">
									<button class="btn btn-xs btn-change-image-curso">Cambiar imagen</button>

								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Certificado:<br>
									<input type="text" name="cursos_titulo" value="<?php echo $cursoCertificado; ?>">
								</label>
								<label>Cursada:<br>
									<textarea name="cursos_orden"><?php echo $cursoCursada; ?></textarea>
								</label>
								<label>Horarios:<br>
									<input type="text" name="cursos_orden" value="<?php echo $cursoHorarios; ?>">
								</label>
								<label>Lugar:<br>
									<input type="text" name="cursos_orden" value="<?php echo $cursoLugar; ?>">
								</label>
							</div><!-- // .col -->
						</div>

						<div class="row">
							<div class="col-sm-6">
								<label>Metodología:<br>
									<textarea name="curso_metodologia"><?php echo $cursoMetodologia; ?></textarea>
								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Objetivo General:<br>
									<textarea name="curso_objgeneral"><?php echo $cursoObjGeneral; ?></textarea>
								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Requisitos:<br>
									<textarea name="curso_requisitos"><?php echo $cursoRequisitos; ?></textarea>
								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Destinatario:<br>
									<textarea name="curso_destinatario"><?php echo $cursoDestinatarios; ?></textarea>
								</label>
							</div><!-- // .col -->
						</div>

						<div class="row">
							<div class="col-sm-8">
								<label>Objetivo Específico:<br>
									<textarea class="tinyeditorcursos" name="curso_objespecifico"><?php echo $cursoObjEspecifico; ?></textarea>
								</label>
							</div><!-- // .col -->
							<div class="col-sm-4">
								<div class="row">
									<div class="col-sm-8">
										<label>Destacado:<br>
										<?php if ( $cursoDestacado == 1 ) { ?>
											<input type="checkbox" name="cursos_destacado" checked>
										<?php } else { ?>
											<input type="checkbox" name="cursos_destacado">
										<?php } ?>
										</label>
									</div>
									<div class="col-sm-4">
										<label>Orden:<br>
											<input type="number" name="cursos_orden" value="<?php echo $cursoOrden; ?>">
										</label>
									</div>
								</div>
							</div><!-- // .col -->
						</div>
						
						<div class="btn-cursos-wrapper">
							<span class="msj-cursos-saved"></span>
							<button class="btn btn-danger btn-curso-save-item" data-tipo="formacion_tecnica" data-id="<?php echo $cursoID; ?>">Guardar Cambios</button>
							<button class="btn btn-success btn-curso-del-item" data-tipo="formacion_tecnica" data-id="<?php echo $cursoID; ?>">Borrar curso</button>
						</div>
					</article>
				</li>
				<?php
			}//while
		} //if post_type 
		  else if ( $post_type == 'no_formal' ) {
		  	//html cursos no formales
		  	while ($row = $result->fetch_array()) {
				$cursoID = $row['curso_ID'];
				$cursoTitulo = $row['curso_titulo'];
				$cursoResumen = $row['curso_resumen'];
				$cursoLugar = $row['curso_lugar'];//en no formales seria duracion
				$cursoHorarios = $row['curso_horarios'];
				$cursoOrden = $row['curso_orden'];

				?>
				<li>
					<article id="<?php echo $cursoID;?>">
						<div class="row">
							<div class="col-sm-8">
								<label>Título:<br>
									<input type="text" name="cursos_titulo" value="<?php echo $cursoTitulo; ?>">
								</label>
							</div><!-- // .col -->
							<div class="col-sm-4">
								<label>Orden:<br>
									<input type="number" name="cursos_orden" value="<?php echo $cursoOrden; ?>">
								</label>
							</div><!-- // .col -->
						</div>

						<div class="row">
							<div class="col-sm-6">
								<label>Duración:<br>
									<input type="text" name="cursos_titulo" value="<?php echo $cursoLugar; ?>">
								</label>
							</div><!-- // .col -->
							<div class="col-sm-6">
								<label>Horarios:<br>
									<input type="text" name="cursos_orden" value="<?php echo $cursoHorarios; ?>">
								</label>
							</div><!-- // .col -->
						</div>
						<div class="row">
							<div class="col-sm-12">
								<label>Resumen:<br>
									<textarea name="cursos_resumen"> <?php echo $cursoResumen; ?></textarea>
								</label>
							</div><!-- // .col -->
						</div>
						<div class="btn-cursos-wrapper">
							<span class="msj-cursos-saved"></span>
							<button class="btn btn-danger btn-curso-save-item" data-tipo="no_formal" data-id="<?php echo $cursoID; ?>">Guardar Cambios</button>
							<button class="btn btn-success btn-curso-del-item" data-tipo="no_formal" data-id="<?php echo $cursoID; ?>">Borrar curso</button>
						</div>
					</article>
				</li>
				<?php 
			}//while

		}//else if post_type
		else if ( $post_type == 'universitarios' ) {
			//html convenios universitarios
		  	while ($row = $result->fetch_array()) {
				$cursoID = $row['curso_ID'];
				$cursoTitulo = $row['curso_titulo'];
				$cursoContenido = $row['curso_objespecifico'];
				$cursoOrden = $row['curso_orden'];
				?>
				<li>
					<article id="<?php echo $cursoID;?>">
						<div class="row">
							<div class="col-sm-10">
								<label>Título:<br>
									<input type="text" name="cursos_titulo" value="<?php echo $cursoTitulo; ?>">
								</label>
							</div><!-- // .col -->
							<div class="col-sm-2">
								<label>Orden:<br>
									<input type="number" name="cursos_orden" value="<?php echo $cursoOrden; ?>">
								</label>
							</div><!-- // .col -->
						</div>

						<div class="row">
							<div class="col-sm-12">
								<label>Contenido:<br>
									<textarea class="tinyeditorcursos" name="cursos_contenido"> <?php echo $cursoContenido; ?></textarea>
								</label>
							</div><!-- // .col -->
						</div>
						<div class="btn-cursos-wrapper">
							<span class="msj-cursos-saved"></span>
							<button class="btn btn-danger btn-curso-save-item" data-tipo="universitarios" data-id="<?php echo $cursoID; ?>">Guardar Cambios</button>
							<button class="btn btn-success btn-curso-del-item" data-tipo="universitarios" data-id="<?php echo $cursoID; ?>">Borrar Convenio</button>
						</div>
					</article>
				</li>
				<?php 
			}//while

		}//else post_type
		
		closeDataBase($connection);
		
	}//else
}//listCursosAdmin ()


function showInstitutoAdmin ( $post_type ) {
	$connection = connectDB();
	$tabla = 'cursos';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_tipo='".$post_type."' ";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { 
	
		echo 'No hay nada cargado';
	
	} else { 
		$row = $result->fetch_array();

		?>
		<li>
			<article id="<?php echo $row['curso_ID']; ?>">

				<div class="row">
					<div class="col-sm-6">
						<label>Historia:<br>
							<textarea class="tinyeditorcursos" name="curso_metodologia"><?php echo $row['curso_metodologia']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Misión:<br>
							<textarea class="tinyeditorcursos" name="curso_objgeneral"><?php echo $row['curso_objgeneral']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Prácticas profesionales:<br>
							<textarea class="tinyeditorcursos" name="curso_requisitos"><?php echo $row['curso_requisitos']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Autoridades:<br>
							<textarea class="tinyeditorcursos" name="curso_certificado"><?php echo $row['curso_certificado']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Cuerpo docente:<br>
							<textarea class="tinyeditorcursos" name="curso_objespecifico"><?php echo $row['curso_objespecifico']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Frase:<br>
							<textarea class="" name="curso_cursada"><?php echo $row['curso_cursada']; ?></textarea>
						</label>

						<h4>Plan De estudios</h4>
						<a href="/uploads/pdfs/<?php echo $row['curso_archivo']; ?>" target="_blank" data-href="<?php echo $row['curso_archivo']; ?>" class="archivo-curso"><?php echo $row['curso_archivo']; ?></a>
							<button class="btn btn-xs btn-change-archivo-curso">Cambiar archivo</button>
					</div><!-- // .col -->
				</div>
				
				<div class="row">
					<div class="col-sm-4">
						<label>Imagen:<br>
							<img data-href="<?php echo $row['curso_imagen']; ?>" class="img-responsive imagen-curso" src="/uploads/images/<?php echo $row['curso_imagen']; ?>">
							<button class="btn btn-xs btn-change-image-curso">Cambiar imagen</button>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-4">
						<label>Titulación:<br>
							<input type="text" name="curso_titulo" value="<?php echo $row['curso_titulo']; ?>">
						</label>
						<label>Rama de conocimiento:<br>
							<input type="text" name="curso_slug" value="<?php echo $row['curso_slug']; ?>">
						</label>
						<label>Duración:<br>
							<input type="text" name="curso_dataextra1" value="<?php echo $row['curso_dataextra1']; ?>">
						</label>
						<label>Modalidad:<br>
							<input type="text" name="curso_dataextra2" value="<?php echo $row['curso_dataextra2']; ?>">
						</label>
					</div><!-- // .col -->
					<div class="col-sm-4">
						<label>Dependencia:<br>
							<input type="text" name="curso_dataextra3" value="<?php echo $row['curso_dataextra3']; ?>">
						</label>
						<label>Plan de Titulación:<br>
							<input type="text" name="curso_resumen" value="<?php echo $row['curso_resumen']; ?>">
						</label>
						<label>Lugar:<br>
							<input type="text" name="curso_lugar" value="<?php echo $row['curso_lugar']; ?>">
						</label>
					</div><!-- // .col -->
				</div>

				<div class="row">
					<div class="col-sm-6">
						<label>Horarios:<br>
							<textarea class="tinyeditorcursos" name="curso_horarios"><?php echo $row['curso_horarios']; ?></textarea>
						</label>
					</div><!-- // .col -->
					<div class="col-sm-6">
						<label>Inscripciones:<br>
							<textarea class="tinyeditorcursos" name="curso_destinatario"><?php echo $row['curso_destinatario']; ?></textarea>
						</label>
					</div><!-- // .col -->
				</div>

				<div class="row">

					<div class="col-sm-12 btn-cursos-wrapper">
						<span class="msj-cursos-saved"></span>
						<button class="btn btn-danger btn-curso-save-item" data-tipo="instituto" data-id="<?php echo $row['curso_ID']; ?>">Guardar Cambios</button>
					</div>	

				</div>

				
			</article>
		</li>
	<?php }//else
	mysqli_close($connection);
}//showInstitutoAdmin()


function showBeneficiosAdmin() {
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
			<h3 class="beneficio-item-titulo"><?php echo $beneficioTitulo; ?></h3>
			<div class="beneficio-item" id="<?php echo $beneficioID; ?>">
				<div class="row">
					<div class="col-sm-4">
						<img src="/uploads/images/<?php echo $beneficioImagen; ?>" data-href="<?php echo $beneficioImagen; ?>" class="img-responsive">
						<button class="btn btn-xs btn-primary btn-change-image-beneficio">Cambiar imagen</button>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<div class="col-sm-10">
								<label>Título:<br>
									<input type="text" name="beneficio_titulo" value="<?php echo $beneficioTitulo; ?>">	
								</label>
								<label>Incluye:<br>
									<input type="text" name="beneficio_incluye" value="<?php echo $beneficioIncluye; ?>">	
								</label>
							</div>
							<div class="col-sm-2">
								<label>Orden:<br>
									<input type="text" name="beneficio_orden" value="<?php echo $beneficioOrden; ?>">
								</label>
							</div>
							<div class="col-sm-12">
								<label>Requisitos:<br>
									<textarea class="tinymce-beneficios" name="beneficio_texto"><?php echo $beneficioTexto; ?></textarea>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p class="btns-item-footer">
							<span class="msj-beneficio-saved"></span>
							<button class="btn btn-sm btn-success btn-save-beneficios-item" data-id="<?php echo $beneficioID; ?>">Guardar cambios</button>
							<button class="btn btn-sm btn-danger btn-del-beneficios-item" data-id="<?php echo $beneficioID; ?>">Borrar elemento</button>
						</p>
					</div>
				</div>

			</div>
		<?php
		}//while
	}//else
	mysqli_close($connection);
};//showBeneficiosAdmin()

function showPageAdmin ( $id ) {
	$connection = connectDB();
	$tabla = 'pages';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " WHERE page_ID='".$id."'";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { 
	
		echo 'No existe esta página';
	
	} else {
		$row = $result->fetch_array(); 
		$pageID = $row['page_ID'];
		$pageTitulo = $row['page_titulo'];
		$pageContenido = $row['page_text'];
		$pageImagen = $row['page_imagen'];

		?>

		<div class="row">
				<div class="col-sm-12">
					<label>Titulo página:<br>
					<input type="text" name="page_titulo" value="<?php echo $pageTitulo; ?>"></label>
				</div>
				<div class="col-sm-12">
					<label>Contenido página:<br>
						<textarea id="textoPrincipal"><?php echo $pageContenido; ?></textarea>
					</label>
				</div>
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
						<?php if ( $pageImagen == '' ) { ?>
							<img src="" data-href="" class="img-responsive">
							<button class="btn btn-sm btn-change-imagen">Agregar imagen</button>
						<?php } else { ?>
							<img src="/uploads/images/<?php echo $pageImagen; ?>" data-href="<?php echo $pageImagen; ?>" class="img-responsive">
							<button class="btn btn-sm btn-change-imagen">Cambiar imagen</button>
						<?php } ?>
						</div>
						<div class="col-sm-8">
							<p class="btns-item-footer">
								<span class="msj-page-saved"></span>
								<button class="btn btn-sm btn-success btn-save-page" data-id="<?php echo $pageID; ?>">Guardar cambios</button>
							</p>		
						</div>
					</div>
					
				</div>
			</div>

			<?php
	}//else
	mysqli_close($connection);
}//showPageAdmin()

function showPreguntasAdmin() {
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
			<h3 class="pregunta-item-titulo"><?php echo $preguntaTitulo; ?></h3>
			<div class="pregunta-item" id="<?php echo $preguntaID; ?>">
				<div class="row">
					<div class="col-sm-2">
						<img src="/uploads/images/<?php echo $preguntaImagen; ?>" data-href="<?php echo $preguntaImagen; ?>" class="img-responsive">
						<button class="btn btn-xs btn-primary btn-change-image-pregunta">Cambiar imagen</button>
					</div>
					<div class="col-sm-10">
						<div class="row">
							<div class="col-sm-10">
								<label>Título:<br>
									<input type="text" name="pregunta_titulo" value="<?php echo $preguntaTitulo; ?>">	
								</label>
							</div>
							<div class="col-sm-2">
								<label>Orden:<br>
									<input type="text" name="pregunta_orden" value="<?php echo $preguntaOrden; ?>">
								</label>
							</div>
							<div class="col-sm-12">
								<label>Contenido:<br>
									<textarea class="tinymce-pregunta" name="pregunta_texto"><?php echo $preguntaTexto; ?></textarea>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p class="btns-item-footer">
							<span class="msj-preguntas-saved"></span>
							<button class="btn btn-sm btn-success btn-save-pregunta-item" data-id="<?php echo $preguntaID; ?>">Guardar cambios</button>
							<button class="btn btn-sm btn-danger btn-del-pregunta-item" data-id="<?php echo $preguntaID; ?>">Borrar elemento</button>
						</p>
					</div>
				</div>

			</div>
		<?php
		}//while
	}//else
	mysqli_close($connection);
}//showPreguntasAdmin()

function showPrevencionAdmin() {
	$connection = connectDB();
	$tabla = 'prevencion';
	
	//queries según parámetros 
	$query  = "SELECT * FROM " .$tabla. " ORDER by prevencion_orden";	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) { 
	
		echo 'No hay nada cargado';
	
	} else {
		while ($row = $result->fetch_array()) {
			$prevencionID = $row['prevencion_ID'];
			$prevencionTitulo = $row['prevencion_titulo'];
			$prevencionTexto = $row['prevencion_texto'];
			$prevencionOrden = $row['prevencion_orden'];
			?>
			<h3 class="prevencion-item-titulo"><?php echo $prevencionTitulo; ?></h3>
			<div class="prevencion-item" id="<?php echo $prevencionID; ?>">
				<div class="row">
					<div class="col-sm-1">
						<label>Orden:<br>
							<input type="text" name="prevencion_orden" value="<?php echo $prevencionOrden; ?>">
						</label>
					</div>
					<div class="col-sm-11">
						<label>Título:<br>
							<input type="text" name="prevencion_titulo" value="<?php echo $prevencionTitulo; ?>">	
						</label>
						<label>Contenido:<br>
							<textarea class="tinymce-prevencion" name="prevencion_texto"><?php echo $prevencionTexto; ?></textarea>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p class="btns-item-footer">
							<span class="msj-prevencion-saved"></span>
							<button class="btn btn-sm btn-success btn-save-prevencion-item" data-id="<?php echo $prevencionID; ?>">Guardar cambios</button>
							<button class="btn btn-sm btn-danger btn-del-prevencion-item" data-id="<?php echo $prevencionID; ?>">Borrar elemento</button>
						</p>
					</div>
				</div>

			</div>
		<?php
		}//while
	}//else
	mysqli_close($connection);
}//showPrevencionAdmin()

function showLaboratorioAdmin() {
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
			$laboratorioOrden = $row['laboratorio_orden'];
			?>
			<h3 class="laboratorio-item-titulo"><?php echo $laboratorioTitulo; ?></h3>
			<div class="laboratorio-item" id="<?php echo $laboratorioID; ?>">
				<div class="row">
					<div class="col-sm-4">
						<img src="/uploads/images/<?php echo $laboratorioImagen; ?>" data-href="<?php echo $laboratorioImagen; ?>" class="img-responsive">
						<button class="btn btn-xs btn-primary btn-change-image-laboratorio">Cambiar imagen</button>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<div class="col-sm-10">
								<label>Título:<br>
									<input type="text" name="laboratorio_titulo" value="<?php echo $laboratorioTitulo; ?>">	
								</label>
							</div>
							<div class="col-sm-2">
								<label>Orden:<br>
									<input type="text" name="laboratorio_orden" value="<?php echo $laboratorioOrden; ?>">
								</label>
							</div>
							<div class="col-sm-12">
								<label>Contenido:<br>
									<textarea class="tinymce-laboratorio" name="laboratorio_texto"><?php echo $laboratorioTexto; ?></textarea>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p class="btns-item-footer">
							<span class="msj-laboratorio-saved"></span>
							<button class="btn btn-sm btn-success btn-save-laboratorio-item" data-id="<?php echo $laboratorioID; ?>">Guardar cambios</button>
							<button class="btn btn-sm btn-danger btn-del-laboratorio-item" data-id="<?php echo $laboratorioID; ?>">Borrar elemento</button>
						</p>
					</div>
				</div>

			</div>
		<?php
		}//while
	}//else
	mysqli_close($connection);
}//showLaboratorioAdmin()


function showhomeAdmin ( ) {
	$connection = connectDB();
	$tabla = 'homepage';

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay nada cargado';
	} else { 

	$data = $result->fetch_array();
		
	}

	$homeContent = array(
	    'audiovisual' => array(
	        'titulo' => $data['audiovisual_titulo'],
	        'video' => $data['audiovisual_video'],
	        'parrafo' => $data['audiovisual_parrafo'],
	    ),
	    'voces' => array(
	        'titulo' => $data['voces_titulo'],
	        'imagen' => $data['voces_imagen'],
	        'parrafo' => $data['voces_parrafo'],
	        'url' => $data['voces_url'],
	    ),
	    'afiliate' => array(
	        'titulo' => $data['afiliate_titulo'],
	        'imagen' => $data['afiliate_imagen'],
	        'parrafo' => $data['afiliate_parrafo'],   
	        'url' => $data['afiliate_url'],
	    ),
	    'banners' => unserialize($data['banners']),
	    'conectados' => array(
	        'texto' => $data['conectados_texto'],
	        'video' => $data['conectados_video'],
	        'url' => $data['conectados_url'],
	    ),
	    'frase' => $data['frase'],
	);

	//devuelve el array de contenido
	return $homeContent;
}
