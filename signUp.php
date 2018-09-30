<?php
if(isset($_POST['username'])){
    $username = $_POST['username'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
if(isset($_POST['homeAddress'])){
    $homeAddress = $_POST['homeAddress'];
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
        } else if(strlen($username) > 10){
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

    </form>
</body>
</html>