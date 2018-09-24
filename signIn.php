<?php

$username = $_POST['username'];
$password= $_POST['password'];
$connection = mysqli_connect("localhost", "root", "root", "LogIn");  

echo "Sign In";

if(isset($_POST['submit'])){
 
    //If we are connected to the database
     if($connection){
        
         //Gets data from database.
        $userQuery = "SELECT * FROM logUser";
        $userResult = mysqli_query($connection, $userQuery);
       
         while($row = mysqli_fetch_assoc($userResult)){    
            if($row[username] == $username){
                echo "username exists";
                break;
            } else {
                echo "Username does not exists.";
                break;
            }
    
        } 

    } else {  
        die ("Incorecct login or falid connection to database"); 
    } 
    
}
     
    

//Log in information

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>mcLog</title>
</head>
<body>
    
    <!-- Till den metoden vi skickar den till -->
<form action="signIn.php" method="post">
    <input type="text" name ="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <input type="submit" name="submit">

    </form>
</body>
</html>





  