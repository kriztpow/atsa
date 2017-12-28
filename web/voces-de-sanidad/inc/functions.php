<?php 
/*
 * Sitio web: MVL
 * @LaCueva.tv
 * Since 1.0
 * FUNCTIONS
 * 
*/

require_once 'config.php';
require_once 'mobile-detect/Mobile_Detect.php';

//busca la página $name = nombre del archivo sin extensión
function getPage( $name ) {
	$error = '404';
	$namePage = PAGESDIR . '/'. $name. '.php';

	if (is_file($namePage)) {
		include $namePage;
	} else {
		include PAGESDIR . '/'. $error. '.php';		
	}
}

//busca el template $name = nombre del archivo sin extensión
function getTemplate ( $name, $data = array() ) {
	$namePage = TEMPLATEDIR . '/'. $name. '.php';
	$error = '404';

	if (is_file($namePage)) {
		include $namePage;
	} else {
		include TEMPLATEDIR . '/'. $error. '.php';			
	}
}

//esta función limpia el url si el sitio no está instalado en la rais del servidor para que funcionen los permalinks sin problemas
function cleanUri() {
	$uri = $_SERVER["REQUEST_URI"];
	$uri = str_replace(CARPETASERVIDOR, '', $uri);
	return $uri;	
}

//detecta el dispositivo
function dispositivo () {
	$dispositivo = 'pc';
	$detect = new Mobile_Detect;

	if ( $detect->isMobile() ) {
		$dispositivo = 'movil';
	}
		
	// Any tablet device.
	if( $detect->isTablet() ){
		$dispositivo = 'tablet';
	}

	return $dispositivo;

}

function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest');
}

/*
* FUNCIÓN DE PERMALINKS
 * Define la page actual y redirecciona segun url, devuelve el slug o template part.
 * a) En el caso de que sean paginas, busca el template en la carpeta templates y listo.
 * b) En el caso de que sea noticia, categoria o curso, busca el template adecuado (cursos = curso.php / o en en el archivo index elige la primera opcion (la segunda es de paginas).
 * Pero ademas, e importante, busca en la base de datos mediante el slug. Si es noticia hace un loop de la categoria elegida o de todas las noticias y si es noticia single busca la noticia específica.
 *
*/
function pageActual ( $uri ) {
	$slug = 'inicio'; //slug por defecto
	
	//borramos la barra / luego del dominio:
	$url = $uri;
	$parseUrl = explode('/', $url);
	$RequestURI = $parseUrl[1];
	
	//busca el simbolo ? en la url
	$permalink = strpos($RequestURI, '?');
	$permalink2 = strpos($RequestURI, '&');
	
	//si en el url no aparece ni ? ni & es porque es un link bonito
	if ( $permalink === false && $permalink2 === false ) {
		
		//si no está vacío, hay que procesar cual es
		if ( $url != '/' ) {

			$slug = $RequestURI;		
			
		}

	} 
	//en cambio, si aparece el ? o el & el url funciona con ids, ejecuta la segunda opcion
	else {
		//BUSCAR PAGE EN EL URL, por defecto sería home
		$slug = isset($_REQUEST['page'])?$_REQUEST['page']:'inicio';
		$noticia = isset($_REQUEST['noticia'])?$_REQUEST['noticia']:'none';
		$cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';

		if ( $noticia != 'none' ) {
			$slug = $noticia;
		}

		if ( $cat != 'none' ) {
			$slug = $cat;
		}
	}

	return $slug;

}//pageActual()

//esta funcion devuelve el nombre de la categoria o nada sino lo es 
function ver_categoria ( $uri ) {
	global $categorias;
	//ver si figura la variable cat en el url, en ese caso es categoria
	$cat = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : 'none';

	$parseUrl = explode('/', $uri);
	$RequestURI = $parseUrl[1];

	for ($i=0; $i < count($categorias); $i++) { 
		if ( $categorias[$i]['slug'] == $RequestURI ) {
		$cat = $RequestURI;
		break;
		}
	}

	return $cat;

}

//esta funcion devuelve el nombre true si es categoria y false si no lo es
function es_categoria ( $uri ) {
	global $categorias;
	//ver si figura la variable cat en el url, en ese caso es categoria
	$cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';
	if ( $cat != 'none' ) {
		return true;
	} 
	//si el url es bonito hay que parsearlo para buscar las categorias
	$parseUrl = explode('/', $uri);

	if ( count( $parseUrl ) >= 3 && $parseUrl[2] != '' ){
		//si el index 2 figura en el url significa que es single
		return false;
	} else {
		$RequestURI = $parseUrl[1];

		for ($i=0; $i < count($categorias); $i++) { 
			if ( $categorias[$i]['slug'] == $RequestURI ) {
			return true;
			break;
			}
		}
		//sino encuentra la categoria en el url, entonces no lo es
		return false;
	}	
}

