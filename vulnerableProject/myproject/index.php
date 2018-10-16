<?php
session_start();
echo "Welcome to our webshop!";
echo "<br>";
echo "Please sign in or sign up."; 
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
    </form>

    <!-- Sign in -->
    <form action="signIn.php" method="post">
    	<input type="submit" name="su" value="Sign In">
	</form>    

</body>
</html>