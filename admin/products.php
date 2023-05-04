<?php include_once('side_navbar.html');
include_once('../../pdocon.php');
session_start();

// Delete from database
if(isset($_POST['delete_btn']))
{
  $stmt=$pdo->prepare("delete from supermarket_items where name=?");
  $params=array($_POST['item_Name']);
  $stmt->execute($params);
  $_SESSION['delete_message']="The item is deleted sucssfuly";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
<style>
table, th, td {
  border:1px solid black;
}
</style>

</head>

<body>
<?php

if($_GET['action'] == "show")
{
$stmt=$pdo->prepare("select * from supermarket_items");
$result=$stmt->execute();
echo" <table width=84%'>
<tr>
<th style='width:60px'>Name</th>
<th style='width:60px'>Img</th>
<th style='width:20px'>Price</th>
<th style='width:10px'>Category</th>
<th style='width:80px'>Action</th>
</tr>";
while($row=$stmt->fetch())
{
echo"
 <tr>
 <td>$row[name]</td>
 <td><img src='$row[img_path]'  width='100px' height='80px'</td>
 <td>$row[price]</td>
 <td>$row[category]</td>
 <td> 
 <a class='btn btn-secondary'href='editProduct.php?productName=$row[name]'>Edit </a>
 <a class='btn btn-danger' href='products.php?action=delete'>Delete </a>
 </td>
 </tr>"; 
}
echo "</table>";




}













 if($_GET['action']=="add")
{?>

<div class="container" style="width:800px ;">
<?php if(isset($_SESSION['Add_message'])) {
  echo "<div class='alert alert-success' role='alert' style='text-align:center;'>"
  .$_SESSION['Add_message'].
"</div>";
}?>
 <div class="card justify-content-center">
  <div class="card-header text-center">
    Add Item
  </div>
  <div class="card-body">
 <form action="uploads.php" method="post" enctype="multipart/form-data" >
 <div class="form-group">
  <label>Item Category</label>
  <input type="text" class="form-control" name="category">
 </div>
  <div class="form-group">
  <label>Item Name</label>
  <input type="text" class="form-control" name="item_name">
  </div>
  <div class="form-group">
  <label>Item Price</label>
  <input type="text" class="form-control" name="price">
  </div>
  <div class="form-group">
  <label>Item img</label>
  <input type="file" class="form-control-file" name="img">
  </div>
  <div style="text-align: center;">
  <button type="submit" class="btn btn-primary" name="add">Add</button>
  </div>
 </form>
  </div>
  </div>
  </div>
<?php
}
// this maby not usabel
if($_GET['action']=="edit")
{?><div class="container" style="width:800px ;">
  <div class="card ">
   <div class="card-header text-center">
     Add Item
   </div>
   <div class="card-body">
  <form action="" method="post">
  <div class="form-group">
  <label>Item Name</label>
   <input type="text" class="form-control" name="item_name">
   </div>
   <div>
   <label>New_Item Category</label>
   <input type="text" class="form-control" name="new_category">
  </div>
   <div class="form-group">
   <label>New_Item Name</label>
   <input type="text" class="form-control" name="new_item_name">
   </div>
   <div class="form-group">
   <label>New_Item Price</label>
   <input type="text" class="form-control" name="new_price">
   </div>
   <div class="form-group">
   <label>New_Item img</label>
   <input type="file" class="form-control-file" name="new_img">
   </div>
   <div style="text-align: center;">
   <button type="submit" class="btn btn-primary" name="edit">Edit</button>
   </div>
  </form>
   </div>
   </div>
 </div>
<!-- ----------------------------------------------------------------------- -->
<?php }
if($_GET['action']=="delete")

{?><div class="container" style="width:800px ;">
<?php if(isset($_SESSION['delete_message']))
{ echo "<div class='alert alert-success' role='alert' style='text-align:center;'>"
  .$_SESSION['delete_message'].
"</div>";}?>

  <div class="card ">
   <div class="card-header text-center">
   Delete Item
   </div>
   <div class="card-body">
  <form action="" method="post">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Item Name</label>
    <select class="form-control" name="item_Name" id="exampleFormControlSelect1">
      <?php 
      $stmt=$pdo->prepare("select name from supermarket_items");
      $result=$stmt->execute();
      while($row=$stmt->fetch())
      {
        echo " <option value='$row[0]'>$row[0]</option> ";
      }
      ?>
     
     
    </select>
  </div>
  
   <div style="text-align: center;">
   <button type="submit" class="btn btn-primary" name="delete_btn">Delete</button>
   </div>
  </form>
   </div>
   </div>
 </div><?php }
 ?>
</body></html>