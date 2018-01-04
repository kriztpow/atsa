<?php
/*
 * Noticias recientes
 * Lista las noticias publicadas y con links para verlas, editarlas o publicarlas
 * Since 3.0
 * 
*/
load_module( 'contactos' );
?>
<!---------- noticias ---------------->
<div class="contenido-modulo">
	<div class="container">
		
		<?php 
		$suscriptores = getContacts();
		?>
		<div class="contacts-container">
			<div class="btn-group" role="group" aria-label="botones-emails">

			  <button id="export_excel" type="button" class="btn btn-default">
			  	Exportar a Excel
			  </button>
			  
			</div>
			<table class="tabla-suscriptores">
				<thead>
					<tr>
						<td width="5%">
							Id:
						</td>
						<td width="30%">
							email:
						</td>
						<td width="20%">
							Nombre:
						</td>
						<td width="10%">
							Apellido:
						</td>
						<td width="10%">
							DNI:
						</td>
						<td width="15%">
							Teléfono
						</td>
						<td width="10%">
							Fecha: <small>(registro)</small>
						</td>
					</tr>
				</thead>
				<tbody>
					<?php 
					for ($i=0; $i < count($suscriptores); $i++) { 
						?>
					<tr>
						<td>
							<?php echo $suscriptores[$i]['susc_id']; ?>
						</td>
						<td>
							<?php echo $suscriptores[$i]['susc_email']; ?>
						</td>
						<td>
							<?php echo $suscriptores[$i]['susc_nombre']; ?>
						</td>
						<td>
							<?php echo $suscriptores[$i]['susc_apellido']; ?>
						</td>
						<td>
							<?php echo $suscriptores[$i]['susc_dni']; ?>
						</td>
						<td>
							<?php echo $suscriptores[$i]['susc_telefono']; ?>
						</td>
						<td>
							<?php echo date('d.m.y' ,strtotime($suscriptores[$i]['susc_fecha_email']) ); ?>
						</td>
					</tr>
						<?php 
					}
					?>
				</tbody>
			</table>
		</div>

		<form action="inc/export_excel.php" method="post" target="_blank" id="FormularioExportacion">
		<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
	</form>

	</div><!-- // container gral modulo -->
</div><!-- // container -->
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>

<!---------- fin noticias ---------------->