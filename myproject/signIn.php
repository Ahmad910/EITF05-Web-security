<?php
require 'preventXSS.php'; //please comment "require 'preventXSS.php'" to enable XSS attack.
session_start();

$_SESSION['auth'] = false;
$username ='';
if(isset($_POST['username'])){
    $username = escape($_POST['username']); //remove the calling of escape to enable XSS attack.

}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}

$submit = isset($_POST['sub']);
$connection = mysqli_connect("localhost", "root", "", "loguser");

echo "Sign In";
echo "<br>";
$_SESSION['username'] = $username;
$userQuery = "SELECT counter FROM loguser WHERE username = '".$username."'";
$row = mysqli_fetch_array(mysqli_query($connection, $userQuery));
$counter = intval($row['counter']);

 if( $counter < 5){
   
    if($submit and $connection){
        $userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";
        $userResult = mysqli_query($connection, $userQuery);
        $row = mysqli_fetch_array($userResult);    
        
        //User exist
        if($row and $row['password'] == $password){
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
<form action="signIn.php" method="post">
    <input type="text" name ="username" placeholder="Enter username">
    <input type="password" name="password" placeholder="Enter password">
    <input type="submit" name="sub" value = "Sign in">
    </form>
</body>
</html>





  