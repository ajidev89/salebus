<?php
include ('../config/dbconn.php');
include ('../config/sessions.php');
$sql = "SELECT * FROM cart ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
$carts = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);

$sql = "SELECT * FROM customers ORDER BY create_date DESC ";
$result = mysqli_query($conn,$sql);
$customers = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
?>


<!-- Make Sales-->
<div class="modal fade" id="sale" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Make Sales</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span>
      </button>
    </div>
   <div class="modal-body">
      <form class="user" id="mk-sales" method="POST">
    <div id="alert-sales"></div>
      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <label>Customer's name</label>
          <input type="text" class="form-control form-control-user" list="customers" value="" name="" id="CustomerName" placeholder="Customer Name">
          <datalist id="customers">
            <?php foreach($customers as $customer){ ?>
            <option><?php echo $customer['customerName']; ?></option>
            <?php } ?>

          </datalist>
        </div>
        <div class="col-sm-6">
          <label>Customer's phone</label>
          <input type="text" class="form-control form-control-user" value="" name="" id="CustomerPhone" placeholder="Customer's phone">
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-0">
          <label>Amount(NGN)</label>
          <input type="text" class="form-control form-control-user" value="<?php $sum = 0;

          foreach ($carts as $cart) {
            $toprods  = htmlspecialchars($cart['price']) * htmlspecialchars($cart['productQty']);
            $sum = $sum + $toprods;
          }
          echo ($sum);
          ?>" name="" id="disabledInput" placeholder="Transaction Name" disabled>
        </div>
        <div class="col-sm-6">
          <label>Discount</label>
          <select class="input-group-lg custom-select rounded-pill" id="Discount" onchange="price()" name="Discount">
            <option selected value="0%">Discount</option>
            <option value="5%" id="discount0">5%</option>
            <option value="10%" id="discount1">10%</option>
            <option value="15%"id="discount2">15%</option>
            <option value="20%" id="discount3">20%</option>
          </select>
      </div>
    </div>
      <div class="form-group">
        <label>Products (Qty)</label>
        <div class="overflow-auto p-2 mb-2 mb-md-0 mr-md-2 bg-light" style="max-height:80px;">
          <?php foreach ($carts as $cart){ ?>
                <span class="small"><?php echo htmlspecialchars($cart['productName']."(".($cart['productQty']).")");?></span>
                <br>
          <?php } ?>
        </div>
      </div>
    </form>
   </div>
     <div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary" form="mk-sales" id="btn-sales" name="" value="Sales">Make Sale</butto>
</div>
</div>
</div>
</div>
<?php
$fin = "";
foreach ($carts as $cart) {
 $pr = $cart['productName']." ".'('.$cart['productQty'].')'.", ";
 $fin = $fin.$pr;}
 ?>
<script type="text/javascript">
      function price() {

       if (($("#Discount").val()) == '5%') {
         let ratio = 0.05;
         let totprice = <?php echo $sum; ?>;
         let discount = ratio * totprice
         let disprice = <?php echo $sum; ?> - discount
         $("#disabledInput").val(disprice)
       }else if (($("#Discount").val()) == '10%') {
         let ratio = 0.1;
         let totprice = <?php echo $sum; ?>;
         let discount = ratio * totprice
         let disprice = <?php echo $sum; ?> - discount
         $("#disabledInput").val(disprice)
       }
       else if (($("#Discount").val()) == '15%')  {
         let ratio = 0.15;
         let totprice = <?php echo $sum; ?>;
         let discount = ratio * totprice
         let disprice = <?php echo $sum; ?> - discount
         $("#disabledInput").val(disprice)
       }
       else if (($("#Discount").val()) == '20%') {
         let ratio = 0.2;
         let totprice = <?php echo $sum; ?>;
         let discount = ratio * totprice
         let disprice = <?php echo $sum; ?> - discount
         $("#disabledInput").val(disprice)
       }
       else {
         let ratio = 0;
         let totprice = <?php echo $sum; ?>;
         let discount = ratio * totprice
         let disprice = <?php echo $sum; ?> - discount
         $("#disabledInput").val(disprice)
       }
      }


  /// INSERT TO  Transaction

   $("#mk-sales").submit(function(e){
     e.preventDefault();
     let CustomerName = $("#CustomerName").val();
     let CustomerPhone = $("#CustomerPhone").val();
     let discount = $("#Discount").val()
     let amount = $("#disabledInput").val();
     let btnSale = $("#btn-sales").val();
     $("#alert-sales").load("pgs/product-validate.php",{
       CustomerName: CustomerName,
       CustomerPhone: CustomerPhone,
       discount: discount,
       amount: amount,
       btnSale: btnSale
     },function() {
       $("#cart").load("pgs/cart.php",function() {
         $("#modal-cart").load("pgs/modal-cart.php",function(){
          $("#count-notif").load("pgs/count-notif.php",function(){
            $("#notif-log").load("pgs/notif-log.php");
          });
         });
         });
       });
     });
</script>
