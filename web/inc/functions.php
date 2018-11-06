<?php 
/*
 * Sitio web: Atsa
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

require_once 'connect.php';

//busca el template $name = nombre del archivo sin extensión, se le puede pasar datos por un array
function getTemplate ( $name, $data = array() ) {
	$error = '404';
	$namePage = TEMPLATEDIR . '/'. $name. '.php';

	if (is_file($namePage)) {
		include $namePage;
	} else {
		include TEMPLATEDIR . '/'. $error. '.php';		
	}
}

//devuelve la url base para que los scripts, css, e imagenes funcionen perfecto con las permalinks
function urlBase() {
	$urlBase = 'https://'.$_SERVER['HTTP_HOST'];
	return $urlBase;
}

/*
 * Define la page actual y redirecciona segun url, devuelve el slug o template part.
 * a) En el caso de que sean paginas, busca el template en la carpeta templates y listo.
 * b) En el caso de que sea noticia, categoria o curso, busca el template adecuado (cursos = curso.php / o en en el archivo index elige la primera opcion (la segunda es de paginas).
 * Pero ademas, e importante, busca en la base de datos mediante el slug. Si es noticia hace un loop de la categoria elegida o de todas las noticias y si es noticia single busca la noticia específica.
 *
*/
function pageActual () {
	global $categoriaNoticias;
	global $esNoticias;
	global $noticiaSingle;
	global $esCategoria;
	global $curso;
	global $noticia;
	global $tag;
	global $etiqueta;
	$slug = 'home'; //slug por defecto
	
	//borramos la barra / luego del dominio:
	$url = $_SERVER['REQUEST_URI'];
	$parseUrl = explode('/', $url);
	$RequestURI = $parseUrl[1];
	//busca el simbolo ? en la url
	$permalink = strpos($RequestURI, '?');
	$permalink2 = strpos($RequestURI, '&');
	
	//si el url es bonito procesa la primera opcion
	if ( $permalink === false && $permalink2 === false ) {
		
		//si no está vacío, hay que procesar cual es
		if ( $url != '/' ) {

			$slug = $RequestURI;

			//si este slug es noticias hay 3 opciones. 1 loop por defecto, 2 loop por categoria o 3 noticia single
			if ( $slug == 'noticias' ) {
				$esNoticias = true;
				
				$noticias = $parseUrl;
				//si la variable noticias contiene cuatro instrucciones son categorias, si son 3 es una noticia single, se modifica el slug para indicar o la categoria o la noticia y se indica a que template pertenece
				
				if (in_array('categoria', $noticias)) {
				    $esCategoria = true;
					$categoriaNoticias = $noticias[3];
					
				}  else if ( in_array('etiquetas', $noticias) ) {
					$tag = true;
					$etiqueta = $noticias[3];
				} else {
					if ( !empty($noticias[2]) ) {
						//si en el indice 3 del array noticias, no hay nada, significa que no es una noticia, porque en ese lugar debería estar el título
						$noticiaSingle = true;
						$noticia = $noticias[2];
					}
				}
			
			}

			//si este slug es curso lo que hace es actualizar la variable global curso que por defecto es none
			if ( $slug == 'curso' ) {
				$cursos = $parseUrl;
				$curso  = $cursos[2];
				echo $curso;
			}
		}
	} 
	//en cambio, si el url es feo y funciona con ids ejecuta la segunda opcion
	
	else {
		//BUSCAR PAGE EN EL URL, por defecto sería home
		$slug = isset($_REQUEST['page'])?$_REQUEST['page']:'home';
		
		//BUSCAR CAT EN EL URL por defecto la categoria es none
		$categoriaNoticias = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';
		if ( $categoriaNoticias != 'none' ) {
			//cambia el template a noticias y categorias
			$esNoticias = true;
			$esCategoria = true;
			//cambia el slug para mostrar la cagetoria
			$slug = 'noticias';
		}
		//BUSCAR NOTICIA EN EL URL por defecto es none
		$noticia = isset($_REQUEST['noticia'])?$_REQUEST['noticia']:'none';
		if ( $noticia != 'none' ) {
			//cambia el template a noticias y a noticia individual
			$esNoticias = true;
			$noticiaSingle = true;
			//cambia el slug al de noticia también
			$slug = 'noticias';
		}
		//BUSCA CURSOS EN EL URL por defecto es none
		$curso = isset($_REQUEST['curso'])?$_REQUEST['curso']:'none';
		if ( $curso != 'none' ) {
			//cambia el slug a cursos que es la pagina de cursos
			$slug = 'curso';
		}
	}
	//finalmente si el slug es 'noticia' hay que definir el template como noticia porque no existe en templates noticias.php así que no lo va a encontrar
	if ( $slug == 'noticias' ) {
		$esNoticias = true;
	}

	return $slug;//devuelve el url de la noticia, de la pagina o de la categoria

}//pageActual()


