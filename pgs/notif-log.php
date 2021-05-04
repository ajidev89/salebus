<?php
include("../config/sessions.php");
include("../config/dbconn.php");
$sql = "SELECT * FROM activity ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
$activities = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
if (array_filter($activities)) {
  if (count($activities) >= 3) {
    for ($i=0; $i < 3 ; $i++) {?>
      <div class="dropdown-item d-flex align-items-center">
        <div class="mr-3">
          <?php if ($activities[$i]['type'] == 'product'){?>
            <div class="icon-circle bg-primary">
              <i class="fas fa-file-alt text-white"></i>
            </div>
          <?php }elseif ($activities[$i]['type'] == 'transaction') {?>
            <div class="icon-circle bg-success">
              <i class="fas fa-donate text-white"></i>
            </div>
          <?php }elseif ($activities[$i]['type'] == 'stock') {?>
            <div class="icon-circle bg-warning">
              <i class="fas fa-exclamation-triangle text-white"></i>
            </div>
          <?php } ?>
        </div>
        <div>
          <div class="small text-gray-500"><?php echo date('F j, Y g:i a',strtotime($activities[$i]['current_time']));  ?></div>
          <span class="font-weight-bold"><?php echo $activities[$i]['Activity']; ?></span>
        </div>
      </div>
    <?php } ?>
<?php }else {
     for ($i=0; $i < count($activities) ; $i++) {?>
    <div class="dropdown-item d-flex align-items-center">
      <div class="mr-3">
        <?php if ($activities[$i]['type'] == 'product'){?>
          <div class="icon-circle bg-primary">
            <i class="fas fa-file-alt text-white"></i>
          </div>
        <?php }elseif ($activities[$i]['type'] == 'transaction') {?>
          <div class="icon-circle bg-success">
            <i class="fas fa-donate text-white"></i>
          </div>
        <?php }elseif ($activities[$i]['type'] == 'stock') {?>
          <div class="icon-circle bg-warning">
            <i class="fas fa-exclamation-triangle text-white"></i>
          </div>
        <?php } ?>
      </div>
      <div>
        <div class="small text-gray-500"><?php echo date('F j, Y g:i a',strtotime($activities[$i]['current_time']));  ?></div>
        <span class="font-weight-bold"><?php echo $activities[$i]['Activity']; ?></span>
      </div>
    </div>
  <?php } ?>
<?php } ?>
<?php }else { ?>
  <div class="text-center">
    <p class="p-3"></p>
    <p>No activity in the past 30 days</p>
    <p class="p-3"></p>
  </div>
<?php } ?>
