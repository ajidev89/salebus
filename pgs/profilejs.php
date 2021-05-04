<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_user WHERE username = '$username'";
$result = mysqli_query($conn,$sql);
$userInfo = mysqli_fetch_assoc($result);
?>
<div class="col-12">
  <!--<img class="card-img" src="img/profile-cover.jpg" alt="">-->
<div class="text-center">
<?php if ($userInfo['logo'] === ""){ ?>
 <div class="text-gray my-2">
   <i class="fas fa-user-circle fa-8x"></i></a>
 </div>
<?php }else{ ?>
 <img class="img-profile rounded-circle my-2" src="<?php echo htmlspecialchars($userInfo['logo']);?>">
 <br>
<?php } ?>
<a href="#" data-toggle="modal" data-target="#logo" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-cloud-upload fa-sm text-white-50"></i>Change profile picture</a>
</div>
<div class="card-body">
<div class="row">
  <div class="col-sm-12">
    <div class="row text-center py-2">
      <div class="col-md-4 text-center">
        <h6>StoreName:</h6>
      </div>
      <div class="col-md-4 text-center">
        <?php echo htmlspecialchars($userInfo['storeName']); ?>
      </div>
      <div class="col-md-4 text-center">
        <a href="#" data-toggle="modal" data-target="#storeName" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-cloud-upload fa-sm text-white-50"></i>Edit</a>
      </div>
    </div>
    <div class="row text-center py-2">
      <div class="col-md-4 text-center">
        <h6>E-mail:</h6>
      </div>
      <div class="col-md-4 text-center">
        <?php echo htmlspecialchars($userInfo['email']); ?>
      </div>
      <div class="col-md-4 text-center">
        <a href="#" data-toggle="modal" data-target="#email" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-cloud-upload fa-sm text-white-50"></i>Edit</a>
      </div>
    </div>
    <div class="row text-center py-2">
      <div class="col-md-4 text-center">
        <h6>Username:</h6>
      </div>
      <div class="col-md-4 text-center">
        <?php echo htmlspecialchars($userInfo['username']); ?>
      </div>
      <div class="col-md-4 text-center">
        <a href="#" data-toggle="modal" data-target="#username" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-cloud-upload fa-sm text-white-50"></i>Edit</a>
      </div>
    </div>
    <div class="row text-center py-2">
      <div class="col-md-4 text-center">
        <h6>Password:</h6>
      </div>
      <div class="col-md-4 text-center">
        <a href="#" data-toggle="modal" data-target="#password" class="btn btn-sm btn-primary shadow-sm"><i class="fas fa-cloud-upload fa-sm text-white-50"></i>Change password</a>
      </div>
      <div class="col-md-4 text-center">
        <?php //echo htmlspecialchars($userInfo['username']); ?>
      </div>
      </div>
  </div>

</div>
</div>
  </div>
  <p class="p-5"></p>