//devuelve el título de la página para <head><title>
function SeoTitlePage ( $pageActual ) {
	global $curso;
    //titulo por defecto (home page)
    $tituloBase   = 'ATSA |';
    $pageSEOTitle = ' Asociación de trabajadores de la Sanidad Argentina | Buenos Aires';

    //titulo cuando no es home ni noticias
    if ( $pageActual != 'home' && $pageActual != 'noticias' ) {
        //si la página no es home hay que separar la url que está unido por "-" para armar un nuevo título
        $pageActualTitle = explode('-', $pageActual);
        $pageSEOTitle = '';
        for ($i=0; $i < count($pageActualTitle); $i++) { 
            $pageSEOTitle .= ' ';
            $pageSEOTitle .= ucfirst($pageActualTitle[$i]);
        }
    }

    //titulo si es noticias
    if ( $pageActual == 'noticias' ) {
        global $noticiaSingle;
        global $esCategoria;
        global $categoriaNoticias;
        global $noticia;
        
        //si es una noticia:
        if ( $noticiaSingle ) {
            $pageActualTitle = explode('-', $noticia);
            $pageSEOTitle = '';
            for ($i=0; $i < count($pageActualTitle); $i++) { 
                $pageSEOTitle .= ' ';
                $pageSEOTitle .= ucfirst($pageActualTitle[$i]);
            }
            
        } else if ( $esCategoria ) {
            //si es categoria
            $pageSEOTitle = ' Últimas Noticias: ';
            $pageSEOTitle .= ucfirst($categoriaNoticias);
        } else {
            $pageSEOTitle = ' Últimas Noticias';
        }
    }

    //si es curso
	if ( $pageActual == 'curso' ) {
		$pageSEOTitle = ' Cursos:';
		$pageActualTitle = explode('-', $curso);
		for ($i=0; $i < count($pageActualTitle); $i++) { 
            $pageSEOTitle .= ' ';
            $pageSEOTitle .= ucfirst($pageActualTitle[$i]);
        }
	}

    return $tituloBase . $pageSEOTitle;
} //SeoTitlePage()


//define el metadescription en la etiqueta Head para SEO
function metaDescriptionText ( $pageActual, $noticia, $curso, $categoriaNoticias ) {
	$metaDescription = DEFAULTDESCRIPTION;
	

	if ( $noticia != 'none') {
		global $dataNoticia;
		$base = ' | Asociación de trabajadores de la Sanidad Argentina, Buenos Aires.';
		$metaDescription = $dataNoticia['resumen'] . $base;
	}

	if ( $categoriaNoticias != 'none') {
		$metaDescription = 'Últimas noticias ' .$categoriaNoticias. '. Asociación de trabajadores de la Sanidad Argentina, Buenos Aires.';
	}

	if ( $curso != 'none') {
		$metaDescription = 'Desde ATSA Bs As apostamos constantemente a la formación y actualización de nuestros compañeros con el fin de mejorar la calidad de nuestra actividad así como la seguridad de nuestros pacientes. En tal sentido, construimos el Instituto de Formación Técnico Profesional, un edificio exclusivo para la capacitación y perfeccionamiento de los trabajadores.';
	}

	return $metaDescription;

}//metaDescriptionText()



/*
 *
 * FUNCIONES CON BASE DE DATOS
 *
*/

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
function closeDataBase( $connection ){
    mysqli_close( $connection );
}

