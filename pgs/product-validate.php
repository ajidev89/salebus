<?php
if (isset($_POST['addproduct'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
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
    }
    else{
         $sql = "SELECT * FROM sp_products WHERE prName = '$productName' ";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $msg = "Product already exist";
            $class = "alert alert-danger my-2";
        }else{
    	//insertion
   	    $productName = mysqli_real_escape_string($conn,$productName);
   	    $Category = mysqli_real_escape_string($conn,$Category);
   	    $Quantity = mysqli_real_escape_string($conn,$Quantity);
   	    $prSellp = mysqli_real_escape_string($conn,$prSellp);
   	    $prCostp = mysqli_real_escape_string($conn,$prCostp);
        $prdesc = mysqli_real_escape_string($conn,$prdesc);
    	$sql = "INSERT INTO sp_products(prName,prCat,prDesc,prSellp,prCostp,pr_qty) VALUES ('$productName','$Category','$prdesc','$prSellp','$prCostp','$Quantity')";
    	if (mysqli_query($conn,$sql)) {
            $msg = 'Successfully Added Product';
            $class = "alert alert-success my-2";
           }else{
            $msg= "Product not added";
            $class = "alert alert-danger my-2";
           }
        }
    }
    echo "<div class ='$class'>$msg</div> ";
}
///Vaildation for category
if (isset($_POST['addCategory'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$categoryName = $_POST['categoryName'];
	$categorydesc = $_POST['categorydesc'];
  $msg = "";
  $class ="";
  //Vaildation Beings
    if (empty($categoryName)|| empty($categorydesc)) {
    	$msg = "Fill all fields";
    	$class = "alert alert-danger my-2";
    }
    else{
         $sql = "SELECT * FROM category WHERE categoryName = '$categoryName'";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) > 0) {
            $msg = "Category already exist";
            $class = "alert alert-danger my-2";
        }else{
    	//insertion
   	    $categoryName = mysqli_real_escape_string($conn,$categoryName);
   	    $categorydesc = mysqli_real_escape_string($conn,$categorydesc);
        $username = mysqli_real_escape_string($conn,$username);
      	$sql = "INSERT INTO category(categoryName,categorydesc) VALUES ('$categoryName','$categorydesc')";
    	  if (mysqli_query($conn,$sql)) {
            $msg = 'Successfully Added Category';
            $class = "alert alert-success my-2";
           }else{
            $msg= "Category not added";
            $class = "alert alert-danger my-2";
           }
        }
    }
    echo "<div class ='$class'>$msg</div> ";
}

//eDIT Category

if (isset($_POST['editCategory'])) {
	include ('../config/dbconn.php');
	include ('../config/sessions.php');
	//Assigning values
	$id = $_POST['id'];
	$categoryName = $_POST['categoryName'];
	$categorydesc = $_POST['categorydesc'];
  $msg = "";
  $class ="";
  ///Vaildation Beings
  if (empty($categoryName)|| empty($categorydesc) ) {
    	$msg = "Fill all fields";
    	$class = "alert alert-danger my-2";
    }else{
			  $categoryName = mysqli_real_escape_string($conn,$categoryName);
 		     $categorydesc = mysqli_real_escape_string($conn,$categorydesc);
				$sql = "UPDATE category SET categoryName = '$categoryName', categorydesc = '$categorydesc' WHERE id = '$id'";
				if (mysqli_query($conn,$sql)) {
						$msg = 'Successfully Edited Category';
						$class = "alert alert-success my-2";
					 }else{
						$msg = 'Product not Edited,';
						$class = "alert alert-danger my-2";

					 }


        }

     echo "<div class ='$class'>$msg</div> ";
}else{}

if (isset($_POST['btn-storeName'])) {

	include ('../config/dbconn.php');
	include ('../config/sessions.php');
 $storeName = $_POST['storeName'];
 $msg = "";
 $class = "";
 if (empty($storeName)) {
	 $msg = "Fill Store name field";
	 $class = "alert alert-danger my-2";
 }else {
	 $storeName = mysqli_real_escape_string($conn,$storeName);
	 $username = mysqli_real_escape_string($conn,$username);
	 $sql = "UPDATE sp_user SET storeName = '$storeName' WHERE username = '$username'";
	 if (mysqli_query($conn,$sql)) {
			 $msg = 'Successfully Edited StoreName';
			 $class = "alert alert-success my-2";
			}else{
			 $msg = 'Store Name not Edited,';
			 $class = "alert alert-danger my-2";
        }
 }
    echo "<div class ='$class'>$msg</div> ";
}else {}

