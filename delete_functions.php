<?php

$id = $_SESSION['userID'];

$query = "DELETE FROM User WHERE userID=$id";

$result = @mysqli_query($dbc, $query);

if ($result){
    redirect_user(index.php);
}
else{
    echo 'Could not delete user.';
}
?>