//muestra las noticias recientes se puede especificar la cant de post, la categoria y se puede excluir una noticia. Además tiene estilo columna para sidebar por default o row
function NoticiasRecientesHTML ( $cantPosts, $categoria = 'none', $exclude = 'none', $style = false, $offset = 0 ) {
	$noticiasPorPagina = $cantPosts;
	$connection = connectDB();
	$fecha_actual = strtotime(date("d-m-Y H:i:00"));
	$tabla = 'noticias';

	if ( $offset != '0' ) {
		$noticiasPorPagina = $offset.','.$cantPosts;
		//$noticiasPorPagina = '3,2';
	}

	$query  = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' ORDER by post_fecha desc LIMIT ".$noticiasPorPagina." ";

	if ( $categoria != 'none' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' AND post_categoria = '".$categoria."' ORDER by post_fecha desc LIMIT ".$noticiasPorPagina." ";
	}

	if ( $exclude != 'none' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_url!='".$exclude."' AND post_status='publicado' ORDER by post_fecha desc LIMIT ".$noticiasPorPagina." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Ninguna noticia ha sido cargada todavía</div>';
		echo $query;
	} else {

		while ($row = $result->fetch_array()) {
				$rows[] = $row;
			}

		foreach ($rows as $row ) { 
			$imgDestacada = $row['post_imagen'];
			$resumen      = $row['post_resumen'];
			$url          = $row['post_url'];
			$id           = $row['post_ID'];
			$titulo       = $row['post_titulo'];
			$date         = $row['post_fecha'];
			$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$fecha        = date("d", strtotime($date)) .' de '. $meses[date("n", strtotime($date))-1] .' de '. date("Y", strtotime($date));
			
			//si la fecha es posterior a hoy no se publica, y se saltea
			if($fecha_actual < strtotime($date) ){
			    continue;
			}

			//la versión style no tiene fecha y el formato es más cuadrado, el texto va sobre la imagen
			if ($style) {
			?>
		
		<li class="loop-recientes-item-row">
			<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">
				<article class="noticia-recientes-item">
					
					<div class="recientes-img-loop-row">
						<?php 
						if ( $imgDestacada != '' ) { ?>
							<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="<?php echo $titulo; ?> | Noticias-ATSA">
						
						<?php 
						
						} else { ?>
							<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
						<?php 
						} ?>

					</div>
					<div class="recientes-text-loop-row">
						<h1>
							<?php echo $titulo; ?>
						</h1>
					</div>
				</article>
			</a>
		</li>
		

		<?php } else {
				//stylo default (sidebar)
			?>
		<li class="loop-recientes-item">
			<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">
				<article class="noticia-recientes-item">
					
					<div class="recientes-img-loop">
						<?php 
						if ( $imgDestacada != '' ) { ?>
							<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="<?php echo $titulo; ?> | Noticias-ATSA">
						
						<?php 
						
						} else { ?>
							<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
						<?php 
						} ?>

					</div>
					<div class="recientes-text-loop">
						<h1>
							<?php echo $titulo; ?>
						</h1>
						
						<p>
							<?php echo $fecha ?>
						</p>
					</div>
				</article>
			</a>
		</li>
	<?php }
		}//cierra for each
	} //else
	mysqli_close($connection);
}//NoticiasRecientesHTML()


