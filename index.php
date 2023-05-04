<?php include_once("../pdocon.php");
include_once("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  
  <meta charset="utf-8">
  <meta name="viewport" content="width = device-width, initial-scale = 1, shrink-to-fit = no">

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
/* .carousel-indicators li {width:12px;height:12px; border-radius: 100%;  opacity: 1; margin-top: 4px;} */
/* .carousel-indicators li.active {width:20px;height:20px;} */
</style>
  </head>
  
  <?php 
  $stmt=$pdo->prepare("select * from supermarket_category");
  $result=$stmt->execute();
  ?>


  <body>
<div class="container-fluid m-0 p-0">
  
  
  
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  
 
  <div class="carousel-inner">
    
    <?php $active="active"; while($row=$stmt->fetch())
    {echo"
    <div class='carousel-item $active'>
    <img src='admin/$row[2]' class='d-block w-100' height='610px' alt='...'>
    <div class='carousel-caption  d-md-block'>
      <h5>$row[0]</h5>
      <p>$row[1].</p>
      <div>
      <a href='supermarket_items.php?cat=$row[0]' class='btn btn-primary'>Start Shopping</a>
      </div>

    </div>
  </div>
    ";$active="";}?>
    
    <br>

    <ol class="carousel-indicators">
  
  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
   
    <?php for($i=1;$i<$stmt->rowCount();$i++){
    echo"<li data-target='#carouselExampleCaptions' data-slide-to='$i'></li>";}?>
 
  </ol>
  </div>
  <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </button>
</div>







   

</div>


  
</body>

  
</html>