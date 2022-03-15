<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<header>
<?php
  if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){

    //Displays defualt header when logged out
    echo "
    <div class='topnav'>
      <div class='topnav-left'>
            <a href='index.php'><img class='lglogo' src='LogoFull_3.0.png' width='200' height='auto' ></a>
            <a style='margin-left:10px' href='login.php' class ='login'>Login</a>
            <a style='margin-left:-20px' href='signup.php' class ='signup'>Sign Up</a>
        <div class='search-container'>
          <form autocomplete='off'>
						<button class='search_btn' type='submit'>Search</button>
            <input class='main_search'  type='text' placeholder='Search..' name='search'>
          </form>
        </div>
      </div>
    </div>";
  }
  else{

    //Displays header when logged in
    echo "
    <div class='topnav'>
      <div class='topnav-left'>
            <a href='home.php'><img class='lglogo' src='LogoFull_3.0.png' width='200' height='auto' ></a>
            <a style='margin-left:-20px' href='recommend.php' class ='signup'>Recommend a Spot</a>
        <div class='search-container'>
          <form autocomplete='off'>
						<button class='search_btn' type='submit'>Search</button>
            <input class='main_search'  type='text' placeholder='Search..' name='search'>
          </form>
        </div>
      </div>
    </div>";
  }
?>
</header>