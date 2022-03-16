<?php

function redirect_user ($page = ''){

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

//trimming slashes from end of url
$url = rtrim($url, '/\\');

//adding the page 
$url .= '/' . $page;

//redirecting 
header("Location: $url");
exit();
}

?>