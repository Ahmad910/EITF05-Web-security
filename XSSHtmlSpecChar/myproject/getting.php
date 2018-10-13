<?php 
session_start();



//Comment the next piece of code to allow CSRF attack
//prevent CSRF
// We will simply here verify the session token in the session and the token passed through the form
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['token'])) {
        //If matches, allow user then to post the user to post
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            $_SESSION['posted'] = true;
            $_SESSION['field'] = $_POST['email'];
           
        } else {
            die('CSRF VALIDATION FAILED');
        }
    }
    else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
    
}

header("location: http://www.youtube.com");

//------------------------------------------------------------------------------------------------
