<?php
/*
 * delete categoria
 * Since 4.0
*/
require_once('../functions.php');

if ( isAjax() ) {
    $connection     = connectDB();
    $id = $_POST['id'];

    $query = "DELETE FROM deportes WHERE id= '".$id."'";
    
    $result = mysqli_query($connection, $query); 
        if ($result) {
            echo 'ok';
        } else {
            echo 'error de borrado';
        }
	//cierre base de datos
    mysqli_close($connection);
	
} else{
	//sino es peticion ajax
    throw new Exception("Error Processing Request", 1);   
}

