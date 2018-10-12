<?php
error_reporting(0);
session_start();
if($_SESSION['auth']== false){
  echo 'ERROR: unauthenticated';
}else{
    $_SESSION['ammount'] = 0;
    $cart = array();  
    //Connection OS X
    //$conn = new PDO("mysql:host=localhost;dbname=create-products", 'root', 'root');
    //Connection Windows
    $conn = new PDO("mysql:host=localhost;dbname=create-products", 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $action = isset($_GET['action'])?$_GET['action']:"";
    if($action=='addcart' && $_SERVER['REQUEST_METHOD']=='POST') {
	     //Finding the product by code
	     $query = "SELECT * FROM products WHERE sku=:sku";
	     $stmt = $conn->prepare($query);
	     $stmt->bindParam('sku', $_POST['sku']);
	     $stmt->execute();
	     $product = $stmt->fetch();
	     $_SESSION['products'][$_POST['sku']] =array('name'=>$product['name'],'image'=>$product['image'],'price'=>$product['price']);
	     $product='';
	     header("Location:webshop.php");
    }
    if($action=='emptyall') {
	     $_SESSION['products'] =array();
       $_SESSION['ammount']= 0;
	     header("Location:webshop.php");	
    }
    if($action=='empty') {
	   $sku = $_GET['sku'];
	   $products = $_SESSION['products'];
      $_SESSION['ammount'] = $_SESSION['ammount'] - $product['price'];
	   unset($products[$sku]);
	   $_SESSION['products']= $products;
	   header("Location:webshop.php");	
    }
    if($action=='pay') {
      header("Location:payment.php");
    } 
    if($action == 'logout'){
      $_SESSION['auth'] = false;
      header("Location:index.php");
    }
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Webshop</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>	
<body>
	
<div class="container" style="width:600px;">
  <?php if(!empty($_SESSION['products'])):?>
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid pull-left" style="width:300px;">
      <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Webshop</a> </div>
    </div>
    <div class="pull-right" style="margin-top:7px;margin-right:7px;"><a href="getting.php?action=emptyall" class="btn btn-info">Empty cart</a></div>
  </nav>

  <table class="table table-striped">

    <thead>
      <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
    </thead>
    <?php foreach($_SESSION['products'] as $key=>$product):?>
    <tr>
      <td><img src="<?php print $product['image']?>" width="50"></td>
      <td><?php print $product['name']?></td>
      <td>$<?php print $product['price']?></td>
      <td><a href="getting.php?action=empty&sku=<?php print $key?>" class="btn btn-info">Delete</a>     	
      </td>
    </tr>
    <?php
    	 $_SESSION['ammount'] =  $_SESSION['ammount']+$product['price'];?>

    <?php endforeach;?>
    <tr><td colspan="5" align="right"><h4>Total:$<?php print  $_SESSION['ammount']?></h4></td></tr>
  </table>
  <?php endif;?>
  
  <nav class="navbar navbar-inverse" style="background:#04B745;">
    <div class="container-fluid">
         <div class="navbar-header"> <a class="navbar-brand" href="#" style="color:#FFFFFF;">Products</a>
       </div>
    </div>
  </nav>
  <div class="row">
    <div class="container" style="width:600px;">
      <?php foreach($products as $product):?>
      <div class="col-md-4">
        <div class="thumbnail"> <img src="<?php print $product['image']?>" alt="Lights">
          <div class="caption">
            <p style="text-align:center;"><?php print $product['name']?></p>
            <p style="text-align:center;color:#04B745;"><b>$<?php print $product['price']?></b></p>
            <form method="post" action="getting.php?action=addcart">
              <p style="text-align:center;color:#04B745;">
                <button type="submit" class=""btn btn-default"">Add To Cart</button>
                <input type="hidden" name="sku" value="<?php print $product['sku']?>">
              </p>
            </form>
          </div>
        </div>
      </div>
     <?php endforeach;?>
    </div>
  </div>

</div>
<div class="row">
    	<div class="container" style="width:100px;">
    		<form method="post" action="getting.php?action=pay">
		<button type="submit" class="btn btn-warning">Pay</button>
    
</div>
</form>
  <br>
<div class="row">
      <div class="container" style="width:120px;">
        <form method="post" action="getting.php?action=logout">
    <button type="submit1" class="btn btn-warning">Log out</button>
    <br>
    <label for="user">User: <?php echo $_SESSION['username']?></label>
</div>
</div>
</div>
</body>
</html>
<?php }
?>