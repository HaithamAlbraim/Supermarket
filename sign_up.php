<?php include_once("../pdocon.php");
include('navbar.php'); ?>
<?php
$usernameErr = $pass1Err = $pass2Err = "";
if (isset($_POST['create_accont_btn'])) {

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (empty($_POST['userName'])) {
    $usernameErr = "User name is requierd";
  } else {
    $username = test_input($_POST['userName']);
  }
  if (empty($_POST['password1'])) {
    $pass1Err = "Password is requierd";
  } else {
    $password1 = test_input($_POST['password1']);
  }
  if (empty($_POST['password2'])) {
    $pass2Err = "Password repet is requierd";
  } else {
    $password2 = test_input($_POST['password2']);
  }
  if (isset($username) && isset($password1) && isset($password2)) {

    $stmt = $pdo->prepare("select username from supermarket_user where username =?");
    $params = array($username);


    $result = $stmt->execute($params);
    if ($stmt->execute() == true) {


      if ($stmt->rowCount() > 0) {
        echo "
        <div class='alert alert-danger' role='alert'>
Try anthor user name
</div>";
      } elseif (($password1 === $password2)) {
        $stmt = $pdo->prepare("insert into supermarket_user values(?,?,?)");
       $hashedPassword=password_hash ($password1,PASSWORD_DEFAULT);
        $params = array($username, $hashedPassword, null);
        $result = $stmt->execute($params);


        if ($stmt->rowCount() == 1) {
          header('location:login.php');
        }
      } else {
        echo "password is not match";
      }
    }
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
                <h2 class="text-uppercase text-center mb-5">Create an account</h2>

                <form method="post" action="">

                  <div class="form-outline mb-4">
                    <label class="form-label" for="name">Your Name</label>
                    <input type="text" id="name" name="userName" class="form-control form-control" />
                    <span class="error"><?php echo $usernameErr; ?></span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="email">Your Email</label>
                    <input type="email" id="email" name="Email" class="form-control form-control" />
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="pass1">Password</label>
                    <input type="password" id="pass1" name="password1" class="form-control form-control" />
                    <span class="error"><?php echo $pass1Err; ?></span>
                    <span class="error" id="passLen" style="display:none ;">The password must be at least 8 char</span>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="pass2">Repeat your password</label>
                    <input type="password" id="pass2" name="password2" class="form-control form-control" />
                    <span class="error"><?php echo $pass2Err; ?></span>
                  </div>


                  <div class="d-flex justify-content-center">
                    <button type="submit" name="create_accont_btn" class="btn btn-success btn-block btn-lg gradient-custom-4  text-body">Register</button>
                  </div>

                  <p class="text-center text-muted mt-4 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>

                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function() {

      $("#pass1").blur(function() {
        i = $(this).val().length;
        if (i < 8) {
          $("#passLen").show();
        } else {
          $("#passLen").hide();
        }
      });
      $(":submit").click(function() {
        if (i < 8) {
          //This code to stop submit the form
          event.preventDefault();
        };
      });
    })
  </script>

</body>



</html>