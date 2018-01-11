<?php 
global $userStatus;
if ($userStatus != '0' && $userStatus != '1' ) {
	echo 'No tiene permisos para ver esta sección';
  	
  	exit;
}
load_module( 'pages' );
require_once("inc/functions.php");

$page = $_GET['slug'];
$data = getDataPage( $page );

function getIconImagen ( $data, $index ) {
	$imagen = explode( '"', $data[$index] );
	$imagen = explode( '/', $imagen[3] )[5];

	return $imagen;
}

function getTextCultura ( $data, $index ) {
	$text = explode( '>', $data[$index] );
	$texto = trim(explode( '<', $text[4] )[0]);
	$texto .= '_';
	$texto .= trim(explode( '<', $text[9] )[0]);

	return $texto;
}

$cultura = explode('<li',$data['about_cultura']);
$imagen1 = getIconImagen($cultura, '1');
$imagen2 = getIconImagen($cultura, '2');
$imagen3 = getIconImagen($cultura, '3');
$imagen4 = getIconImagen($cultura, '4');
$texto1 = getTextCultura($cultura, '1');
$texto2 = getTextCultura($cultura, '2');
$texto3 = getTextCultura($cultura, '3');
$texto4 = getTextCultura($cultura, '4');


?>	
<div class="contenido-modulo">