/*
ESTA FUNCIÓN TOMA LA VARIANTE DE ALGUNAS PAGINAS POR EJEMPLO NOTICIAS, EL SLUG ES UNA CATEGORIA O EL URL DE UNA NOTICIA
@return: string
*/
function getPageVar ( $uri ) {
	$categoria = '';

	//si es categoria, entonces no hay nada que decir
	if ( es_categoria( $uri ) ){
		return;
	} 
	
	//si figura variable noticia en el url, entonces es facil:
	$cat = isset($_REQUEST['cat'])?$_REQUEST['cat']:'none';
	if ( $cat != 'none' ) {
		$categoria = $cat;
		return $categoria;
	} 

	//si no hay variables hay que parsear el url para buscar informacion
	$parseUrl = explode('/', $uri);
	
	//si por el contrario hay un indice 2 y este no es la "/" entonces hay info que rescatar
	if ( isset($parseUrl[2]) && $parseUrl[2] != '' ) {
		$categoria = $parseUrl[2];
	} 
	
	return $categoria;

}

//ESTA FUNCION DEVUELVE EL SLUG PARA BUSCAR LA NOTICIA
function getSlug ( $uri ) {
	$slug = '';
	
	//si figura variable noticia en el url, entonces es facil:
	$noticia = isset($_REQUEST['noticia'])?$_REQUEST['noticia']:'none';
	if ( $noticia != 'none' ) {
		$slug = $noticia;
		return $slug;
	} 

	//si no hay variables hay que parsear el url para buscar informacion
	$parseUrl = explode('/', $uri);
	
	//si por el contrario hay un indice 2 y este no es la "/" entonces hay info que rescatar
	if ( isset($parseUrl[3]) && $parseUrl[3] != '' ) {
		$slug = $parseUrl[3];
	} 
	
	return $slug;

}
//esta función toma el nombre de la categoría para mostrarlo en el front en caso de que sea distinto el nombre del slug
function getNameCategoria( $categoria ) {
	global $categorias;
	for ($i=0; $i < count($categorias) ; $i++) { 
		if ($categorias[$i]['slug'] == $categoria ) {
			return $categorias[$i]['nombre'];
			break;
		}
	}
}

//acorta el texto
function acortaTexto( $texto, $cantPalabras = 50, $final = null ) {
	if ( null === $final ) {
	$final = '&hellip;';
	}	
	$textoOriginal = $texto;
	
	//quitar html
	$texto = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $texto );
	$texto = strip_tags($texto);
	
	//reducir texto y agregar el final
	 $words_array = preg_split( "/[\n\r\t ]+/", $texto, $cantPalabras + 1, PREG_SPLIT_NO_EMPTY );
	$sep = ' ';
	
	//devolver texto reducido
	if ( count( $words_array ) > $cantPalabras ) {
		array_pop( $words_array );
		$texto = implode( $sep, $words_array );
		$texto = $texto . $final;
	} else {
		$texto = implode( $sep, $words_array );
	}
	return $texto;
}

//prepara el resumen para buscarlo en el resumen y en el contenido, recibe como parametro el array del post
function preparaResumen ( $post ) {
	$resumen = $post['post_resumen'];
		if ( $post['post_resumen'] == '' ) {
			if ( $post['post_contenido'] != '' ) {
				$resumen = $post['post_contenido'];
			}
			$resumen = '';
		}	
	return $resumen;
}

