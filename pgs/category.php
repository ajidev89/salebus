<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM category ORDER BY id ASC ";
$result = mysqli_query($conn,$sql);
$Categorys = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);


 ?>
          <h1 class="h3 mb-2 text-gray-800">All Category</h1>
           <p class="mb-4">Product are arranged into categories</p>

          <p class="delete"></p>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Category table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Category name</th>
                      <th>Category(s) Found</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Category name</th>
                      <th>Category(s) Found</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody id="categoryTable"></tbody>
                </table>
              </div>
            </div>
          </div>
          <?php foreach ($Categorys as $Category){?>
          <!-- Edit Pop-up-->
           <div class="modal fade" id="<?php echo ('category'.$Category['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
           <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
                </button>
              </div>
             <div class="modal-body">
                <form class="user" id="<?php echo ('edit'.$Category['id']); ?>" method="POST">
              <div id="<?php echo ('alert'.$Category['id']); ?>"></div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Category['categoryName']);?>" name="<?php echo ('categoryName'.$Category['id']); ?>" id="<?php echo ('categoryName'.$Category['id']); ?>" placeholder="Category Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Category['categorydesc']);?>" name="<?php echo ('categorydesc'.$Category['id']); ?>" id="<?php echo ('categorydesc'.$Category['id']); ?>" placeholder="Category description">
                </div>
              </form>
             </div>
               <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" form="<?php echo ('edit'.$Category['id']); ?>" id="<?php echo ('button'.$Category['id']); ?>" name="<?php echo ('button'.$Category['id']); ?>" value="Edit">Edit Category</button>
        </div>
      </div>
    </div>
  </div>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script type="text/javascript">
        $("#<?php echo ('edit'.$Category['id']); ?>").submit(function(e){
                    e.preventDefault();
                    let id = <?php echo ($Category['id']); ?>;
                    let categoryName = $("#<?php echo ('categoryName'.$Category['id']); ?>").val();
                    let categorydesc = $("#<?php echo ('categorydesc'.$Category['id']); ?>").val();
                    let editCategory = $("#<?php echo ('button'.$Category['id']); ?>").val()
                    $("#<?php echo ('alert'.$Category['id']);?>").load("pgs/product-validate.php",{
                      id:id,
                      categoryName: categoryName,
                      categorydesc: categorydesc,
                      editCategory: editCategory
                    },function functionName() {
                    $("#categoryTable").load("pgs/maincat.php");  
                    });
                    });
  </script>
<?php } ?>
<script type="text/javascript">
  $("#categoryTable").load("pgs/maincat.php");
</script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</div>
</div>
