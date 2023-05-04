<?php include_once('../pdocon.php');
include('navbar.php');
$nameError = $passError = "";
if (isset($_POST['login_btn'])) {
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return ($data);
  }

  if (empty($_POST['username'])) {
    $nameError = "User Name is required";
  } else {
    $username = test_input($_POST['username']);
  }
  if (empty($_POST['password'])) {
    $passError = "password is required";
  } else {
    $password = test_input($_POST['password']);
  }


  if (isset($username) && isset($password)) {
    $stmt = $pdo->prepare("select username , password from supermarket_user where username=? ");
    $params = array($username);
    $reselt = $stmt->execute($params);
    $row = $stmt->fetch();
    if ($row = $stmt->rowCount() == 1 && password_verify($password, $row['password'])) {
      $_SESSION['username'] = $username;
      $role = $row['role'];
    } else {
      echo "the username or password is wrong";
    }
  }


  if (isset($_SESSION['username'])) {
    $a = $_POST['redirect'];

    header("location:$a");
  }
}

?>



<!DOCTYPE html>
<html>

<head>
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
  <!-- <script src="jquery-3.6.0.min.js"></script> -->
  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

  <style>
    .error {
      color: #FF0000;
    }
  </style>
  <link rel="stylesheet" href="sign_up.css">
</head>





<body>
  <section class="vh-100 ">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-4">
                <h2 class="text-uppercase text-center mb-5">Login</h2>

                <form method="post" action="">

                  <div class="form-outline mb-4">
                    <label class="form-label" for="name">User name</label>
                    <input type="text" id="name" name="username" class="form-control form-control" />
                    <span class="error"><?php echo $nameError; ?></span>
                  </div>



                  <div class="form-outline mb-4">
                    <label class="form-label" for="pass1">Password</label>
                    <input type="password" id="pass1" name="password" class="form-control form-control" />
                    <span class="error"><?php echo $passError; ?></span>
                    
                  </div>



                  <div class="d-flex justify-content-center">
                    <button type="submit" name="login_btn"  class="btn btn-success btn-block btn-lg gradient-custom-4  text-body">Login</button>
                  </div>

                  <p class="text-center text-muted mt-4 mb-0"> Dont have an account sign up now? <a href="sign_up.php" class="fw-bold text-body"><u>Sing up here</u></a></p>
                  <input type="hidden" name="redirect" value=" <?php echo $_SERVER['HTTP_REFERER']; ?>">
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>