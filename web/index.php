<?php
/*
 * Sitio web: ATSA
 * @LaCueva.tv
 * Since 1.0
 * INDEX
 * la pagina de inicio tiene dos macro templates. single page, o noticias que tiene sidebar. Por lo tanto primero define si esNoticia, que por defecto no lo es, entonces después del header arma una sola columna. Si encuentra que corresponde a una noticia, categoria o loop de noticias generales, armar las dos columnas
*/


require_once 'inc/config.php';
require_once 'inc/functions.php';

//TEMPLATES, DEFAULT SINGLE PAGE:
$noticiaSingle     = false;
$esNoticias        = false;
$esCategoria       = false;
//estos links o slugs especificos indican como buscar en la base de datos ya que representan los titulos de la noticia, categoria o curso
$categoriaNoticias = 'none';
$noticia           = 'none';
$curso             = 'none';

//definir $pageActual
$pageActual = pageActual();

/*
 *
 * LISTO, ahora se arma el html:
 *
 *
*/

//head es la etiqueta head de html
include 'head.php';
?>
<!------------- body html --------------->


<!------- header -------->
<?php
	//header section html (submenu-menu-logo)
	include 'header.php';
?>
<!------- // cierre header ------>


<!------- main section ------>

<?php
//si $pageActual es noticias, entonces no busca template, y la pagina tiene dos columnas main y aside
	if ( $esNoticias  ) {
		?>
	<div class="wrapper-page-noticias container-fluid">
		<div class="row">
			<div class="col-md-8 col-lg-9">
				<main role="main" class="main">
					<h1 class="sr-only">Últimas noticias ATSA Buenos Aires</h1>

					<div id="noticias-loop" class="container-fluid">
						
					    <ul class="loop-noticia">
					    	
					    	<?php 
					    	//si es una noticia muestra el post
				    		if ( $noticiaSingle ) {
				    		//si es noticia se busca el template del single y muestra la noticia individual
				    			getTemplate( 'noticia-single' );
				    			
				    		} else {
				    		//sino, hace el loop de categorias
				    			loopNoticiasHTML ( $categoriaNoticias );
				    		}
					    	?>
					    </ul>
					</div><!-- //#noticias-loop -->

				</main><!------- // cierre main section ------>
			</div><!-- //.col -->
			<div class="col-md-4 col-lg-3">
<!------------------- SIDEBAR -------------------------------->
				<aside class="sidebar-news">
					<div class="container-fluid">
					<?php getTemplate( 'sidebar' ); ?>
					</div>
				</aside>
		<!------- // cierre sidebar ------>
			</div><!-- //.col -->
		</div><!-- //.row -->
	</div><!-- //.container -->
<!------- // fin main section ------>
		<?php

	} //pero si no es noticia es una pagina sin sidebar y un solo main
	else {
?>
<!------- main section ------>
	<main role="main" class="main">
	<?php
    	getTemplate( $pageActual );
    }
    ?>
    </main>
<!------- // cierre main section ------>
	
<!------- footer ------>
<?php
    include 'footer.php';
?>
<!------- // cierre footer ------>

<!------- foot (legales y scripts ------>
<?php
    include 'foot.php';
?>