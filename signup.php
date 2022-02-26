<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Index</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylelayout.css">
</head>
<body>
  <div class="topnav">
      <div class="topnav-left">
          <img class="lglogo" src="LogoFull_3.0.png" width="200" height="auto">
          <h1 style="color:#07f813;">Please fill out the form below to create an account</h1>
      </div>
  </div>

<div class="row">
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
  
  <div class="column middle">
    <form style="text-align:left; font-size:x-large;" action="login.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username.."></br>

        <label for="pass1">Password</label>
        <input type="password" id="pass1" name="pass1" placeholder="Password.."></br>

        <label for="pass2">Confirm Password</label>
        <input type="password" id="pass2" name="pass2" placeholder="Confirm Password.."></br>

        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your first name.."></br>

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.."></br>

        <label for="city">City</label>
        <input type="text" id="city" name="city" placeholder="City where you live.."></br>

        <label for="zipcode">Zip Code</label>
        <input type="text" id="zipcode" name="zipcode" placeholder="Zip code where you live.."></br>
    </form>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>