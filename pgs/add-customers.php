<?php
include('../config/dbconn.php');
include('../config/sessions.php');
 ?>
<div class="py-3"></div>
<form class="user" id="add" method="POST">
     <h1 class="h3 mb-2 text-gray-800">Add Customer </h1>
       <p class="mb-4">Add a new customer by filing the form</p>
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" name="customerName" id="customerName" placeholder="Customer Name">
               <div class="text-danger" id="errfirstName" role="alert"></div>
             </div>
             <div class="col-sm-6">
             <input type="text" class="form-control form-control-user" name="phone" id="phone" placeholder="Phone Number">
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="E-mail">
           </div>
           <div class="form-group">
           <select class="input-group-lg custom-select rounded-pill" id="gender" name="gender">
                 <option selected value="Category">Select Gender</option>
                 <option value="Male">Male</option>
                 <option value="Female">Female</option>
               </select>
           </div>
           <button type="submit" form="add" name="addcustomer" id="addcustomer" value="Add Employee" class="btn btn-primary btn-user btn-block ">Add Customers</button>
         </form>
      <p class="p-4"></p>
         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               let customerName = $("#customerName").val();
               let phone = $("#phone").val();
               let email = $("#email").val();
               let gender = $("#gender").val();
               let addcustomer = $("#addcustomer").val()
               $("#alert").load("pgs/product-validate.php",{
                 customerName: customerName,
                 phone: phone,
                 gender: gender,
                 email: email,
                 addcustomer: addcustomer
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
