<?php
if ($_FILES['file']['name'] != "" ) {
    include('../config/dbconn.php');
    $test = explode(".", $_FILES['file']['name']);
    $extension = end($test);
    $name = "logo." . $extension;
    $location = '../img/'.$name;
    $locDB = 'img/'.$name;
    $sql = "UPDATE storeinfo SET logo = '$locDB' WHERE id = 1 ";
    mysqli_query($conn,$sql);
    $_SESSION['profileUrl'] = $locDB;
    move_uploaded_file($_FILES["file"]["tmp_name"], $location );
}