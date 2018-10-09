<?php
session_start();
require 'preventXSS.php'; //comment "require 'preventXSS.php'" to enable XSS attack.

//comment the next 4 rows to enabe CSRF attack.
include'Csrf.php';
$csrf = new Csrf();
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);




if(isset($_SESSION['auth'])){//comment this to enabe CSRF attack.
  if($_SESSION['auth']== false){
  echo 'ERROR: unauthenticated';
  }else{
?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<title>Cashout</title></head>
<body>  

<?php

$total = $_SESSION['ammount'];
$name = $_SESSION['username'];
$cardNumberErr = "";
$cardNumber = "";
if($csrf->check_valid('post')){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["cardNumber"])) {
    $cardNumberErr = "Card number is required";
  } else {
    $cardNumber = $_POST["cardNumber"];
    if (!preg_match("/^[0-9]*$/",$cardNumber)) {
      $cardNumberErr = "Only numbers allowed"; 
    }
  }
}

}//comment this to enabe CSRF attack.
?>
<h2>Performing the payment..</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Card Number: <input type="text" name="cardNumber" value="<?php echo $cardNumber;?>">
  <span class="error">* <?php echo $cardNumberErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Purchase">  
  <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" />
  </form>
<?php
if($csrf->check_valid('post')){//comment this to enabe CSRF attack.
if (isset($_POST['submit'])) {
  if (empty($_POST["cardNumber"])) {
  }
  elseif (!preg_match("/^[0-9]*$/",escape($cardNumber))) { //remove the calling of escape to enable XSS attack.
      
   }else{
   	?>
    <h2>Your receipt:</h2>
    Thank you for your purchase!
    <br>
    -----------------------------------
   <table class="table table-striped">
    <thead>
      <tr> 
        <th>Name</th>
        <th>Price</th>
      </tr>
    </thead>
    <?php 
    foreach($_SESSION['products'] as $key=>$product):
    ?>
    <tr>
      <td><?php print ($product['name'])?></td>
      <td>$<?php print ($product['price'])?></td>
    </tr>
    <?php endforeach; ?>  
    </table>
    -----------------------------------
    <br>
    Total cost:
    <?php echo "$";
    echo $total;
    echo '<br/>';
    echo 'Purchaser: ';
    echo $name;
  }// comment this to enabe CSRF attack.
?>
    
<br><br><br><br>
<form action="webshop.php?action=emptyall" method="post"> 
    <input type="submit" name="backToWs" value = "Continue shoping!">
    <input type="hidden" name="<?= $token_id; ?>" value="<?= $token_value; ?>" /> 
  </form>
    <?php
     }    
}?>
</body>
</html>
<?php
     }    
}else{
     echo 'ERROR: unauthenticated';
}?>