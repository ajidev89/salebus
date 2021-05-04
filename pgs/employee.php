<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_user";
$result = mysqli_query($conn,$sql);

$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//print_r($Products);

 ?>
  <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">Users</h1>
          <p class="mb-4">List all of Employee</p>
          <p class="delete"></p>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Employee Table</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                      <th>E-mail</th>
                      <th>Make Admin</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                      <th>E-mail</th>
                      <th>Make Admin</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody id="employee"></tbody>
                </table>
              </div>
            </div>
          </div>    

           
			  <!-- Page level plugins -->

			  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
			  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

			  <!-- Page level custom scripts -->
			  <script src="js/demo/datatables-demo.js"></script>
        <script type="text/javascript">
        $("#employee").load("pgs/employtable.php")
        </script>
      </div>
