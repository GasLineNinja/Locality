<?php

//connect to database
 require ('mysqli_connect.php');

 $id = $_SESSION['userID'];

 $query = "SELECT Business.busName, Business.busStreetAddress, Business.busCity, Business.busState, Business.busZipCode, 
 Business.busReviewCount, Business.busPrice, Business.busType, Business.busCovidRules, Review.reviewMessage
 FROM Business LEFT OUTER JOIN Review ON Business.busID = Review.busID";

 $result = @mysqli_query($dbc, $query);

 $numRows = mysqli_num_rows($result);

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
 else{
   echo '<p class="error"> You have not recommended any places yet.</p>';
 }

 mysqli_close($dbc);

?>