//archivo de noticias por mes
function archivoNoticias () {
	$connection   = connectDB();
	$tabla        = 'noticias';
	$query        = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' ORDER by post_fecha DESC";
	$ActualDate   = getdate();
	$mesActual    = $ActualDate['mon']+1; //al mes actual suma 1
	$primerMes    = true;
	$result       = mysqli_query($connection, $query);
	$cantidadPost = $result->num_rows;
	$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$postIndice   = 1;
	$fecha_actual = strtotime(date("d-m-Y H:i:00"));

	if ( $cantidadPost == 0 ) {
		echo '<div>Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ( $row = $result->fetch_array() ) {
				$rows[] = $row;
			}
		
		foreach ( $rows as $row ) { 
			$url          = $row['post_url'];
			$titulo       = $row['post_titulo'];
			$date         = $row['post_fecha'];
			$fechaMes     = date("n", strtotime($date));
			$fechaYear    = date("Y", strtotime($date));
			
			//si la fecha es posterior a hoy no se publica, y se saltea
			if($fecha_actual < strtotime($date) ){
			    continue;
			}



			//la primera vuelta está obligado a crear todo
			if ( $primerMes ) { ?>
			<!-- item tab -->
				<h3>
				  	<?php echo $meses[$fechaMes-1] . ' ' . $fechaYear; ?>
				</h3>
				<div>
					<ul class="content-archivo">
						<li>
							<a href="/noticias/<?php echo $url; ?>">
								<?php echo $titulo; ?>
							</a>
						</li>
				<?php
				//define el mes actual como la fecha de este post
				$mesActual = $fechaMes;
				$primerMes = false;
				if ( $postIndice ==  $cantidadPost ) { ?>
						</ul>
					</div>
					<?php
				} else {
					$postIndice ++;
				}

				//2. en cada vuelta chequea que el post sea del mismo mes o sea un mes nuevo
			} else if ( $mesActual == $fechaMes ) {
				//como el mes actual siempre al primero es uno más en la primer ronda está obligado a crearlo
				?>
						<li>
							<a href="/noticias/<?php echo $url; ?>">
								<?php echo $titulo; ?>
							</a>
						</li>
				<?php
					if ( $postIndice ==  $cantidadPost ) { ?>
						</ul>
					</div>
					<?php
					} else {
						$postIndice ++;
					}
				//3. si es otro mes lo tiene que crear nuevamente y actualizar la variable mes actual para que la proxima vuelta no cree el mes otra vez
				} else {
					$mesActual = $fechaMes;
				 	?>
				 	</ul>
				</div>
			<!-- item tab -->
				<h3>
				  	<?php echo $meses[$fechaMes-1] . ' ' . $fechaYear; ?>
				</h3>
				<div>
					<ul class="content-archivo">
						<li>
							<a href="/noticias/<?php echo $url; ?>">
								<?php echo $titulo; ?>
							</a>
						</li>
					<?php
					
					if ( $postIndice ==  $cantidadPost ) { ?>
						</ul>
					</div>
					<?php
				} else {
						$postIndice ++;
					}
				}
		}//for each
	}//else
	mysqli_close($connection);
} //archivoNoticias ()


//muestra html del loop de noticias de acuerdo a su categoría
function loopNoticiasHTML ( $categoria ) {
	$fecha_actual = strtotime(date("d-m-Y H:i:00"));
	$noticiasPorPagina = 3;
	$connection = connectDB();
	$tabla = 'noticias';
	$query  = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' ORDER by post_fecha desc LIMIT ".$noticiasPorPagina." ";

	if ( $categoria != 'none' ) {
		$query  = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' AND post_categoria = '".$categoria."' ORDER by post_fecha desc LIMIT ".$noticiasPorPagina." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ( $row = $result->fetch_array() ) {
			$rows[] = $row;
		}

		foreach ($rows as $row ) { 
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
			$date         = $row['post_fecha'];

			$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$dia          = date("d", strtotime($date));
			$mes          = $meses[date("n", strtotime($date))-1];
			$year         = date("Y", strtotime($date));
		
			if ( $resumen == '' ) {
				$resumen = $bajada;
			}

			//si la fecha es posterior a hoy no se publica, y se saltea
			if($fecha_actual < strtotime($date) ){
			    continue;
			}

			?>
			<li class="loop-noticias-item">
				<article class="noticia-index">
					<header>
						<h1>
							<?php echo $titulo; ?>
						</h1>
					</header>
					<section>
						<div class="meta-data-news">
							<div class="date-news">
								<p>
									<strong>
									<?php echo $dia; ?>
									</strong><br>
									de <?php echo $mes .' '. $year; ?>
								</p>
							</div>

							<?php 
							if ( $imgDestacada != '' ) { ?>
								<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">
									<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="<?php echo $titulo; ?> | Noticias-ATSA">
								</a>
							<?php 
							
							} else {

							?>
								<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
							<?php 
							} ?>
						</div>
						<p class="excerpt-news">
							<?php echo $bajada; ?>
						</p>
					</section>
					<footer>
						<div class="btn-noticia-index">
							<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">Leer más</a>
						</div>
					</footer>
				</article>
			</li>
		<?php

		}//FOREACH
	}//ELSE
	mysqli_close($connection);
} //loopNoticiasHTML()


