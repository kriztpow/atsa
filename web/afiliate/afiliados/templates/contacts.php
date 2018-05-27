<?php
/*
 * Lista los afiliados
 * Since 4.0
 * 
*/
load_module( 'contactos' );

$plantillaReduce = false;
$delegados = false;
//si el usuario es "a" se pide plantilla de row sin poder borrar afiliado
global $userStatus;
//si el usuario es "d" no tiene acceso
if ($userStatus == 'd' ) {
	echo 'No tiene permisos para ver esta sección';
  	exit;
}

if ($userStatus == 'a' ) {
	$plantillaReduce = true;
}



//show es el status del afiliado, 0 no contactado, 1 es contactado, 2 es anulado, 3 es firmado
$show = isset($_GET['afiliado-status']) ? $_GET['afiliado-status'] : 'all';
$registeredBy = isset($_GET['by']) ? $_GET['by'] : '';

if ( $show != '' && $registeredBy != '' ) {
	$afiliados = getAfiliados( $show, $registeredBy );	
	$numeroAfiliados = getAfiliadosNumber( $show, $registeredBy );
} else if ( $show != '' && $registeredBy == '' ) {
	$afiliados = getAfiliados( $show );	
	$numeroAfiliados = getAfiliadosNumber( $show ); 
} else {
	//lista completa sin filtros
	$afiliados = getAfiliados();
	$numeroAfiliados = getAfiliadosNumber();
}

if ($registeredBy == 'delegados') {
	$delegados = true;
}

?>

