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
	$urlBase = 'http://'.$_SERVER['HTTP_HOST'];
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
function NoticiasRecientesHTML ( $cantPosts, $categoria = 'none', $exclude = 'none', $style = false ) {
	$noticiasPorPagina = $cantPosts;
	$connection = connectDB();
	$fecha_actual = strtotime(date("d-m-Y H:i:00"));
	$tabla = 'noticias';
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
	
}//NoticiasRecientesHTML()


//archivo de noticias por mes
function archivoNoticias () {
	$connection   = connectDB();
	$tabla        = 'noticias';
	$query        = "SELECT * FROM " .$tabla. " WHERE post_status='publicado' ORDER by post_fecha DESC";
	$ActualDate   = getdate();
	$mesActual    = $ActualDate[mon]+1; //al mes actual suma 1
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
} //archivoNoticias ()


//muestra html del loop de noticias de acuerdo a su categoría
function loopNoticiasHTML ( $categoria ) {
	$fecha_actual = strtotime(date("d-m-Y H:i:00"));
	$noticiasPorPagina = 5;
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
							<?php echo $resumen; ?>
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
} //loopNoticiasHTML()


//busca la noticia en particular y recoge los datos para pasar al template
function singlePostHTML ( $noticia ) {
	$connection = connectDB();
	$tabla = 'noticias';
	$query  = "SELECT * FROM " .$tabla. " WHERE post_url='".$noticia."' LIMIT 1 ";

	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>Esta noticia no fue encontrada</div>';
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
} //singlePostHTML()

//busca el curso en particular y recoge los datos para pasar al template
function singleCursoHTML ( $curso ) {
	$connection = connectDB();
	$tabla = 'cursos';
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_slug='".$curso."' LIMIT 1 ";
		
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		echo '<div>No hay ningún hotel cargado</div>';
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
} //singlePostHTML()

//busca el curso en particular y recoge los datos para pasar al template
function hotelesLoopHTML () {
	$connection = connectDB();
	$tabla = 'hoteles';
	$query  = "SELECT * FROM " .$tabla. " WHERE curso_slug='".$curso."' LIMIT 1 ";
		
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
								<?php echo $resumen; ?>
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
} //getSliders()