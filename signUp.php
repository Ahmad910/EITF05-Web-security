<?php

$username = $_POST['username'];
$password= $_POST['password'];
$homeAddress = $_POST['homeAddress'];
$connection = mysqli_connect("localhost", "root", "root", "LogIn");  

echo "Sign up";

    if(isset($_POST['submit']) and $connection){
      
       //Check if username is correct
        if($username and $password and $homeAddress and strlen($username) < 10){
            echo "Corecct login";
        } else {  
          die ("Incorecct login or falid connection to database"); 
        }   
    }

$query = "INSERT INTO logUser(homeAddress,username,password)";
$query .= "VALUES ('$homeAddress','$username', '$password')";
$result = mysqli_query($connection, $query);

    if(!$result){
     die('Query failed' . mysqli_error());
    
    } else {
     //Hämtar ut data från databas.
        
        $userQuery = "SELECT * FROM logUser";
        $userResult = mysqli_query($connection, $userQuery);
       // while($row = mysqli_fetch_assoc($userResult)){    
         //   print_r($row[username]);
        //}
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>mcLog</title>
</head>
<body>
    
    <!-- Till den metoden vi skickar den till -->
<form action="signUp.php" method="post">
    <input type="text" name ="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <input type="text" name="homeAddress" placeholder="Enter street name">
    <input type="submit" name="submit">

    </form>
</body>
</html>