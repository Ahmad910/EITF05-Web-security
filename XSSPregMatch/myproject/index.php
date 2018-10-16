<?php
session_start();
echo "Welcome to our webshop!";
echo "<br>";
echo "Please sign in or sign up."; 


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

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Webshop</title>
</head>
<body>
    <!-- Sign up -->
    <form action="signUp.php" method="post">
    	<input type="submit" name="su" value="Sign Up">
    	<!-- send this token to getting.php via a hidden input field --> 
    	<input type="hidden" name="token" value="<?php echo $token; ?>" />  
    </form>

    <!-- Sign in -->
    <form action="signIn.php" method="post">
    	<input type="submit" name="su" value="Sign In">
    	<input type="hidden" name="token" value="<?php echo $token; ?>" />
	</form>    

</body>
</html>