<?php
include('../config/dbconn.php');
include('../config/sessions.php');
 ?>
<div class="py-3"></div>
<form class="user" id="add" method="POST">
     <h1 class="h3 mb-2 text-gray-800">Add Employee </h1>
       <p class="mb-4">Add a new employees by filing the form</p>
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" name="fName" id="fName" placeholder="First Name">
               <div class="text-danger" id="errfirstName" role="alert"></div>
             </div>
             <div class="col-sm-6">
             <input type="text" class="form-control form-control-user" name="lName" id="lName" placeholder="Last Name">
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Username">
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" name="email"id="email" placeholder="E-mail">
           </div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
             </div>
             <div class="col-sm-6">
               <input type="password" class="form-control form-control-user" name="cpassword" id="cpassword" placeholder="Confirm password">
             </div>
           </div>
           <button type="submit" form="add" name="addemployee" id="addemployee" value="Add Employee" class="btn btn-primary btn-user btn-block ">Add Employee</button>
         </form>
      <p class="p-4"></p>
         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               //$("#alert").load("pgs/add-product.php");
               //alert("ment");
               let fName = $("#fName").val();
               let lName = $("#lName").val();
               let username = $("#username").val();
               let email = $("#email").val();
               let password = $("#password").val();
               let cpassword = $("#cpassword").val();
               let addemployee = $("#addemployee").val()
               $("#alert").load("pgs/product-validate.php",{
                 fName: fName,
                 lName: lName,
                 username: username,
                 email: email,
                 password: password,
                 cpassword: cpassword,
                 addemployee: addemployee
               },function() {
                 if ($("#alert div").attr("class") == "alert alert-success my-2") {
                   setTimeout(function() {
                     $("#alert").empty();
                     $("#add")[0].reset();
                   },4000);
                 } else {

                 }
               });
                 });
           });

         </script>
