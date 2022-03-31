<?php

//Get session
session_start();

//Connect to database
require ('mysqli_connect.php');
require ('redirect_function.php');

//Get current user id
$id = $_SESSION['userID'];

//query to delete user account
$query = "DELETE FROM User WHERE userID='$id'";

//checking query result
$result = @mysqli_query($dbc, $query);

//If query is good, kill session and redirect to index page
if ($result){
    
    session_destroy();

    redirect_user('index.php');
}
else{
    echo 'Could not delete user.';
}
?>