<?php

//connect to database
 require ('mysqli_connect.php');

 //getting user id from the session
 $id = $_SESSION['userID'];

 //querying database for all place information as well as the review for those places
 $query = "SELECT Business.busID, Business.busName, Business.busStreetAddress, Business.busCity, Business.busState, 
 Business.busZipCode, Business.busReviewCount, Business.busPrice, Business.busType, Business.busCovidRules, 
 Review.reviewMessage, Image.imgFilePath 
 FROM Business 
 LEFT JOIN Review ON Business.busID = Review.busID 
 LEFT JOIN Image ON Business.busID = Image.busID ";

 //checking query result
 $result = @mysqli_query($dbc, $query);

 //getting number of row returned
 $numRows = mysqli_num_rows($result);

 //while there is data populate a table with it
 if ($numRows > 0){ 
   echo '';

   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     $busID = $row["busID"];
     $imgPath = $row["imgFilePath"];

     if ($imgPath != NULL){
      echo '
            <div class="pull_content">
              
              <img class="review_image" src="uploads/' . $imgPath . '" alt="img">

              <h1 class="review_busName">' . $row['busName'] . '</h1>
              
              <p class="review_address">' . $row['busStreetAddress'] . '</p>
              <p class="review_address">' . $row['busCity'] . ', <span style="text-transform: uppercase;">' . $row['busState'] . '<span> ' . $row['busZipCode'] . '</p>
              <p class="review_count">Currently <span style="color:black;font-style: bold;">'. $row['busReviewCount'] .'</span> user(s) have recommended this spot!</p>

              <p class="review_des">Price: <span style="color:rgb(61, 206, 32)">' . $row['busPrice'] . '</span></p>
              <p class="review_des">Type: ' . $row['busType'] . '</p>
              <p class="review_des">Following COVID-19 Guildlines: '. $row['busCovidRules'] .'</p>
      
              <h4 class="review_review">Review:</h4>
              <div class="pulled_reivew">
                <p>' . $row['reviewMessage'] . '</p>
              </div>
            </div>
            </br>
            ';
     }
     else{
      echo '
      <div class="pull_content">
        
        <img class="review_image" src="uploads/placeholder.png" alt="placeholder">

        <h1 class="review_busName">' . $row['busName'] . '</h1>
        
        <p class="review_address">' . $row['busStreetAddress'] . '</p>
        <p class="review_address">' . $row['busCity'] . ', <span style="text-transform: uppercase;">' . $row['busState'] . '<span> ' . $row['busZipCode'] . '</p>
        <p class="review_count">Currently <span style="color:black;font-style: bold;">'. $row['busReviewCount'] .'</span> user(s) have recommended this spot!</p>

        <p class="review_des">Price: <span style="color:rgb(61, 206, 32)">' . $row['busPrice'] . '</span></p>
        <p class="review_des">Type: ' . $row['busType'] . '</p>
        <p class="review_des">Following COVID-19 Guildlines: '. $row['busCovidRules'] .'</p>

        <h4 class="review_review">Review:</h4>
        <div class="pulled_reivew">
          <p>' . $row['reviewMessage'] . '</p>
        </div>
      </div>
      </br>
      ';
     }
   }
   echo '';

   mysqli_free_result($result);
 }

 //print error if no recommendations have been made
 else{
   echo '<p class="error"> There are no recommendations around you.</p>';
 }

 //close database
 mysqli_close($dbc);

?>