//Select Products
if(isset($_POST['addCart'])) {
	include ('../config/dbconn.php');
	include ('../config/sessions.php');
	$qty = $_POST['qty'];
	$cartproduct = $_POST['cartproduct'];
	$msg = "";
	$class = "";
  if (empty($qty)||($cartproduct === "Select products")) {
 	 $msg = "Fill all field";
 	 $class = "alert alert-danger my-2";
 }else{
    $sql = "SELECT * FROM sp_products WHERE prName = '$cartproduct' ";
    $result = mysqli_query($conn,$sql);
		$products = mysqli_fetch_assoc($result);
		$price = $products['prSellp'];
		$productQty = $products['pr_qty'];
    if ($qty <= $productQty) {
			   $sql = "SELECT * FROM cart WHERE productName = '$cartproduct' ";
		       $result = mysqli_query($conn,$sql);
		       if (mysqli_num_rows($result) > 0) {
				 $msg = "Product is already added";
				 $class = "alert alert-danger my-2";
				}else{
			     $sql = "INSERT INTO cart(productQty,productName,price) VALUES ('$qty','$cartproduct','$price')";
			     if (mysqli_query($conn,$sql)) {
			     $msg = "Successfully added product to cart";
			     $class = "alert alert-success my-2";
			      }else{
			      $msg= "Product not added";
			      $class = "alert alert-danger my-2";
			    }
				}
		}else {
	    $msg = "Cannot make sale ! ". $productQty." product(s) remaining";
		$class = "alert alert-warning my-2";
	}
}
	echo "<div class ='$class'>$msg</div> ";
}else{}

if (isset($_POST['btnSale'])) {
	include ('../config/dbconn.php');
	include ('../config/sessions.php');
	$sql = "SELECT * FROM cart ";
	$result = mysqli_query($conn,$sql);
	$cartpr = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$cartJSON = json_encode($cartpr, JSON_FORCE_OBJECT);
    $customerName = $_POST['CustomerName'];
    $customerPhone = $_POST['CustomerPhone'];
    $amount = $_POST['amount'];
    $discount = $_POST['discount'];
    $msg = "";
    $class = "";
    if (!array_filter($cartpr)) {
	 $msg = "No products in the cart";
	 $class = "alert alert-danger my-2";
    }
    elseif (empty($customerName) || empty($customerPhone) ) {
			$msg = "Fill all field";
			$class = "alert alert-danger my-2";
    }elseif (!is_numeric($customerPhone)) {
			$msg = "You entered wrong number";
			$class = "alert alert-danger my-2";
    }
		else {
		$customerName = mysqli_real_escape_string($conn,$customerName);
	    $customerPhone = mysqli_real_escape_string($conn,$customerPhone);
	    $amount = mysqli_real_escape_string($conn,$amount);
		$cartJSON = mysqli_real_escape_string($conn,$cartJSON);
		$invoiceid = rand(100,900);
	    $sql = "INSERT INTO sp_transaction (customerName,customerPhone,products,discount,prices,invoiceid,userid) VALUES ('$customerName','$customerPhone','$cartJSON','$discount','$amount','$invoiceid','$username')";
	    if (mysqli_query($conn,$sql)) {
		for ($i = 0; $i < count($cartpr); $i++) {
        $productName = $cartpr[$i]['productName'];
        $sql1 = "SELECT * FROM sp_products WHERE prName = '$productName' ";
        $result = mysqli_query($conn,$sql1);
        $pr_qty = mysqli_fetch_assoc($result);
        $newqty = $pr_qty['pr_qty'] - $cartpr[$i]['productQty'];
        $sql2 = "UPDATE sp_products SET pr_qty = '$newqty' WHERE prName = '$productName' ";
        mysqli_query($conn,$sql2);
		if ($newqty < 5) {
				$type = 'stock';
				$activity = $productName .' has '.$newqty.' quantities left in your store';
				$sql = "INSERT INTO activity (Activity,type) VALUES ('$activity','$type')";
				mysqli_query($conn,$sql);
			}else{}
        }
		$sql = "TRUNCATE TABLE cart";
        if (mysqli_query($conn,$sql)) {
						$sql = "SELECT id FROM sp_transaction ORDER BY id DESC";
						$result = mysqli_query($conn,$sql);
						$id = mysqli_fetch_assoc($result);
						$msg = "Congrats on sale <a class='small' target='_blank' href='pgs/invoice?id=".$id['id']."'>Click here to print invoice</a>";
					    $class = "alert alert-success my-2";
						$type = 'transaction';
						$activity ='New transaction alert: Sold products worth NGN'.number_format($amount).' to '.$customerName;
						$sql = "INSERT INTO activity (Activity,type) VALUES ('$activity','$type')";
            mysqli_query($conn,$sql);
            }else{
            $mg= 'error'. mysqli_error($conn);
			$class = "alert alert-danger my-2";
            }
        }else{}
    }
 	echo "<div class ='$class'>$msg</div> ";
}else {}



