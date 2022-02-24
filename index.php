<?php
	//Start session
	session_start();
	
	//Include Header
	$page_title = 'Locality';
	include('header.php');
	
	//Mysql Connect
	include('mysqli_connect.php');

	// Welcome the user (by name if they are logged in): !!This code is old and can be changed
	echo '<h1><center>Welcome';
	if (isset($_SESSION['fname'])) {
		echo ", {$_SESSION['fname']}";
	} else {
		echo ", You are not currently logged in";
	}
	echo '!</center></h1>';
	
	//Include Footer
	include('footer.php');
?>