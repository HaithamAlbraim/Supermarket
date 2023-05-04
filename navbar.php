<?php include_once('../pdocon.php');
include_once('class.php');
session_start();


// if(!isset($_SESSION['product_name'])){
//  $_SESSION['product_name']=array();
// }
?>
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
  
</style>
</head>
<body >
  <div class="container-fluid m-0 p-0">
   

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
<a class="navbar-brand" href="index.php">
    <img src="img/384999.png" width="30" height="30" class="d-inline-block align-top" alt="">
 Shop
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav" >
    <ul class="navbar-nav">
    <?php 
     
     $stmt=$pdo->prepare("select category from supermarket_category");

     $result=$stmt->execute();
     while($row=$stmt->fetch()){
      echo"
      <li class='nav-item'>
        <a class='nav-link' href='supermarket_items.php?cat=$row[0]'>$row[0]</a> </li>";}?>
      
    
      
    </ul>
  </div>
  <a href="cart.php"> <img src="img/4379876.png" height="40px" width="40px" alt="cart"></a>
 
 <?php 
if(isset($_SESSION['in_cart']))
{
  echo count($_SESSION['in_cart'])."  ";
  
}
else{echo "0";}
 if(isset($_SESSION['add_to_cart_message']))
 {}
 if(!isset($_SESSION['username']))
 {echo"
  <a href='login.php?action=login' class='btn  m-2' style='color:#cde2f7 ;'>Login</a>
  <a href='sign_up.php?action=sign_up' class='btn btn-dark'>Sign up</a>";}
  else{
    echo"<span style='color:aliceblue;margin-left:20px';>$_SESSION[username]</span><a href='logout.php' class='btn  m-2' style='color:#cde2f7 ;'>Sign out</a>";}?>
</nav>


  </div>
    

  
</body>
</html>
