
<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_transaction ORDER BY transtime DESC";
$result = mysqli_query($conn,$sql);

$Transactions = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//print_r($Products);

 ?>
  <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Transactions</h1>
          <p class="mb-4">These are full records of Customers and amount paid </p>
          <p class="delete"></p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Transactions record</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Customer's name</th>
                      <th>Customer's number</th>
                      <th>Amount paid</th>
                      <th>Discount</th>
                      <th>Time of transaction</th>
                      <th>Generate Invoice</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Customer's name</th>
                      <th>Customer's number</th>
                      <th>Amount paid</th>
                      <th>Discount</th>
                      <th>Time of transaction</th>
                      <th>Generate Invoice</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php foreach ($Transactions as $Transaction){ ?>
			      <tr>
                  <td><?php echo htmlspecialchars($Transaction['customerName']);?></td>
                  <td><?php echo htmlspecialchars($Transaction['customerPhone']); ?></td>
                  <td>&#8358;<?php echo htmlspecialchars(number_format($Transaction['prices']));?></td>
                  <td><?php echo htmlspecialchars($Transaction['discount']);  ?></td>
                  <td><?php echo date('F j, Y g:i a',strtotime($Transaction['transtime']));  ?></td>
                  <td>
                  <a href="#" data-toggle="modal" data-target="#<?php echo('generate'.$Transaction['id']); ?>">Generate Invoice</a>

                  </td>
               </tr>
		       <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<script src="../vendor/jquery/jquery.min.js"></script>
  <?php foreach ($Transactions as $Transaction){?>
<!-- Edit Generate Pop-up-->
<div class="modal fade" id="<?php echo ('generate'.$Transaction['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
 <div class="modal-content">
 <div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Generate Invoice</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">×</span>
      </button>
    </div>
   <div class="modal-body" id="<?php echo ('modal-body'.$Transaction['id']); ?>">
   <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="<?php echo ('info-tab'.$Transaction['id']); ?>" data-toggle="tab" href="#<?php echo ('info'.$Transaction['id']); ?>" role="tab" aria-controls="<?php echo ('info'.$Transaction['id']); ?>" aria-selected="true">More Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="<?php echo ('email-tab'.$Transaction['id']); ?>" data-toggle="tab" href="#<?php echo ('email'.$Transaction['id']); ?>" role="tab" aria-controls="<?php echo ('info'.$Transaction['id']); ?>" aria-selected="false">Send via E-mail</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active pt-3" id="<?php echo ('info'.$Transaction['id']); ?>" role="tabpanel" aria-labelledby="<?php echo ('info-tab'.$Transaction['id']); ?>">
        <form class="user" id="<?php echo ('edit'.$Transaction['id']); ?>" method="POST">
          <div id="<?php echo ('alert'.$Transaction['id']); ?>"></div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Customer's name</label>
                <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Transaction['customerName']);?>" name="<?php echo ('customerName'.$Transaction['customerName']); ?>" id="disabledInput" placeholder="Transaction Name" disabled>
              </div>
              <div class="col-sm-6">
                <label>Customer's phone</label>
                <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Transaction['customerPhone']);?>" name="<?php echo ('customerPhone'.$Transaction['customerPhone']); ?>" id="disabledInput" placeholder="Transaction Name" disabled>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Amount paid</label>
                <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Transaction['prices']);?>" name="<?php echo ('amount'.$Transaction['id']); ?>" id="disabledInput" placeholder="Transaction Name" disabled>
              </div>
              <div class="col-sm-6">
                <label>Discount</label>
                <input type="text" class="form-control form-control-user" value="<?php echo htmlspecialchars($Transaction['discount']);?>" name="<?php echo ('discount'.$Transaction['id']); ?>" id="disabledInput" placeholder="Transaction Name" disabled>
              </div>
            </div>
            <div class="form-group">
              <label>Products bought(Qty)</label>
              <div class="overflow-auto p-2 mb-2 mb-md-0 mr-md-2 bg-light" style="max-height:100px;">
              <?php
              $products = json_decode($Transaction['products'],true);
              foreach ($products as $product) {
                echo $product['productName']  ."  x  ".  $product['productQty']."<br>";
              }
              ?>
              </div>
            </div>
       </form>
      </div>
      <div class="tab-pane fade pt-3" id="<?php echo ('email'.$Transaction['id']); ?>" role="tabpanel" aria-labelledby="<?php echo ('email-tab'.$Transaction['id']); ?>">
          <div class="py-1"></div>
          <form class="user" id="<?php echo ('SendEmail'.$Transaction['id']); ?>" method="POST">
            <div id="<?php echo ('emailalert'.$Transaction['id']); ?>"></div>
              <div class="form-group">
              <input type="email" class="form-control form-control-user" name="<?php echo ('emailVal'.$Transaction['id']); ?>" id="<?php echo ('emailVal'.$Transaction['id']); ?>" placeholder="E-mail">
            </div>
            <input type="submit" value="Send invoice" class="btn btn-primary">
          </form>
      </div>
    </div>

  </div>
<div class="modal-footer">
<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
<a class="btn btn-primary" target="_blank" href="pgs/invoice?id=<?php echo ($Transaction['id']);?>">Print</a>
</div>
</div>
</div>
</div>
<script type="text/javascript">
  $("#<?php echo ('SendEmail'.$Transaction['id']); ?>").submit(function(e){
     e.preventDefault();
     let email = $("#<?php echo ('emailVal'.$Transaction['id']); ?>").val();
     $("#<?php echo ('emailalert'.$Transaction['id']); ?>").load("pgs/email.php?id=<?php echo $Transaction['id'];?>&email="+ email); 
  });
</script>
<?php } ?>

			  <!-- Page level plugins -->

			  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
			  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

			  <!-- Page level custom scripts -->
			  <script src="js/demo/datatables-demo.js"></script>

      </div>
