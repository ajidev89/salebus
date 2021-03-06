<?php
 include("pgs/login.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/favicon.ico" rel="icon">
  <title>Login - Sale+ </title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<!--PRELOADER CSS-->
  <link href="css/preloader.css" rel="stylesheet">
</head>
<body style="background:#f8fbfe">
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image">
               
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                     <div class="text-center" id="msg" role="alert"></div>
                  </div>
                  <form class ="user" id="login" action="" method="POST">
                     <?php if (!empty($errors['invaild'])) {?>
                              <div class="alert alert-danger alert-dismissible fade show small" role="alert"> <?php echo $errors['invaild']; ?>                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              </div>
                    <?php } ?> 
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="username" id="username" value="<?php echo $username; ?>" placeholder="Email or username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                      <div class="text-right">
                      <a href="#" class="small" id="viewPass" >View Password</a>
                      </div>
                     
                    </div>
                    <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-user btn-block">
                    <hr>
                  </form>
          
                  <div class="text-center">
                    <a class="small" href="forgot-password">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <div id="preloader"></div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/preloader.js"></script>
  <script>
    $('#viewPass').click(function(e){
      e.preventDefault();
      //alert("4ghj");
      if ($("#password").attr("type") == "password"){
        $("#password").attr('type','text')      
      }else{
        $("#password").attr('type','password') 
      }
    });

  </script>
</body>

</html>
