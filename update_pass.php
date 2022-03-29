<?php

session_start();

$page_title = 'Update Password';

//Redirect user to login screen if not signed in 
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){
    header("Location: login.php");
    exit();
    }

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //connecting to the database
    require ('mysqli_connect.php');
    $seshUsername = $_SESSION['username'];

    //Making an array to hold error messages
    $errors = array();

	//Making sure passwords match
	if (!empty($_POST['pass1'])){
		if ($_POST['pass1'] != $_POST['pass2']){
			$errors[] = 'Your passwords do not match.';
		}
		else{
			$password = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	}
	else{
		$errors[] = 'You need to enter a pasword.';
	}

    //If nothing is wrong make query
	if (empty($errors)){

        $query = "UPDATE `User` SET `userPassword`= SHA2('$password',256) WHERE `username`='$seshUsername'";

        $result = @mysqli_query($dbc, $query);

        if ($result) {
            echo '<p style="color: #07f813; font-size: x-large;">Your password has been updated.</p>';
        }
        else{
            echo 'There was an error '.mysqli_error($dbc);
        }
    }
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

  <div class="signUp_form">
	<h1 class="form_info">Please enter new password</h1>
    <form action="update_pass.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;">

      <label class="form_content_titles">New Password</label></br>
      <input class="signUp_form_input" type="password" id="pass1" name="pass1" placeholder="Password.." value="<?php if(isset($_REQUEST['userPassword'])) echo $_REQUEST['userPassword'];?>" required></br>

      <label class="form_content_titles">Confirm Password</label></br>
      <input class="signUp_form_input" type="password" id="pass2" name="pass2" placeholder="Confirm Password.." required></br>
    
      <input class="signUp_form_submit" type="submit" name="submit" value="Submit">
    
    </form>
    </div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  <div>
      <ul class="sideNav">
        <a href="edit_account.php"><li class="nav_select"><p class="nav_txt">Edit Account</p></li></a>
        <a href="index.php"><li class="nav_select"><p class="nav_txt">Delete Account</p></li></a>
      </ul>
    </div>
  </div>
</div>
  
</body>
</html>