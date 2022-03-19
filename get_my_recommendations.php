<?php

//connect to database
 require ('mysqli_connect.php');

 $id = $_SESSION['userID'];

 $query = "SELECT Business.busName, Review.reviewMessage
 FROM Business INNER JOIN Review ON Business.busID = Review.busID WHERE Review.userID = '$id'";

 $result = @mysqli_query($dbc, $query);

 $numRows = mysqli_num_rows($result);

 if ($numRows > 0){
   echo '<table>';

   while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
     echo ' <tr>
              <td>' . $row['busName'] . '</td>
            </tr>
            <tr>
              <td>' . $row['reviewMessage'] . '</td>
            </tr>';
   }
   echo '</table></br>';

   mysqli_free_result($result);
 }
 else{
   echo '<p class="error"> You have not recommended any places yet.</p>';
 }

 mysqli_close($dbc);

?>