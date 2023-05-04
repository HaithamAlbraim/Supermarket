<?php include_once('../pdocon.php');
include_once('navbar.php');

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

</head>
<body>

  <div class="container-fluid">
    <div class="row">
      <?php 
      $params=array($_GET['cat']);
      $stmt=$pdo->prepare("select * from supermarket_items where category=?");
 
      $result=$stmt->execute($params);
      while($row=$stmt->fetch()){
        if($row['quantity'] < 1 )
        {continue;}
        echo"
      <div style='display:inline-block';>
      <div class='card m-2' style='width:430px' >
      <img src='admin/$row[img_path]' class='card-img-top' alt='...' height=300px;>
      <div class='card-body justify-content-center' style= 'text-align:center';>
        <h5 class='card-title'>$row[name]</h5>
        <p class='card-text'>Price:$row[price].</p>
<a href='cart.php?product=$row[name]' class='btn btn-primary'>Add to cart</a>  
      
        
      </div>
    </div></div>";}?>

    </div>
  </div>
  
</body>
</html>