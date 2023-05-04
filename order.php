<?php
include('../pdocon.php');
session_start();

$stmt=$pdo->prepare("update supermarket_items set quantity = quantity - ? where name=?");
foreach($_SESSION['in_cart'] as $key=> $value)
{
  $params=array($value,$key);
  $result=$stmt->execute($params);
}
unset($_SESSION['in_cart']);
echo "Thank you for shopping from our store";