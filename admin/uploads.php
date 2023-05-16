<?php 
if(isset($_POST['add']))
{
  include_once('../../pdocon.php');
  session_start();

  $img=$_FILES['img'];
  $img_name=$_FILES['img']['name'];
  $img_tmpName=$_FILES['img']['tmp_name'];
  $img_size=$_FILES['img']['size'];
  $img_error=$_FILES['img']['error'];
  $img_type=$_FILES['img']['type'];
  $img_ext=explode('.',$img_name);
$img_Ext=strtolower(end($img_ext));

$allowed_imgExt=array('jpg','jpeg','png','gif');
if(in_array($img_Ext,$allowed_imgExt))
{
  if($img_error===0){
$new_img_Name=uniqid("",true).".".$img_Ext;
$img_location='uploads/'.$new_img_Name;
move_uploaded_file($img_tmpName,$img_location);
$stmt=$pdo->prepare("insert into supermarket_items (category,name,img_path,price) values(?,?,?,?) ");
$params=array($_POST['category'],$_POST['item_name'],$img_location,$_POST['price']);
$stmt->execute($params);
$_SESSION['Add_message']="The img uploaded scssfule";

  }
  else { echo"Ther is error try agen later"; }
  
}
else {
  $_SESSION['Add_message']="Only JPG,JPEG,PNG,GIF is allwod";

}
  
}
header('location:products.php?action=add');





if(isset($_POST['add_category']))
{
  include_once('../../pdocon.php');
  session_start();

  $img=$_FILES['img'];
  $img_name=$_FILES['img']['name'];
  $img_tmpName=$_FILES['img']['tmp_name'];
  $img_size=$_FILES['img']['size'];
  $img_error=$_FILES['img']['error'];
  $img_type=$_FILES['img']['type'];
  $img_ext=explode('.',$img_name);
$img_Ext=strtolower(end($img_ext));

$allowed_imgExt=array('jpg','jpeg','png','gif');
if(in_array($img_Ext,$allowed_imgExt))
{
  if($img_error===0){
$new_img_Name=uniqid("",true).".".$img_Ext;
$img_location='uploads/'.$new_img_Name;
move_uploaded_file($img_tmpName,$img_location);
$stmt=$pdo->prepare("insert into supermarket_category (category,discription,img_path) values(?,?,?) ");
$params=array($_POST['categoryName'],$_POST['catedoryDes'],$img_location,);
$stmt->execute($params);
$_SESSION['Add_message']="The img uploaded scssfule";

  }
  else { echo"Ther is error try agen later"; }
  
}
else {
  $_SESSION['Add_message']="Only JPG,JPEG,PNG,GIF is allwod";

}
  
}
header('location:category.php?action=add');
?>