if (isset($_POST['btnstoreName'])) {
	include ('../config/dbconn.php');
	include ('../config/sessions.php');
  $storeName = $_POST['storeName'];
	$msg = "";
  $class = "";
	$sql = "SELECT * FROM sp_user WHERE username = '$username'";
	$result = mysqli_query($conn,$sql);
	$userInfo = mysqli_fetch_assoc($result);
  //valbegins
	if ($storeName == $userInfo['storeName']) {
		$msg = "No changes made";
	  $class = "alert alert-info my-2";
	}elseif (empty($storeName)) {
		$msg = "Fill fields";
		$class = "alert alert-danger my-2";
	}
	else {
    $storeName = mysqli_real_escape_string($conn,$storeName);
		$sql = "UPDATE sp_user SET storename = '$storeName' WHERE username = '$username' ";
		if (mysqli_query($conn,$sql)) {
			$msg = "Edited Store name successfully";
			$class = "alert alert-success my-2";
		}else {
			$msg = 'error'. mysqli_error($conn);
			$class = "alert alert-danger my-2";
		}
	}

	echo "<div class ='$class'>$msg</div> ";
}else{}

	if (isset($_POST['btnemail'])) {
		include ('../config/dbconn.php');
		include ('../config/sessions.php');
	  $email = $_POST['email'];
		$msg = "";
	  $class = "";
		$sql = "SELECT * FROM sp_user WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		$userInfo = mysqli_fetch_assoc($result);
	  //valbegins
		if ($email == $userInfo['email']) {
			$msg = "No changes made";
		  $class = "alert alert-info my-2";
		}elseif (empty($email)) {
			$msg = "Fill fields";
			$class = "alert alert-danger my-2";
		}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$msg = "Invaild email";
			$class = "alert alert-danger my-2";
		}
		else {
	    $email = mysqli_real_escape_string($conn,$email);
			$sql = "UPDATE sp_user SET email = '$email' WHERE username = '$username' ";
			if (mysqli_query($conn,$sql)) {
				$msg = "Edited E-mail successfully";
				$class = "alert alert-success my-2";
			}else {
				$msg = 'error'. mysqli_error($conn);
				$class = "alert alert-danger my-2";
			}
		}

		echo "<div class ='$class'>$msg</div> ";
	}else{}

	if (isset($_POST['btnpassword'])) {
		include ('../config/dbconn.php');
		include ('../config/sessions.php');
	  $oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		$msg = "";
	  $class = "";
		$sql = "SELECT * FROM sp_user WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		$userInfo = mysqli_fetch_assoc($result);
		echo md5($userInfo['password']);
	  //valbegins
		if (empty($oldpassword) || empty($newpassword)) {
			$msg = "Fill fields";
			$class = "alert alert-danger my-2";
		}
	  elseif ($oldpassword != md5($userInfo['password'])) {
		$msg = "Wrong password";
		$class = "alert alert-info my-2";
  	}elseif (strlen($newpassword) < 6) {
			$msg = "New Password too short";
			$class = "alert alert-danger my-2";
		}
		else {
	    $newpassword = mysqli_real_escape_string($conn,$newpassword);
			$sql = "UPDATE sp_user SET password = '$newpassword' WHERE username = '$username' ";
			if (mysqli_query($conn,$sql)) {
				$msg = "Edited Password successfully";
				$class = "alert alert-success my-2";
			}else {
				$msg = 'error'. mysqli_error($conn);
				$class = "alert alert-danger my-2";
			}
		}

		echo "<div class ='$class'>$msg</div> ";
	}else{}

