<?php
include('../config/dbconn.php');
include('../config/sessions.php');

$sql = "SELECT * FROM cart ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
$carts = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);?>


<?php foreach ($carts as $cart) {?>
<!-- Delete Modal-->
<div class="modal fade" id="<?php echo('product'.$cart['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Do you want to delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="<?php echo('alert'.$cart['id']); ?>">Select "Delete" below if you want to delete <?php echo htmlspecialchars($cart['productName']);?> from the cart.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger" href="#" id="<?php echo('delete'.$cart['id']); ?>">Delete</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

 $("#<?php echo('delete'.$cart['id']); ?>").click(function(e){
   e.preventDefault();
   let cartid = <?php echo ($cart['id']); ?>;
   $("#<?php echo('alert'.$cart['id']); ?>").load("pgs/delete.php",{
     cartid:cartid
   },function(){
    $('#<?php echo('product'.$cart['id']); ?>').modal('hide');
    $("#cart").load("pgs/cart.php",function() {
        $("#mksales").load("pgs/mk-sales.php");
    });
   });


 });

</script>

<?php } ?>
