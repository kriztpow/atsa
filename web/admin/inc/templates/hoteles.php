<?php
/*
 * Editar sección hoteles
 * cambiar textos e imagenes
 * Since 4.0
 * 
*/
require_once("inc/functions.php");

//busca en la base de datos los datos del slider
	searchViajesData();
	//recupera los datos
	global $dataViajes;

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			<div id="hotelesyviajes">
		<!----- VIAJES ------------>
				<h3>Viajes</h3>
				<div>
					<div class="container-fluid">
						<h4>Modificar viajes</h4>
						<div class="wrapper-viajes-editor">
							<div class="row">
								<div class="col-sm-6">
									<h5>Texto superior de la página:</h5>
									<input type="text" id="texto-superior" name="texto-superior" value="<?php echo $dataViajes['texto_superior']; ?>">
								</div>
								
								<div class="col-sm-6">
									<h5>Texto de contacto:</h5>
									<input type="text" id="texto-contacto" name="texto-contacto" value="<?php echo $dataViajes['texto_contacto']; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<h5>Titulo Promoción:</h5>
									<input type="text" id="titulo-promo" name="titulo-promo" value="<?php echo $dataViajes['titulo_promocion']; ?>">
									<h5>Texto Promoción:</h5>
									<p>
										<small>Conviene utilizar la lista de viñetas para detallar los elementos</small>
									</p>
									<textarea id="promo-viajes-text" name="promo-viajes-text"><?php echo $dataViajes['texto_principal']; ?></textarea>
								</div>
							</div>
							<div class="btn-viajes-wrapper">
								<span class="msj-viajes-saved"></span>
								<button class="btn btn-danger" id="save-viajes-data">Guardar Cambios</button>
							</div>
						</div>
					</div>
				</div><!-- // cierre viajes -->

		<!----- HOTELES ------------>
				<h3>Hoteles</h3>
				<div>
					<div class="container-fluid">
						<h4>Modificar hoteles</h4>
						<button class="btn btn-warning btn-sm" id="new-item-hotel">Crear nuevo hotel</button>
						<ul class="lista-hoteles-admin">
							<?php searchHotelesAdmin(); ?>
						</ul>

					</div>
				</div><!-- // cierre hoteles -->
			</div><!-- // accordion -->
		</div><!-- // container -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
	    </div>
	    <div id="dialog"></div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->