<?php
include('../config/dbconn.php');
include('../config/sessions.php');
 ?>
 <?php 
 $sql = "SELECT * FROM sp_user WHERE username = '$username' ";
 $result = mysqli_query($conn,$sql);
 $userInfo = mysqli_fetch_assoc($result);
 ?>
<div class="py-3"></div>
<form class="user" id="add" method="POST">
     <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
       <p class="mb-4"></p>
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" value="<?php echo $userInfo['firstName']; ?>" name="fName" id="fName" placeholder="First Name">
               <div class="text-danger" id="errfirstName" role="alert"></div>
             </div>
             <div class="col-sm-6">
             <input type="text" class="form-control form-control-user" value="<?php echo $userInfo['lastName']; ?>" name="lName" id="lName" placeholder="Last Name">
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" value="<?php echo $userInfo['username']; ?>" name="username" id="username" placeholder="Username">
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" value="<?php echo $userInfo['email']; ?>" name="email" id="email" placeholder="E-mail" <?php if ($userInfo['email'] == "admin") {
               echo "disabled";
             } ?> >
           </div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Old password">
             </div>
             <div class="col-sm-6">
               <input type="password" class="form-control form-control-user" name="npassword" id="npassword" placeholder="New password">
             </div>
           </div>

           <button type="submit" form="add" name="editInfo" id="editInfo" class="btn btn-primary btn-user btn-block ">Edit Profile</button>
         </form>
      <p class="p-5"></p>
         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               let fName = $("#fName").val();
               let lName = $("#lName").val();
               let email = $("#email").val();
               let username = $("#username").val();
               let password = $("#password").val();
               let npassword = $("#npassword").val();
               let editInfo = $("#editInfo").val()
               $("#alert").load("pgs/product-validate.php",{
                 fName: fName,
                 lName: lName,
                 username: username,
                 email: email,
                 password: password,
                 npassword: npassword,
                 editInfo: editInfo
               },function() {
                 if ($("#alert div").attr("class") == "alert alert-success my-2") {
                   setTimeout(function() {
                     $("#alert").empty();
                   },4000);
                 } else {
                 }
               });
                 });
           });

         </script>
