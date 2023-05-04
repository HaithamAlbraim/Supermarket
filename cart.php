<?php 
include_once('class.php');
include('../pdocon.php');
include_once('navbar.php');

if(empty($_SESSION['in_cart']))
{
$_SESSION['in_cart']=array();
}
// cancel all orderd
if(isset($_GET['cancel']))
{unset($_SESSION['in_cart']);
  $_SESSION['in_cart']=array();
echo "The cart is empty";exit;}
//  cancel all orderd
//update quantity
if(isset($_GET['refresh_btn']))
{
  $r=$_GET['product_name'];
 $_SESSION['in_cart'][$r]=$_GET['newQuantity'];
}
// delete item
if(isset($_GET['deleteItem_btn']))
{
  $r=$_GET['product_name'];

 unset($_SESSION['in_cart'][$r]);
 
}



if(isset($_GET['product']))
{
  $product_name=$_GET['product'];
  if(!array_key_exists($product_name,$_SESSION['in_cart']))
  {
    $_SESSION['in_cart'][$product_name]=1;
  }
  else{
    $_SESSION['in_cart'][$product_name]++;
  }
  print_r($_SESSION['in_cart']);
  $a=$_SERVER['HTTP_REFERER'];

header("location:$a");
exit;

}









 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
table, th, td {
  border:1px solid black;
}
</style>
</head>
<body>
  <br>
  <br>

  <div class="container">
<table style="width:100% ;">
  <tr>
    <th>Item img</th>
    <th>Item name</th>
    <th>Item price</th>
    <th>quantity</th>
    <th>Total price</th>
  </tr>
  <?php
  $i=0;
  $total=0;
  foreach($_SESSION['in_cart'] as $key=> $value)
  {
    $product="product".$i;
    $product=new product0($key,$value);


  $stmt=$pdo->prepare("select * from supermarket_items  where name=?");
  $params=array($product->get_name());
  $result=$stmt->execute($params);
 $row=$stmt->fetch();
  $quantity= $product->get_quantity();

  $subtotal=$product->subtotal($quantity,$row['price']);
  $total+=$subtotal;
    echo "<tr> 
    <td> <img src='admin/$row[img_path]' width='160px' height=100px'></td>
    <td>$row[name]</td>
    <td>$row[price].JD</td>
 <td><form action='' method='get'>
 <input type='number' min='1' max='$row[quantity]' name='newQuantity' style='width:60px' value=$quantity>
 <input type='hidden' name='product_name' value='$key'>
 <button type='submit' name='refresh_btn'>R</button>
 <button type='submit' name='deleteItem_btn'>D</button>
 </form></td>
 <td>$subtotal.JD</td>
    

</tr>";
  $i++;
  
}

echo "<tr> <td> $total</td></tr>";
  ?>
</table>
<form action="" method="get">
  <button type="submit" name="cancel">cancel </button>
</form>
<?php
if(isset($_SESSION['username']))
{
  echo"
<form action='order.php' method='post'>
<button type='submit' class='btn btn-primary' name='order'>Order </button>
</form>
";}?>
  </div>
   
</body>
</html>