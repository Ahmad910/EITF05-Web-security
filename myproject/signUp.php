<?php

session_start();
require 'preventXSS.php'; //please comment "require 'preventXSS.php'" to enable XSS attack.
//please comment the next 4 rows to enabe CSRF attack.
include'Csrf.php';
$csrf = new Csrf();
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);


if(isset($_POST['username'])){
    if($csrf->check_valid('post')){//please comment this to enabe CSRF attack.
        $username = escape($_POST['username']); //remove the calling of escape to enable XSS attack.
        var_dump($_POST[$token_id]);
    }//please comment this to enabe CSRF attack.
}
if(isset($_POST['password'])){
    if($csrf->check_valid('post')){//please comment this to enabe CSRF attack.
        $password = $_POST['password'];
        var_dump($_POST[$token_id]);
    }//please comment this to enabe CSRF attack.
}
if(isset($_POST['homeAddress'])){
    if($csrf->check_valid('post')){//please comment this to enabe CSRF attack.
        $homeAddress = escape($_POST['homeAddress']); //remove the calling of escape to enable XSS attack.
        var_dump($_POST[$token_id]);
    }//please comment this to enabe CSRF attack.
}
$connection = mysqli_connect("localhost", "root", "", "loguser");
echo "Sign up";
echo "<br>";
    if(isset($_POST['subm']) and $connection){
        $userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";
        $userResult = mysqli_query($connection, $userQuery);
        $row = mysqli_fetch_array($userResult);    
      
        //Check if username is correct
        if(!($username and $password and $homeAddress)){
            echo ("Please fill in all information.");
        } else if($row){
                echo "Username aldredy exists. ";  
        } else if(strlen($username) > 300){
                echo "Username is too long. ";
        } else if(strlen($password) < 8){
                echo "Password is too short. ";
        }    
            //Checks if user-info is valid and add user.
        else{
            $query = "INSERT INTO loguser(homeAddress,username,password)";
            $query .= "VALUES ('$homeAddress','$username', '$password')";
            $result = mysqli_query($connection, $query);
            header("Location:signIn.php");
            if(!$result){
                die('Query failed' . mysqli_error());
            }    
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
</head>
<body>
    
    <!-- Till den metoden vi skickar den till -->
<form action="signUp.php" method="post">
    <input type="text" name ="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <input type="text" name="homeAddress" placeholder="Enter street name">
    <input type="submit" name="subm" value = "Create user and proceed to log in.">
    <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
    </form>
</body>
</html>