//busca la noticia en particular y recoge los datos para pasar al template
function singlePostHTML ( $noticia ) {
	$connection = connectDB();
	$tabla = 'noticias';
	$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$noticia."' LIMIT 1 ";

	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		header("Location: /404");
	} else {

		$data = mysqli_fetch_array($result);

		$date         = $data['post_fecha'];
		$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$dia          = date("d", strtotime($date));
		$mes          = $meses[date("n", strtotime($date))-1];
		$year         = date("Y", strtotime($date));
		$resumen      = $data['post_resumen'];
		$bajada       = $data['post_bajada'];
		$galeria      = $data['post_galeria'];
 		$imgGaleria   = array();
		//si no hay resumen toma la bajada
		if ( $resumen == '' ) {
			$resumen = $bajada;
		}

		if ( $galeria ) {
			$imgGaleria = unserialize( $data['post_imagenesGal'] );
		}

		$dataNoticia = array(
			'titulo'       => $data['post_titulo'],
			'url'          => $data['post_url'],
			'imgDestacada' => $data['post_imagen'],
			'resumen'      => $resumen,
			'bajada'       => $bajada,
			'contenido'    => $data['post_contenido'],
			'video'        => $data['post_video'],
			'categoria'    => $data['post_categoria'],
			'etiquetas'    => $data['post_etiquetas'],
			'galeria'      => $data['post_galeria'],
			'imgGaleria'   => $imgGaleria,
			'dia'          => $dia,
			'mes'          => $mes,
			'year'         => $year,	
		);

		return $dataNoticia;
		
	}//ELSE
	mysqli_close($connection);
} //singlePostHTML()

//busca el curso en particular y recoge los datos para pasar al template
function singleCursoHTML ( $curso ) {
	$connection = connectDB();
	$tabla = 'cursos';
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_slug='".$curso."' LIMIT 1 ";
		
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>No hay ningún curso cargado</div>';
	} else {

		$data = mysqli_fetch_array($result);

		$dataCurso = array(
			'titulo'        => $data['curso_titulo'],
			'url'           => $data['curso_slug'],
			'imagen'        => $data['curso_imagen'],
			'metodologia'   => $data['curso_metodologia'],
			'general'       => $data['curso_objgeneral'],
			'especifico'    => $data['curso_objespecifico'],
			'requisitos'    => $data['curso_requisitos'],
			'certificado'   => $data['curso_certificado'],
			'cursada'       => $data['curso_cursada'],
			'lugar'         => $data['curso_lugar'],
			'horarios'      => $data['curso_horarios'],
			'destinatarios' => $data['curso_destinatario'],
			'destacado'     => $data['curso_destacado'],
		);

		return $dataCurso;
		
	}//ELSE
	mysqli_close($connection);
} //singlecurso()

//busca los hoteles y recoge los datos para pasar al template
function hotelesLoopHTML () {
	$connection = connectDB();
	$tabla = 'hoteles';
	$query  = "SELECT * FROM " .$tabla. " WHERE hotel_dataextra='hotel' LIMIT 1 ";
		
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>No existe este curso o no fue encontrado</div>';
	} else {

		while ( $row = $result->fetch_array() ) {
			$rows[] = $row;
		}

		foreach ($rows as $row ) { 
			$locationTag           = $row['hotel_location'];
			$titleHotel            = $row['hotel_titulo'];
			$descriptionHotel      = $row['hotel_description'];
			$listaServiciosHotel   = $row['hotel_servicios'];
			$dataExtraHotel        = $row['hotel_dataextra'];
			$iconTipoHotel         = $row['hotel_icontipo'];
			$iconServiciosHotel    = $row['hotel_iconservicios'];
			$thumnailhotel         = $row['hotel_thumnail'];
			$infoContingentesHotel = $row['hotel_contingente'];
		}	
		
	}//ELSE
	mysqli_close($connection);
} //singlePostHTML()

