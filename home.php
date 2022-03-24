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
      <ul class="sideNav">
        <a href="home.php"><li class="nav_active"><p>Home</p></li></a>
        <a href="spots_piv.php"><li class="nav_select"><p class="nav_txt">Where To Go</p></li></a>
        <a href="recommend.php"><li class="nav_select"><p class="nav_txt">Recommend a Spot</p></li></a>
        <a href="my_recommendations.php"><li class="nav_select"><p class="nav_txt">My Recommendations</p></li></a>
        <a href="signout.php"><li class="nav_select"><p class="nav_txt">Sign Out</p></li></a>
      </ul>
    </div>
  </div>
  
  <div class="column middle">

  <div class="pull_content">
      <p class="review_busName">ACCOUNT INFOMATION WOULD GO HERE</p>

    
  </div>
  </br>


  <div class="pull_content">
    <center>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.4601443532665!2d-79.13427753120769!3d33.41124595587085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x890031609db58a79%3A0x4c1928338e07d867!2s617%20Springs%20Ave%2C%20Pawleys%20Island%2C%20SC%2029585!5e0!3m2!1sen!2sus!4v1648084354017!5m2!1sen!2sus" 
      width="560" height="450" style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
    </center>
    </div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
</html>