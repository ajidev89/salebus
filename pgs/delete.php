<?php
if (isset($_POST['id'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$id = $_POST['id'];
	$msg ="";
	$class ="";
       $id = mysqli_real_escape_string($conn,$id);
       $sql = "DELETE FROM sp_products WHERE id = $id";
       if (mysqli_query($conn,$sql)) {
          $msg = "Successful deleted product";
          $class = "alert alert-success my-2";
       }else{
         echo 'error'. mysqli_error($conn);
       }

echo "<div class ='$class'>$msg</div> ";
}
?>

<?php
if (isset($_POST['catid'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$catid = $_POST['catid'];
	$msg ="";
	$class ="";
       $catid = mysqli_real_escape_string($conn,$catid);
       $sql = "DELETE FROM category WHERE id = '$catid' ";
       if (mysqli_query($conn,$sql)) {
          $msg = "Successful deleted category";
          $class = "alert alert-success my-2";
       }else{
         echo 'error'. mysqli_error($conn);
       }

echo "<div class ='$class'>$msg</div> ";
}
?>

<?php
if (isset($_POST['cartid'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$cartid = $_POST['cartid'];
  $cartid = mysqli_real_escape_string($conn,$cartid);
  $sql = "DELETE FROM cart WHERE id = $cartid";
  if (mysqli_query($conn,$sql)) {
       $msg = "Successful deleted product";
       $class = "alert alert-success my-2";
       }else{
         echo 'error'. mysqli_error($conn);
       }
echo "<div class ='$class'>$msg</div> ";
}
?>

<?php
if (isset($_POST['employid'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$employid = $_POST['employid'];
  $employid = mysqli_real_escape_string($conn,$employid);
  $sql = "DELETE FROM sp_user WHERE id = '$employid' ";
  if (mysqli_query($conn,$sql)) {
       $msg = "Successful deleted employee";
       $class = "alert alert-success my-2";
       }else{
         echo 'error'. mysqli_error($conn);
       }
echo "<div class ='$class'>$msg</div> ";
}
?>