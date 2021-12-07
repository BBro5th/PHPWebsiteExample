<?php 

// This file contains the database access information. 
// This file establishes a connection to MySQL and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER', 'Username'); //Username placeholder
DEFINE ('DB_PASSWORD', 'password'); //password placeholder
DEFINE ('DB_HOST', 'localhost'); //will require being on same network as DB
DEFINE ('DB_NAME', 'DatabaseName');

// Make the connection:
$dbc = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
//echo "Connection successful!";  remove this statement once you know it is working
mysqli_set_charset($dbc,"utf8")
?>
