<?php
session_start();
include('../../pdocon.php');
if(isset($_POST['login_btn']) && isset($_POST['username'])&&isset($_POST['password']))
{
  $username=$_POST['username'];
  
  $password=$_POST['password'];
  
  $stmt=$pdo->prepare("select username , password , role from supermarket_user where username=? ");
  $params=array($username);
  $result=$stmt->execute($params);
  $row=$stmt->fetch();
  
 if($roww=$stmt->rowCount() == 1 && password_verify($password,$row['password']) )
 {
  $role=$row['role'];
 if(isset($role)){
  $_SESSION['username']=$row['username'];}
  else {echo "this is not a admin accont";}
 }
 
 else{echo"the username or password is wrong";}
 

 
 if(isset($_SESSION['username']))

 {header('location:index.php');exit;}
  
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

</head>

<body>
<div class="container">
    <div class="row justify-content-center">
 
      <div class="card mt-4  justify-content-center" style="width: 600px; ">
  <div class="card-header " style="text-align:center ;">
    <h1>Israa supermarket</h1>
  </div>
  <div class="card-body ">
  <form action="" method="post" >
  username
<input type="text" class="form-control" name="username" id="username" required="required" >
password
<input type="password" class="form-control" name="password" id="password" required="required">
<br>
<div class="row justify-content-center">
<input type="submit" class="btn btn-primary" name="login_btn" value="login">

</div>

</form>
    
  </div>
</div>

      
    </div>
  </div>
  
</body>
</html>