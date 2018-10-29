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
if ($userStatus == 'd' ) {
	echo 'No tiene permisos para ver esta sección';
  	exit;
}

if ($userStatus == 'a' ) {
	$plantillaReduce = true;
}

$lista = getPeticiones ( 'all', 'fecha', 'desc', CANTPOST);

$numeroPeticiones = getPeticionesNumber('all');

?>

<!---------- noticias ---------------->
<div class="contenido-modulo">
	<div class="container">

		<div class="contacts-container">
			<div>
				<a type="button" href="index.php" class="btn">Volver al inicio</a>
                <button id="export_excel" type="button" class="btn btn-primary">
			  		Exportar a Excel
			  	</button>
			</div>

			<table class="tabla-suscriptores">
				<thead>
					<tr>
						<td width="5%">
							#
						</td>
						<td width="20%">
                            Apellido, Nombre:
						</td>
						<td width="10%">
							DNI:
						</td>
						<td width="15">
							email:
						</td>		
						<td width="10%">
							Género
						</td>
						<td width="10%">
							Recibir info
						</td>
						<td width="10%">
							Enviado
						</td>
						<td width="20%">
							
						</td>
					</tr>
				</thead>
				<tbody class="row-usuario">
					<?php 
					if ( $lista != null ) : 
                        for ($i=0; $i < count($lista); $i++) { 
                        echo $plantillaReduce; ?>
						<tr>
							<?php
                            //si el usuario es a:
                            
							if ($plantillaReduce) {
                                //carga plantilla especial para que el afiliado no se pueda borrar	
								getTemplate( 'fragmento-tabla-peticion-std-reduce',$lista[$i] ); 
							} else {
								//si es cualquier otro usuario se carga plantilla con boton de borrado incluido:
								getTemplate('fragmento-tabla-peticion-std',$lista[$i]); 	
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
					if ( $numeroPeticiones > CANTPOST ) : ?>
				
						<button class="btn btn-primary load-more-peticiones-btn" data-user="<?php echo $plantillaReduce ?>" data-cant-post="<?php echo CANTPOST ?>" data-post-orden="desc">
							Cargar más
						</button>
				<?php endif; ?>
				<?php if ( $numeroPeticiones > 5 ) : ?>
					<div class="select-cant-post">
						<p>Mostrar: </p>
						<select class="select-mostrar-peticiones" data-user="<?php echo $plantillaReduce ?>" data-post-orden="desc" data-afiliado-status="all">
							<option value="5">5</option>
						<?php if ( $numeroPeticiones > 10 ) : ?>
							<option value="10" selected>10</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 25 ) : ?>
							<option value="25">25</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 50 ) : ?>
							<option value="50">50</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 100 ) : ?>
							<option value="100">100</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 250 ) : ?>
							<option value="250">250</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 500 ) : ?>
							<option value="500">500</option>
						<?php endif; ?>
						<?php if ( $numeroPeticiones > 1000 ) : ?>
							<option value="1000">1000</option>
						<?php endif; ?>
						</select> 
						<p>peticiones por página.</p>
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