//muestra etiquetas en sidebar u otro lado
function printTags() {
	$connection = connectDB();
	$tabla = 'etiquetas';
	$query  = "SELECT * FROM " .$tabla. " ";
		
	$result = mysqli_query($connection, $query);

	while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) { ?>
		<a href="/noticias/etiquetas/<?php echo $row['tag_name']; ?>" class="btn-tag-name"><?php echo $row['tag_name']; ?></a>	
	<?php }

	mysqli_close($connection);
}//printTags()

function searchPostWithTags($tag) {
	$connection = connectDB();
	$tablaNoticias = 'noticias';
	$tablaEtiquetas = 'etiquetas';
	$cantPosts = 20;
	$PostFound = 0;
	
	$query  = "SELECT * FROM " .$tablaEtiquetas. " WHERE tag_name='".$tag."' ";
	$result = mysqli_query($connection, $query);
	//el resultado siempre es 1, esa etiqueta
	$postsID = $result->fetch_array(MYSQLI_ASSOC);
	$postsID = unserialize($postsID['tag_posts']);
	
	//si la cantidad de posts que hay es menor a la referida entonces que sea el total
	if ($cantPosts > count($postsID) ) {
		$cantPosts = count($postsID);
	}

	for ($i=0; $i < $cantPosts; $i++) { 
		$postID = strval($postsID[$i]);
		$query  = "SELECT * FROM " .$tablaNoticias. " WHERE post_ID='".$postID."' ";
		$result = mysqli_query($connection, $query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		
		if ( !is_null($row) ) {
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
			$date         = $row['post_fecha'];

			$meses        = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
			$dia          = date("d", strtotime($date));
			$mes          = $meses[date("n", strtotime($date))-1];
			$year         = date("Y", strtotime($date));
		
			if ( $resumen == '' ) {
				$resumen = $bajada;
			}
			
			?>
				<li class="loop-noticias-item">
					<article class="noticia-index">
						<header>
							<h1>
								<?php echo $titulo; ?>
							</h1>
						</header>
						<section>
							<div class="meta-data-news">
								<div class="date-news">
									<p>
										<strong>
										<?php echo $dia; ?>
										</strong><br>
										de <?php echo $mes .' '. $year; ?>
									</p>
								</div>

								<?php 
								if ( $imgDestacada != '' ) { ?>
									<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">
										<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="<?php echo $titulo; ?> | Noticias-ATSA">
									</a>
								<?php 
								
								} else {

								?>
									<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
								<?php 
								} ?>
							</div>
							<p class="excerpt-news">
								<?php echo $bajada; ?>
							</p>
						</section>
						<footer>
							<div class="btn-noticia-index">
								<a href="/noticias/<?php echo $url; ?>" title="Leer noticia">Leer más</a>
							</div>
						</footer>
					</article>
				</li>
			<?php
			$PostFound++;
		}
	}//for

	if ( $PostFound == 0) {
		echo '<div>No hay noticias cargadas con esta etiqueta</div>';
	}

	//cierre base de datos
	mysqli_close($connection);
}//searchPostWithTags()


//busca el slider en base de datos de acuerdo a su 'ubicacion' pasada
function getSliders( $slider ) {

	$connection = connectDB();
	$tabla = 'sliders';
	$query  = "SELECT * FROM " .$tabla. " WHERE slider_ubicacion='".$slider."' ORDER by slider_orden asc";
		
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div></div>';
	} else {

		while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
			$dataSlider[] = $row;
		}
		
		//selecciona el template html y le pasa la info
		getTemplate( 'sliders', $dataSlider);

	}//else
	mysqli_close($connection);
} //getSliders()