function tuneandoFecha( $date ) {
	/*FECHAS*/
	$meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
	$dias = array('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
	$fecha = date("j", strtotime($date)) .' de '. $meses[date("n", strtotime($date))-1] . ' de ' . date("Y", strtotime($date));

	return $fecha;
}


//muestra el menú del array de menu
function showMenu( $menu, $active = null, $hide = false ) {
	//el último elemento del array tiene los menus ocultos
	for ($i=0; $i < count($menu)-2; $i++) { ?>
		<li>
			<?php 
				if ( ! isset( $menu[$i]['subItem'] ) ) : ?>
			<a href="<?php echo MAINSURL . '/' . $menu[$i]['url']; ?>" <?php 
			if ( $menu[$i]['url'] == $active ) {
				echo 'class="menu-active"';
			} ?>>
				<?php echo $menu[$i]['nombre']; ?>
			</a>
			
			<?php else : 
				$submenu = $menu[$i]['subItem'];
			?>
			<a href="<?php echo MAINSURL . '/' . $menu[$i]['url']; ?>" class="sub-menu-toggle <?php 
			if ( $menu[$i]['url'] == $active ) {
				echo ' menu-active';
			} ?>">
				<?php echo $menu[$i]['nombre']; ?>
			</a>
				<ul class="submenu">
				<?php for ($a=0; $a < count($submenu); $a++) { ?>
					<li>
						<a href="<?php echo MAINSURL . '/' . $submenu[$a]['url']; ?>">
							<?php echo $submenu[$a]['nombre']; ?>
						</a>
					</li>
				<?php } ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php }//for
	
	//mostrar los menus ocultos
	if ( $hide ) {
		if ( isset($menu['hideMenus']) ) {
			$hideMenus = $menu['hideMenus'];	
		} else {
			return;
		}
		

		//for menu hide
		for ($i=0; $i < count($hideMenus); $i++) { ?>
			<li>
				<a href="<?php echo MAINSURL . '/' . $hideMenus[$i]['url']; ?>">
					<?php echo $hideMenus[$i]['nombre']; ?>
				</a>
			</li>
			<?php
		}

		//extra menus
		if ( isset($menu['extra-menu']) ) {
			$extraMenus = $menu['extra-menu'];	
		} else {
			return;
		}
		

		//for extra menus
		for ($i=0; $i < count($extraMenus); $i++) { ?>
			<li>
				<a href="<?php echo $extraMenus[$i]['url']; ?>" target="_blank">
					<?php echo $extraMenus[$i]['nombre']; ?>
				</a>
			</li>
			<?php
		}

	}
}

//devuelve el título de la página para <head><title>
function SeoTitlePage ( $page ) {
    $tituloBase = SITETITLE;

    //titulo cuando no es home ni noticias
    if ( $page != 'inicio' ) {
        //si la página no es home hay que separar la url que está unido por "-" para armar un nuevo título
        
        $pageActualTitle = explode('/', $page);
        $pageSEOTitle = '';
        for ($i=1; $i < count($pageActualTitle); $i++) { 
            $pageSEOTitle .= ' - ';
            $pageSEOTitle .= str_replace('-', ' ', ucfirst($pageActualTitle[$i]) );
        }

        $tituloBase .= $pageSEOTitle;
    }

    return $tituloBase;
} //SeoTitlePage()


//define el metadescription en la etiqueta Head para SEO
function metaDescriptionText ( $item ) {
	if ( $item != '') {
		return $item;
	} else {

		return METADESCRIPTION;
	}

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
	if ( isset($connection) ) {
    	mysqli_close( $connection );
    }
}

//busca post en base de datos y devuelve array con todos ellos
function getPosts( $categoria = 'none', $number = -1, $exclude = 'none', $status = 'publicado', $offset = 0 ) {
	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'noticias';

	if ( $offset != '0' ) {
		$number = $offset.','.$number;
	}

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_status='";
	$query .= $status . "'";
	if ( $categoria != 'none' ) {
		$query .= " AND post_categoria = '".$categoria."'";
	}
	if ( $exclude != 'none' ) {
		$query .= " AND post_url!='".$exclude."'";
	}
	if ( $status == 'publicado' ) {
		$query .= " AND post_fecha <= '".$fecha_actual."'";	
	}
	$query .= " ORDER by post_fecha desc ";
	if ( $number != -1 ) {
		$query .= " LIMIT ".$number." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$loop = '<div>Ninguna noticia ha sido cargada todavía</div>';
	} else {

		while ($row = $result->fetch_array()) {
				$loop[] = $row;
			}

	}
	
	return $loop;
}


//busca los posts destacados para el slider
function getPostsSlider( $number = -1 ) {
	$connection = connectDB();
	$tabla = 'noticias';

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_status='publicado' AND post_destacado='1'";
	if ( $number != -1 ) {
		$query .= " LIMIT ".$number." ";
	}
	
	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		$loop = 'none';
	} else {

		while ($row = $result->fetch_array()) {
				$loop[] = $row;
			}

	}
	
	return $loop;
}


//recupera los post individualmente de acuerdo al url
function getSinglePost ( $slug ) {

	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'noticias';

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_url='" . $slug . "'";
	$query .= " AND post_fecha <= '". $fecha_actual. "'";
	$query .= " LIMIT 1";

	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		getTemplate( '404' );
	} else {

		$post = mysqli_fetch_array($result);

	}

	closeDataBase( $connection );

	return $post;
}

