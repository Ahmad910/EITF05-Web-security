<?php 
session_start();


//------------------------------------------------------------------------------------------------
//Uncomment the next piece of code to allow CSRF attack
//Allow CSRF attack
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['posted'] = true;
    $_SESIION['data'] = $_POST['data'];
}
header("location: http://www.youtube.com");
