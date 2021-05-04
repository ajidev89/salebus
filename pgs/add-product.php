<?php
include('../config/dbconn.php');
include('../config/sessions.php');
 ?>
<div class="py-3"></div>
<form class="user" id="add" method="POST">
     <h1 class="h3 mb-2 text-gray-800">Add product</h1>
       <p class="mb-4">Add a new product by filing the form</p>
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" name="productName" id="productName" placeholder="Product Name">
               <div class="text-danger" id="errfirstName" role="alert"></div>
             </div>
             <div class="col-sm-6">
               <?php
               $sql = "SELECT categoryName FROM category ORDER BY id DESC";
               $result =mysqli_query($conn,$sql);
               $categoryNames = mysqli_fetch_all($result,MYSQLI_ASSOC);
               // print_r($categoryNames);
               ?>
               <select class="input-group-lg custom-select rounded-pill" id="Category" name="Category">
                 <option selected value="Category">Select Category</option>
                 <?php foreach ($categoryNames as $categoryName) {?>
                <option value="<?php echo htmlspecialchars($categoryName['categoryName'])?>"><?php echo htmlspecialchars($categoryName['categoryName'])?></option>
             <?php } ?>
               </select>
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" name="Quantity" id="Quantity" placeholder="Quantity available">
           </div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" name="prSellp" id="prSellp" placeholder="Selling price">
             </div>
             <div class="col-sm-6">
               <input type="text" class="form-control form-control-user" name="prCostp" id="prCostp" placeholder="Cost price">
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" name="prdesc"id="prdesc" placeholder="Product descriptions">
           </div>
           <button type="submit" form="add" name="addproduct" id="addproduct" value="Add product" class="btn btn-primary btn-user btn-block ">Add product</button>

         </form>
      <p class="p-4"></p>
         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               //$("#alert").load("pgs/add-product.php");
               //alert("ment");
               let productName = $("#productName").val();
               let Category = $("#Category").val();
               let Quantity= $("#Quantity").val();
               let prSellp = $("#prSellp").val();
               let prCostp = $("#prCostp").val();
               let prdesc = $("#prdesc").val();
               let addproduct = $("#addproduct").val()
               $("#alert").load("pgs/product-validate.php",{
                 productName: productName,
                 Category: Category,
                 Quantity: Quantity,
                 prSellp: prSellp,
                 prCostp: prCostp,
                 prdesc: prdesc,
                 addproduct: addproduct
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
