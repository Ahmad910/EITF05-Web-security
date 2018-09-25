<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

$cardNumberErr = "";
$cardNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["cardNumber"])) {
    $cardNumberErr = "Card number is required";
  } else {
    $cardNumber = test_input($_POST["cardNumber"]);
    if (!preg_match("/^[0-9]*$/",$cardNumber)) {
      $cardNumberErr = "Only numbers allowed"; 
    }
  }
}
function test_input($data) {
  $data = trim($data);
  return $data;
}
?>

<h2>Performing the payment..</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Card Number: <input type="text" name="cardNumber" value="<?php echo $cardNumber;?>">
  <span class="error">* <?php echo $cardNumberErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
<?php
$total = 0;
session_start();
echo "<h2>Your receipt:</h2>";
if (!preg_match("/^[0-9]*$/",$cardNumber)) {
       echo "Only numbers allowed";
}else{
     echo $cardNumber;     
}
?>
</body>
</html>