<?php 
/*
 * Sitio web: Atsa
 * @LaCueva.tv
 * Since 2.3
 * search
 * 
*/
require_once '../config.php';
require_once '../functions.php';


if(!$_POST){
	header('Location: /404/');
  

} //
//si tratan de acceder directamente te redirige a otro lado
else {
	$busqueda = trim($_POST['input-search']);	

//definir $pageActual
	$categoriaNoticias = 'none';
$noticia           = 'none';
$curso             = 'none';
$pageActual = 'Buscador';

//head es la etiqueta head de html
include '../../head.php';
?>
<!------------- body html --------------->


<!------- header -------->
<?php
	//header section html (submenu-menu-logo)
	include '../../header.php';
?>
<!------- // cierre header ------>


<!------- main section ------>
<main role="main" class="main">
	<article id="buscar" class="wrapper-page less-padding" style="padding: 250px 0">
		<div class="container">
		    <h1 class="main-tittle-page">Búsqueda realizada</h1>
		    

		    <div class="resultados-busqueda-wrapper">
		    	<?php 
		    	if (empty($busqueda)){
					  $texto = 'Búsqueda sin resultados';
				} else{
					  // Si hay información para buscar, abrimos la conexión
					$connection = connectDB();
					$query  = "SELECT * FROM noticias WHERE post_titulo LIKE '%" .$busqueda. "%' ";
						
					$result = mysqli_query($connection, $query);
					
					if ( $result->num_rows == 0 ) {
							echo 'No se encontró ningun registro';
					} else {

						while ( $row = $result->fetch_array(MYSQLI_ASSOC) ) {
							$rows[] = $row;
						}
						?>
						
						<ul class="resultados-busqueda">

							<?php
							for ($i=0; $i < count($rows); $i++) { 
								?>
								<li>
									<a href="/noticias/<?php echo $rows[$i]['post_url']; ?>">
										<?php echo $rows[$i]['post_titulo']; ?>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
						<p style="text-align: center;margin: 30px 0;">
					    	<a class="btn-standard" href="\" title="Inicio">Volver al Inicio</a>
					    </p>
						<?php
					}//else
				}//else
		    	?>
		    </div>

	    </div>
	</article>	
</main>
<!------- // cierre main section ------>
	
<!------- footer ------>
<?php
    include '../../footer.php';
?>
<!------- // cierre footer ------>

<!------- foot (legales y scripts ------>
<?php
    include '../../foot.php';

}//else final

