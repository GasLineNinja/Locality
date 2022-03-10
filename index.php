<?php
	$page_title = 'Locality';
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
  <header>
    <div class="topnav">
      <div class="topnav-left">
            <a href="index.php"><img class="lglogo" src="LogoFull_3.0.png" width="200" height="auto" ></a>
        <a style="margin-left:10px" href="login.php" class ="login">Login</a>
        <a style="margin-left:-20px" href="signup.php" class ="signup">Sign Up</a>
        <div class="search-container">
          <form>
            <input style="margin-left:75px" class="searchbar" type="text" placeholder="Search.." name="search">
            <button type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
</header>

<div class="row">
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
  
  <div class="column middle">
    <h2 class="welcome">Welcome to Locality!</h2>
    <h3 class="whatDo">What we do:</h3>
		<div class="info_full">
    <dl class="deets">
      <dt class="info_title">Tourists</dt>
	      <dd class="info_content">➡ No more getting stuck in tourist trap areas</dd>
	      <dd class="info_content">➡ Find local places from bars, restaurants, parks and attractions that are off the beaten path</dd>
	      <dd class="info_content">➡ Get a chance to Live Like a Local</dd><br>
      <dt class="info_title">Local Residents</dt>
	      <dd class="info_content">➡ Rep your favorite places in town</dd>
	      <dd class="info_content">➡ Help shine like on your town's local businesses</dd>
	      <dd class="info_content">➡ Give visitor a chance to experience your city the way it was meant to</dd>
		</div>
    </dl>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
<?php include('footer.php');?>
</html>