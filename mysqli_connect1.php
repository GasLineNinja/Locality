<?php

DEFINE ('DB_HOST','localhost');
DEFINE ('DB_USER','locality_locality');
DEFINE ('DB_PASSWORD','infost490capstone');
DEFINE ('DB_NAME','locality_infost490');

$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR die('Connection failed to server with error: ' .mysqli_connect_error());
?>
