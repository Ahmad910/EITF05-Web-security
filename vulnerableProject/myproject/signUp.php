<?php

session_start();



//Connection OS X
//$connection = new mysqli("localhost", "root", "root", "loguser");
//$connectionBL = new mysqli("localhost", "root", "root", "blacklist");

//Connection windows
$connection = new mysqli("localhost", "root", "", "loguser");
$connectionBL = new mysqli("localhost", "root", "", "blacklist");


if(isset($_POST['username'])){
    $username = $_POST['username'];
}
if(isset($_POST['password'])){
        $password = $_POST['password'];
        //$password = crypt($password,$hashF_and_salt); //encrypt the password
}
if(isset($_POST['homeAddress'])){
        $homeAddress = $_POST['homeAddress'];
}       
echo "Sign up";
echo "<br>";



if(isset($_POST['subm']) and !($connection->connect_error) and !($connectionBL->connect_error)){
    $userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";
    $queryResult = $connection->query($userQuery);
    $row = mysqli_fetch_array($queryResult);
    $blacklistQuery = "SELECT * FROM blacklist WHERE bl_name = '".$password."'";
    $blResult = $connectionBL->query($blacklistQuery);
    $blRow = mysqli_fetch_array($blResult);
    //Check if username is correct
    if(!($username and $password and $homeAddress)){
        echo ("Please fill in all information.");
    }else if($row){
        echo "Username aldredy exists. ";  
    }else if(strlen($username) > 300) {
        echo "Username is too long, or contains < or > ";
    }else if(strlen($password) < 8){
        echo "Password is too short. ";
    } else if($blRow){ //Remove else if to enable blacklist-passwords.
        echo "Weak password. ";
    } else if((preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) and 
        (preg_match('/\W/', $password))) {
         $password = password_hash($password, PASSWORD_DEFAULT); //hash + salt
         $query = $connection->prepare("INSERT INTO loguser(username, password, homeAddress) VALUES (?,?,?)");
         $query->bind_param("sss", $username, $password, $homeAddress);
         $query->execute();
         $query->close();
         header("Location:signIn.php");
            if(!$result){
                die('Query failed' . mysqli_error());
            }    
    }//Checks if user-info is valid and add user.
      else{
        echo "Passwords must contain:";
        echo "<br>";
        echo "Lowercase letter/s (a-z)";
        echo "<br>";
        echo "Uppercase letter/s (A-Z)";
        echo "<br>";
        echo "Number/s (0-9)";
        echo "<br>";
        echo "Special character/s (~`!@#$%^&*()+=_-{}[]\|:;”’?/,.)";
        echo "<br>";
        echo "< or > tags are not allowed in passwords";
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
    </form>
</body>
</html>