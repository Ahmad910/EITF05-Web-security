<?php
echo "Welcome to our webshop! Please sign in or sign up.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>mcLog</title>
</head>
<body>
    
    <!-- Sign up -->
<form action="signUp.php" method="post">
    <input type="submit" name="su" value="Sign Up">
    </form>

    <!-- Sign in -->
    <form action="signIn.php" method="post">
    <input type="submit" name="su" value="Sign In">
</form>    

</body>
</html>