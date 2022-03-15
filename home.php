<?php

session_start();
$page_title = "Home";

//Redirect user to login screen if not signed in 
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){
  header("Location: login.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Home</title>
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
    <div>
      <ul>
      <li><a class="active" href="home.php">Home</a></li>
          <li><a href="places.php">Where To Go</a></li>
          <li><a href="recommend.php">Recommend</a></li>
          <li><a href="myrecommendations.php">My Recommendations</a></li>
          <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </div>
  </div>
  
  <div class="column middle">
    <div class="content">
      <p>We need content of some sort here</p>
    </div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
</html>