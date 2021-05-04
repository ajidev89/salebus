
<div class="col-12">
  <div class="card shadow h-100 p-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text font-weight-bold text-primary text-uppercase mb-1">Activity Log</div>
          <?php
          include('../config/dbconn.php');
          include('../config/sessions.php');
          $sql = "UPDATE activity SET viewed_status = '1' ";
          mysqli_query($conn,$sql);

          $sql = "SELECT * FROM activity ORDER BY id DESC ";
          $result = mysqli_query($conn,$sql);
          $activities = mysqli_fetch_all($result,MYSQLI_ASSOC);
          mysqli_free_result($result);
          if (array_filter($activities)) {?>
          <script>
             $("#count-notif").load("pgs/count-notif.php");
          </script>

         <?php foreach ($activities as $activity): ?>
           <div class="dropdown-item d-flex align-items-left">
             <div class="mr-3">
               <?php if ($activity['type'] == 'product'){?>
                 <div class="icon-circle bg-primary">
                   <i class="fas fa-file-alt text-white"></i>
                 </div>
               <?php }elseif ($activity['type'] == 'transaction') {?>
                 <div class="icon-circle bg-success">
                   <i class="fas fa-donate text-white"></i>
                 </div>
               <?php }elseif ($activity['type'] == 'stock') {?>
                 <div class="icon-circle bg-warning">
                   <i class="fas fa-exclamation-triangle text-white"></i>
                 </div>
               <?php } ?>
             </div>
             <div>
               <div class="small text-gray-500"><?php echo date('F j, Y g:i a',strtotime($activity['current_time']));  ?></div>
               <span class="font-weight-bold"><?php echo $activity['Activity']; ?></span>
             </div>
           </div>
         <?php endforeach; ?>
       <?php }else { ?>
         <div class="text-center">
           <p class="p-3"></p>
           <p>No activity in the past 30 days</p>
           <p class="p-3"></p>
         </div>
         <?php } ?>

        </div>
      </div>
    </div>
  </div>
</div>
<p class="p-5"></p>
