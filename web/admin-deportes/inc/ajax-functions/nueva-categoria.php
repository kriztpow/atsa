<?php
require '../functions.php';

if ( isAjax() ) {

    $connection     = connectDB();
    $nombre = isset($_POST['nombre_nueva_categoria']) ? $_POST['nombre_nueva_categoria'] : '';
    $slug = isset($_POST['slug_nueva_categoria']) ? $_POST['slug_nueva_categoria'] : '';
    //$tipo = isset($_POST['tipo_nueva_categoria']) ? $_POST['tipo_nueva_categoria'] : '';
    
    if ( $slug == '' ) {
        echo 'Slug vacío';
        return;
    }

    $query  = "INSERT INTO deportes (nombre,slug) VALUES ('".$nombre."','".$slug."')";

    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $nuevoId = mysqli_insert_id($connection);

        $html = '';
        $html .= '<tr><td><input type="hidden" name="categoria_id" value="'.$nuevoId.'"><input type="hidden" name="categoria_slug" value="'.$slug.'"><input type="text" name="categoria_name" value="'.$nombre.'"></td><td><button data-id="'.$nuevoId.'" class="btn btn-primary btn-sm btn-change-category">Guardar</button>&nbsp;<button data-id="'.$nuevoId.'" class="btn btn-danger btn-sm btn-del-category">Borrar</button><span class="error-msj"></span></td></tr>';

        echo $html;
    } else {
        echo 'error';
    }

	//cierre base de datos
    mysqli_close($connection);

} else {
	exit;
}//else - fin script