/*
muestra los links que estan cargados de la sección deportes
*/
function showLinksDeportes () {
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
			
			if ( $result2->num_rows == 0 ) {
				continue;
			 } else { 
				//se arma el html. Primero va el titulo de la sección
				?>
				<!-- item tab -->
				<h3>
					<span class="text-title-accordion">
							<?php echo $textoSecciones[$i]; ?>
					</span>
				<span class="icon-suma"></span>
				</h3>
				<div class="contenido-accordion-deportes">
					<ul>
			
				<?php
				while ($rowitem = $result2->fetch_array()) {					

					$orden = $rowitem['deportes_orden'];
					$IDItem = $rowitem['deportes_id'];
					$textoItem = $rowitem['deportes_texto'];
					$urlItem = $rowitem['deportes_url'];
					
					?>
						<li>
							<a href="<?php echo '/uploads/pdfs/' . $urlItem; ?>" target="_blank">
								<?php echo $textoItem; ?>
							</a>
						</li>	

				<?php }//while
				
				//cierre de la seccion
				?>
					</ul>
				</div>
			<?php }//else

		}//for de secciones

	}//else
	mysqli_close($connection);
}//showLinksDeportes()

/*
muestra los links que estan cargados de la sección convenios
*/
function showLinksConvenios () {
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
			
			if ( $result2->num_rows == 0 ) {
				continue;
			 } else { 
				//se arma el html. Primero va el titulo de la sección
				?>
				<!-- item tab -->
				<h3 class="ui-accordion-header-open">
				  	<span class="text-title-accordion">
				  		<?php echo $textoSecciones[$i]; ?>
				  	</span>
				  	<span class="icon-cross"></span>
				</h3>
				
				<div>
					<ul class="pdfs-download pdfs-download-acordion">
			
				<?php
				while ($rowitem = $result2->fetch_array()) {					

					$orden = $rowitem['convenios_orden'];
					$IDItem = $rowitem['convenios_id'];
					$textoItem = $rowitem['convenios_texto'];
					$urlItem = $rowitem['convenios_url'];
					$linkItem = $rowitem['convenios_link'];
					
					?>
						<li class="pdfs-download-item">
							<?php if ( $linkItem == '1' ) { ?>
							<a href="<?php echo $urlItem; ?>" target="_blank">
							<?php } else { ?>
							<a href="<?php echo 'uploads/pdfs/' . $urlItem; ?>" target="_blank">
							<?php } ?>
								<?php echo $textoItem; ?>
							</a>
						</li>	

				<?php }//while
				
				//cierre de la seccion
				?>
					</ul>
				</div>
			<?php }//else

		}//for de secciones

	}//else
	mysqli_close($connection);
}//showLinksConvenios()


function showLeyes() {
	$connection = connectDB();
	$tabla = 'convenios';
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE convenios_seccion='leyes' ORDER by convenios_orden";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		echo 'No hay ninguna cargada';
	} else { 

	while ($rowitem = $result->fetch_array()) {					

		$orden = $rowitem['convenios_orden'];
		$IDItem = $rowitem['convenios_id'];
		$textoItem = $rowitem['convenios_texto'];
		$urlItem = $rowitem['convenios_url'];
		$linkItem = $rowitem['convenios_link'];
		
		if ( $linkItem == '0') { ?>
			<li class="pdfs-download-item">
	    		<a href="uploads/pdfs/<?php echo $urlItem; ?>" target="_blank">
	    			<?php echo $textoItem; ?>
	    		</a>
	    	</li>
		<?php } else {

		?>
			<li class="pdfs-download-item">
	    		<a href="<?php echo $urlItem; ?>" target="_blank">
	    			<?php echo $textoItem; ?>
	    		</a>
	    	</li>

	<?php }//else
		}//while
	}//else
	mysqli_close($connection);
}//showLeyes()

