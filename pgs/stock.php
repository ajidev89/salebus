<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_products WHERE pr_qty < 5 ";
$result = mysqli_query($conn,$sql);

$Products = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//print_r($Products);

 ?>
  <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Stock Mangement</h1>
          <p class="mb-4">These are products below the quantity are below 5 </p>
          <p class="delete"></p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Stock management table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product name</th>
                      <th>Selling price</th>
                      <th>Cost price</th>
                      <th>Quantity available</th>
                      <th>Category</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Product name</th>
                      <th>Selling price</th>
                      <th>Cost price</th>
                      <th>Quantity available</th>
                      <th>Category</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody id="stockTable"></tbody>
                </table>
              </div>
            </div>
          </div>
          <?php foreach ($Products as $Product){?>
          <!-- Edit Pop-up-->
        <div class="modal fade" id="<?php echo ('product'.$Product['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
           <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                </button>
              </div>
             <div class="modal-body">
                <form class="user" id="<?php echo ('edit'.$Product['id']); ?>" method="POST">
              <div id="<?php echo ('alert'.$Product['id']); ?>"></div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Product['prName']);?>" name="<?php echo ('productName'.$Product['id']); ?>" id="<?php echo ('productName'.$Product['id']); ?>" placeholder="Product Name">
                  </div>
                  <div class="col-sm-6">
                    <?php
                    $sql = "SELECT categoryName FROM category ORDER BY id DESC";
                    $result =mysqli_query($conn,$sql);
                    $categoryNames = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    // print_r($categoryNames);
                    ?>
                    <select class="input-group-lg custom-select rounded-pill" id="<?php echo ('Category'.$Product['id']); ?>" name="<?php echo ('Category'.$Product['id']); ?>">
                      <option selected value="<?php echo($Product['prCat'])?>"><?php echo($Product['prCat'])?></option>
                      <?php foreach ($categoryNames as $categoryName) {?>
                     <option value="<?php echo htmlspecialchars($categoryName['categoryName'])?>"><?php echo htmlspecialchars($categoryName['categoryName'])?></option>
                  <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Product['pr_qty']);?>" name="<?php echo ('Quantity'.$Product['id']); ?>" id="<?php echo ('Quantity'.$Product['id']); ?>" placeholder="Quantity available">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Product['prSellp']); ?>" name="<?php echo ('prSellp'.$Product['id']); ?>" id="<?php echo ('prSellp'.$Product['id']); ?>" placeholder="Selling price">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Product['prCostp']); ?>" name="<?php echo ('prCostp'.$Product['id']); ?>" id="<?php echo ('prCostp'.$Product['id']); ?>" placeholder="Cost price">
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Product['prDesc']); ?>" name="<?php echo ('prdesc'.$Product['id']); ?>"id="<?php echo ('prdesc'.$Product['id']); ?>" placeholder="Product descriptions">
                </div>
              </form>
             </div>
               <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" form="<?php echo ('edit'.$Product['id']); ?>" id="<?php echo ('button'.$Product['id']); ?>" name="<?php echo ('button'.$Product['id']); ?>" value="Edit">Edit</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript">
        $("#<?php echo ('edit'.$Product['id']); ?>").submit(function(e){
                    e.preventDefault();
                    let id = <?php echo ($Product['id']); ?>;
                    let productName = $("#<?php echo ('productName'.$Product['id']); ?>").val();
                    let Category = $("#<?php echo ('Category'.$Product['id']); ?>").val();
                    let Quantity = $("#<?php echo ('Quantity'.$Product['id']); ?>").val();
                    let prSellp = $("#<?php echo ('prSellp'.$Product['id']); ?>").val();
                    let prCostp = $("#<?php echo ('prCostp'.$Product['id']); ?>").val();
                    let prdesc = $("#<?php echo ('prdesc'.$Product['id']); ?>").val();
                    let editButton = $("#<?php echo ('button'.$Product['id']); ?>").val()
                    $("#<?php echo ('alert'.$Product['id']);?>").load("pgs/edit-product.php",{
                      id:id,
                      productName: productName,
                      Category: Category,
                      Quantity: Quantity,
                      prSellp: prSellp,
                      prCostp: prCostp,
                      prdesc: prdesc,
                      editButton: editButton
                    },function() {
                      $("#stockTable").load("pgs/mainstock.php",function() {
                        setTimeout(function() {
                            $("#<?php echo ('alert'.$Product['id']);?>").empty();
                        },4000);
                      });
                    });
                    });
  </script>
<?php } ?>
<script type="text/javascript">
    $("#stockTable").load("pgs/mainstock.php");
</script>
			  <!-- Page level plugins -->

			  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
			  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

			  <!-- Page level custom scripts -->
			  <script src="js/demo/datatables-demo.js"></script>

      </div>
