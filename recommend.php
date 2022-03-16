<?php

//Access the session
session_start();
$page_title = "Recommend";

require ('redirect_function.php');

//Redirect user to login screen if not signed in 
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){
  header("Location: login.php");
  exit();
}

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//connecting to the database
	require ('mysqli_connect.php');

    $id = $_SESSION['userID'];
    $username = $_SESSION['username'];
    $busCity = $_SESSION['userCity'];

	//Making an array to hold error messages
	$errors = array();

	//checking for form information
    //checking for business name, street address, city, state, and zip code
	if (empty($_POST['busName'])){
		$errors[] = 'Must enter business name to recommend it to others.';
	}
	else{
		$busName = mysqli_real_escape_string($dbc, trim($_POST['busName']));
	}

    if (empty($_POST['busStreetAddress'])){
        $errors[] = 'Must enter the street address so people can find your recommendation.';
    }
    else{
        $busStreetAddress = mysqli_real_escape_string($dbc, trim($_POST['busStreetAddress']));
    }

    if (empty($_POST['busState'])){
        $errors = 'Enter the state your recommendation is in.';
    }
    else{
        $busState = mysqli_real_escape_string($dbc, trim($_POST['busState']));
    }

    if (empty($_POST['busZipCode'])){
        $errors[] = 'Enter the zip code for your recommendation.';
    }
    else{
        $busZipCode = mysqli_real_escape_string($dbc, trim($_POST['busZipCode']));
    }

	//If nothing is wrong make query
	if (empty($errors)){

		$query = "INSERT INTO Business (busName, busStreetAddress, busCity, busState, busZipCode) 
		VALUES ('$busName', '$busStreetAddress', '$busCity', '$busState', '$busZipCode')";

		$result = @mysqli_query($dbc, $query);

		//If the query works relay message
		if ($result){

      redirect_user ('review.php');

			echo "<p>Thank you $username your favorite spot has been saved!</p>";
			echo '<p>Would you like to <a href="recommend.php">recommend</a> another business?</P>';
			echo '<p>Or go back to the <a href="home.php">Homepage</a>?';
		}

		//Otherwise list errors
		else{
			echo "There was an error. ";
			echo mysqli_error($dbc);
		}
		mysqli_close($dbc);

		exit();
	}
	else{

		echo "There were errors.";
		foreach($errors as $message){
			echo "$message";
		}
		echo "Try again";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Recommend</title>
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
        <a href="home.php"><li class="nav_select"><p class="nav_txt">Home</p></li></a>
        <a href="places.php"><li class="nav_select"><p class="nav_txt">Where To Go</p></li></a>
        <!--<a href="recommend.php"><li class="nav_active"><p>Recommend</p></li></a>-->
        <a href="myrecommendations.php"><li class="nav_select"><p class="nav_txt">My Recommendations</p></li></a>
        <a href="signout.php"><li class="nav_select"><p class="nav_txt">Sign Out</p></li></a>
      </ul>
    </div>
  </div>
  
  <div class="column middle">
  <div class="recommend_form">
	<h1 class="form_info">Recommend your favorite spot!</h1>
    
    <form action="recommend.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;">
      
      <label class="form_content_titles">Business Name</label></br>
      <input class="recommend_form_input" type="text" id="busName" name="busName" placeholder="Your favorite business's name goes here.." value="" required></br>

      <label class="form_content_titles">Address</label></br>
      <input class="recommend_form_input" type="text" id="busStreetAddress" name="busStreetAddress" placeholder="Let people know where it is.." value="" required></br>

      <label class="form_content_titles">City</label></br>
      <input class="recommend_form_input" type="text" id="busCity" name="busCity" value="<?php echo $_SESSION['userCity']?>" READONLY></br>

      <label class="form_content_titles">State</label></br>
      <input class="recommend_form_input" type="text" id="busState" name="busState" placeholder="State located in.. i.e. NY, WI, CA.." maxlength="2" required></br>

      <label class="form_content_titles">Zip Code</label></br>
      <input class="recommend_form_input" type="number" id="busZipCode" name="busZipCode" placeholder="Zip Code.. i.e. 12345" maxlength="5" required></br>
        
      <input class="recommend_form_submit" type="submit" name="submit" value="Submit">
    </form>
		</div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
</html>