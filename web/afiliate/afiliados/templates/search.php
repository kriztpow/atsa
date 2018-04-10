<?php
/*
 * Lista los afiliados
 * Since 4.0
 * 
*/
load_module( 'contactos' );

$afiliados = searchAfiliados( $data );	
$numeroAfiliados = searchAfiliadosNumber( $data );

?>

<div class="contenido-modulo">
	<div class="container">

		<div class="contacts-container">
			<div class="btn-group" role="group" aria-label="botones-emails">

			  	<button id="export_excel" type="button" class="btn btn-default">
			  		Exportar a Excel
			  	</button>
				<a href="index.php?admin=edit-contacts" id="new-suscriptor" type="button" class="btn btn-primary">
				  	Nuevo Afiliado
				</a>
				<div class="filtros-wrapper">
				  <select class="orden-suscriptores" data-cant-post="<?php echo CANTPOST; ?>">
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
						<td width="10%">
							Teléfono:
						</td>
						<td width="10%">
							Celular:
						</td>
						<td width="15%">
							Empresa:
						</td>
						<td width="10%">
							Fecha: <small>(ingreso)</small>
						</td>
						<td width="10%">
							Profesión:
						</td>
						<td width="8%">
							Fecha: <small>(afiliación)</small>
						</td>
						<td width="7%">
							
						</td>
					</tr>
				</thead>
				<tbody class="row-usuario">
					<?php 
					if ( $afiliados != null ) : 

						for ($i=0; $i < count($afiliados); $i++) { ?>
						<tr>

							<?php 
								getTemplate('fragmento-tabla-afiliado-std',$afiliados[$i]);	?>

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
				
						<button class="btn btn-primary load-more-btn" data-afiliado-status="<?php echo $show; ?>" data-cant-post="<?php echo CANTPOST ?>" data-post-orden="desc">
							Cargar más
						</button>
				<?php endif; ?>
				<?php if ( $numeroAfiliados > 5 ) : ?>
					<div class="select-cant-post">
						<p>Mostrar: </p>
						<select class="select-mostrar" data-post-orden="desc">
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
						</select> 
						<p>afiliados por página.</p>
					</div>
				<?php endif; ?>

			</div>
		</div>

	</div><!-- // container -->
</div><!-- // contenido-modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>

<!---------- fin afiliado ---------------->