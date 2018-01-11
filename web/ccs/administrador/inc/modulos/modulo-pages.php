<?php
/*
 * MODULO PAGES
*/

function getDataPage ( $page ) {
	$connection = connectDB();
	$tabla = 'pages';

	$query  = "SELECT * FROM " .$tabla. " WHERE page_name='".$page."' LIMIT 1";
	
	$result = mysqli_query($connection, $query);
	
	if ( $result->num_rows == 0 ) {
		return false;
	} else {
		$page = $result->fetch_array();

		return $page;
	}
}