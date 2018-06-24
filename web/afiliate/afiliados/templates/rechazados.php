<?php
/*
 * Lista los afiliados
 * Since 4.0
 * 
*/
load_module( 'contactos' );

//si el usuario es "a" se pide plantilla de row sin poder borrar afiliado
global $userStatus;
//si el usuario es "d" no tiene acceso
if ($userStatus == 'd' || $userStatus == 'a') {
	echo 'No tiene permisos para ver esta sección';
  	exit;
}

$rechazados = getRechazados();


?>

<!---------- noticias ---------------->
<div class="contenido-modulo">
	<div class="container">

		<div class="contacts-container">
			<div>
				<a type="button" href="index.php" class="btn">Volver al inicio</a>
				
			</div>

			

			<div class="btn-group" role="group" aria-label="botones-emails">

			  	<button id="export_excel" type="button" class="btn btn-default">
			  		Exportar a Excel
			  	</button>
				
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
							Dni:
						</td>		
						<td width="10%">
							Cuit
						</td>
						<td width="10%">
							Fecha: <small>(ingreso)</small>
						</td>
						<td width="10%">
							Tel/cel:
						</td>
						<td width="10%">
							Email
						</td>
						<td width="15%">
							Domicilio Laboral
						</td>
						<td>
							
						</td>
					</tr>
				</thead>
				<tbody class="row-usuario">
					<?php 
					if ( $rechazados != null ) : 

						for ($i=0; $i < count($rechazados); $i++) { ?>
						<tr>
							<?php 
							getTemplate('fragmento-tabla-rechazados',$rechazados[$i]); 
							
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
</footer>

<!---------- fin noticias ---------------->