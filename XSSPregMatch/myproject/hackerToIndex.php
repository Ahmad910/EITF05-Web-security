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
    <form action="getting.php" method="post">
        <input type="submit" name="su" value="Sign Up">
    </form>
    <!-- Sign in -->
    <form action="getting.php" method="post">
        <input type="submit" name="su" value="Sign In">
    </form>    

</body>
</html>