<?php if ( $page == 'home' ) : ?>

	<h1 class="titulo-modulo">
		Pagina de inicio
	</h1>
	<div class="container">
		
		<form method="POST" id="editar-pagina-formulario" name="editar-pagina-formulario">		
			<input type="hidden" name="page_id" value="<?php echo $data['page_id']; ?>">
				<div class="error-msj-wrapper">
					<ul class="error-msj-list">
						
					</ul>
				</div>
				
		<!------ SECTION NOSOTROS ---------->	
				<section class="wrapper-section-inicio">
					
					<h2 class="text-center">Nosotros</h2>
						
					<div class="row">
						<div class="col-50">
							<div class="form-group">
								<label for="about_text">
									Texto Nosotros:
								</label>
								<textarea class="editor-enriquecido" name="about_text" id="about_text">
									<?php echo $data['about_text']; ?>
								</textarea>
							</div>
						</div>

						<div class="col-50">
							<input type="hidden" name="about_mainfoto" id="about_mainfoto" value="<?php echo $data['about_mainfoto']; ?>" class="change-image-input">
							<img src="<?php echo UPLOADSURLIMAGES . '/' . $data['about_mainfoto']; ?>" alt="imagen de fondo" class="image-responsive">
							<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
						</div>
					</div>
					<div class="row">

						<div class="col-50">
							<div class="form-group">
								<label for="about_text_familia">
									Texto Somos Familia:
								</label>
								<textarea class="editor-enriquecido" name="about_text_familia" id="about_text_familia">
									<?php echo $data['about_familia']; ?>
								</textarea>
							</div>
						</div>

						<div class="col-50">
							<div class="form-group">
								<label for="about_text_trayectoria">
									Texto Somos trayectoria:
								</label>
								<textarea class="editor-enriquecido" name="about_text_trayectoria" id="about_text_trayectoria">
									<?php echo $data['about_trayectoria']; ?>
								</textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-20">
							<div class="form-group">
								<img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen1; ?>" class="image-responsive">
								<input type="hidden" id="icon-cultura-1" name="icon-cultura-1" value="<?php echo $imagen1; ?>" class="change-image-input">
								<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
							</div>
							<div class="form-group">
								<input type="text" name="text-cultura-1" id="text-cultura-1" value="<?php echo $texto1; ?>">
							</div>
						</div>
						<div class="col-20">
							<div class="form-group">
								<img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen2; ?>" class="image-responsive">
								<input type="hidden" name="icon-cultura-2" id="icon-cultura-2" value="<?php echo $imagen2; ?>" class="change-image-input">
								<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
							</div>
							<div class="form-group">
								<input type="text" name="text-cultura-2" id="text-cultura-2" value="<?php echo $texto2; ?>">
							</div>
						</div>
						<div class="col-20">
							<div class="form-group">
								<img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen3; ?>" class="image-responsive">
								<input type="hidden" id="icon-cultura-3" name="icon-cultura-3" value="<?php echo $imagen3; ?>" class="change-image-input">
								<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
							</div>
							<div class="form-group">
								<input type="text" name="text-cultura-3" id="text-cultura-3" value="<?php echo $texto3; ?>">
							</div>
						</div>
						<div class="col-20">
							<div class="form-group">
								<img src="<?php echo UPLOADSURLIMAGES . '/' . $imagen4; ?>" class="image-responsive">
								<input type="hidden" id="icon-cultura-4" name="icon-cultura-4" value="<?php echo $imagen4; ?>" class="change-image-input">
								<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
							</div>
							<div class="form-group">
								<input type="text" name="text-cultura-4" id="text-cultura-4" value="<?php echo $texto4; ?>">
							</div>
						</div>

						<div class="col">
							<p>
								<small>*El texto tiene que ser separado por un _ (guión bajo)</small>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="hidden" name="about_backfoto" id="about_backfoto" value="<?php echo $data['about_backfoto']; ?>" class="change-image-input">
							<img src="<?php echo UPLOADSURLIMAGES . '/' . $data['about_backfoto']; ?>" alt="imagen de fondo" class="image-responsive">
							<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
						</div>

					</div>

				</section>	

		<!------ SECTION AGENDA ---------->	
				<section class="wrapper-section-inicio">
					
					<h2 class="text-center">Agenda</h2>
						
					<div class="row">
						<div class="col-50">
							<div class="form-group">
								<label for="agenda_text">
									Texto agenda:
								</label>
								<textarea class="editor-enriquecido" name="agenda_text" id="agenda_text">
									<?php echo $data['agenda_text']; ?>
								</textarea>
							</div>
						</div>
					</div>

				</section>

		<!------ SECTION CURSOS Y TALLERES---------->	
				<section class="wrapper-section-inicio">
					
					<h2 class="text-center">Cursos y Talleres</h2>
						
					<div class="row">
						<div class="col-50">
							<input type="hidden" name="cursos_image" id="cursos_image" value="<?php echo $data['cursos_image']; ?>" class="change-image-input">
							<img src="<?php echo UPLOADSURLIMAGES . '/' . $data['cursos_image']; ?>" alt="imagen de fondo" class="image-responsive">
							<button type="button" class="btn btn-xs btn-danger btn-change-image">Cambiar imagen</button>
						</div>

						<div class="col-50">
							<div class="form-group">
								<label for="cursos_text_short">
									Texto corto de Cursos:
								</label>
								<textarea class="editor-enriquecido" name="cursos_text_short" id="cursos_text_short">
									<?php echo $data['cursos_text_short']; ?>
								</textarea>
							</div>

							<div class="form-group">
								<label for="cursos_text">
									Texto de Cursos:
								</label>
								<textarea class="editor-enriquecido" name="cursos_text" id="cursos_text">
									<?php echo $data['cursos_text']; ?>
								</textarea>
							</div>
						</div>
					</div>

				</section>	

		<!------ SECTION ESPACIO AUDIOVISUAL---------->	
				<section class="wrapper-section-inicio">
					
					<h2 class="text-center">Espacio Audiovisual</h2>
						
					<div class="row">
						<div class="col-50">
							<div class="form-group">
								<label for="audiovisual_video">
									Url del Video:
								</label>
								<input type="url" name="audiovisual_video" id="audiovisual_video" value="<?php echo $data['audiovisual_video']; ?>">
							</div>
						</div>

						<div class="col-50">
							<div class="form-group">
								<label for="audiovisual_link">
									Url del canal:
								</label>
								<input type="url" name="audiovisual_link" id="audiovisual_link" value="<?php echo $data['audiovisual_link']; ?>">
							</div>
						</div>
					</div>

				</section>

		<!------ SECTION CONTACTO---------->	
				<section class="wrapper-section-inicio">

					<h2 class="text-center">Contacto</h2>
						
					<div class="row">
						<div class="col-30">
							<div class="form-group">
								<label for="contact_tel1">
									Teléfono 1:
								</label>
								<input type="text" name="contact_tel1" id="contact_tel1" value="<?php echo $data['contact_tel1']; ?>">
							</div>
							<div class="form-group">
								<label for="contact_tel2">
									Teléfono 2:
								</label>
								<input type="text" name="contact_tel2" id="contact_tel2" value="<?php echo $data['contact_tel2']; ?>">
							</div>
						</div>

						<div class="col-30">
							<div class="form-group">
								<label for="contact_email">
									Email:
								</label>
								<input type="text" name="contact_email" id="contact_email" value="<?php echo $data['contact_email']; ?>">
							</div>
							<div class="form-group">
								<label for="contact_facebook">
									Link Facebook:
								</label>
								<input type="text" name="contact_facebook" id="contact_facebook" value="<?php echo $data['contact_facebook']; ?>">
							</div>
						</div>

						<div class="col-30">
							<div class="form-group">
								<label for="contact_text">
									Texto Corto:
								</label>
								<input type="text" name="contact_text" id="contact_text" value="<?php echo $data['contact_text']; ?>">
							</div>
						</div>
					</div>

				</section>	

				<hr>

			   	<div class="row">	
					<div class="col">
					   	<div class="form-group save-button-right">
					   		<button type="submit" name="submit_save" class="btn btn-primary btn-submit">Guardar Cambios</button>
					   	</div>
					</div><!-- // col -->
				</div><!-- // row -->  
			</form>	
		
	</div>

<?php endif; ?>

</div>
<div id="dialog">
	
</div>
<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
</footer>