if (isset($_POST['addemployee'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$email = $_POST['email'];

	$msg = "";
	$class ="";
	///Vaildation Beings
	if (empty($fName) || (empty($lName)) || (empty($username)) ||  (empty($email)) || (empty($password)) || (empty($cpassword)) ) {
		$msg = "Fill all fields";
		$class = "alert alert-danger my-2";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$msg = "Invaild E-mail address";
		$class = "alert alert-danger my-2";
	}
	elseif (strlen($password) < 6 ) {
		$msg = "Password is too short";
		$class = "alert alert-danger my-2";
	}
	elseif ($password != $cpassword) {
		$msg = "Password do not match";
		$class = "alert alert-danger my-2";
	}
	else{
		$sql = "SELECT * FROM sp_user WHERE username = '$username' OR email = '$email'; ";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result) > 0) {
			$msg = "Employee already exist";
			$class = "alert alert-danger my-2";
		}else{
		//insertion
		    $password = md5($password);
			$fName = mysqli_real_escape_string($conn,$fName);
			$lName = mysqli_real_escape_string($conn,$lName);
			$email = mysqli_real_escape_string($conn,$email);
			$password = mysqli_real_escape_string($conn,$password);
			$username = mysqli_real_escape_string($conn,$username);
		    $sql = "INSERT INTO sp_user (firstName,lastName,email,password,username) VALUES ('$fName','$lName','$email','$password','$username') ";
	        if (mysqli_query($conn,$sql)) {
			$msg = 'Successfully Added Employee';
			$class = "alert alert-success my-2";
			}else{
			$msg= "Employee not added";
			$class = "alert alert-danger my-2";
			}
		}
	}
	echo "<div class ='$class'>$msg</div> ";
}
if (isset($_POST['addStoreinfo'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$sName = $_POST['sName'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$pNumber = $_POST['pNumber'];
	$msg = "";
	$class ="";
	///Vaildation Beings
	if (empty($sName) || (empty($address)) ||  (empty($email)) || (empty($pNumber)) ) {
		$msg = "Fill all fields";
		$class = "alert alert-danger my-2";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$msg = "Invaild E-mail address";
		$class = "alert alert-danger my-2";
	}
	elseif (strlen($pNumber) != 11 ) {
		$msg = "Invaild Phone Number";
		$class = "alert alert-danger my-2";
	}
	else{
		$sName = mysqli_real_escape_string($conn,$sName);
		$address = mysqli_real_escape_string($conn,$address);
		$email = mysqli_real_escape_string($conn,$email);
		$pNumber = mysqli_real_escape_string($conn,$pNumber);
		$sql = "SELECT * FROM storeinfo";
		$result = mysqli_query($conn,$sql);
		$check = mysqli_fetch_assoc($result);
		if (empty($check)) {
			//insertion
 		    $sql = "INSERT INTO storeinfo (storeName,storeAddress,email,phone) VALUES ('$sName','$address','$email','$pNumber') ";
	        if (mysqli_query($conn,$sql)) {
			$msg = 'Successfully added store information';
			$class = "alert alert-success my-2";
			}else{
			$msg= "Store information not added";
			$class = "alert alert-danger my-2";
			}  	
		}else{
             //Update
			 $sql = "UPDATE storeinfo SET storeName = '$sName', storeAddress = '$address', email = '$email' WHERE id = 1 ";
			 if (mysqli_query($conn,$sql)) {
				$msg = 'Successfully edit store information';
				$class = "alert alert-success my-2";		
			 }else{
				$msg= "Store information not edited";
				$class = "alert alert-danger my-2"; 
			 }		
		}
	}
	echo "<div class ='$class'>$msg</div> ";
}
if (isset($_POST['editInfo'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$npassword = $_POST['npassword'];
	$email = $_POST['email'];

	$msg = "";
	$class ="";
	$sql = "SELECT * FROM sp_user WHERE username = '$username' ";
    $result = mysqli_query($conn,$sql);
    $userInfo = mysqli_fetch_assoc($result);
	$id = $userInfo['id'];
	///Vaildation Beings
	if (empty($fName) || (empty($lName)) || (empty($username)) ||  (empty($email)) || (empty($password)) || (empty($npassword)) ) {
		$msg = "Fill all fields";
		$class = "alert alert-danger my-2";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$msg = "Invaild E-mail address";
		$class = "alert alert-danger my-2";
	}
	elseif (md5($password) != $userInfo['password']) {
		$msg = "Password do not match";
		$class = "alert alert-danger my-2";
	}
	elseif (strlen($npassword) < 6 ) {
		$msg = "Password is too short";
		$class = "alert alert-danger my-2";
	}else{
		    //update
		    $npassword = md5($npassword);
			$fName = mysqli_real_escape_string($conn,$fName);
			$lName = mysqli_real_escape_string($conn,$lName);
			$email = mysqli_real_escape_string($conn,$email);
			$npassword = mysqli_real_escape_string($conn,$npassword);
			$username = mysqli_real_escape_string($conn,$username);
			 //Update
			 $sql = "UPDATE sp_user SET firstName = '$fName', username = '$username', lastName = '$lName', email = '$email', password = '$npassword' WHERE id = '$id' ";
			 if (mysqli_query($conn,$sql)) {
				$msg = 'Successfully edit profile';
				$class = "alert alert-success my-2";		
			 }else{
				$msg= "Profile not edited";
				$class = "alert alert-danger my-2"; 
			 }
		}
	echo "<div class ='$class'>$msg</div> ";
}
if (isset($_POST['genreport'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	//Assigning values
	$report = $_POST['report'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];

	$msg = "";
	$class ="";

	///Vaildation Beings
	if ( ($report === 'report') || (empty($startdate)) || (empty($enddate)) ) {
		$msg = "Fill all fields";
		$class = "alert alert-danger my-2";
	}
	elseif ($report === 'transaction') {
		$msg = "Report generated <a class='small' target='_blank' href='pgs/transaction-report?startdate=".$startdate."&enddate=".$enddate."'>Click here to print report</a>";
		$class = "alert alert-success my-2";
	}
	echo "<div class ='$class'>$msg</div> ";
}
if (isset($_POST['mkadmin'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$id = $_POST['mkadmin'];
	$msg = "";
	$class ="";
     
	$sql = "UPDATE sp_user SET isAdmin = 1  WHERE id = '$id' ";

	if (mysqli_query($conn,$sql)) {
	   $msg = 'Successfully made admin';
	   $class = "alert alert-success my-2";		
	}else{
	   $msg= "Profile not edited";
	   $class = "alert alert-danger my-2"; 
	}

	echo "<div class ='$class'>$msg</div> ";
}
if (isset($_POST['rmadmin'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	$id = $_POST['rmadmin'];
	$msg = "";
	$class ="";
    $sql = "SELECT * FROM sp_user WHERE isAdmin = 1 ";
	$result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 1) {
	$sql = "UPDATE sp_user SET isAdmin = 0  WHERE id = '$id' ";

	if (mysqli_query($conn,$sql)) {
	   $msg = 'Successfully remove admin';
	   $class = "alert alert-success my-2";		
	}else{
	   $msg= "Profile not edited";
	   $class = "alert alert-danger my-2"; 
	}

   }else{
	$msg = 'One account must remain an Admin';
	$class = "alert alert-success my-2";	
   }

	echo "<div class ='$class'>$msg</div> ";
}
 
if (isset($_POST['addcustomer'])) {
	include ('../config/dbconn.php');
	include('../config/sessions.php');
	
	//Assigning values
	$report = $_POST['report'];
	$startdate = $_POST['startdate'];
	$enddate = $_POST['enddate'];

	$msg = "";
	$class ="";

	
}

?>