<!---------- noticias ---------------->
<div class="contenido-modulo">
	<div class="container">

		<div class="contacts-container">
			<div>
				<a type="button" href="index.php" class="btn">Volver al inicio</a>
				<?php if ( $show == '0' ) : ?>
					<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
					<a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
					<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
				<?php endif; ?>	
				<?php if ( $show == '1' ) : ?>
					<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
					<a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
					<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
				<?php endif; ?>	
				<?php if ( $show == '2' ) : ?>
					<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
					<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
				<?php endif; ?>
				<?php if ( $show == '3' ) : ?>
					<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
				    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
					<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
				<?php endif; ?>
				<?php if ( $show == 'all' || $show == '') : ?>
					<a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
					<a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
					<a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
					<a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
					<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
				<?php endif; ?>
			</div>

			<?php if ( $delegados ) : ?>
				<div>
					<?php 
					//si se hizo clic en delegados muestra todos los delicados para filtrar por cada uno
					$users = getUsers( 'd' );
					if ( $users != null) {
						for ($i=0; $i < count($users); $i++) { ?>
							<a type="button" href="index.php?admin=contacts&by=<?php echo $users[$i]['user_usuario']; ?>" class="btn btn-primary"><?php echo $users[$i]['user_nombre']; ?></a>
						<?php }
					}
					?>
					
				</div>
			<?php endif; ?>

			<div class="btn-group" role="group" aria-label="botones-emails">

			  	<button id="export_excel" type="button" class="btn btn-default">
			  		Exportar a Excel
			  	</button>
				<a href="index.php?admin=edit-contacts" id="new-suscriptor" type="button" class="btn btn-danger">
				  	Agregar Nuevo Afiliado
				</a>
				<div class="filtros-wrapper">
				  <select class="orden-suscriptores" data-afiliado-status="<?php echo $show; ?>" data-cant-post="<?php echo CANTPOST; ?>">
				  	<option value="desc" selected>Descendente</option>
				  	<option value="asc">Ascendente</option>
				  </select>
				  <p class="notes-filtro-orden">
				  	<small>Reordenar en la pantalla</small>
				  </p>
				</div>
			</div>

			<table class="tabla-suscriptores">
				<thead>
					<tr>
						<td width="5%">
							#
						</td>
						<td width="10%">
							cuil:
						</td>
						<td width="15%">
							Apellido, Nombre:
						</td>
						<td width="10">
							Tel/cel:
						</td>		
						<td width="15%">
							Empresa:
						</td>
						<td width="10%">
							Fecha: <small>(ingreso)</small>
						</td>
						<td width="10%">
							Afiliado
						</td>
						<td width="10%">
							Notas:
						</td>
						<td width="15%">
							
						</td>
						
					</tr>
				</thead>
				<tbody class="row-usuario">
					<?php 
					if ( $afiliados != null ) : 

						for ($i=0; $i < count($afiliados); $i++) { ?>
						<tr>
							<?php
							//si el usuario es a:
							if ($plantillaReduce) {
								//carga plantilla especial para que el afiliado no se pueda borrar	
								getTemplate( 'fragmento-tabla-afiliado-std-reduce',$afiliados[$i] ); 
							} else {
								//si es cualquier otro usuario se carga plantilla con boton de borrado incluido:
								getTemplate('fragmento-tabla-afiliado-std',$afiliados[$i]); 	
							}
							?>

						</tr>
							<?php 
						}//for
					endif;
					?>
				</tbody>
			</table>
			<div class="wrapper-loaders">
				<?php 
					
					//si el numero es mayor a la cantidad de post por página entonces muestra el botón cargar más
					if ( $numeroAfiliados > CANTPOST ) : ?>
				
						<button class="btn btn-primary load-more-btn" data-afiliado-status="<?php echo $show; ?>" data-user="<?php echo $plantillaReduce ?>" data-cant-post="<?php echo CANTPOST ?>" data-post-orden="desc">
							Cargar más
						</button>
				<?php endif; ?>
				<?php if ( $numeroAfiliados > 5 ) : ?>
					<div class="select-cant-post">
						<p>Mostrar: </p>
						<select class="select-mostrar" data-user="<?php echo $plantillaReduce ?>" data-post-orden="desc" data-afiliado-status="<?php echo $show; ?>" data-registeredby="<?php echo $registeredBy; ?>" >
							<option value="5">5</option>
						<?php if ( $numeroAfiliados > 10 ) : ?>
							<option value="10" selected>10</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 25 ) : ?>
							<option value="25">25</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 50 ) : ?>
							<option value="50">50</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 100 ) : ?>
							<option value="100">100</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 250 ) : ?>
							<option value="250">250</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 500 ) : ?>
							<option value="500">500</option>
						<?php endif; ?>
						<?php if ( $numeroAfiliados > 1000 ) : ?>
							<option value="1000">1000</option>
						<?php endif; ?>
						</select> 
						<p>afiliados por página.</p>
					</div>
				<?php endif; ?>

			</div>
		</div>

		<form action="inc/export_excel.php" method="post" target="_blank" id="FormularioExportacion">
			<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
		</form>

	</div><!-- // container gral modulo -->
</div><!-- // container -->
<!-- botones del modulo -->
<div id="formulario-suscriptor">
	
</div>
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
    <a type="button" href="index.php?admin=edit-contacts" class="btn btn-danger">agregar uno nuevo</a>
   
	<?php if ( $show == '0' ) : ?>
		<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
		<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
	<?php endif; ?>	
	<?php if ( $show == '1' ) : ?>
		<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
		<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
	<?php endif; ?>	
	<?php if ( $show == '2' ) : ?>
		<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
		<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
	<?php endif; ?>
	<?php if ( $show == '3' ) : ?>
		<a type="button" href="index.php?admin=contacts" class="btn btn-primary">Lista completa</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
		<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
	<?php endif; ?>
	<?php if ( $show == 'all' || $show == '') : ?>
		<a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=1" class="btn btn-primary">Ver contactados</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
		<a type="button" href="index.php?admin=contacts&afiliado-status=3" class="btn btn-primary">Ver firmados</a>
		<a type="button" href="index.php?admin=contacts&by=delegados" class="btn btn-primary">Ver delegados</a>
	<?php endif; ?>
</footer>

<!---------- fin noticias ---------------->