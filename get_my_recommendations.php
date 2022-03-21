<?php

//connect to database
 require ('mysqli_connect.php');

 //get user id from open session
 $id = $_SESSION['userID'];

 //query databse for businesses logged in user has recommended and their reviews
 $query = "SELECT Business.busName, Review.reviewMessage
 FROM Business INNER JOIN Review ON Business.busID = Review.busID WHERE Review.userID = '$id'";

 //checking query result
 $result = @mysqli_query($dbc, $query);
 
 //getting count of rows returned from query
 $numRows = mysqli_num_rows($result);

 //while there is data being pulled populate a table with that data
 if ($numRows > 0){
   echo '';

   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     echo '
        <div class="pull_content">

          <img class="review_image" src="uploads/placeholder.png" alt="placeholder">

          <h1 class="review_busName">' . $row['busName'] . '</h1>

          <h4 class="review_review">Review:</h4>
          <div class="pulled_reivew">
            <p>' . $row['reviewMessage'] . '</p>
          </div>
        </div>
        </br>
     ';
   }
   echo '';

   mysqli_free_result($result);
 }

 //If no recommendations yet print error
 else{
   echo '<p class="error"> You have not recommended any places yet.</p>';
 }

 //close database
 mysqli_close($dbc);

?>