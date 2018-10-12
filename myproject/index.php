<?php
session_start();
echo "Welcome to our webshop!";
echo "<br>";
echo "Please sign in or sign up."; 


if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
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