//recupera los post individualmente de acuerdo al id
function getSinglePostbyId ( $id, $op ) {

	$connection = connectDB();
	$fecha_actual = date("Y-m-d");
	$tabla = 'noticias';

	$query  = "SELECT * FROM " .$tabla;
	$query .= " WHERE post_id" . $op . "'" . $id . "'";
	$query .= " AND post_fecha <= '". $fecha_actual. "'";

	if ($op == '<' ) {
		$query .= " ORDER BY post_id desc LIMIT 1";	
	} else {
		$query .= " ORDER BY post_id asc LIMIT 1";
	}

	

	$result = mysqli_query($connection, $query);

	if ( $result->num_rows == 0 ) {
		$post = 'none';

	} else {

		$post = mysqli_fetch_array($result);

	}

	closeDataBase( $connection );
	
	return $post;
}


//Muestra el botón de cargar más de ser necesario e indica la página
function getPagination( $categoria, $postPerPage ) {
	$posts = getPosts( $categoria );
	$totalPost = count($posts);
	$postRestantes = ceil($totalPost - $postPerPage);//devuelve valor redondeado 

	if ( $postRestantes <= 0 ) {
		return;
	}

	?>
	<div class="load-more-wrapper">
		
		<div class="ajax-loader-noticias"></div>

		<button class="btn btn-destacado btn-load-more-news" data-page="1" data-categoria="<?php echo $categoria; ?>" data-cantpost="<?php echo $postPerPage; ?>" data-resto="<?php echo $postRestantes; ?>">Cargar más Noticias</button>

		<p class="mensaje mensaje-sutil">
			<?php echo $postRestantes; ?> noticias más. 
		</p>
	</div>
	<?php
}




//busca el previo y el próximo post y publican si existen
function getNextPrevious ( $id ) {
	$post1 = getSinglePostbyId( $id, '<');
	$post2 = getSinglePostbyId( $id, '>');

	$postsURLs = array(
		isset($post1['post_url']) ? $post1['post_url'] : 'none',
		isset($post1['post_url']) ? $post1['post_categoria'] : 'none',
	 	isset($post2['post_url']) ? $post2['post_url'] : 'none',
	 	isset($post2['post_url']) ? $post2['post_categoria'] : 'none',
	);
	
	return $postsURLs;
}


//busca la documentación cargada
function getDocumentation ( $section = 'none', $subSection = 'none' ) {
	$connection = connectDB();
	$tabla = 'docs';

	$query  = "SELECT * FROM " .$tabla;
	if ( $section != 'none' ) {	
		$query .= " WHERE docs_seccion='" . $section . "'";
	}
	if ( $subSection != 'none' ) {
		$query .= " AND docs_subsection = '".$subSection."'";
	}
	
	$query .= " AND post_type = 'link' ORDER by docs_orden desc ";
	
	$result = mysqli_query($connection, $query);
	
	closeDataBase( $connection );

	if ( $result->num_rows == 0 ) {
		
		echo '<li>Ningun archivo ha sido cargado todavía</li>';

		return;
		
	} else {

		while ($row = $result->fetch_array()) {
				$loop[] = $row;
			}
	}

	getTemplate( 'template-documentacion', $loop );
}

function openPopUp ( $page ) {
	
	if ( $page == 'inicio' ) {

		$connection = connectDB();
		$tabla = 'options';
		$option_name = 'popupValue';
		$query  = "SELECT * FROM " .$tabla. " WHERE options_name = '{$option_name}' LIMIT 1";
		$result =  mysqli_query($connection, $query);
		
		
		if ($result->num_rows == 0) {
			return;
		}
		
		$data = mysqli_fetch_array($result);
		
		if ($data[2] == '1') {
			getTemplate( 'popup' );
		} else {
			return;
		}
	}
}//funcion openPopUp

function showPopupImg () {
	
	$connection = connectDB();
	$tabla = 'medios';
	$post_type = 'promo';
	$query  = 'SELECT * FROM ' .$tabla. ' WHERE medio_post_type = "'.$post_type.'" order by medio_id desc LIMIT 1';

	$result =  mysqli_query($connection, $query);
	$data = mysqli_fetch_array($result);
	$urlPoup = $data[3];
	
	mysqli_close($connection);
	if ( $urlPoup == NULL ) {
		echo MAINSURL . '/images/popupdefault.png';
	} else {
		echo UPLOADSURL . '/' . $urlPoup;
	}
}

//busca el url si existe
function getUrlPromo() {
	$connection = connectDB();
	$tabla = 'options';
	$option_name = 'urlPopup';

	$query  = "SELECT * FROM " .$tabla. " WHERE options_name = '{$option_name}' LIMIT 1";
	$result =  mysqli_query($connection, $query);
	
	closeDataBase($connection);

	if ($result->num_rows == 0) {
		return '#';
	}
	
	$data = mysqli_fetch_array($result);
	
	if ($data[2] == '') {
		return '#';
	} else {
		return $data[2];
	}

	closeDataBase($connection);
}