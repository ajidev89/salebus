<?php
include("../config/sessions.php");
include("../config/dbconn.php");
$sql = "SELECT * FROM activity WHERE viewed_status = 0 ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
$activities = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo count($activities)."+";
 ?>
