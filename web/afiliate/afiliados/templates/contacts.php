<?php
/*
 * Lista los afiliados
 * Since 4.0
 * 
*/
load_module( 'contactos' );

//mira si tiene que buscar de alguna manera en especial
$show = isset($_GET['afiliado-status']) ? $_GET['afiliado-status'] : '';

?>

<!---------- noticias ---------------->
<div class="contenido-modulo">
	<div class="container">
		
		<?php 
		if ( $show != '' ) {
			$afiliados = getAfiliados( $show );	
		} else {
			$afiliados = getAfiliados();	
		}
		
		?>
		<div class="contacts-container">
			<div class="btn-group" role="group" aria-label="botones-emails">

			  	<button id="export_excel" type="button" class="btn btn-default">
			  		Exportar a Excel
			  	</button>
				<button id="new-suscriptor" type="button" class="btn btn-primary">
				  	Nuevo Afiliado
				</button>
				<button id="export_excel_full" type="button" class="btn btn-default">
				  	Exportar a Excel Lista Completa
				</button>
				<div class="filtros-wrapper">
				  <select class="orden-suscriptores">
				  	<option value="">Menor a Mayor</option>
				  	<option value="">Mayor a Menor</option>
				  </select>
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

						<?php 
						//template standard
						if ( $show == '' ) : ?>

							<td width="10%">
								Profesión:
							</td>
							<td width="8%">
								Fecha: <small>(afiliación)</small>
							</td>
							<td width="7%">
								
							</td>
						<?php
						//template para mostrar no contactados o anulados
						else : ?>
							
							<td width="10%">
								Notas:
							</td>
							<td width="15%">
								
							</td>
							
						<?php endif; ?>
					</tr>
				</thead>
				<tbody class="row-usuario">
					<?php 
					if ( $afiliados != null ) : 

						for ($i=0; $i < count($afiliados); $i++) { ?>
						<tr>

							<?php 
							if ( $show == '' ) {
								getTemplate('fragmento-tabla-afiliado-std',$afiliados[$i]);
							} else {
								getTemplate('fragmento-tabla-afiliado-0',$afiliados[$i]);
							}
							?>

						</tr>
							<?php 
						}//for
					endif;
					?>
				</tbody>
			</table>
			<button class="btn btn-primary load-more-btn" data-afiliado-status="<?php echo $show; ?>">
				Cargar más
			</button>
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
	    
	    <a type="button" href="index.php?admin=contacts&afiliado-status=2" class="btn btn-primary">Ver anulados</a>
	<?php endif; ?>
	<?php if ( $show == '2' ) : ?>
	    <a type="button" href="index.php?admin=contacts&afiliado-status=0" class="btn btn-primary">Ver no contactados</a>
	    
	<?php endif; ?>
</footer>

<!---------- fin noticias ---------------->