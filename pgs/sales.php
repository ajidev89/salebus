<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_products WHERE pr_qty >= 1 ORDER BY create_at DESC ";
$result = mysqli_query($conn,$sql);
$Products = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

 ?>

	<div class="row">
		<div class="col-md-6 ">
              <h6 class="m-0 font-weight-bold text-primary my-4">Select product</h6>
              <form class="user" id="select-product" method="POST">
             <div id="alert-cart"></div>
               <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                   <input type="text" class="form-control form-control-user" name="select-Quantity" id="select-Quantity" placeholder="Quantity">
                 </div>
                 <div class="col-sm-6">
                    <select class="input-group-lg custom-select rounded-pill" id="cart-Product" name="Select products">
                     <option selected value="Select products">Select products...</option>
                     <?php foreach ($Products as $Product) {?>
                    <option value="<?php echo htmlspecialchars($Product['prName'])?>"><?php echo htmlspecialchars($Product['prName'])?></option>
                 <?php } ?>
                   </select>
                 </div>
               </div>
               <button type="submit" form="select-product" name="addCart" id="addCart" value="Add product" class="btn btn-primary btn-user btn-block ">Add to Cart</button>

             </form>
             <script type="text/javascript">

                 $("#select-product").submit(function(e){
                   e.preventDefault();
                   let qty = $("#select-Quantity").val();
                   let cartproduct = $("#cart-Product").val();
                   let addCart = $("#addCart").val();
                   $("#alert-cart").load("pgs/product-validate.php",{
                     qty: qty,
                     cartproduct: cartproduct,
                     addCart: addCart
                   },function(){
                        if ($("#alert-cart div").attr("class") == "alert alert-success my-2") {
                          setTimeout(function() {
                             $("#cart").load("pgs/cart.php")
                              $("#alert-cart").empty();
                              $("#select-product")[0].reset();
                              $("#modal-cart").load("pgs/modal-cart.php",function() {
                              $("#mksales").load("pgs/mk-sales.php");
                          },2000);
                        });
                      }else{}
                      });
                   });
             </script>
            </div>
		<div class="col-md-6">
              <?php
              $sql = "SELECT * FROM cart ORDER BY id DESC ";
              $result = mysqli_query($conn,$sql);
              $carts = mysqli_fetch_all($result,MYSQLI_ASSOC);
              mysqli_free_result($result);
              //print_r($Products);?>
             <div class="container">
               <div class="row">
                 <div class="col-6 text-left">
                   <h6 class="m-0 font-weight-bold text-primary my-4">Cart</h6>
                 </div>
                 <div class="col-6 text-right" >
                   <a href="#" data-toggle="modal" data-target="#sale" class="btn btn-sm btn-primary shadow-sm my-4">
                     <i class="fas fa-money-check fa-sm text-white-50"></i> Make Sale</a>
                 </div>
               </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th>Price</th>
                      <th>Quantiy</th>
                      <th>Remove</th>
                    </tr>
                  </thead>

                  <tbody id="cart">

                  </tbody>
                </table>
	    </div>
    </div>
    <script type="text/javascript">
      $("#cart").load("pgs/cart.php");
    </script>
    <div id="modal-cart">

         </div>

    <script type="text/javascript">
      $("#modal-cart").load("pgs/modal-cart.php");
    </script>

    <div id="mksales"></div>
    <script type="text/javascript">
    $("#mksales").load("pgs/mk-sales.php");
    </script>
