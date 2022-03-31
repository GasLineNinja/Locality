<?php

$page_title = 'Sign Up';
require ('redirect_function.php');

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//connecting to the database
	require ('mysqli_connect.php');

	//Making an array to hold error messages
	$errors = array();

	//checking for form information
  //checking for username, first name, last name, and email
	if (empty($_POST['username'])){
		$errors[] = 'You must enter a valid username.';
	}
	else{
		$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}

  if (empty($_POST['fname'])){
    $errors[] = 'You must enter your first name.';
  }
  else{
    $fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
  }

  if (empty($_POST['lname'])){
    $errors[] = 'You must enter your last name.';
  }
  else{
    $lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
  }

  if (empty($_POST['email'])){
    $errors = 'You must enter a valid email address.';
  }
  else{
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
  }

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

  //Checking for city and Zip code info
  if (empty($_POST['city'])){
    $errors[] = 'You must enter the city you live in.';
  }
  else{
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
  }

  if (empty($_POST['zipcode'])){
    $errors[] = 'You must enter the zip code where you live.';
  }
  else{
    $zipcode = mysqli_real_escape_string($dbc, trim($_POST['zipcode']));
  }

	//If nothing is wrong make query
	if (empty($errors)){

    $query = "SELECT username FROM User WHERE username='$username'";

    $result = @mysqli_query($dbc, $query);

    if ($result){
      echo '<h2 style="color: red;">Username already exists. Please choose another.<h2>';
    }
    else{
      $query = "INSERT INTO User (username, userFirstName, userLastName, userPassword, userCity, userZipCode, userEmail) 
      VALUES ('$username', '$fname', '$lname', SHA2('$password',256), '$city', '$zipcode', '$email')";

      $result = @mysqli_query($dbc, $query);

      //If the query works relay message
      if ($result){

        redirect_user ('login.php');

        echo "<p>Thank you $username you are now signed up!</p>";
        echo '<p>Please <a href="login.php">Login</a> to continue.</P>';
        
      }

      //Otherwise list errors
      else{
        echo "There was an error. ";
        echo mysqli_error($dbc);
      }
      mysqli_close($dbc);

      exit();
    }
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
<title>Locality Sign Up</title>
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
		<div class="signUp_form">
		<h1 class="form_info">Please fill out the form below to create an account</h1>
    <p class="redirect_size">or <a class="redirect_btn" href="login.php">Login</a> if you have an existing account</p>
    <form action="signup.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;" action="login.php">
      
      <label class="form_content_titles">Username</label></br>
      <input class="signUp_form_input" type="text" id="username" name="username" placeholder="Username.." value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>" required></br>

      <label class="form_content_titles">Password</label></br>
      <input class="signUp_form_input" type="password" id="pass1" name="pass1" placeholder="Password.." value="<?php if(isset($_REQUEST['userPassword'])) echo $_REQUEST['userPassword'];?>" required></br>

      <label class="form_content_titles">Confirm Password</label></br>
      <input class="signUp_form_input" type="password" id="pass2" name="pass2" placeholder="Confirm Password.." required></br>

      <label class="form_content_titles">First Name</label></br>
      <input class="signUp_form_input" type="text" id="fname" name="fname" placeholder="Your first name.." required></br>

      <label class="form_content_titles">Last Name</label></br>
      <input class="signUp_form_input" type="text" id="lname" name="lname" placeholder="Your last name.." required></br>

      <label class="form_content_titles">Email</label></br>
      <input class="signUp_form_input" type="email" id="email" name="email" placeholder="Email Address.." required></br>
        
      <label class="form_content_titles">City</label></br>
      <input class="signUp_form_input" type="text" id="city" name="city" placeholder="City where you live.." required></br>

      <label class="form_content_titles">Zip Code</label></br>
      <input class="signUp_form_input" type="text" id="zipcode" name="zipcode" placeholder="Zip code where you live.." required>

      <input class="signUp_form_submit" type="submit" name="submit" value="Submit">
    </form>
		</div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>