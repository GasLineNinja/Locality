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
   echo '<table>';

   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     echo '
            <tr>
              <td>' . $row['busName'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busStreetAddress'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busCity'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busState'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busZipCode'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busPrice'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busType'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busCovidRules'] . '</td>
            </tr>
            <tr>
              <td>' . $row['busReviewCount'] . '</td>
            </tr>
            <tr>
              <td>' . $row['reviewMessage'] . '</td>
            </tr>
          ';
   }
   echo '</table></br>';

   mysqli_free_result($result);
 }

 //print error if no recommendations have been made
 else{
   echo '<p class="error"> There are no recommendations around you.</p>';
 }

 //close database
 mysqli_close($dbc);

?>