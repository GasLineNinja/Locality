<?php

//connect to database
 require ('mysqli_connect.php');

 //getting user id from the session
 $id = $_SESSION['userID'];

 //querying database for all place information as well as the review for those places
 $query = "SELECT Business.busName, Business.busStreetAddress, Business.busCity, Business.busState, Business.busZipCode, 
 Business.busReviewCount, Business.busPrice, Business.busType, Business.busCovidRules, Review.reviewMessage
 FROM Business LEFT OUTER JOIN Review ON Business.busID = Review.busID";

 //checking query result
 $result = @mysqli_query($dbc, $query);

 //getting number of row reyurned
 $numRows = mysqli_num_rows($result);

 //while there is data populate a table with it
 if ($numRows > 0){ 
   echo '';

   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     echo '
          <div class="pull_content">
            <h1>' . $row['busName'] . '</h1><p>Count: '. $row['busReviewCount'] .'</p>
            
            <p>' . $row['busStreetAddress'] . '</p>
            <p>' . $row['busCity'] . ', ' . $row['busState'] . ' ' . $row['busZipCode'] . '</p>

            <p>Price: ' . $row['busPrice'] . '</p>
            <p>Type: ' . $row['busType'] . '</p>
            <p>Following COVID-19 Guildlines: ' . $row['busCovidRules'] . '</p>
            
            <div class="pulled_reivew">
              <h4>Review:</h4>
              <p>' . $row['reviewMessage'] . '</p>
            </div>
          </div>
          </br>
          ';
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