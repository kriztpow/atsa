<?php 
/*
 * Sitio web: Atsa
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

//FUNCIONES - 

//busca el template $name = nombre del archivo sin extensión
function getTemplate ( $name ) {
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

//define la page actual y redirecciona segun url, funciona como servidor y elije el template y la pagina a buscar
function pageActual () {
	global $categoriaNoticias;
	global $esNoticias;
	global $noticiaSingle;
	global $esCategoria;
	global $curso;
	global $noticia;

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
					//si en el indice 3 del array noticias, no hay nada, significa que no es una noticia, porque en ese lugar debería estar el título
				} else if ( !empty($noticias[2]) ) {
					$noticiaSingle = true;
					$noticia = $noticias[2];
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


//muestra html del loop de noticias de acuerdo a su categoría
function loopNoticiasHTML ( $categoria ) {
	//busca los datos en la variable
	global $dataNoticias;
	
	//numero de noticias por pagina, por ahora es la cantidad de noticias del array despues cuando haya muchas se puede poner un numero
	$noticiasPorPagina = count($dataNoticias);

	
	switch ( $categoria ) {
		case 'none':
			//no tiene categoria, entonces se muestra todo con el bucle
			for ($i = 0; $i < count($dataNoticias); $i++) { 

				$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
				$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
				$resumenNoticia   = $dataNoticias[$i]['resumenNoticia'];
				$bajadaNoticia    = $dataNoticias[$i]['bajadaNoticia'];
				$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];
				$urlNoticia       = $dataNoticias[$i]['urlNoticia'];
				$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array	
				$excerptNoticia   = $resumenNoticia;
				
				if ( $resumenNoticia == '' ) {
					$excerptNoticia = $bajadaNoticia;
				}
			?>

				<li class="loop-noticias-item">
					<article class="noticia-index">
						<header>
							<h1>
								<?php echo $tituloNoticia; ?>
							</h1>
						</header>
						<section>
							<div class="meta-data-news">
								<div class="date-news">
									<p>
										<strong>
											<?php echo $fechaNoticia[0]; ?>
										</strong><br>
										de 
										<?php echo $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
									</p>
								</div>

								<?php 
									if ( $imgDestacada != '' ) { ?>
										<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="Foto-Noticia-ATSA">
									
									<?php 
									
									} else {

									?>
										<img src="assets/images/noticia-img-default.png" alt="Noticias-ATSA">
									<?php 
									} ?>

								
							</div>
							<p class="excerpt-news">
								<?php echo $excerptNoticia; ?>
							</p>
						</section>
						<footer>
							<div class="btn-noticia-index">
								<a href="/noticias/<?php echo $urlNoticia; ?>" title="Leer noticia">Leer más</a>
							</div>
						</footer>
					</article>
				</li>

			<?php
			}//bucle for
			break;
		
		case 'ATSA':
			//si la noticia tiene categoria ATSA continua
			for ($i = 0; $i < count($dataNoticias); $i++) { 

				$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];

				//si es de categoria atsa la muestra
				if ( $categoriaNoticia == $categoria ) {

					$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
					$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
					$resumenNoticia   = $dataNoticias[$i]['resumenNoticia'];
					$bajadaNoticia    = $dataNoticias[$i]['bajadaNoticia'];
					$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];
					$urlNoticia       = $dataNoticias[$i]['urlNoticia'];
					$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array	
					$excerptNoticia   = $resumenNoticia;
					
					if ( $resumenNoticia == '' ) {
						$excerptNoticia = $bajadaNoticia;
					}	
				?>

					<li class="loop-noticias-item">
						<article class="noticia-index">
							<header>
								<h1>
									<?php echo $tituloNoticia; ?>
								</h1>
							</header>
							<section>
								<div class="meta-data-news">
									<div class="date-news">
										<p>
											<strong>
												<?php echo $fechaNoticia[0]; ?>
											</strong><br>
											de 
											<?php echo $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
										</p>
									</div>
									<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="Foto-Noticia-ATSA">
								</div>
								<p class="excerpt-news">
									<?php echo $excerptNoticia; ?>
								</p>
							</section>
							<footer>
								<div class="btn-noticia-index">
									<a href="/noticias/<?php echo $urlNoticia; ?>" title="Leer noticia">Leer más</a>
								</div>
							</footer>
						</article>
					</li>

				<?php
				} //if
			}//bucle for
			break;
		
		case 'nacionales':
			//si la noticia tiene categoria nacionales continua
			for ($i = 0; $i < count($dataNoticias); $i++) { 

				$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];

				//si es de categoria atsa la muestra
				if ( $categoriaNoticia == $categoria ) {

					$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
					$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
					$resumenNoticia   = $dataNoticias[$i]['resumenNoticia'];
					$bajadaNoticia    = $dataNoticias[$i]['bajadaNoticia'];
					$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];
					$urlNoticia       = $dataNoticias[$i]['urlNoticia'];
					$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array	
					$excerptNoticia   = $resumenNoticia;
					
					if ( $resumenNoticia == '' ) {
						$excerptNoticia = $bajadaNoticia;
					}	
				?>

					<li class="loop-noticias-item">
						<article class="noticia-index">
							<header>
								<h1>
									<?php echo $tituloNoticia; ?>
								</h1>
							</header>
							<section>
								<div class="meta-data-news">
									<div class="date-news">
										<p>
											<strong>
												<?php echo $fechaNoticia[0]; ?>
											</strong><br>
											de 
											<?php echo $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
										</p>
									</div>
									<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="Foto-Noticia-ATSA">
								</div>
								<p class="excerpt-news">
									<?php echo $excerptNoticia; ?>
								</p>
							</section>
							<footer>
								<div class="btn-noticia-index">
									<a href="/noticias/<?php echo $urlNoticia; ?>" title="Leer noticia">Leer más</a>
								</div>
							</footer>
						</article>
					</li>

				<?php
				} //if
			}//bucle for	
			break;

		case 'internacionales':
			//si la noticia tiene categoria internacionales continua
			for ($i = 0; $i < count($dataNoticias); $i++) { 

				$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];

				//si es de categoria atsa la muestra
				if ( $categoriaNoticia == $categoria ) {

					$tituloNoticia    = $dataNoticias[$i]['tituloNoticia'];
					$imgDestacada     = $dataNoticias[$i]['imgDestacada'];
					$resumenNoticia   = $dataNoticias[$i]['resumenNoticia'];
					$bajadaNoticia    = $dataNoticias[$i]['bajadaNoticia'];
					$categoriaNoticia = $dataNoticias[$i]['categoriaNoticia'];
					$urlNoticia       = $dataNoticias[$i]['urlNoticia'];
					$fechaNoticia     = $dataNoticias[$i]['fechaNoticia'];//array	
					$excerptNoticia   = $resumenNoticia;
					
					if ( $resumenNoticia == '' ) {
						$excerptNoticia = $bajadaNoticia;
					}	
				?>

					<li class="loop-noticias-item">
						<article class="noticia-index">
							<header>
								<h1>
									<?php echo $tituloNoticia; ?>
								</h1>
							</header>
							<section>
								<div class="meta-data-news">
									<div class="date-news">
										<p>
											<strong>
												<?php echo $fechaNoticia[0]; ?>
											</strong><br>
											de 
											<?php echo $fechaNoticia[1] .' '. $fechaNoticia[2]; ?>
										</p>
									</div>
									<img src="uploads/images/<?php echo $imgDestacada; ?>" alt="Foto-Noticia-ATSA">
								</div>
								<p class="excerpt-news">
									<?php echo $excerptNoticia; ?>
								</p>
							</section>
							<footer>
								<div class="btn-noticia-index">
									<a href="/noticias/<?php echo $urlNoticia; ?>" title="Leer noticia">Leer más</a>
								</div>
							</footer>
						</article>
					</li>

				<?php
				} //if
			}//bucle for
			break;
	}//switch

	//arma el look de acuerdo al filtro previo

	
	
	//va a buscar la template y hace el loop;
	//getTemplate( 'noticias-loop' );
}//loopNoticiasHTML()




//muestra las noticias recientes en el sidebar
function NoticiasRecientesHTML ( $categoria ) {
	//va a buscar la template y hace el loop;
	getTemplate( 'noticias-recientes' );
}//loopNoticiasHTML()



