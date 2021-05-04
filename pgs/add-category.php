<h1 class="h3 mb-2 text-gray-800">Add category</h1>
 <p class="mb-4">Add category so that products are easily searched for </p>
<div class="py-1"></div>
<form class="user" id="add" method="POST">
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" name="categoryName" id="categoryName" placeholder="Category Name">
             </div>
             <div class="col-sm-6">
               <input type="text" class="form-control form-control-user" name="categorydesc"id="categorydesc" placeholder="Category descriptions">
             </div>
           </div>
           <div class="form-group">

           </div>
           <button type="submit" form="add" name="addCategory" id="addCategory" class="btn btn-primary btn-user btn-block ">Add category</button>

         </form>

         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               let categoryName = $("#categoryName").val();
               let categorydesc = $("#categorydesc").val();
               let addCategory = $("#addCategory").val()
               $("#alert").load("pgs/product-validate.php",{
                 categoryName: categoryName,
                 categorydesc: categorydesc,
                 addCategory: addCategory
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
