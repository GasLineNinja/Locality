<!DOCTYPE html>
<html lang="en">
<head>
<title>Locality Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylelayout.css">
</head>
<body>
  <div class="topnav">
      <div class="topnav-left">
          <img class="lglogo" src="LogoFull_3.0.png" width="200" height="auto">
          <h1 style="color:#07f813; text-align:center">Please login to continue</h1>
      </div>
  </div>

<div class="row">
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
  
  <div class="column middle">
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