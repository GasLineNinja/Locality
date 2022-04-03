<?php

//Access the session
session_start();
$page_title = "Recommend";

require ('redirect_function.php');

//Redirect user to login screen if not signed in 
if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']))){
header("Location: login.php");
exit();
}

//Checking if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //connecting to the database
  require ('mysqli_connect.php');

  $id = $_SESSION['userID'];
  $username = $_SESSION['username'];
  $busCity = $_SESSION['userCity'];
  

  //Making an array to hold error messages
  $errors = array();

  //checking for form information
  //Business info
  if (empty($_POST['busName'])){
      $errors[] = 'Must enter business name to recommend it to others.';
  }
  else{
      $busName = mysqli_real_escape_string($dbc, trim($_POST['busName']));
  }

  if (empty($_POST['busStreetAddress'])){
      $errors[] = 'Must enter the street address so people can find your recommendation.';
  }
  else{
      $busStreetAddress = mysqli_real_escape_string($dbc, trim($_POST['busStreetAddress']));
  }

  if (empty($_POST['busState'])){
      $errors[] = 'Enter the state your recommendation is in.';
  }
  else{
      $busState = mysqli_real_escape_string($dbc, trim($_POST['busState']));
  }

  if (empty($_POST['busZipCode'])){
      $errors[] = 'Enter the zip code for your recommendation.';
  }
  else{
      $busZipCode = mysqli_real_escape_string($dbc, trim($_POST['busZipCode']));
  }

  if (empty($_POST['busPrice'])){
      $errors[] = 'Enter price range.';
  }
  else{
      $busPrice = mysqli_real_escape_string($dbc, trim($_POST['busPrice']));
  }

  if (empty($_POST['busType'])){
      $errors[] = 'Enter the type of place this is.';
  }
  else{
      $busType = mysqli_real_escape_string($dbc, trim($_POST['busType']));
  }

  //Tag variables
    $KidFriendly = "Kid Friendly";
    $PetFriendly = "Pet Friendly";
    $DateNight = "Date Night";
    $VeganFriendly = "Vegan Friendly";
    $VegFriendly = "Vegetarian Friendly";
    $FamilyFun = "Family Fun";
    $OutdoorsNature = "Outdoors/Nature";
    $LocalGem = "Local Gem";

  //Covid Rules
  if (empty($_POST['busCovidRules'])){
      $errors[] = 'Enter whether this place follows COVID rules.';
  }
  else{
      $busCovidRules = mysqli_real_escape_string($dbc, trim($_POST['busCovidRules']));
  }

  //Review
  if (empty($_POST['reviewMessage'])){
      $errors[] = "Please enter a review to help this business stand out.";
  }
  else{
      $reviewMessage = mysqli_real_escape_string($dbc, trim($_POST['reviewMessage']));
  }

  ///// THIS IS THE UPLOAD CODE
  $imgFilePath = "uploads/" . $_FILES["imgFilePath"]["name"];

  if(file_exists("uploads/" . $_FILES["imgFilePath"]["name"])){

  } 
  else{
      $temp = explode(".", $_FILES["imgFilePath"]["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
      move_uploaded_file($_FILES["imgFilePath"]["tmp_name"], "uploads/" . $newfilename);
  }

  //If nothing is wrong make query to see if business has already been added
      if (empty($errors)){
          $query = "SELECT busID, busName, busZipCode, busCity, busReviewCount FROM Business WHERE busName='$busName' 
          AND busStreetAddress='$busStreetAddress' AND busCity='$busCity'";

          $result = @mysqli_query($dbc, $query);

          //Checking to see if business already exist in database
          if (mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                  $busReviewCount = $row["busReviewCount"];
                  $busID = $row["busID"];
              }
              
              //Incrementing review count to reflect multiple recomendations
              $busReviewCount += 1;
              
              //updating databse with new review count
              $query = "UPDATE Business SET busReviewCount='$busReviewCount' WHERE busID='$busID'";
          
              $result = @mysqli_query($dbc, $query);
          
              //If everything is fine add new review to review table for business
              if ($result){
                  $query = "INSERT INTO Review (userID, busID, reviewMessage)
                  VALUES ('$id', '$busID', '$reviewMessage')";
          
                  $result = @mysqli_query($dbc, $query);
                  
                  //If all is good redirect user to fresh recommend page
                  if ($result){
                      redirect_user('recommend.php');
                  }
                  //Otherwise produce errors if all is not good
                  else{
                      echo "There was an error. ";
                      echo mysqli_error($dbc);
                  }
                      mysqli_close($dbc);
              
                      exit();
              }
              //Otherwise return errors on add review
                  else{
                      echo "There was an error. ";
                      echo mysqli_error($dbc);
                  }
                      mysqli_close($dbc);
                  
                      exit();
          }
          //If business has not been recommended before insert form info into database
          else{
              $query = "INSERT INTO Business (busName, busStreetAddress, busCity, busState, busZipCode, busReviewCount, busPrice, busType, busCovidRules) 
              VALUES ('$busName', '$busStreetAddress', '$busCity', '$busState', '$busZipCode', '1', '$busPrice', '$busType', '$busCovidRules')";
      
              $result = @mysqli_query($dbc, $query);
      
              //If the query works query for the businuss
              if ($result){
                  $query = "SELECT busID FROM Business WHERE busName='$busName'";

                  $result = @mysqli_query($dbc, $query);

                  //Assign busID to a variable
                  if (mysqli_num_rows($result) > 0){
                      $row = mysqli_fetch_assoc($result);
                      $busID = $row["busID"];
                      
                      //If query works
                      if ($result){

                            //upload tags to database
                            if (isset($_POST['KidFriendly'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$KidFriendly')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Kid Friendly';
                                }
                            }
                            if (isset($_POST['PetFriendly'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$PetFriendly')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Pet Friendly';
                                }
                            }
                            if (isset($_POST['DateNight'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$DateNight')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Date Night';
                                }
                            }
                            if (isset($_POST['VeganFriendly'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$VeganFriendly')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Vegan Friendly';
                                }
                            }
                            if (isset($_POST['VegFriendly'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$VegFriendly')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Vegetarian Friendly';
                                }
                            }
                            if (isset($_POST['FamilyFun'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$FamilyFun')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Family Fun';
                                }
                            }
                            if (isset($_POST['OutdoorsNature'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$OutdoorsNature')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Outdoors/Nature';
                                }
                            }
                            if (isset($_POST['LocalGem'])){
                                $query = "INSERT INTO Tag (busID, tag) VALUES ('$busID', '$LocalGem')";

                                $result = @mysqli_query($dbc, $query);

                                if (!$result){
                                    echo 'There was an error on Local Only';
                                }
                            }
                        
                          //upload image to database
                          //if (isset($_POST['imgFilePath'])){
                              $query = "INSERT INTO Image (busID, imgFilePath) VALUES ('$busID', '$newfilename')";
                          
                              $result = @mysqli_query($dbc, $query);

                              //if (!$result){
                           //     echo "There was an error. ";
                           //     echo mysqli_error($dbc);
                           // }
                           //     mysqli_close($dbc);
                        
                           //     exit();
                              
                         // }
                          if ($result){
                              //if upload image works
                              if (isset($_POST['reviewMessage'])){

                                  //insert review info into review table with userID and busID as foreign keys
                                  $query = "INSERT INTO Review (userID, busID, reviewMessage)
                                  VALUES ('$id', '$busID', '$reviewMessage')";
                              
                                  $result = @mysqli_query($dbc, $query);
                                  
                                  //If everything is good redirect user to recommend another place
                                  if ($result){
                                      redirect_user ('recommend.php');
                                  }
                                  //Otherwise produce errors
                                  else{
                                      echo "There was an error. ";
                                      echo mysqli_error($dbc);
                                  }
                                      mysqli_close($dbc);
                              
                                      exit();
                              }
                            }
                              //Produce errors for image upload
                              else{
                                  echo "There was an error. ";
                                  echo mysqli_error($dbc);
                              }
                                  mysqli_close($dbc);
                          
                                  exit();
                           // }
                      }
                      //list errors for query
                          else{
                              echo "There was an error. ";
                              echo mysqli_error($dbc);
                          }
                              mysqli_close($dbc);
                      
                              exit();
                  }
                  //Otherwise list errors for assign busID
                  else{
                      echo "There was an error. ";
                      echo mysqli_error($dbc);
                  }
                      mysqli_close($dbc);
          
                      exit();
              }
              //Otherwise list errors for busID query
              else{
                  echo "There was an error. ";
                  echo mysqli_error($dbc);
              }
                  mysqli_close($dbc);

                  exit();
      }
    }
      //List errors for form
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
<title>Locality Recommend</title>
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
    <div>
    <ul class="sideNav">
        <a href="home.php"><li class="nav_select"><p class="nav_txt">Home</p></li></a>
        <a href="spots_piv.php"><li class="nav_select"><p class="nav_txt">Where To Go</p></li></a>
        <a href="recommend.php"><li class="nav_active"><p>Recommend a Spot</p></li></a>
        <a href="my_recommendations.php"><li class="nav_select"><p class="nav_txt">My Recommendations</p></li></a>
        <a href="signout.php"><li class="nav_select"><p class="nav_txt">Sign Out</p></li></a>
      </ul>
    </div>
  </div>
  
  <div class="column middle">
  <div class="recommend_form">
	<h1 class="form_info">Recommend your favorite spot!</h1>
    
    <form action="recommend.php" enctype="multipart/form-data" method="post" style="margin-left:125px; text-align:left; font-size:x-large;">
      
      <label class="form_content_titles">Place's Name</label></br>
      <input class="recommend_form_input" type="text" id="busName" name="busName" placeholder="Your favorite place's name goes here.." value="" required></br>

      <label class="form_content_titles">Address</label></br>
      <input class="recommend_form_input" type="text" id="busStreetAddress" name="busStreetAddress" placeholder="Let people know where it is.." value="" required></br>

      <label class="form_content_titles">City</label></br>
      <input class="recommend_form_input" type="text" id="busCity" name="busCity" value="<?php echo $_SESSION['userCity']?>" READONLY></br>

      <label class="form_content_titles">State</label></br>
      <select class="recommend_form_input" id="busState" name="busState" maxlength="2" required>
        <option placeholder="State located in..">Select State</option>
        <option value="Alabama">AL</option>
        <option value="Alaska">AK</option>
        <option value="Arizona">AZ</option>
        <option value="Arkansas">AR</option>
        <option value="California">CA</option>
        <option value="Colorado">CO</option>
        <option value="Conneticut">CT</option>
        <option value="Delaware">DE</option>
        <option value="Florida">FL</option>
        <option value="Georgia">GA</option>
        <option value="Hawaii">HI</option>
        <option value="Idaho">ID</option>
        <option value="Illinois">IL</option>
        <option value="Idiana">IN</option>
        <option value="Iowa">IA</option>
        <option value="Kansas">KS</option>
        <option value="Kentucky">KY</option>
        <option value="Louisiana">LA</option>
        <option value="Maine">MA</option>
        <option value="Maryland">MD</option>
        <option value="Massachusetts">MA</option>
        <option value="Michigan">MI</option>
        <option value="Minnesota">MN</option>
        <option value="Mississippi">MS</option>
        <option value="Misouri">MO</option>
        <option value="Montana">MT</option>
        <option value="Nebraska">NE</option>
        <option value="Nevada">MV</option>
        <option value="New Hampshire">NH</option>
        <option value="New Jersey">NJ</option>
        <option value="New Mexico">NM</option>
        <option value="New York">NY</option>
        <option value="North Carolina">NC</option>
        <option value="North Dakota">ND</option>
        <option value="Ohio">OH</option>
        <option value="Oklahoma">OK</option>
        <option value="Oregon">OR</option>
        <option value="Pennsylvania">PA</option>
        <option value="Rhode Island">RI</option>
        <option value="South Carolina">SC</option>
        <option value="South Dakota">SD</option>
        <option value="Tennessee">TN</option>
        <option value="Texas">TX</option>
        <option value="Utah">UT</option>
        <option value="Vermont">VT</option>
        <option value="Virginia">VA</option>
        <option value="Washington">WA</option>
        <option value="West Virgina">WV</option>
        <option value="Wisconsin">WI</option>
        <option value="Wyoming">WY</option>
      </select></br>

      <label class="form_content_titles">Zip Code</label></br>
      <input class="recommend_form_input" type="text" id="busZipCode" name="busZipCode" placeholder="Zip Code.. i.e. 12345" maxlength="5" required></br>

      <label class="form_content_titles">Price</label></br>
      <select class="recommend_form_input" id="busPrice" name="busPrice" required>
        <option placeholder="Select price">Select Price</option>
        <option placeholder="Price">FREE!!</option>
        <option placeholder="Price">$</option>
        <option placeholder="Price">$$</option>
        <option placeholder="Price">$$$</option>
        <option placeholder="Price">$$$$</option>
      </select></br>

      <label class="form_content_titles">Type of place</label></br>
      <select class="recommend_form_input" id="busType" name="busType" required>
        <option placeholder="Select type">Select type pf place</option>
        <option placeholder="Restaurant">Restaurant</option>
        <option placeholder="Bar">Bar</option>
        <option placeholder="Cafe">Cafe</option>
        <option placeholder="Brewery">Brewery</option>
        <option placeholder="Park">Park</option>
        <option placeholder="Attraction">Attraction</option>
        <option placeholder="Theater">Theater</option>
        <option placeholder="Sport Venue">Sport Venue</option>
      </select></br>

      <!-- Tags Code -->
      <label class="form_content_titles">Tags</label></br>
        <div class="checkbox_form">
        <input type="checkbox" id="KidFriendly" name="KidFriendly">
        <label class="tags_container">Kid Friendly
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="PetFriendly" name="PetFriendly">
        <label class="tags_container">Pet Friendly
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="DateNight" name="DateNight">
        <label class="tags_container">Date Night
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="VeganFriendly" name="VeganFriendly">
        <label class="tags_container">Vegan Friendly
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="VegFriendly" name="VegFriendly">
        <label class="tags_container">Vegetarian Friendly
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="FamilyFun"name="FamilyFun">
        <label class="tags_container">Family Fun
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="OutdoorsNature" name="OutdoorsNature">
        <label class="tags_container">Outdoors/Nature
          <span class="tags_checkmark"></span>
        </label></br>

        <input type="checkbox" id="LocalGem" name="LocalGem">
        <label class="tags_container">Local Gem
        <span class="tags_checkmark"></span>
        </label></br>
        </div>

      <label class="form_content_titles">Follows COVID Protocols</label></br>
      <select class="recommend_form_input" id="busCovidRules" name="busCovidRules" required>
        <option placeholder="Select type">Are COVID rule in place</option>
        <option placeholder="Yes">Yes</option>
        <option placeholder="No">No</option>
      </select></br>

      <!-- UPLOAD IMAGE CODE -->
      <label class="form_content_titles">Select an Image</label></br>
      <input type="file" class="file_select_btn"  id="imgFilePath" name="imgFilePath"></br>

      <label class="form_content_titles">Review</label></br>
      <textarea class="review_content" name="reviewMessage" placeholder="Tell everyone why you love this place!" maxlength="512" required></textarea></br>
        
      <input class="recommend_form_submit" type="submit" name="submit" value="Submit">
    </form>
		</div>
  </div>
  
  <div class="column side">
	<!--<img class="smlogo" src="LogoSmall_3.0.png">-->
  </div>
</div>
  
</body>
</html>