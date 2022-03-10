<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//using helper files
	require ('login_functions.php');
	require ('mysqli_connect.php');

	//chcking the login
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['pass1']);

	//If everything is ok
	if ($check){

		//setting session data
		session_start();
		$_SESSION['username'] = $data['username'];

		$_SESSION['userID'] = $data['userID'];

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
	<!-- Very broken fix right now, temporary -->
	</br>
	</br>
	</br>
	<h1 style="font-size: 25px; color:#07f813; margin-right:100px; margin-top:-35px">Please login to continue</h1>
	<p>or <a style="color:#07f813" href="signup.php">Sign Up</a> to create an account</p>
    <form action="login.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;" action="login.php">

      <label class="username">Username</label></br>
      <input style="width:75%; border-radius: 25px" type="text" id="username" name="username" placeholder="Username.." value="<?php if(isset($_REQUEST['username'])) echo $_REQUEST['username'];?>" required></br>

      <label class="password">Password</label></br>
      <input style="width:75%; border-radius: 25px" type="password" id="pass1" name="pass1" placeholder="Password.." value="<?php if(isset($_REQUEST['userPassword'])) echo $_REQUEST['userPassword'];?>" required></br>

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