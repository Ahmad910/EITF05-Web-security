<?php


session_start();
require 'preventXSS.php'; // comment "require 'preventXSS.php'" to enable XSS attack.

//Connection windows
$connection = new mysqli("localhost", "root", "", "loguser");


$_SESSION['auth'] = false;
$username ='';

if(isset($_POST['username'])){
        $username = $_POST['username'];
        $username = escape($username);//remove the calling of htmlspecialchars to enable XSS attack.
}
if(isset($_POST['password'])){
        $password = $_POST['password'];
        //Kanske ska vi ta med detta...
        //$password = htmlspecialchars($password);//remove the calling of htmlspecialchars to enable XSS attack.   
}

$submit = isset($_POST['sub']);

echo "Sign In";
echo "<br>";
$_SESSION['username'] = $username;
$userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";    
$queryResult = $connection->query($userQuery);
$row = mysqli_fetch_array($queryResult);
$counter = intval($row['counter']);

 if($counter < 5){
   
    if($submit and !($connection->connect_error)){
        
        $userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";
        $queryResult = $connection->query($userQuery);
        $row = mysqli_fetch_array($queryResult);

        //User exist
        if($row and password_verify($password, $row['password'])){
            $_SESSION['auth'] = true; 
           
                header("Location:webShop.php?action=emptyall");
          
        
        }else{
            echo "Incorrect username or password";
            $counter = $counter + 1;
            $sql = "UPDATE loguser SET counter ='".$counter."' WHERE username ='".$username."'";
            mysqli_query($connection, $sql);
        }
    }
}else{
     exit("Brute Force Lockdown. Contact webmaster!");
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign In</title></head>
<body>
    
    <!-- Till den metoden vi skickar den till -->
<form action="getting.php" method="post">
    <input type="text" name ="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <input type="submit" name="sub" value = "Sign in">
    </form>

    
</body>
</html>





  