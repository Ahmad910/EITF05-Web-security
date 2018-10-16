<?php
session_start();
if(isset($_SESSION['auth'])){
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["cardNumber"])) {
    $cardNumberErr = "Card number is required";
  }else {
    $cardNumber = $_POST["cardNumber"];
    if (!preg_match("/^[0-9]*$/",$cardNumber)) {
      $cardNumberErr = "Only numbers allowed"; 
    }
  }
}
?>
<h2>Performing the payment..</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Card Number: <input type="text" name="cardNumber" value="<?php echo $cardNumber;?>">
  <span class="error">* <?php echo $cardNumberErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Purchase">  
  </form>
<?php
if (isset($_POST['submit'])) {
  if (empty($_POST["cardNumber"])) {
  }
  elseif (!preg_match("/^[0-9]*$/", $cardNumber)) { 
      
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
?>
    
<br><br><br><br>
<form action="webshop.php?action=emptyall" method="post"> 
    <input type="submit" name="backToWs" value = "Continue shoping!">
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