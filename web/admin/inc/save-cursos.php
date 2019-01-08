<?php
/*
 * guarda viajes
 * Since 4.0
 * 
*/
require_once("functions.php");
if ( isAjax() ) {

	$connection = connectDB();
	$tabla = 'cursos';
	$post_type = isset( $_POST['post_type'] ) ? $_POST['post_type'] : 'no_formal';
	$titulo = isset( $_POST['titulo'] ) ? $_POST['titulo'] : '';
	$slug = isset( $_POST['slug'] ) ? $_POST['slug'] : '';
	$resumen = isset( $_POST['resumen'] ) ? $_POST['resumen'] : '';
	$metodologia = isset( $_POST['metodologia'] ) ? $_POST['metodologia'] : '';
	$objGeneral = isset( $_POST['objGeneral'] ) ? $_POST['objGeneral'] : '';
	$objEspecifico = isset( $_POST['objEspecifico'] ) ? $_POST['objEspecifico'] : '';
	$requisitos = isset( $_POST['requisitos'] ) ? $_POST['requisitos'] : '';
	$imagen = isset( $_POST['imagen'] ) ? $_POST['imagen'] : '';
	$destinatario = isset( $_POST['destinatario'] ) ? $_POST['destinatario'] : '';
	$certificado = isset( $_POST['certificado'] ) ? $_POST['certificado'] : '';
	$cursada = isset( $_POST['cursada'] ) ? $_POST['cursada'] : '';
	$horarios = isset( $_POST['horarios'] ) ? $_POST['horarios'] : '';
	$lugar = isset( $_POST['lugar'] ) ? $_POST['lugar'] : '';
	$destacado = isset( $_POST['destacado'] ) ? $_POST['destacado'] : '0';
	$archivo = isset( $_POST['archivo'] ) ? $_POST['archivo'] : '';
	$orden = isset( $_POST['orden'] ) ? $_POST['orden'] : '0';
	$newArticle = isset( $_POST['newArticle'] ) ? $_POST['newArticle'] : 'true';
	$idItem = isset( $_POST['idItem'] ) ? $_POST['idItem'] : '';
	
	//limpieza general
	$orden = filter_var($orden,FILTER_SANITIZE_NUMBER_INT);

	//si el post es nuevo se crea
	if ( $newArticle == 'true' ) {
		if ( $post_type == 'formacion_tecnica' ) { 

			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
			$slug = filter_var($slug,FILTER_SANITIZE_STRING);
			$resumen = filter_var($resumen,FILTER_SANITIZE_STRING);
			$metodologia = filter_var($metodologia,FILTER_SANITIZE_STRING);
			$objGeneral = filter_var($objGeneral,FILTER_SANITIZE_STRING);
			$requisitos = filter_var($requisitos,FILTER_SANITIZE_STRING);
			$destinatario = filter_var($destinatario,FILTER_SANITIZE_STRING);
			$certificado = filter_var($certificado,FILTER_SANITIZE_STRING);
			$cursada = filter_var($cursada,FILTER_SANITIZE_STRING);
			$horarios = filter_var($horarios,FILTER_SANITIZE_STRING);
			$lugar = filter_var($lugar,FILTER_SANITIZE_STRING);

			if ( $certificado == '' ) {
				$certificado = '&nbsp;';
			}

			if ( $cursada == '' ) {
				$cursada = '&nbsp;';
			}

			if ( $lugar == '' ) {
				$lugar = '&nbsp;';
			}

			if ( $horarios == '' ) {
				$horarios = '&nbsp;';
			}

			$queryCreateItem  = "INSERT INTO " .$tabla. " (curso_slug, curso_titulo, curso_resumen, curso_metodologia, curso_objgeneral, curso_objespecifico, curso_requisitos, curso_imagen, curso_certificado, curso_cursada, curso_lugar, curso_horarios, curso_destinatario, curso_destacado, curso_orden, curso_tipo) VALUES ('$slug','$titulo','$resumen','$metodologia','$objGeneral','$objEspecifico','$requisitos','$imagen','$certificado','$cursada','$lugar','$horarios','$destinatario','$destacado','$orden', 'formacion_tecnica')";
		
		} else if ( $post_type == 'no_formal' ) {
			
			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);

			$queryCreateItem  = "INSERT INTO " .$tabla. " (curso_slug, curso_titulo, curso_resumen, curso_metodologia, curso_objgeneral, curso_objespecifico, curso_requisitos, curso_imagen,curso_archivo, curso_certificado, curso_cursada, curso_lugar, curso_horarios, curso_destinatario, curso_destacado, curso_orden, curso_tipo) VALUES ('','$titulo','','','','$objEspecifico','','$imagen','$archivo',','','','','','0','$orden', 'no_formal')";

		} else if ( $post_type == 'universitarios' ) {
			
			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);

			$queryCreateItem  = "INSERT INTO " .$tabla. " (curso_slug, curso_titulo, curso_resumen, curso_metodologia, curso_objgeneral, curso_objespecifico, curso_requisitos, curso_imagen, curso_certificado, curso_cursada, curso_lugar, curso_horarios, curso_destinatario, curso_destacado, curso_orden, curso_tipo) VALUES ('','$titulo','','','','$objEspecifico','','$imagen','$archivo','','','','','0','$orden', 'universitarios')";

		}

		$result = mysqli_query($connection, $queryCreateItem);
		
		echo mysqli_insert_id($connection);

	} //si el post ya existe se actualiza
		else {

		if ( $post_type == 'formacion_tecnica' ) { 

			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
			$slug = filter_var($slug,FILTER_SANITIZE_STRING);
			$resumen = filter_var($resumen,FILTER_SANITIZE_STRING);
			$metodologia = filter_var($metodologia,FILTER_SANITIZE_STRING);
			$objGeneral = filter_var($objGeneral,FILTER_SANITIZE_STRING);
			$requisitos = filter_var($requisitos,FILTER_SANITIZE_STRING);
			$destinatario = filter_var($destinatario,FILTER_SANITIZE_STRING);
			$certificado = filter_var($certificado,FILTER_SANITIZE_STRING);
			$cursada = filter_var($cursada,FILTER_SANITIZE_STRING);
			$horarios = filter_var($horarios,FILTER_SANITIZE_STRING);
			$lugar = filter_var($lugar,FILTER_SANITIZE_STRING);

			if ( $certificado == '' ) {
				$certificado = '&nbsp;';
			}

			if ( $cursada == '' ) {
				$cursada = '&nbsp;';
			}

			if ( $lugar == '' ) {
				$lugar = '&nbsp;';
			}

			if ( $horarios == '' ) {
				$horarios = '&nbsp;';
			}

			$queryUpdateItem  = "UPDATE ".$tabla." SET curso_slug='".$slug."', curso_titulo='".$titulo."', curso_resumen='".$resumen."', curso_metodologia='".$metodologia."', curso_objgeneral='".$objGeneral."', curso_objespecifico='".$objEspecifico."', curso_requisitos='".$requisitos."', curso_imagen='".$imagen."', curso_certificado='".$certificado."', curso_cursada='".$cursada."', curso_lugar='".$lugar."', curso_horarios='".$horarios."', curso_destinatario='".$destinatario."', curso_destacado='".$destacado."', curso_orden='".$orden."' WHERE curso_ID='".$idItem."' LIMIT 1";

		} else if ( $post_type == 'no_formal' ) {

			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
			
			
			$queryUpdateItem  = "UPDATE ".$tabla." SET curso_titulo='".$titulo."', curso_objespecifico='".$objEspecifico."', curso_imagen='".$imagen."', curso_archivo='".$archivo."', curso_orden='".$orden."' WHERE curso_ID='".$idItem."' LIMIT 1";

		} else if ( $post_type == 'universitarios' ) {

			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);

			$queryUpdateItem  = "UPDATE ".$tabla." SET curso_titulo='".$titulo."', curso_objespecifico='".$objEspecifico."', curso_imagen='".$imagen."', curso_archivo='".$archivo."', curso_orden='".$orden."' WHERE curso_ID='".$idItem."' LIMIT 1";
			
		} else {

			$dataextra1 = isset( $_POST['dataextra1'] ) ? $_POST['dataextra1'] : '';
			$dataextra2 = isset( $_POST['dataextra2'] ) ? $_POST['dataextra2'] : '';
			$dataextra3 = isset( $_POST['dataextra3'] ) ? $_POST['dataextra3'] : '';
			$archivo = isset( $_POST['archivo'] ) ? $_POST['archivo'] : '';
			
			$titulo = filter_var($titulo,FILTER_SANITIZE_STRING);
			$slug = filter_var($slug,FILTER_SANITIZE_STRING);
			$resumen = filter_var($resumen,FILTER_SANITIZE_STRING);
			$lugar = filter_var($lugar,FILTER_SANITIZE_STRING);
			$dataextra1 = filter_var($dataextra1,FILTER_SANITIZE_STRING);
			$dataextra2 = filter_var($dataextra2,FILTER_SANITIZE_STRING);
			$dataextra3 = filter_var($dataextra3,FILTER_SANITIZE_STRING);

			$queryUpdateItem  = "UPDATE ".$tabla." SET curso_slug='".$slug."', curso_titulo='".$titulo."', curso_resumen='".$resumen."', curso_metodologia='".$metodologia."', curso_objgeneral='".$objGeneral."', curso_objespecifico='".$objEspecifico."', curso_requisitos='".$requisitos."', curso_imagen='".$imagen."', curso_archivo='".$archivo."', curso_certificado='".$certificado."', curso_cursada='".$cursada."', curso_lugar='".$lugar."', curso_horarios='".$horarios."', curso_dataextra1='".$dataextra1."', curso_dataextra2='".$dataextra2."', curso_dataextra3='".$dataextra3."', curso_destinatario='".$destinatario."', curso_destacado='".$destacado."', curso_orden='".$orden."' WHERE curso_ID='".$idItem."' LIMIT 1";

		}

		$result = mysqli_query($connection, $queryUpdateItem);
		
		echo 'ok';
	}
	
	//cierre base de datos
	mysqli_close($connection);

} //if not ajax
else {
	exit;
}
