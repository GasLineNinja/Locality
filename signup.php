<?php

$page_title = 'Sign Up';

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

		$query = "INSERT INTO user (username, userFirstName, userLastName, userPassword, userCity, userZipCode, userEmail) 
		VALUES ('$username', '$fname', '$lname', SHA2('$password',256), '$city', '$zipcode', '$email')";

		$result = @mysqli_query($dbc, $query);

		//If the query works relay message
		if ($result){

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
  <div class="topnav">
      <div class="topnav-left">
          <img class="lglogo" src="LogoFull_3.0.png" width="200" height="auto">
          <h1 style="color:#07f813; text-align:center">Please fill out the form below to create an account</h1>
      </div>
  </div>

<div class="row">
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
  
  <div class="column middle">
    <form action="signup.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;" action="login.php">
      
      <label class="username">Username</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="username" name="username" placeholder="Username.." value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>" required></br>

      <label class="password">Password</label></br>
      <input style="width:75%; border-radius: 25px" type="password" id="pass1" name="pass1" placeholder="Password.." value="<?php if(isset($_REQUEST['userPassword'])) echo $_REQUEST['userPassword'];?>" required></br>

      <label class="cpassword">Confirm Password</label></br>
      <input style="width:75%; border-radius: 25px" type="password" id="pass2" name="pass2" placeholder="Confirm Password.." required></br>

      <label class="fname">First Name</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="fname" name="fname" placeholder="Your first name.." required></br>

      <label class="lname">Last Name</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="lname" name="lname" placeholder="Your last name.." required></br>

      <label class="email">Email</label></br>
      <input style="width:75%; border-radius: 25px" type="email" id="email" name="email" placeholder="Email Address.." required></br>
        
      <label class="city">City</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="city" name="city" placeholder="City where you live.." required></br>

      <label class="zipcode">Zip Code</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="zipcode" name="zipcode" placeholder="Zip code where you live.." required></br></br>

      <input style="width:25%; margin-left:245px; color: rgba(11, 3, 117, 0.6); background-color: #07f813; border-radius: 25px" type="submit" name="submit" value="Submit">
    </form>
    
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>