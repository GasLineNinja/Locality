<?php
// Define Vars
DEFINE ('DB_HOST', 'DB host here'); //We need to put our new DB here
DEFINE ('DB_USER', 'DB User here');
DEFINE ('DB_PASSWORD', 'DB Paasoword here');
DEFINE ('DB_NAME', 'DB Name here');

//Connect to database
$dbc= @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Connection failed to server, Error:' . mysqli_connect_error());
?>