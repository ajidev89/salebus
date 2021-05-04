<?php
$username ="";
if (isset($_POST['login'])) {
    include('config/dbconn.php');
    $errors= array('invaild'=> "");
    //checking fields
    if(empty($_POST['username']) || empty($_POST['password']) ){
      $errors['invaild'] = "Username or password field is empty";
    }else{
      $username = $_POST['username'];
      $password = $_POST['password'];
      $username = mysqli_real_escape_string($conn, $username);
      $password = mysqli_real_escape_string($conn, $password);
      $sql = "SELECT * FROM sp_user WHERE username = '$username' OR email = '$username' AND password = md5('$password')";
      $result = mysqli_query($conn,$sql);
      $check = mysqli_fetch_assoc($result);
      $count = mysqli_num_rows($result);
      if($count == 1) {
          session_start();
          echo $check['username'];
          $_SESSION['username'] = $check['username'];
          $_SESSION['email'] = $check['email'];
         header("location: dashboard");
       }else{
          $errors['invaild'] ="Invaild login details";
      }
    }
  
}

?>