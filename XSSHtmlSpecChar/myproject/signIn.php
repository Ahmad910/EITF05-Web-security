<?php
session_start();
require 'preventXSS.php'; // comment "require 'preventXSS.php'" to enable XSS attack.

session_regenerate_id();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['token'])) {
        //If matches, allow user then to post the user to post
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            $_SESSION['posted'] = true;
        } else {
            die('CSRF failed.');
        }
    } else {
        die('Token were not found.');
    }
    
}

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(64));
}
$token = $_SESSION['token'];

//Connection OS X
//$connection = new mysqli("localhost", "root", "root", "loguser");
//$vConnection = mysqli_connect("localhost", "root", "root", "voucher");
//Connection windows
$connection = new mysqli("localhost", "root", "", "loguser");
$vConnection = mysqli_connect("localhost", "root", "", "voucher");
$_SESSION['auth'] = false;
$username ='';
$password = '';
if(isset($_POST['username'])){
        $username = escape($_POST['username']);
}
if(isset($_POST['password'])){
        $password = escape($_POST['password']);  
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
    if($submit and !($connection->connect_error) and $vConnection){
        // Remove to enable sql-injection
       /*
        $voucher = $_POST['vh'];
        $voucherQuery = "SELECT * FROM voucher WHERE v = '".$voucher."'";
        $vResult = mysqli_query($vConnection, $voucherQuery);
        $vRow = mysqli_num_rows($vResult);
        */
        
        //Prevents sql-injection
        $voucher = $_POST['vh'];
        $voucherQuery = "SELECT * FROM voucher WHERE v = '".$voucher."'";
        $vResult = $vConnection->query($voucherQuery);
        $vRow = mysqli_fetch_array($vResult);


        

        $userQuery = "SELECT * FROM loguser WHERE username = '".$username."'";
        $queryResult = $connection->query($userQuery);
        $row = mysqli_fetch_array($queryResult);



        if($vRow > 0){
        	$_SESSION['auth'] = true; 
            header("Location:webShop.php?action=emptyall");
            
            
        }else if($row and password_verify($password, $row['password'])){
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
    <input type="text" name="vh" placeholder="Voucher"> 
    <input type="submit" name="sub" value = "Sign in">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    </form>

    
</body>
</html>
