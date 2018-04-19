<?php
/*
 * editar slider
 * Edita el slider seleccionado o crea uno nuevo
 * Since 3.0
 * 
*/
require_once("inc/functions.php");

//recupera slug a buscar
global $slug;

if ($slug != '') {
	//busca en la base de datos los datos del slider
	showSliderToEdit ( $slug );
	//recupera los datos
	global $dataSlider;
}

$item = 1;

?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container">
			
			<h2 class="text-center">
			 	Slider: <?php echo $slug; ?>
			</h2>
			<div id="imagen_destacada_wrapper">
				<button id="new-item" class="btn btn-lg btn-warning">Agregar nuevo item</button>
			</div>

			<ul id="<?php echo $slug; ?>" class="sliders-wrapper">
				<?php for ($i=0; $i < count($dataSlider); $i++) {
				 	$row = $dataSlider[$i];
					$sliderID        = isset($row['slider_id'])? $row['slider_id']:'';
					$sliderImagen    = isset($row['slider_imagen'])? $row['slider_imagen']:'';
					$sliderTitulo    = isset($row['slider_titulo'])? $row['slider_titulo']:'';
					$sliderLink      = isset($row['slider_link'])? $row['slider_link']:'';
					$sliderTextoLink = isset($row['slider_textoLink'])? $row['slider_textoLink']:'';
					$sliderTexto     = isset($row['slider_texto'])? $row['slider_texto']:'';
					$sliderUbicacion = isset($row['slider_ubicacion'])? $row['slider_ubicacion']:'';
					$sliderOrden     = isset($row['slider_orden'])? $row['slider_orden']:'';
				?>
				<li class="item-slider" id="<?php echo $sliderID; ?>">
					<h3>Item <?php echo $item; ?></h3>
					<div class="row">	 
						<!-- col -->
						<div class="col-sm-6">
						<form id="edit_slider_imagen" name="edit_slider_imagen" data-sliderID="<?php echo $sliderID; ?>" method="POST" >
							<div class="group-form">
								<input type="hidden" name="slider_imagen" value="<?php echo $sliderImagen; ?>">

								<img id="slider_imagen_Preview-<?php echo $sliderID; ?>" src="/uploads/images/<?php echo $sliderImagen; ?>" class="img-responsive">
							</div>
							<div class="group-form recargar-btn-wrapper">
								<button data-sliderID="<?php echo $sliderID; ?>" type="button" class="btn btn-info btn-xs btn-recargar">Cargar nueva foto</button><span class="msj-guardar-imagen"></span>
							</div>
						</form>
						</div><!-- //col -->
						<!-- col -->
						<div class="col-sm-6">
							<div class="group-form input-sliders">
								<label for="slider_titulo-<?php echo $item; ?>">Titulo a mostrar</label>
								<input type="text" name="slider_titulo-<?php echo $item; ?>" id="slider_titulo-<?php echo $item; ?>" value="<?php echo $sliderTitulo; ?>">
							</div>

							<div class="group-form input-sliders">
								<label for="sliderLink-<?php echo $item; ?>">URL</label>
								<input type="text" name="sliderLink-<?php echo $item; ?>" id="sliderLink-<?php echo $item; ?>" value="<?php echo $sliderLink; ?>">
							</div>

							<div class="group-form input-sliders">
								<label for="slider_textoLink-<?php echo $item; ?>">Texto boton</label>
								<input type="text" name="slider_textoLink-<?php echo $item; ?>" id="slider_textoLink-<?php echo $item; ?>" value="<?php echo $sliderTextoLink; ?>">
							</div>
						</div><!-- //col -->
					</div><!-- //row -->
					<div class="row">	 
						<!-- col -->
						<div class="col-sm-6">
							<div class="group-form input-sliders">
								<label for="slider_texto-<?php echo $item; ?>">Texto slider</label>
								<textarea id="slider_texto-<?php echo $item; ?>" name="slider_texto-<?php echo $item; ?>"><?php echo $sliderTexto; ?></textarea>
							</div>
						</div><!-- //col -->

						<div class="col-sm-6">
						<hr>
							<div class="row">
								<div class="col-sm-5">
									<div class="group-form input-sliders">
										<label for="slider_orden-<?php echo $item; ?>">Orden de ubicación</label>
										<input type="number" name="slider_orden-<?php echo $item; ?>" id="slider_orden-<?php echo $item; ?>" value="<?php echo $sliderOrden; ?>">
									</div>
								</div><!-- //col -->
								<div class="col-sm-7">
									<div class="group-form input-sliders borrar-guardar-btns">
										<button data-id="<?php echo $sliderID ?>" type="button" class="btn btn-warning btn-guardar">Guardar item</button>
										<button data-id="<?php echo $sliderID ?>" type="button" class="btn btn-danger btn-xs btn-borrar">Borrar item</button>
										<span class="msj-guardar"></span>
									</div>
								</div><!-- //col -->
							</div><!-- //row -->
						</div><!-- //col -->

					</div><!-- //row -->
				</li>
				<?php 
				$item++;
				}//for ?>
			
			</ul>
		</div><!-- // container -->
		<div id="dialog">
			
		</div>
		
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
		    <a type="button" href="index.php?admin=sliders" class="btn btn-info">Volver a sliders</a>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->