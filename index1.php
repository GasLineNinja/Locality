<?php
	//Start session
	session_start();
	$page_title = 'Locality';

    //Mysql Connect
	include('mysqli_connect.php');
?>

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
      <a href="login.php" class ="login">Login</a>
      <a href="signup.php" class ="signup">Sign Up</a>
      <div class="search-container">
        <form>
          <input class="searchbar" type="text" placeholder="Search.." name="search">
          <button type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>

<div class="row">
  <div class="column side">
	<img class="smlogo" src="LogoSmall_3.0.png">
  </div>
  
  <div class="column middle">
    <h2>Main Content</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque tortor sed accumsan convallis.</p>
  </div>
  
  <div class="column side">
	<img class="smlogo" src="LogoSmall_3.0.png">
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>