<?php  
$conn = mysqli_connect('localhost','root',"",'salebus');
 if (!$conn) {
	echo 'Connection error:'. mysqli_connect_error();
	header("location: 404");
}
?>