//mmustra autoridades, vocales, delegados. Primer parámetro elige cual tipo de staff, el segundo estilo: uno para delegados (de dos en dos), otro para unico (sin lista) y otro normal (li)
function showStaff( $delegados, $style = 'default') {
	$connection = connectDB();
	$tabla = 'staff';
	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE staff_post_type='".$delegados."' ORDER by staff_orden";	
	$result = mysqli_query($connection, $query);
	$count = 1;

	if ( $result->num_rows == 0 ) {
		echo 'No hay nada cargado';
	} else { 

		while ($row = $result->fetch_array()) {			
$count++;
			$nombre = $row['staff_nombre'];
			$cargo = $row['staff_cargo'];
			$img = $row['staff_image'];
			$trabajo = $row['staff_trabajo'];
			$redSocial = $row['staff_redsocial'];
			
			if ( $style == 'unique' ) { ?>

				<article class="staff-member">
	    			<?php if ( $img != '' ) { ?>
	    			<div class="staff-img-wrapper">
	    				<img class="staff-image" src="uploads/images/<?php echo $img; ?>" alt="<?php echo $nombre; ?> - Cargo - ATSA BsAS">
	    			</div>
	    			<?php } ?>
	    			<div class="staff-text">
	    				<h1 class="staff-name"><?php echo $nombre; ?></h1>
	    				<h5 class="staff-charge"><?php echo $cargo; ?></h5>
	    				<p class="staff-excerpt">
							<?php echo $trabajo; ?>
							<?php if ( $redSocial != '' ) { ?>
							<br>
							<em>
								<?php echo $redSocial; ?>
							</em>
							<?php } ?>
						</p>
	    			</div>
		    		</article>
				<?php } elseif ( $style == 'columnsx2' ) {
					
					
					?>
					<div class="col-sm-4">
						<!---- item Delegado ---->
		    			<li class="delegado-item">
		    				<article>
		    					<div class="delegado-img">
		    						<div class="delegado-img-wrapper">
		    							<img src="uploads/images/<?php echo $img; ?>" alt="Delegado ATSA">
		    						</div>
		    					</div>
		    					<div class="delegado-data">
		    						<h1><?php echo $nombre; ?></h1>
		    					</div>
		    				</article>
		    			</li>
		    		</div>
					<?php 

				} else {

			//estilo default son columnas con imagenes
			?>
				<!-- staff member -->
		    	<li class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		    		<article class="staff-member">
		    			<?php if ( $img != '' ) { ?>
		    			<div class="staff-img-wrapper">
		    				<img class="staff-image" src="uploads/images/<?php echo $img; ?>" alt="<?php echo $nombre; ?> - Cargo - ATSA BsAS">
		    			</div>
		    			<?php } ?>
		    			<div class="staff-text">
		    				<h1 class="staff-name"><?php echo $nombre; ?></h1>
		    				<h5 class="staff-charge"><?php echo $cargo; ?></h5>
		    				<p class="staff-excerpt">
								<?php echo $trabajo; ?>
								<?php if ( $redSocial != '' ) { ?>
								<br>
								<em>
									<?php echo $redSocial; ?>
								</em>
								<?php } ?>
							</p>
		    			</div>
		    		</article>
		    	</li><!-- // cols -->
		    	<!-- // staff member -->
			<?php }
			
		}//while
	}//else
	mysqli_close($connection);
}//showStaff()

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

function showPageHtml($id, $title=false) {
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

		
		if (! $title) : ?>
		<h1 class="sr-only">
			<?php echo $pageTitulo; ?>
		</h1>
		<?php else : ?>
			<h1 class="titulo-importante">
				<span><?php echo $pageTitulo; ?></span>
			</h1>
		<?php endif; ?>

		<div class="contenido">
			<?php echo $pageContenido; ?>
		</div>
	<?php
	}//else
	mysqli_close($connection);
}; //showPageHtml($id)



//busca en la bd todos los parametros del home y los devuelve en una array
function getHome() {
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

function frontgetVideoVivo() {
	$connection = connectDB();
	$tabla = 'options';

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE option_name='video_vivo_link'";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		return null;
	} else { 

		$data = $result->fetch_array();
		
	}
	return $data;
}

function frontgetTextVivo() {
	$connection = connectDB();
	$tabla = 'options';

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " WHERE option_name='video_vivo_text'";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		return null;
	} else { 

		$data = $result->fetch_array();
		
	}
	return $data;
}

function showpeticionData () {
	$connection = connectDB();
	$tabla = 'peticiones';

	//queries según parámetros
	$query  = "SELECT * FROM " .$tabla. " ";	
	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		$data = null;
	} else { 

		$data = $result->fetch_array();
		
	}

	//devuelve el array de contenido
	return $data;
}