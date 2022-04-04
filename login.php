<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//using helper files
	require ('login_functions.php');
	require ('redirect_function.php');
	require ('mysqli_connect.php');

	//chcking the login
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['pass1']);

	//If everything is ok
	if ($check){

		//setting session data
		session_start();
		$_SESSION['username'] = $data['username'];

		$_SESSION['userID'] = $data['userID'];
		$_SESSION['userFirstName'] = $data['userFirstName'];
		$_SESSION['userLastName'] = $data['userLastName'];
		$_SESSION['userEmail'] = $data['userEmail'];
 		$_SESSION['userCity'] = $data['userCity'];
		$_SESSION['userZipCode'] = $data['userZipCode'];

		//storing HTTP_USER_AGENT
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		//redirecting to home page after login
		redirect_user('home.php');
	}
	else{
		$errors = $data;
	}

	//close the database
	mysqli_close($dbc);
}

//creating the login form
$page_title = 'Login';

//if there are any errors display them
if (isset($errors) && !empty($errors)){
	echo '<p><h1>Error!</h1></p>
		<p class="error">The following errors occured:<br/>';
	foreach ($errors as $message){
		echo "- $message<br/>\n";
	}
	echo "</p><p>Try again.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Login</title>
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
		<div class="login_form">
		<h1 class="form_info">Please login to continue</h1>
		<p class="redirect_size">or <a class="redirect_btn" href="signup.php">Sign Up</a> to create an account</p>
    <form action="login.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;" action="login.php">

      <label class="form_content_titles">Username</label></br>
      <input class="login_form_input" type="text" id="username" name="username" placeholder="Username.." value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>" required></br>

      <label class="form_content_titles">Password</label></br>
      <input class="login_form_input" type="password" id="pass1" name="pass1" placeholder="Password.." value="<?php if(isset($_REQUEST['userPassword'])) echo $_REQUEST['userPassword'];?>" required></br>

      <input class="login_form_submit" type="submit" name="submit" value="Submit">
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