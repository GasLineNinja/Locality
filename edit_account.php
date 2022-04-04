<?php

session_start();
$page_title = 'Edit Acoount';
require ('redirect_function.php');

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	//connecting to the database
	require ('mysqli_connect.php');

	//Making an array to hold error messages
	$errors = array();

    $userID = $_SESSION['userID'];
    $fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
    $lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $city = mysqli_real_escape_string($dbc, trim($_POST['city']));
    $zipcode = mysqli_real_escape_string($dbc, trim($_POST['zipcode']));

    $query = "UPDATE User SET userFirstName='$fname', userLastName='$lname', userEmail='$email', userCity='$city', userZipCode='$zipcode'
    WHERE userID='$userID'";

    $result = @mysqli_query($dbc, $query);

    if ($result){
        $_SESSION['userFirstName'] = $fname;
        $_SESSION['userLastName'] = $lname;
        $_SESSION['userEmail'] = $email;
        $_SESSION['userCity'] = $city;
        $_SESSION['userZipCode'] = $zipcode;
        redirect_user('home.php');
    }
    else{
        echo "There was an error. ";
        echo mysqli_error($dbc);
    }
    mysqli_close($dbc);

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Edit Account Info</title>
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
		<h1 class="form_info">Edit your account information below</h1>
    <form action="edit_account.php" method="post" style="margin-left:125px; text-align:left; font-size:x-large;">
      
      <label class="form_content_titles">First Name</label></br>
      <input class="signUp_form_input" type="text" id="fname" name="fname" value="<?php echo $_SESSION['userFirstName']?>"></br>

      <label class="form_content_titles">Last Name</label></br>
      <input class="signUp_form_input" type="text" id="lname" name="lname" value="<?php echo $_SESSION['userLastName']?>"></br>

      <label class="form_content_titles">Email</label></br>
      <input class="signUp_form_input" type="email" id="email" name="email" value="<?php echo $_SESSION['userEmail']?>"></br>
        
      <label class="form_content_titles">City</label></br>
      <input class="signUp_form_input" type="text" id="city" name="city" value="<?php echo $_SESSION['userCity']?>"></br>

      <label class="form_content_titles">Zip Code</label></br>
      <input class="signUp_form_input" type="text" id="zipcode" name="zipcode" value="<?php echo $_SESSION['userZipCode']?>">

      <input class="signUp_form_submit" type="submit" name="submit" value="Submit">
    </form>
		</div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  <div>
      <ul class="sideNav">
        <a href="home.php"><li class="nav_select"><p class="nav_txt">Back</p></li></a>
      </ul>
    </div>
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>