<?php
/*
 * guarda la página
 * Since 6.0
 * Maneja el backend del editor de la página de inicio
*/
require_once('../functions.php');
if ( isAjax() ) {

	//se toman los datos para variables
	$connection             = connectDB();
	$tabla                  = 'pages';
	$pageId                 = isset( $_POST['page_id'] ) ? $_POST['page_id'] : '';
	$about_text             = isset($_POST['about_text']) ? $_POST['about_text'] : '';
	$about_mainfoto         = isset($_POST['about_mainfoto']) ? $_POST['about_mainfoto'] : '';
    $about_text_familia     = isset($_POST['about_text_familia']) ? $_POST['about_text_familia'] : '';
    $about_text_trayectoria = isset($_POST['about_text_trayectoria']) ? $_POST['about_text_trayectoria'] : '';
	$icon_cultura1          = isset($_POST['icon-cultura-1']) ? $_POST['icon-cultura-1'] : '';
    $text_cultura1          = isset($_POST['text-cultura-1']) ? $_POST['text-cultura-1'] : '';
    $icon_cultura2          = isset($_POST['icon-cultura-2']) ? $_POST['icon-cultura-2'] : '';
    $text_cultura2          = isset($_POST['text-cultura-2']) ? $_POST['text-cultura-2'] : '';
    $icon_cultura3          = isset($_POST['icon-cultura-3']) ? $_POST['icon-cultura-3'] : '';
    $text_cultura3          = isset($_POST['text-cultura-3']) ? $_POST['text-cultura-3'] : '';
    $icon_cultura4          = isset($_POST['icon-cultura-4']) ? $_POST['icon-cultura-4'] : '';
    $text_cultura4          = isset($_POST['text-cultura-4']) ? $_POST['text-cultura-4'] : '';
    $about_backfoto         = isset($_POST['about_backfoto']) ? $_POST['about_backfoto'] : '';
    $agenda_text            = isset($_POST['agenda_text']) ? $_POST['agenda_text'] : '';
    $cursos_image           = isset($_POST['cursos_image']) ? $_POST['cursos_image'] : '';
    $cursos_text_short      = isset($_POST['cursos_text_short']) ? $_POST['cursos_text_short'] : '';
    $cursos_text            = isset($_POST['cursos_text']) ? $_POST['cursos_text'] : '';
    $audiovisual_video      = isset($_POST['audiovisual_video']) ? $_POST['audiovisual_video'] : '';
    $audiovisual_link       = isset($_POST['audiovisual_link']) ? $_POST['audiovisual_link'] : '';
    $contact_tel1           = isset($_POST['contact_tel1']) ? $_POST['contact_tel1'] : '';
    $contact_tel2           = isset($_POST['contact_tel2']) ? $_POST['contact_tel2'] : '';
    $contact_email          = isset($_POST['contact_email']) ? $_POST['contact_email'] : '';
    $contact_facebook       = isset($_POST['contact_facebook']) ? $_POST['contact_facebook'] : '';
    $contact_text           = isset($_POST['contact_text']) ? $_POST['contact_text'] : '';

	//saneamiento
	$text_cultura1          = filter_var($text_cultura1,FILTER_SANITIZE_STRING);
	$text_cultura2          = filter_var($text_cultura2,FILTER_SANITIZE_STRING);
	$text_cultura3          = filter_var($text_cultura3,FILTER_SANITIZE_STRING);
	$text_cultura4          = filter_var($text_cultura4,FILTER_SANITIZE_STRING);
	$contact_text           = filter_var($contact_text,FILTER_SANITIZE_STRING);
	$contact_tel1           = filter_var($contact_tel1,FILTER_SANITIZE_STRING);
	$contact_tel2           = filter_var($contact_tel2,FILTER_SANITIZE_STRING);
	$audiovisual_video      = filter_var($audiovisual_video,FILTER_SANITIZE_URL);
	$audiovisual_link       = filter_var($audiovisual_link,FILTER_SANITIZE_URL);
	$contact_facebook       = filter_var($contact_facebook,FILTER_SANITIZE_URL);
	$contact_email          = filter_var($contact_email,FILTER_SANITIZE_EMAIL);

	$texto1 = explode('_', $text_cultura1);
	$texto2 = explode('_', $text_cultura2);
	$texto3 = explode('_', $text_cultura3);
	$texto4 = explode('_', $text_cultura4);

	//se arma el texto de cultura que viene en distintos cuadros y es una sola columna en la base de datos
	$about_text_cultura = '
	<ul class="stats">
    	<li class="fa  fa-6x">
    		<img src="'.UPLOADSURLIMAGES.'/'.$icon_cultura1.'" width="128px" height="128px"/>
    		<p>
      			<span class="count">
      				'.$texto1[0].'
      			</span>
      			<span class="count_plus"> + </span>
    		</p>
    		<p class="count_dscrp">
       			'.$texto1[1].'
    		</p>
    	</li>
    	<li class="fa  fa-6x">
    		<img src="'.UPLOADSURLIMAGES.'/'.$icon_cultura2.'" width="128px" height="128px"/>
		    <p>
	      		<span class="count">
	      			'.$texto2[0].'
	      		</span>
	      		<span class="count_plus"> + </span>
    		</p>
    		<p class="count_dscrp">
       			'.$texto2[1].'
    		</p>
    	</li>
    	<li class="fa fa-6x">
			<img src="'.UPLOADSURLIMAGES.'/'.$icon_cultura3.'" width="128px" height="128px"/>
    		<p>
      			<span class="count">
      			'.$texto3[0].'
      			</span>
      			<span class="count_plus"> + </span>
    		</p>
    		<p class="count_dscrp">
       			'.$texto3[1].'
    		</p>
    	</li>
    	<li class="fa fa-6x">
    		<img src="'.UPLOADSURLIMAGES.'/'.$icon_cultura4.'" width="128px" height="128px"/>
    		<p>
      			<span class="count">
      				'.$texto4[0].'
      			</span>
      			<span class="count_plus"> + </span>
    		</p>
    		<p class="count_dscrp">
       			'.$texto4[1].'
    		</p>
    	</li>
  	</ul>';
	

	//UPDATE PAGE
	$query = "UPDATE ".$tabla." SET about_mainfoto='".$about_mainfoto."', about_backfoto='".$about_backfoto."', about_text='".$about_text."', about_cultura='".$about_text_cultura."', about_familia='".$about_text_familia."', about_trayectoria='".$about_text_trayectoria."', agenda_text='".$agenda_text."', cursos_text_short='".$cursos_text_short."', cursos_text='".$cursos_text."', cursos_image='".$cursos_image."', audiovisual_link='".$audiovisual_link."', audiovisual_video='".$audiovisual_video."', contact_text='".$contact_text."', contact_tel1='".$contact_tel1."', contact_tel2='".$contact_tel2."', contact_email='".$contact_email."', contact_facebook='".$contact_facebook."' WHERE page_id='".$pageId."' LIMIT 1";

			$updatePage = mysqli_query($connection, $query); 
			
			if ($updatePage) {
				echo 'La página fue actualizada';
			} else {
				echo 'Hubo un error, intente maś tarde';
			}
		

	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}