<?php
include("../config/sessions.php");
include("../config/dbconn.php");
$sql = "UPDATE activity SET viewed = '1' ";
mysqli_query($conn,$sql);

 ?>