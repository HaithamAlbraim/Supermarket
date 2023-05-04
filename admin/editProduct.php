<?php include_once("../../pdocon.php");
if(isset($_POST['edit']))
{
  $name=$_POST['newName'];
  $id=$_POST['id'];
  

  $cat=$_POST['cat'];
  $price=$_POST['price'];
  $img=$_POST['currentImg'];
  
print_r($_FILES);
if(!empty($_FILES['new_img']['name']))
{
 
 $imgName=$_FILES['new_img']['name'];
 $img_tempName=$_FILES['new_img']['tmp_name'];
 $imgType=$_FILES['new_img']['type'];
 $imgError=$_FILES['new_img']['error'];
 $img_ext=explode(".",$imgName);
 $img_Ext=strtolower(end($img_ext));
 $allowd_ext=array('jpg','jpeg','png','gif');
 if(in_array($img_Ext,$allowd_ext))
 {
if($imgError===0)
{
$newImgName=uniqid("",true).".".$img_Ext;
$location="uploads/".$newImgName;
move_uploaded_file($img_tempName,$location);
$img=$location;

unlink($_POST['currentImg']);


}
 }


}
$stmt=$pdo->prepare("update supermarket_items set category=? , name=? , price=? , img_path=? where id=?");
$params=array($cat,$name,$price,$img,$id);
$result=$stmt->execute($params);

header("location:editProduct.php?productName=$name");

}?>






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
  <?php include_once('side_navbar.html')?>
  <div class="container">


<?php 
if(isset($_GET['productName']))
{
 
  $productName=$_GET['productName'];
  $stmt=$pdo->prepare("select * from supermarket_items where name=?");
  $params=array($productName);
  $result=$stmt->execute($params);
  $row=$stmt->fetch();
  echo"
 <form method='post' action=''  enctype='multipart/form-data'>
 <table style='width:92%'>
 <tr>
 <th style='height:60px'>Name</th>
 <td><input type='text' name='newName' class='form-control' value='$row[name]'></td>
 </tr>
 <tr>
 <th style='height:60px'>Category</th>
 <td><input type='text' name='cat' class='form-control' value='$row[category]'></td>
 </tr>
 <tr>
 <th style='height:60px'>Price</th>
 <td><input type='text' name='price' class='form-control' value='$row[price]'></td>
 </tr>
 <tr>
 <th>Current Img</th>
 <td> <img src='$row[img_path]' width=140px height=120px></td>
 </tr>
  <tr>
 <th style='height:60px'>New Img</th>
 <td> <input type='file' name='new_img'></td>
 </tr>

 </table>
 <br>
 <br> 
 <div class=' row justify-content-center'>

 <button type='submit' class='btn btn-primary' name='edit' value='$productName'>Edit</button>
 </div>
 <input type='hidden' name='currentImg' value='$row[img_path]'>
 <input type='hidden' name='id' value='$row[id]'>
 </form>";
}?>
</div>
</body>
</html>