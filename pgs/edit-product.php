<?php

if (isset($_POST['editButton'])) {

	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$id = $_POST['id'];
	$productName = $_POST['productName'];
	$Category = $_POST['Category'];
	$Quantity = $_POST['Quantity'];
	$prSellp = $_POST['prSellp'];
	$prCostp = $_POST['prCostp'];
    $prdesc = $_POST['prdesc'];


     $msg = "";
    $class ="";
    ///Vaildation Beings
    if (empty($productName)|| ($Category === "Category") || (empty($Quantity)) ||  (empty($prSellp)) || (empty($prCostp)) || (empty($prdesc)) ) {
    	$msg = "Fill all fields";
    	$class = "alert alert-danger my-2";
    }
    elseif (empty($Category)) {
    	$msg = "Category field is required";
    	$class = "alert alert-danger my-2";
    }
    elseif (!is_numeric($Quantity)) {
    	$msg = "Quantity field is not a number";
    	$class = "alert alert-danger my-2";
    }
    elseif  (!is_numeric($prSellp)) {
    	$msg = "Selling price is not a number";
    	$class = "alert alert-danger my-2";
    }
    elseif ($prCostp >= $prSellp) {
    	$msg = "Cost price is greater than your selling price";
    	$class = "alert alert-danger my-2";
    }else{
        	//Update
   	    $productName = mysqli_real_escape_string($conn,$productName);
   	    $Category = mysqli_real_escape_string($conn,$Category);
   	    $Quantity = mysqli_real_escape_string($conn,$Quantity);
   	    $prSellp = mysqli_real_escape_string($conn,$prSellp);
   	    $prCostp = mysqli_real_escape_string($conn,$prCostp);
        $prdesc = mysqli_real_escape_string($conn,$prdesc);
        $username = mysqli_real_escape_string($conn,$username);
        $sql = "UPDATE sp_products SET prName = '$productName',prCat = '$Category',pr_qty = '$Quantity',prDesc = '$prdesc', prCostp = '$prCostp',prSellp = '$prSellp' WHERE id = '$id'";
        if (mysqli_query($conn,$sql)) {
            $msg = 'Successfully Edited Product';
            $class = "alert alert-success my-2";
           }else{
            $msg = 'Product not Edited,';
            $class = "alert alert-danger my-2";

           }
        }




     echo "<div class ='$class'>$msg</div> ";







}else{}








?>
