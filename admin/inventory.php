<?php
include('../../pdocon.php');          
include_once("side_navbar.html");
if(isset($_POST['productName']))
{
$name=$_POST['productName'];
$quantity=$_POST['newQuantity'];

$stmt=$pdo->prepare("update supermarket_items set quantity = quantity + ? where name=?");
$params=array($quantity,$name);
$result=$stmt->execute($params);
}

?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>table, th, td {
    border:1px solid black;
  }</style>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  
  <!-- Shortcut Icon -->
  <link rel="shortcut icon" href="" type="image/x-icon">
  
  
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

</head>
<body>
<table style="width: 80%;">
  <tr>
    <th>Name</th>
    <th>Quantity</th>
    <th>add</th>
    </tr>
    <?php
    $stmt=$pdo->prepare("select name , quantity from supermarket_items");
    $result=$stmt->execute();
    while($row=$stmt->fetch())
    {
      echo"
    
      <tr>
      <td>$row[name]</td>
      <td>$row[quantity]</td>
      <td>
      <form action='' method='post'> <input type='number' name='newQuantity' min='1'>
      <button class='btn btn-secondary' type='submit' name='productName' value='$row[name]'>Edit </button>
      </form></td>
      </tr>";

  }?>
</table>





</body></html>