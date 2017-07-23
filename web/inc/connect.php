<?php
/*
 * Connection file
 * @since 2.5
*/

	define("DB_SERVER", "localhost");
	define("DB_USER", "dbuser");
	define("DB_PASS", "123");
	define("DB_NAME", "atsa");

  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if( mysqli_connect_errno() ) {
    die("Database connection failed: " . mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
