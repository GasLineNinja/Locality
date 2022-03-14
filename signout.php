<?php

//access the session
session_start();
$page_title = 'Sign Out';

//if no session redirect user
if (!isset($_SESSION['username'])){

	require ("login_functions.php");
	echo '<p><h2 style="color: #07f813">You are currently logged out.<br/>Please <a href="login.php">Login</a> to continue.</p></h2>';
}
else{

	//clear variable
	$_SESSION = array();
	//destroy the session
	session_destroy();

//printing log out message
echo "<p><h2>You have been logged out!</h2></p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality SignOut</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylelayout.css">
</head>
<body>

  <?php
    //Include Header
    include('header.php');
  ?>



<div class="row">
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
  
  <div class="column middle">
    <div class="content">
      
    </div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
<?php include("footer.php");?>
</html>

