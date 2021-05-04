<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Product(s) added </div>
            <?php
            include('../config/dbconn.php');
            include('../config/sessions.php');
            $sql = "SELECT * FROM sp_products ORDER BY create_at DESC ";
            $result = mysqli_query($conn,$sql);
            $Products = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($Products); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ESTIMATED PROFIT</div>
            <?php if(!array_filter($Products)){ ?>
              <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;0</div>
            <?php }else {
               $totalprofit = 0;
               $totsellp = 0;
               $totcostp = 0;
               foreach ($Products as $product) {
                $sellp = $product['prSellp'] * $product['pr_qty'];
                $costp = $product['prCostp'] * $product['pr_qty'];
                $profit = $sellp - $costp;
                $totalprofit = $totalprofit + $profit;
                $totsellp = $totsellp + $sellp;
                $totcostp = $totcostp + $costp;
              }?>
              <div class="h5 mb-0 font-weight-bold text-gray-800">&#8358;<?php echo number_format("$totalprofit");; ?></div>
            <?php }; ?>
          </div>
          <div class="col-auto">
            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stock Management</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <?php
                $sql = "SELECT * FROM sp_products WHERE pr_qty < 5 ";
                $result = mysqli_query($conn,$sql);
                $stock = mysqli_fetch_all($result,MYSQLI_ASSOC);
                mysqli_free_result($result);
                 if (count($stock) === 0 ) {?>
                   <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Well-Stocked</div>
                 <?php }else {?>
                   <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo count($stock); ?></div>
              <?php }?>
              </div>
              <div class="col">
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-boxes fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Transactions(Monthly)</div>
            <?php
            include('../config/dbconn.php');
            $info = getdate();
            $year = $info['year'];
            $mon = $info['mon'];
            //echo "$year";
            $sql = "SELECT * FROM sp_transaction  WHERE CAST(transtime as DATE) >= '$year-$mon-01' ";
            $result = mysqli_query($conn,$sql);
            $Transactions = mysqli_fetch_all($result,MYSQLI_ASSOC);
            mysqli_free_result($result);
            ?>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($Transactions); ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-fw fa-folder fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Content Row -->

<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Generate Report</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
  <form class="user" id="report-form" method="post">
  <div id="alert"></div>
   <div class="form-group">
     <label></label>
     <select class="input-group-lg custom-select rounded-pill" id="report" name="report">
       <option  value="report">Select type of report</option>
       <option  value="transaction">Transaction Report</option>
       <option  value="Category">Inventory report</option>
       <option  value="Category">Profit report</option>
     </select>
   </div>
   <div class="form-group row">
     <div class="col-sm-6 mb-3 mb-sm-0">
       <label>Start date</label>
       <input type="date" class="form-control form-control-user" name="startdate" id="startdate" placeholder="Selling price">
     </div>
     <div class="col-sm-6">
       <label>End date</label>
       <input type="date" class="form-control form-control-user" name="enddate" id="enddate" placeholder="Cost price">
     </div>
   </div>
   <br>

   <button type="submit" form="report-form" name="genreport" id="genreport" value="Generate report" class="btn btn-primary btn-user btn-block ">Generate report</button>
 </form>
<p class="p-3"></p>
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Statistics</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Selling price
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Cost price
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../vendor/chart.js/Chart.min.js"></script>
<script type="text/javascript">
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
type: 'doughnut',
data: {
  labels: ["Cost price", "Selling price",],
  datasets: [{
    data: [<?php echo "$totcostp"; ?>,<?php echo "$totsellp"; ?>,],
    backgroundColor: ['#4e73df', '#1cc88a'],
    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
    hoverBorderColor: "rgba(234, 236, 244, 1)",
  }],
},
options: {
  maintainAspectRatio: false,
  tooltips: {
    backgroundColor: "rgb(255,255,255)",
    bodyFontColor: "#858796",
    borderColor: '#dddfeb',
    borderWidth: 1,
    xPadding: 15,
    yPadding: 15,
    displayColors: false,
    caretPadding: 10,
  },
  legend: {
    display: false
  },
  cutoutPercentage: 80,
},
});


</script>
<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<!--
<script src="js/demo/chart-pie-demo.j"></script>-->
 <script type="text/javascript">
       $(document).ready(function(){
           $("#report-form").submit(function(e){
               e.preventDefault();
               let report = $("#report").val();
               let startdate = $("#startdate").val();
               let enddate = $("#enddate").val();
               let genreport = $("#genreport").val()
               $("#alert").load("pgs/product-validate.php",{
                 report: report,
                 startdate: startdate,
                 enddate: enddate,
                 genreport: genreport,
               });
            });
       });

         </script>

